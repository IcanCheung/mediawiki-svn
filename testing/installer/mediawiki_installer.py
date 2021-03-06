# (C) 2008,2009 Wikiation 
# (C) 2009 Kim Bruning 
#
# Distributed under the terms of the MIT license.

import settings_handler as settings
import os, os.path, shutil, sys
import subprocess

from installation_system import Installation_System, Installer_Exception

from installer_util import *
from isolation import *
import installer_util

# this still uses some legacy structured code, wrapped in a class so it can't do
#too much harm outside this file. Will refactor later when I have more time.

# already partially refactored while creating class.


#constants

#Things that are not mediawiki revisions (in the svn tags directory on mediawiki svn)
filter_available=['extensions/']

# a cache for mediawiki revisions. Just making a global in this namespace is easiest.
revision_cache=[]

class Mediawiki_Installer_Exception(Installer_Exception):
	pass


class Mediawiki_Installer(Installation_System):
	"""installer for mediawiki revisions"""
	system_name='mediawiki'
	# TODO: destination_dir isn't quite changable until we have finished refactoring everything (not today)
	def __init__(self):
		Installation_System.__init__(self)
		self.destination_dir=settings.instancesdir
	
	def get_installers(self):
		"""list available items"""

		l=list(os.popen('svn ls '+settings.tagsdir))
		stripped=[line.strip() for line in l]
		#filter out things that are not mediawiki revisions
		for item in filter_available:
			if item in stripped:
				stripped.remove(item)
		return stripped
	
	def get_tags(self,installer_name=None):
		return self.get_installers()

	#def exists: same as super

	# Hmm: perhaps these should really belong in a separate mixin?
	#installdir_name: unused, but leave for future expansion
	#exec_task: unused, but leave for future expansion
	#can_exec: unused, but leave for future expansion

	def get_installed(self):
		"""list installed items"""
		if not self.destination_dir:
			raise Exception("Internal Error: Mediawiki_Installer: get_installed, self.destination_dir not set")
		return os.listdir(self.destination_dir)

	def is_installed(self, installer_name):
		return installer_name in self.get_installed()

	# super.get_info does something sane here, let's leave it in. 
	# (we can even provide info files for certain releases if we want)

	def install(self, installer_name=None, as_alias=None):

		if self.tag:
			installer_name=self.tag

		if self.revision:
			installer_name="latest"

		if not installer_name:
			installer_name=self.instance

		if not installer_name:
			raise Mediawiki_Installer_Exception("Please specify which mediawiki tag or revision you would like to view")

		name=as_alias or self.as_alias or installer_name
		
		if not installer_util.db_works():
			raise Installer_Exception("Cannot access database. (Is your settings.py correct?)")

		install(installer_name, name, self.revision, self.language)
		return self.is_installed(name)

	#download is unused, but leave for future expansion
	#install_settings unused
	#uninstall_settings

	def uninstall(self,installer_name):
		name=self.as_alias or installer_name
		if not self.is_installed(name):
			print name+" does not appear to be installed"
			return
		if not installer_util.db_works():
			raise Installer_Exception("Cannot access database. (Is your settings.py correct?)")

		uninstall(name)
		return not self.is_installed(name) 
	
	def get_revisions(self,installer=None):
		"""Get list of available revisions.
		This list is cached in ram at first call to this function.
                installer parameter is ignored (inherited from Installation_System)
                """


		global revision_cache
		if revision_cache:
			print "Using cached mediawiki revision list."
		else:
			print "Getting list of mediawiki revisions... One moment (takes 10-20 seconds)"
			sys.stdout.flush()
			revision_cache=self._get_revisions_generic("phase3")
	
		return revision_cache

	def get_svnbase(self):
		return settings.trunkdir


	def duplicate(self, src, dst):
		"""Duplicate an existing instance. 
		src is the instance to duplicate
		dst is the name to copy to.  
		"""
		if not installer_util.db_works():
			raise Installer_Exception("Cannot access database. (Is your settings.py correct?)")

		if not self.is_installed(src):
			raise Mediawiki_Installer_Exception(src+" not found.")

		if self.is_installed(dst):
			raise Mediawiki_Installer_Exception(dst+" already exists.")

		srcpath= os.path.join(settings.instancesdir,src)
		dstpath= os.path.join(settings.instancesdir,dst)
		dbtmp=os.path.join(dstpath,"installerdbtmp.sql")
		print "Copying instance files..."
		shutil.copytree(srcpath,dstpath,symlinks=True)
		print "updating unique settings and adminsettings"
		uniquesettings(dst, self.language)
		adminsettings(dst)
		print "Copying instance database..."
		dumpdb(src,dbtmp)
		dropdb(dst)
		createdb(dst)
		do_sql(dst,dbtmp)
		print "cleanup"
		os.unlink(dbtmp)
		print "done."
		
	def maintenance_update(self):
		"""run maintenance/update.php to deal with any installed extensions""" 
		if not self.instancedir():
			raise Mediawiki_Installer_Exception("setup_update:Internal Error: Could not determine instancedir")

		update_script=os.path.join(self.instancedir(),"maintenance","update.php")

		if not os.path.exists(update_script):
			raise Mediawiki_Installer_Exception("setup_update:While installing, could not find update.php at: "+command)

		command=settings.phpcommand+" "+update_script
		rv=os.system(command)>>8
		if rv:
			raise Mediawiki_Installer_Exception("setup_update:While installing, I tried to run the instance's maintenance/update.php, but some issue occurred.")



#TODO: use this method everywhere a database name is requested
# REFACTOR: dbname now in installation_system.py 
def dbname(installer_name):
	"""based on the name of the installer/instance, figure out what the name of the
	database is. Right now we just use the name of the installer as the name of the database,
	but that might not always work."""
	return settings.dbname_prefix+installer_name


#duplicate of get_installed() TODO: Refactor
def installed():
	"""list installed items"""
	return os.listdir(settings.instancesdir)

#duplicate of get_installers() TODO: Refactor
def available():
	"""list available items"""

	l=list(os.popen('svn ls '+settings.tagsdir))
	stripped=[line.strip() for line in l]
	for item in filter_available:
		if item in stripped:
			stripped.remove(item)
	return stripped



def install(target, option_as, revision, language=None):
	"""implement install command. Installs a mediawiki version"""
	target=clean_target(target)
	
	latest=False
	if target=="latest":
		latest=True
	
	if option_as:
		name=clean_target(option_as)
	else:
		name=target

	if name in installed():
		print name+" already installed."
		return
	
	# available targets all end in '/', very consistent, this :-P
	if not latest and target+'/' not in available():
		print target+" is not available or invalid.\n(try:  ls available  )"
		return

	#Everything checks out ok, so let's install.
	os.chdir(settings.instancesdir)
	print "Checking out code from subversion (please be patient)..."
	if latest:
		checkout_latest(name, revision)
	else:
		checkout(target+"/", name, revision)

	print "Copying LocalSettings.php,creating unique settings, db-admin settings"
	localsettings(name)
	uniquesettings(name,language)
	adminsettings(name)
	print "Copy logo..."
	logo(name)
	print "Setting up database..."
	makedb(name)
	if settings.run_automated_tests:
		print "Storing comparison data for check_isolation"
		difftests(name)
	print "Done."


def uninstall(target):
	"""implements uninstall command: uninstall mediawiki version"""

	target=clean_target(target)
	
	if target not in installed():
		print target+": can't find an installed revision by that name"
		return
	
	#Ok, looks like our arguments are valid.
	os.chdir(settings.instancesdir)
	print "Dropping database..."
	dropdb(target)
	print "Deleting directory..."
	delete(target)
	print "Done."

def checkout(target, name, revision):
	"""checkout the given target revision"""

	command="svn checkout "
	if revision:
		command+="-r"+str(revision)+" "
	command+=settings.tagsdir+"/"+target+"phase3"
	_checkout(command,name)

def checkout_latest(name, revision):
	"""checkout the latest trunk revision"""

	command="svn checkout "
	if revision:
		command+="-r"+str(revision)+" "
	command+=settings.trunkdir+"/phase3"
	_checkout(command,name)

def _checkout(command, name):
	"""perform the actual check out, and rename our checked out data to something more useful"""

	rv=os.system(command)>>8
	if rv:
		raise Installer_Exception("Download failed")
	os.rename('phase3',name)


def localsettings(target):
	"""Copy over our LocalSettings.php , and create InstallerUniqueSettings.php
	(which contains settings unique to this instance), and create LocalSettings dir.
	LocalSettings.php is the main configuration file for mediawiki."""

	here=settings.installerdir+"/LocalSettings.php"
	instancedir=settings.instancesdir+"/"+target
	there=instancedir+"/LocalSettings.php"
	shutil.copy2(here,there)
	subdir=os.path.join(settings.instancesdir,target,"LocalSettings")
	os.mkdir(subdir)
	
def uniquesettings(target,language=None):
	"""Set up settings that are unique to one particular wiki (in the file InstallerUniqueSettings.php)"""
	uniquesettings=settings.instancesdir+"/"+target+"/InstallerUniqueSettings.php"
	unique=file(uniquesettings,"w")
	unique.write('<?php\n')
	unique.write('$wgSitename = "'+target+'";\n')
	unique.write('$wgScriptPath = "'+settings.base_scriptpath+target+'";\n')
	unique.write('$wgDBname = "'+dbname(target)+'";\n')
	unique.write('$wgDBserver = "'+settings.mysql_server+'";\n')
	unique.write('$wgDBuser = "'+settings.mysql_user+'";\n')
	unique.write('$wgDBpassword = "'+settings.mysql_pass+'";\n')

	use_language=language or settings.wgLanguageCode
	unique.write('$wgLanguageCode = "'+use_language+'";\n');

	unique.write('?>\n')
	
	unique.close()

def adminsettings(target):
	"""Set up settings that are unique to one particular wiki (in the file InstallerUniqueSettings.php)"""
	adminsettings=settings.instancesdir+"/"+target+"/AdminSettings.php"
	admin=file(adminsettings,"w")
	admin.write('<?php\n')
	admin.write('$wgDBadminuser = "'+settings.mysql_user+'";\n')
	admin.write('$wgDBadminpassword = "'+settings.mysql_pass+'";\n')
	admin.write('$wgEnableProfileInfo = false;\n')
	admin.write('?>\n')
	
	admin.close()
	

def logo(target):
	"""copy a nice logo"""

	logo=settings.installerdir+"/Logo.png"
	dest=settings.instancesdir+"/"+target+"/Logo.png"
	shutil.copy(logo,dest)

def makedb(target):
	"""make a mediawiki database for target mediawiki instance """

	dropdb(target);
	createdb(target);
	make_tables(target)
	make_admin(target)	

def make_tables(target):
	"""use the maintenance/tables.sql file provided by target mediawiki
	instance to generate our tables"""

	target_file=settings.instancesdir+"/"+target+"/maintenance/tables.sql"
	do_sql(target, target_file)

def make_admin(target):
	"""create an admin user using createAndPromote.php"""
	#do_sql(target, settings.installerdir+"/user.sql")
	phpfile=os.path.join(settings.instancesdir,target,"maintenance","createAndPromote.php")
	command="php "+phpfile+" --bureaucrat "+settings.adminuser_name+" "+settings.adminuser_password
	rv=os.system(command)>>8
	if rv:
		raise Installer_Exception("Failed to create admin user on "+target)

def dumpdb(target,outfile):
	command=settings.mysqldump_command+" "+dbname(target)+" > "+outfile
	rv=os.system(command)>>8
	if rv:
		raise Installer_Exception("Failed to dump database"+dbname(target))

def do_sql(target, infile):
	"""execute an sql file, using mysql"""

	command="< "+infile+" "+settings.mysql_command+" "+dbname(target)
	rv=os.system(command)>>8
	if rv:
		raise Installer_Exception("Could not execute  sql file "+infile+" for database "+dbname(target))

def createdb(target):
	"""create a database using mysql"""

	command="echo 'CREATE DATABASE "+dbname(target)+";' | "+settings.mysql_command
	rv=os.system(command)>>8
	if rv:
		raise Installer_Exception("Could not create database "+dbname(target))

def dropdb(target):
	"""drop a database using mysql"""

	command="echo 'DROP DATABASE IF EXISTS "+dbname(target)+";' | "+settings.mysql_command
	rv=os.system(command)>>8
	if rv:
		raise Installer_Exception("Could not drop database "+dbname(target))

def delete(target):
	"""delete target mediawiki installation, assumes we are in the revisions directory"""
	shutil.rmtree(target)


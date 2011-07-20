<?php
if ( php_sapi_name() !== 'cli' ) {
	exit; // sanity, script run via CLI
}

error_reporting( E_ALL );

/**
 * Automatically SVN checkout a MediaWiki version and do some basic wmf setup.
 * LocalSettings.php will be created (which loads CommonSettings.php) and verious
 * symlinks will also be created.
 *
 * The first argument is the SVN directory (relative to mediawiki/branches/wmf).
 * This is typically a version of the format "X.XXwmfX" ("e.g. 1.17wmf1").
 * The second argument is the target path (relative to /home/wikipedia/common/)
 * to store local copy of the SVN checkout. This is typically of the format "php-X.XX".
 *
 * The script will not run if files already existing in the target directory.
 * Also, assume the user running this script must have an SVN account
 * with the SSH agent/key available.
 *
 * @return void
 */
function checkoutMediaWiki() {
	global $argv;
	$commonDir = '/home/wikipedia/common';

	$argsValid = false;
	if ( count( $argv ) >= 3 ) {
		$svnVersion = $argv[1]; // e.g. "X.XXwmfX"
		$dstVersion = $argv[2]; // e.g. "php-X.XX"
		if ( preg_match( '/^php-(\d+\.\d+|trunk)$/', $dstVersion, $m ) ) {
			$dstVersionNum = $m[1];
			$argsValid = true;
		}
	}

	if ( !$argsValid ) {
		die( "Usage: checkoutMediaWiki.php X.XXwmfX php-X.XX" );
	}

	# The url to SVN to checkout from
	$source = "svn+ssh://svn.wikimedia.org/svnroot/mediawiki/branches/wmf/$svnVersion";

	# Create the destination path to SVN checkout to...
	$destIP = "$commonDir/$dstVersion";
	if ( file_exists( $destIP ) ) {
		die( "Cannot checkout, the directory $destIP already exists.\n" );
	}
	print "Creating checkout directory $destIP...";
	mkdir( $destIP, 0775 );
	print "done.\n";

	print "Checking out $source to $destIP...\n";
	# Checkout the SVN directory...
	$retval = 1; // error by default?
	passthru( "svn checkout $source $destIP", $retval );
	if ( $retval !== 0 ) {
		rmdir( $destIP ); // rollback
		die( "\nUnable to checkout SVN path." );
	}
	print "...SVN checkout done.\n";

	$localSettingsCode = <<<EOT
<?php
# WARNING: This file is publically viewable on the web. Do not put private data here.
if ( defined('TESTWIKI') ) {
	include_once( "/home/wikipedia/common/wmf-config/CommonSettings.php" );
} else {
	include_once( "/apache/common/wmf-config/CommonSettings.php" );
}
EOT;

	# Create LocalSettings.php stub...
	$path = "$destIP/LocalSettings.php";
	if ( !file_exists( $path ) ) {
		$handle = fopen( $path, "w" );
		if ( $handle ) {
			fwrite( $handle, $localSettingsCode );
			fclose( $handle );
			print "Created LocalSettings.php file.\n";
		}
	} else {
		print "File already exists: $path\n";
	}

	# Create symlink to wmf-config/AdminSettings.php...
	$path = "$destIP/AdminSettings.php";
	if ( !file_exists( $path ) ) {
		if ( symlink( "../wmf-config/AdminSettings.php", $path ) ) {
			print "Created AdminSettings.php symlink.\n";
		}
	} else {
		print "File already exists: $path\n";
	}

	# Create symlink to wmf-config/StartProfiler.php...
	$path = "$destIP/StartProfiler.php";
	if ( !file_exists( $path ) ) {
		if ( symlink( "../wmf-config/StartProfiler.php", $path ) ) {
			print "Created StartProfiler.php symlink.\n";
		}
	} else {
		print "File already exists: $path\n";
	}

	# Create bits.wikimedia.org symlinks...
	$path = "$commonDir/docroot/bits/skins-$dstVersionNum";
	if ( !file_exists( $path ) ) {
		if ( symlink( "/usr/local/apache/common/php-$dstVersionNum/skins/", $path ) ) {
			print "Created skins-$dstVersionNum symlink.\n";
		}
	} else {
		print "File already exists: $path\n";
	}
	$path = "$commonDir/docroot/bits/w/extensions-$dstVersionNum";
	if ( !file_exists( $path ) ) {
		if ( symlink( "/usr/local/apache/common/php-$dstVersionNum/extensions", $path ) ) {
			print "Created w/extensions-$dstVersionNum symlink.\n";
		}
	} else {
		print "File already exists: $path\n";
	}

	print "MediaWiki $dstVersionNum, from $svnVersion, successfully checked out.\n";
}

checkoutMediaWiki();

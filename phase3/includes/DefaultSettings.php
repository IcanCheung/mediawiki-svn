<?php
# DO NOT EDIT THIS FILE!
# To customize your installation, edit "LocalSettings.php".
# Note that since all these string interpolations are expanded
# before LocalSettings is included, if you localize something
# like $wgScriptPath, you must also localize everything that
# depends on it.

# Disable reporting of 'notices'. 1.3.x should run clean with it on,
# but 1.2.x relies on traditional behavior and doesn't appreciate
# the output being replaced with a screenfull of paranoid _notices_
# that our code is sloppy. We know it's sloppy.
error_reporting( E_ALL & ~E_NOTICE );

$wgVersion			= "1.2.5";

$wgSitename         = "MediaWiki"; # Please customize!
$wgMetaNamespace    = FALSE; # will be same as you set $wgSitename

$wgServer           = "http://" . $_SERVER["SERVER_NAME"];
if( $_SERVER["SERVER_PORT"] != 80 ) $wgServer .= ":" . $_SERVER["SERVER_PORT"];

$wgScriptPath	    = "/wiki";

# ATTN: Old installations used wiki.phtml and redirect.phtml -
# make sure that LocalSettings.php is correctly set!
$wgScript           = "{$wgScriptPath}/index.php";
$wgRedirectScript   = "{$wgScriptPath}/redirect.php";

# Whether to support URLs like index.php/Page_title
$wgUsePathInfo		= ( strpos( php_sapi_name(), "cgi" ) === false );

$wgStyleSheetPath   = "{$wgScriptPath}/style";
$wgStyleSheetDirectory = "{$IP}/style";
$wgArticlePath      = "{$wgScript}?title=$1";
$wgUploadPath       = "{$wgScriptPath}/upload";
$wgUploadDirectory	= "{$IP}/upload";
$wgLogo				= "{$wgUploadPath}/wiki.png";
$wgMathPath         = "{$wgUploadPath}/math";
$wgMathDirectory    = "{$wgUploadDirectory}/math";
$wgTmpDirectory     = "{$wgUploadDirectory}/tmp";
$wgStockPath        = false; # For stock images that come with MediaWiki
                             # Set to false for $wgStockPath=$wgUploadPath
$wgEmergencyContact = "wikiadmin@" . getenv( "SERVER_NAME" );
$wgPasswordSender	= "Wikipedia Mail <apache@" . getenv( "SERVER_NAME" ) . ">";

# For using a direct (authenticated) SMTP server connection.
# "host" => 'SMTP domain', "IDHost" => 'domain for MessageID', "port" => "25", "auth" => true/false, "username" => user, "password" => password
$wgSMTP				= false;

# MySQL settings
#
$wgDBserver         = "localhost";
$wgDBname           = "wikidb";
$wgDBconnection     = "";
$wgDBuser           = "wikiuser";
$wgDBpassword       = "userpass";
$wgDBminWordLen     = 4;
$wgDBtransactions	= false; # Set to true if using InnoDB tables
$wgDBmysql4			= false; # Set to true to use enhanced fulltext search

# Sysop SQL queries
$wgAllowSysopQueries = false; # Dangerous if not configured properly.
$wgDBsqluser		= "sqluser";
$wgDBsqlpassword	= "sqlpass";
$wgSqlTimeout		= 30;
$wgSqlLogFile           = "{$wgUploadDirectory}/sqllog_mFhyRe6";

# Database load balancer
$wgDBservers		= false; # e.g. array("larousse", "pliny")
$wgDBloads			= false; # e.g. array(0.6, 0.4);


# memcached settings
# See docs/memcached.doc
#
$wgMemCachedDebug   = false; # Will be set to false in Setup.php, if the server isn't working
$wgUseMemCached     = false;
$wgMemCachedServers = array( "127.0.0.1:11000" );
$wgMemCachedDebug   = false;
$wgSessionsInMemcached = false;
$wgLinkCacheMemcached = false; # Not fully tested

# Language settings
#
$wgLanguageCode     = "en";
$wgInterwikiMagic	= true; # Treat language links as magic connectors, not inline links
$wgInputEncoding	= "ISO-8859-1";
$wgOutputEncoding	= "ISO-8859-1";
$wgEditEncoding		= "";
$wgDocType          = "-//W3C//DTD HTML 4.01 Transitional//EN";
$wgDTD              = "http://www.w3.org/TR/html4/loose.dtd";
$wgUseDynamicDates  = false; # Enable to allow rewriting dates in page text
							 # DOES NOT FORMAT CORRECTLY FOR MOST LANGUAGES
$wgAmericanDates    = false; # Enable for English module to print dates
							 # as eg 'May 12' instead of '12 May'
$wgLocalInterwiki   = "w";
$wgShowIPinHeader	= true; # For non-logged in users
$wgMaxNameChars     = 32; # Maximum number of bytes in username

# Translation using MediaWiki: namespace
# This will increase load times by 25-60% unless memcached is installed
$wgUseDatabaseMessages = true;
$wgMsgCacheExpiry	= 86400;

$wgExtraSubtitle	= "";
$wgSiteSupportPage	= "";

# Miscellaneous configuration settings
#
$wgReadOnlyFile         = "{$wgUploadDirectory}/lock_yBgMBwiR";

# The debug log file should be not be publically accessible if it is
# used, as it may contain private data.
$wgDebugLogFile         = "";

$wgDebugComments        = false;
$wgReadOnly             = false;
$wgLogQueries           = false;
$wgUseCategoryMagic		= false;
$wgEnablePersistentLC	= false;	# Persistent link cache in linkscc table; FAILS on MySQL 3.x
$wgCompressedPersistentLC = true; # use gzcompressed blobs

$wgEnableParserCache = false; # requires that php was compiled --with-zlib

# wgHitcounterUpdateFreq sets how often page counters should be
# updated, higher values are easier on the database. A value of 1
# causes the counters to be updated on every hit, any higher value n
# cause them to update *on average* every n hits. Should be set to
# either 1 or something largish, eg 1000, for maximum efficiency.

$wgHitcounterUpdateFreq = 1;

# User rights 
$wgWhitelistEdit = false;   # true = user must login to edit.
$wgWhitelistRead = false;   # Pages anonymous user may see, like: =array ( ":Main_Page", "Special:Userlogin", "Wikipedia:Help");
$wgWhitelistAccount = array ( "user" => 1, "sysop" => 1, "developer" => 1 );

$wgSysopUserBans        = false; # Allow sysops to ban logged-in users
$wgSysopRangeBans		= false; # Allow sysops to ban IP ranges
$wgDefaultBlockExpiry	= "24 hours"; # default expiry time
                                # strtotime format, or "infinite" for an infinite block
$wgAutoblockExpiry		= 86400; # Number of seconds before autoblock entries expire

# Client-side caching:
$wgCachePages       = true; # Allow client-side caching of pages

# Set this to current time to invalidate all prior cached pages.
# Affects both client- and server-side caching.
$wgCacheEpoch = "20030516000000";

# Server-side caching:
#  This will cache static pages for non-logged-in users
#  to reduce database traffic on public sites.
#  Must set $wgShowIPinHeader = false
$wgUseFileCache = false;
$wgFileCacheDirectory = "{$wgUploadDirectory}/cache";

$wgCookieExpiration = 2592000;

# Squid-related settings
#
# Enable/disable Squid
 $wgUseSquid = false;
# If you run Squid3 with ESI support, enable this (default:false):
 $wgUseESI = false;
# Internal server name as known to Squid, if different
# $wgInternalServer = 'http://yourinternal.tld:8000';
 $wgInternalServer = $wgServer;
# Cache timeout for the squid, will be sent as s-maxage (without ESI) or 
# Surrogate-Control (with ESI). Without ESI, you should strip out s-maxage in the Squid config.
# 18000 seconds = 5 hours, more cache hits with 2678400 = 31 days
 $wgSquidMaxage = 18000;
# A list of proxy servers (ips if possible) to purge on changes
# don't specify ports here (80 is default)
# $wgSquidServers = array('127.0.0.1');

# Set to set an explicit domain on the login cookies
# eg, "justthis.domain.org" or ".any.subdomain.net"
$wgCookieDomain = "";
$wgCookiePath = "/";
$wgDisableCookieCheck = false;

$wgAllowExternalImages = true;
$wgMiserMode = false; # Disable database-intensive features
$wgDisableQueryPages = false; # Disable all query pages if miser mode is on, not just some
$wgUseWatchlistCache = false; # Generate a watchlist once every hour or so
$wgWLCacheTimeout = 3600;	# The hour or so mentioned above

# To use inline TeX, you need to compile 'texvc' (in the 'math' subdirectory
# of the MediaWiki package and have latex, dvips, gs (ghostscript), and
# convert (ImageMagick) installed and available in the PATH.
# Please see math/README for more information.
$wgUseTeX = false;
$wgTexvc = "./math/texvc"; # Location of the texvc binary

# Profiling / debugging
$wgProfiling = false; # Enable for more detailed by-function times in debug log
$wgProfileLimit = 0.0; # Only record profiling info for pages that took longer than this
$wgProfileOnly = false; # Don't put non-profiling info into log file
$wgProfileToDatabase = false; # Log sums from profiling into "profiling" table in db.
$wgProfileSampleRate = 1; # Only profile every n requests when profiling is turned on
$wgDebugProfiling = false; # Detects non-matching wfProfileIn/wfProfileOut calls
$wgDebugFunctionEntry = 0; # Output debug message on every wfProfileIn/wfProfileOut

$wgDisableCounters = false;
$wgDisableTextSearch = false;
$wgDisableFuzzySearch = false;
$wgDisableSearchUpdate = false; # If you've disabled search semi-permanently, this also disables updates to the table. If you ever re-enable, be sure to rebuild the search table.
$wgDisableUploads = true; # Uploads have to be specially set up to be secure
$wgRemoteUploads = false; # Set to true to enable the upload _link_ while local uploads are disabled. Assumes that the special page link will be bounced to another server where uploads do work.
$wgDisableAnonTalk = false;

# We can serve pages compressed in order to save bandwidth,
# but this will increase CPU usage.
# Requires zlib support enabled in PHP.
$wgUseGzip = function_exists( "gzencode" );

# We can also compress text in the old revisions table. If this is set on,
# old revisions will be compressed on page save if zlib support is available.
# Any compressed revisions will be decompressed on load regardless of this
# setting *but will not be readable at all* if zlib support is not available.
$wgCompressRevisions = false;

# This is the list of preferred extensions for uploading files. Uploading
# files with extensions not in this list will trigger a warning.

$wgFileExtensions = array( "png", "jpg", "jpeg", "ogg" );

# Files with these extensions will never be allowed as uploads.
$wgFileBlacklist = array(
	# HTML may contain cookie-stealing JavaScript and web bugs
	"html", "htm",
	# PHP scripts may execute arbitrary code on the server
	"php", "phtml", "php3", "php4", "phps",
	# Other types that may be interpreted by some servers
	"shtml", "jhtml", "pl", "py",
	# May contain harmful executables for Windows victims
	"exe", "scr", "dll", "msi", "vbs", "bat", "com", "pif", "cmd", "vxd", "cpl" );

# This is a flag to determine whether or not to check file extensions on
# upload.
$wgCheckFileExtensions = true;

# If this is turned off, users may override the warning for files not
# covered by $wgFileExtensions.
$wgStrictFileExtensions = true;

## Set $wgUseImageResize to true if you want to enable dynamic
## server side image resizing ("Thumbnails")
# 
$wgUseImageResize		= false;

## Resizing can be done using PHP's internal image libraries
## or using ImageMagick. The later supports more file formats
## than PHP, which only supports PNG, GIF, JPG, XBM and WBMP.
##
## Set $wgUseImageMagick to true to use Image Magick instead
## of the builtin functions
#
$wgUseImageMagick		= false;
$wgImageMagickConvertCommand    = "/usr/bin/convert";

$wgPasswordSalt = true; # For compatibility with old installations set to false

# Which namespaces should support subpages?
# See Language.php for a list of namespaces.
#
$wgNamespacesWithSubpages = array( -1 => 0, 0 => 0, 1 => 1,
  2 => 1, 3 => 1, 4 => 0, 5 => 1, 6 => 0, 7 => 1 );

$wgNamespacesToBeSearchedDefault = array( -1 => 0, 0 => 1, 1 => 0,
  2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0 );

# If set, a bold ugly notice will show up at the top of every page.
$wgSiteNotice = "";

# Whether to allow anonymous users to set changes to 'minor'
$wgAllowAnonymousMinor = false;

$wgBlockOpenProxies = false; # Automatic open proxy test on edit
$wgProxyPorts = array( 80, 81, 1080, 3128, 8080 );
$wgProxyScriptPath = "$IP/proxy_check.php";
$wgProxyMemcExpiry = 86400;

# Set this to false to avoid forcing the first letter of links
# to capitals. WARNING: may break links! This makes links
# COMPLETELY case-sensitive. Links appearing with a capital at
# the beginning of a sentence will *not* go to the same place
# as links in the middle of a sentence using a lowercase initial.
$wgCapitalLinks = true;

?>

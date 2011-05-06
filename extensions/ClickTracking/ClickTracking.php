<?php
/**
 * Usability Initiative Click Tracking extension
 *
 * @file
 * @ingroup Extensions
 *
 * @author Nimish Gautam <ngautam@wikimedia.org>
 * @author Trevor Parscal <tparscal@wikimedia.org>
 * @license GPL v2 or later
 * @version 0.1.1
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is not a valid entry point to MediaWiki.' );
}

/* Configuration */

// Click tracking throttle, should be seen as "1 out of every $wgClickTrackThrottle users will have it enabled"
// Setting this to 1 means all users will have it enabled, setting to a negative number will disable it for all users
$wgClickTrackThrottle = -1;

// Set the time window for what we consider 'recent' contributions, in days
$wgClickTrackContribGranularity1 = 60 * 60 * 24 * 365 / 2; // 6 months
$wgClickTrackContribGranularity2 = 60 * 60 * 24 * 365 / 4; // 3 months
$wgClickTrackContribGranularity3 = 60 * 60 * 24 * 30; // 1 month

/* Setup */

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'Click Tracking',
	'author' => array( 'Nimish Gautam', 'Trevor Parscal' ),
	'version' => '0.1.1',
	'descriptionmsg' => 'clicktracking-desc',
	'url' => 'http://www.mediawiki.org/wiki/Extension:UsabilityInitiative'
);

$dir = dirname( __FILE__ ) . '/';
// Autoload classes
$wgAutoloadClasses['ClickTrackingHooks'] = $dir . 'ClickTracking.hooks.php';
$wgAutoloadClasses['ApiClickTracking'] = $dir . 'ApiClickTracking.php';
$wgAutoloadClasses['SpecialClickTracking'] = $dir . 'SpecialClickTracking.php';
$wgAutoloadClasses['ApiSpecialClickTracking'] = $dir . 'ApiSpecialClickTracking.php';

// Hooked functions
$wgHooks['LoadExtensionSchemaUpdates'][] = 'ClickTrackingHooks::loadExtensionSchemaUpdates';
$wgHooks['BeforePageDisplay'][] = 'ClickTrackingHooks::beforePageDisplay';
$wgHooks['MakeGlobalVariablesScript'][] = 'ClickTrackingHooks::makeGlobalVariablesScript';
$wgHooks['ParserTestTables'][] = 'ClickTrackingHooks::parserTestTables';

$wgHooks['EditPage::showEditForm:fields'][] = 'ClickTrackingHooks::editPageShowEditFormFields';
$wgHooks['ArticleSave'][] = 'ClickTrackingHooks::articleSave';
$wgHooks['ArticleSaveComplete'][] = 'ClickTrackingHooks::articleSaveComplete';

// API modules
$wgAPIModules['clicktracking'] = 'ApiClickTracking';
$wgAPIModules['specialclicktracking'] = 'ApiSpecialClickTracking';

// New special page
$wgSpecialPages['ClickTracking'] = 'SpecialClickTracking';

// New user right, required to use Special:ClickTracking
$wgAvailableRights[] = 'clicktrack';
$wgGroupPermissions['sysop']['clicktrack'] = true;

// i18n
$wgExtensionMessagesFiles['ClickTracking'] = $dir . 'ClickTracking.i18n.php';
$wgExtensionAliasesFiles['ClickTracking'] = $dir . 'ClickTracking.alias.php';

// Resource modules
$ctResourceTemplate = array(
	'localBasePath' => $dir . 'modules',
	'remoteExtPath' => 'ClickTracking/modules',
);
$wgResourceModules['jquery.clickTracking'] = array(
	'scripts' => 'jquery.clickTracking.js',
	'dependencies' => 'jquery.cookie',
) + $ctResourceTemplate;
$wgResourceModules['ext.clickTracking'] = array(
	'scripts' => 'ext.clickTracking.js',
	'dependencies' => 'jquery.clickTracking',
) + $ctResourceTemplate;
$wgResourceModules['ext.clickTracking.special'] = array(
	'scripts' => 'ext.clickTracking.special.js',
	'styles' => 'ext.clickTracking.special.css',
	'dependencies' => array( 'jquery.json', 'jquery.ui.datepicker', 'jquery.ui.dialog' ),
) + $ctResourceTemplate;
$wgResourceModules['ext.UserBuckets'] = array(
	'scripts' => 'ext.UserBuckets.js',
	'dependencies' => array('jquery.clickTracking', 'jquery.json', 'jquery.cookie'),
) + $ctResourceTemplate;

//uncomment for sample campaign
//ClickTrackingHooks::addCampaign($dir. 'modules', 'ClickTracking/modules', 'sampleCampaign' );


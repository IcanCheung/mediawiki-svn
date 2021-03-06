<?php
/**
 * MoodBar extension
 * Allows specified users to send their "mood" back to the site operator.
 */

$wgExtensionCredits['other'][] = array(
	'author' => array( 'Andrew Garrett', 'Timo Tijhof' ),
	'descriptionmsg' => 'moodbar-desc',
	'name' => 'MoodBar',
	'url' => 'http://www.mediawiki.org/wiki/MoodBar',
	'version' => '0.1',
	'path' => __FILE__,
);

// Object model
$wgAutoloadClasses['MBFeedbackItem'] = dirname(__FILE__).'/FeedbackItem.php';
$wgAutoloadClasses['MBFeedbackResponseItem'] = dirname(__FILE__).'/FeedbackResponseItem.php';
$wgAutoloadClasses['MoodBarFormatter'] = dirname(__FILE__).'/Formatter.php';
$wgAutoloadClasses['MoodBarHTMLEmailNotification'] = dirname(__FILE__).'/include/MoodBarHTMLEmailNotification.php';
$wgAutoloadClasses['MoodBarHTMLMailerJob'] = dirname( __FILE__ ) . '/include/MoodBarHTMLMailerJob.php';

// API
$wgAutoloadClasses['ApiMoodBar'] = dirname(__FILE__).'/ApiMoodBar.php';
$wgAPIModules['moodbar'] = 'ApiMoodBar';
$wgAutoloadClasses['ApiQueryMoodBarComments'] = dirname( __FILE__ ). '/ApiQueryMoodBarComments.php';
$wgAPIListModules['moodbarcomments'] = 'ApiQueryMoodBarComments';
$wgAutoloadClasses['ApiFeedbackDashboard'] = dirname(__FILE__).'/ApiFeedbackDashboard.php';
$wgAPIModules['feedbackdashboard'] = 'ApiFeedbackDashboard';
$wgAutoloadClasses['ApiFeedbackDashboardResponse'] = dirname(__FILE__).'/ApiFeedbackDashboardResponse.php';
$wgAPIModules['feedbackdashboardresponse'] = 'ApiFeedbackDashboardResponse';
$wgAutoloadClasses['ApiMoodBarSetUserEmail'] = dirname(__FILE__).'/ApiMoodBarSetUserEmail.php';
$wgAPIModules['moodbarsetuseremail'] = 'ApiMoodBarSetUserEmail';

// Hooks
$wgAutoloadClasses['MoodBarHooks'] = dirname(__FILE__).'/MoodBar.hooks.php';
$wgHooks['BeforePageDisplay'][] = 'MoodBarHooks::onPageDisplay';
$wgHooks['ResourceLoaderGetConfigVars'][] = 'MoodBarHooks::resourceLoaderGetConfigVars';
$wgHooks['MakeGlobalVariablesScript'][] = 'MoodBarHooks::makeGlobalVariablesScript';
$wgHooks['LoadExtensionSchemaUpdates'][] = 'MoodBarHooks::onLoadExtensionSchemaUpdates';

// Special pages
$wgAutoloadClasses['SpecialMoodBar'] = dirname(__FILE__).'/SpecialMoodBar.php';
$wgSpecialPages['MoodBar'] = 'SpecialMoodBar';
$wgAutoloadClasses['SpecialFeedbackDashboard'] = dirname( __FILE__ ) . '/SpecialFeedbackDashboard.php';
$wgSpecialPages['FeedbackDashboard'] = 'SpecialFeedbackDashboard';

$dashboardFormsPath = dirname(__FILE__) . '/DashboardForms.php';
$wgAutoloadClasses['MBDashboardForm'] = $dashboardFormsPath;
$wgAutoloadClasses['MBActionForm'] = $dashboardFormsPath;
$wgAutoloadClasses['MBHideForm'] = $dashboardFormsPath;
$wgAutoloadClasses['MBRestoreForm'] = $dashboardFormsPath;

$wgLogTypes[] = 'moodbar';
$wgLogNames['moodbar'] = 'moodbar-log-name';
$wgLogHeaders['moodbar'] = 'moodbar-log-header';
$wgLogActions += array(
	'moodbar/hide' => 'moodbar-log-hide',
	'moodbar/restore' => 'moodbar-log-restore',
);

// Jobs
$wgJobClasses['MoodBarHTMLMailerJob'] = 'MoodBarHTMLMailerJob';

// User rights
$wgAvailableRights[] = 'moodbar-view';
$wgAvailableRights[] = 'moodbar-admin';

$wgGroupPermissions['sysop']['moodbar-admin'] = true;

// Internationalisation
$wgExtensionMessagesFiles['MoodBar'] = dirname(__FILE__).'/MoodBar.i18n.php';
$wgExtensionMessagesFiles['MoodBarAliases'] = dirname( __FILE__ ) . '/MoodBar.alias.php';

// Resources
$mbResourceTemplate = array(
	'localBasePath' => dirname(__FILE__) . '/modules',
	'remoteExtPath' => 'MoodBar/modules'
);

$wgResourceModules['ext.moodBar.init'] = $mbResourceTemplate + array(
	'styles' => 'ext.moodBar/ext.moodBar.init.css',
	'scripts' => 'ext.moodBar/ext.moodBar.init.js',
	'messages' => array(
		'moodbar-trigger-feedback',
		'moodbar-trigger-share',
		'moodbar-trigger-editing',
		'tooltip-p-moodbar-trigger-feedback',
		'tooltip-p-moodbar-trigger-share',
		'tooltip-p-moodbar-trigger-editing',
	),
	'position' => 'bottom',
	'dependencies' => array(
		'jquery.cookie',
		'jquery.client',
		'mediawiki.util'
	),
);

$wgResourceModules['ext.moodBar.tooltip'] = $mbResourceTemplate + array(
	'styles' => 'ext.moodBar/ext.moodBar.tooltip.css',
	'scripts' => 'ext.moodBar/ext.moodBar.tooltip.js',
	'messages' => array(
		 'moodbar-tooltip-title',
	),
	'position' => 'bottom',
	'dependencies' => array(
		'jquery.cookie',
		'ext.moodBar.init',
	),
);

$oldVersion = version_compare( $wgVersion, '1.17', '<=' );

if ( !$oldVersion ) {
	$wgResourceModules['ext.moodBar.init']['dependencies'][] = 'mediawiki.user';
}


$wgResourceModules['jquery.NobleCount'] = $mbResourceTemplate + array(
	'scripts' => 'jquery.NobleCount/jquery.NobleCount.js',
);

$wgResourceModules['ext.moodBar.core'] = $mbResourceTemplate + array(
	'styles' => 'ext.moodBar/ext.moodBar.core.css',
	'scripts' => 'ext.moodBar/ext.moodBar.core.js',
	'messages' => array(
		'moodbar-close',
		'moodbar-intro-feedback',
		'moodbar-intro-share',
		'moodbar-intro-editing',
		'moodbar-type-happy-title',
		'moodbar-type-sad-title',
		'moodbar-type-confused-title',
		'tooltip-moodbar-what',
		'moodbar-what-target',
		'moodbar-what-label',
		'moodbar-what-expanded',
		'moodbar-what-collapsed',
		'moodbar-what-content',
		'moodbar-what-link',
		'moodbar-form-title',
		'moodbar-form-note',
		'moodbar-form-note-dynamic',
		'moodbar-form-policy-text',
		'moodbar-form-policy-label',
		'moodbar-form-submit',
		'moodbar-privacy',
		'moodbar-privacy-link',
		'moodbar-privacy-link-title',
		'moodbar-disable-link',
		'moodbar-loading-title',
		'moodbar-error-title',
		'moodbar-success-title',
		'moodbar-loading-subtitle',
		'moodbar-error-subtitle',
		'moodbar-success-subtitle',
		'moodbar-blocked-title',
		'moodbar-blocked-subtitle',
		'moodbar-email-title',
		'moodbar-email-input',
		'moodbar-email-desc',
		'moodbar-email-submit',
		'moodbar-updating-title',
		'moodbar-updating-subtitle',
		'moodbar-email-confirm-title',
		'moodbar-email-confirm-desc',
		'moodbar-email-resend-confirmation',
		'moodbar-email-optout',
	),
	'dependencies' => array(
		'mediawiki.util',
		'ext.moodBar.init', // just in case
		'jquery.localize',
		'jquery.NobleCount',
		'jquery.moodBar',
	),
	'position' => 'bottom',
);

$wgResourceModules['ext.moodBar.dashboard'] = $mbResourceTemplate + array(
	'scripts' => 'ext.moodBar.dashboard/ext.moodBar.dashboard.js',
	'dependencies' => array(
		'mediawiki.util',
		'jquery.NobleCount',
		'jquery.elastic'
	),
	'messages' => array(
		'moodbar-feedback-nomore',
		'moodbar-feedback-noresults',
		'moodbar-feedback-ajaxerror',
		'moodbar-feedback-action-error',
		'moodbar-action-reason',
		'moodbar-action-reason-required',
		'moodbar-feedback-action-confirm',
		'moodbar-feedback-action-cancel',
		'moodbar-respond-text',
		'moodbar-respond-collapsed',
		'moodbar-respond-expanded',
		'moodbar-response-add',
		'moodbar-response-desc',
		'moodbar-response-btn',
		'moodbar-form-note-dynamic',
		'moodbar-response-url',
		'moodbar-response-link',
		'moodbar-response-terms',
		'feedbackresponse-success',
		'response-back-text',
		'response-preview-text',
		'response-preview-text',
		'response-ajax-action-head', 
		'response-ajax-action-body',
		'response-ajax-success-head',
		'response-ajax-success-body',
		'response-ajax-error-head', 
		'response-ajax-error-body',
	),
);

$wgResourceModules['ext.moodBar.dashboard.styles'] = $mbResourceTemplate + array(
	'styles' => 'ext.moodBar.dashboard/ext.moodBar.dashboard.css',
);

$wgResourceModules['jquery.moodBar'] = $mbResourceTemplate + array(
	'scripts' => 'jquery.moodBar/jquery.moodBar.js',
	'dependencies' => array(
		'mediawiki.util',
	),
);

$wgResourceModules['jquery.elastic'] = $mbResourceTemplate + array(
	'scripts' => 'jquery.elastic/jquery.elastic.js'
);

/** Configuration **/
/** The registration time after which users will be shown the MoodBar **/
$wgMoodBarCutoffTime = null;

/** MoodBar configuration settings **/
$wgMoodBarConfig = array(
	'bucketConfig' =>
		array(
			'buckets' =>
				array(
					'feedback' => 100,
					'share' => 0, //disabled
					'editing' => 0, //disabled
				),
			'version' => 3,
			'expires' => 30,
		),
	'infoUrl' => 'http://www.mediawiki.org/wiki/MoodBar',
	'privacyUrl' => 'about:blank',
	'disableExpiration' => 365,
);
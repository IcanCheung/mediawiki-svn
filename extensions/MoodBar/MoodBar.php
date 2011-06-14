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

// API
$wgAutoloadClasses['ApiMoodBar'] = dirname(__FILE__).'/ApiMoodBar.php';
$wgAPIModules['moodbar'] = 'ApiMoodBar';

// Internationalisation
$wgExtensionMessagesFiles = dirname(__FILE__).'/Messages.php';

// Resources
$mbResourceTemplate = array(
	'localBasePath' => dirname(__FILE__),
	'remoteExtPath' => 'MoodBar'
);

$wgResourceModules['ext.moodBar'] = $mbResourceTemplate + array(
	'styles' => array(  ),
	'scripts' => array(  ),
	'dependencies' => array(  ),
	'messages' => array( ),
);

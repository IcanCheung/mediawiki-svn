<?php
/**
 * Usability Initiative NavigableTOC extension
 *
 * @file
 * @ingroup Extensions
 *
 * This file contains the include file for the NavigableTOC portion of the
 * UsabilityInitiative extension of MediaWiki.
 *
 * Usage: This file is included automatically by ../UsabilityInitiative.php
 *
 * @author Roan Kattouw <roan.kattouw@gmail.com>
 * @license GPL v2 or later
 * @version 0.1.1
 */

/* Configuration */

// Bump the version number every time you change any of the .css/.js files
$wgNavigableTOCStyleVersion = 0;

/* Setup */

// Credits
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'NavigableTOC',
	'author' => 'Roan Kattouw',
	'version' => '0.1.1',
	'url' => 'http://www.mediawiki.org/wiki/Extension:UsabilityInitiative',
	'descriptionmsg' => 'navigabletoc-desc',
);

// Adds Autoload Classes
$wgAutoloadClasses['NavigableTOCHooks'] =
	dirname( __FILE__ ) . '/NavigableTOC.hooks.php';

// Adds Internationalized Messages
$wgExtensionMessagesFiles['NavigableTOC'] =
	dirname( __FILE__ ) . '/NavigableTOC.i18n.php';

// Registers Hooks
$wgHooks['EditPage::showEditForm:initial'][] = 'NavigableTOCHooks::addTOC';

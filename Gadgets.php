<?php
/**
 * Gadgets extension - lets users select custom javascript gadgets
 *
 *
 * For more info see http://mediawiki.org/wiki/Extension:Gadgets
 *
 * @file
 * @ingroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2007 Daniel Kinzler
 * @license GNU General Public Licence 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

if ( version_compare( $wgVersion, '1.17alpha', '<' ) ) {
	die( "This version of Extension:Gadgets requires MediaWiki 1.17+\n" );
}

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'Gadgets',
	'author' => 'Daniel Kinzler',
	'url' => 'http://mediawiki.org/wiki/Extension:Gadgets',
	'descriptionmsg' => 'gadgets-desc',
);

$wgHooks['ArticleSaveComplete'][]           = 'Gadgets::articleSaveComplete';
$wgHooks['BeforePageDisplay'][]             = 'Gadgets::beforePageDisplay';
$wgHooks['GetPreferences'][]                = 'Gadgets::getPreferences';
$wgHooks['ResourceLoaderRegisterModules'][] = 'Gadgets::registerModules';

$dir = dirname(__FILE__) . '/';
$wgExtensionMessagesFiles['Gadgets'] = $dir . 'Gadgets.i18n.php';
$wgExtensionAliasesFiles['Gadgets'] = $dir . 'Gadgets.alias.php';

$wgAutoloadClasses['Gadget'] = $dir . 'Gadgets_body.php';
$wgAutoloadClasses['Gadgets'] = $dir . 'Gadgets_body.php';
$wgAutoloadClasses['GadgetsResourceLoaderModule'] = $dir . 'Gadgets_body.php';
$wgAutoloadClasses['SpecialGadgets'] = $dir . 'SpecialGadgets.php';

$wgSpecialPages['Gadgets'] = 'SpecialGadgets';
$wgSpecialPageGroups['Gadgets'] = 'wiki';

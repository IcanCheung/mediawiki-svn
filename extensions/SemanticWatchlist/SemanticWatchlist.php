<?php

/**
 * Initialization file for the Semantic Watchlist extension.
 * 
 * Documentation:	 		http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * Support					http://www.mediawiki.org/wiki/Extension_talk:Semantic_Watchlist
 * Source code:             http://svn.wikimedia.org/viewvc/mediawiki/trunk/extensions/SemanticWatchlist
 *
 * @file SemanticWatchlist.php
 * @ingroup SemanticWatchlist
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

/**
 * This documenation group collects source code files belonging to Semantic Watchlist.
 *
 * @defgroup SemanticWatchlist Semantic Watchlist
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( version_compare( $wgVersion, '1.17', '<' ) ) {
	die( 'Semantic Watchlist requires MediaWiki 1.17 or above.' );
}

define( 'SemanticWatchlist_VERSION', '0.1 alpha' );

$wgExtensionCredits[defined( 'SEMANTIC_EXTENSION_TYPE' ) ? 'semantic' : 'other'][] = array(
	'path' => __FILE__,
	'name' => 'Semantic Watchlist',
	'version' => SemanticWatchlist_VERSION,
	'author' => array(
		'[http://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw] for WikiWorks',
	),
	'url' => 'http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist',
	'descriptionmsg' => 'semanticwatchlist-desc'
);

$egSWLScriptPath = $wgExtensionAssetsPath === false ? $wgScriptPath . '/extensions/SemanticWatchlist' : $wgExtensionAssetsPath . '/SemanticWatchlist';

$wgExtensionMessagesFiles['SemanticWatchlist'] = dirname( __FILE__ ) . '/SemanticWatchlist.i18n.php';

/*$moduleTemplate = array(
	'localBasePath' => dirname( __FILE__ ),
	'remoteBasePath' => $egSWLScriptPath
);

$wgResourceModules['ext.swl'] = $moduleTemplate + array(
	'scripts' => 'ext.swl.js',
	'dependencies' => array(),
	'messages' => array()
);*/

require_once 'SemanticWatchlist.settings.php';

$wgAutoloadClasses['SWLHooks'] = dirname( __FILE__ ) . '/SemanticWatchlist.hooks.php';

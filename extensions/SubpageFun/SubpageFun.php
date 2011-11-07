<?php

/**
 * 'Subpage Fun' is a MediaWiki extension which defines some new parser functions to get
 * advanced information about subpages.
 *
 * Documentation: http://www.mediawiki.org/wiki/Extension:Subpage_Fun
 * Support:       http://www.mediawiki.org/wiki/Extension_talk:Subpage_Fun
 * Source code:   http://svn.wikimedia.org/viewvc/mediawiki/trunk/extensions/SubpageFun
 * 
 * @version: 0.5
 * @license: ISC license
 * @author:  Daniel Werner < danweetz@web.de >
 *
 * @file SubpageFun.php
 * @ingroup SubpageFun
 */

if ( ! defined( 'MEDIAWIKI' ) ) { die( ); }


/**** extension info ****/ 
 
$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'Subpage Fun',
	'descriptionmsg' => 'subpagefun-desc',
	'version'        => ExtSubpageFun::VERSION,
	'author'         => '[http://www.mediawiki.org/wiki/User:Danwe Daniel Werner]',
	'url'            => 'http://www.mediawiki.org/wiki/Extension:Subpage_Fun',
);

// language files:
$wgExtensionMessagesFiles['SubpageFun'     ] = ExtSubpageFun::getDir() . '/SubpageFun.i18n.php';
$wgExtensionMessagesFiles['SubpageFunMagic'] = ExtSubpageFun::getDir() . '/SubpageFun.i18n.magic.php';

// Load member classes:
$wgAutoloadClasses['SubpageInfo'] = ExtSubpageFun::getDir() . '/SFun_SubpageInfo.php';

// Register magic words:
$wgHooks['ParserFirstCallInit'         ][] = 'ExtSubpageFun::init';
//$wgHooks['LanguageGetMagic'            ][] = 'ExtSubpageFun::onLanguageGetMagic';

// register plain variables:
$wgHooks['MagicWordwgVariableIDs'      ][] = 'ExtSubpageFun::onMagicWordwgVariableIDs';
$wgHooks['ParserGetVariableValueSwitch'][] = 'ExtSubpageFun::onParserGetVariableValueSwitch';


class ExtSubpageFun {

	const VERSION = '0.5';

	const MAG_SUBPAGETITLE     = 'subpagetitle';
	const MAG_SUBPAGES         = 'subpages';
	const MAG_PARENTPAGES      = 'parentpages';
	const MAG_SIBLINGPAGES     = 'siblingpages';
	const MAG_SUBPAGELEVEL     = 'subpagelevel';
	const MAG_NUMBEROFSUBPAGES = 'numberofsubpages';
	const MAG_TOPLEVELPAGE     = 'toplevelpage';
	
	static function init( &$parser ) {
		// optional SFH_NO_HASH to omit the hash '#' from function names
		$parser->setFunctionHook( self::MAG_SUBPAGETITLE,     array( __CLASS__, 'subpagetitle'),     SFH_NO_HASH );
		$parser->setFunctionHook( self::MAG_SUBPAGES,         array( __CLASS__, 'subpages'),         SFH_NO_HASH );
		$parser->setFunctionHook( self::MAG_PARENTPAGES,      array( __CLASS__, 'parentpages'),      SFH_NO_HASH );
		$parser->setFunctionHook( self::MAG_SIBLINGPAGES,     array( __CLASS__, 'siblingpages'),     SFH_NO_HASH );
		$parser->setFunctionHook( self::MAG_SUBPAGELEVEL,     array( __CLASS__, 'subpagelevel'),     SFH_NO_HASH );
		$parser->setFunctionHook( self::MAG_NUMBEROFSUBPAGES, array( __CLASS__, 'numberofsubpages'), SFH_NO_HASH );
		$parser->setFunctionHook( self::MAG_TOPLEVELPAGE,     array( __CLASS__, 'toplevelpage'),     SFH_NO_HASH );
		
		return true;
	}
	
	/**
	 * Returns the extensions base installation directory.
	 *
	 * @since 0.5
	 * 
	 * @return boolean
	 */
	public static function getDir() {		
		static $dir = null;
		
		if( $dir === null ) {
			$dir = dirname( __FILE__ );
		}
		return $dir;
	}
	
	/*** private helper functions: ***/
	
	/**
	 * Helper function for seperating n arguments of a MW parser function
	 * @return Array
	 */
	private static function getFunctionArgsArray( $args )
	{
		# Populate $argv with both named and numeric parameters
		$argv = array();
		$numargs = 0;
		
		foreach ($args as $arg) if( ! is_object( $arg ) )
		{
			if( preg_match( '/^([^\\n\\r]+?)\\s*=\\s*(.*)$/s', $arg, $match ) ) { // s - include newline. Parameter name is not supposed to have linebreaks
				$argv[ trim( $match[1] ) ] = trim( $match[2] );
			} else {
				$numargs++;
				$argv[ $numargs ] = trim( $arg );
			}
		}
		return $argv;
	}
	
	/**
	 * Helper to get a new title from user input. Returns null if invalid title is given.
	 * 
	 * @param Parser $parser
	 * @param string $title
	 * 
	 * @return Title|null
	 */
	private static function newTitleObject ( Parser &$parser, $title = null ) {	
		if( $title !== null && $title !== '' ) {
			return Title::newFromText( $title );
		}
		//returns object of current page if nothing else is requested:
		return $parser->getTitle();
	}

	/**
	 * Create a list with page titles as final output of a SubpageFun function.
	 * The output ist un-parsed wiki markup, no HTML.
	 * 
	 * @param $pages Array the pages
	 * @param $link Boolean whether or not to link the pages in the list
	 * @param $sep String glue between the pages
	 * 
	 * @return String
	 */
	private static function createSiteList( $pages, $link = false, $sep = ', ' ) {		
		//if( $pages === null )
		//	return '';
		$out = array();
		foreach( $pages as $page ) {
			if( $link ) {
				$out[] = '[[:' . $page->getPrefixedText() . ']]';
			} else {
				$out[] = $page->getPrefixedText();
			}
		}
		return implode( $sep, $out );
	}
	
	/**
	 * Filters a list of title elements by a word or a regular expression.
	 * The titles name without prefix is taken for comparision.
	 * 
	 * @param array $list
	 * @param string $filter
	 * @return array 
	 */
	private static function filterSiteList( array $list, $filter = null ) {
		// return all if no filter set:
		if( $filter === null ) {
			return $list;
		}
        if ( ! self::isValidRegEx( $filter ) ) {
			// no regex given, create one returning everything having the $filter words in it
			$filters = explode( '|', $filter );			
			foreach( $filters as &$part ) {
				$part = preg_quote( trim( $part ), '/' );
			}
			$filter = '/^.*(?:' . implode( '|', $filters ) . ').*$/i';
		}
		
		// create new array from all matches:
		$newList = array();
		
		foreach( $list as $t ) {
			if ( preg_match( $filter, $t->getText() ) ) {
				$newList[] = $t;
			}
        }
		return $newList;
	}
	
	/**
	 * Decides for the given $pattern whether its a valid regular expression acceptable for
	 * the 'filter' parameter or not.
	 * 
	 * @param string $pattern regular expression including delimiters and optional flags
	 * 
	 * @return boolean
	 */
	private static function isValidRegEx( $pattern ) {
		// validate first for allowd delimiters '/%|' and flags
		if( ! preg_match( '/^([\\/\\|%]).*\\1[imsSuUx]*$/', $pattern ) ) {
			return false;
		}
		wfSuppressWarnings(); // instead of using the evil @ operator!
		$isValid = false !== preg_match( $pattern, ' ' ); // preg_match returns false on error
		wfRestoreWarnings();
		return $isValid;
	}
	
	/**
	 * Function to validate the paraameter depth required by some functions
	 * returns null if no value or invalid value is given, an integer if
	 * a number, including negative value, is given
	 * 
	 * @param $depth Mixed
	 * @return Mixed null or integer
	 */
	private static function valDepth( $depth ) {
		if( $depth === null || $depth === false || trim( $depth ) === '' ) {
			return null;
		}
		// if it is '0'
		if( $depth == 0 ) {
			return 0;
		}
		// if it is a number:
		if( $depth < 0 || (string)(int)$depth === $depth ) {
			return $depth;
		}
		// invalid value like text:
		else
			return null;			
	}
	
	
	/*** 'Subpage Fun' parser functions: ***/

	static function subpagetitle( &$parser, $title = null ) {
		$t = self::newTitleObject( $parser, $title );
		if( $t === null ) {
			return ''; // invalid title given
		}
		return SubpageInfo::getSubpageTitle( $t );
	}
	
	static function subpages( &$parser ) {
		// get all possible arguments:
		$args = ExtSubpageFun::getFunctionArgsArray( func_get_args() );

		$title  = isset( $args[1] )        ? $args[1]        : null;
		$linked = isset( $args['linked'] ) ? true            : false;
		$sep    = isset( $args['sep'] )    ? $args['sep']    : ', ';
		$filter = isset( $args['filter'] ) ? $args['filter'] : null;
		$depth  = isset( $args['depth'] )  ? self::valDepth( $args['depth'] ) : null;		
		
		// function logic:
		$t = self::newTitleObject( $parser, $title );
		if( $t === null ) {
			return ''; // invalid title given
		}
		
		// get subpages:
		$subpages = SubpageInfo::getSubpages( $t, $depth );
		
		// filter by filter criterion:
		$subpages = self::filterSiteList( $subpages, $filter );
		
		return self::createSiteList( $subpages, $linked, $sep );
	}
	
	static function parentpages( &$parser ) {
		// get all possible arguments:
		$args = ExtSubpageFun::getFunctionArgsArray( func_get_args() );

		$title  = isset( $args[1] )        ? $args[1]        : null;
		$linked = isset( $args['linked'] ) ? true            : false;
		$sep    = isset( $args['sep'] )    ? $args['sep']    : ', ';
		$filter = isset( $args['filter'] ) ? $args['filter'] : null;
		$depth  = isset( $args['depth'] )  ? self::valDepth( $args['depth'] ) : null;
		
		// function logic:
		$t = self::newTitleObject( $parser, $title );
		if( $t === null ) {
			return ''; // invalid title given
		}
		
		// get parent pages:
		$parentpages = SubpageInfo::getAncestorPages( $t, $depth );
		
		// filter by filter criterion:
		$parentpages = self::filterSiteList( $parentpages, $filter );
		
		return self::createSiteList( $parentpages, $linked, $sep );
	}	
	
	static function siblingpages( &$parser ) {
		//get all possible arguments:
		$args = ExtSubpageFun::getFunctionArgsArray( func_get_args() );

		$title  = isset( $args[1] )        ? $args[1]        : null;
		$linked = isset( $args['linked'] ) ? true            : false;
		$sep    = isset( $args['sep'] )    ? $args['sep']    : ', ';
		$filter = isset( $args['filter'] ) ? $args['filter'] : null;
	
		//function logic:
		$t = self::newTitleObject( $parser, $title );
		if( $t === null ) {
			return ''; // invalid title given
		}
		
		// get siblings:
		$siblingpages = SubpageInfo::getSiblingPages( $t );
		
		// filter by filter criterion:
		$siblingpages = self::filterSiteList( $siblingpages, $filter );

		return self::createSiteList( $siblingpages, $linked, $sep );
	}	
	
	static function subpagelevel( &$parser, $title = null) {		
		$t = self::newTitleObject( $parser, $title );
		if( $t === null ) {
			return ''; // invalid title given
		}
		return SubpageInfo::getSubpageLevel( $t );
	}	
	
	static function numberofsubpages( &$parser ) {		
		//get all possible arguments:
		$args = ExtSubpageFun::getFunctionArgsArray( func_get_args() );

		$title = isset($args[1]) ? $args[1] : null;
		$depth = isset( $args['depth'] ) ? self::valDepth( $args['depth'] ) : null;
		
		//function logic:
		$t = self::newTitleObject( $parser, $title );
		if( $t === null ) {
			return ''; // invalid title given
		}
		
		$subpages = SubpageInfo::getSubpages( $t, $depth );
		return count( $subpages );
	}	
	
	static function toplevelpage( &$parser, $title = null) {		
		$t = self::newTitleObject( $parser, $title );
		if( $t === null ) {
			return ''; // invalid title given
		}
		
		//get all parents because the toplevel is the highest existing parent:
		$parentpages = SubpageInfo::getAncestorPages( $t );
		
		if( ! empty( $parentpages ) )
			return $parentpages[0]->getPrefixedText();
		else //no parent! The page itself is the top level:
			return $t->getPrefixedText();
	}
	
	
	/**** All the SubpageFunctions for use with MW Variables on the current page ****/
	
	static function onParserGetVariableValueSwitch( &$parser, &$cache, &$magicWordId, &$ret ) {
		switch( $magicWordId ) {
			/** SUBPAGETITLE **/
			case self::MAG_SUBPAGETITLE:
				$ret = self::subpagetitle( $parser );
				break;
			/** SUBPAGES **/
			case self::MAG_SUBPAGES:
				$ret = self::subpages( $parser );
				break;
			/** PARENTPAGES **/
			case self::MAG_PARENTPAGES:
				$ret = self::parentpages( $parser );
				break;
			/** SIBLINGPAGES **/
			case self::MAG_SIBLINGPAGES:
				$ret = self::siblingpages( $parser );
				break;
			/** SUBPAGELEVEL **/
			case self::MAG_SUBPAGELEVEL:
				$ret = self::subpagelevel( $parser );
				break;
			/** NUMBEROFSUBPAGES **/
			case self::MAG_NUMBEROFSUBPAGES:
				$ret = self::numberofsubpages( $parser );
				break;
			/** TOPLEVELPAGE **/
			case self::MAG_TOPLEVELPAGE:
				$ret = self::toplevelpage( $parser );
				break;
		}
		return true;
	}
	
	static function onMagicWordwgVariableIDs( &$customVariableIds ) {
		// register variable ids:
		$customVariableIds[] = self::MAG_SUBPAGETITLE;
		$customVariableIds[] = self::MAG_SUBPAGES;
		$customVariableIds[] = self::MAG_PARENTPAGES;
		$customVariableIds[] = self::MAG_SIBLINGPAGES;
		$customVariableIds[] = self::MAG_SUBPAGELEVEL;
		$customVariableIds[] = self::MAG_NUMBEROFSUBPAGES;
		$customVariableIds[] = self::MAG_TOPLEVELPAGE;
		
		return true;
	}
	
}

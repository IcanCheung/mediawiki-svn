<?php
/**
 * Main class of the WikimediaIncubator extension.
 * Implement test wiki preference, magic word and prefix check on edit page,
 * and contains general functions for other classes.
 *
 * @file
 * @ingroup Extensions
 * @author Robin Pepermans (SPQRobin)
 */

class IncubatorTest {

	/**
	 * Add preferences
	 * @return True
	 */
	static function onGetPreferences( $user, &$preferences ) {
		global $wmincPref, $wmincProjects, $wmincProjectSite,
			$wmincLangCodeLength, $wgDefaultUserOptions;

		$preferences['language']['help-message'] = 'wminc-prefinfo-language';

		$prefinsert[$wmincPref . '-project'] = array(
			'type' => 'select',
			'options' =>
				array( wfMsg( 'wminc-testwiki-none' ) => 'none' ) +
				array_flip( $wmincProjects ) +
				array( $wmincProjectSite['name'] => $wmincProjectSite['short'] ),
			'section' => 'personal/i18n',
			'label-message' => 'wminc-testwiki',
			'id' => $wmincPref . '-project',
			'help-message' => 'wminc-prefinfo-project',
		);
		$prefinsert[$wmincPref . '-code'] = array(
			'type' => 'text',
			'section' => 'personal/i18n',
			'label-message' => 'wminc-testwiki',
			'id' => $wmincPref . '-code',
			'maxlength' => (int)$wmincLangCodeLength,
			'size' => (int)$wmincLangCodeLength,
			'help-message' => 'wminc-prefinfo-code',
			'validation-callback' => array( 'IncubatorTest', 'validateCodePreference' ),
		);

		$wgDefaultUserOptions[$wmincPref . '-project'] = 'none';

		$preferences = wfArrayInsertAfter( $preferences, $prefinsert, 'language' );

		return true;
	}

	/**
	 * For the preferences above
	 * @return String or true
	 */
	static function validateCodePreference( $input, $alldata ) {
		global $wmincPref, $wmincProjects;
		# If the user selected a project that NEEDS a language code,
		# but the user DID NOT enter a language code, give an error
		if ( isset( $alldata[$wmincPref.'-project'] ) &&
			array_key_exists( $alldata[$wmincPref.'-project'], $wmincProjects ) &&
			!$input ) {
			return Xml::element( 'span', array( 'class' => 'error' ),
				wfMsg( 'wminc-prefinfo-error' ) );
		} else {
			return true;
		}
	}

	/**
	 * This validates a given language code.
	 * Only "xx[x]" and "xx[x]-x[xxxxxxxx]" are allowed.
	 * @return Boolean
	 */
	static function validateLanguageCode( $code ) {
		global $wmincLangCodeLength;
		if( strlen( $code ) > $wmincLangCodeLength ) { return false; }
		if( $code == 'be-x-old' ) {
			return true; # one exception... waiting to be renamed to be-tarask
		}
		return (bool) preg_match( '/^[a-z][a-z][a-z]?(-[a-z]+)?$/', $code );
	}

	/**
	 * This validates a full prefix in a given title.
	 * Do not include namespaces!
	 * It gives an array with the project and language code, containing
	 * the key 'error' if it is invalid.
	 * Use validatePrefix() if you just want true or false.
	 * Use displayPrefixedTitle() to make a prefix page title!
	 *
	 * @param $title String The given title (often $wgTitle->getText() )
	 * @param $onlyInfoPage Bool Whether to validate only the prefix, or
	 * also allow other text within the page title (Wx/xxx vs Wx/xxx/Text)
	 * @return Array with 'error' or 'project', 'lang', 'prefix' and
	 *					optionally 'realtitle'
	 */
	static function analyzePrefix( $title, $onlyInfoPage = false ) {
		$data = array( 'error' => null );
		# split title into parts
		$titleparts = explode( '/', $title );
		if( !is_array( $titleparts ) || !isset( $titleparts[1] ) ) {
			$data['error'] = 'noslash';
		} else {
			$data['project'] = ( isset( $titleparts[0][1] ) ? $titleparts[0][1] : '' ); # get the x from Wx/...
			$data['lang'] = $titleparts[1]; # language code
			$data['prefix'] = 'W'.$data['project'].'/'.$data['lang'];
			# check language code
			if( !self::validateLanguageCode( $data['lang'] ) ) {
				$data['error'] = 'invalidlangcode';
			}
		}
		global $wmincProjects;
		$listProjects =	implode( '', array_keys( $wmincProjects ) ); # something like: pbtqn
		if( !preg_match( '/^W['.$listProjects.']\/[a-z-]+' .
			($onlyInfoPage ? '$/' : '(\/.+)?$/' ), $title ) ) {
			$data['error'] = 'invalidprefix';
		}
		if( !$onlyInfoPage && $data['error'] != 'invalidprefix' ) { # there is a Page_title
			$prefixn = strlen( $data['prefix'].'/' ); # number of chars in prefix
			# get Page_title from Wx/xx/Page_title
			$data['realtitle'] = substr( $title, $prefixn );
		}
		return $data; # return an array with information
	}

	/**
	 * This returns simply true or false based on analyzePrefix().
	 * @return Boolean
	 */
	static function validatePrefix( $title, $onlyprefix = false ) {
		$data = self::analyzePrefix( $title, $onlyprefix );
		if( !$data['error'] ) { return true; }
		return false;
	}


	/**
	 * Get &testwiki=wx/xx and validate that prefix.
	 * Returns the array of analyzePrefix() on success.
	 * @return Array or false
	 */
	static function getUrlParam() {
		global $wgRequest;
		$urlParam = $wgRequest->getVal( 'testwiki' );
		if( !$urlParam ) {
			return false;
		}
		$val = self::analyzePrefix( ucfirst( $urlParam ), true );
		if( $val['error'] || !isset( $val['project'] ) || !isset( $val['lang'] )
			|| !$val['project'] || !$val['lang'] ) {
			return false;
		}
		$val['prefix'] = strtolower( $val['prefix'] );
		return $val;
	}

	/**
	 * Whether the given project (or preference by default) is one of the
	 * projects using the format Wx/xxx (as defined in $wmincProjects)
	 * @param $project the project code
	 * @return Boolean
	 */
	static function isContentProject( $project = '' ) {
		global $wgUser, $wmincPref, $wmincProjects;
		$url = self::getUrlParam();
		if( $project ) {
			$r = $project; # Precedence to given value
		} elseif( $url ) {
			$r = $url['project']; # Otherwise URL &testwiki= if set
		} else {
			$r = $wgUser->getOption( $wmincPref . '-project' ); # Defaults to preference
		}
		return (bool) array_key_exists( $r, $wmincProjects );
	}

	/**
	 * display the prefix by the given project and code
	 * (or the URL &testwiki= or user preference if no parameters are given)
	 * @return String
	 */
	static function displayPrefix( $project = '', $code = '', $allowSister = false ) {
		global $wmincSisterProjects;
		if( $project && $code ) {
			$projectvalue = $project;
			$codevalue = $code;
		} else {
			global $wgUser, $wmincPref;
			$url = self::getUrlParam();
			$projectvalue = ( $url ? $url['project'] : $wgUser->getOption($wmincPref . '-project') );
			$codevalue = ( $url ? $url['lang'] : $wgUser->getOption($wmincPref . '-code') );
		}
		$sister = (bool)( $allowSister && isset( $wmincSisterProjects[$projectvalue] ) );
		if ( self::isContentProject( $projectvalue ) || $sister ) {
			// if parameters are set OR it falls back to user pref and
			// he has a content project pref set  -> return the prefix
			return 'W' . $projectvalue . '/' . $codevalue; // return the prefix
		} else {
			// fall back to user pref with NO content pref set
			// -> still provide the value (probably 'none' or 'inc')
			return $projectvalue;
		}
	}

	/**
	 * Makes a full prefixed title of a given page title and namespace
	 * @param $ns Int numeric value of namespace
	 * @return object Title
	 */
	static function displayPrefixedTitle( $title, $ns = 0 ) {
		global $wgLang, $wmincTestWikiNamespaces;
		if( in_array( $ns, $wmincTestWikiNamespaces ) ) {
			/* Standard namespace as defined by
			* $wmincTestWikiNamespaces, so use format:
			* TITLE + NS => NS:Wx/xxx/TITLE
			*/
			$title = Title::makeTitleSafe( $ns, self::displayPrefix() . '/' . $title );
		} else {
			/* Non-standard namespace, so use format:
			* TITLE + NS => Wx/xxx/NS:TITLE
			* (with localized namespace name)
			*/
			$title = Title::makeTitleSafe( NULL, self::displayPrefix() . '/' .
				$wgLang->getNsText( $ns ) . ':' . $title );
		}
		return $title;
	}

	static function magicWordVariable( &$magicWords ) {
		$magicWords[] = 'usertestwiki';
		return true;
	}

	static function magicWord( &$magicWords, $langCode ) {
		$magicWords['usertestwiki'] = array( 0, 'USERTESTWIKI' );
		return true;
	}

	static function magicWordValue( &$parser, &$cache, &$magicWordId, &$ret ) {
		if( !self::displayPrefix() ) {
			$ret = 'none';
		} else {
			$ret = self::displayPrefix();
		}
		return true;
	}

	/**
	 * Whether we should show an error message that the page is unprefixed
	 * @param $title Title object
	 * @return Boolean
	 */
	static function shouldWeShowUnprefixedError( $title ) {
		global $wmincTestWikiNamespaces, $wmincProjectSite;
		$prefixdata = self::analyzePrefix( $title->getText() );
		$ns = $title->getNamespace();
		if( !$prefixdata['error'] ) {
			# no error in prefix -> no error to show
			return false;
		} elseif( self::displayPrefix() == $wmincProjectSite['short'] ) {
			# If user has "project" (Incubator) as test wiki preference, it isn't needed to check
			return false;
		} elseif( !in_array( $ns, $wmincTestWikiNamespaces ) ) {
			# OK if it's not in one of the content namespaces
			return false;
		} elseif( ( $ns == NS_CATEGORY || $ns == NS_CATEGORY_TALK ) &&
			preg_match( '/^(' . implode( '|', $wmincPseudoCategoryNSes ) .'):.+$/', $title->getText() ) ) {
			# whitelisted unprefixed categories
			return false;
		}
		return true;
	}

	/**
	 * This does several things:
	 * Disables editing pages belonging to existing wikis (+ shows message)
	 * Disables creating an unprefixed page (+ shows error message)
	 * See also: IncubatorTest::onShowMissingArticle()
	 * @return Boolean
	 */
	static function onGetUserPermissionsErrors( $title, $user, $action, &$result ) {
		$titletext = $title->getText();
		$prefixdata = self::analyzePrefix( $titletext );

		if( self::getDBState( $prefixdata ) == 'existing' ) {
			if( $prefixdata['prefix'] == $titletext &&
				( $title->exists() || $user->isAllowed( 'editinterface' ) ) ) {
				# if it's an info page, allow if the page exists or the user has 'editinterface' right
				return true;
			}
			# no permission if the wiki already exists
			$link = self::getSubdomain( $prefixdata['lang'],
				$prefixdata['project'], ( $title->getNsText() ? $title->getNsText() . ':' : '' ) .
				preg_replace( '/ /', '_', $prefixdata['realtitle'] ) );
			$result[] = array( 'wminc-error-wiki-exists', $link );
			return false;
		}

		if( !self::shouldWeShowUnprefixedError( $title ) || $action != 'create' ) {
			# only check if needed & if on page creation
			return true;
		} elseif( $prefixdata['error'] == 'invalidlangcode' ) {
			$error[] = array( 'wminc-error-wronglangcode', $prefixdata['lang'] );
		} elseif ( self::isContentProject() ) {
			# If the user has a test wiki pref, suggest a page title with prefix
			$suggesttitle = isset( $prefixdata['realtitle'] ) ?
				$prefixdata['realtitle'] : $titletext;
			$suggest = self::displayPrefixedTitle( $suggesttitle, $title->getNamespace() );
			# Suggest to create a prefixed page
			$error[] = array( 'wminc-error-unprefixed-suggest', $suggest );
		} else {
			$error = 'wminc-error-unprefixed';
		}
		$result = $error;
		return false;
	}

	/**
	 * Return an error if the user wants to move
	 * an existing page to an unprefixed title
	 * @return Boolean
	 */
	static function checkPrefixMovePermissions( $oldtitle, $newtitle, $user, &$error ) {
		if( self::shouldWeShowUnprefixedError( $newtitle ) ) {
			# there should be an error with the new page title
			$error = wfMsgWikiHtml( 'wminc-error-move-unprefixed' );
			return false;
		}
		return true;
	}

	/**
	 * Add a link to Special:ViewUserLang from Special:Contributions/USERNAME
	 * if the user has 'viewuserlang' permission
	 * Based on code from extension LookupUser made by Tim Starling
	 * @return True
	 */
	static function efLoadViewUserLangLink( $id, $nt, &$links ) {
		global $wgUser;
		if ( $wgUser->isAllowed( 'viewuserlang' ) ) {
			$user = $nt->getText();
			$links[] = $wgUser->getSkin()->link(
				SpecialPage::getTitleFor( 'ViewUserLang', $user ),
				wfMsgHtml( 'wminc-viewuserlang' )
			);
		}
		return true;
	}

	/**
	 * This loads language names. Also from CLDR if that extension is found.
	 * @return Array with language names or empty array
	 */
	static public function getLanguageNames( $code = '' ) {
		if ( is_callable( array( 'LanguageNames', 'getNames' ) ) ) {
			global $wgLang;
			$langcode = ( $code ? $code : $wgLang->getCode() );
			return LanguageNames::getNames( $langcode,
				LanguageNames::FALLBACK_NORMAL,
				LanguageNames::LIST_MW_AND_CLDR
			);
		}
		return Language::getLanguageNames( false );
	}

	/**
	 * Do we know the databases of the existing wikis?
	 * @return Boolean
	 */
	static function canWeCheckDB() {
		global $wmincExistingWikis, $wmincProjectDatabases;
		if( !is_array( $wmincProjectDatabases ) || !is_array( $wmincExistingWikis ) ) {
			return false; # We don't know the databases
		}
		return true; # Should work now
	}
	
	/**
	 * Given an incubator testwiki prefix, get the database name of the
	 * corresponding wiki, whether it exists or not
	 * @param $prefix Array from IncubatorTest::analyzePrefix();
	 * @return false or string
	 */
	static function getDB( $prefix ) {
		if( !self::canWeCheckDB() ) {
			return false;
		} elseif( !isset( $prefix ) || $prefix['error'] ) {
			return false; # shouldn't be, but you never know
		}
		global $wmincProjectDatabases;
		return preg_replace('/-/', '_', $prefix['lang'] ) .
			$wmincProjectDatabases[$prefix['project']];
	}

	/**
	 * @return false or array with closed databases
	 */
	static function getDBClosedWikis() {
		global $wmincClosedWikis;
		if( !self::canWeCheckDB() ) {
			return false;
		}
		# Is probably a file, but it might be that an array is given
		return is_array( $wmincClosedWikis ) ? $wmincClosedWikis :
			array_map( 'trim', file( $wmincClosedWikis ) );
	}

	/**
	 * @param $prefix Array from IncubatorTest::analyzePrefix();
	 * @return false or string 'existing' 'closed' 'missing'
	 */
	static function getDBState( $prefix ) {
		$db = self::getDB( $prefix );
		if( !$db ) {
			return false;
		}
		global $wmincExistingWikis, $wmincClosedWikis;
		if( !in_array( $db, $wmincExistingWikis ) ) {
			return 'missing'; # not in the list
		} elseif( in_array( $db, self::getDBClosedWikis() ) ) {
			return 'closed'; # in the list of closed wikis
		}
		return 'existing';
	}

	/**
	 * If existing wiki: show message or redirect if &testwiki is set to that
	 * Missing article on Wx/xx info pages: show welcome page
	 * See also: IncubatorTest::onGetUserPermissionsErrors()
	 * @return True
	 */
	static function onShowMissingArticle( $article ) {
		global $wgOut, $wgUser;
		$title = $article->getTitle();
		$prefix = self::analyzePrefix( $title->getText(), true /* only info pages */ );

		if( $prefix['error'] ) { # We are not on info pages
			$prefix2 = self::analyzePrefix( $title->getText() );
			if( self::getDBState( $prefix2 ) == 'existing' ) {
				$link = self::getSubdomain( $prefix2['lang'],
					$prefix2['project'], ( $title->getNsText() ? $title->getNsText() . ':' : '' ) .
						$prefix2['realtitle'] );
				if( self::displayPrefix() == $prefix2['prefix'] ) {
					# Redirect to the existing wiki if the user has this wiki as preference
					$wgOut->redirect( $link );
					return true;
				} else {
					# Show a link to the existing wiki
					$showLink = $wgUser->getSkin()->makeExternalLink( $link, $link );
					$wgOut->addHtml( '<div class="wminc-wiki-exists">' .
						wfMsgHtml( 'wminc-error-wiki-exists', $showLink ) .
					'</div>' );
				}
			} elseif ( self::shouldWeShowUnprefixedError( $title ) ) {
				# Unprefixed pages
				if( self::isContentProject() ) {
					# If the user has a test wiki pref, suggest a page title with prefix
					$suggesttitle = isset( $prefix2['realtitle'] ) ?
						$prefix2['realtitle'] : $title->getText();
					$suggest = self::displayPrefixedTitle( $suggesttitle, $title->getNamespace() );
					# Suggest to create a prefixed page
					$wgOut->addHtml( '<div class="wminc-unprefixed-suggest">' .
						wfMsgWikiHtml( 'wminc-error-unprefixed-suggest', $suggest ) .
					'</div>' );
				} else {
					$wgOut->addWikiMsg( 'wminc-error-unprefixed' );
				}
			}
			return true;
		}

		# At this point we should be on info pages ("Wx/xx[x]" pages)
		# So use the InfoPage class to show a nice welcome page
		# depending on whether it belongs to an existing, closed or missing wiki
		if( $title->getNamespace() != NS_MAIN ) {
			return true; # not for other namespaces
		}
		$infopage = new InfoPage( $title, $prefix );
		$infopage->mDbStatus = $dbstate = self::getDBState( $prefix );
		if( $dbstate == 'existing' ) {
			$infopage->mSubStatus = 'beforeincubator';
			$wgOut->addHtml( $infopage->showExistingWiki() );
		} elseif( $dbstate == 'closed' ) {
			$infopage->mSubStatus = 'imported';
			$wgOut->addHtml( $infopage->showIncubatingWiki() );	
		} else {
			$wgOut->addHtml( $infopage->showMissingWiki() );
		}
		return true;
	}

	/**
	 * When creating a new info page, help the user by prefilling it
	 * @return True
	 */
	public static function onEditFormPreloadText( &$text, &$title ) {
		$pagetitle = $title->getText();
		$prefix = IncubatorTest::analyzePrefix( $pagetitle, true /* only info page */ );
		if( $prefix['error'] || $title->getNamespace() != NS_MAIN ) {
			return true;
		}
		global $wgRequest, $wgOut;
		if ( $wgRequest->getBool( 'redlink' ) ) {
			# The edit page was reached via a red link.
			# Redirect to the article page and let them click the edit tab if
			# they really want to create this info page.
			$wgOut->redirect( $title->getFullUrl() );
		}
		$text = wfMsgNoTrans( 'wminc-infopage-prefill', $prefix['prefix'] );
		return true;
	}

	/**
	 * This forms a URL based on the language and project, and optionally title.
	 * TODO: add support for secure server, or are links automatically converted?
	 * @param $lang Language code
	 * @param $project Project code (or project name)
	 * @param $title Optional title on the target wiki
	 * @param $protocol Whether to include the protocol
	 * @return String
	 */
	public static function getSubdomain( $lang, $project, $title = '', $protocol = true ) {
		global $wmincProjects;
		$projectName = isset( $wmincProjects[$project] ) ? $wmincProjects[$project] : $project;
		return ( $protocol ? 'http://' : '' ) . strtolower( $lang ) . '.' .
			strtolower( $projectName ) . '.org' . ( $title ? '/wiki/' . $title : '' );
	}

	/**
	 * make "Wx/xxx/Main Page"
	 * @return String
	 */
	public static function getMainPage( $langCode, $prefix = null ) {
		# Take the "mainpage" msg in the given language
		$msg = wfMsgExt( 'mainpage', array( 'language' => $langCode ) );
		return isset( $prefix ) ? $prefix . '/' . $msg : $msg;
	}

	/**
	 * Redirect if &goto=mainpage on info pages
	 * @return True
	 */
	public static function onArticleFromTitle( &$title, &$article ) {
		global $wgRequest;
		$prefix = IncubatorTest::analyzePrefix( $title, true );
		if( $prefix['error'] || $wgRequest->getVal('goto') != 'mainpage' ) {
			return true;
		}
		$dbstate = self::getDBState( $prefix );
		if( !$dbstate ) {
			return true;
		}
		if( $dbstate == 'existing' ) {
			$url = self::getSubdomain( $prefix['lang'], $prefix['project'] );
		} else {
			$params['redirectfrom'] = 'infopage';
			$uselang = $wgRequest->getVal( 'uselang' );
			if( $uselang ) {
				$params['uselang'] = $uselang;
			}
			$mainpage = Title::newFromText(
				self::getMainPage( $prefix['lang'], $prefix['prefix'] )
			);
			$url = $mainpage->getFullURL( $params );
		}
		global $wgOut;
		$wgOut->redirect( $url );
		return true;
	}

	/**
	 * Whether we should use the feature of custom logos per project
	 * @param $title Title object
	 * @return false or Array from analyzePrefix()
	 */
	static function shouldWeSetCustomLogo( $title ) {
		$prefix = IncubatorTest::analyzePrefix( $title->getText() );

		# Maybe do later something like if( isContentProject() && 'recentchanges' ) { return true; }

		# return if the page does not have a valid prefix (info page is considered valid)
		if( $prefix['error'] ) {
			return false;
		}
		# display the custom logo only if &testwiki=wx/xx or the user's pref is set to the current test wiki
		if( self::displayPrefix() != $prefix['prefix'] ) {
			return false;
		}
		global $wmincTestWikiNamespaces;
		# return if the page is not in one of the test wiki namespaces
		if( !in_array( $title->getNamespace(), (array)$wmincTestWikiNamespaces ) ) {
			return false;
		}
		return $prefix;
	}

	/**
	 * Display a different logo in current test wiki
	 * if it is set in MediaWiki:Incubator-logo-wx/xxx
	 * and if accessed through &testwiki=wx/xxx
	 * or it the user preference is set to wx/xxx
	 * @return Boolean
	 */
	static function fnTestWikiLogo( &$out ) {
		$setLogo = self::shouldWeSetCustomLogo( $out->getTitle() );
		if( !$setLogo ) {
			return false;
		}
		global $wgLogo;
		$prefixForPageTitle = preg_replace('/\//', '-', strtolower( $setLogo['prefix'] ) );
		$file = wfFindFile( wfMsgForContentNoTrans( 'Incubator-logo-' . $prefixForPageTitle ) );
		if( !$file ) {
			# if MediaWiki:Incubator-logo-wx-xx(x) doesn't exist,
			# try a general, default logo for that project
			global $wmincProjects;
			$project = $setLogo['project'];
			$projectForFile = preg_replace('/ /', '-', strtolower( $wmincProjects[$project] ) );
			$imageobj = wfFindFile( wfMsg( 'wminc-logo-' . $projectForFile ) );
			if( $imageobj ) {
				$thumb = $imageobj->transform( array( 'width' => 135, 'height' => 135 ) );
				$wgLogo = $thumb->getUrl();
				return true;
			}
			return false;
		}
		# Use MediaWiki:Incubator-logo-wx-xx(x)
		$thumb = $file->transform( array( 'width' => 135, 'height' => 135 ) );
		$wgLogo = $thumb->getUrl();
		return true;
	}
}

<?php
#(c) Joerg Baach, Aaron Schulz 2007 GPL

if ( !defined( 'MEDIAWIKI' ) ) {
	echo "FlaggedRevs extension\n";
	exit( 1 );
}

if( !defined( 'FLAGGED_CSS' ) ) define('FLAGGED_CSS', $wgScriptPath.'/extensions/FlaggedRevs/flaggedrevs.css' );
if( !defined( 'FLAGGED_JS' ) ) define('FLAGGED_JS', $wgScriptPath.'/extensions/FlaggedRevs/flaggedrevs.js' );

if( !function_exists( 'extAddSpecialPage' ) ) {
	require( dirname(__FILE__) . '/../ExtensionFunctions.php' );
}

$wgExtensionCredits['parserhook'][] = array(
	'author' => 'Aaron Schulz',
	'name' => 'Flagged Revisions',
	'url' => 'http://www.mediawiki.org/wiki/Extension:FlaggedRevs',
	'description' => 'Allows for revisions of pages to be made static regardless of internal templates and images'
);

$wgExtensionCredits['specialpage'][] = array(
	'author' => 'Aaron Schulz, Joerg Baach',
	'name' => 'Review revisions',
	'url' => 'http://www.mediawiki.org/wiki/Extension:FlaggedRevs',
	'description' => 'Gives editors/reviewers the ability to validate revisions and stabilize pages'
);

$wgExtensionFunctions[] = 'efLoadFlaggedRevs';

# Load promotion UI
include_once( dirname( __FILE__ ) . '/SpecialMakevalidate.php' );
# Load review UI
extAddSpecialPage( dirname(__FILE__) . '/FlaggedRevsPage_body.php', 'Revisionreview', 'Revisionreview' );
# Load stableversions UI
extAddSpecialPage( dirname(__FILE__) . '/FlaggedRevsPage_body.php', 'Stableversions', 'Stableversions' );
# Load unreviewed pages list
extAddSpecialPage( dirname(__FILE__) . '/FlaggedRevsPage_body.php', 'Unreviewedpages', 'UnreviewedPages' );

function efLoadFlaggedRevs() {
	global $wgMessageCache, $RevisionreviewMessages, $wgOut, $wgJsMimeType, $wgHooks, $wgFlaggedRevs, $wgFlaggedArticle;
	$wgFlaggedRevs = new FlaggedRevs();
	$wgFlaggedArticle = new FlaggedArticle();
	
	# Internationalization
	require_once( dirname( __FILE__ ) . '/FlaggedRevsPage.i18n.php' );
	foreach( $RevisionreviewMessages as $lang => $langMessages ) {
		$wgMessageCache->addMessages( $langMessages, $lang );
	}
	# UI CSS
	$wgOut->addLink( array(
		'rel'	=> 'stylesheet',
		'type'	=> 'text/css',
		'media'	=> 'screen, projection',
		'href'	=> FLAGGED_CSS,
	) );
	# UI JS
	$wgOut->addScript( "<script type=\"{$wgJsMimeType}\" src=\"" . FLAGGED_JS . "\"></script>\n" );
	
	global $wgGroupPermissions, $wgUseRCPatrol;
	# Use RC Patrolling to check for vandalism
	# When revisions are flagged, they count as patrolled
	$wgUseRCPatrol = true;
	# Use only our extension mechanisms
	$wgGroupPermissions['sysop']['autopatrol'] = false;
	$wgGroupPermissions['sysop']['patrol']     = false;

	######### Hook attachments #########
	# Main hooks, overrides pages content, adds tags, sets tabs and permalink
	$wgHooks['SkinTemplateTabs'][] = array( $wgFlaggedArticle, 'setCurrentTab');
	# Update older, incomplete, page caches (ones that lack template Ids/image timestamps)
	$wgHooks['ArticleViewHeader'][] = array( $wgFlaggedArticle, 'maybeUpdateMainCache');
	$wgHooks['ArticleViewHeader'][] = array($wgFlaggedArticle, 'setPageContent');
	$wgHooks['SkinTemplateBuildNavUrlsNav_urlsAfterPermalink'][] = array($wgFlaggedArticle, 'setPermaLink');
	# Add tags do edit view
	$wgHooks['EditPage::showEditForm:initial'][] = array($wgFlaggedArticle, 'addToEditView');
	# Add review form
	$wgHooks['BeforePageDisplay'][] = array($wgFlaggedArticle, 'addReviewForm');
	# Mark of items in page history
	$wgHooks['PageHistoryBeforeList'][] = array($wgFlaggedArticle, 'addToPageHist');
	$wgHooks['PageHistoryLineEnding'][] = array($wgFlaggedArticle, 'addToHistLine');
	# Autopromote Editors
	$wgHooks['ArticleSaveComplete'][] = array($wgFlaggedArticle, 'autoPromoteUser');
	# Adds table link references to include ones from the stable version
	$wgHooks['LinksUpdateConstructed'][] = array($wgFlaggedArticle, 'extraLinksUpdate');
	# Check on undelete/merge/revisiondelete for changes to stable version
	$wgHooks['ArticleUndelete'][] = array($wgFlaggedArticle, 'articleLinksUpdate2');
	$wgHooks['ArticleRevisionVisiblitySet'][] = array($wgFlaggedArticle, 'articleLinksUpdate2');
	$wgHooks['ArticleMergeComplete'][] = array($wgFlaggedArticle, 'articleLinksUpdate');
	# Update our table NS/Titles when things are moved
	$wgHooks['SpecialMovepageAfterMove'][] = array($wgFlaggedArticle, 'updateFromMove');
	# Parser hooks, selects the desired images/templates
	$wgHooks['BeforeParserrenderImageGallery'][] = array($wgFlaggedArticle, 'parserMakeGalleryStable');
	$wgHooks['BeforeGalleryFindFile'][] = array($wgFlaggedArticle, 'galleryFindStableFileTime');
	$wgHooks['BeforeParserFetchTemplateAndtitle'][] = array($wgFlaggedArticle, 'parserFetchStableTemplate');
	$wgHooks['BeforeParserMakeImageLinkObj'][] = array( $wgFlaggedArticle, 'parserMakeStableImageLink');
	# Additional parser versioning
	$wgHooks['ParserAfterTidy'][] = array( $wgFlaggedArticle, 'parserInjectImageTimestamps');
	$wgHooks['OutputPageParserOutput'][] = array( $wgFlaggedArticle, 'outputInjectImageTimestamps');
	# Page review on edit
	$wgHooks['ArticleUpdateBeforeRedirect'][] = array( $wgFlaggedArticle, 'injectReviewDiffURLParams');
	$wgHooks['DiffViewHeader'][] = array( $wgFlaggedArticle, 'addDiffNoticeAfterEdit' );
        # Autoreview stuff
        $wgHooks['ArticleInsertComplete'][] = array( $wgFlaggedArticle, 'maybeMakeNewPageReviewed' );
        $wgHooks['ArticleSaveComplete'][] = array( $wgFlaggedArticle, 'maybeMakeEditReviewed' );
        #########

}

#########
# IMPORTANT:
# When configuring globals, add them to localsettings.php and edit them THERE

# This will only distinguish "sigted", "quality", and unreviewed
# A small icon will show in the upper right hand corner
$wgSimpleFlaggedRevsUI = false;
# Add stable/draft revision tabs. May be redundant due to the tags.
# If you have an open wiki, with the simple UI, you may want to enable these.
$wgFlaggedRevTabs = false;

# Allowed namespaces of reviewable pages
$wgFlaggedRevsNamespaces = array( NS_MAIN );

# Revision tagging can slow development...
# For example, the main user base may become complacent,
# perhaps treat flagged pages as "done",
# or just be too damn lazy to always click "current".
# We may just want non-user visitors to see reviewed pages by default.
$wgFlaggedRevsAnonOnly = true;
# Do flagged revs override the default view?
$wgFlaggedRevsOverride = true;
# Can users make comments that will show up below flagged revisions?
$wgFlaggedRevComments = false;
# Automatically checks the 'watch' box on the review form if they set 
# "watch pages I edit" as true at [[Special:Preferences]].
$wgFlaggedRevsWatch = true;
# Redirect users out to review changes since stable version on save?
$wgReviewChangesAfterEdit = true;
# Auto-review edits directly to the stable version by reviewers?
# Depending on how often templates are edited and by whom, this can possibly
# allow for vandalism to slip in :/
# Users should preview changes perhaps. This doesn't help much for section
# editing, so they may also want to review the page afterwards.
$wgFlaggedRevsAutoReview = true;
# Auto-review new pages with the minimal level?
$wgFlaggedRevsAutoReviewNew = false;

# How long to cache stable versions? (seconds)
$wgFlaggedRevsExpire = 7 * 24 * 3600;
# Compress pre-processed flagged revision text?
$wgFlaggedRevsCompression = false;

# When setting up new dimensions or levels, you will need to add some 
# MediaWiki messages for the UI to show properly; any sysop can do this.
# Define the tags we can use to rate an article, 
# and set the minimum level to have it become a "quality" version.
# "quality" revisions take precidence over other reviewed revisions
$wgFlaggedRevTags = array( 'accuracy'=>2, 'depth'=>1, 'style'=>1 );
# How high can we rate these revisions?
$wgFlaggedRevValues = 4;
# Who can set what flags to what level? (use -1 for not at all)
# Users cannot lower tags from a level they can't set
# Users with 'validate' can do anything regardless
# This is mainly for custom, less experienced, groups
$wgFlagRestrictions = array(
	'accuracy' => array('review' => 1),
	'depth'    => array('review' => 2),
	'style'    => array('review' => 3),
);

# Lets some users access the review UI and set some flags
$wgAvailableRights[] = 'review';
# Let some users set higher settings
$wgAvailableRights[] = 'validate';

# Define our basic reviewer class
$wgGroupPermissions['editor']['review']         = true;
$wgGroupPermissions['editor']['unwatchedpages'] = true;
$wgGroupPermissions['editor']['autoconfirmed']  = true;
$wgGroupPermissions['editor']['patrolmarks']    = true;

# Defines extra rights for advanced reviewer class
$wgGroupPermissions['reviewer']['validate'] = true;
# Let this stand alone just in case...
$wgGroupPermissions['reviewer']['review']   = true;

# Define when users get automatically promoted to editors. Set as false to disable.
$wgFlaggedRevsAutopromote = array(
	'days'       => 60,
	'edits'      => 200,
	'spacing'    => 5,
	'benchmarks' => 5, // keep this small
	'email'      => true,
	'userpage'   => true
);

# Variables below this point should probably not be modified
#########

# Add review log
$wgLogTypes[] = 'review';
$wgLogNames['review'] = 'review-logpage';
$wgLogHeaders['review'] = 'review-logpagetext';
$wgLogActions['review/approve']  = 'review-logentrygrant';
$wgLogActions['review/unapprove'] = 'review-logentryrevoke';
$wgLogActions['rights/erevoke']  = 'rights-editor-revoke';
$wgLogActions['rights/egrant']  = 'rights-editor-grant';

class FlaggedRevs {

	function __construct() {
		global $wgFlaggedRevTags, $wgFlaggedRevValues;
		
		$this->dimensions = array();
		foreach( array_keys($wgFlaggedRevTags) as $tag ) {
			$this->dimensions[$tag] = array();
			for($i=0; $i <= $wgFlaggedRevValues; $i++) {
				$this->dimensions[$tag][$i] = "$tag-$i";
			}
		}
		$this->isDiffFromStable = false;
		$this->skipReviewDiff = false;
	}
    
	/**
	 * Should this be using a simple icon-based UI?
	 */	
	static function useSimpleUI() {
		global $wgSimpleFlaggedRevsUI;
		
		return $wgSimpleFlaggedRevsUI;
	}
	
	/**
	 * Should comments be allowed on pages and forms?
	 */	
	static function allowComments() {
		global $wgFlaggedRevComments;
		
		return $wgFlaggedRevComments;
	}
    
    /**
     * @param string $text
     * @param Title $title
     * @param integer $id, revision id
     * @returns array( string, bool )
     * All included pages/arguments are expanded out
     */
    public function expandText( $text='', $title, $id=null ) {
    	global $wgParser, $wgUser;
    	# Make our hooks to trigger
    	$wgParser->isStable = true;
    	$wgParser->includesMatched = true;
        # Parse with default options
        $options = new ParserOptions($wgUser);
        $options->setRemoveComments( true ); // Save some bandwidth ;)
        $outputText = $wgParser->preprocess( $text, $title, $options, $id );
        $expandedText = array( $outputText, $wgParser->includesMatched );
        # Done!
        $wgParser->isStable = false;
        $wgParser->includesMatched = false;
        
        return $expandedText;
    }
    
	/**
	 * @param Article $article
	 * @param string $text
	 * @param int $id
	 * @returns ParserOutput
	 * Get the HTML of a revision based on how it was during $timeframe
	 */
    public function parseStableText( $article, $text, $id=NULL ) {
    	global $wgParser, $wgUser;
    	# Default options for anons if not logged in
    	$options = ParserOptions::newFromUser($wgUser);
    	# Make our hooks to trigger
    	$wgParser->isStable = true;
		# Don't show section-edit links, they can be old and misleading
		$options->setEditSection(false);
		// $options->setEditSection( $id==$article->getLatest() );
		# Parse the new body, wikitext -> html
		$title = $article->getTitle(); // avoid pass-by-reference error
       	$parserOut = $wgParser->parse( $text, $title, $options, true, true, $id );
       	# Reset $wgParser
       	$wgParser->isStable = false; // Done!
       	
       	return $parserOut;
    }
    
    /**
    * @param string $text
    * @returns string, flags
    * Compress pre-processed text, passed by reference
    */
    public function compressText( &$text ) {
    	global $wgFlaggedRevsCompression;
    	# Compress text if $wgFlaggedRevsCompression is set.
		$flags = array( 'utf-8' );
		if( $wgFlaggedRevsCompression ) {
			if( function_exists( 'gzdeflate' ) ) {
				$text = gzdeflate( $text );
				$flags[] = 'gzip';
			} else {
				wfDebug( "FlaggedRevs::compressText() -- no zlib support, not compressing\n" );
			}
		}
    	return implode( ',', $flags );
    }
    
    /**
    * @param string $text
    * @param mixed $flags, either in string or array form
    * @returns string
    * Uncompress pre-processed text, using flags
    */
    public function uncompressText( $text, $flags ) {
    	global $wgFlaggedRevsCompression;
    	
    	if( !is_array($flags) ) {
    		$flags = explode( ',', $flags );
    	}
    	# Lets not mix up types here
    	if( is_null($text) )
    		return null;
    	
		if( in_array( 'gzip', $flags ) ) {
			# Deal with optional compression if $wgFlaggedRevsCompression is set.
			$text = gzinflate( $text );
		}
		return $text;
    }
    
	/**
	 * @param int $rev_id
	 * @returns string
	 * Get the text of a stable version
	 */	
    public function getFlaggedRevText( $rev_id ) {
 		$dbr = wfGetDB( DB_SLAVE );
 		// Get the text from the flagged revisions table
		$result = $dbr->select( array('flaggedrevs','revision'),
			array('fr_text', 'fr_flags'),
			array('fr_rev_id' => $rev_id, 'fr_rev_id = rev_id', 
				'rev_deleted & '.Revision::DELETED_TEXT.' = 0'), 
			__METHOD__,
			array('LIMIT' => 1) );
		if( $row = $dbr->fetchObject($result) ) {
			return self::uncompressText( $row->fr_text, $row->fr_flags );
		}
		
		return NULL;
    }
    
	/**
	 * @param int $rev_id
	 * @returns Revision
	 * Will not return if deleted
	 */		
	public function getFlaggedRev( $rev_id ) {
		$dbr = wfGetDB( DB_SLAVE );
		# Skip deleted revisions
		$result = $dbr->select( array('flaggedrevs','revision'),
			array('fr_namespace', 'fr_title', 'fr_rev_id', 'fr_user', 'fr_timestamp', 'fr_comment', 'rev_timestamp'),
			array('fr_rev_id' => $rev_id, 'fr_rev_id = rev_id', 
				'rev_deleted & '.Revision::DELETED_TEXT.' = 0'),
			__METHOD__ );
		# Sorted from highest to lowest, so just take the first one if any
		if( $row = $dbr->fetchObject($result) ) {
			return $row;
		}
		
		return NULL;
	}

	/**
	 * @param int $page_id
	 * @returns Row
	 * Get rev ids of reviewed revs for a page
	 * Will include deleted revs here
	 */
    public function getReviewedRevs( $page ) {
		$rows = array();
		
		$dbr = wfGetDB( DB_SLAVE );
		$result = $dbr->select('flaggedrevs',
			array('fr_rev_id','fr_quality'),
			array('fr_namespace' => $page->getNamespace(), 'fr_title' => $page->getDBkey() ),
			__METHOD__ ,
			array('ORDER BY' => 'fr_rev_id DESC') );
		while( $row = $dbr->fetchObject($result) ) {
        	$rows[$row->fr_rev_id] = $row->fr_quality;
		}
		
		return $rows;
    }

	/**
	 * @param int $page_id
	 * @param int $from_rev
	 * @returns int
	 * Get number of revs since a certain revision
	 */
    public function getRevCountSince( $page_id, $from_rev ) {   
		$dbr = wfGetDB( DB_SLAVE );
		$count = $dbr->selectField('revision', 'COUNT(*)',
			array('rev_page' => $page_id, "rev_id > $from_rev"),
			__METHOD__ );
		
		return $count;
    }
	
	/**
	 * Get latest quality rev, if not, the latest reviewed one.
	 * @param Title $title
	 * @param bool $getText
	 * @param bool $forUpdate, use master DB and avoid using page_ext_stable?
	 * @returns Row
	*/
    public function getOverridingRev( $title=NULL, $getText=false, $forUpdate=false ) {
    	if( is_null($title) )
			return null;
    	
    	$selectColumns = array('fr_rev_id', 'fr_user', 'fr_timestamp', 'fr_comment', 'rev_timestamp');
    	if( $getText ) {
    		$selectColumns[] = 'fr_text';
    		$selectColumns[] = 'fr_flags';
    	}
    	# If we want the text, then get the text flags too
    	if( !$forUpdate ) {
    		$dbr = wfGetDB( DB_SLAVE );
        	$result = $dbr->select( array('page', 'flaggedrevs', 'revision'),
				$selectColumns,
				array('page_namespace' => $title->getNamespace(), 'page_title' => $title->getDBkey(),
					'page_ext_stable = fr_rev_id', 'fr_rev_id = rev_id', 
				 	'rev_deleted & '.Revision::DELETED_TEXT.' = 0'),
				__METHOD__,
				array('LIMIT' => 1) );
			if( !$row = $dbr->fetchObject($result) )
				return null;
			
			return $row;
		}
		
		$dbw = wfGetDB( DB_MASTER );
		// Look for quality revision
        $result = $dbw->select( array('flaggedrevs', 'revision'),
			$selectColumns,
			array('fr_namespace' => $title->getNamespace(), 'fr_title' => $title->getDBkey(), 
				'fr_quality >= 1', 'fr_rev_id = rev_id', 'rev_deleted & '.Revision::DELETED_TEXT.' = 0'),
			__METHOD__,
			array('ORDER BY' => 'fr_rev_id DESC', 'LIMIT' => 1 ) );
		// Do we have one? If not, try any reviewed revision...
        if( !$row = $dbw->fetchObject($result) ) {
        	$result = $dbw->select( array('flaggedrevs', 'revision'),
				$selectColumns,
				array('fr_namespace' => $title->getNamespace(), 'fr_title' => $title->getDBkey(),
					'fr_rev_id = rev_id', 'rev_deleted & '.Revision::DELETED_TEXT.' = 0'),
				__METHOD__,
				array('ORDER BY' => 'fr_rev_id DESC', 'LIMIT' => 1 ) );
			if( !$row = $dbw->fetchObject($result) )
				return null;
		}
		return $row;
    }
    
	/**
	 * Get flags for a revision
	 * @param int $rev_id
	 * @returns Array
	*/
    public function getFlagsForRevision( $rev_id ) {
    	# Set all flags to zero
    	$flags = array();
    	foreach( array_keys($this->dimensions) as $tag ) {
    		$flags[$tag] = 0;
    	}
    	# Grab all the tags for this revision
		$db = wfGetDB( DB_SLAVE );
		$result = $db->select('flaggedrevtags',
			array('frt_dimension', 'frt_value'), 
			array('frt_rev_id' => $rev_id),
			__METHOD__ );
		# Iterate through each tag result
		while ( $row = $db->fetchObject($result) ) {
			$flags[$row->frt_dimension] = $row->frt_value;
		}
		return $flags;
	}
	
	/**
	 * @param int $title
	 * @returns bool
	 * Is $title the main page?
	 */	
	public function isMainPage( $title ) {
		$mp = Title::newMainPage();
		return ( $title->getNamespace()==$mp->getNamespace() && $title->getDBKey()==$mp->getDBKey() );
	}

	/**
	 * @param array $flags
	 * @param bool $prettybox
	 * @param string $css, class to wrap box in
	 * @returns string
	 * Generates a review box/tag
	 */	
    public function addTagRatings( $flags, $prettyBox = false, $css='' ) {
        global $wgFlaggedRevTags;
        
        $tag = '';
        if( $prettyBox )
        	$tag .= "<table align='center' class='$css' cellpading='0'>";
        
		foreach( $this->dimensions as $quality => $value ) {
			$valuetext = wfMsgHtml('revreview-' . $this->dimensions[$quality][$flags[$quality]]);
            $level = $flags[$quality];
            $minlevel = $wgFlaggedRevTags[$quality];
            if( $level >= $minlevel )
                $classmarker = 2;
            elseif( $level > 0 )
                $classmarker = 1;
            else
                $classmarker = 0;

            $levelmarker = $level * 20 + 20; //XXX do this better
            if( $prettyBox ) {
            	$tag .= "<tr><td><span class='fr-group'><span class='fr-text'>" . wfMsgHtml("revreview-$quality") . 
					"</span></td><td><span class='fr-marker fr_value$levelmarker'>$valuetext</span></span></td></tr>\n";
            } else {
				$tag .= "&nbsp;<span class='fr-marker-$levelmarker'><strong>" . 
					wfMsgHtml("revreview-$quality") . 
					"</strong>: <span class='fr-text-value'>$valuetext&nbsp;</span>&nbsp;" .
					"</span>\n";    
			}
		}
		if( $prettyBox )
			$tag .= '</table>';
		 
		return $tag;
    }
  
	/**
	 * @param Row $trev, flagged revision row
	 * @param array $flags
	 * @param int $rev_since, revisions since review
	 * @param bool $stable, are we referring to the stable revision?
	 * @returns string
	 * Generates a review box using a table using addTagRatings()
	 */	
	public function prettyRatingBox( $tfrev, $flags, $revs_since, $stable=true ) {
		global $wgLang;
		# Get quality level
		$quality = self::isQuality( $flags );
		$pristine = self::isPristine( $flags );
		$time = $wgLang->date( wfTimestamp(TS_MW, $tfrev->fr_timestamp), true );
		# Some checks for which tag CSS to use
		if( $pristine )
			$tagClass = 'flaggedrevs_box3';
		else if( $quality )
			$tagClass = 'flaggedrevs_box2';
		else
			$tagClass = 'flaggedrevs_box1';
        # Construct some tagging
        $msg = $stable ? 'revreview-' : 'revreview-newest-';
        $msg .= $quality ? 'quality' : 'basic';
        $msg2 = $stable ? '' : ' '.wfMsg('revreview-oldrating');
        
		$box = ' <a id="mw-revisiontoggle" style="display:none;" href="javascript:toggleRevRatings()">' . 
			wfMsg('revreview-toggle') . '</a>';
		$box .= '<span id="mw-revisionratings">' .
			wfMsgExt($msg, array('parseinline'), $tfrev->fr_rev_id, $time, $revs_since) .
			$msg2 .
			self::addTagRatings( $flags, true, "{$tagClass}a" ) .
			'</span>';
        
        return $box;
	}

	/**
	 * @param Row $row
	 * @returns string
	 * Generates revision review notes
	 */	    
    public function ReviewNotes( $row ) {
    	global $wgUser, $wgFlaggedRevComments;
    	
    	if( !$row || !$wgFlaggedRevComments ) 
			return '';
    	
    	if( $row->fr_comment ) {
    		$skin = $wgUser->getSkin();
    		$notes = '<p><div class="flaggedrevs_notes plainlinks">';
    		$notes .= wfMsgExt('revreview-note', array('parse'), User::whoIs( $row->fr_user ) );
    		$notes .= '<i>' . $skin->formatComment( $row->fr_comment ) . '</i></div></p><br/>';
    	}
    	return $notes;
    }
    
	/**
	* @param Array $flags
	* @returns bool, is this revision at quality condition?
	*/
    public function isQuality( $flags ) {
    	global $wgFlaggedRevTags;
    	
    	foreach( $wgFlaggedRevTags as $f => $v ) {
    		if( !isset($flags[$f]) || $v > $flags[$f] ) 
				return false;
    	}
    	return true;
    }
    
	/**
	* @param Array $flags
	* @returns bool, is this revision at optimal condition?
	*/
    public function isPristine( $flags ) {
    	global $wgFlaggedRevTags, $wgFlaggedRevValues;
    	
    	foreach( $wgFlaggedRevTags as $f => $v ) {
    		if( !isset($flags[$f]) || $flags[$f] < $wgFlaggedRevValues ) 
				return false;
    	}
    	return true;
    }

	/**
	* Is this page in reviewable namespace?
	* @param Title, $title
	* @returns bool
	*/
    public function isReviewable( $title ) {
    	global $wgFlaggedRevsNamespaces;
    	
    	return in_array($title->getNamespace(),$wgFlaggedRevsNamespaces);
    }
    
	/**
	* @param Article $article
	* @returns ParserOutput
	* Get the page cache for the top stable revision of an article
	*/   
    public function getPageCache( $article ) {
    	global $wgUser, $parserMemc, $wgCacheEpoch, $wgFlaggedRevsExpire;
    	
		wfProfileIn( __METHOD__ );
		# Make sure it is valid
    	if( !$article || !$article->getId() ) 
			return NULL;
    	
    	$parserCache =& ParserCache::singleton();
    	$key = 'sv-' . $parserCache->getKey( $article, $wgUser );
		# Get the cached HTML
		wfDebug( "Trying parser cache $key\n" );
		$value = $parserMemc->get( $key );
		if( is_object( $value ) ) {
			wfDebug( "Found.\n" );
			# Delete if article has changed since the cache was made
			$canCache = $article->checkTouched();
			$cacheTime = $value->getCacheTime();
			$touched = $article->mTouched;
			if( !$canCache || $value->expired( $touched ) ) {
				if( !$canCache ) {
					wfIncrStats( "pcache_miss_invalid" );
					wfDebug( "Invalid cached redirect, touched $touched, epoch $wgCacheEpoch, cached $cacheTime\n" );
				} else {
					wfIncrStats( "pcache_miss_expired" );
					wfDebug( "Key expired, touched $touched, epoch $wgCacheEpoch, cached $cacheTime\n" );
				}
				$parserMemc->delete( $key );
				$value = false;
			} else {
				if( isset( $value->mTimestamp ) ) {
					$article->mTimestamp = $value->mTimestamp;
				}
				wfIncrStats( "pcache_hit" );
			}
		} else {
			wfDebug( "Parser cache miss.\n" );
			wfIncrStats( "pcache_miss_absent" );
			$value = false;
		}
		
		wfProfileOut( __METHOD__ );
		
		return $value;		
    }
    
	/**
	* @param Article $article
	* @param parerOutput $parserOut
	* Updates the stable cache of a page with the given $parserOut
	*/
    public function updatePageCache( $article, $parserOut=NULL ) {
    	global $wgUser, $parserMemc, $wgFlaggedRevsExpire;
    	# Make sure it is valid
    	if( is_null($parserOut) || !$article ) 
			return false;
    	# Update the cache...
		$article->mTitle->invalidateCache();
		
		$parserCache =& ParserCache::singleton();
    	$key = 'sv-' . $parserCache->getKey( $article, $wgUser );
    	# Add cache mark to HTML
		$now = wfTimestampNow();
		$parserOut->setCacheTime( $now );
		# Save the timestamp so that we don't have to load the revision row on view
		$parserOut->mTimestamp = $article->getTimestamp();
    	$parserOut->mText .= "\n<!-- Saved in stable version parser cache with key $key and timestamp $now -->";
		# Set expire time
		if( $parserOut->containsOldMagic() ){
			$expire = 3600; # 1 hour
		} else {
			$expire = $wgFlaggedRevsExpire;
		}
		# Save to objectcache
		$parserMemc->set( $key, $parserOut, $expire );
		# Purge squid for this page only
		$article->mTitle->purgeSquid();
		
		return true;
    }
    
	/**
	* Automatically review an edit and add a log entry in the review log.
	* LinksUpdate was already called via edit operations, so the page
	* fields will be up to date. This updates the stable version.
	*/ 
	public function autoReviewEdit( $article, $user, $text, $rev, $flags ) {
		global $wgParser, $wgFlaggedRevsAutoReview, $wgFlaggedRevs;
		
		$quality = 0;
		if( $this->isQuality($flags) ) {
			$quality = $this->isPristine($flags) ? 2 : 1;
		}
		$flagset = $tmpset = $imgset = array();
		foreach( $flags as $tag => $value ) {
			$flagset[] = array(
				'frt_rev_id' => $rev->getId(),
				'frt_dimension' => $tag,
				'frt_value' => $value 
			);
		}
		# Try the parser cache, should be set on the edit before this is called.
		# If not set or up to date, then parse it...
		$parserCache =& ParserCache::singleton();
		$poutput = $parserCache->get( $article, $user );
		if( $poutput==false ) {
			$options = ParserOptions::newFromUser($user);
			$options->setTidy(true);
			$poutput = $wgParser->parse( $text, $article->mTitle, $options, true, true, $rev->getID() );
			# Might as well save the cache while we're at it
			$parserCache->save( $poutput, $article, $user );
		}
		# NS:title -> rev ID mapping
        foreach( $poutput->mTemplateIds as $namespace => $title ) {
        	foreach( $title as $dbkey => $id ) {
				$tmpset[] = array(
					'ft_rev_id' => $rev->getId(),
					'ft_namespace' => $namespace,
					'ft_title' => $dbkey,
					'ft_tmp_rev_id' => $id
				);
        	}
        }
        # Image -> timestamp mapping
        foreach( $poutput->mImageSHA1Keys as $dbkey => $timeAndSHA1 ) {
        	foreach( $timeAndSHA1 as $time => $sha1 ) {
				$imgset[] = array( 
					'fi_rev_id' => $rev->getId(),
					'fi_name' => $dbkey,
					'fi_img_timestamp' => $time,
					'fi_img_sha1' => $sha1
				);
			}
        }
        
		$dbw = wfGetDB( DB_MASTER );
		$dbw->begin();
		# Update our versioning pointers
		if( !empty( $tmpset ) ) {
			$dbw->replace( 'flaggedtemplates', 
				array( array('ft_rev_id','ft_namespace','ft_title') ), $tmpset,
				__METHOD__ );
		}
		if( !empty( $imgset ) ) {
			$dbw->replace( 'flaggedimages', 
				array( array('fi_rev_id','fi_name') ), $imgset, 
				__METHOD__ );
		}
        # Get the page text and resolve all templates
        list($fulltext,$complete) = $this->expandText( $rev->getText(), $rev->getTitle(), $rev->getId() );
        if( !$complete ) {
        	$dbw->rollback(); // All versions must be specified, 0 for none
        	return false;
        }
        # Compress $fulltext, passed by reference
        $textFlags = self::compressText( $fulltext );
		# Our review entry
		$revisionset = array(
			'fr_rev_id'    => $rev->getId(),
			'fr_namespace' => $rev->getTitle()->getNamespace(),
			'fr_title'     => $rev->getTitle()->getDBkey(),
			'fr_user'      => $user->getId(),
			'fr_timestamp' => wfTimestampNow(),
			'fr_comment'   => '',
			'fr_quality'   => $quality,
			'fr_text'      => $fulltext, // Store expanded text for speed
			'fr_flags'     => $textFlags
		);
		# Update flagged revisions table
		$dbw->replace( 'flaggedrevs', 
			array( array('fr_rev_id','fr_namespace','fr_title') ), $revisionset, 
			__METHOD__ );
		# Set all of our flags
		$dbw->replace( 'flaggedrevtags', 
			array( array('frt_rev_id','frt_dimension') ), $flagset, 
			__METHOD__ );
		# Mark as patrolled
		$dbw->update( 'recentchanges',
			array( 'rc_patrolled' => 1 ),
			array( 'rc_this_oldid' => $rev->getId() ),
			__METHOD__ 
		);
		$dbw->commit();
		
		# Update the article review log
		Revisionreview::updateLog( $rev->getTitle(), $flags, wfMsg('revreview-auto'), 
			$rev->getID(), true, false );
		
		# Might as well save the stable version cache
		$this->updatePageCache( $article, $poutput );
    	# Update page fields
    	$this->updateArticleOn( $article, $rev->getID() );
		# Purge squid for this page only
		$article->mTitle->purgeSquid();
		
		return true;
	}
	
 	/**
	* @param Article $article
	* @param Integer $rev_id, the stable version rev_id
	* Updates the page_ext_stable and page_ext_reviewed fields
	*/
    function updateArticleOn( $article, $rev_id ) {
        $dbw = wfGetDB( DB_MASTER );
        $dbw->update( 'page',
			array('page_ext_stable' => $rev_id, 
				'page_ext_reviewed' => ($article->getLatest() == $rev_id) ),
			array('page_namespace' => $article->mTitle->getNamespace(), 
				'page_title' => $article->mTitle->getDBkey() ),
			__METHOD__ );	
    }
    
    public function updateFromMove( $movePageForm, $oldtitle, $newtitle ) {
    	$dbw = wfGetDB( DB_MASTER );
        $dbw->update( 'flaggedrevs',
			array('fr_namespace' => $newtitle->getNamespace(), 'fr_title' => $newtitle->getDBkey() ),
			array('fr_namespace' => $oldtitle->getNamespace(), 'fr_title' => $oldtitle->getDBkey() ),
			__METHOD__ );
			
		return true;
    }

	/**
	* Clears cache for a page when merges are done.
	* We may have lost the stable revision to another page.
	*/
    public function articleLinksUpdate( $article, $a=null, $b=null ) {
    	global $wgUser, $wgParser;
    	# Update the links tables as the stable version may now be the default page...
		$parserCache =& ParserCache::singleton();
		$poutput = $parserCache->get( $article, $wgUser );
		if( $poutput==false ) {
			$text = $article->getContent();
			$poutput = $wgParser->parse($text, $article->mTitle, ParserOptions::newFromUser($wgUser));
			# Might as well save the cache while we're at it
			$parserCache->save( $poutput, $article, $wgUser );
		}
		$u = new LinksUpdate( $article->mTitle, $poutput );
		$u->doUpdate(); // this will trigger our hook to add stable links too...
		
		return true;
    }
    
	/**
	* Clears cache for a page when revisiondelete/undelete is used
	*/
    public function articleLinksUpdate2( $title, $a=null, $b=null ) {
    	global $wgUser, $wgParser;
    	
    	$article = new Article( $title );
		# Update the links tables as the stable version may now be the default page...
		$parserCache =& ParserCache::singleton();
		$poutput = $parserCache->get( $article, $wgUser );
		if( $poutput==false ) {
			$text = $article->getContent();
			$poutput = $wgParser->parse($text, $article->mTitle, ParserOptions::newFromUser($wgUser));
			# Might as well save the cache while we're at it
			$parserCache->save( $poutput, $article, $wgUser );
		}
		$u = new LinksUpdate( $article->mTitle, $poutput );
		$u->doUpdate(); // this will trigger our hook to add stable links too...
		
		return true;
    }

	/**
	* Inject stable links on LinksUpdate
	*/
    public function extraLinksUpdate( $linksUpdate ) {
    	global $wgFlaggedRevs;

    	wfProfileIn( __METHOD__ );
		    	
    	if( !$this->isReviewable( $linksUpdate->mTitle ) ) 
			return true;
    	# Check if this page has a stable version
    	$sv = $this->getOverridingRev( $linksUpdate->mTitle, true, true );
    	if( !$sv )
			return true;
    	# Parse the revision
    	$article = new Article( $linksUpdate->mTitle );
    	$text = self::uncompressText( $sv->fr_text, $sv->fr_flags );
    	$parserOut = self::parseStableText( $article, $text, $sv->fr_rev_id );
    	# Might as well update the stable cache while we're at it
    	$this->updatePageCache( $article, $parserOut );
    	# Update page fields
    	$this->updateArticleOn( $article, $sv->fr_rev_id );
    	# Update the links tables to include these
    	# We want the UNION of links between the current
		# and stable version. Therefore, we only care about
		# links that are in the stable version and not the regular one.
		$linksUpdate->mLinks += $parserOut->getLinks();
		$linksUpdate->mImages += $parserOut->getImages();
		$linksUpdate->mTemplates += $parserOut->getTemplates();
		$linksUpdate->mExternals += $parserOut->getExternalLinks();
		$linksUpdate->mCategories += $parserOut->getCategories();
		# Interlanguage links
		$ill = $parserOut->getLanguageLinks();
		foreach( $ill as $link ) {
			list( $key, $title ) = explode( ':', $link, 2 );
			$linksUpdate->mInterlangs[$key] = $title;
		}

		wfProfileOut( __METHOD__ );
		return true;
    }
 
	/**
	* Select the desired templates based on the selected stable revision IDs
	*/
	function parserFetchStableTemplate( $parser, $title, &$skip, &$id ) {
    	# Trigger for stable version parsing only
    	if( !isset($parser->isStable) || !$parser->isStable )
    		return true;
    	# Only called to make fr_text, right after template/image specifiers 
    	# are added to the DB. Slaves may not have it yet...
		$dbw = wfGetDB( DB_MASTER );
		$id = $dbw->selectField('flaggedtemplates', 'ft_tmp_rev_id',
			array('ft_rev_id' => $parser->mRevisionId, 
				'ft_namespace' => $title->getNamespace(), 'ft_title' => $title->getDBkey() ),
			__METHOD__ );
		
		if( !$id ) {
			if( $id === false )
				$parser->includesMatched = false; // May want to give an error
			$id = 0; // Zero for not found
			$skip = true;
		}
		return true;
    }

	/**
	* Select the desired images based on the selected stable revision times/SHA-1s
	*/  
	function parserMakeStableImageLink( $parser, $nt, &$skip, &$time ) {
    	# Trigger for stable version parsing only
    	if( !isset($parser->isStable) || !$parser->isStable )
    		return true;
    	# Only called to make fr_text, right after template/image specifiers 
    	# are added to the DB. Slaves may not have it yet...
    	$dbw = wfGetDB( DB_MASTER );
       	$time = $dbw->selectField('flaggedimages', 'fi_img_timestamp',
			array('fi_rev_id' => $parser->mRevisionId, 'fi_name' => $nt->getDBkey() ),
			__METHOD__ );
		
		if( !$time ) {
			if( $time === false ) 
				$parser->includesMatched = false; // May want to give an error
			$time = 0; // Zero for not found
			$skip = true;
		}
		return true;
    }

	/**
	* Select the desired images based on the selected stable revision times/SHA-1s
	*/  
    function galleryFindStableFileTime( $ig, $nt, &$time ) {
    	# Trigger for stable version parsing only
    	if( !isset($ig->isStable) || !$ig->isStable )
    		return true;
    	# Slaves may not have it yet...
    	$dbr = wfGetDB( DB_MASTER );
        $time = $dbr->selectField('flaggedimages', 'fi_img_timestamp',
			array('fi_rev_id' => $ig->mRevisionId, 'fi_name' => $nt->getDBkey() ),
			__METHOD__ );
		$time = $time ? $time : -1; // hack, will never find this
		
		return true;
    }

	/**
	* Flag of an image galley as stable
	*/  
    function parserMakeGalleryStable( $parser, $ig ) {
    	# Trigger for stable version parsing only
    	if( !isset($parser->isStable) || !$parser->isStable )
    		return true;
    	
    	$ig->isStable = true;
    	
    	return true;
    }

	/**
	* Insert image timestamps/SHA-1 keys into parser output
	*/  
    function parserInjectImageTimestamps( $parser, &$text ) {
		$parser->mOutput->mImageSHA1Keys = array();
		# Fetch the timestamps of the images
		if( !empty($parser->mOutput->mImages) ) {
			$dbr = wfGetDB( DB_SLAVE );
        	$res = $dbr->select('image', array('img_name','img_timestamp','img_sha1'),
				array('img_name IN(' . $dbr->makeList( array_keys($parser->mOutput->mImages) ) . ')'),
				__METHOD__ );
			
			while( $row = $dbr->fetchObject($res) ) {
				$parser->mOutput->mImageSHA1Keys[$row->img_name] = array();
				$parser->mOutput->mImageSHA1Keys[$row->img_name][$row->img_timestamp] = $row->img_sha1;
			}
		}
		return true;
    }

	/**
	* Insert image timestamps/SHA-1s into page output
	*/  
    function outputInjectImageTimestamps( $out, $parserOut ) {
    	$out->mImageSHA1Keys = $parserOut->mImageSHA1Keys;
    	
    	return true;
    }

	/**
	* Redirect users out to review the changes to the stable version.
	* Only for people who can review and for pages that have a stable version.
	*/ 
    public function injectReviewDiffURLParams( $article, &$sectionanchor, &$extraq ) {
    	global $wgUser, $wgReviewChangesAfterEdit, $wgFlaggedRevs;
		# Was this already autoreviewed?
		if( $this->skipReviewDiff )
			return true;
		
    	if( !$wgReviewChangesAfterEdit || !$wgUser->isAllowed( 'review' ) )
    		return true;
    	
		$frev = $this->getOverridingRev( $article->getTitle() );
		if( $frev )	{
			$frev_id = $frev->fr_rev_id;
			$extraq .= "oldid={$frev_id}&diff=cur&editreview=1";
		}
		
		return true;
	
	}

	/**
	* When comparing the stable revision to the current after editing a page, show
	* a tag with some explaination for the diff.
	*/ 
	public function addDiffNoticeAfterEdit( $diff, $OldRev, $NewRev ) {
		global $wgRequest, $wgUser, $wgOut, $wgFlaggedRevs;
		
		if( !$wgUser->isAllowed( 'review') || !$wgRequest->getBool('editreview') || !$NewRev->isCurrent() )
			return true;
		
		$frev = $this->getOverridingRev( $diff->mTitle );
		if( !$frev || $frev->fr_rev_id != $OldRev->getID() )
			return true;
	
		$wgOut->addHTML( '<div id="mw-difftostable" class="flaggedrevs_notice plainlinks">' .
			wfMsg('revreview-update').'</div>' );
		# Set flag for review form to tell it to autoselect tag settings from the
		# old revision unless the current one is tagged to.
		if( !self::getFlaggedRev( $NewRev->getID() ) ) {
			global $wgFlaggedArticle;
			$wgFlaggedArticle->isDiffFromStable = true;
		}
		
		return true;
	
	}

	/**
	* When an edit is made by a reviwer, if the current revision is the stable
	* version, try to automatically review it.
	*/ 
	public function maybeMakeEditReviewed( $article, $user, $text, $c, $m, $a, $b, $flags, $rev ) {
		global $wgFlaggedRevs, $wgFlaggedRevsAutoReview;
		
		if( !$wgFlaggedRevsAutoReview || !$user->isAllowed( 'review' ) )
			return true;
		# Revision will be null for null edits
		if( !$rev ) {
			$this->skipReviewDiff = true; // Don't jump to diff...
			return true;
		}
		# Check if this new revision is now the current one.
		# ArticleSaveComplete may trigger even though a confict blocked insertion.
		$prev_id = $article->mTitle->getPreviousRevisionID( $rev->getID() );
		if( !$prev_id )
			return true;
		$frev = $this->getOverridingRev( $article->mTitle );
		# Is this an edit directly to the stable version?
		if( is_null($frev) || $prev_id != $frev->fr_rev_id )
			return true;
		# Grab the flags for this revision
		$flags = $this->getFlagsForRevision( $frev->fr_rev_id );
		# Check if user is allowed to renew the stable version.
		# If it has been reviewed too highly for this user, abort.
		foreach( $flags as $quality => $level ) {
			if( !Revisionreview::userCan($quality,$level) ) {
				return true;
			}
		}
		self::autoReviewEdit( $article, $user, $text, $rev, $flags );
		
		$this->skipReviewDiff = true; // Don't jump to diff...
		
		return true;
	}

	/**
	* When a new page is made by a reviwer, try to automatically review it.
	*/ 	
	public function maybeMakeNewPageReviewed( $article, $user, $text, $c, $flags, $a, $b, $flags, $rev ) {
		global $wgFlaggedRevs, $wgFlaggedRevsAutoReviewNew;
	
		if( !$wgFlaggedRevsAutoReviewNew || !$user->isAllowed( 'review' ) )
			return true;
		# Revision will be null for null edits
		if( !$rev ) {
			$this->skipReviewDiff = true; // Don't jump to diff...
			return true;
		}
		# Assume basic flagging level
		$flags = array();
    	foreach( array_keys($this->dimensions) as $tag ) {
    		$flags[$tag] = 1;
    	}
		self::autoReviewEdit( $article, $user, $text, $rev, $flags );
		
		$this->skipReviewDiff = true; // Don't jump to diff...
		
		return true;
	}

	/**
	* Callback that autopromotes user according to the setting in 
    * $wgFlaggedRevsAutopromote. This is not as efficient as it should be
	*/
	public function autoPromoteUser( $article, $user, &$text, &$summary, &$isminor, &$iswatch, &$section ) {
		global $wgUser, $wgFlaggedRevsAutopromote;
		
		if( !$wgFlaggedRevsAutopromote )
			return true;
		# Grab current groups
		$groups = $user->getGroups();
		$now = time();
		$usercreation = wfTimestamp(TS_UNIX,$user->mRegistration);
		$userage = floor(($now-$usercreation) / 86400);
		$userpage = $user->getUserPage();
		# Do not give this to current holders or bots
		if( in_array( array('bot','editor'), $groups ) )
			return true;
		# Check if we need to promote...
		if( $userage < $wgFlaggedRevsAutopromote['days'] )
			return true;
		if( $user->getEditCount() < $wgFlaggedRevsAutopromote['edits'] )
			return true;
		if( $wgFlaggedRevsAutopromote['email'] && !$wgUser->isAllowed('emailconfirmed') )
			return true;
		if( $wgFlaggedRevsAutopromote['userpage'] && !$userpage->exists() )
			return true;
		if( $user->isBlocked() )
			return true;
    	# Do not re-add status if it was previously removed...
		$dbw = wfGetDB( DB_MASTER );
		$removed = $dbw->selectField( 'logging',
			'log_timestamp',
			array( 'log_namespace' => NS_USER,
				'log_title' => $wgUser->getUserPage()->getDBkey(),
				'log_type'  => 'rights',
				'log_action'  => 'erevoke' ),
			__METHOD__,
			array('USE INDEX' => 'page_time') ); 
		if( $removed )
			return true;
		# Check for edit spacing. This can be expensive...so check it last
		if( $wgFlaggedRevsAutopromote['spacing'] > 0 && $wgFlaggedRevsAutopromote['benchmarks'] > 1 ) {
			$spacing = $wgFlaggedRevsAutopromote['spacing'] * 24 * 3600; // Convert to hours
			# Check the oldest edit
			$dbr = wfGetDB( DB_SLAVE );
			$lower = $dbr->selectField( 'revision', 'rev_timestamp',
				array( 'rev_user' => $user->getID() ),
				__METHOD__,
				array( 'ORDER BY' => 'rev_timestamp ASC',
					'USE INDEX' => 'user_timestamp' ) );
			# Recursevly check for for an edit $spacing days later, until we are done.
			# The first edit counts, so we have one less scans to do...
			$benchmarks = 0;
			$needed = $wgFlaggedRevsAutopromote['benchmarks'] - 1;
			while( $lower && $benchmarks < $needed ) {
				$lower += $spacing;
				$lower = $dbr->selectField( 'revision', 'rev_timestamp',
					array( "rev_timestamp > {$lower}"),
					array( 'ORDER BY' => 'rev_timestamp ASC',
						'USE INDEX' => 'user_timestamp' ) );
				if( $lower !==false )
					$benchmarks++;
			}
			if( $benchmarks < $needed )
				return true;
		}
		# Add editor rights
		$newGroups = $groups ;
		array_push( $newGroups, 'editor');
		# Lets NOT spam RC, set $RC to false
		$log = new LogPage( 'rights', false );
		$log->addEntry('rights', $user->getUserPage(), wfMsgHtml('makevalidate-autosum'), 
			array( implode(', ',$groups), implode(', ',$newGroups) ) );
		$user->addGroup('editor');
		
		return true;
    }
    
	/**
	* Updates parser cache output to included needed versioning params.
	*/
    public function maybeUpdateMainCache( $article, &$outputDone, &$pcache ) {
    	global $wgUser, $action, $wgFlaggedRevs;
		# Only trigger on article view for content pages, not for protect/delete/hist
		if( $action !='view' || !$wgUser->isAllowed( 'review' ) ) 
			return true;
		if( !$article || !$article->exists() || !$this->isReviewable( $article->mTitle ) ) 
			return true;
		
		$parserCache =& ParserCache::singleton();
    	$parserOut = $parserCache->get( $article, $wgUser );
		if( $parserOut ) {
			# Clear older, incomplete, cached versions
			# We need the IDs of templates and timestamps of images used
			if( !isset($parserOut->mTemplateIds) || !isset($parserOut->mImageSHA1Keys) )
				$article->mTitle->invalidateCache();
		}
		return true;
    }
	
	######### Stub functions, overridden by subclass #########
    
    function pageOverride() { return false; }
    
    function setPageContent( $article, &$outputDone, &$pcache ) {}
    
    function addToEditView( $editform ) {}
    
    function addReviewForm( $out ) {}
    
    function setPermaLink( $sktmp, &$nav_urls, &$revid, &$revid ) {}
    
    function setCurrentTab( $sktmp, &$content_actions ) {}
    
    function addToPageHist( $article ) {}
    
    function addToHistLine( $row, &$s ) {}
    
    function addQuickReview( $id=NULL, $out ) {}
    
	function getLatestQualityRev() {}
    
	function getLatestStableRev() {}
	
	#########
    
}

class FlaggedArticle extends FlaggedRevs {
	/**
	 * Does the config and current URL params allow 
	 * for overriding by stable revisions?
	 */		
    function pageOverride() {
    	global $wgFlaggedRevsAnonOnly, $wgFlaggedRevsOverride, $wgFlaggedRevs,
			$wgTitle, $wgUser, $wgRequest, $action;
    	# This only applies to viewing content pages
    	if( $action !='view' || !$this->isReviewable( $wgTitle ) ) 
			return;
    	# Does not apply to diffs/old revisions
    	if( $wgRequest->getVal('oldid') || $wgRequest->getVal('diff') ) 
			return;
    	# Does the stable version override the current one?
    	if( $wgFlaggedRevsOverride ) {
    		# If $wgFlaggedRevsAnonOnly is set to false, stable version are only requested explicitly
    		if( $wgFlaggedRevsAnonOnly && $wgUser->isAnon() ) {
    			return !( $wgRequest->getIntOrNull('stable')===0 );
    		} else {
    			return ( $wgRequest->getIntOrNull('stable')===1 );
    		}
		} else {
    		return !( $wgRequest->getIntOrNull('stable') !==1 );
		}
	}

	 /**
	 * Replaces a page with the last stable version if possible
	 * Adds stable version status/info tags and notes
	 * Adds a quick review form on the bottom if needed
	 */
	function setPageContent( $article, &$outputDone, &$pcache ) {
		global $wgRequest, $wgTitle, $wgOut, $action, $wgUser, $wgFlaggedRevs;
		// Only trigger on article view for content pages, not for protect/delete/hist
		if( $action !='view' || !$article || !$article->exists() || !$this->isReviewable( $article->mTitle ) ) 
			return true;
		// Grab page and rev ids
		$pageid = $article->getId();
		$revid = $article->mRevision ? $article->mRevision->mId : $article->getLatest();
		if( !$revid ) 
			return true;
			
		$skin = $wgUser->getSkin();
		
		$vis_id = $revid;
		$tag = ''; $notes = '';
		# Check the newest stable version...
		$tfrev = $this->getOverridingRev();
		$simpleTag = false;
		if( $wgRequest->getVal('diff') || $wgRequest->getVal('oldid') ) {
    		// Do not clutter up diffs any further...
		} else if( !is_null($tfrev) ) {
			global $wgLang;
			# Get flags and date
			$flags = $this->getFlagsForRevision( $tfrev->fr_rev_id );
			# Get quality level
			$quality = $this->isQuality( $flags );
			$pristine =  $this->isPristine( $flags );
			$time = $wgLang->date( wfTimestamp(TS_MW, $tfrev->fr_timestamp), true );
			# Looking at some specific old rev or if flagged revs override only for anons
			if( !$this->pageOverride() ) {
				$revs_since = $this->getRevCountSince( $pageid, $tfrev->fr_rev_id );
				$simpleTag = true;
				# Construct some tagging
				if( !$wgOut->isPrintable() ) {
					if( $this->useSimpleUI() ) {
						$msg = $quality ? 'revreview-quick-see-quality' : 'revreview-quick-see-basic';
						$tag .= "<span class='fr_tab_current plainlinks'></span>" . wfMsgExt($msg,array('parseinline'));
						$tag .= $this->prettyRatingBox( $tfrev, $flags, $revs_since, false );
					} else {
						$msg = $quality ? 'revreview-newest-quality' : 'revreview-newest-basic';
						$tag .= wfMsgExt($msg, array('parseinline'), $tfrev->fr_rev_id, $time, $revs_since);
						# Hide clutter
						$tag .= ' <a id="mw-revisiontoggle" style="display:none;" href="javascript:toggleRevRatings()">' . 
							wfMsg('revreview-toggle') . '</a>';
						$tag .= '<span id="mw-revisionratings" style="display:block;">' . 
							wfMsg('revreview-oldrating') . $this->addTagRatings( $flags ) . '</span>';
					}
				}
			// Viewing the page normally: override the page
			} else {
       			# We will be looking at the reviewed revision...
       			$vis_id = $tfrev->fr_rev_id;
       			$revs_since = $this->getRevCountSince( $pageid, $vis_id );
				# Construct some tagging
				if( !$wgOut->isPrintable() ) {
					if( $this->useSimpleUI() ) {
						$msg = $quality ? 'revreview-quick-quality' : 'revreview-quick-basic';
						$css = $quality ? 'fr_tab_quality' : 'fr_tab_stable';
						$tag .= "<span class='$css plainlinks'></span>" . 
							wfMsgExt($msg,array('parseinline'),$tfrev->fr_rev_id,$revs_since);
					 	$tag .= $this->prettyRatingBox( $tfrev, $flags, $revs_since );
					} else {
						$msg = $quality ? 'revreview-quality' : 'revreview-basic';
						$tag = wfMsgExt($msg, array('parseinline'), $vis_id, $time, $revs_since);
						$tag .= ' <a id="mw-revisiontoggle" style="display:none;" href="javascript:toggleRevRatings()">' . 
							wfMsg('revreview-toggle') . '</a>';
						$tag .= '<span id="mw-revisionratings" style="display:block;">' . 
							$this->addTagRatings( $flags ) . '</span>';
					}
				}
				# Try the stable page cache
				$parserOut = $this->getPageCache( $article );
				# If no cache is available, get the text and parse it
				if( $parserOut==false ) {
					$text = $this->getFlaggedRevText( $vis_id );
       				$parserOut = $this->parseStableText( $article, $text, $vis_id );
       				# Update the general cache
       				$this->updatePageCache( $article, $parserOut );
       			}
       			$wgOut->mBodytext = $parserOut->getText();
       			# Show stable categories and interwiki links only
       			$wgOut->mCategoryLinks = array();
       			$wgOut->addCategoryLinks( $parserOut->getCategories() );
       			$wgOut->mLanguageLinks = array();
       			$wgOut->addLanguageLinks( $parserOut->getLanguageLinks() );
				$notes = $this->ReviewNotes( $tfrev );
				# Tell MW that parser output is done
				$outputDone = true;
				$pcache = false;
			}
			# Some checks for which tag CSS to use
			if( $this->useSimpleUI() )
				$tagClass = 'flaggedrevs_short';
			else if( $simpleTag )
				$tagClass = 'flaggedrevs_notice';
			else if( $pristine )
				$tagClass = 'flaggedrevs_tag3';
			else if( $quality )
				$tagClass = 'flaggedrevs_tag2';
			else
				$tagClass = 'flaggedrevs_tag1';
			# Wrap tag contents in a div
			if( $tag !='' )
				$tag = '<div id="mw-revisiontag" class="' . $tagClass . ' plainlinks">'.$tag.'</div>';
			# Set the new body HTML, place a tag on top
			$wgOut->mBodytext = $tag . $wgOut->mBodytext . $notes;
		// Add "no reviewed version" tag, but not for main page
		} else if( !$wgOut->isPrintable() && !$this->isMainPage( $article->mTitle ) ) {
			if( $this->useSimpleUI() ) {
				$tag .= "<span class='fr_tab_current plainlinks'></span>" . 
					wfMsgExt('revreview-quick-none',array('parseinline'));
				$tag = '<div id="mw-revisiontag" class="flaggedrevs_short plainlinks">'.$tag.'</div>';
			} else {
				$tag = '<div id="mw-revisiontag" class="flaggedrevs_notice plainlinks">' .
					wfMsgExt('revreview-noflagged', array('parseinline')) . '</div>';
			}
			$wgOut->addHTML( $tag );
		}
		return true;
    }
    
    function addToEditView( $editform ) {
		global $wgRequest, $wgTitle, $wgOut, $wgFlaggedRevs;
		# Talk pages cannot be validated
		if( !$editform->mArticle || !$this->isReviewable( $wgTitle ) )
			return false;
		# Find out revision id
		if( $editform->mArticle->mRevision ) {
       		$revid = $editform->mArticle->mRevision->mId;
		} else {
       		$revid = $editform->mArticle->getLatest();
       	}
		# Grab the ratings for this revision if any
		if( !$revid ) 
			return true;
		# Set new body html text as that of now
		$tag = '';
		# Check the newest stable version
		$tfrev = $this->getOverridingRev();
		if( is_object($tfrev) ) {
			global $wgLang, $wgUser, $wgFlaggedRevs, $wgFlaggedRevsAutoReview;
			
			$time = $wgLang->date( wfTimestamp(TS_MW, $tfrev->fr_timestamp), true );
			$flags = $this->getFlagsForRevision( $tfrev->fr_rev_id );
			$revs_since = $this->getRevCountSince( $editform->mArticle->getID(), $tfrev->fr_rev_id );
			# Construct some tagging
			$msg = $this->isQuality( $flags ) ? 'revreview-newest-quality' : 'revreview-newest-basic';
			$tag = wfMsgExt($msg, array('parseinline'), $tfrev->fr_rev_id, $time, $revs_since );
			# Hide clutter
			$tag .= ' <a id="mw-revisiontoggle" style="display:none;" href="javascript:toggleRevRatings()">' . 
				wfMsg('revreview-toggle') . '</a>';
			$tag .= '<span id="mw-revisionratings" style="display:block;">' . 
				wfMsg('revreview-oldrating') . $this->addTagRatings( $flags ) . 
				'</span>';
			$wgOut->addHTML( '<div id="mw-revisiontag" class="flaggedrevs_notice plainlinks">' . $tag . '</div>' );
			# If this will be autoreviewed, notify the user...
			if( !$wgFlaggedRevsAutoReview )
				return true;
			if( $wgUser->isAllowed('review') && $revid==$tfrev->fr_rev_id && $revid==$editform->mArticle->getLatest() ) {
				# Grab the flags for this revision
				$flags = $this->getFlagsForRevision( $tfrev->fr_rev_id );
				# Check if user is allowed to renew the stable version.
				# If it has been reviewed too highly for this user, abort.
				foreach( $flags as $quality => $level ) {
					if( !Revisionreview::userCan($quality,$level) ) {
						return true;
					}
				}
				$wgOut->addHTML( '<div id="mw-autoreviewtag" class="flaggedrevs_warning plainlinks">' . 
					wfMsgExt('revreview-auto-w',array('parseinline')) . '</div>' );
			}
		}
		return true;
    }
	
    function addReviewForm( $out ) {
    	global $wgArticle, $wgRequest, $action, $wgFlaggedRevs;

		if( !$wgArticle || !$wgArticle->exists() || !$this->isReviewable( $wgArticle->mTitle ) ) 
			return true;
		# Check if page is protected
		if( $action !='view' || !$wgArticle->mTitle->quickUserCan( 'edit' ) ) {
			return true;
		}
		# Get revision ID
		$revId = $out->mRevisionId ? $out->mRevisionId : $wgArticle->getLatest();
		# We cannot review deleted revisions
		if( is_object($wgArticle->mRevision) && $wgArticle->mRevision->mDeleted ) 
			return true;
    	# Add quick review links IF we did not override, otherwise, they might
		# review a revision that parses out newer templates/images than what they saw.
		# Revisions are always reviewed based on current templates/images.
		if( $this->pageOverride() ) {
			$tfrev = $this->getOverridingRev();
			if( $tfrev ) 
				return true;
		}
		$this->addQuickReview( $revId, $out, $wgRequest->getBool('editreview') );
		
		return true;
    }
    
    function setPermaLink( $sktmp, &$nav_urls, &$revid, &$revid ) {
    	global $wgFlaggedRevs;
		# Non-content pages cannot be validated
		if( !$this->pageOverride() ) 
			return true;
		# Check for an overridabe revision
		$tfrev = $this->getOverridingRev();
		if( !$tfrev ) 
			return true;
		# Replace "permalink" with an actual permanent link
		$nav_urls['permalink'] = array(
			'text' => wfMsg( 'permalink' ),
			'href' => $sktmp->makeSpecialUrl( 'Stableversions', "oldid={$tfrev->fr_rev_id}" )
		);
		
		global $wgHooks;
		# Are we using the popular cite extension?
		if( in_array('wfSpecialCiteNav',$wgHooks['SkinTemplateBuildNavUrlsNav_urlsAfterPermalink']) ) {
			if( $this->isReviewable( $sktmp->mTitle ) && $revid !== 0 ) {
				$nav_urls['cite'] = array(
					'text' => wfMsg( 'cite_article_link' ),
					'href' => $sktmp->makeSpecialUrl( 'Cite', "page=" . wfUrlencode( "{$sktmp->thispage}" ) . "&id={$tfrev->fr_rev_id}" )
				);
			}
		}
		return true;
    }
    
    function setCurrentTab( $sktmp, &$content_actions ) {
    	global $wgRequest, $wgUser, $action, $wgFlaggedRevs, $wgFlaggedRevsAnonOnly, 
			$wgFlaggedRevsOverride, $wgFlaggedRevTabs;
		# Get the subject page, not all skins have it :(
		if( !isset($sktmp->mTitle) )
			return true;
		$title = $sktmp->mTitle->getSubjectPage();
		# Non-content pages cannot be validated
		if( !$this->isReviewable( $title ) || !$title->exists() ) 
			return true;
		$article = new Article( $title );
		# If we are viewing a page normally, and it was overridden,
		# change the edit tab to a "current revision" tab
       	$tfrev = $this->getOverridingRev();
       	# No quality revs? Find the last reviewed one
       	if( !is_object($tfrev) )
			return true;
       	/* 
		// If the stable version is the same is the current, move along...
    	if( $article->getLatest() == $tfrev->fr_rev_id ) {
       		return true;
       	}
       	*/
       	# Be clear about what is being edited...
       	if( !$sktmp->mTitle->isTalkPage() && !($wgFlaggedRevsAnonOnly && !$wgUser->isAnon()) ) {
       		if( isset( $content_actions['edit'] ) )
       			$content_actions['edit']['text'] = wfMsg('revreview-edit');
       		if( isset( $content_actions['viewsource'] ) )
       			$content_actions['viewsource']['text'] = wfMsg('revreview-source');
       	}
       	
     	if( !$wgFlaggedRevTabs ) {
       		return true;
       	}
       	// We are looking at the stable version
       	if( $this->pageOverride() ) {
			$new_actions = array(); $counter = 0;
			# Straighten out order
			foreach( $content_actions as $tab_action => $data ) {
				if( $counter==1 ) {
					# Set the tab AFTER the main tab is set
					if( $wgFlaggedRevsOverride && !($wgFlaggedRevsAnonOnly && !$wgUser->isAnon()) ) {
						$new_actions['current'] = array(
							'class' => '',
							'text' => wfMsg('revreview-current'),
							'href' => $title->getLocalUrl( 'stable=0' )
						);
					} else {
					# Add 'stable' tab if either $wgFlaggedRevsOverride is off, 
					# or this is a user viewing the page with $wgFlaggedRevsAnonOnly on
						$new_actions['stable'] = array(
							'class' => 'selected',
							'text' => wfMsg('revreview-stable'),
							'href' => $title->getLocalUrl( 'stable=1' )
						);
					}
				}
       			$new_actions[$tab_action] = $data;
       			$counter++;
       		}
       		# Reset static array
       		$content_actions = $new_actions;
    	} else if( $action !='view' || $wgRequest->getVal('oldid') || $sktmp->mTitle->isTalkPage() ) {
    	// We are looking at the talk page or diffs/hist/oldids
			$new_actions = array(); $counter = 0;
			# Straighten out order
			foreach( $content_actions as $tab_action => $data ) {
				if( $counter==1 ) {
					# Set the tab AFTER the main tab is set
					if( $wgFlaggedRevsOverride && !($wgFlaggedRevsAnonOnly && !$wgUser->isAnon()) ) {
						$new_actions['current'] = array(
							'class' => '',
							'text' => wfMsg('revreview-current'),
							'href' => $title->getLocalUrl( 'stable=0' )
						);
					} else {
					# Add 'stable' tab if either $wgFlaggedRevsOverride is off, 
					# or this is a user viewing the page with $wgFlaggedRevsAnonOnly on
						$new_actions['stable'] = array(
							'class' => '',
							'text' => wfMsg('revreview-stable'),
							'href' => $title->getLocalUrl( 'stable=1' )
						);
					}
				}
       			$new_actions[$tab_action] = $data;
       			$counter++;
       		}
       		# Reset static array
       		$content_actions = $new_actions;
    	} else if( $wgFlaggedRevTabs ) {
		// We are looking at the current revision
			$new_actions = array(); $counter = 0;
			# Straighten out order
			foreach( $content_actions as $tab_action => $data ) {
				if( $counter==1 ) {
       				# Set the tab AFTER the main tab is set
					if( $wgFlaggedRevsOverride && !($wgFlaggedRevsAnonOnly && !$wgUser->isAnon()) ) {
						$new_actions['current'] = array(
							'class' => 'selected',
							'text' => wfMsg('revreview-current'),
							'href' => $title->getLocalUrl( 'stable=0' )
						);
					} else {
					# Add 'stable' tab if either $wgFlaggedRevsOverride is off, 
					# or this is a user viewing the page with $wgFlaggedRevsAnonOnly on
						$new_actions['stable'] = array(
							'class' => '',
							'text' => wfMsg('revreview-stable'),
							'href' => $title->getLocalUrl( 'stable=1' )
						);
				 	}
				}
       			$new_actions[$tab_action] = $data;
       			$counter++;
       		}
       		# Reset static array
       		$content_actions = $new_actions;
    	}
    	return true;
    }
    
    function addToPageHist( $article ) {
    	global $wgUser;
    
    	$this->pageFlaggedRevs = array();
    	$rows = $this->getReviewedRevs( $article->getTitle() );
    	if( !$rows ) 
			return true;
    	# Try to keep the skin readily accesible; addToHistLine() will use it
    	$this->skin = $wgUser->getSkin();
    	
    	foreach( $rows as $rev => $quality )
    		$this->pageFlaggedRevs[$rev] = $quality;

    	return true;
    }
    
    function addToHistLine( $row, &$s ) {
    	global $wgUser;
    
    	if( isset($this->pageFlaggedRevs) && array_key_exists($row->rev_id,$this->pageFlaggedRevs) ) {
    		$msg = ($this->pageFlaggedRevs[$row->rev_id] >= 1) ? 'hist-quality' : 'hist-stable';
    		$special = SpecialPage::getTitleFor( 'Stableversions' );
    		$s .= ' <tt><small><strong>' . 
				$this->skin->makeLinkObj( $special, wfMsgHtml($msg), 'oldid='.$row->rev_id ) . 
				'</strong></small></tt>';
		}
		
		return true;
    }
    
    function addQuickReview( $id=NULL, $out, $top=false ) {
		global $wgOut, $wgTitle, $wgUser, $wgRequest,
			$wgFlaggedRevsOverride, $wgFlaggedRevComments, $wgFlaggedRevsWatch;
		# User must have review rights
		if( !$wgUser->isAllowed( 'review' ) ) 
			return;
		# Looks ugly when printed
		if( $out->isPrintable() ) 
			return;
		
		$skin = $wgUser->getSkin();
		# If we are reviewing updates to a page, start off with the stable revision's
		# flags. Otherwise, we just fill them in with the selected revision's flags.
		if( $this->isDiffFromStable ) {
			$flags = $this->getFlagsForRevision( $wgRequest->getVal('oldid') );
			# Check if user is allowed to renew the stable version.
			# It may perhaps have been reviewed too highly for this user, if so,
			# then get the flags for the new revision itself.
			foreach( $flags as $quality => $level ) {
				if( !Revisionreview::userCan($quality,$level) ) {
					$flags = $this->getFlagsForRevision( $id );
					break;
				}
			}
		} else {
			$flags = $this->getFlagsForRevision( $id );
		}
       
		$reviewtitle = SpecialPage::getTitleFor( 'Revisionreview' );
		$action = $reviewtitle->escapeLocalUrl( 'action=submit' );
		$form = Xml::openElement( 'form', array( 'method' => 'post', 'action' => $action ) );
		$form .= "<fieldset><legend>" . wfMsgHtml( 'revreview-flag', $id ) . "</legend>\n";
		
		if( $wgFlaggedRevsOverride )
			$form .= '<p>'.wfMsgExt( 'revreview-text', array('parseinline') ).'</p>';
		
		$form .= wfHidden( 'title', $reviewtitle->getPrefixedText() );
		$form .= wfHidden( 'target', $wgTitle->getPrefixedText() );
		$form .= wfHidden( 'oldid', $id );
		$form .= wfHidden( 'action', 'submit');
        $form .= wfHidden( 'wpEditToken', $wgUser->editToken() );
        
		foreach( $this->dimensions as $quality => $levels ) {
			$options = ''; $disabled = '';
			foreach( $levels as $idx => $label ) {
				$selected = ( $flags[$quality]==$idx || $flags[$quality]==0 && $idx==1 ) ? "selected='selected'" : '';
				# Do not show options user's can't set unless that is the status quo
				if( !Revisionreview::userCan($quality, $flags[$quality]) ) {
					$disabled = 'disabled = true';
					$options .= "<option value='$idx' $selected>" . wfMsgHtml("revreview-$label") . "</option>\n";
				} else if( Revisionreview::userCan($quality, $idx) ) {
					$options .= "<option value='$idx' $selected>" . wfMsgHtml("revreview-$label") . "</option>\n";
				}
			}
			$form .= "\n" . wfMsgHtml("revreview-$quality") . ": <select name='wp$quality' $disabled>\n";
			$form .= $options;
			$form .= "</select>\n";
		}
        if( $wgFlaggedRevComments && $wgUser->isAllowed( 'validate' ) ) {
			$form .= "<br/><p>" . wfMsgHtml( 'revreview-notes' ) . "</p>" .
			"<p><textarea tabindex='1' name='wpNotes' id='wpNotes' rows='2' cols='80' style='width:100%'></textarea>" .	
			"</p>\n";
		}
		
		$imageParams = $templateParams = '';
        if( !isset($out->mTemplateIds) || !isset($out->mImageSHA1Keys) ) {
        	return; // something went terribly wrong...
        }
        # Hack, add NS:title -> rev ID mapping
        foreach( $out->mTemplateIds as $namespace => $title ) {
        	foreach( $title as $dbkey => $id ) {
        		$title = Title::makeTitle( $namespace, $dbkey );
        		$templateParams .= $title->getPrefixedText() . "|" . $id . "#";
        	}
        }
        $form .= Xml::hidden( 'templateParams', $templateParams ) . "\n";
        # Hack, image -> timestamp mapping
        foreach( $out->mImageSHA1Keys as $dbkey => $timeAndSHA1 ) {
        	foreach( $timeAndSHA1 as $time => $sha1 ) {
        		$imageParams .= $dbkey . "|" . $time . "|" . $sha1 . "#";
        	}
        }
		$form .= Xml::hidden( 'imageParams', $imageParams ) . "\n";
        
        $watchLabel = wfMsgExt('watchthis', array('parseinline'));
        $watchAttribs = array('accesskey' => wfMsg( 'accesskey-watch' ), 'id' => 'wpWatchthis');
        $watchChecked = ( $wgFlaggedRevsWatch && $wgUser->getOption( 'watchdefault' ) || $wgTitle->userIsWatching() );
       	# Not much to say unless you are a validator
		if( $wgUser->isAllowed( 'validate' ) )
        	$form .= "<p>".wfInputLabel( wfMsgHtml( 'revreview-log' ), 'wpReason', 'wpReason', 60 )."</p>\n";
        
		$form .= "<p>&nbsp;&nbsp;&nbsp;".Xml::check( 'wpWatchthis', $watchChecked, $watchAttribs );
		$form .= "&nbsp;<label for='wpWatchthis'".$skin->tooltipAndAccesskey('watch').">{$watchLabel}</label>";
        
		$form .= '&nbsp;&nbsp;&nbsp;'.Xml::submitButton( wfMsgHtml( 'revreview-submit' ) )."</p></fieldset>";
		$form .= Xml::closeElement( 'form' );
		
		if( $top )
			$out->mBodytext =  $form . '<span style="clear:both"/>' . $out->mBodytext;
		else
			$wgOut->addHTML( '<hr style="clear:both"/>' . $form );
		
    }

	/**
	 * Get latest quality rev, if not, the latest reviewed one
	 * Same params for the sake of inheritance
	 * @returns Row
	 */
	function getOverridingRev( $title = NULL, $getText=false, $forUpdate=false ) {
		global $wgTitle;
		# Get the content page, skip talk
		$title = $wgTitle->getSubjectPage();
		
		if( !$forUpdate ) {
			if( !$row = $this->getLatestQualityRev( $getText ) ) {
				if( !$row = $this->getLatestStableRev( $getText ) ) {
            		$this->stablefound = false;
					return null;
				}
			}
			$this->stablefound = true;
			$this->stablerev = $row;
			return $row;
		}
        # Cached results available?
		if( isset($this->stablefound) ) {
			return ( $this->stablefound ) ? $this->stablerev : null;
		}
		
    	$selectColumns = array('fr_rev_id', 'fr_user', 'fr_timestamp', 'fr_comment', 'rev_timestamp');
    	if( $getText ) {
    		$selectColumns[] = 'fr_text';
    		$selectColumns[] = 'fr_flags';
    	}
    	
		$dbw = wfGetDB( DB_MASTER );
        $result = $dbw->select( array('page', 'flaggedrevs', 'revision'),
			$selectColumns,
			array('page_namespace' => $title->getNamespace(), 'page_title' => $title->getDBkey(),
				'page_ext_stable = fr_rev_id', 'fr_rev_id = rev_id', 
				'rev_deleted & '.Revision::DELETED_TEXT.' = 0'),
			__METHOD__,
			array('LIMIT' => 1) );
		# Do we have one?
        if( $row = $dbw->fetchObject($result) ) {
        	$this->stablefound = true;
			$this->stablerev = $row;
			return $row;
	    } else {
            $this->stablefound = false;    
            return null;
        }
        
		return $row;
	}
    
	/**
	 * Get latest flagged revision that meets requirments
	 * per the $wgFlaggedRevTags variable
	 * This passes rev_deleted revisions
	 * This is based on the current article and caches results
	 * @output array ( rev, flags )
	 */
	function getLatestQualityRev( $getText=false ) {
		global $wgTitle;
		# Get the content page, skip talk
		$title = $wgTitle->getSubjectPage();
        # Cached results available?
		if( isset($this->qualityfound) ) {
			return ( $this->qualityfound ) ? $this->qualityrev : null;
		}
		
    	$selectColumns = array('fr_rev_id', 'fr_user', 'fr_timestamp', 'fr_comment', 'rev_timestamp');
    	if( $getText ) {
    		$selectColumns[] = 'fr_text';
    		$selectColumns[] = 'fr_flags';
    	}
    	
		$dbr = wfGetDB( DB_SLAVE );
        $result = $dbr->select( array('flaggedrevs', 'revision'),
			$selectColumns,
			array('fr_namespace' => $title->getNamespace(), 'fr_title' => $title->getDBkey(), 'fr_quality >= 1',
			'fr_rev_id = rev_id', 'rev_deleted & '.Revision::DELETED_TEXT.' = 0'),
			__METHOD__,
			array('ORDER BY' => 'fr_rev_id DESC', 'LIMIT' => 1 ) );
		
		// Do we have one?
        if( $row = $dbr->fetchObject($result) ) {
        	$this->qualityfound = true;
			$this->qualityrev = $row;
			return $row;
	    } else {
            $this->qualityfound = false;    
            return null;
        }
    }
    
	/**
	 * Get latest flagged revision
	 * This passes rev_deleted revisions
	 * This is based on the current article and caches results
	 * The cache here doesn't make sense for arbitrary articles
	 * @output array ( rev, flags )
	 */
	function getLatestStableRev( $getText=false ) {
		global $wgTitle;
		# Get the content page, skip talk
		$title = $wgTitle->getSubjectPage();
        # Cached results available?
		if( isset($this->latestfound) ) {
			return ( $this->latestfound ) ? $this->latestrev : NULL;
		}
		
    	$selectColumns = array('fr_rev_id', 'fr_user', 'fr_timestamp', 'fr_comment', 'rev_timestamp');
    	if( $getText ) {
    		$selectColumns[] = 'fr_text';
    		$selectColumns[] = 'fr_flags';
    	}
		
		$dbr = wfGetDB( DB_SLAVE );
        $result = $dbr->select( array('flaggedrevs', 'revision'),
			$selectColumns,
			array('fr_namespace' => $title->getNamespace(), 'fr_title' => $title->getDBkey(),
				'fr_rev_id = rev_id', 'rev_page' => $title->getArticleID(), 
				'rev_deleted & '.Revision::DELETED_TEXT.' = 0'),
			__METHOD__,
			array('ORDER BY' => 'fr_rev_id DESC', 'LIMIT' => 1 ) );
		# Do we have one?
        if( $row = $dbr->fetchObject($result) ) {
        	$this->latestfound = true;
			$this->latestrev = $row;
			return $row;
	    } else {
            $this->latestfound = false;    
            return null;
        }
    }
    
	/**
	 * @param int $rev_id
	 * Return an array output of the flags for a given revision
	 */	
    public function getFlagsForRevision( $rev_id ) {
    	global $wgFlaggedRevTags;
    	# Cached results?
    	if( isset($this->flags[$rev_id]) && $this->flags[$rev_id] )
    		return $this->revflags[$rev_id];
    	# Set all flags to zero
    	$flags = array();
    	foreach( array_keys($wgFlaggedRevTags) as $tag ) {
    		$flags[$tag] = 0;
    	}
    	# Grab all the tags for this revision
		$dbr = wfGetDB( DB_SLAVE );
		$result = $dbr->select( 'flaggedrevtags',
			array( 'frt_dimension', 'frt_value' ), 
			array( 'frt_rev_id' => $rev_id ),
			__METHOD__ );
		# Iterate through each tag result
		while( $row = $dbr->fetchObject($result) ) {
			$flags[$row->frt_dimension] = $row->frt_value;
		}
		# Try to cache results
		$this->flags[$rev_id] = true;
		$this->revflags[$rev_id] = $flags;
		
		return $flags;
	}

}



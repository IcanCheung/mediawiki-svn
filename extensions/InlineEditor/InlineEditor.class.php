<?php
/**
 * InlineEditor base class, contains all the basic logic of the editor.
 * It handles hooks through static functions, and they can spawn an InlineEditor object using
 * an article object, and then render like a normal page, or as JSON. Reason for this is to be
 * able to pass this object to different hook functions.
 */
class InlineEditor {
	private static $fallbackReason; /// < reason for not using the editor, used for showing a message
	const REASON_BROWSER  = 1;      /// < reason is an incompatible browser
	const REASON_ADVANCED = 2;      /// < reason is editing an 'advanced' page, whatever that may be

	private $article;               /// < Article object to edit
	private $extendedEditPage;      /// < ExtendedEditPage object we're using to handle editor logic

	/**
	 * Main entry point, hooks into MediaWikiPerformAction.
	 * Checks whether or not to spawn the editor, and does so if necessary.
	 */
	public static function mediaWikiPerformAction( $output, $article, $title, $user, $request, $wiki ) {
		global $wgHooks;

		// check if the editor could be used on this page, and if so, hide the [edit] links
		if ( self::isValidBrowser() && !self::isAdvancedPage( $article, $title ) ) {
			self::hideEditSection( $output );
		}

		// return if the action is not 'edit' or if it's disabled
		if ( $wiki->getAction( $request ) != 'edit' ) {
			return true;
		}

		// check if the 'fulleditor' parameter is set either in GET or POST
		if ( $request->getCheck( 'fulleditor' ) ) {
			// hook into the edit page to inject the hidden 'fulleditor' input field again
			$wgHooks['EditPage::showEditForm:fields'][] = 'InlineEditor::showEditFormFields';
			return true;
		}
		
		// for now, ignore section edits and just edit the whole page
		unset( $_GET['section'] );
		unset( $_POST['section'] );
		$request->setVal( 'section', null );

		// terminate if the browser is not supported
		if ( !self::isValidBrowser() ) {
			self::$fallbackReason = self::REASON_BROWSER;
			return true;
		}

		// terminate if we consider this page 'advanced'
		if ( self::isAdvancedPage( $article, $title ) ) {
			self::$fallbackReason = self::REASON_ADVANCED;
			return true;
		}

		// start the session if needed
		if ( session_id() == '' ) {
			wfSetupSession();
		}
		
		// try to spawn the editor and render the page
		$editor = new InlineEditor( $article );
		if ( $editor->render( $output ) ) {
			return false;
		}
		else {
			// if rendering fails for some reason, terminate and show the advanced page notice
			self::$fallbackReason = self::REASON_ADVANCED;
			return true;
		}
	}

	/**
	 * Hooks into EditPage::showEditForm:initial. Shows a message if there is a fallback reason set.
	 * @param $editPage EditPage
	 */
	public static function showEditForm( &$editPage ) {
		global $wgExtensionAssetsPath, $wgOut, $wgRequest;

		// check for a fallback reason
		if ( isset( self::$fallbackReason ) ) {
			// add the style for fallback message
			$wgOut->addExtensionStyle( $wgExtensionAssetsPath . "/InlineEditor/EditForm.css?0" );

			// show the appropriate message at the top of the page
			switch( self::$fallbackReason ) {
				case self::REASON_BROWSER:
					self::prependFallbackMessage( wfMsgExt( 'inline-editor-redirect-browser', 'parseinline' ) );
					break;
				case self::REASON_ADVANCED:
					self::prependFallbackMessage( wfMsgExt( 'inline-editor-redirect-advanced', 'parseinline' ) );
					break;
			}
		}

		return true;
	}

	/**
	 * Prepends a fallback message at the top of the page.
	 * @param $html string Correct HTML
	 */
	private static function prependFallbackMessage( $html ) {
		global $wgOut;
		$wgOut->prependHTML( '<div class="inlineEditorMessage">' . $html . '</div>' );
	}

	/**
	 * Checks if the browser is supported.
	 * This function is borrowed from EditPage::checkUnicodeCompliantBrowser().
	 */
	private static function isValidBrowser() {
		global $wgInlineEditorBrowserBlacklist;
		if ( empty( $_SERVER["HTTP_USER_AGENT"] ) ) {
			// No User-Agent header sent? Trust it by default...
			return true;
		}
		$currentbrowser = $_SERVER["HTTP_USER_AGENT"];
		foreach ( $wgInlineEditorBrowserBlacklist as $browser ) {
			if ( preg_match( $browser, $currentbrowser ) ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Check if the page is 'advanced'. For now, that means it has to be in an allowed namespace.
	 * @param $article Article
	 * @param $title Title
	 * @return bool
	 */
	private static function isAdvancedPage( &$article, &$title ) {
		global $wgInlineEditorAllowedNamespaces;
		if ( !empty( $wgInlineEditorAllowedNamespaces )
			&& !in_array( $title->getNamespace(), $wgInlineEditorAllowedNamespaces ) ) {
				return true;
		}
		return false;
	}

	/**
	 * Entry point for the 'Preview' function through ajax.
	 * No real point in securing this, as nothing is actually saved.
	 * @param $json string JSON object from the client
	 * @param $pageName string The page we're editing
	 * @return string HTML
	 */
	public static function ajaxPreview( $json, $pageName ) {
		$title   = Title::newFromText( $pageName );
		$article = Article::newFromId( $title->getArticleId() );

		$editor = new InlineEditor( $article );
		return $editor->preview( $json );
	}

	/**
	 * Hide the [edit] links on the page by enabling a piece of CSS (instead of screwing with the parser cache).
	 * @param $output OutputPage
	 */
	public static function hideEditSection( &$output ) {
		global $wgExtensionAssetsPath;
		$output->addExtensionStyle( $wgExtensionAssetsPath . "/InlineEditor/HideEditSection.css?0" );
	}

	/**
	 * Add a 'fulleditor' hidden input field to the normal edit page
	 * @param $editpage EditPage
	 * @param $output OutputPage
	 */
	public static function showEditFormFields( &$editpage, &$output ) {
		$output->addHTML(
			HTML::rawElement( 'input', array( 'name' => 'fulleditor', 'type' => 'hidden', 'value' => '1' ) )
		);
		return true;
	}

	/**
	 * Constructor which takes only an Article object
	 * @param $article Article
	 */
	public function __construct( $article ) {
		$this->article = $article;
	}

	/**
	 * Render the editor.
	 * Spawns an ExtendedEditPage which is an EditPage with some specific logic for this editor.
	 * This is supplied with wikitext generated using InlineEditorText, from the posted JSON.
	 * If the page is being saved, the ExtendedEditPage will terminate the script itself, else
	 * the editing interface will show as usual.
	 * @param $output OutputPage
	 */
	public function render( &$output ) {
		global $wgParser, $wgHooks, $wgRequest, $wgExtensionAssetsPath;

		// if the page is being saved, retrieve the wikitext from the JSON
		if ( $wgRequest->wasPosted() ) {
			$request = FormatJson::decode( $wgRequest->getVal( 'json' ), true );
			$request['object'] = $_SESSION['inline-editor-object-' . $request['object']];
			$text = InlineEditorText::restoreObject( $request, $this->article );
			$wgRequest->setVal( 'wpTextbox1', $text->getWikiOriginal() );
		}
		else {
			// create an InlineEditorText object which generates the HTML and JSON for the editor
			$text = new InlineEditorText( $this->article );
		}

		// try to initialise, or else return false, which will spawn an 'advanced page' notice
		$this->extendedEditPage = new ExtendedEditPage( $this->article );
		if ( $this->extendedEditPage->initInlineEditor() ) {
			// IMPORTANT: if the page was being saved, the script has been terminated by now!!

			// include the required JS and CSS files
			$output->includeJQuery();
			$output->addScriptFile( $wgExtensionAssetsPath . "/InlineEditor/jquery.elastic.js?0" );
			$output->addScriptFile( $wgExtensionAssetsPath . "/InlineEditor/jquery.inlineEditor.js?0" );
			$output->addScriptFile( $wgExtensionAssetsPath . "/InlineEditor/jquery.inlineEditor.basicEditor.js?0" );
			$output->addScriptFile( $wgExtensionAssetsPath . "/InlineEditor/jquery-ui-effects-1.8.4.min.js?0" );
			$output->addExtensionStyle( $wgExtensionAssetsPath . "/InlineEditor/InlineEditor.css?0" );
			$output->addExtensionStyle( $wgExtensionAssetsPath . "/InlineEditor/BasicEditor.css?0" );

			// have the different kind of editors register themselves
			wfRunHooks( 'InlineEditorDefineEditors', array( &$this, &$output ) );

			// load the wikitext into the InlineEditorText object
			$text->loadFromWikiText( $this->extendedEditPage->getWikiText() );

			// add a large <div> around the marked wikitext to denote the editing position
			$parserOutput = $text->getFullParserOutput();
			$parserOutput->setText( '<div id="editContent">' . $parserOutput->getText() . '</div>' );
			
			// put the marked output into the page
			$output->addParserOutput( $parserOutput );
			$output->setPageTitle( $parserOutput->getTitleText() );
			
			// convert the text object into an initial state to send
			$initial = InlineEditorText::initialState( $text );
			
			// store the actual object in the session, as it can be quite large 
			$objectID = (isset($_SESSION['inline-editor-id']) ? $_SESSION['inline-editor-id'] + 1 : 0);
			$_SESSION['inline-editor-id'] = $objectID;
			$_SESSION['inline-editor-object-' . $objectID] = $initial['object'];
			$initial['object'] = $objectID;
			
			// add the initial JSON state in Javascript, and then initialise the editor
			$initialJSON = FormatJson::encode( $initial );
			$output->addInlineScript(
				'jQuery( document ).ready( function() {
					jQuery.inlineEditor.addInitialState( ' . $initialJSON . ' );
					jQuery.inlineEditor.init();
				} );'
			);

			// hook into SiteNoticeBefore to display the two boxes above the title
			// @todo: fix this in core, make sure that anything can be inserted above the title, outside #siteNotice
			$wgHooks['SiteNoticeBefore'][]  = array( $this, 'siteNoticeBefore' );
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Get the Article being edited
	 * @return Article
	 */
	public function getArticle() {
		return $this->article;
	}

	/**
	 * Pass JSON into an InlineEditorText object and return combined JSON (HTML + sentence representation)
	 * @param $json string
	 * @return string
	 */
	public function preview ( $json ) {
		// decode the JSON
		$request = FormatJson::decode( $json, true );
		
		// add the actual object from session, as it's quite big
		$request['object'] = $_SESSION['inline-editor-object-' . $request['object']];
		
		// load the JSON to a text object and perform the edit
		$text = InlineEditorText::restoreObject( $request, $this->article );
		$text->doEdit( $request['lastEdit']['id'], $request['lastEdit']['text'] );
		
		// get the next state
		$subseq = InlineEditorText::subsequentState( $text );
		
		// save the object to a new unique key in the session
		$objectID = (isset($_SESSION['inline-editor-id']) ? $_SESSION['inline-editor-id'] + 1 : 0);
		$_SESSION['inline-editor-id'] = $objectID;
		$_SESSION['inline-editor-object-' . $objectID] = $subseq['object'];
		$subseq['object'] = $objectID;
		
		// send back the JSON
		return FormatJson::encode( $subseq );
	}

	/**
	 * Hooks into SiteNoticeBefore. Renders the edit interface above the title of the page.
	 * @param $siteNotice string
	 */
	public function siteNoticeBefore( &$siteNotice ) {
		$siteNotice = $this->renderEditBox();
		return false;
	}

	/**
	 * Generates "Edit box" (the first one)
	 * This looks like this:
	 * <div class="editbox">
	 *   inline-editor-editbox-top
	 *   <hr/>
	 *
	 *   inline-editor-editbox-changes-question
	 *   <input class="summary" name="summary" />
	 *   <div class="example">inline-editor-editbox-changes-example</div>
	 *   <hr/>
	 *
	 *   <div class="side">
	 *     inline-editor-editbox-publish-notice
	 *     <div class="terms">inline-editor-editbox-publish-terms</div>
	 *   </div>
	 *   <a id="publish">inline-editor-editbox-publish-caption</a>
	 * </div>
	 *   
	 * @return string HTML
	 */
	private function renderEditBox() {
		$top  = wfMsgExt( 'inline-editor-editbox-top', 'parseinline' );
		$top .= '<hr/>';

		$summary  = wfMsgExt( 'inline-editor-editbox-changes-question', 'parseinline' );
		$summary .= Html::input( 'wpSummary', $this->extendedEditPage->getSummary(),
			'text', array( 'class' => 'summary', 'maxlength' => 250 ) );
		$summary .= Html::rawElement( 'div', array( 'class' => 'example' ),
			wfMsgExt( 'inline-editor-editbox-changes-example', 'parseinline' ) );
		$summary .= '<hr/>';

		$terms    = Html::rawElement( 'div', array( 'class' => 'terms' ),
			// @todo FIXME: Create a link to content language copyrightpage with plain content
			//              link description.
			wfMsgExt( 'inline-editor-editbox-publish-terms', 'parseinline', '[[' . wfMsgForContent( 'copyrightpage' ) . ']]' ) );
		$publish  = Html::rawElement( 'div', array( 'class' => 'side' ),
			wfMsgExt( 'inline-editor-editbox-publish-notice', 'parseinline' ) . $terms );
		$publish .= Html::rawElement( 'a', array( 'id' => 'publish', 'href' => '#' ),
			wfMsgExt( 'inline-editor-editbox-publish-caption', 'parseinline' ) );
		$publish .= HTML::rawElement( 'input', array( 'id' => 'json', 'name' => 'json', 'type' => 'hidden' ) );

		$form = Html::rawElement( 'form', array(
			'id' => 'editForm',
			'method' => 'POST',
			'action' => $this->extendedEditPage->getSubmitUrl() ), $top . $summary . $publish );


		return Html::rawElement( 'div', array( 'class' => 'editbox' ), $form );
	}

	/**
	 * Make sure the entire page rerenders when rendering a reference.
	 * 
	 * @todo: FIXME: This should be moved over to the Cite extension, and something like this should
	 * be included in other extensions as well. In the future, something smarter should be
	 * implemented, to be able to only rerender the dependencies and not the entire page.
	 *  
	 * @param $markedWiki string
	 * @return bool
	 */
	public static function partialRenderCite( $markedWiki ) {
		return true;
		/*return ( preg_match( '/<ref[^\/]*?>.*?<\/ref>|<ref.*?\/>/is', $markedWiki) <= 0) ;*/
	}
}

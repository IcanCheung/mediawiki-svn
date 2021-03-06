<?php
/**
 * Displays a pre-defined form that a user can run a query with.
 *
 * @author Yaron Koren
 * @file
 * @ingroup SF
 */

/**
 * @ingroup SFSpecialPages
 */
class SFRunQuery extends IncludableSpecialPage {

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct( 'RunQuery' );
		SFUtils::loadMessages();
	}

	function execute( $query ) {
		global $wgRequest;

		if ( !$this->including() ) {
			$this->setHeaders();
		}
		$form_name = $this->including() ? $query : $wgRequest->getVal( 'form', $query );

		$this->printPage( $form_name, $this->including() );
	}

	function printPage( $form_name, $embedded = false ) {
		global $wgOut, $wgRequest, $sfgFormPrinter, $wgParser, $sfgRunQueryFormAtTop;

		// Get contents of form-definition page.
		$form_title = Title::makeTitleSafe( SF_NS_FORM, $form_name );

		if ( !$form_title || !$form_title->exists() ) {
			if ( $form_name === '' ) {
				$text = Xml::element( 'p', array( 'class' => 'error' ), wfMsg( 'sf_runquery_badurl' ) ) . "\n";
			} else {
				$text = Xml::tags( 'p', array( 'class' => 'error' ),
					wfMsg( 'sf_formstart_badform', SFUtils::linkText( SF_NS_FORM, $form_name ) ) ) . "\n";
			}
			$wgOut->addHTML( $text );
			return;
		}

		// Initialize variables.
		$form_article = new Article( $form_title, 0 );
		$form_definition = $form_article->getContent();
		$submit_url = $form_title->getLocalURL( 'action=submit' );
		if ( $embedded ) {
			$run_query = false;
			$content = null;
			$raw = false;
		} else {
			$run_query = $wgRequest->getCheck( 'wpRunQuery' );
			$content = $wgRequest->getVal( 'wpTextbox1' );
			$raw = $wgRequest->getBool( 'raw', false );
		}
		$form_submitted = ( $run_query );
		if ( $raw ) {
			$wgOut->setArticleBodyOnly( true );
		}
		// If user already made some action, ignore the edited
		// page and just get data from the query string.
		if ( !$embedded && $wgRequest->getVal( 'query' ) == 'true' ) {
			$edit_content = null;
			$is_text_source = false;
		} elseif ( $content != null ) {
			$edit_content = $content;
			$is_text_source = true;
		} else {
			$edit_content = null;
			$is_text_source = true;
		}
		list ( $form_text, $javascript_text, $data_text, $form_page_title ) =
			$sfgFormPrinter->formHTML( $form_definition, $form_submitted, $is_text_source, $form_article->getID(), $edit_content, null, null, true, $embedded );
		$text = "";

		if ( $form_submitted ) {
			global $wgUser, $wgTitle, $wgOut;
			$wgParser->mOptions = ParserOptions::newFromUser( $wgUser );
			// @TODO - fix RunQuery's parsing so that this check
			// isn't needed.
			if ( $wgParser->getOutput() == null ) {
				$headItems = array();
			// method was added in MW 1.16
			} elseif ( method_exists( $wgParser->getOutput(), 'getHeadItems' ) ) {
				$headItems = $wgParser->getOutput()->getHeadItems();
			} else {
				$headItems = $wgParser->getOutput()->mHeadItems;
			}
			foreach ( $headItems as $key => $item ) {
				$wgOut->addHeadItem( $key, "\t\t" . $item . "\n" );
			}
		}

		// Get the text of the results.
		$resultsText = '';
		if ( $form_submitted ) {
			$resultsText = $wgParser->parse( $data_text, $wgTitle, $wgParser->mOptions )->getText();
		}

		// Get the full text of the form.
		$fullFormText = '';
		$additionalQueryHeader = '';
		$dividerText = '';
		if ( !$raw ) {
			// Create the "additional query" header, and the
			// divider text - one of these (depending on whether
			// the query form is at the top or bottom) is displayed
			// if the form has already been submitted.
			if ( $form_submitted ) {
				$additionalQueryHeader = "\n" . Xml::element( 'h2', null, wfMsg( 'sf_runquery_additionalquery' ) ) . "\n";
				$dividerText = "\n<hr style=\"margin: 15px 0;\" />\n";
			}
			$action = htmlspecialchars( $this->getTitle( $form_name )->getLocalURL() );
			$fullFormText .= <<<END
	<form id="sfForm" name="createbox" action="$action" method="post" class="createbox">

END;
			$fullFormText .= SFFormUtils::hiddenFieldHTML( 'query', 'true' );
			$fullFormText .= $form_text;
		}

		// Either display the query form at the top, and the results at
		// the bottom, or the other way around, depending on the
		// settings - the display is slightly different in each case.
		if ( $sfgRunQueryFormAtTop ) {
			$text .= $fullFormText;
			$text .= $dividerText;
			$text .= $resultsText;
		} else {
			$text .= $resultsText;
			$text .= $additionalQueryHeader;
			$text .= $fullFormText;
		}

		if ( $embedded ) {
			$text = "<div class='runQueryEmbedded'>$text</div>";
		}

		// Armor against doBlockLevels()
		$text = preg_replace( '/^ +/m', '', $text );
		// Now write everything to the screen.
		$wgOut->addHTML( $text );
		SFUtils::addJavascriptAndCSS( $embedded ? $wgParser : null );
		$script = "\t\t" . '<script type="text/javascript">' . "\n" . $javascript_text . '</script>' . "\n";
		if ( $embedded ) {
			$wgParser->getOutput()->addHeadItem( $script );
		} else {
			$wgOut->addScript( $script );
			$po = $wgParser->getOutput();
			if ( $po ) {
				$wgOut->addParserOutputNoText( $po );
			}
		}

		// Finally, set the page title - for MW <= 1.16, this has to be
		// called after addParserOutputNoText() for it to take effect.
		if ( !$embedded ) {
			if ( $form_page_title != null ) {
				$wgOut->setPageTitle( $form_page_title );
			} else {
				$s = wfMsg( 'sf_runquery_title', $form_title->getText() );
				$wgOut->setPageTitle( $s );
			}
		}
	}
}

<?php

/**
 * This special page (Special:ExportRDF) for MediaWiki implements an OWL-export of semantic data,
 * gathered both from the annotations in articles, and from metadata already
 * present in the database.
 *
 * @ingroup SMWSpecialPage
 * @ingroup SpecialPage
 *
 * @author Markus Krötzsch
 * @author Jeroen De Dauw
 */
class SMWSpecialOWLExport extends SpecialPage {
	
	/// Export controller object to be used for serializing data
	protected $export_controller;

	public function __construct() {
		parent::__construct( 'ExportRDF' );
		smwfLoadExtensionMessages( 'SemanticMediaWiki' );
	}

	public function execute( $page ) {
		global $wgOut, $wgRequest;
		$wgOut->setPageTitle( wfMsg( 'exportrdf' ) );
		
		// see if we can find something to export:
		$page = ( $page == '' ) ? $wgRequest->getVal( 'page' ) : rawurldecode( $page );
		if ( $page == '' ) { // Try to get POST list; some settings are only available via POST.
			$pageblob = $wgRequest->getText( 'pages' );
			if ( $pageblob != '' ) {
				$pages = explode( "\n", $pageblob );
			}
		} else {
			$pages = array( $page );
		}

		if ( isset( $pages ) ) {
			$this->exportPages( $pages );
			return;
		} else {
			$offset = $wgRequest->getVal( 'offset' );
			if ( isset( $offset ) ) {
				$this->startRDFExport();				 
				$this->export_controller->printPageList( $offset );
				return;
			} else {
				$stats = $wgRequest->getVal( 'stats' );
				if ( isset( $stats ) ) {
					$this->startRDFExport();
					$this->export_controller->printWikiInfo();
					return;
				}
			}
		}
		// nothing exported yet; show user interface:
		$this->showForm();
	}

	/**
	 * Create the HTML user interface for this special page.
	 */
	protected function showForm() {
		global $wgOut, $wgUser, $smwgAllowRecursiveExport, $smwgExportBacklinks, $smwgExportAll;

		$html = '<form name="tripleSearch" action="" method="POST">' . "\n" .
                '<p>' . wfMsg( 'smw_exportrdf_docu' ) . "</p>\n" .
                '<input type="hidden" name="postform" value="1"/>' . "\n" .
                '<textarea name="pages" cols="40" rows="10"></textarea><br />' . "\n";
		
		if ( $wgUser->isAllowed( 'delete' ) || $smwgAllowRecursiveExport ) {
			$html .= '<input type="checkbox" name="recursive" value="1" id="rec">&#160;<label for="rec">' . wfMsg( 'smw_exportrdf_recursive' ) . '</label></input><br />' . "\n";
		}
		if ( $wgUser->isAllowed( 'delete' ) || $smwgExportBacklinks ) {
			$html .= '<input type="checkbox" name="backlinks" value="1" default="true" id="bl">&#160;<label for="bl">' . wfMsg( 'smw_exportrdf_backlinks' ) . '</label></input><br />' . "\n";
		}
		if ( $wgUser->isAllowed( 'delete' ) || $smwgExportAll ) {
			$html .= '<br />';
			$html .= '<input type="text" name="date" value="' . date( DATE_W3C, mktime( 0, 0, 0, 1, 1, 2000 ) ) . '" id="date">&#160;<label for="ea">' . wfMsg( 'smw_exportrdf_lastdate' ) . '</label></input><br />' . "\n";
		}
		$html .= '<br /><input type="submit"  value="' . wfMsg( 'smw_exportrdf_submit' ) . "\"/>\n</form>";
		
		$wgOut->addHTML( $html );
	}
	
	/**
	 * Prepare $wgOut for printing non-HTML data.
	 */
	protected function startRDFExport() {
		global $wgOut, $wgRequest;
		$syntax = $wgRequest->getText( 'syntax' );
		if ( $syntax == '' ) $syntax = $wgRequest->getVal( 'syntax' );
		$wgOut->disable();
		ob_start();
		if ( $syntax == 'turtle' ) {
			$mimetype = 'application/x-turtle'; // may change to 'text/turtle' at some time, watch Turtle development
			$serializer = new SMWTurtleSerializer();
		} else { // rdfxml as default
			// Only use rdf+xml mimetype if explicitly requested (browsers do
			// not support it by default).
			// We do not add this parameter to RDF links within the export
			// though; it is only meant to help some tools to see that HTML
			// included resources are RDF (from there on they should be fine).
			$mimetype = ( $wgRequest->getVal( 'xmlmime' ) == 'rdf' ) ? 'application/rdf+xml' : 'application/xml';
			$serializer = new SMWRDFXMLSerializer();
		}
		header( "Content-type: $mimetype; charset=UTF-8" );
		$this->export_controller = new SMWExportController( $serializer );
	}
	
	/**
	 * Export the given pages to RDF.
	 * @param array $pages containing the string names of pages to be exported
	 */
	protected function exportPages( $pages ) {
		global $wgRequest, $smwgExportBacklinks, $wgUser, $smwgAllowRecursiveExport;

		// Effect: assume "no" from missing parameters generated by checkboxes.
		$postform = $wgRequest->getText( 'postform' ) == 1;

		$recursive = 0;  // default, no recursion
		$rec = $wgRequest->getText( 'recursive' );
		if ( $rec == '' ) $rec = $wgRequest->getVal( 'recursive' );
		if ( ( $rec == '1' ) && ( $smwgAllowRecursiveExport || $wgUser->isAllowed( 'delete' ) ) ) {
			$recursive = 1; // users may be allowed to switch it on
		}

		$backlinks = $smwgExportBacklinks; // default
		$bl = $wgRequest->getText( 'backlinks' );
		if ( $bl == '' ) $bl = $wgRequest->getVal( 'backlinks' );
		if ( ( $bl == '1' ) && ( $wgUser->isAllowed( 'delete' ) ) ) {
			$backlinks = true; // admins can always switch on backlinks
		} elseif ( ( $bl == '0' ) || ( '' == $bl && $postform ) ) {
			$backlinks = false; // everybody can explicitly switch off backlinks
		}

		$date = $wgRequest->getText( 'date' );
		if ( $date == '' ) $date = $wgRequest->getVal( 'date' );
		if ( $date != '' ) {
			$timeint = strtotime( $date );
			$stamp = date( "YmdHis", $timeint );
			$date = $stamp;
		}

		$this->startRDFExport();
		$this->export_controller->enableBacklinks( $backlinks );
		$this->export_controller->printPages( $pages, $recursive, $date );
	}

}

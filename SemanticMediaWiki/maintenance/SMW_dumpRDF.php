<?php

/**
 * Usage:
 * php SMW_dumpRDF.php [options...]
 *
 * -o <filename>  output file, stdout is used if omitted; 
 *                file output is generally better and strongly recommended for large wikis
 * --categories   only do categories
 * --properties   only do properties
 * --types        only do types
 * --individuals  only do pages that are no categories, properties, or types
 */

$optionsWithArgs = array( 'o' ); // -o <output file>

require_once( 'commandLine.inc' );
require_once( "$IP/extensions/SemanticMediaWiki/specials/ExportRDF/SMW_SpecialExportRDF.php");

if ( !empty( $options['o'] ) ) {
	$outfile = $options['o'];
} else {
	$outfile = false;
}

if ( $options['categories'] ) {
	$export_ns = NS_CATEGORY;
} elseif ( $options['properties'] ) {
	$export_ns = SMW_NS_PROPERTY;
} elseif ( $options['types'] ) {
	$export_ns = SMW_NS_TYPE;
} elseif ( $options['individuals'] ) {
	$export_ns = -1;
} else {
	$export_ns = false;
}

$exRDF = new ExportRDF();
$exRDF->printAll($outfile, $export_ns);


/**
 * Creates an es.ParagraphModel object.
 * 
 * @class
 * @constructor
 */
es.ParagraphModel = function( length ) {
	// Inheritance
	es.DocumentModelNode.call( this, length );
};

/* Inheritance */

es.extend( es.ParagraphModel, es.DocumentModelNode );

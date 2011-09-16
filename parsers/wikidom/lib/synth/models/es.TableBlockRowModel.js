/**
 * Creates an es.TableBlockRowModel object.
 * 
 * @class
 * @constructor
 * @param items {Array}
 * @param attributes {Object}
 * @property items {Array}
 * @property attributes {Object}
 */
es.TableBlockRowModel = function( items, attributes ) {
	es.ModelContainerItem.call( this );
	es.ModelContainer.call( this );
	
	if ( $.isArray( items ) ) {
		for ( var i = 0; i < items.length; i++ ) {
			this.append( items[i] );
		}
	}

	this.attributes = attributes || {};
};

/**
 * Creates an TableBlockRowModel object from a plain object.
 * 
 * @method
 * @static
 * @param obj {Object}
 */
es.TableBlockRowModel.newFromPlainObject = function( obj ) {
	return new es.TableBlockRowModel(
		// Cells - if given, convert plain cell objects to es.TableBlockCellModel objects
		!$.isArray( obj.cells ) ? [] : $.map( obj.cells, function( cell ) {
			return !$.isPlainObject( cell ) ? null
				: es.TableBlockCellModel.newFromPlainObject( cell )
		} ),
		// Attributes - if given, make a deep copy of attributes
		!$.isPlainObject( obj.attributes ) ? {} : $.extend( true, {}, obj.attributes )
	);
};

/* Methods */

/**
 * Creates a view for this model
 */
es.TableBlockRowModel.prototype.createView = function() {
	return new es.TableBlockRowView( this );
};

/**
 * Gets the length of all content.
 * 
 * @method
 * @returns {Integer} Length of all content
 */
es.TableBlockRowModel.prototype.getContentLength = function() {
	return this.items.getContentLength();
};

/**
 * Gets a plain table row object.
 * 
 * @method
 * @returns obj {Object}
 */
es.TableBlockRowModel.prototype.getPlainObject = function() {
	/*
	var obj = {};
	if ( this.items.length ) {
		obj.cells = $.map( this.items, function( item ) {
			return item.getPlainObject();
		} );
	}
	if ( !$.isEmptyObject( this.attributes ) ) {
		obj.attributes = $.extend( true, {}, this.attributes );
	}
	return obj;
	*/
};

/* Inheritance */

es.extend( es.TableBlockRowModel, es.ModelContainerItem );
es.extend( es.TableBlockRowModel, es.ModelContainer );

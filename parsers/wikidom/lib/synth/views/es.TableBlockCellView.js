/**
 * Creates an es.TableBlockCellView object.
 * 
 * @class
 * @extends {es.ViewListItem}
 * @constructor
 */
es.TableBlockCellView = function( model ) {
	es.ViewList.call( this, model, $( '<td>' ) );
	es.ViewListItem.call( this, model, this.$ );
	this.$.attr( this.model.attributes );
};

/* Methods */

/**
 * Gets the offset of a position.
 * 
 * @method
 * @param position {es.Position} Position to translate
 * @returns {Integer} Offset nearest to position
 */
es.TableBlockCellView.prototype.getOffsetFromPosition = function( position ) {
	if ( this.items.length === 0 ) {
		return 0;
	}
	
	var blockView = this.items[0];

	for ( var i = 0; i < this.items.length; i++ ) {
		if ( this.items[i].$.offset().top >= position.top ) {
			break;
		}
		blockView = this.items[i];
	}
	
	return blockView.list.items.offsetOf( blockView ) + blockView.getOffsetFromPosition( position );
};

/**
 * Gets length of contents.
 * 
 * @method
 * @returns {Integer} Length of content, including any virtual spaces within the block
 */
es.TableBlockCellView.prototype.getLength = function() {
	return this.items.getLengthOfItems();
};

/**
 * Render content.
 * 
 * @method
 */
es.TableBlockCellView.prototype.renderContent = function() {
	for ( var i = 0; i < this.items.length; i++ ) {
		this.items[i].renderContent();
	}
};

/**
 * Gets offset within content of position.
 * 
 * @method
 * @param position {es.Position} Position to get offset for
 * @returns {Integer} Offset nearest to position
 */
es.TableBlockCellView.prototype.getContentOffset = function( position ) {
	// TODO
};

/**
 * Gets rendered position of offset within content.
 * 
 * @method
 * @param offset {Integer} Offset to get position for
 * @returns {es.Position} Position of offset
 */
es.TableBlockCellView.prototype.getRenderedPosition = function( offset ) {
	// TODO
};

/**
 * Draw selection around a given range.
 * 
 * @method
 * @param range {es.Range} Range of content to draw selection around
 */
es.TableBlockCellView.prototype.drawSelection = function( range ) {
	var selectedViews = this.items.select( range );
	for ( var i = 0; i < selectedViews.length; i++ ) {
		selectedViews[i].item.drawSelection(
			new es.Range( selectedViews[i].from, selectedViews[i].to )
		);
	}
};



/**
 * Gets HTML rendering of block.
 * 
 * @method
 * @param options {Object} List of options, see es.DocumentView.getHtml for details
 * @returns {String} HTML data
 */
es.TableBlockCellView.prototype.getHtml = function( options ) {
	return es.Html.makeTag( 'td', this.model.attributes, this.documentView.getHtml() );
}

/* Inheritance */

es.extend( es.TableBlockCellView, es.ViewListItem );
es.extend( es.TableBlockCellView, es.ViewList );
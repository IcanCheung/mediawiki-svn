/* Classes */

/**
 * Content objects are wrappers around arrays of plain or annotated characters. Data in this form
 * is ultimately equivalent to but more efficient to work with than WikiDom line objects (plain text
 * paired with offset annotation), especially when performing substring operations. Content can be
 * derived from or converted to one or more WikiDom line objects.
 * 
 * @param content {Array} List of plain or annotated characters
 * @returns {Content}
 */
function Content( content ) {
	this.data = content || [];
};

/* Static Methods */

/**
 * Recursively compares string and number property between two objects.
 * 
 * A false result may be caused by property inequality or by properties in one object missing from
 * the other. An asymmetrical test may also be performed, which checks only that properties in the
 * first object are present in the second object, but not the inverse.
 * 
 * @param a {Object} First object to compare
 * @param b {Object} Second object to compare
 * @param asymmetrical {Boolean} Whether to check only that b contains values from a
 * @return {Boolean} If the objects contain the same values as each other
 */
Content.compareObjects = function( a, b, asymmetrical ) {
	var aValue, bValue, aType, bType;
	for ( var k in a ) {
		aValue = a[k];
		bValue = b[k];
		aType = typeof aValue;
		bType = typeof bValue;
		if ( aType !== bType
				|| ( ( aType === 'string' || aType === 'number' ) && aValue !== bValue )
				|| ( $.isPlainObject( aValue ) && !Content.compareObjects( aValue, bValue ) ) ) {
			return false
		}
	}
	// If the check is not asymmetrical, recursing with the arguments swapped will verify our result
	return asymmetrical ? true : Content.compareObjects( b, a, true );
};

/**
 * Gets a recursive copy of an object's string, number and plain-object property.
 * 
 * @param source {Object} Object to copy
 * @return {Object} Copy of source object
 */
Content.copyObject = function( source ) {
	var destination = {};
	for ( var key in source ) {
		sourceValue = source[key];
		sourceType = typeof sourceValue;
		if ( sourceType === 'string' || sourceType === 'number' ) {
			destination[key] = sourceValue;
		} else if ( $.isPlainObject( sourceValue ) ) {
			destination[key] = Content.copyObject( sourceValue );
		}
	}
	return destination;
};

/**
 * Gets content data from a WikiDom line object, which uses a series of offset-based annotations to
 * supplement plain text.
 * 
 * @param line {Object} WikiDom compatible line object, containing text and optionally annotations
 * properties, the latter of which being an array of annotation objects including range information
 * @return {Array} List of plain or annotated characters
 */
Content.convertLine = function( line ) {
	// Convert string to array of characters
	var data = line.text.split('');
	for ( var i in line.annotations ) {
		var src = line.annotations[i];
		// Build simplified annotation object
		var dst = { 'type': src.type };
		if ( 'data' in src ) {
			dst.data = Content.copyObject( src.data );
		}
		// Apply annotation to range
		for ( var k = src.range.start; k < src.range.end; k++ ) {
			// Auto-convert to array
			typeof data[k] === 'string' && ( data[k] = [data[k]] );
			// Append 
			data[k].push( dst );
		}
	}
	return data;
};

/**
 * Creates a new Content object from a WikiDom line object.
 * 
 * @param line {Object} WikiDom compatible line object - @see Content.convertLine
 * @return {Content} New content object containing data derived from the WikiDom line
 */
Content.newFromLine = function( line ) {
	return new Content( Content.convertLine( line ) );
};

/**
 * Creates a new Content object from a list of WikiDom line objects.
 * 
 * This plural version of Content.newFromLine inserts non-annotated new line characters between
 * lines, preserving the divisions between the original line objects. When Content objects are
 * converted to WikiDom line objects, these new line characters are used to split the content data
 * into multiple line objects, thus making a clean round trip possible.
 * 
 * @param line {Array} List of WikiDom compatible line objects - @see Content.convertLine
 * @return {Content} New content object containing data derived from the WikiDom line
 */
Content.newFromLines = function( lines ) {
	var data = [];
	for ( var i = 0; i < lines.length; i++ ) {
		data = data.concat( Content.convertLine( lines[i] ) );
		if ( i < lines.length - 1 ) {
			data.push( '\n' );
		}
	}
	return new Content( data );
};

/**
 * Gets plain text version of the content within a specific range.
 * 
 * @param start {Integer} Optional beginning of range, if omitted range will begin at 0
 * @param end {Integer} Optional end of range, if omitted range will end a this.data.length
 * @return {String} Plain text within given range
 */
Content.prototype.substring = function( start, end ) {
	// Wrap values
	start = Math.max( 0, start || 0 );
	if ( end === undefined ) {
		end = this.data.length;
	} else {
		end = Math.min( this.data.length, end )
	}
	// Copy characters
	var text = '';
	for ( var i = start; i < end; i++ ) {
		// If not using in IE6 or IE7 (which do not support array access for strings) use this..
		// text += this.data[i][0];
		// Otherwise use this...
		text += typeof this.data[i] === 'string' ? this.data[i] : this.data[i][0];
	}
	return text;
};

Content.prototype.slice = function( start, end ) {
	return new Content( this.data.slice( start, end ) );
};

Content.prototype.insert = function( start, insert ) {
	// TODO: Prefer to not take annotations from a neighbor that's a space character
	var neighbor = this.data[Math.max( start - 1, 0 )];
	if ( $.isArray( neighbor ) ) {
		var annotations = neighbor.slice( 1 );
		for ( var i = 0; i < insert.length; i++ ) {
			if ( typeof insert[i] === 'string' ) {
				insert[i] = [insert[i]];
			}
			insert[i] = insert[i].concat( annotations );
		}
	}
	Array.prototype.splice.apply( this.data, [start, 0].concat( insert ) )
};

Content.prototype.remove = function( start, end ) {
	this.data.splice( start, end - start );
};

Content.prototype.getLength = function() {
	return this.data.length; 
};

Content.annotationRenderers = {
	'template': {
		'open': function( data ) {
			return '<span class="editSurface-format-object">' + data.html;
		},
		'close': '</span>',
	},
	'bold': {
		'open': '<span class="editSurface-format-bold">',
		'close': '</span>',
	},
	'italic': {
		'open': '<span class="editSurface-format-italic">',
		'close': '</span>',
	},
	'size': {
		'open': function( data ) {
			return '<span class="editSurface-format-' + data.type + '">';
		},
		'close': '</span>',
	},
	'script': {
		'open': function( data ) {
			return '<span class="editSurface-format-' + data.type + '">';
		},
		'close': '</span>',
	},
	'link': {
		'open': function( data ) {
			return '<span class="editSurface-format-link" data-href="' + data.href + '">';
		},
		'close': '</span>'
	}
};

Content.renderAnnotation = function( bias, annotation, stack ) {
	var renderers = Content.annotationRenderers,
		type = annotation.type,
		out = '';
	if ( type in renderers ) {
		if ( bias === 'open' ) {
			// Add annotation to the top of the stack
			stack.push( annotation );
			// Open annotation
			out += typeof renderers[type]['open'] === 'function'
				? renderers[type]['open']( annotation.data )
				: renderers[type]['open'];
		} else {
			if ( stack[stack.length - 1] === annotation ) {
				// Remove annotation from top of the stack
				stack.pop();
				// Close annotation
				out += typeof renderers[type]['close'] === 'function'
					? renderers[type]['close']( annotation.data )
					: renderers[type]['close'];
			} else {
				// Find the annotation in the stack
				var depth = stack.indexOf( annotation );
				if ( depth === -1 ) {
					throw 'Invalid stack error. An element is missing from the stack.';
				}
				// Close each already opened annotation
				for ( var i = stack.length - 1; i >= depth + 1; i-- ) {
					out += typeof renderers[stack[i].type]['close'] === 'function'
						? renderers[stack[i].type]['close']( stack[i].data )
						: renderers[stack[i].type]['close'];
				}
				// Close the buried annotation
				out += typeof renderers[type]['close'] === 'function'
					? renderers[type]['close']( annotation.data )
					: renderers[type]['close'];
				// Re-open each previously opened annotation
				for ( var i = depth + 1; i < stack.length; i++ ) {
					out += typeof renderers[stack[i].type]['open'] === 'function'
						? renderers[stack[i].type]['open']( stack[i].data )
						: renderers[stack[i].type]['open'];
				}
				// Remove the annotation from the middle of the stack
				stack.splice( depth, 1 );
			}
		}
	}
	return out;
};

Content.prototype.coverageOfAnnotation = function( start, end, annotation, strict ) {
	var coverage = [];
	for ( var i = start; i < end; i++ ) {
		var index = this.indexOfAnnotation( i, annotation );
		if ( typeof this.data[i] !== 'string' && index !== -1 ) {
			if ( strict ) {
				if ( Content.compareObjects( this.data[i][index].data, annotation.data ) ) {
					coverage.push( i );
				}
			} else {
				coverage.push( i );
			}
		} else if ( this.data[i] === '\n' ) {
			coverage.push( i );
		}
	}
	return coverage;
};

Content.prototype.indexOfAnnotation = function( offset, annotation, strict ) {
	var annotatedCharacter = this.data[offset];
	for ( var i = 1; i < this.data[offset].length; i++ ) {
		if ( annotatedCharacter[i].type === annotation.type ) {
			if ( strict ) {
				if ( Content.compareObjects( annotatedCharacter[i].data, annotation.data ) ) {
					return i;
				}
			} else {
				return i;
			}
		}
	}
	return -1;
};

/**
 * Applies an annotation to a given range.
 * 
 * If a range arguments are not provided, all content will be annotated.
 * 
 * @param annotation {Object} Annotation to apply
 * @param start {Integer} Offset to begin annotating from
 * @param end {Integer} Offset to stop annotating to
 */
Content.prototype.annotate = function( annotation, start, end ) {
	start = Math.max( start, 0 );
	end = Math.min( end, this.data.length );
	method = annotation.method;
	if ( method === 'toggle' ) {
		var coverage = this.coverageOfAnnotation( start, end, annotation, false );
		if ( coverage.length === end - start ) {
			var strictCoverage = this.coverageOfAnnotation( start, end, annotation, true );
			method = strictCoverage.length === coverage.length ? 'remove' : 'add';
		} else {
			method = 'add';
		}
	}
	if ( method === 'add' ) {
		var duplicate;
		for ( var i = start; i < end; i++ ) {
			duplicate = -1;
			if ( typeof this.data[i] === 'string' ) {
				// Never annotate new lines
				if ( this.data[i] === '\n' ) {
					continue;
				}
				// Auto-initialize as annotated character
				this.data[i] = [this.data[i]];
			} else {
				// Detect duplicate annotation
				duplicate = this.indexOfAnnotation( i, annotation );
			}
			if ( duplicate === -1 ) {
				// Append new annotation
				this.data[i].push( annotation );
			} else {
				// Replace existing annotation
				this.data[i][duplicate] = annotation;
			}
		}
	} else if ( method === 'remove' ) {
		for ( var i = start; i < end; i++ ) {
			if ( typeof this.data[i] !== 'string' ) {
				if ( annotation.type === 'all' ) {
					// Remove all annotations by converting the annotated character to a plain
					// character
					this.data[i] = this.data[i][0];
				}
				// Remove all matching instances of annotation
				var j;
				while ( ( j = this.indexOfAnnotation( i, annotation ) ) !== -1 ) {
					this.data[i].splice( j, 1 );
				}
			}
		}
	}
};

Content.htmlCharacters = {
	'&': '&amp;',
	'<': '&lt;',
	'>': '&gt;',
	'\'': '&#039;',
	'"': '&quot;',
	' ': '&nbsp;',
	'\n': '<span class="editSurface-whitespace">&#182;</span>',
	'\t': '<span class="editSurface-whitespace">&#8702;</span>'
};

Content.prototype.render = function( start, end ) {
	if ( start || end ) {
		return this.slice( start, end ).render();
	}
	var out = '',
		left = '',
		right,
		leftPlain,
		rightPlain,
		stack = [];
	for ( var i = 0; i < this.data.length; i++ ) {
		right = this.data[i];
		leftPlain = typeof left === 'string';
		rightPlain = typeof right === 'string';
		if ( !leftPlain && rightPlain ) {
			// [formatted][plain] pair, close any annotations for left
			for ( var j = 1; j < left.length; j++ ) {
				out += Content.renderAnnotation( 'close', left[j], stack );
			}
		} else if ( leftPlain && !rightPlain ) {
			// [plain][formatted] pair, open any annotations for right
			for ( var j = 1; j < right.length; j++ ) {
				out += Content.renderAnnotation( 'open', right[j], stack );
			}
		} else if ( !leftPlain && !rightPlain ) {
			// [formatted][formatted] pair, open/close any differences
			for ( var j = 1; j < left.length; j++ ) {
				if ( right.indexOf( left[j] ) === -1 ) {
					out += Content.renderAnnotation( 'close', left[j], stack );
				}
			}
			for ( var j = 1; j < right.length; j++ ) {
				if ( left.indexOf( right[j] ) === -1 ) {
					out += Content.renderAnnotation( 'open', right[j], stack );
				}
			}
		}
		out += right[0] in Content.htmlCharacters ? Content.htmlCharacters[right[0]] : right[0];
		left = right;		
	}
	
	return out;
}

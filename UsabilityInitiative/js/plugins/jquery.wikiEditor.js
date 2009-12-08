/**
 * This plugin provides a way to build a user interface around a textarea. You
 * can build the UI from a confguration..
 * 	$j( 'div#edittoolbar' ).wikiEditor(
 * 		{ 'modules': { 'toolbar': { ... config ... } } }
 * 	);
 * ...and add modules after it's already been initialized...
 * 	$j( 'textarea#wpTextbox1' ).wikiEditor(
 * 		'addModule', 'toc', { ... config ... }
 *	);
 * ...using the API, which is still be finished.
 */
( function( $ ) {

$.wikiEditor = {
	'modules': {},
	'instances': [],
	/**
	 * For each browser name, an array of conditions that must be met are supplied in [operaton, value] form where
	 * operation is a string containing a JavaScript compatible binary operator and value is either a number to be
	 * compared with $.browser.versionNumber or a string to be compared with $.browser.version
	 */
	'browsers': {
		'ltr': {
			'msie': [['>=', 7]],
			'firefox': [
				['>=', 2],
				['!=', '2.0'],
				['!=', '2.0.0.1'],
				['!=', '2.0.0.2'],
				['!=', '2.0.0.3'],
				['!=', '2.0.0.4']
			],
			'opera': [['>=', 9.6]],
			'safari': [['>=', 3.1]]
		},
		'rtl': {
			'msie': [['>=', 8]],
			'firefox': [
				['>=', 2],
				['!=', '2.0'],
				['!=', '2.0.0.1'],
				['!=', '2.0.0.2'],
				['!=', '2.0.0.3'],
				['!=', '2.0.0.4']
			],
			'opera': [['>=', 9.6]],
			'safari': [['>=', 3.1]]
		}
	},
	/**
	 * Path to images - this is a bit messy, and it would need to change if
	 * this code (and images) gets moved into the core - or anywhere for
	 * that matter...
	 */
	'imgPath' : wgScriptPath + '/extensions/UsabilityInitiative/images/wikiEditor/',
	'isSupportKnown': function() {
		return $.browser.name in $.wikiEditor.browsers[$( 'body' ).is( '.rtl' ) ? 'rtl' : 'ltr'];
	},
	'isSupported': function() {
		// Cache the return value
		if ( $.wikiEditor.supported != undefined )
			return $.wikiEditor.supported;
		
		if ( !$.wikiEditor.isSupportKnown ) {
			// Assume good faith :)
			return $.wikiEditor.supported = true;
		}
		var browser = $.wikiEditor.browsers[$( 'body' ).is( '.rtl' ) ? 'rtl' : 'ltr'][$.browser.name];
		for ( condition in browser ) {
			var op = browser[condition][0];
			var val = browser[condition][1];
			if ( typeof val == 'string' ) {
				if ( !( eval( '$.browser.version' + op + '"' + val + '"' ) ) ) {
					return $.wikiEditor.supported = false;
				}
			} else if ( typeof val == 'number' ) {
				if ( !( eval( '$.browser.versionNumber' + op + val ) ) ) {
					return $.wikiEditor.supported = false;
				}
			}
		}
		return $.wikiEditor.supported = true;
	},
	// Wraps gM from js2, but allows raw text to supercede
	'autoMsg': function( object, property ) {
		// Accept array of possible properties, of which the first one found will be used
		if ( typeof property == 'object' ) {
			for ( i in property ) {
				if ( property[i] in object || property[i] + 'Msg' in object ) {
					property = property[i];
					break;
				}
			}
		}
		if ( property in object ) {
			return object[property];
		} else if ( property + 'Msg' in object ) {
			return gM( object[property + 'Msg'] );
		} else {
			return '';
		}
	},
	// Get an icon in a certain language
	// @param icon Icon object from e.g. toolbar config
	// @param path Default icon path, defaults to $.wikiEditor.imgPath
	// @param lang Language code, defaults to wgUserLanguage
	'getIcon': function( icon, path, lang ) {
		lang = lang || wgUserLanguage;
		path = path || $.wikiEditor.imgPath;
		var src = icon[lang] || icon['default'] || icon;
		// Prepend path if src is not absolute
		if ( src.substr( 0, 7 ) != 'http://' && src.substr( 0, 8 ) != 'https://' &&
				src[0] != '/' )
			src = path + src;
		return src + '?' + wgWikiEditorIconVersion;
	},
	'fixOperaBrokenness': function( s ) {
		/*
		// This function works around Opera's
		// broken newline handling in textareas.
		// .val() has \n while selection functions
		// treat newlines as \r\n
		
		if ( typeof $.isOperaBroken == 'undefined' && $.wikiEditor.instances.length > 0 ) {
			// Create a textarea inside a div
			// with zero area, to hide it properly
			var div = $( '<div />' )
				.height( 0 )
				.width( 0 )
				.insertBefore( $.wikiEditor.instances[0] );
			var textarea = $( '<textarea></textarea>' )
				.height( 0 )
				.appendTo( div )
				.val( "foo\r\nbar" );
			// Try to search&replace bar --> BAR
			var index = textarea.val().indexOf( 'bar' );
			textarea.select();
			textarea.setSelection( index, index + 3 );
			textarea.encapsulateSelection( '', 'BAR', '', false, true );
			if ( textarea.val().substr( -4 ) != 'BARr' )
				$.isOperaBroken = false;
			else
				$.isOperaBroken = true;
			div.remove();
		}
		if ( $.isOperaBroken )
			s = s.replace( /\n/g, "\r\n" );
		*/
		return s;
	}
};

$.fn.wikiEditor = function() {

// Skip any further work on browsers that are unsupported
if ( $j.wikiEditor.isSupportKnown() && !$j.wikiEditor.isSupported() ) {
	return $(this);
}

/* Initialization */

// The wikiEditor context is stored in the element, so when this function
// gets called again we can pick up where we left off
var context = $(this).data( 'wikiEditor-context' );

// This only gets run on the first call
if ( typeof context == 'undefined' ) {
	
	var instance = $.wikiEditor.instances.length;
	context = { '$textarea': $(this), 'views': {}, 'modules': {}, 'data': {}, 'instance': instance };
	$.wikiEditor.instances[instance] = $(this);
	
	/* Externally Accessible API */
	
	context.api = {
		/**
		 * Accepts either a string of the name of a module to add without any
		 * additional configuration parameters, or an object with members keyed with
		 * module names and valued with configuration objects
		 */
		'addModule': function( context, data ) {
			// A safe way of calling an API function on a module
			function callModuleApi( module, call, data ) {
				if (
					module in $.wikiEditor.modules &&
					'fn' in $.wikiEditor.modules[module] &&
					call in $.wikiEditor.modules[module].fn
				) {
					$.wikiEditor.modules[module].fn[call]( context, data );
				}
			}
			if ( typeof data == 'string' ) {
				callModuleApi( data, 'create', {} );
			} else if ( typeof data == 'object' ) {
				for ( module in data ) {
					if ( typeof module == 'string' ) {
						callModuleApi( module, 'create', data[module] );
					}
				}
			}
		}
	};
	// Allow modules to extend the API
	for ( module in $.wikiEditor.modules ) {
		if ( 'api' in $.wikiEditor.modules[module] ) {
			for ( call in $.wikiEditor.modules[module].api ) {
				// Modules may not overwrite existing API functions - first come,
				// first serve
				if ( !( call in context.api ) ) {
					context.api[call] = $.wikiEditor.modules[module].api[call];
				}
			}
		}
	}
	
	/* 
	 * Event Handlers
	 * 
	 * These act as filters returning false if the event should be ignored or returning true if it should be passed
	 * on to all modules. This is also where we can attach some extra information to the events.
	 */
	
	context.evt = {
		'change': function( event ) {
			// Event filtering
			switch ( event.type ) {
				case 'keypress':
					if ( /* TODO: test if something interesting was deleted */ true ) {
						event.data.scope = 'division';
					} else {
						event.data.scope = 'character';
					}
					break;
				case 'mousedown': // FIXME: mouseup?
					if ( /* TODO: test if text was dragged and dropped */ true ) {
						event.data.scope = 'division';
					} else {
						return false;
					}
					break;
				default:
					event.data.scope = 'division';
					break;
			}
			return true;
		}
	};
	
	/* Internal Functions */
	
	context.fn = {
		'trigger': function( name, event ) {
			// Event is an optional argument, but from here on out, at least the type field should be dependable
			if ( typeof event == 'undefined' ) {
				event = { 'type': 'custom' };
			}
			// Ensure there's a place for extra information to live
			if ( typeof event.data == 'undefined' ) {
				event.data = {};
			}
			// Allow filtering to occur
			if ( name in context.evt ) {
				if ( !context.evt[name]( event ) ) {
					return false;
				}
			}
			for ( module in $.wikiEditor.modules ) {
				if ( 'evt' in $.wikiEditor.modules[module] && name in $.wikiEditor.modules[module].evt ) {
					$.wikiEditor.modules[module].evt[name]( context, event );
				}
			}
		},
		'addButton': function( options ) {
			// Ensure that buttons and tabs are visible
			context.$controls.show();
			context.$buttons.show();
			return $( '<button />' )
				.text( $.wikiEditor.autoMsg( options, 'caption' ) )
				.click( options.action )
				.appendTo( context.$buttons );
		},
		'addView': function( options ) {
			// Adds a tab
			function addTab( options ) {
				// Ensure that buttons and tabs are visible
				context.$controls.show();
				context.$tabs.show();
				// Return the newly appended tab
				return $( '<div></div>' )
					.attr( 'rel', 'wikiEditor-ui-view-' + options.name )
					.addClass( context.view == options.name ? 'current' : null )
					.append( $( '<a></a>' )
						.attr( 'href', '#' )
						.click( function( event ) {
							context.$ui.find( '.wikiEditor-ui-view' ).hide();
							context.$ui.find( '.' + $(this).parent().attr( 'rel' ) ).show();
							context.$tabs.find( 'div' ).removeClass( 'current' );
							$(this).parent().addClass( 'current' );
							$(this).blur();
							if ( 'init' in options && typeof options.init == 'function' ) {
								options.init( context );
							}
							event.preventDefault();
							return false;
						} )
						.text( $.wikiEditor.autoMsg( options, 'title' ) )
					)
					.appendTo( context.$tabs );
			}
			// Automatically add the previously not-needed wikitext tab
			if ( !context.$tabs.children().size() ) {
				addTab( { 'name': 'wikitext', 'titleMsg': 'wikieditor-wikitext-tab' } );
			}
			// Add the tab for the view we were actually asked to add
			addTab( options );
			// Return newly appended view
			return $( '<div></div>' )
				.addClass( 'wikiEditor-ui-view wikiEditor-ui-view-' + options.name )
				.hide()
				.appendTo( context.$ui );
		},
		/**
		 * Set up the magic iframe
		 */
		'setup': function() {
			// We need to properly escape any HTML entities like &amp;, &lt; and &gt; so they end up as visible
			// characters rather than actual HTML tags in the code editor container.
			var contentHTML = $( '<div />' ).text( context.$textarea.val() ).html();
			
			// Setup the iframe with a basic document
			context.$iframe[0].contentWindow.document.open();
			context.$iframe[0].contentWindow.document.write(
				// FIXME: Break this line
				'<html><head><title>wikiEditor</title><script>var context = window.parent.jQuery.wikiEditor.instances[' + context.instance + '].data( "wikiEditor-context" ); window.parent.jQuery( document ).bind( "keydown keypress keyup mousedown mouseup cut paste", function( event ) { context.fn.trigger( "change", event ) } );</script></head><body style="margin:0;padding:0;width:100%;height:100%;white-space:pre-wrap;font-family:monospace">' + contentHTML + '</body></html>'
			);
			context.$iframe[0].contentWindow.document.close();
			// Turn the document's design mode on
			context.$iframe[0].contentWindow.document.designMode = 'on';
			// Get a reference to the content area of the iframe
			context.$content = $( context.$iframe[0].contentWindow.document.body );
			if ( $( 'body' ).is( '.rtl' ) ) {
				context.$content.addClass( 'rtl' ).attr( 'dir', 'rtl' );
			}
			
			/* Magic IFRAME Activation */
			
			// Activate the iframe, encoding the content of the textarea and copying it to the content of the iframe
			context.$textarea.attr( 'disabled', true );
			context.$textarea.hide();
			context.$iframe.show();
		},
		/**
		 * Checks whether the magic iframe is properly set up
		 */
		'isSetup': function() {
			return context.$content != undefined && context.$content[0].innerHTML != undefined;
		},
		/**
		 * Gets the complete contents of the iframe
		 */
		'getContents': function() {
			// We use .html() instead of .text() so HTML entities are handled right
			// Setting the HTML of the textarea doesn't work on all browsers, use a dummy <div> instead
			
			return $( '<div />' )
				.html( context.$content.html().replace( /\<br\>/g, "\n" ) )
				.text();
		},
		'setContents': function( options ) {
			context.$content.text( options.contents );
			return context.$textarea;
		},
		/**
		 * Gets the currently selected text in the content
		 * DO NOT CALL THESE DIRECTLY, use .textSelection( 'functionname', options ) instead
		 */
		'textSelection': function() {
			var retval;
			if ( context.$iframe[0].contentWindow.getSelection ) {
				retval = context.$iframe[0].contentWindow.getSelection();
			} else if ( context.$iframe[0].contentWindow.document.selection ) { // should come last; Opera!
				retval = context.$iframe[0].contentWindow.document.selection.createRange();
			}
			if ( retval.text ) {
				retval = retval.text;
			} else if ( retval.toString ) {
				retval = retval.toString();
			}
			return retval;
		},
		/**
		 * Inserts text at the beginning and end of a text selection, optionally inserting text at the caret when
		 * selection is empty.
		 * DO NOT CALL THESE DIRECTLY, use .textSelection( 'functionname', options ) instead
		 */
		'encapsulateSelection': function( options ) {
			// TODO: IE
			// TODO: respect options.ownline
			var selText = $(this).textSelection( 'getSelection' );
			var selectAfter = false;
			var pre = options.pre, post = options.post;
			if ( !selText ) {
				selText = options.peri;
				selectAfter = true;
			} else if ( options.replace ) {
				selText = options.peri;
			} else if ( selText.charAt( selText.length - 1 ) == ' ' ) {
				// Exclude ending space char
				// FIXME: Why?
				selText = selText.substring( 0, selText.length - 1 );
				post += ' ';
			}
			var range = context.$iframe[0].contentWindow.getSelection().getRangeAt( 0 );
			if ( options.ownline ) {
				// TODO: This'll probably break with syntax highlighting
				if ( range.startOffset != 0 )
					pre  = "\n" + options.pre;
				// TODO: Will this still work with syntax highlighting?
				if ( range.endContainer == range.commonAncestorContainer )
					post += "\n";
			}
			var insertText = pre + selText + post;
			var insertLines = insertText.split( "\n" );
			range.extractContents();
			// Insert the contents one line at a time
			// insertNode() inserts at the beginning, so this has
			// to happen in reverse order
			var lastNode;
			for ( var i = insertLines.length - 1; i >= 0; i-- ) {
				range.insertNode( document.createTextNode( insertLines[i] ) );
				if ( i > 0 ) {
					lastNode = range.insertNode( document.createElement( 'br' ) );
				}
			}
			if ( lastNode ) {
				context.fn.scrollToTop( lastNode );
			}
			// Trigger the encapsulateSelection event (this might need to get named something else/done differently)
			context.$content.trigger( 'encapsulateSelection', [ pre, options.peri, post,
				options.ownline, options.replace ] );
			return context.$textarea;
		},
		/**
		 * Gets the position (in resolution of bytes not nessecarily characters) in a textarea
		 * DO NOT CALL THESE DIRECTLY, use .textSelection( 'functionname', options ) instead
		 */
		'getCaretPosition': function( options ) {
			// FIXME: Character-based functions aren't useful for the magic iframe
			// ...
			//reurn character position
		},
		/**
		 * Sets the selection of the content
		 * DO NOT CALL THESE DIRECTLY, use .textSelection( 'functionname', options ) instead
		 *
		 * @param start Character offset of selection start
		 * @param end Character offset of selection end
		 * @param startContainer Element in iframe to start selection in
		 * @param endContainer Element in iframe to end selection in
		 */
		'setSelection': function( options ) {
			// TODO: IE
			var sel = context.$iframe[0].contentWindow.getSelection();
			var sc = options.startContainer, ec = options.endContainer;
			sc = sc.jquery ? sc[0] : sc;
			ec = ec.jquery ? ec[0] : ec;
			while ( sc.firstChild && sc.nodeName != '#text' )
				sc = sc.firstChild;
			while ( ec.firstChild && ec.nodeName != '#text' )
				ec = ec.firstChild;
			// TODO: Can this be done in one call? sel.addRange()?
			//sel.removeAllRanges();
			sel.extend( sc, options.start );
			//if ( sel.
			sel.collapseToStart();
			if ( options.end != options.start || sc != ec )
				sel.extend( ec, options.end );
			
		},
		/**
		 * Scroll a textarea to the current cursor position. You can set the cursor position with setSelection()
		 * DO NOT CALL THESE DIRECTLY, use .textSelection( 'functionname', options ) instead
		 */
		'scrollToCaretPosition': function( options ) {
			// ...
			//context.$textarea.trigger( 'scrollToPosition' );
		},
		/**
		 * Scroll an element to the top of the iframe
		 * DO NOT CALL THESE DIRECTLY, use .textSelection( 'functionname', options ) instead
		 *
		 * @param $element jQuery object containing an element in the iframe
		 * @param force If true, scroll the element even if it's already visible
		 */
		'scrollToTop': function( $element, force ) {
			var body = context.$content.closest( 'body' );
			var y = $element.offset().top - context.$content.offset().top;
			if ( force || y < body.scrollTop() || y > body.scrollTop() + body.height() )
				body.scrollTop( y );
			$element.trigger( 'scrollToTop' );
		},
		/**
		 * Get the first element before the selection matching a certain selector
		 * @param selector Selector to match. Defaults to '*'
		 * @param getAll If true, get all matching elements before the selection
		 */
		'beforeSelection': function( selector, getAll ) {
			if ( typeof selector == 'undefined' )
				selector = '*';
			var retval = [];
			var range = context.$iframe[0].contentWindow.getSelection().getRangeAt( 0 );
			// Start at the selection's start and traverse the DOM backwards
			var e = range.startContainer;
			//TODO continue
		}
	};
	
	/* Base UI Construction */
	
	// Encapsulate the textarea with some containers for layout
	context.$textarea
		.wrap( $( '<div></div>' ).addClass( 'wikiEditor-ui' ) )
		.wrap( $( '<div></div>' ).addClass( 'wikiEditor-ui-view wikiEditor-ui-view-wikitext' ) )
		.wrap( $( '<div></div>' ).addClass( 'wikiEditor-ui-left' ) )
		.wrap( $( '<div></div>' ).addClass( 'wikiEditor-ui-bottom' ) )
		.wrap( $( '<div></div>' ).addClass( 'wikiEditor-ui-text' ) );
	
	context.$ui = context.$textarea.parent().parent().parent().parent().parent();
	context.$wikitext = context.$textarea.parent().parent().parent().parent();
	// Add in tab and button containers
	context.$wikitext
		.before(
			$( '<div></div>' ).addClass( 'wikiEditor-ui-controls' )
				.append( $( '<div></div>' ).addClass( 'wikiEditor-ui-tabs' ).hide() )
				.append( $( '<div></div>' ).addClass( 'wikiEditor-ui-buttons' ) )
		)
		.before( $( '<div style="clear:both;"></div>' ) );
	context.$controls = context.$ui.find( '.wikiEditor-ui-buttons' ).hide();
	context.$buttons = context.$ui.find( '.wikiEditor-ui-buttons' );
	context.$tabs = context.$ui.find( '.wikiEditor-ui-tabs' );
	// Clear all floating after the UI
	context.$ui.after( $( '<div style="clear:both;"></div>' ) );
	// Attach a right container
	context.$wikitext.append( $( '<div></div>' ).addClass( 'wikiEditor-ui-right' ) );
	// Attach a top container to the left pane
	context.$wikitext.find( '.wikiEditor-ui-left' ).prepend( $( '<div></div>' ).addClass( 'wikiEditor-ui-top' ) );
	// Setup the intial view
	context.view = 'wikitext';
	
	/* Core Event Handlers */
	
	$( window ).resize( function( event ) { context.fn.trigger( 'resize', event ) } );
	
	/* Magic IFRAME Construction */
	
	// Create an iframe in place of the text area
	context.$iframe = $( '<iframe></iframe>' )
		.attr( 'frameborder', 0 )
		.css( {
			'backgroundColor': 'white',
			'width': '100%',
			'height': context.$textarea.height(),
			'display': 'none',
			'overflow-y': 'scroll',
			'overflow-x': 'hidden',
		})
		.insertAfter( context.$textarea );
	
	/*
	 * For whatever strange reason, this code needs to be within a timeout or it doesn't work - it seems to be that
	 * the DOM manipulation to add the iframe happens asynchronously and this code that depends on it actually being
	 * finished doesn't function on the right reference.
	 * FIXME: The fact that this calls a function that's defined below is ugly
	 */
	setTimeout( function() { context.fn.setup(); }, 1 );
	
	// Attach a submit handler to the form so that when the form is submitted the content of the iframe gets decoded and
	// copied over to the textarea
	context.$textarea.closest( 'form' ).submit( function() {
		context.$textarea.attr( 'disabled', false );
		context.$textarea.val( context.$textarea.textSelection( 'getContents' ) );
	} );
}

// If there was a configuration passed, it's assumed to be for the addModule API call
if ( arguments.length > 0 && typeof arguments[0] == 'object' ) {
	// If the iframe construction isn't ready yet, defer the call
	if ( context.fn.isSetup() )
		context.api.addModule( context, arguments[0] );
	else {
		var args = arguments;
		setTimeout( function() {
			context.api.addModule( context, args[0] );
 		}, 2 );
	}
} else {
	// Since javascript gives arguments as an object, we need to convert them so they can be used more easily
	arguments = $.makeArray( arguments );
	if ( arguments.length > 0 ) {
		// Handle API calls
		var call = arguments.shift();
		if ( call in context.api ) {
			// If the iframe construction isn't ready yet, defer the call
			if ( context.fn.isSetup() )
				context.api[call]( context, arguments[0] == undefined ? {} : arguments[0] );
			else {
				var args = arguments;
				setTimeout( function() {
					context.api[call]( context, args[0] == undefined ? {} : args[0] );
				}, 2 );
			}
		}
	}
}

// Store the context for next time, and support chaining
return $(this).data( 'wikiEditor-context', context );

}; } )( jQuery );

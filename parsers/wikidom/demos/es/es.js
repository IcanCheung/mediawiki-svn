$(document).ready( function() {
	var showData = false;
	var doc = es.Document.newFromWikiDomDocument( { 'blocks': [
		{
			"type": "paragraph",
			"lines": [
				{
					'text': "In text display, line wrap is the feature of continuing on a new line when a line is full, such that each line fits in the viewable window, allowing text to be read from top to bottom without any horizontal scrolling.",
					'annotations': [
						// "In text display" should be bold
						{ 'type': 'bold', 'range': { 'start': 0, 'end': 15 } },
						// "line wrap" should be italic
						{ 'type': 'italic', 'range': { 'start': 17, 'end': 26 } },
						// "wrap is" should be a link to "#"
						{
							'type': 'xlink',
							'data': { 'href': '#' },
							'range': { 'start': 22, 'end': 29 }
						}
					]
				},
				{ 'text': "Word wrap is the additional feature of most text editors, word processors, and web browsers, of breaking lines between and not within words, except when a single word is longer than a line." }
			]
		},
		{
			"type": "paragraph",
			"lines": [
				{
					'text': "It is usually done on the fly when viewing or printing a document, so no line break code is manually entered, or stored.  If the user changes the margins, the editor will either automatically reposition the line breaks to ensure that all the text will \"flow\" within the margins and remain visible, or provide the typist some convenient way to reposition the line breaks.",
					'annotations': [
						// "[citation needed]" should be super
						{
							'type': 'template',
							'data': {
								'html': '<sup><small><a href="#">[citation needed]</a></small></sup>'
							},
							'range': { 'start': 120, 'end': 121 }
						}
					]
				},
				{ 'text': "A soft return is the break resulting from line wrap or word wrap, whereas a hard return is an intentional break, creating a new paragraph." }
			]
		},
		{
			'type': 'list',
			'style': 'number',
			'items': [
				{
					'line': { 'text': 'Operating Systems' },
					'lists': [
						{
							'style': 'bullet',
							'items': [
								{
									'line': { 'text': 'Linux' },
									'lists': [
										{
											'style': 'bullet',
											'items': [
												{
													'line': { 'text': 'Ubuntu' },
													'lists': [
														{
															'style': 'bullet',
															'items': [
																{
																	'line': {
																		'text': 'Desktop: Intuitive office apps, safe and fast web browsing, and seamless integration.  Ubuntu brings the very best technologies straight to the desktop.',
																		'annotations': [
																			// "[citation needed 2]" should be super
																			{
																				'type': 'template',
																				'data': {
																					'html': '<sup><small><a href="#">[citation needed 2]</a></small></sup>'
																				},
																				'range': { 'start': 85, 'end': 86 }
																			}
																		]
																	}
																},
																{ 'line': { 'text': 'Server: Secure, fast and powerful, Ubuntu Server is transforming IT environments worldwide. Realise the full potential of your infrastructure with a reliable, easy-to-integrate technology platform. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. Lorem ipsum.. ' } },
																{ 'line': { 'text': 'Cloud: Ubuntu cloud computing puts you in control of your IT infrastructure. It helps you access computing power as and when you need it so you can meet user demand more effectively.' } }
															]
														}
													]
												},
												{ 'line': { 'text': 'Fedora' } },
												{ 'line': { 'text': 'Gentoo' } }
											]
										}
									]
								},
								{ 'line': { 'text': 'Windows' } },
								{ 'line': { 'text': 'Mac' } }
							]
						}
					]
				},
				{
					'line': {
						'text': 'Second item',
						'annotations': [
							{
								'type': 'italic',
								'range': {
									'start': 0,
									'end': 6
								}
							}
						]
					}
				},
				{
					'line': {
						'text': 'Third item',
						'annotations': [
							{
								'type': 'bold',
								'range': {
									'start': 0,
									'end': 5
								}
							}
						]
					}
				},
				{
					'line': {
						'text': 'Fourth item',
						'annotations': [
							{
								'type': 'ilink',
								'range': {
									'start': 7,
									'end': 11
								},
								'data': { 'title': 'User:JohnDoe' }
							}
						]
					}
				}
			]
		},
		{
			'type': 'paragraph',
			'lines': [
				{ 'text': 'The soft returns are usually placed after the ends of complete words, or after the punctuation that follows complete words. However, word wrap may also occur following a hyphen.' },
				{ 'text': 'Word wrap following hyphens is sometimes not desired, and can be avoided by using a so-called non-breaking hyphen instead of a regular hyphen. On the other hand, when using word processors, invisible hyphens, called soft hyphens, can also be inserted inside words so that word wrap can occur following the soft hyphens.' },
				{ 'text': 'Sometimes, word wrap is not desirable between words. In such cases, word wrap can usually be avoided by using a hard space or non-breaking space between the words, instead of regular spaces.' },
				{ 'text': 'OccasionallyThereAreWordsThatAreSoLongTheyExceedTheWidthOfTheLineAndEndUpWrappingBetweenMultipleLines.' },
				{ 'text': 'Text might have\ttabs\tin it too. Not all text will end in a line breaking character' }
			]
		}
	] } );
	var surface = new es.Surface( $('#es-editor'), doc );
	
	$( '#es-toolbar .es-toolbarTool' ).mousedown( function( e ) {
		e.preventDefault();
		return false;
	} );
	$( '#es-toolbar-bold' ).click( function() {
			surface.annotateContent( 'toggle', { 'type': 'bold' } );
			return false;
		} );
	$( '#es-toolbar-italic' ).click( function() {
		surface.annotateContent( 'toggle', { 'type': 'italic' } );
		return false;
	} );
	$( '#es-toolbar-small' ).click( function() {
		surface.annotateContent( 'toggle', {
			'type': 'size',
			'data': { 'type': 'small' }
		} );
		return false;
	} );
	$( '#es-toolbar-big' ).click( function() {
		surface.annotateContent( 'toggle', {
			'type': 'size',
			'data': { 'type': 'big' }
		} );
		return false;
	} );
	$( '#es-toolbar-sub' ).click( function() {
		surface.annotateContent( 'toggle', {
			'type': 'script',
			'data': { 'type': 'sub' }
		} );
		return false;
	} );
	$( '#es-toolbar-super' ).click( function() {
		surface.annotateContent( 'toggle', {
			'type': 'script',
			'data': { 'type': 'super' }
		} );
		return false;
	} );
	$( '#es-toolbar-link' ).click( function() {
		surface.annotateContent( 'toggle', {
			'type': 'xlink',
			'data': { 'href': '#' }
		} );
		return false;
	} );
	$( '#es-toolbar-clear' ).click( function() {
		surface.annotateContent( 'remove', { 'type': 'all' } );
		return false;
	} );
	$( '.es-toolbarGroup-preview .es-toolbarTool' ).click( function() {
		var type = $(this).attr( 'rel' );
		showData = showData === type ? false : type;
		if ( showData ) {
			$( 'body' ).addClass( 'es-showData' );
			$( '.es-preview' ).hide();
			$( '#es-preview-' + type ).show();
			$( '.es-toolbarGroup-preview .es-toolbarTool' ).removeClass( 'es-toolbarTool-down' );
			$(this).addClass( 'es-toolbarTool-down' );
		} else {
			$( 'body' ).removeClass( 'es-showData' );
			$(this).removeClass( 'es-toolbarTool-down' );
		}
		doc.renderBlocks();
		doc.emit( 'update' );
	} );
	// Setup data updates
	var previewTimeout = null,
		context = new es.Document.Context();
	doc.on( 'update', function() {
		if ( showData ) {
			if ( previewTimeout !== null ) {
				clearTimeout( previewTimeout );
			}
			previewTimeout = setTimeout( function () {
				switch ( showData ) {
					case 'json':
						$( '#es-preview-json' )
							.text( doc.serialize( 'json', context, { 'indentWith': '  ' } ) );
						break;
					case 'wikitext':
						$( '#es-preview-wikitext' ).text( doc.serialize( 'wikitext', context ) );
						break;
					case 'html':
						$( '#es-preview-html' ).text( doc.serialize( 'html', context ) );
						break;
					case 'render':
						$( '#es-preview-render' ).html( doc.serialize( 'html', context ) );
						break;
				}
			}, 100 );
		}
	} );
} );
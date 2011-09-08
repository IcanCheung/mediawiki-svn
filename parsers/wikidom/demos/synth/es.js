$(document).ready( function() {
	var doc = es.DocumentModel.newFromPlainObject( { 'blocks': [
		{
			'type': 'paragraph',
			'content': {
				'text': 'In text display, line wrap is the feature of continuing on a new line when a line is full, such that each line fits in the viewable window, allowing text to be read from top to bottom without any horizontal scrolling.\nWord wrap is the additional feature of most text editors, word processors, and web browsers, of breaking lines between and not within words, except when a single word is longer than a line.',
				'annotations': [
					// 'In text display' should be bold
					{ 'type': 'bold', 'range': { 'start': 0, 'end': 15 } },
					// 'line wrap' should be italic
					{ 'type': 'italic', 'range': { 'start': 17, 'end': 26 } },
					// 'wrap is' should be a link to '#'
					{
						'type': 'xlink',
						'data': { 'href': '#' },
						'range': { 'start': 22, 'end': 29 }
					},
				]
			}
		},
		{
			'type': 'paragraph',
			'content': {
				'text': 'It is usually done on the fly when viewing or printing a document, so no line break code is manually entered, or stored.  If the user changes the margins, the editor will either automatically reposition the line breaks to ensure that all the text will "flow" within the margins and remain visible, or provide the typist some convenient way to reposition the line breaks.\nA soft return is the break resulting from line wrap or word wrap, whereas a hard return is an intentional break, creating a new paragraph.',
				'annotations': [
					// '[citation needed]' should be super
					{
						'type': 'template',
						'data': {
							'html': '<sup><small><a href="#">[citation needed]</a></small></sup>'
						},
						'range': { 'start': 120, 'end': 121 }
					}
				]
			}
		},
		{
			'type': 'paragraph',
			'content': { 'text': 'The soft returns are usually placed after the ends of complete words, or after the punctuation that follows complete words. However, word wrap may also occur following a hyphen.\nWord wrap following hyphens is sometimes not desired, and can be avoided by using a so-called non-breaking hyphen instead of a regular hyphen. On the other hand, when using word processors, invisible hyphens, called soft hyphens, can also be inserted inside words so that word wrap can occur following the soft hyphens.\nSometimes, word wrap is not desirable between words. In such cases, word wrap can usually be avoided by using a hard space or non-breaking space between the words, instead of regular spaces.\nOccasionallyThereAreWordsThatAreSoLongTheyExceedTheWidthOfTheLineAndEndUpWrappingBetweenMultipleLines.\nText might have\ttabs\tin it too. Not all text will end in a line breaking character' }
		}
	] } );
	var surface = new es.SurfaceView( $('#es-editor'), doc );
} );

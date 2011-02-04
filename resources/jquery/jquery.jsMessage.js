/**
 * jQuery jsMessage
 *
 * Function to inform the user of something. Use sparingly (since there's mw.log for
 * messages aimed at developers / debuggers). Based on the function in MediaWiki's
 * legacy javascript (wikibits.js) by Aryeh Gregor called jsMsg() added in r23233.
 *
 * @author Krinkle <krinklemail@gmail.com>
 *
 * Dual license:
 * @license CC-BY 3.0 <http://creativecommons.org/licenses/by/3.0>
 * @license GPL2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 */
( function( $, mw ) {
// @return jQuery object of the message box
$.jsMessageNew = function( options ) {
	options = $.extend( {
		'id': 'js-message', // unique identifier for this message box
		'parent': 'body', // jQuery/CSS selector
		'insert': 'prepend' // 'prepend' or 'append'
	}, options );
	var $curBox = $( '#'+ options.id );
	// Only create a new box if it doesn't exist already
	if ( $curBox.size() > 0 ) {
		if ( $curBox.hasClass( 'js-message-box' ) ) {
			return $curBox;
		} else {
			return $curBox.addClass( 'js-message-box' );
		}
	} else {
		var $newBox = $( '<div/>', {
			'id': options.id,
			'class': 'js-message-box',
			'css': {
				'display': 'none'
			}
		});
		if ( options.insert === 'append' ) {
			$newBox.appendTo( options.parent );
			return $newBox;
		} else {
			$newBox.prependTo( options.parent );
			return $newBox;
		}
	}
};
// Calling with no message or message set to empty string or null will hide the group,
// setting 'replace' to true as well will reset and hide the group entirely.
// If there are no visible groups the main message box is hidden automatically,
// and shown again once there are messages
// @return jQuery object of message group
$.jsMessage = function( options ) {
	options = $.extend( {
		'message': '',
		'group': 'default',
		'replace': false, // if true replaces any previous message in this group
		'target': 'js-message'
	}, options );	  
	var $target = $.jsMessageNew( { id: options.target } );
	var groupID = options.target + '-' + options.group;
	var $group = $( '#' + groupID );
	// Create group container if not existant
	if ( $group.size() < 1 ) {
		$group = $( '<div/>', {
			'id': groupID,
			'class': 'js-message-group'
		});
		$target.prepend( $group );
	}
	// Replace ?
	if ( options.replace === true ) {
		$group.empty();
	}
	// Hide it ?
	if ( options.message === '' || options.message === null ) {
		$group.hide();
	} else {
		// Actual message addition
		$group.prepend( $( '<p/>' ).append( options.message ) ).show();
		$target.slideDown()
	}
	// If the last visible group was just hidden, slide the entire box up
	// Othere wise slideDown (if already visible nothing will happen)
	if ( $target.find( '> *:visible' ).size() === 0 ) {
		// to avoid a sudden dissapearance of the last group followed by
		// a slide up of only the outline, show it for a second
		$group.show();
		$target.slideUp();
		$group.hide();
	} else {
		$target.slideDown();
	}
	return $group;
};
} )( jQuery, mediaWiki );
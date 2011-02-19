/**
* Skin js allows you to override contrlBuilder html/class output
*/
( function( mw, $ ) {
	
mw.PlayerSkinKskin = {

	// The parent class for all kskin css:
	playerClass: 'k-player',

	// Display time string length
	longTimeDisp: false,

	// Default control bar height
	height: 20,

	// Volume control layout is horizontal
	volume_layout: 'horizontal',

	// Skin "kskin" is specific for wikimedia we have an
	// api Title key so the "credits" menu item can be showed.
	supportedMenuItems: {
		'credits': true
	},

	// Extends base components with kskin specific options:
	components: {
		'playButtonLarge' : {
			'h' : 55
		},
		'options': {
			'w':50,
			'o':function( ctrlObj ) {
				return $( '<div />' )
					.attr( 'title', gM( 'mwe-embedplayer-player_options' ) )
					.addClass( "ui-state-default ui-corner-bl rButton k-options" )
					.append(
						$( '<span />' )
						.text( gM( 'mwe-embedplayer-menu_btn' ) )
					);
			}
		},
		'volumeControl': {
			'w':40
		},
		// No attributionButton component for kSkin ( its integrated into the credits screen )
		'attributionButton' : false,

		// Time display:
		'timeDisplay': {
			'w':45
		},
		'optionsMenu': {
			'w' : 0,
			'o' : function( ctrlObj ) {
				var embedPlayer = ctrlObj.embedPlayer;

				$menuOverlay = $( '<div />')
					.addClass( 'overlay-win k-menu ui-widget-content' )
					.css( {
						'width' : '100%',
						'position': 'absolute',
						'top' : '0px',
						'bottom' : ( ctrlObj.getHeight() + 2 ) + 'px'
					} );

				// Note safari can't display video overlays with text:
				// see bug https://bugs.webkit.org/show_bug.cgi?id=48379

				var userAgent = navigator.userAgent.toLowerCase();
				if( userAgent.indexOf('safari') != -1 ){
					$menuOverlay.css('opacity', '0.9');
				}
				// Setup menu offset ( if player height < getOverlayHeight )
				// This displays the menu outside of the player on small embeds
				if ( embedPlayer.getPlayerHeight() < ctrlObj.getOverlayHeight() ) {
					var topPos = ( ctrlObj.checkOverlayControls() )
							? embedPlayer.getPlayerHeight()
							: embedPlayer.getPlayerHeight() + ctrlObj.getHeight();

					$menuOverlay.css( {
						'top' : topPos + 'px',
						'bottom' : null,
						'width' : ctrlObj.getOverlayWidth(),
						'height' : ctrlObj.getOverlayHeight() + 'px'
					});
					// Special common overflow hack for thumbnail display of player
					$( embedPlayer ).parents( '.thumbinner' ).css( 'overflow', 'visible' );
				}

				$menuBar = $( '<ul />' )
					.addClass( 'k-menu-bar' );

				// dont include about player menu item ( FIXME should be moved to a init function )
				delete ctrlObj.supportedMenuItems['aboutPlayerLibrary'];

				// Output menu item containers:
				for ( var menuItem in ctrlObj.supportedMenuItems ) {
					$menuBar.append(
						$( '<li />')
						// Add the menu item class:
						.addClass( 'k-' + menuItem + '-btn' )
						.attr( 'rel', menuItem )
						.append(
							$( '<a />' )
							.attr( {
								'title' : gM( 'mwe-embedplayer-' + menuItem ),
								'href' : '#'
							})
						)
					);
				}

				// Add the menuBar to the menuOverlay
				$menuOverlay.append( $menuBar );

				var $menuScreens = $( '<div />' )
					.addClass( 'k-menu-screens' )
					.css( {
						'position' : 'absolute',
						'top' : '0px',
						'left' : '0px',
						'bottom' : '0px',
						'right' : '45px',
						'overflow' : 'hidden'
					} );
				for ( var menuItem in ctrlObj.supportedMenuItems ) {
					$menuScreens.append(
						$( '<div />' )
						.addClass( 'menu-screen menu-' + menuItem )
					);
				}

				// Add the menuScreens to the menuOverlay
				$menuOverlay.append( $menuScreens );

				return $menuOverlay;

			}
		}
	},

	/**
	* Get minimal width for interface overlay
	*/
	getOverlayWidth: function(){
		return ( this.embedPlayer.getPlayerWidth() < 200 )? 200 : this.embedPlayer.getPlayerWidth();
	},

	/**
	* Get minimal height for interface overlay
	*/
	getOverlayHeight: function(){
		return ( this.embedPlayer.getPlayerHeight() < 160 )? 160 : this.embedPlayer.getPlayerHeight();
	},

	/**
	* Adds the skin Control Bindings
	*/
	addSkinControlBindings: function() {
		var embedPlayer = this.embedPlayer;
		var _this = this;

		// Set up control bar pointer
		this.$playerTarget = embedPlayer.$interface;
		// Set the menu target:


		// Options menu display:
		this.$playerTarget.find( '.k-options' )
		.unbind()
		.click( function() {
			_this.checkMenuOverlay();
			var $kmenu = _this.$playerTarget.find( '.k-menu' );
			if ( $kmenu.is( ':visible' ) ) {
				_this.closeMenuOverlay( );
			} else {
				_this.showMenuOverlay( );
			}
		} );

	},
	
	/**
	* checks for menu overlay and runs menu bindings if unset
	*/
	checkMenuOverlay: function(){
		var _this = this;
		var embedPlayer = this.embedPlayer;
		if ( _this.$playerTarget.find( '.k-menu' ).length == 0 ) {
			// Stop the player if it does not support overlays:
			if ( !embedPlayer.supports['overlays'] ) {
				embedPlayer.stop();
			}

			// Add the menu binding
			_this.addMenuBinding();
		}
	},

	/**
	* Close the menu overlay
	*/
	closeMenuOverlay: function() {
		mw.log("PlayerSkin: close menu overlay" );

		var $optionsMenu = this.$playerTarget.find( '.k-options' );
		var $kmenu = this.$playerTarget.find( '.k-menu' );
		$kmenu.fadeOut( "fast", function() {
			$optionsMenu.find( 'span' )
				.text ( gM( 'mwe-embedplayer-menu_btn' ) );
		} );
		this.$playerTarget.find( '.play-btn-large' ).fadeIn( 'fast' );

		// re display the control bar if hidden:
		this.showControlBar();

		// Set close overlay menu flag:
		this.keepControlBarOnScreen = false;
	},

	/**
	* Show the menu overlay
	*/
	showMenuOverlay: function( $ktxt ) {
		var $optionsMenu = this.$playerTarget.find( '.k-options' );
		var $kmenu = this.$playerTarget.find( '.k-menu' );

		$kmenu.fadeIn( "fast", function() {
			$optionsMenu.find( 'span' )
				.text ( gM( 'mwe-embedplayer-close_btn' ) );
		} );
		this.$playerTarget.find( '.play-btn-large' ).fadeOut( 'fast' );

		$(this.embedPlayer).trigger( 'displayMenuOverlay' );

		// Set the Options Menu display flag to true:
		this.keepControlBarOnScreen = true;
	},

	/**
	* Adds binding for the options menu
	*
	* @param {Object} $tp Target video container for
	*/
	addMenuBinding: function() {
		var _this = this;
		var embedPlayer = this.embedPlayer;
		// Set local player target pointer:
		var $playerTarget = embedPlayer.$interface;

		// Check if k-menu already exists:
		if ( $playerTarget.find( '.k-menu' ).length != 0 )
			return false;

		// Add options menu to top of player target children:
		$playerTarget.prepend(
			_this.getComponent( 'optionsMenu' )
		);

		// By default its hidden:
		$playerTarget.find( '.k-menu' ).hide();

		// Add menu-items bindings:
		for ( var menuItem in _this.supportedMenuItems ) {
			$playerTarget.find( '.k-' + menuItem + '-btn' ).click( function( ) {

				// Grab the context from the "clicked" menu item
				var mk = $( this ).attr( 'rel' );

				// hide all menu items
				$targetItem = $playerTarget.find( '.menu-' + mk );

				// call the function showMenuItem
				_this.showMenuItem(	mk );

				// Hide the others
				$playerTarget.find( '.menu-screen' ).hide();

				// Show the target menu item:
				$targetItem.fadeIn( "fast" );

				// Don't follow the # link
				return false;
			} );
		}
	},

	/**
	* onClipDone action
	* onClipDone for k-skin (with apiTitleKey) show the "credits" screen:
	*/
	onClipDone: function(){
		if( this.embedPlayer.apiTitleKey ){
			this.checkMenuOverlay( );
			this.showMenuOverlay();
			this.showMenuItem( 'credits' );
		}
	},

	/**
	* Shows a selected menu_item
	*
	* NOTE: this should be merged with parent mw.PlayerControlBuilder optionMenuItems
	* binding mode
	*
	* @param {String} menu_itme Menu item key to display
	*/
	showMenuItem:function( menuItem ) {
		var embedPlayer = this.embedPlayer;
		//handle special k-skin specific display;
		switch( menuItem ){
			case 'credits':
				this.showCredits();
			break;
			case 'playerSelect':
				embedPlayer.$interface.find( '.menu-playerSelect').html(
					this.getPlayerSelect()
				);
			break;
			case 'download' :
				embedPlayer.$interface.find( '.menu-download').text(
					gM('mwe-loading_txt' )
				);
				// Call show download with the target to be populated
				this.showDownload(
					embedPlayer.$interface.find( '.menu-download')
				);
			break;
			case 'share':
				embedPlayer.$interface.find( '.menu-share' ).html(
					this.getShare()
				);
			break;
		}
	},

	/**
	* Show the credit screen ( presently specific to kaltura skin )
	*/
	showCredits: function() {
		// Set up the shortcuts:
		var embedPlayer = this.embedPlayer;
		var _this = this;
				
		var $target = embedPlayer.$interface.find( '.menu-credits' );		
				
		$target.empty().append(
			$('<h2 />')
			.text( gM( 'mwe-embedplayer-credits' ) ),
			$('<div />')
			.addClass( "credits_box ui-corner-all" )
			.loadingSpinner()
		);

		if( mw.getConfig( 'EmbedPlayer.KalturaAttribution' ) == true ){
			$target.append(
				$( '<div />' )
				.addClass( 'k-attribution' )
				.attr({
					'title': gM('mwe-embedplayer-kaltura-platform-title')
				})
				.click( function( ) {
					window.location = 'http://kaltura.com';
				})
			);
		}
		var $creditsTarget = embedPlayer.$interface.find( '.menu-credits .credits_box' );
		
		// Allow modules to load and add credits
		$( embedPlayer ).triggerQueueCallback( 'ShowCredits', $creditsTarget, function( status ){
			// Check if the first ShowCredits binding returned false:  
			if( !status || status[0] == false ){
				$creditsTarget.text(
					gM('mwe-embedplayer-no-video_credits')
				);
			}
		});
	}
};

} )( window.mediaWiki, window.jQuery );

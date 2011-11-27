<?php 
	/**
	 * Do not edit this file instead use LocalSettings.php and 
	 * $wgMwEmbedModuleConfig[ {configuration name} ] = value; format
	 */
	return array (
			// The relative ( or absolute ) path to the EmbedPlayer folder
			'EmbedPlayer.WebPath' => "modules/EmbedPlayer/",
			
			// If the player controls should be overlaid on top of the video ( if supported by playback method)
			// can be set to false per embed player via overlayControls attribute
			'EmbedPlayer.OverlayControls' => true,
			
			// The preferred media codec preference 
			// Note user selected format order 
			'EmbedPlayer.CodecPreference' => array( 'webm', 'h264', 'ogg' ),
	
			// If the iPad should use html controls ( can't use fullscreen or control volume, 
			// but lets you support overlays ie html controls ads etc. )
			'EmbedPlayer.EnableIpadHTMLControls'=> false, 
			
			'EmbedPlayer.LibraryPage'=> 'http://www.kaltura.org/project/HTML5_Video_Media_JavaScript_Library',
	
			// jQuery selector of tags to be re-written by embedPlayer
			// Set to empty string or null to avoid automatic video tag rewrites to embedPlayer
			"EmbedPlayer.RewriteSelector" => "video,audio,playlist",
	
			// Default video size ( if no size provided )
			"EmbedPlayer.DefaultSize" => "400x300",
			
			// If the video player should attribute kaltura
			"EmbedPlayer.KalturaAttribution" => true,
	
			// The attribution button
			'EmbedPlayer.AttributionButton' => array(
				'title' => 'Kaltura html5 video library',
			 	'href' => 'http://www.kaltura.org/project/HTML5_Video_Media_JavaScript_Library',
				// Style icon to be applied
				'class' => 'kaltura-icon',
				// An icon image url ( should be a 12x12 image or data url )
				'iconurl' => false
			),
			
			// If the player should wait for metadata like video size and duration, before trying to draw
			// the player interface. 
			'EmbedPlayer.WaitForMeta' => true,
			
			// Set the browser player warning flag displays warning for non optimal playback
			"EmbedPlayer.ShowNativeWarning" => true,
			
			// If a fullscreen tip to press f11 should be displayed when entering fullscreen 
			"EmbedPlayer.FullscreenTip" => true,
			
			// if the browser should display a warning for direct file links:
			"EmbedPlayer.DirectFileLinkWarning" => false,
			
			// A  link to download firefox
			"EmbedPlayer.FirefoxLink" => 'http://www.mozilla.com/en-US/firefox/upgrade.html?from=mwEmbed',
	
			// If fullscreen is global enabled.
			"EmbedPlayer.EnableFullscreen" => true,
			
			// If the options control bar menu item should be enabled: 
			'EmbedPlayer.EnableOptionsMenu' => true,
	
			// If mwEmbed should use the Native player controls
			// this will prevent video tag rewriting and skinning
			// useful for devices such as iPad / iPod that
			// don't fully support DOM overlays or don't expose full-screen
			// functionality to javascript
			"EmbedPlayer.NativeControls" => false,
	
			// If mwEmbed should use native controls on mobile safari
			"EmbedPlayer.NativeControlsMobileSafari" => true,
	
	
			// The z-index given to the player interface during full screen ( high z-index )
			"EmbedPlayer.FullScreenZIndex" => 999998,
	
			// The default share embed mode ( can be "iframe" or "xssVideo" )
			//
			// "iframe" will provide a <iframe tag pointing to mwEmbedFrame.php
			// 		Object embedding should be much more compatible with sites that
			//		let users embed flash applets
			// "xssVideo" will include the source javascript and video tag to
			//	 	rewrite the player on the remote page DOM
			//		Video tag embedding is much more mash-up friendly but exposes
			//		the remote site to the mwEmbed javascript and can be a xss issue.
			"EmbedPlayer.ShareEmbedMode" => 'iframe',
	
			// The skin framework list: 
			"EmbedPlayer.SkinList" => array( 'mvpcf', 'kskin' ),
			
			// Default player skin name
			"EmbedPlayer.DefaultSkin" => "mvpcf",

			// Number of milliseconds between interface updates
			'EmbedPlayer.MonitorRate' => 250,
	
			// If the embedPlayer should accept arguments passed in from iframe postMessages calls
			'EmbedPlayer.EnableIFramePlayerServer' => false,
			
			// If embedPlayer should support server side temporal urls for seeking options are 
			// flash|always|none default is support for flash only.
			'EmbedPlayer.EnableURLTimeEncoding' => 'flash',
			
			// The domains which can read and send events to the video player
			'EmbedPlayer.IFramePlayer.DomainWhiteList' => '*',
			
			// If the iframe should send and receive javascript events across domains via postMessage 
			'EmbedPlayer.EnableIframeApi' => true,
			
	);	

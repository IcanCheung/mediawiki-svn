
// Wrap in mw closure to avoid global leakage
( function( mw ) {
	
mw.SequencerTimeline = function( sequencer ) {
	return this.init( sequencer );
};

// Set up the mvSequencer object
mw.SequencerTimeline.prototype = {
	// Lazy init $timelineTracksContainer
	$timelineTracksContainer : null,
	
	// Pointer to the track layout 
	trackLayout: null,	
	
	//Default height width of timeline clip:
	timelineThumbSize: {
		'height': 90,
		'width' : 120
	},
	
	// Store the max track length
	maxTrackLength: 0,
	
	init: function( sequencer ){
		this.sequencer = sequencer;
	},

	getTimelineContainer: function(){
		return this.sequencer.getContainer().find('.mwseq-timeline');
	},
	
	/**
	 * Get the timelineTracksContainer
	 */
	getTracksContainer: function( ){
		if( this.getTimelineContainer().find( '.timelineTrackContainer' ).length == 0 ){
			// getTimelineContainer 
			this.getTimelineContainer().append( 
				$j('<div />')
				.addClass('timelineTrackContainer')		
				.append(
					$j('<div />')
					.addClass( 'ui-layout-west trackNamesContainer'),
					
					$j('<div />')
					.addClass( 'ui-layout-center clipTrackSetContainer')
				)
				.css( 'height', this.getTimelineContainerHeight() )
			)
			// Apply layout control to track name / clipTrackSet division  			
			this.trackLayout = this.getTimelineContainer().find( '.timelineTrackContainer')
				.layout( {
					'applyDefaultStyles': true,		
					'west__size' : 150,
					'west__minSize' : 100,
					'west__maxSize' : 300
				} );
		}
		return this.getTimelineContainer().find( '.timelineTrackContainer');
	},
	resizeTimeline: function(){
		this.trackLayout.resizeAll();
	},
	getTimelineContainerHeight: function(){
		var _this = this;
		// Start with vertical space for one more track
		var timelineHeight = mw.getConfig( 'Sequencer.TimelineTrackHeight' );
		var smilSequenceTracks = this.sequencer.getSmil().getBody().getSeqElements();
		$j.each(smilSequenceTracks, function( trackIndex, smilSequenceTrack ){
			timelineHeight+= _this.getSequenceTrackHeight( smilSequenceTrack )
		})
		return timelineHeight;
	},
	// xxx may need to refactor to store collapsed expanded state info 
	getSequenceTrackHeight: function( smilSequenceTrack ){
		if( $j( smilSequenceTrack).attr('tracktype') == 'audio' ){
			return mw.getConfig( 'Sequencer.TimelineColapsedTrackSize') 
		}else{
			return mw.getConfig( 'Sequencer.TimelineTrackHeight' ) 
		}			 
	},
	// Get the selected sequence track index ( for now its always zero )  
	getSelectedTrackIndex: function(){
		return 0;
	},
	
	// Draw the timeline
	drawTimeline: function(){			
		var _this = this;
		// xxx TODO support multiple tracks ::: 
		var smilSequenceTracks = this.sequencer.getSmil().getBody().getSeqElements();
		
		// Draw all the tracks
		$j.each(smilSequenceTracks, function( trackIndex, smilSequenceTrack ){
			_this.drawSequenceTrack( trackIndex, smilSequenceTrack );
		})
	},
	
	drawSequenceTrack: function( trackIndex, smilSequenceTrack ){	
		var _this = this;
		// Tracks by default are video tracks		
		mw.log("SequenceTimeline::drawSequenceTrack: Track inx: " + 
				trackIndex + ' trackType:' + $j ( smilSequenceTrack ).attr('tracktype') );
		// Check if we already have a container for this track set
		
		// Add sequence track name if not present	
		var $clipTrackName = $j( '#' + this.getTrackNameInterfaceId( trackIndex ) );
		if( $clipTrackName.length == 0 ) {
			this.getTracksContainer().find('.trackNamesContainer').append( 
					this.getTrackNameInterface( trackIndex, smilSequenceTrack )
			)
			$clipTrackName = $j( '#' + this.getTrackNameInterfaceId( trackIndex ) );
		}
		// xxx check for specific smilSequenceTrack updates that require TrackNameInterface update
		
		
		// Add Sequence track container if not present 
		var $clipTrackSet = $j( '#' + this.getTrackSetId( trackIndex ))
		mw.log( "SequenceTimeline::drawSequenceTrack: id: " +   $clipTrackSet.length );
		if(  $clipTrackSet.length == 0 ) {			
			this.getTracksContainer().find('.clipTrackSetContainer').append( 
				this.getClipTrackSet( trackIndex , smilSequenceTrack)
			)
			$clipTrackSet = $j( '#' + this.getTrackSetId( trackIndex ));
		}			
		// Draw sequence track clips ( checks for dom updates to smilSequenceTrack )
		this.drawTrackClipsInterface( $clipTrackSet, smilSequenceTrack );
	},

	/**
	 * add Track Clips and Interface binding
	 */
	drawTrackClipsInterface: function( $clipTrackSet, smilSequenceTrack ){
		var _this = this;
		mw.log( 'drawTrackClipsInterface:: existing lenght: ' + 
				$clipTrackSet.children() + ' id: ' + $clipTrackSet.attr('id') );
		// Setup a local pointer to the smil engine: 
		var smil = this.sequencer.getSmil();
		        		
		var $previusClip = null; 
		
		var seqOrder = 0;
		var reOrderTimelineFlag = false;
		
		// Get all the refs that are children of the smilSequenceTrack with associated offsets and durations
		// for now assume all tracks start at zero time:
		var startOffset = 0;		
		smil.getBody().getRefElementsRecurse( smilSequenceTrack, startOffset, function( $node ){			
			var reRenderThumbFlag = false;
			mw.log("ADD: " + _this.getTimelineClipId( $node ) + ' to ' + $clipTrackSet.attr('id') );
			// Draw the node onto the timeline if the clip is not already there:
			var $timelineClip = $clipTrackSet.find( '#' + _this.getTimelineClipId( $node ) )
			if( $timelineClip.length == 0 ){								
				$timelineClip = _this.getTimelineClip( smilSequenceTrack, $node );
				// Set the index order on the clip
				$timelineClip.data( 'indexOrder', $clipTrackSet.children().length );
				if( $previusClip ){
					$previusClip.after( 
						$timelineClip 
					)
				} else { 
					// Add to the start of the track set: 
					$clipTrackSet.prepend( 
						$timelineClip		
					);					
				}			
				reRenderThumbFlag = true;
			} else { 
				// Confirm clip is in the correct indexOrder
				// mw.log( 'indexOrder::' +  $timelineClip.attr('id') + ' '+ $timelineClip.data('indexOrder') + ' == ' + $node.data('indexOrder'));
				if( $timelineClip.data('indexOrder') != $node.data('indexOrder') ){
					reOrderTimelineFlag = true;
				}							
			}
			
			// xxx Check if the start time was changed to set reRenderThumbFlag 
			
			if ( reRenderThumbFlag ){
				// issue a draw Thumb request ( since we reinserted into the dom )
				// Check Buffer for when the first frame of the smilNode can be grabbed: 				
				smil.getBuffer().bufferedSeek( $node, 0, function(){					
					//mw.log("getTrackClipInterface::bufferedSeek for " + smil.getPageDomId( $node ));
					_this.drawClipThumb( $node , 0);
				});
			}
			
			// Update the $previusClip 
			$previusClip = $timelineClip;
			// Update the natural order index 
			seqOrder ++;			
		});	
		
		// Check if we need to re-sort the list
		if( reOrderTimelineFlag ){
			// move every node in-order to the end. 
			smil.getBody().getRefElementsRecurse( smilSequenceTrack, startOffset, function( $node ){		
				var $timelineClip = $clipTrackSet.find('#' + _this.getTimelineClipId( $node ) )				
				$timelineClip.appendTo( $clipTrackSet );
			});
			// Update the order for all clips
			$clipTrackSet.children().each(function (inx, clip){
				$j( clip ).data('indexOrder', inx);
			});	
		}	
		
		// Give the track set a width relative to the number of clips 
		$clipTrackSet.css('width', ($clipTrackSet.find( '.timelineClip' ).length + 1) * 
			( this.timelineThumbSize.width + 12 ) 
		);
		
		// Add global TrackClipInterface bindings:
		var keyBindings = this.sequencer.getKeyBindings();		 
		keyBindings.bindEvent({
			'escape': function(){
				_this.getTimelineContainer().find( '.selectedClip' ).removeClass( 'selectedClip' );
			},
			'delete': function(){
				_this.removeSelectedClips();
			}
		})	
	},
	
	getTrackSetId:function( trackIndex ){
		return this.sequencer.getId() + '_clipTrackSet_' + trackIndex;	
	},
	
	/**
	 * get and add a clip track set to the dom: 
	 */
	getClipTrackSet: function( trackIndex, smilSequenceTrack ){
		var _this = this;
	 			
		return $j('<ul />')
				.attr( 'id',  this.getTrackSetId( trackIndex ))
				.data( 'trackIndex', trackIndex )
				.addClass( 'clipTrackSet ui-corner-all' )
				.css( 'height', _this.getSequenceTrackHeight( smilSequenceTrack ) )
				// Add "sortable
				.sortable({ 
				    placeholder: "clipSortTarget timelineClip ui-corner-all",
				    forcePlaceholderSize: true,
				    opacity: 0.6,	
				    tolerance: 'pointer',
				    cursor: 'move',
				    helper: function( event, helper ){						
						// xxx might need some fixes for multi-track
						var $selected = _this.getTimelineContainer().find( '.selectedClip' )
						if ( $selected.length === 0 ||  $selected.length == 1) { 
							return $j( helper ); 
						} 			
						return $j('<ul />')
							.css({
								'width' : (_this.timelineThumbSize.width + 16) * $selected.length
							})
							.append( $selected.clone() );  
					},
				    scroll: true,
				    update: function( event, ui ) {
						// Check if the movedClip was a timeline clip ( else generate timeline clip )  
						if( ! $j(  ui.item ).hasClass( 'timelineClip' ) ){
							// likely an asset dragged from add-media-wizard 
							// ( future would be cool to support desktop file drag and drop )
							_this.handleDropAsset( ui.item );
						} else {											
							// Update the html dom 
							_this.handleReorder( ui.item );
						}
					}
				})
	},
	// expand the track size by clip length + 1
	expandTrackSetSize: function ( trackIndex ){
		var trackClipCount = this.getTimelineContainer().find( '.clipTrackSet' ).children().length;		
		//mw.log("SequencerTimeline::expandTrackSetSize: " + this.timelineThumbSize.width + ' tcc: ' + trackClipCount + ' ::' +  ( ( this.timelineThumbSize.width + 16) * (trackClipCount + 2) ) );		
		this.getTracksContainer().find('.clipTrackSet').css({ 
			'width' : ( (this.timelineThumbSize.width + 16) * (trackClipCount + 2 ) ) + 'px'
		});
	},
	restoreTrackSetSize: function ( trackIndex ){
		var trackClipCount = this.getTimelineContainer().find( '.clipTrackSet' ).children().length;
		this.getTracksContainer().find('.clipTrackSet').css({ 
			'width' : ( ( this.timelineThumbSize.width + 16) * trackClipCount) + 'px'
		});
	},
	getTimelineClip: function( smilSequenceTrack, $node ){
		var _this = this;
				
		return $j('<li />')
			.attr('id',  _this.getTimelineClipId( $node ) )	
			.data( {
				'smilId': $node.attr('id'),				
			})
			.css( 'height', this.getSequenceTrackHeight( smilSequenceTrack) - 10 )
			.addClass( 'timelineClip ui-corner-all' )
			.loadingSpinner()				
			.click(function(){
				//Add clip to selection
				_this.handleMultiSelect( this );
			})				
	},
	// calls the edit interface passing in the selected clip:
	editClip: function( selectedClip ){
		var smil = this.sequencer.getSmil();
		// get the smil element for the edit tool:
		var smilClip = smil.$dom.find( '#' + $j( selectedClip ).data('smilId') );	
		var toolTarget = this.sequencer.getEditToolTarget();
		this.sequencer.getEditTools().drawClipEditTools( toolTarget, smilClip );
	},	
	
	/**
	 * Remove selected clips and update the smil player
	 */
	removeSelectedClips: function(){				
		var smil = this.sequencer.getSmil();
		this.getTimelineContainer().find( '.selectedClip' ).each(function( inx, selectedClip ){
			// Remove from smil dom:
			smil.removeById( $j(selectedClip).data('smilId') );
			// Remove from timeline dom: 
			$j( selectedClip ).fadeOut('fast', function(){
				$j(this).remove();
			});
		})		
		
		// Invalidate / update embedPlayer duration: 
		this.sequencer.getEmbedPlayer().getDuration( true );

		// Register the edit state for undo / redo 
		this.sequencer.getActionsEdit().registerEdit();
	},
	
	/**
	 * Handles assets dropped into the timeline
	 * xxx TODO right now hard coded to "AddMedia" but eventually we 
	 *  want to support desktop drag and drop
	 */
	handleDropAsset: function( asset ){
		var _this = this;
		// Get the newAsset resource object
		var clipIndex = $j( asset ).index();
		// Get the trackIndex for target track
		var trackIndex = $j( asset ).parent().data( 'trackIndex' );
		
		mw.addLoaderDialog( gM( 'mwe-sequencer-loading-asset' ) );
		
		this.sequencer.getAddMedia().getSmilClipFromAsset( asset, function( smilClip ){
			$j( asset ).remove();			
			_this.insertSmilClipEdit( smilClip, trackIndex, clipIndex );
			mw.closeLoaderDialog();
		});
	},
	
	/**
	 * Insert a smilClip to the smil dom and sequencer and display the edit
	 * 	interface with a 'cancel' insert button
	 */
	insertSmilClipEdit: function( smilClip, trackIndex, clipIndex  ){				
		// Handle optional arguments
		if( typeof trackIndex != 'undefined' ){
			trackIndex = this.getSelectedTrackIndex();
		}
		var $clipTrackSet = $j( '#' + this.getTrackSetId( trackIndex ) );
		if( $clipTrackSet.length == 0 ){
			mw.log( "Error: insertSmilClipEdit could not find track " + trackIndex + " in inteface" );
			return ;
		}
		
		// Before insert ensure the smilClip has an id: 
		this.sequencer.getSmil().getBody().assignIds( $j( smilClip ) );

		// Add the smil resource to the smil track		
		var $smilSequenceTrack = $j( this.sequencer.getSmil().getBody().getSeqElements()[ trackIndex ] );		
		if( typeof clipIndex == 'undefined' || clipIndex >= $smilSequenceTrack.children().length ){
			$smilSequenceTrack.append( 
				$j( smilClip ).get(0)
			)
		} else {
			$smilSequenceTrack.children().eq( clipIndex ).before( 
				$j( smilClip ).get(0) 
			)
		}
		
		// Update the dom timeline
		this.drawTimeline();
		
		// Invalidate / update embedPlayer duration / clip offsets 
		this.sequencer.getEmbedPlayer().getDuration( true );			
		
		// Register the insert edit action
		_this.sequencer.getActionsEdit().registerEdit();
		
		// Select the current clip		
		var $timelineClip = $clipTrackSet.find('#' + this.getTimelineClipId( smilClip ) )
		if( $timelineClip.length == 0 ){
			mw.log("Error: insertSmilClipEdit: could not find clip: " + this.getTimelineClipId( smilClip ) );
		}
		this.getTimelineContainer().find( '.selectedClip' ).removeClass( 'selectedClip' );				
		$timelineClip.addClass( 'selectedClip' );		
		// Seek to the added clip
		this.seekToStartOfClip( $timelineClip );
		
		// Display the edit interface with 'special' cancel button
		this.editClip( $timelineClip );
	},
	
	handleReorder: function ( movedClip ){
		var _this = this;
		var smil = this.sequencer.getSmil();
		var movedIndex = null;				
				
		var clipIndex = $j( movedClip ).index();
		var $movedSmileNode = smil.$dom.find( '#' + $j( movedClip ).data('smilId') );
		var $seqParent = $movedSmileNode.parent();		

		if( clipIndex ==  $seqParent.children().length ){
			$seqParent.append( $movedSmileNode.get(0) );
		} else {
			// see if the index was affected by our move position
			if( clipIndex >= $movedSmileNode.data('indexOrder') ){
				$seqParent.children().eq( clipIndex ).after( $movedSmileNode.get(0) );
			}else{
				$seqParent.children().eq( clipIndex ).before( $movedSmileNode.get(0) );
			}
		}
		// If any other clips were selected add them all after smilNode
		var $selected = _this.getTimelineContainer().find( '.selectedClip' )
		if( $selected.length > 1 ){
			// Move all the non-ordredClip items behind ordredClip
			$selected.each( function( inx, selectedClip ){
				if( $j(selectedClip).attr('id') != $j( movedClip ).attr('id') ){
					// Update html dom
					$j( movedClip ).after( $j( selectedClip ).get(0 ) );
					
					// Update the smil dom
					var $smilSelected = smil.$dom.find( '#' + $j( selectedClip ).data('smilId') );		
					$smilSelected.insertAfter( $movedSmileNode.get(0) );
				}
			});	
		}
		
		// Update the order for all clips
		$seqParent.children().each(function (inx, clip){
			$j( clip ).data('indexOrder', inx);
		});
		
		// Invalidate / update embedPlayer duration / clip offsets 
		_this.sequencer.getEmbedPlayer().getDuration( true );
		
		// Register the edit state for undo / redo 
		_this.sequencer.getActionsEdit().registerEdit();
	},
	
	/**
	 * Handle multiple selections based on what clips was just "cliked" 
	 */
	handleMultiSelect: function( clickClip ){
		var _this = this;
		var keyBindings = this.sequencer.getKeyBindings();
		var $target = this.getTimelineContainer();
		var smil = this.sequencer.getSmil();
		var embedPlayer = this.sequencer.getEmbedPlayer();
		
		
		// Add the selectedClip class to the clickClip
		if( $j( clickClip ).hasClass( 'selectedClip') && 
			( 	
				$target.find( '.selectedClip' ).length == 1 
				||
				keyBindings.ctrlDown
			) 
		){
			$j( clickClip ).removeClass( 'selectedClip' );
		}else {
			$j( clickClip ).addClass( 'selectedClip' );
		}
		
		// If not in multi select mode remove all existing selections except for clickClip
		mw.log( ' HandleMultiSelect::' + keyBindings.shiftDown + '  ctrl_down:' + keyBindings.ctrlDown );
		
		if ( ! keyBindings.shiftDown && ! keyBindings.ctrlDown ) {
			$target.find( '.selectedClip' ).each( function( inx, selectedClip ) {
				if( $j( clickClip ).attr('id') != $j( selectedClip ).attr('id') ){
					$j( selectedClip ).removeClass('selectedClip');
				}	
			} );
		}
		
		// Seek to the current clip time ( startOffset of current )
		this.seekToStartOfClip( clickClip );
		
		// if shift select is down select the in-between clips
		if( keyBindings.shiftDown ){
			// get the min max of current selection (within the current track)
			var maxOrder = 0;
			var minOrder = false;
			$target.find( '.timelineClip' ).each( function( inx, curClip) {	
				if( $j(curClip).hasClass('selectedClip') ){
					// Set min max
					if ( minOrder === false || inx < minOrder ){
						minOrder = inx;
					}
					if ( inx > maxOrder ){
						maxOrder = inx;
					}
				}
			} );
			// select all non-selected between max or min
			$target.find( '.timelineClip' ).each( function( inx, curClip) {	
				if( inx > minOrder && inx < maxOrder ){
					$j(curClip).addClass( 'selectedClip')
				}
			});	
		}
		
		// Update the edit Tools window
		var $selectedClips =  _this.getTimelineContainer().find('.selectedClip');
		// zero clips selected
		var $toolTarget = _this.sequencer.getEditToolTarget();
		
		//( on an edit screen update the edit screen per selection )
		if( $toolTarget.find( '.editToolsContainer' ).length != 0 ){			
			// multiple clips selected
			if( $selectedClips.length == 0 ){
				// Update edit window to no selected clips
				$toolTarget.empty().append( 
					gM( 'mwe-sequencer-no_selected_resource'  ),
					$j('<div />').addClass('editToolsContainer')
				)
			} else if( $selectedClips.length > 1 ){
				$toolTarget.empty().append( 
					gM( 'mwe-sequencer-error_edit_multiple' ),
					$j('<div />').addClass('editToolsContainer')
				)
			} else {
				// A single clip is selected edit that clip   
				_this.editClip( clickClip );
			}
			// Register the edit tools update for undo
			_this.sequencer.getActionsEdit().registerEdit();
		}
	},
	
	/**
	 * Seek to the start of a given timelineClip
	 */
	seekToStartOfClip: function( timelineClip ){		
		var seekTime = this.sequencer
			.getSmil()
			.$dom.find( '#' + $j( timelineClip ).data('smilId') )
			.data( 'startOffset' );
		
		this.sequencer.getEmbedPlayer().setCurrentTime( seekTime, function(){
			mw.log("handleMultiSelect::seek done")
		});
	},
		
	getTimelineClipId: function( $node ){
		return this.sequencer.getSmil().getPageDomId( $node ) + '_timelineClip';
	},
	
	// Draw a clip thumb into the timeline clip target
	drawClipThumb: function ( $node , relativeTime ){		
		var _this = this;
		var smil = this.sequencer.getSmil();	
		
		var clipButtonCss = {
			'position' : 'absolute',
			'bottom' : '2px',
			'padding' : '2px',
			'cursor' : 'pointer'
		};
		
		var $timelineClip = $j( '#' + _this.getTimelineClipId( $node ) );
		// Add Thumb target and remove loader
		$timelineClip.empty().append(
								
			$j('<div />')					
			.addClass("thumbTraget"),

			// Edit clip button: 
			$j('<div />')
			.css( clipButtonCss )
			.css({				
				'right' : '32px'			
			})
			.addClass( 'clipEditLink ui-state-default ui-corner-all' )
			.append( 
				$j('<span />')
				.addClass( 'ui-icon ui-icon-wrench' )
			)
			.hide()
			.buttonHover()
			.click( function(){
				_this.editClip( $timelineClip )
			}),
			
			// Remove clip button: 
			$j('<div />')
			.css( clipButtonCss )
			.css({			
				'right' : '5px'				
			})
			.addClass( 'clipRemoveLink ui-state-default ui-corner-all' )
			.append( 
				$j('<span />')
				.addClass( 'ui-icon ui-icon-trash' )
			)
			.hide()
			.buttonHover()
			.click( function(){				
				// Remove the associated clip:				
				_this.getTimelineContainer().find('.selectedClip').removeClass( 'selectedClip' );				
				$timelineClip.addClass( 'selectedClip' );
				_this.removeSelectedClips();
			})
		)
		// Add mouse over thumb "edit", "remove"  button
		.hover(
			function(){
				$timelineClip.find('.clipEditLink,.clipRemoveLink').fadeIn();
			},
			function(){
				$timelineClip.find('.clipEditLink,.clipRemoveLink').fadeOut();
			}
		)
		// remove loader
		.find('.loadingSpinner').remove();
		
		var $thumbTarget = $j( '#' + _this.getTimelineClipId( $node ) ).find('.thumbTraget');
		
		// Check for a "poster" image use that temporarily while we wait for the video to seek and draw
		if( $node.attr('poster') ){			
			var img = new Image();
			$j( img )
			.css( {
				'top': '0px',
				'position' : 'absolute',
				'opacity' : '.9',
				'left': '0px',
				'height': _this.timelineThumbSize.height
			})
			.attr( 'src', smil.getAssetUrl( $node.attr('poster') ) )
			.load( function(){			
				if( $thumbTarget.children().length == 0 ){
					$thumbTarget.html( img );	
				}
			});
			
			// Sometimes the load event does not fire force the fallback image after 5 seconds
			setTimeout( function(){
				if( $thumbTarget.children().length == 0 ){
					$thumbTarget.html( img );	
				}
			}, 5000);
		}			
		
		// Buffer the asset then render it into the layout target:		
		smil.getBuffer().bufferedSeek( $node, relativeTime, function(){					
			// Add the seek, add to canvas and draw thumb request
			smil.getLayout().drawElementThumb( $thumbTarget, $node, relativeTime );
		
		})
	},
	/**
	 * Gets an sequence track control interface 
	 * 	features to add :: expand collapse, hide, mute etc. 
	 * 	for now just audio or video with icon 
	 */
	getTrackNameInterface: function( trackIndex,  smilSequenceTrack ){
		mw.log( 'SequencerTimeline:: getTrackNameInterface : ' + trackIndex);
		
		var $trackNameContainer = $j('<div />')
			.attr('id', this.getTrackNameInterfaceId( trackIndex ) )
			.addClass('trackNames ui-corner-all')
		
		var $trackNameTitle = 					
			$j('<a />')
			.attr('href','#')
			.addClass( "ui-icon_link" );		
			
		if( $j( smilSequenceTrack).attr('tracktype') == 'audio' ){
			$trackNameTitle.append( 				
					$j('<span />').addClass( 'ui-icon ui-icon-volume-on'),
					$j('<span />').text( gM( 'mwe-sequencer-audio-track' ) )
				)
		} else {
			// for now default to "video" tracktype
			$trackNameTitle.append( 				
					$j('<span />').addClass( 'ui-icon ui-icon-video'),
					$j('<span />').text( gM( 'mwe-sequencer-video-track' ) )
				)			
		}
		// Set track name height
		$trackNameContainer.css({
			'height' : this.getSequenceTrackHeight( smilSequenceTrack )
		});
		
		// Add the track title as a title attribute 
		if ( $j( smilSequenceTrack ).attr('title') ){
			$trackNameTitle.find('span').attr('title', $j( smilSequenceTrack ).attr('title') );
		} 
		
		$trackNameContainer.append( $trackNameTitle )
		// Wrap the track name in a box that matches the trackNames 
		return $trackNameContainer;
	},
	getTrackNameInterfaceId: function(trackIndex ){
		return this.sequencer.getId() + '_trackName_' + trackIndex;
	},
	
	getSequenceTrackId: function( index, smilSequenceTrack ){
		if( ! $j( smilSequenceTrack ).data('id') ){
			$j( smilSequenceTrack ).data('id', this.sequencer.getId() + '_sequenceTrack_' + index );
		}
		return  $j( smilSequenceTrack ).data('id');		
	}
}	
	
	
} )( window.mw );	
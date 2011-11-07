
//
//Views
//

var ChatView = Backbone.View.extend({
	tagName: 'li',
	template: _.template( $('#message-template').html() ),
	inlineTemplate: _.template( $('#inline-alert-template').html() ),

	initialize: function(options) {
		_.bindAll(this, 'render');
		this.model.bind('all', this.render);
	},

	render: function(type){
		//$().log("ABOUT TO RENDER THIS CHAT MESSAGE: " + JSON.stringify(this.model));
		
		// Inline Alerts have may have i18n messages in them. If so (and they don't have 'text' yet), process the message and cache it in 'text'.
		// This needs to be done before the template processing below so that 'text' will be set by then.
		if(this.model.get('text') == ''){
			$().log("Found an i18n message with msg name " + this.model.get('wfMsg') + " and params: " + this.model.get('msgParams'));
			var i18nText = $.msg(this.model.get('wfMsg'), this.model.get('msgParams'));
			this.model.set({text: i18nText});
			$().log("Message translated to: " + i18nText);
		}

		if(this.model.get('isInlineAlert')){
			var originalTemplate = this.template;
			this.template = this.inlineTemplate;
			$(this.el).html(this.template(this.model.toJSON()));
			this.template = originalTemplate;
		} else {
			$(this.el).html(this.template(this.model.toJSON()));
		}
		
		$(this.el).attr('id', 'entry-' + this.model.cid );
		
		// Add username as a class in li element
		if (this.model.get('name')) {
			$(this.el).attr('data-user', this.model.get('name'));
		}

		// Add "continued" class if this user also typed the last message (combines in UI)
		if (type == 'change' || typeof(type) == 'undefined') {
			if (this.model.get('continued') === true) {
				$(this.el).addClass('continued');
			}
		}
		
		// Add a special "you" class for styling your own messages
		if (this.model.get('name') == wgUserName) {
			$(this.el).addClass('you');
		}

		// Inline Alert
		if(this.model.get('isInlineAlert') === true){
			$(this.el).addClass('inline-alert');
		}
		
		// Timestamps
		if(this.model.get('timeStamp').toString().match(/^\d+$/)) {
			var date = new Date(this.model.get('timeStamp'));
			var hours;
			if (date.getHours() == 0) {
				hours = 12;
			} else if (date.getHours() > 12) {
				hours = date.getHours() - 12;
			} else {
				hours = date.getHours();
			}
			var minutes = (date.getMinutes().toString().length == 1) ? '0' + date.getMinutes() : date.getMinutes();
			$(this.el).find('.time').text(hours + ':' + minutes);
		}
		
		return this;
	}
});

var UserView = Backbone.View.extend({
	tagName: 'li',
	className: 'User',
	template: _.template( $('#user-template').html() ),

	/*
	events: {
		"click .kickban"            : "toggleDone",
	},
	*/

	initialize: function(){
		_.bindAll(this, 'render', 'close');
		this.model.bind('change', this.render);
		this.model.view = this;
	},

	render: function(){
		//$().log("ABOUT TO RENDER THIS USER: " + JSON.stringify(this.model));
		$(this.el).html( this.template(this.model.toJSON()) );
		
		// Set the id by username so that we can remove it when the user parts.
		
		
		$(this.el).attr('id', this.liId());
		$(this.el).attr('data-user', this.model.get('name'));

		// If this is a chat moderator, add the chat-mod class so that kick-ban links don't show up, etc.
		if(this.model.get('isModerator') === true){
			$(this.el).addClass('chat-mod');
		}
		
		if(this.model.get('isStaff') === true){
			$(this.el).addClass('staff');
		}
		
		
		// If the user is away, add a certain class to them, if not, remove the away class.
		if(this.model.get('statusState') == STATUS_STATE_AWAY){
			$(this.el).addClass('away');
		} else {
			$(this.el).removeClass('away');
		}

		// If this is you, render your content on top.
		if( this.model.get('name') == wgUserName ){
			$().log("Attempting to render self. Copying up to other div.");
			$(this.el).css('display', 'none');
			$('#ChatHeader .User').html( $(this.el).html() )
								  .attr('class', $(this.el).attr('class') );
		}

		return this;
	},
	
	liId: function(){
		var prefix = "";
		
		if( this.model.get('isPrivate') === true ) { 
			prefix = "priv-";
		}
		username = this.model.get('name').replace(/ /g, "_"); // encodeURIComponent would add invalid characters
		return prefix + 'user-' + username;
	},
	
	getUserElement: function() {
		return $(document.getElementById(this.liId()));
	}
});

var NodeChatDiscussion = Backbone.View.extend({
	initialize: function(options) {
		this.roomId = options.roomId;
		this.model = options.model;
		this.model.chats.bind('afteradd', $.proxy(this.addChat, this));
		this.model.chats.bind('clear', $.proxy(this.clear, this));
		        
		this.delegateEventsToTrigger(this.triggerEvents, function(e){
			return e;
		});
		
		$("#WikiaPage").append($('<div style="display:none" id="Chat_' + this.roomId + '" class="Chat"><ul></ul></div>'));
		this.chatDiv = $("#Chat_" + this.roomId );
		this.chatUL = $("#Chat_" + this.roomId + " ul");

		$("#Chat_" + this.roomId + " a").live('click', $.proxy(function(e) { 
			this.trigger('clickAnchor', e); 
			e.preventDefault(); 
        },this)); 
		
		this.model.room.bind('change', $.proxy(this.updateRoom, this));
	},
	//TODO: divide to NodeChatDiscussion and NodeChatUsers
	updateRoom: function(status) {
		var count = $('#MsgCount_' + status.get('roomId'));
		var room = count.closest('.User, .wordmark');
		var privateHeader = $('#Rail > .private');
		
		if(status.get('unreadMessage') > 0 ) {
			count.text(status.get('unreadMessage'));	
			room.addClass('unread');
		} else {
			room.removeClass('unread');	
		}
		
		if(status.get('isActive') === true) {
			room.addClass('selected');
			
			if(status.get('blockedMessageInput') === true ) {

				$('#Write').addClass('blocked');
				$('#Write textarea').attr("disabled", "disabled");
			} else {
				$('#Write').removeClass('blocked');
				$('#Write textarea').removeAttr("disabled");
			}	
			
			this.show();
			if(status.get('privateUser') === false ) {
		 		$('#ChatHeader .public').show();
		 		$('#ChatHeader .private').hide();
			} else {
		 		$('#ChatHeader .public').hide();
		 		$('#ChatHeader .private').text($.msg('chat-private-headline').replace('$1', status.get('privateUser').get('name'))).show();
			}
		} else {
			room.removeClass('selected');
			this.hide();
		}
		
		if(status.get('blockedMessageInput') === true ) {
			room.addClass('blocked');
		} else {
			room.removeClass('blocked');
		}
		
		if(status.get('hidden') === true ) {
			room.hide();
		} else {
			room.show();
		}
		
		// Handle hiding/showing private chat header
		($('#PrivateChatList .User:visible').length) ? privateHeader.show() : privateHeader.hide();
		
	},
	
	getTextInput: function() {
		return $('#Write [name="message"]');
	},

	show: function() {
		this.chatDiv.show();
		this.scrollToBottom();
	},
	
	hide: function() {
		this.chatDiv.hide();
	},
	
	triggerEvents: {
			"keypress #Write": "sendMessage"
	},
	
	clear: function(chat) {
		this.chatUL.empty(); 	
	},
	
	addChat: function(chat) {
		// Determine if chat view is presently scrolled to the bottom
		var isAtBottom = false;				
		if (( this.chatDiv.scrollTop() + 1) >= (this.chatUL.outerHeight() - this.chatDiv.height())) {
			isAtBottom = true;
		}
		
		// Add message to chat
		var view = new ChatView({model: chat});
		this.chatUL.append(view.render().el);

		// Scroll chat to bottom
		if (chat.attributes.name == wgUserName || isAtBottom) {
			this.scrollToBottom();
		}
	},
	
	scrollToBottom: function() {
		this.chatDiv.scrollTop(this.chatDiv.get(0).scrollHeight);	
	}
});
//TODO: raname it to frame NodeChatFrame ? 
var NodeChatUsers = Backbone.View.extend({
	actionTemplate: _.template( $('#user-action-template').html() ),
	initialize: function(options) {
		this.model.users.bind('add', this.addUser);
		this.model.users.bind('remove', this.removeUser);
		
		this.model.privateUsers.bind('add', this.addUser);
		this.model.privateUsers.bind('remove', this.removeUser);
		
        $("#ChatHeader a").click($.proxy(function(e) { 
            this.trigger('clickAnchor', e); 
            e.preventDefault(); 
        },this)); 
		
		this.delegateEventsToTrigger(this.triggerEvents, function(e) {
    		e.preventDefault();
    		var name = $(e.target).closest('.UserStatsMenu').find('.username').text();
    		if(!(name.length > 0)) {
    			name = $(e.target).closest('li').find('.username').first().text();
    		}
    		return { 'name': name, 'event': e, 'target': $(e.target).closest('li')}; 
		});
		
		$("#Rail .wordmark").live("click", function(event) {
			event.preventDefault();
			window.mainRoom.showRoom('main');
		});
		
		// Hide/show main chat user list
		$('#Rail .chevron').click(function() {
			if ($('#WikiChatList').is(':visible')) {
				$(this).addClass('closed');
				$('#WikiChatList').slideUp('fast');
			} else {
				$(this).removeClass('closed');
				$('#WikiChatList').slideDown('fast');
			}
		});
	},
	
	triggerEvents: {
			"click .kickban": "kickBan",
			"click .give-chat-mod": "giveChatMod",
			"click .private-block": "blockPrivateMessage",
			"click .private-allow": "allowPrivateMessage",
			"click .private": "showPrivateMessage",
			"click #WikiChatList li": "mainListClick",
			"click #PrivateChatList li": "privateListClick"
	},
	
 	clearPrivateChatActive: function() {
 		$("#PrivateChatList li").removeClass('selected');
 	},
		
	addUser: function(user) {
		var view = new UserView({model: user});
		var list = (user.attributes.isPrivate) ? $('#PrivateChatList') : $('#WikiChatList');
		
		var el = $(view.render().el);

		// For private chats, show private headline and possibly select the chat		
		if(user.get('isPrivate')) {
			$('#Rail h1.private').show();
			if(user.get('active')) {
				el.addClass('selected');	
			}
		}
	
		// Add users to list
		if (list.children().length) {
			// The list is not empty. Arrange alphabetically.
			var compareA = el.data('user').toUpperCase();
			var wasAdded = false;
			list.children().each(function(idx, itm) {
				compareB = $(itm).data('user').toUpperCase();
				//TODO: check it
				if (compareA == compareB) {
					return false;
				}
				if (compareA < compareB) {
					$(itm).before(el);
					wasAdded = true;
					return false;
				}
			});
			if (!wasAdded) {
				list.append(el);
			}
		} else {
			// The list is empty. Append this user.
			list.append(el);
		}
		
		// Scroll the list down if a new private chat is being added
		if (user.get('isPrivate')) {
			$().log('UserView SCROLL DOWN!!!');
			$('#Rail').scrollTop($('#Rail').get(0).scrollHeight);		
		}
		
		// Only show chevron in public chat if there is anyone to talk to
		if (list.children().length > 1) {
			$('#Rail .public .chevron').show();
		} else {
			$('#Rail .public .chevron').hide();
		}		
	},
	
	removeUser: function(user) {
		var view = new UserView({model: user});
		view.getUserElement().remove();
	},

	showMenu: function(element, actions) {
		var menu = $("#UserStatsMenu");
		
		menu
			.html($(element).find('.UserStatsMenu').html())
			.css('left', $(element).offset().left - menu.outerWidth() + 10)
			.css('top', $(element).offset().top);
		
		var menuActions = $("#UserStatsMenu .actions");
		
		for( var i in actions ) {
			menuActions.append( this.actionTemplate( {actionName: actions[i] , actionDesc: $.msg('chat-user-manu-' + actions[i]) } ) );	
		}
		
		// Is the menu falling below the viewport? If so, move it!				
		if (parseInt(menu.css('top')) + menu.outerHeight() > $(window).height()) {
			menu.css('top', $(window).height() - menu.outerHeight());
		}
		
		// Add chat-mod class if necessary
		($(element).hasClass('chat-mod')) ? menu.addClass('chat-mod') : menu.removeClass('chat-mod');
		
		menu.show();

		// Bind event handler to body to close the menu			
		$('body').bind('click.menuclose', function(event) {
			if (!$(event.target).closest('#UserStatsMenu').length) {
				$('#UserStatsMenu').hide();
				$('body').unbind('.menuclose');
			};
		});
		
		// Handle clicking the profile and contrib links
		menu.find('.profile').add('.contribs').click(function(event) {
			event.preventDefault();
			var target = $(event.currentTarget);
			var menu = target.closest('.UserStatsMenu');
			var username = menu.find('.username').text();
			var location = '';
			
			if (target.hasClass('profile')) {
				location = pathToProfilePage.replace('$1', username);
			} else if (target.hasClass('contribs')) {
				location = pathToContribsPage.replace('$1', username);
			}
							
			window.open(location);
			menu.hide();
		});		
	}, 
	hideMenu: function() {
		$("#UserStatsMenu").hide();
	}
});

/*
 * add method to Backbone to give possibility to export events to controler
 */

Backbone.View.prototype.delegateEventsToTrigger = function(events, preProcess) {
    for (var key in events) {
    	var event = events[key];
    	var view = this;
    	this[ event ] = (function(event){ return function(e) {  
    		view.trigger( event, preProcess(e) ); }; 
    	})(event);
    }	
   
	this.delegateEvents(this.triggerEvents);
};

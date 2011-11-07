/**
 * @author Sean Colombo
 *
 * This file contains config that will be used by both the node chat server and the Node Chat API.
 */

var md5 = require("./lib/md5.js").md5;

var wgScript = '/wiki/index.php';

/** CONSTANTS **/
exports.CHAT_SERVER_PORT = 8000;
exports.API_SERVER_PORT = 8001;
exports.MAX_MESSAGES_IN_BACKLOG = 50; // how many messages each room will store for now. only longer than NUM_MESSAGES_TO_SHOW_ON_CONNECT for potential debugging.
exports.NUM_MESSAGES_TO_SHOW_ON_CONNECT = 10;
exports.AUTH_URL = wgScript + "?action=ajax&rs=ChatAjax&method=getUserInfo"; // do NOT add hostname into this URL.
exports.KICKBAN_URL = wgScript + "?action=ajax&rs=ChatAjax&method=kickBan";
exports.GIVECHATMOD_URL = wgScript + "?action=ajax&rs=ChatAjax&method=giveChatMod";
exports.WIKIA_PROXY_HOST = "";
exports.WIKIA_PROXY_PORT = "";

// Settings for local varnish
exports.WIKIA_PROXY_HOST = "127.0.0.1";
exports.WIKIA_PROXY_PORT = 6081;


/** KEY BUILDING / ACCESSING FUNCTIONS **/
exports.getKey_listOfRooms = function( cityId, type, users ){
	var users = users || [];
	users = users.sort();
	if(type == "open") {
		return "rooms_on_wiki:" + cityId;	
	} else {
		return "rooms_on_wiki:" + cityId + ':' + md5( type + users.join( ',' ) );
	}
}

exports.getKey_nextRoomId = function(){ return "next.room.id"; }
exports.getKeyPrefix_room = function(){ return "room"; }


exports.getKey_UserCounts = function(){ return "UserCounts"; }

exports.getKey_sessionData = function(key){ return "session_data:" + key; }

exports.getKey_room = function(roomId){ return exports.getKeyPrefix_room() + ":" + roomId; }
exports.getKey_userInRoom = function(userName, roomId){
	// Key representing the presence of a single user in a specific room (that user may be in multiple rooms).
	// used by the in-memory sessionIdByKey hash, not by redis.. so not prefixed.
	return roomId + ":" + userName;
}

exports.getKeyPrefix_usersInRoom = function(){ return "users_in_room"; }
exports.getKey_usersInRoom = function(roomId){ return exports.getKeyPrefix_usersInRoom() +":" + roomId; } // key for set of all usernames in the given room

exports.getKeyPrefix_usersAllowedInPrivRoom = function( roomId ){ return "users_allowed_in_priv_room"; }
exports.getKey_usersAllowedInPrivRoom = function( roomId ){ return exports.getKeyPrefix_usersAllowedInPrivRoom() + ":" + roomId; }

exports.getKey_chatEntriesInRoom = function(roomId){ return "chatentries:" + roomId; }

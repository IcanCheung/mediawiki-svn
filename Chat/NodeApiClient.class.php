<?php
/**
 * Even though the Predis 5.2 backport works swimmingly, given the layout of our network (chat server and its local redis instance running in the public network)
 * and the fact that redis is essentially unsecured, it is not safe for our MediaWiki server to make requests to redis.
 *
 * To allow the MediaWiki app to interface with the chat data in redis, there is a simple API running from the same server.js script as the main chat server (on a
 * different port though).  This API will encapsulate simple tasks that require access to the redis server.
 *
 * @author Sean Colombo
 */
class NodeApiClient {
	
	const API_HOST_AND_PORT_PRODUCTION = "127.0.0.1:8001";
	
	const HOST_PRODUCTION_FROM_CLIENT = "127.0.0.1";
	const PORT = "8000"; // port of the chat server (as opposed to the Node API)

	/**
	 * Given a roomId, fetches the wgCityId from redis. This will
	 * allow the auth class to verify that the room is in the same
	 * that the connection is attempting to be made from (prevents
	 * circumventing bans by connecting to Wiki A's chat via Wiki B).
	 */
	static public function getCityIdForRoom($roomId){
		wfProfileIn(__METHOD__);

		$cityId = "";
		$cityJson = NodeApiClient::makeRequest(array(
			"func" => "getCityIdForRoom",
			"roomId" => $roomId
		));
		$cityData = json_decode($cityJson);
		if(isset($cityData->{'cityId'})){
			$cityId = $cityData->{'cityId'};
		} else {
			// FIXME: How should we handle it if there is no cityId?
		}

		wfProfileOut( __METHOD__ );
		return $cityId;
	} // end getCityIdForRoom()

	/**
	 * Returns the id of the default chat for the current wiki.
	 *
	 * If the chat doesn't exist, creates it.
	 *
	 * @param roomName - will be filled with the name of the chat (a string stored in VARCHAR(255), so it's reasonable length)
	 * @param roomTopic - will be filled with the topic of the chat (a string stored in a blob, so it might be fairly large).
	 */
	static public function getDefaultRoomId(&$roomName, &$roomTopic, $roomType = "open", $roomUsers = array() ){
		global $wgCityId, $wgSitename, $wgServer, $wgArticlePath, $wgMemc;
		wfProfileIn(__METHOD__);

		if(empty($roomData)){
			// Add some extra data that the server will want in order to store it in the room's hash.
			$extraData = array(
				'wgServer' => $wgServer,
				'wgArticlePath' => $wgArticlePath
			);
			$extraDataString = json_encode($extraData);
			
			$roomId = "";
			$roomJson = NodeApiClient::makeRequest(array(
				"func" => "getDefaultRoomId",
				"wgCityId" => $wgCityId,
				"roomType" => $roomType,
				"roomUsers" => $roomUsers,
				"defaultRoomName" => $wgSitename,
				"defaultRoomTopic" => wfMsg('chat-default-topic', $wgSitename),
				"extraDataString" => $extraDataString
			));
			
			$roomData = json_decode($roomJson);
		}

		if(isset($roomData->{'roomId'})){
			$roomId = $roomData->{'roomId'};
			$roomName = $roomData->{'roomName'};
			$roomTopic = $roomData->{'roomTopic'};
		} else {
			// FIXME: How should we handle it if there is no roomId?
		}

		wfProfileOut( __METHOD__ );
		return $roomId;
	} // end getDefaultRoomId()


	static public function getChatters($roomId, $maxChatters, &$numInRoom=0) {
		global $wgMemc;
		wfProfileIn(__METHOD__);

		// Since this is used on every page render & involves a network request to the node servers, cache the results
		// in memcached (but only for a short time because it needs to be very close to "live" to interest people).
		$memKey = wfMemcKey("NodeApiClient::getChatters", $roomId, $maxChatters);
		
		$data = $wgMemc->get($memKey);
		if(!$data){
			$data['numInRoom'] = 0;
			$data['chatters'] = array();

			$usersInRoomJson = NodeApiClient::makeRequest(array(
				"func" => "getUsersInRoom",
				"roomId" => $roomId
			));
			$usersInRoomData = json_decode($usersInRoomJson);

			// Allow calling code to find the total number of users in the room.
			$data['numInRoom'] = count($usersInRoomData);

			// Get the avatar urls for the subset of users which we want avatars for.
			for($index=0; (($index < count($usersInRoomData)) && ($index < $maxChatters)); $index++){
				$data['chatters'][] = array('username' => $usersInRoomData[$index]);
			}

			$wgMemc->set($memKey, $data, 30); // only cache for a short time... needs to be pretty fresh (this might even be too long).
		}
		
		// Allow calling code to find the total number of users in the room (by reference).
		$numInRoom = $data['numInRoom'];

		wfProfileOut( __METHOD__ );
		return $data['chatters'];
	}


	/**
	 * Does the request to the Node server and returns the responseText (empty string on failure).
	 */
	static private function makeRequest($params){
		wfProfileIn( __METHOD__ );
		
		$requestUrl = "http://" . NodeApiClient::getHostAndPort() . "/api?" . http_build_query($params);
		$response = Http::get( $requestUrl );
		if($response === false){
			$response = "";
		}

		wfProfileOut( __METHOD__ );
		return $response;
	}

	/**
	 * Return the appropriate host and port for the client to connect to.
	 * This is based on whether this is dev or prod, but can be overridden
	 */
	static protected function getHostAndPort(){
		$hostAndPort = NodeApiClient::API_HOST_AND_PORT_PRODUCTION;
		return $hostAndPort;
	} // end getHostAndPort()

}

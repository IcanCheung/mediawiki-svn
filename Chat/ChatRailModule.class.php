<?php
class ChatRailModule extends Module {
	const MAX_CHATTERS = 6;
	const AVATAR_SIZE = 50;
	var $linkToSpecialChat;
	var $windowFeatures;
	var $chatHeadline;
	var $profileAvatar;
	var $totalInRoom;
	var $chatters;
	var $buttonIconUrl;
	var $buttonText;
	var $isLoggedIn;
	var $chatClickAction;	

	/**
	 * Render placeholder. Content will be ajax-loaded for freshness
	 */
	public function executePlaceholder() {
		global $wgOut, $wgExtensionsPath;
		$wgOut->addScript('<script src="'.$wgExtensionsPath.'/wikia/Chat/js/ChatRailModule.js"></script>');
		$wgOut->addStyle(AssetsManager::getInstance()->getSassCommonURL('extensions/wikia/Chat/css/ChatRailModule.scss'));
	}
	
	public function executeAnonLoginSuccess() {
		global $wgExtensionsPath; 
		
		$this->linkToSpecialChat = SpecialPage::getTitleFor("Chat")->escapeLocalUrl();
		$this->windowFeatures = $this->getWindowFeatures();	
		$this->buttonIconUrl = $wgExtensionsPath .'/wikia/Chat/images/chat_icon.png';
		if ( !empty($this->totalInRoom) ) {
			$this->buttonText = wfMsg('chat-join-the-chat');
		} else {
			$this->buttonText = wfMsg('chat-start-a-chat');		
		}
		$this->chatClickAction = "window.open('{$this->linkToSpecialChat}', 'wikiachat', '{$this->windowFeatures}'); $('.modalWrapper').closeModal();";
	}
	
	/**
	 * Render module contents - loaded via ajax only for freshness
	 */
	public function executeContents(){
		global $wgUser, $wgSitename, $wgOut, $wgExtensionsPath, $wgContLang;
		wfProfileIn( __METHOD__ );

		// Main variables
		$this->linkToSpecialChat = SpecialPage::getTitleFor("Chat")->escapeLocalUrl();
		$this->windowFeatures = $this->getWindowFeatures();
		$this->chatHeadline = wfMsg('chat-headline', $wgSitename);
		$this->isLoggedIn = $wgUser->isLoggedIn();
		if($wgUser->isLoggedIn()){
			$this->profileAvatar = AvatarService::renderAvatar($wgUser->getName(), ChatRailModule::AVATAR_SIZE);
		} else {
			$this->profileAvatar = "";
		}

		// List of other people in chat
		$this->totalInRoom = 0;
		$roomName = $roomTopic = ""; // just needed for pass-by-reference... will be ignored
		$roomId = NodeApiClient::getDefaultRoomId($roomName, $roomTopic); // get id of default chat for the wiki
		
		// Gets array of users currently in chat to populate rail module and user stats menus
		$chatters = NodeApiClient::getChatters($roomId, ChatRailModule::MAX_CHATTERS, $this->totalInRoom);
		for ($i = 0; $i < count($chatters); $i++) {
			// avatar
			$chatters[$i]['avatarUrl'] = AvatarService::getAvatarUrl($chatters[$i]['username'], ChatRailModule::AVATAR_SIZE);
			
			// get stats for edit count and member since
			$user = User::newFromName($chatters[$i]['username']);
			if(is_object($user)){
				$userStatsService = new UserStatsService($user->getId());
				$stats = $userStatsService->getStats();

				// edit count
				$chatters[$i]['editCount'] = (int) $wgContLang->formatNum($stats['edits']);
				
				// member since
				$chatters[$i]['showSince'] = $chatters[$i]['editCount'] != 0;
				$chatters[$i]['since'] = date("M Y", strtotime($stats['date']));
				
				// profile page
				$chatters[$i]['profileUrl'] = Title::makeTitle( NS_USER, $chatters[$i]['username'] )->getFullURL();
				
				// contribs page
				$chatters[$i]['contribsUrl'] = SpecialPage::getTitleFor( 'Contributions', $chatters[$i]['username'] )->getFullURL();
			}
		}
		$this->chatters = $chatters;

		// Button setup
		$this->buttonIconUrl = $wgExtensionsPath .'/wikia/Chat/images/chat_icon.png';
		if ( !empty($this->totalInRoom) ) {
			$this->buttonText = wfMsg('chat-join-the-chat');
		} else {
			$this->buttonText = wfMsg('chat-start-a-chat');		
		}
		$this->chatClickAction = "window.open('{$this->linkToSpecialChat}', 'wikiachat', '{$this->windowFeatures}')";

		wfProfileOut( __METHOD__ );
	}

	/**
	 * Return string of window features
	 */
	private function getWindowFeatures() {
		$width = 600;
		$height = 600;
		$windowFeatures = 'width='.$width.',height='.$height;
		$windowFeatures.= ',menubar=no,status=no,location=no,toolbar=no';
		$windowFeatures.= ',scrollbars=no,resizable=yes';

		return $windowFeatures;	
	}
}

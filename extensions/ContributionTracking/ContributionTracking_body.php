<?php

class ContributionTracking extends UnlistedSpecialPage {
	function __construct() {
		parent::__construct( 'ContributionTracking' );
	}

	function get_owa_ref_id($ref){
		// Replication lag means sometimes a new event will not exist in the table yet
		$dbw = wfGetDB( DB_MASTER );
		$id_num = $dbw->selectField(
			'contribution_tracking_owa_ref',
			'id',
			array( 'url' => $ref ),
			__METHOD__
		);
		// Once we're on mysql 5, we can use replace() instead of this selectField --> insert or update hooey
		if ( $id_num === false ) {
			$dbw->insert(
				'contribution_tracking_owa_ref',
				array( 'url' => (string) $event_name ),
				__METHOD__
			);
			$id_num = $dbw->insertId();
		}
		return $id_num === false ? 0 : $id_num;
	}


	function execute( $language ) {
		global $wgRequest, $wgOut;
		
		if ( !preg_match( '/^[a-z-]+$/', $language ) ) {
			$language = 'en';
		}
		$this->lang = Language::factory( $language );
		
		$this->setHeaders();
		
		$gateway = $wgRequest->getText( 'gateway' );
		if( !in_array( $gateway, array( 'paypal', 'moneybookers' ) ) ) {
			$wgOut->showErrorPage( 'contrib-tracking-error', 'contrib-tracking-error-text' );
			return;
		}
		
		$db = contributionTrackingConnection();

		$ts = $db->timestamp();

		$owa_ref = $wgRequest->getText('owa_ref', null);
		if($owa_ref != null  && !is_numeric($owa_ref)){
			$owa_ref = $this->get_owa_ref_id($owa_ref);
		}

		$tracked_contribution = array(
			'note' => $wgRequest->getText('comment', null),
			'referrer' => $wgRequest->getText('referrer', null),
			'anonymous' => ($wgRequest->getCheck('comment-option', 0) ? 0 : 1),
			'utm_source' => $wgRequest->getText('utm_source', null),
			'utm_medium' => $wgRequest->getText('utm_medium', null),
			'utm_campaign' => $wgRequest->getText('utm_campaign', null),
			'optout' => ($wgRequest->getCheck('email-opt', 0) ? 0 : 1),
			'language' => $wgRequest->getText('language', null),
			'owa_session' => $wgRequest->getText('owa_session', null),
			'owa_ref' => $owa_ref,
			'ts' => $ts,
		);
		
		// Make all empty strings NULL
		foreach ($tracked_contribution as $key => $value) {
			if ($value === '') {
				$tracked_contribution[$key] = null;
			}
		}
		
		// Store the contribution data
		if ( !$wgRequest->getVal( 'contribution_tracking_id', 0 )) {
			$db->insert( 'contribution_tracking', $tracked_contribution );
		}
		$contribution_tracking_id = $wgRequest->getVal( 'contribution_tracking_id', $db->insertId());
		
		$returnText = $wgRequest->getText( 'returnto', "Donate-thanks/$language" );
		$returnTitle = Title::newFromText( $returnText );
		if( $returnTitle ) {
			$returnto = $returnTitle->getFullUrl();
		} else {
			$returnto = "http://wikimediafoundation.org/wiki/Thank_You/$language";
		}
		
		// Set the action and tracking ID fields
		$repost = array();
		$action = 'http://wikimediafoundation.org/';
		if ( $gateway == 'paypal' ) {
			$action = 'https://www.paypal.com/cgi-bin/webscr';
			
			// Tracking
			$repost['on0'] = 'contribution_tracking_id';
			
			// PayPal
			$repost['business'] = 'donations@wikimedia.org';
			$repost['item_name'] = 'One-time donation';
			$repost['item_number'] = 'DONATE';
			$repost['cmd'] = '_xclick';
			$repost['no_note'] = '0';
			$repost['notify_url'] = 'https://civicrm.wikimedia.org/fundcore_gateway/paypal';
			$repost['return'] = $returnto;
			
			$repost['currency_code'] = $wgRequest->getText( 'currency_code', 'USD' );
			
			// additional fields to pass to PayPal from single-step credit card form
			$repost[ 'first_name' ] = $wgRequest->getText( 'fname', null );
			$repost[ 'last_name' ] = $wgRequest->getText( 'lname', null );
			$repost[ 'email' ] = $wgRequest->getText( 'email', null );
		}
		else if ( $gateway == 'moneybookers' ) {
			$action = 'https://www.moneybookers.com/app/payment.pl';

			// Tracking
			$repost['merchant_fields'] = 'os0';

			// Moneybookers
			$repost['pay_to_email'] = 'donation@wikipedia.org';
			$repost['status_url'] = 'https://civicrm.wikimedia.org/fundcore_gateway/moneybookers';
			$repost['language'] = 'en';
			$repost['detail1_description'] = 'One-time donation';
			$repost['detail1_text'] = 'DONATE';
			$repost['currency'] = $wgRequest->getText( 'currency_code', 'USD' );
		} else {
			throw new MWException( "This shouldn't happen, we validated the gateway earlier." );
		}
		
		// Normalized amount
		$repost['amount'] = $wgRequest->getVal( 'amount' );
		if ( $wgRequest->getVal( 'amountGiven' ) ) {
			$repost['amount'] = $wgRequest->getVal( 'amountGiven' );
		}
		
		// Tracking
		$repost['os0'] = $contribution_tracking_id;
		
		$wgOut->addWikiText( "{{2009/Donate-banner/$language}}" );
		$wgOut->addHTML( $this->msgWiki( 'contrib-tracking-submitting' ) );
		
		// Output the repost form
		$output = '<form method="post" name="contributiontracking" action="' . $action . '">';

		foreach ( $repost as $key => $value ) {
			$output .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '" />';
		}
		
		// Offer a button to post the form if the user has no Javascript support
		$output .= $this->msgWiki( 'contrib-tracking-continue' );
		$output .= '<input type="submit" value="' . $this->msg( 'contrib-tracking-button' ) . '" />';

		$output .= '</form>';

		$wgOut->addHTML( $output );

		// Automatically post the form if the user has Javascript support
		$wgOut->addHTML( '<script type="text/javascript">document.contributiontracking.submit();</script>' );

	}

	function msg( $key ) {
		return wfMsgExt( $key, array( 'escape', 'language' => $this->lang ) );
	}


	function msgWiki( $key ) {
		return wfMsgExt( $key, array( 'parse', 'language' => $this->lang ) );
	}

}

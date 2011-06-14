<?php

/*
 * Created on June 13, 2011
 *
 * API module for MediaWiki's FlaggedRevs extension
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

/**
 * API module to set the "currently reviewing" status of revisions
 *
 * @ingroup FlaggedRevs
 */
class ApiReviewActivity extends ApiBase {

	/**
	 * This function does essentially the same as RevisionReview::AjaxReview,
	 * except that it generates the template and image parameters itself.
	 */
	public function execute() {
		global $wgUser;
		$params = $this->extractRequestParams();
		// Check basic permissions
		if ( !$wgUser->isAllowed( 'review' ) ) {
			$this->dieUsage( "You don't have the right to review revisions.",
				'permissiondenied' );
		} elseif ( $wgUser->isBlocked( false ) ) {
			$this->dieUsageMsg( array( 'blockedtext' ) );
		}

		$newRev = Revision::newFromId( $params['newid'] );
		if ( !$newRev || !$newRev->getTitle() ) {
			$this->dieUsage( "Cannot find a revision with the specified ID.", 'notarget' );
		}
		$title = $newRev->getTitle();

		$fa = FlaggedPage::getTitleInstance( $title );
		if ( !$fa->isReviewable() ) {
			$this->dieUsage( "Provided page is not reviewable.", 'notreviewable' );
		}

		$status = false;
		if ( $params['oldid'] ) { // changes
			$oldRev = Revision::newFromId( $params['oldid'] );
			if ( !$oldRev || $oldRev->getPage() != $newRev->getPage() ) {
				$this->dieUsage( "Revisions do not belong to the same page.", 'notarget' );
			}
			// Mark as reviewing...
			if ( $params['reviewing'] ) {
				$status = FRUserActivity::setUserReviewingDiff(
					$wgUser, $params['oldid'], $params['newid'] );
			// Unmark as reviewing...
			} else {
				$status = FRUserActivity::clearUserReviewingDiff(
					$wgUser, $params['oldid'], $params['newid'] );
			}
		} else {
			// Mark as reviewing...
			if ( $params['reviewing'] ) {
				$status = FRUserActivity::setUserReviewingPage( $wgUser, $newRev->getPage() );
			// Unmark as reviewing...
			} else {
				$status = FRUserActivity::clearUserReviewingPage( $wgUser, $newRev->getPage() );
			}
		}

		# Success in setting flag...
		if ( $status === true ) {
			$this->getResult()->addValue(
				null, $this->getModuleName(), array( 'result' => 'Success' ) );
		# Failure...
		} else {
			$this->getResult()->addValue(
				null, $this->getModuleName(), array( 'result' => 'Failure' ) );
		}
	}

	public function mustBePosted() {
		return true;
	}

	public function isWriteMode() {
 		return true;
 	}

	public function getAllowedParams() {
		return array(
			'oldid'   	=> null,
			'newid' 	=> null,
			'reviewing' => array( ApiBase::PARAM_TYPE => array( 0, 1 ) )
		);
	}

	public function getParamDescription() {
		return array(
			'oldid'  	=> 'The old revision ID (for reviewing changes or pages)',
			'newid'  	=> 'The new revision ID (for reviewing changes only)',
			'reviewing' => 'Whether to advertising as reviewing or no longer reviewing',
		);
	}

	public function getDescription() {
		return 'Advertise or de-advertise yourself as reviewing an unreviewed page or unreviewed changes';
	}

	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(
			array( 'code' => 'notarget',
				'info' => 'Provided revision or page can not be found.' ),
			array( 'code' => 'notreviewable',
				'info' => 'Provided page is not reviewable.' ),
			array( 'code' => 'permissiondenied',
				'info' => 'Insufficient rights to set the activity flag.' ),
		) );
	}

	public function needsToken() {
		return false;
	}

    public function getTokenSalt() {
		return false;
	}

	protected function getExamples() {
		return 'api.php?action=reviewactivity&pageid=12345&reviewing=1';
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}
}

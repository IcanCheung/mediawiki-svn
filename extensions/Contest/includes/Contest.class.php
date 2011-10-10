<?php

/**
 * Class representing a single contest.
 * 
 * @since 0.1
 * 
 * @file Contest.class.php
 * @ingroup Contest
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Contest extends ContestDBObject {
	
	// Constants representing the states a contest can have.
	const STATUS_DRAFT = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_FINISHED = 2;
	
	/**
	 * List of challenges for this contest.
	 * @see loadChallenges, setChallenges and writeChallengesToDB
	 * 
	 * @since 0.1
	 * @var array of ContestChallenge
	 */
	protected $challenges = null;
	
	/**
	 * List of contestants for this contest.
	 * @see loadContestants, setContestants and writeContestantsToDB
	 * 
	 * @since 0.1
	 * @var array of ContestContestant
	 */
	protected $contestants = null;
	
	/**
	 * Indicates if the contest was set from non-finished to finished.
	 * This is used to take further action on save of the object.
	 * 
	 * @since 0.1
	 * @var boolean
	 */
	protected $wasSetToFinished = false;
	
	/**
	 * Method to get an instance so methods that ought to be static,
	 * but can't be due to PHP 5.2 not having LSB, can be called on
	 * it. This also allows easy identifying of code that needs to
	 * be changed once PHP 5.3 becomes an acceptable requirement. 
	 * 
	 * @since 0.1
	 * 
	 * @return ContestDBObject
	 */
	public static function s() {
		static $instance = false;
		
		if ( $instance === false ) {
			$instance = new self( array() );
		}
		
		return $instance;
	}
	
	/**
	 * Get a new instance of the class from an array. 
	 * This method ought to be in the basic class and
	 * return a new static(), but this requires LSB/PHP>=5.3.
	 * 
	 * @since 0.1
	 * 
	 * @param array $data
	 * @param boolean $loadDefaults
	 * 
	 * @return ContestDBObject
	 */	
	public function newFromArray( array $data, $loadDefaults = false ) {
		return new self( $data, $loadDefaults );
	}
	
	/**
	 * @see parent::getFieldTypes
	 * 
	 * @since 0.1
	 * 
	 * @return string
	 */
	public function getDBTable() {
		return 'contests';
	}

	/**
	 * @see parent::getFieldTypes
	 * 
	 * @since 0.1
	 * 
	 * @return string
	 */
	protected function getFieldPrefix() {
		return 'contest_';
	}
	
	/**
	 * @see parent::getFieldTypes
	 * 
	 * @since 0.1
	 * 
	 * @return array
	 */
	protected function getFieldTypes() {
		return array(
			'id' => 'id',
			'name' => 'str',
			'status' => 'int',
			'end' => 'int',
		
			'rules_page' => 'str',
			'opportunities' => 'str',
			'intro' => 'str',
			'help' => 'str',
			'signup_email' => 'str',
			'reminder_email' => 'str',
		
			'submission_count' => 'int',
		);
	}
	
	/**
	 * @see parent::getDefaults
	 * 
	 * @since 0.1
	 * 
	 * @return array
	 */
	public function getDefaults() {
		return array(
			'name' => '',
			'status' => self::STATUS_DRAFT,
			'end' => '',
			
			'rules_page' => 'MediaWiki:',
			'opportunities' => 'MediaWiki:',
			'intro' => 'MediaWiki:',
			'help' => '',
			'signup_email' => 'MediaWiki:',
			'reminder_email' => 'MediaWiki:',
		
			'submission_count' => 0,
		);
	}
	
	/**
	 * Gets the message for the provided status.
	 * 
	 * @param Contest::STATUS_ $status
	 * 
	 * @return string
	 */
	public static function getStatusMessage( $status ) {
		static $map = false;
		
		if ( $map === false ) {
			$map = array_flip( self::getStatusMessages() );
		}
		
		return $map[$status];
	}
	
	/**
	 * Returns a list of status messages and their corresponding constants.
	 * 
	 * @since 0.1
	 * 
	 * @return array
	 */
	public static function getStatusMessages() {
		static $map = false;
		
		if ( $map === false ) {
			$map = array(
				wfMsg( 'contest-status-draft' ) => self::STATUS_DRAFT,
				wfMsg( 'contest-status-active' ) => self::STATUS_ACTIVE,
				wfMsg(  'contest-status-finished' ) => self::STATUS_FINISHED,
			);
		}
		
		return $map;
	}
	
	/**
	 * Load the challenges from the database.
	 * Any set challenges will be lost.
	 * 
	 * @since 0.1
	 */
	public function loadChallenges() {
		$this->challenges = ContestChallenge::s()->select(
			null,
			array( 'contest_id' => $this->getId() )
		);
	}
	
	/**
	 * Gets the challenges that are part of this contest.
	 * 
	 * @since 0.1
	 * 
	 * @return array of ContestChallenge
	 */
	public function getChallenges( $forceLoad = false ) {
		if ( is_null( $this->challenges ) || $forceLoad ) {
			$this->loadChallenges();
		}
		
		return $this->challenges;
	}
	
	/**
	 * Load the contestants from the database.
	 * Any set contestants will be lost.
	 * 
	 * @since 0.1
	 */
	public function loadContestants() {
		$this->contestants = ContestContestant::s()->select(
			null,
			array( 'contest_id' => $this->getId() )
		);
	}
	
	/**
	 * Gets the contestants for this contest.
	 * 
	 * @since 0.1
	 * 
	 * @return array of ContestContestant
	 */
	public function getContestants( $forceLoad = false ) {
		if ( is_null( $this->contestants ) || $forceLoad ) {
			$this->loadContestants();
		}
		
		return $this->contestants;
	}
	
	/**
	 * Set the contestants for this contest.
	 * 
	 * @since 0.1
	 * 
	 * @param array $contestants
	 */
	public function setContestants( array /* of ContestContestant */ $contestants ) {
		$this->contestants = $contestants;
	}
	
	/**
	 * Set the challenges for this contest.
	 * 
	 * @since 0.1
	 * 
	 * @param array $challenges
	 */
	public function setChallenges( array /* of ContestChallenge */ $challenges ) {
		$this->challenges = $challenges;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see ContestDBObject::writeToDB()
	 */
	public function writeToDB() {
		$success = parent::writeToDB();
		
		if ( $success && $this->wasSetToFinished ) {
			$this->doFinishActions();
			$this->wasSetToFinished = false;
		}
		
		return $success;
	}
	
	/**
	 * Write the contest and all set challenges and participants to the database.
	 * 
	 * @since 0.1
	 * 
	 * @return boolean Success indicator
	 */
	public function writeAllToDB() {
		$success = self::writeToDB();
	
		if ( $success ) {
			$success = $this->writeChallengesToDB();
		}
		
		if ( $success ) {
			$success = $this->writeContestantsToDB();
		}
		
		return $success;
	}
	
	/**
	 * Write the challenges to the database.
	 * 
	 * @since 0.1
	 * 
	 * @return boolean Success indicator
	 */
	public function writeChallengesToDB() {
		if ( is_null( $this->challenges ) || count( $this->challenges ) == 0 ) {
			return true;
		}
		
		$dbw = wfGetDB( DB_MASTER );
		$success = true;
		
		$dbw->begin();
		
		foreach ( $this->challenges as /* ContestChallenge */ $challenge ) {
			$challenge->setField( 'contest_id', $this->getId() );
			$success &= $challenge->writeToDB();
		}
		
		$dbw->commit();
		
		return $success;
	}
	
	/**
	 * Write the contestants to the database.
	 * 
	 * @since 0.1
	 * 
	 * @return boolean Success indicator
	 */
	public function writeContestantsToDB() {
		if ( is_null( $this->contestants ) || count( $this->contestants ) == 0 ) {
			return true;
		}
		
		$dbw = wfGetDB( DB_MASTER );
		$success = true;
		$nr = 0;
		
		$dbw->begin();
		
		foreach ( $this->contestants as /* ContestContestant */ $contestant ) {
			$contestant->setField( 'contest_id', $this->getId() );
			$success &= $contestant->writeToDB();
			
			if ( ++$nr % 500 == 0 ) {
				$dbw->commit();
				$dbw->begin();
			}
		}
		
		$dbw->commit();
		
		return $success;
	}
	
	/**
	 * Add an amount (can be negative) to the total submissions for this contest.
	 * 
	 * @since 0.1
	 * 
	 * @param integer $amount
	 * 
	 * @return boolean Success indicator
	 */
	public function addToSubmissionCount( $amount ) {
		return parent::addToField( 'submission_count', $amount );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see ContestDBObject::setField()
	 */
	public function setField( $name, $value ) {
		if ( $name == 'status' && $value == self::STATUS_FINISHED
			&& $this->hasField( $name ) && $this->getField( $name ) != self::STATUS_FINISHED ) {
			$this->wasSetToFinished = true;
		}
		
		parent::setField( $name, $value );
	}
	
	/**
	 * Remove the contest and all it's linked data from the database.
	 * 
	 * @since 0.1
	 * 
	 * @return boolean Success indicator
	 */
	public function removeAllFromDB() {
		$condition = array( 'contest_id' => $this->getId() );
		
		$success = ContestChallenge::s()->delete( $condition );
		
		if ( $success ) {
			$contestantIds = array();
			
			foreach ( ContestContestant::s()->select( 'id', $condition ) as /* ContestContestant */ $contestant ) {
				$contestantIds[] = $contestant->getId();
			}
			
			$success = ContestComment::s()->delete( array( 'contestant_id' => $contestantIds ) ) && $success;
			$success = ContestVote::s()->delete( array( 'contestant_id' => $contestantIds ) ) && $success;
			$success = ContestContestant::s()->delete( $condition ) && $success;
		}
		
		if ( $success ) {
			$success = parent::removeFromDB();
		}
		
		return $success;
	}	
	
	/**
	 * Do all actions that need to be done on contest finish.
	 * 
	 * @since 0.1
	 */
	public function doFinishActions() {
		// TODO
	}
	
}

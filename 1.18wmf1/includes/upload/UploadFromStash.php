<?php
/**
 * Implements uploading from previously stored file.
 *
 * @file
 * @ingroup upload
 * @author Bryan Tong Minh
 */

class UploadFromStash extends UploadBase {
	protected $mFileKey, $mVirtualTempPath, $mFileProps, $mSourceType;
	
	// an instance of UploadStash
	private $stash;
	
	//LocalFile repo
	private $repo;
	
	public function __construct( $user = false, $stash = false, $repo = false ) {
		// user object. sometimes this won't exist, as when running from cron.
		$this->user = $user;

		if( $repo ) {
			$this->repo = $repo;
		} else {
			$this->repo = RepoGroup::singleton()->getLocalRepo();
		}

		if( $stash ) {
			$this->stash = $stash;
		} else {
			if( $user ) {
				wfDebug( __METHOD__ . " creating new UploadStash instance for " . $user->getId() . "\n" );
			} else {
				wfDebug( __METHOD__ . " creating new UploadStash instance with no user\n" );
			}
			$this->stash = new UploadStash( $this->repo, $this->user );
		}

		return true;
	}
	
	public static function isValidKey( $key ) {
		// this is checked in more detail in UploadStash
		return preg_match( UploadStash::KEY_FORMAT_REGEX, $key );
	}

	/**
	 * @param $request WebRequest
	 *
	 * @return Boolean
	 */
	public static function isValidRequest( $request ) {
		return self::isValidKey( $request->getText( 'wpFileKey' ) || $request->getText( 'wpSessionKey' ) );
	}

	public function initialize( $key, $name = 'upload_file' ) {
		/**
		 * Confirming a temporarily stashed upload.
		 * We don't want path names to be forged, so we keep
		 * them in the session on the server and just give
		 * an opaque key to the user agent.
		 */		
		$metadata = $this->stash->getMetadata( $key );
		$this->initializePathInfo( $name,
			$this->getRealPath ( $metadata['us_path'] ),
			$metadata['us_size'],
			false
		);

		$this->mFileKey = $key;
		$this->mVirtualTempPath = $metadata['us_path'];
		$this->mFileProps = $this->stash->getFileProps( $key );
		$this->mSourceType = $metadata['us_source_type'];
	}

	/**
	 * @param $request WebRequest
	 */
	public function initializeFromRequest( &$request ) {
		$fileKey = $request->getText( 'wpFileKey' ) || $request->getText( 'wpSessionKey' );

		$desiredDestName = $request->getText( 'wpDestFile' );
		if( !$desiredDestName ) {
			$desiredDestName = $request->getText( 'wpUploadFile' ) || $request->getText( 'filename' );
		}
		return $this->initialize( $fileKey, $desiredDestName );
	}

	public function getSourceType() { 
		return $this->mSourceType; 
	}

	/**
	 * File has been previously verified so no need to do so again.
	 *
	 * @return bool
	 */
	protected function verifyFile() {
		return true;
	}

	/**
	 * Stash the file.	
	 */
	public function stashFile( $key = null ) {		
		// replace mLocalFile with an instance of UploadStashFile, which adds some methods
		// that are useful for stashed files.
		$this->mLocalFile = parent::stashFile( $key );
		return $this->mLocalFile;
	}

	/**
	 * This should return the key instead of the UploadStashFile instance, for backward compatibility.
	 */
	public function stashSession( $key = null ) {
		return $this->stashFile( $key )->getFileKey();
	}

	/**
	 * Remove a temporarily kept file stashed by saveTempUploadedFile().
	 * @return success
	 */
	public function unsaveUploadedFile() {
		return $this->stash->removeFile( $this->mFileKey );
	}

	/**
	 * Perform the upload, then remove the database record afterward.
	 */
	public function performUpload( $comment, $pageText, $watch, $user ) {
		$rv = parent::performUpload( $comment, $pageText, $watch, $user );
		$this->unsaveUploadedFile();
		return $rv;
	}

}
<?php
/**
 * ResourceLoader module for a single gadget
 */
class GadgetResourceLoaderModule extends ResourceLoaderWikiModule {
	protected $pages, $dependencies, $messages, $source, $timestamp;

	/**
	 * Creates an instance of this class
	 * @param $pages Array: Associative array of pages in ResourceLoaderWikiModule-compatible
	 * format, for example:
	 * array(
	 * 		'MediaWiki:Gadget-foo.js'  => array( 'type' => 'script' ),
	 * 		'MediaWiki:Gadget-foo.css' => array( 'type' => 'style' ),
	 * )
	 * @param $dependencies Array: Names of resources this module depends on
	 * @param $messages Array: Keys of the i18n messages that this module needs
	 * @param $source String: Name of the source of this module, as defined in ResourceLoader
	 * @param $timestamp String: Last modification timestamp of the gadget metadata
	 * @param $db Database: Remote database object // TODO: How will this work for ForeignAPIGadgetRepo?
	 */
	public function __construct( $pages, $dependencies, $messages, $source, $timestamp, $db ) {
		$this->pages = $pages;
		$this->dependencies = $dependencies;
		$this->messages = $messages;
		$this->source = $source;
		$this->timestamp = $timestamp;
		$this->db = $db;
	}
	
	protected function getDB() {
		return $this->db;
	}

	/**
	 * Overrides the abstract function from ResourceLoaderWikiModule class
	 * @return Array: $pages passed to __construct()
	 */
	protected function getPages( ResourceLoaderContext $context ) {
		return $this->pages;
	}

	/**
	 * Overrides ResourceLoaderModule::getDependencies()
	 * @return Array: Names of resources this module depends on
	 */
	public function getDependencies() {
		return $this->dependencies;
	}
	
	/**
	 * Overrides ResourceLoaderModule::getMessages()
	 * @return Array: Keys of messages this module needs
	 */
	public function getMessages() {
		return $this->messages;
	}
	
	/**
	 * Overrides ResourceLoaderModule::getSource()
	 * @return String: Name of the source of this module as defined in ResourceLoader
	 */
	public function getSource() {
		return $this->source;
	}
	
	/**
	 * Overrides ResourceLoaderWikiModule::getModifiedTime() to take $timestamp
	 * into account.
	 * @param $context ResourceLoaderContext object
	 * @return int UNIX timestamp
	 */
	public function getModifiedTime( ResourceLoaderContext $context ) {
		$retval = parent::getModifiedTime( $context );
		return max( $retval, wfTimestamp( TS_UNIX, $this->timestamp ) );
	}
}

<?php
/**
 * @file
 * @ingroup SMWDataItems
 */

/**
 * This class implements wiki page data items.
 *
 * @since 1.6
 *
 * @author Markus Krötzsch
 * @ingroup SMWDataItems
 */
class SMWDIWikiPage extends SMWDataItem {

	/**
	 * MediaWiki DB key string
	 * @var string
	 */
	protected $m_dbkey;
	/**
	 * MediaWiki namespace integer.
	 * @var integer
	 */
	protected $m_namespace;
	/**
	 * MediaWiki interwiki prefix.
	 * @var string
	 */
	protected $m_interwiki;
	/**
	 * Id for subobjects of pages, or empty string if the given object is
	 * the page itself (not a subobject).
	 * @var string
	 */
	protected $m_subobjectid;

	/**
	 * Contructor. We do not bother with too much detailed validation here,
	 * regarding the known namespaces, canonicity of the dbkey (namespace
	 * exrtacted?), validity of interwiki prefix (known?), and general use
	 * of allowed characters (may depend on MW configuration). All of this
	 * would be more work than it is worth, since callers will usually be
	 * careful and since errors here do not have major consequences.
	 */
	public function __construct( $dbkey, $namespace, $interwiki, $subobjectid = '' ) {
		if ( !is_numeric( $namespace ) ) {
			throw new SMWDataItemException( "Given namespace '$namespace' is not an integer." );
		}
		$this->m_dbkey = $dbkey;
		$this->m_namespace = (int)$namespace; // really make this an integer
		$this->m_interwiki = $interwiki;
		$this->m_subobjectid = $subobjectid;
	}

	public function getDIType() {
		return SMWDataItem::TYPE_WIKIPAGE;
	}

	public function getDBkey() {
		return $this->m_dbkey;
	}

	public function getNamespace() {
		return $this->m_namespace;
	}

	public function getInterwiki() {
		return $this->m_interwiki;
	}

	public function getSubobjectId() {
		return $this->m_subobjectid;
	}

	/**
	 * Get the sortkey of the wiki page data item. Note that this is not
	 * the sortkey that might have been set for the corresponding wiki
	 * page. To obtain the latter, query for the values of the property
	 * "new SMWDIProperty( '_SKEY' )".
	 */
	public function getSortKey() {
		return $this->m_dbkey;
	}

	/**
	 * Create a MediaWiki Title object for this SMWDIWikiPage. The result
	 * can be null if an error occurred.
	 *
	 * @todo From MW 1.17 on, makeTitleSafe supports interwiki prefixes.
	 * This function can be simplified when compatibility to MW 1.16 is
	 * dropped.
	 * @return mixed Title or null
	 */
	public function getTitle() {
		if ( $this->m_interwiki == '' ) {
			return Title::makeTitleSafe( $this->m_namespace, $this->m_dbkey, '' );
		} else {
			$datavalue = new SMWWikiPageValue( '_wpg' );
			$datavalue->setDataItem( $this );
			return Title::newFromText( $datavalue->getPrefixedText() );
		}
	}

	public function getSerialization() {
		if ( $this->m_subobjectid == '' ) {
			return strval( $this->m_dbkey . '#' . strval( $this->m_namespace ) . '#' . $this->m_interwiki );
		} else {
			return strval( $this->m_dbkey . '#' . strval( $this->m_namespace ) . '#' . $this->m_interwiki . '#' . $this->m_subobjectid );
		}
	}

	/**
	 * Create a data item from the provided serialization string and type
	 * ID.
	 * @return SMWDIWikiPage
	 */
	public static function doUnserialize( $serialization ) {
		$parts = explode( '#', $serialization, 4 );
		if ( count( $parts ) == 3 ) {
			return new SMWDIWikiPage( $parts[0], floatval( $parts[1] ), $parts[2] );
		} elseif ( count( $parts ) == 4 ) {
			return new SMWDIWikiPage( $parts[0], floatval( $parts[1] ), $parts[2], $parts[3] );
		} else {
			throw new SMWDataItemException( "Unserialization failed: the string \"$serialization\" was not understood." );
		} 
	}

	/**
	 * Create a data item from a MediaWiki Title.
	 *
	 * @param $title Title
	 * @return SMWDIWikiPage
	 */
	public static function newFromTitle( Title $title ) {
		return new SMWDIWikiPage( $title->getDBkey(), $title->getNamespace(), $title->getInterwiki() );
	}

}

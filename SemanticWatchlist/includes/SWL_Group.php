<?php

/**
 * Static class with functions interact with watchlist groups.
 * 
 * @since 0.1
 * 
 * @file SWL_Groups.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SWLGroup {

	protected $id;
	
	protected $name;
	
	protected $categories;
	
	protected $namespaces;
	
	protected $properties;
	
	protected $concepts;
	
	public static function newFromDBResult( $group ) {
		return new SWLGroup(
			$group->group_id,
			$group->group_name,
			$group->group_categories == '' ? array() : explode( '|', $group->group_categories ),
			$group->group_namespaces == '' ? array() : array_map( 'intval', explode( '|', $group->group_namespaces ) ),
			$group->group_properties == '' ? array() : explode( '|', $group->group_properties ),
			$group->group_concepts == '' ? array() : explode( '|', $group->group_group_concepts )
		);
	}
	
	public function __construct( $id, $name, array $categories, array $namespaces, array $properties, array $concepts ) {
		$this->id = $id;
		$this->name = $name;
		$this->categories = $categories;
		$this->namespaces = $namespaces;
		$this->properties = $properties;	
		$this->concepts = $concepts;	
	}
	
	/**
	 * Returns the categories specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[string]
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**
	 * Returns the namespaces specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[integer]
	 */
	public function getNamespaces() {
		return $this->namespaces;
	}

	/**
	 * Returns the properties specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[string]
	 */
	public function getProperties() {
		return $this->properties;
	}
	
	/**
	 * Returns the concepts specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[string]
	 */
	public function getConcepts() {
		return $this->concepts;
	}
	
	/**
	 * Returns the group database id.
	 * 
	 * @since 0.1
	 * 
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the group name.
	 * 
	 * @since 0.1
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}	
	
	/**
	 * Returns whether the group contains the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */
	public function coversPage( Title $title ) {
		return $this->categoriesCoverPage( $title ) 
			|| $this->namespacesCoversPage( $title )
			|| $this->conceptsCoverPage( $title );
	}
	
	/**
	 * Returns whether the namespaces of the group cover the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */	
	public function namespacesCoversPage( Title $title ) {
		if ( count( $this->namespaces ) > 0 ) {
			if ( !in_array( $title->getNamespace(), $this->namespaces ) ) {
				return false;
			}
		}
		
		return true;		
	}
	
	/**
	 * Returns whether the catgeories of the group cover the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */		
	public function categoriesCoverPage( Title $title ) {
		if ( count( $this->categories ) > 0 ) {
			$cats = array_keys( $title->getParentCategories() );
			
			if ( count( $cats ) == 0 ) {
				return false; 
			}
			
			$foundMatch = false;
			
			foreach ( $this->categories as $groupCategory ) {
				$foundMatch = in_array( $groupCategory, $cats );
				
				if ( $foundMatch ) {
					break;
				}
			}
		}

		return $foundMatch;
	}
	
	/**
	 * Returns whether the concepts of the group cover the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */		
	public function conceptsCoverPage( Title $title ) {
		if ( count( $this->concepts ) == 0 ) {
			return true;
		}
		
		$foundMatch = false;
		
		foreach ( $this->concepts as $groupConcept ) {
			$queryDescription = new SMWConjunction();
			
			$conceptTitle = Title::newFromText( $groupConcept, SMW_NS_CONCEPT );
			$queryDescription->addDescription( new SMWConceptDescription( SMWDIWikiPage::newFromTitle( $conceptTitle ) ) );
			$queryDescription->addDescription( new SMWValueDescription( SMWDIWikiPage::newFromTitle( $title ) ) );
			
			$query = new SMWQuery( $queryDescription );
			$query->querymode = SMWQuery::MODE_COUNT;

			/* SMWQueryResult */ $result = smwfGetStore()->getQueryResult( $query );
			$foundMatch = $result->getCount() > 0;
			
			if ( $foundMatch ) {
				break;
			}
		}
		
		return $foundMatch;
	}
	
}
	
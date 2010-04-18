<?php

/**
 * File holding the SMAreaValueDescription class.
 * 
 * @file SM_AreaValueDescription.php
 * @ingroup SemanticMaps
 * 
 * @author Jeroen De Dauw
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

/**
 * Description of one data value of type Goegraphical Areas.
 *
 * @author Jeroen De Dauw
 * 
 * @ingroup SemanticMaps
 * 
 * TODO: storing the distance here does not seem quite right
 */
class SMAreaValueDescription extends SMWValueDescription {
	protected $mBounds = false;

	public function __construct( SMGeoCoordsValue $dataValue, $radius, $comparator = SMW_CMP_EQ ) {
		parent::__construct( $dataValue, $comparator );
		
		// TODO: get user provided distance
		//global $smgGeoCoordDistance;
		//$distance = $smgGeoCoordDistance; 		
		
		// If the MapsGeoFunctions class is not loaded, we can not create the bounding box, so don't add any conditions.
		if ( self::geoFunctionsAreAvailable() ) {
			$dbKeys = $dataValue->getDBkeys();
			
			$this->mBounds = self::getBoundingBox(
				array(
					'lat' => $dbKeys[0],
					'lon' => $dbKeys[1]
				),
				$radius
			); 			
		}		
	}	
	
	/**
	 * @see SMWDescription:getQueryString
	 * @param Boolean $asvalue
	 */
	public function getQueryString( $asValue = false ) {
		if ( $this->m_datavalue !== null ) {
			$queryString = $this->m_datavalue->getWikiValue();
			return $asValue ? $queryString : "[[$queryString]]";
		} else {
			return $asValue ? '+' : '';
		}
	}

	/**
	 * @see SMWDescription:prune
	 */
    public function prune( &$maxsize, &$maxdepth, &$log ) {
    	if ( ( $maxsize < $this->getSize() ) || ( $maxdepth < $this->getDepth() ) ) {
			$log[] = $this->getQueryString();
			$result = new SMWThingDescription();
			$result->setPrintRequests( $this->getPrintRequests() );
			return $result;
		} else {
			$maxsize = $maxsize - $this->getSize();
			$maxdepth = $maxdepth - $this->getDepth();
			return $this;
		}
    }
    
    public function getBounds() {
    	return $this->mBounds;
    }
    
	/**
	 * Returns the lat and lon limits of a bounding box around a circle defined by the provided parameters.
	 * 
	 * @param array $centerCoordinates Array containing non-directional float coordinates with lat and lon keys. 
	 * @param float $circleRadius The radidus of the circle to create a bounding box for, in km.
	 * 
	 * @return An associative array containing the limits with keys north, east, south and west.
	 */
	private static function getBoundingBox( array $centerCoordinates, $circleRadius ) {
		$north = MapsGeoFunctions::findDestination( $centerCoordinates, 0, $circleRadius );
		$east = MapsGeoFunctions::findDestination( $centerCoordinates, 90, $circleRadius );
		$south = MapsGeoFunctions::findDestination( $centerCoordinates, 180, $circleRadius );
		$west = MapsGeoFunctions::findDestination( $centerCoordinates, 270, $circleRadius );

		return array(
			'north' => $north['lat'],
			'east' => $east['lon'],
			'south' => $south['lat'],
			'west' => $west['lon'],
		);
	}
	
	/**
	 * Returns a boolean indicating if MapsGeoFunctions is available. 
	 */
	private static function geoFunctionsAreAvailable() {
		global $wgAutoloadClasses;
		return array_key_exists( 'MapsGeoFunctions', $wgAutoloadClasses );
	}	    
}
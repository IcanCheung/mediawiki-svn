<?php

/**
 * Interface that should be implemented by all mapping feature classes.
 * 
 * @since 0.6.3
 * 
 * @file iMappingService.php
 * @ingroup Maps
 * 
 * @author Jeroen De Dauw
 */
interface iMappingService {
	
	/**
	 * Returns the internal name of the service.
	 * 
	 * @since 0.6.5
	 * 
	 * @return string
	 */	
	function getName();
	
	/**
	 * Adds the dependencies to the parser output as head items.
	 * 
	 * @since 0.6.3
	 * 
	 * @param mixed $parserOrOut
	 */
	function addDependencies( &$parserOrOut );
	
	/**
	 * Adds service-specific parameter definitions to the porvided parameter list.
	 * 
	 * @since 0.7
	 * 
	 * @return array
	 */
	function addParameterInfo( array &$parameterInfo );
	
	/**
	 * Adds a dependency that is needed for this service. It will be passed along with the next 
	 * call to getDependencyHtml or addDependencies.
	 * 
	 * @since 0.6.5
	 * 
	 * @param string $dependencyHtml
	 */	
	function addDependency( $dependencyHtml );
	
	/**
	 * Adds a feature to this service. This is to indicate this service has support for this feature.
	 * 
	 * @since 0.6.5
	 * 
	 * @param string $featureName
	 * @param string $handlingClass
	 */	
	function addFeature( $featureName, $handlingClass );
	
	/**
	 * Returns the html for the needed dependencies or false.
	 * 
	 * @since 0.6.5
	 * 
	 * @return mixed String or false
	 */	
	function getDependencyHtml();
	
	/**
	 * Returns the name of the class that handles the provided feature in this service, or false if there is none.
	 * 
	 * @since 0.6.5
	 * 
	 * @param string $featureName.
	 * 
	 * @return mixed String or false
	 */	
	function getFeature( $featureName );
	
	/**
	 * Returns an instance of the class handling the provided feature with this service, or false if there is none.
	 * 
	 * @since 0.6.6
	 * 
	 * @param string $featureName.
	 * 
	 * @return iMappingFeature or false
	 */	
	function getFeatureInstance( $featureName );	
	
	/**
	 * Returns a list of aliases.
	 * 
	 * @since 0.6.5
	 * 
	 * @return array
	 */	
	function getAliases();
	
	/**
	 * Returns if the service has a certain alias or not.
	 * 
	 * @since 0.6.5
	 * 
	 * @param string $alias
	 * 
	 * @return boolean
	 */	
	function hasAlias( $alias );
	
	/**
	 * Returns the default zoomlevel for the mapping service.
	 * 
	 * @since 0.6.5
	 * 
	 * @return integer
	 */
	function getDefaultZoom();
	
	/**
	 * Returns a string that can be used as an unique ID for the map html element.
	 * Increments the number by default, providing false for $increment will get
	 * you the same ID as on the last request.
	 * 
	 * @since 0.6.5
	 * 
	 * @param boolean $increment
	 * 
	 * @return string
	 */
	function getMapId( $increment = true );

	/**
	 * Creates a JS array with marker meta data that can be used to construct a 
	 * map with markers via a function in this services JS file.
	 * 
	 * @since 0.6.5
	 * 
	 * @param array $markers
	 * 
	 * @return string
	 */	
	function createMarkersJs( array $markers );	

}
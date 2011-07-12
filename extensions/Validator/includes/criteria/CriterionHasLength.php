<?php

/**
 * Parameter criterion stating that the value must have a certain length.
 * 
 * @since 0.4
 * 
 * @file CriterionHasLength.php
 * @ingroup Validator
 * @ingroup Criteria
 * 
 * @author Jeroen De Dauw
 */
class CriterionHasLength extends ItemParameterCriterion {
	
	protected $lowerBound;
	protected $upperBound;
	
	/**
	 * Constructor.
	 * 
	 * @param integer $lowerBound Null for no lower bound (since 0.4.8).
	 * @param mixed $upperBound False for same value as lower bound. Null for no upper bound (since 0.4.8).
	 * 
	 * @since 0.4
	 */
	public function __construct( $lowerBound, $upperBound = false ) {
		parent::__construct();
		
		$this->lowerBound = $lowerBound;
		$this->upperBound = $upperBound === false ? $lowerBound : $upperBound;
	}
	
	/**
	 * @see ItemParameterCriterion::validate
	 */	
	protected function doValidation( $value, Parameter $parameter, array $parameters ) {
		$strlen = strlen( $value );
		return ( is_null( $this->upperBound ) || $strlen <= $this->upperBound )
			&& ( is_null( $this->lowerBound ) || $strlen >= $this->lowerBound );
	}
	
	/**
	 * @see ItemParameterCriterion::getItemErrorMessage
	 */	
	protected function getItemErrorMessage( Parameter $parameter ) {
		global $wgLang;
		
		if ( $this->lowerBound == $this->upperBound ) {
			return wfMsgExt( 'validator-error-invalid-length', 'parsemag', $parameter->getOriginalName(), $wgLang->formatNum( $this->lowerBound ) );
		}
		else {
			return wfMsgExt(
				'validator-error-invalid-length-range',
				'parsemag',
				$parameter->getOriginalName(),
				$wgLang->formatNum( $this->lowerBound ),
				$wgLang->formatNum( $this->upperBound )
			);
		}
	}
	
}
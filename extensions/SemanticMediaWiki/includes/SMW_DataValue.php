<?php
/**
 * @file
 * @ingroup SMWDataValues
 */

/**
 * This group contains all parts of SMW that relate to the processing of datavalues
 * of various types.
 * @defgroup SMWDataValues SMWDataValues
 * @ingroup SMW
 */

/**
 * Objects of this type represent all that is known about a certain user-provided
 * data value, especially its various representations as strings, tooltips,
 * numbers, etc.  Objects can be created as "emtpy" containers of a certain type,
 * but are then usually filled with data to present one particular data value.
 *
 * Data values have two chief representation forms: the user-facing syntax and the
 * internal representation. In user syntax, every value is (necessarily) a single
 * string, however complex the value is. For example, a string such as "Help:editing"
 * may represent a wiki page called "Editing" in the namespace for "Help". The
 * internal representation may be any numerical array of strings and numbers. In the
 * example, it might be array("Editing",12), where 12 is the number used for identifying
 * the namespace "Help:". Of course, the internal representation could also use a single
 * string value, such as in array("Help:Editing"), but this might be less useful for
 * certain operations (e.g. filterng by namespace). Moreover, all values that are
 * restored from the database are given in the internal format, so it wise to choose a
 * format that allows for very fast and easy processing without unnecessary parsing.
 *
 * The main functions of data value objects are:
 * - setUserValue() which triggers parseUserValue() to process a user-level string.
 * - getDBkeys() which provides an array that represents the current value for internal
 *   processing
 * - setDBkeys() which triggers parseDBkeys() to process an array with the internal
 *   representation
 *
 * In addition, there are a number of get-functions that provide useful output versions
 * for displaying and serializing the value.
 *
 * @ingroup SMWDataValues
 */
abstract class SMWDataValue {

	/// The text label of the respective property or false if none given
	protected $m_property = NULL;
	/// The text label to be used for output or false if none given
	protected $m_caption;
	/// True if a value was set.
	protected $m_isset = false;
	/// The type id for this value object
	protected $m_typeid;
	/// Array of infolink objects
	protected $m_infolinks = array();
	/// output formatting string, see setOutputFormat()
	protected $m_outformat = false;
	/// usually unstub() checks if this contains useful content,
	/// and inits the value with setDBkeys() in this case; false while unused
	protected $m_stubvalues = false;

    /// used to control the addition of the standard search link
	private $m_hasssearchlink;
	/// used to control service link creation
	private $m_hasservicelinks;
	/// Array of error text messages, private to allow us to track error insertion (PHP's count() is too slow when called often)
	private $m_errors = array();
	/// True if there were any errors
	private $m_haserrors = false;

	public function __construct($typeid) {
		$this->m_typeid = $typeid;
	}

///// Set methods /////

	/**
	 * Set the user value (and compute other representations if possible).
	 * The given value is a string as supplied by some user. An alternative
	 * label for printout might also be specified.
	 */
	public function setUserValue($value, $caption = false) {
		wfProfileIn('SMWDataValue::setUserValue (SMW)');
		$this->m_errors = array(); // clear errors
		$this->m_haserrors = false;
		$this->m_infolinks = array(); // clear links
		$this->m_isset = false;
		$this->m_hasssearchlink = false;
		$this->m_hasservicelinks = false;
		$this->m_stubvalues = false;
		$this->m_caption = is_string($caption)?trim($caption):false;
		// The following checks for markers generated by MediaWiki to handle special content,
		// e.g. math. In general, we are not prepared to handle such content properly, and we
		// also have no means of obtaining the user input at this point. Hence the assignement
		// just fails.
		// Note: \x07 was used in MediaWiki 1.11.0, \x7f is used now
		if ((strpos($value,"\x7f") === false) && (strpos($value,"\x07") === false)) {
			$this->parseUserValue($value); // may set caption if not set yet, depending on datavalue
			$this->m_isset = true;
		} else {
			wfLoadExtensionMessages('SemanticMediaWiki');
			$this->addError(wfMsgForContent('smw_parseerror'));
		}
		if ($this->isValid()) {
			$this->checkAllowedValues();
		}
		wfProfileOut('SMWDataValue::setUserValue (SMW)');
	}

	/**
	 * Initialise this object based on an array of values. The contents
	 * of the array depends on the given datatype. All implementations
	 * should support round-tripping between this function and getDBkeys().
	 * However, implementations MUST NOT assume that the provided array
	 * was generated by their own getDBkeys() function. In particular, it
	 * may contain fewer entries (but more than one) and their content
	 * may not be as expected. Implementations must make sure that no
	 * warnings, errors, notices, etc. occur in such cases.
	 */
	public function setDBkeys($args) {
		$this->m_errors = array(); // clear errors
		$this->m_haserrors = false;
		$this->m_infolinks = array(); // clear links
		$this->m_hasssearchlink = false;
		$this->m_hasservicelinks = false;
		$this->m_caption = false;
		$this->m_stubvalues = $args;
		$this->m_isset = true;
	}

	/**
	 * This function does the acutal processing for loading a datavalue's
	 * contents from a value array. setDBkeys() merely stores the given
	 * values, whereas unstub() actually parses and processes them. This
	 * function usually needs to be called before any outputs can be returned.
	 * It takes only very little effort if unstubbing is not needed.
	 */
	protected function unstub() {
		if ($this->m_stubvalues !== false) {
			wfProfileIn('SMWDataValue::unstub-' . $this->m_typeid . ' (SMW)');
			$args = $this->m_stubvalues;
			$this->m_stubvalues = false; // careful to avoid recursive unstubbing
			$this->parseDBkeys($args);
			wfProfileOut('SMWDataValue::unstub-' . $this->m_typeid . ' (SMW)');
		}
	}

	/**
	 * Specify the property to which this value refers. Used to generate search links and
	 * to find custom settings that relate to the property.
	 */
	public function setProperty(SMWPropertyValue $property) {
		$this->m_property = $property;
	}

	/**
	 * Change the caption (the text used for displaying this datavalue). The given
	 * value must be a string.
	 */
	public function setCaption($caption) {
		$this->m_caption = $caption;
	}

	public function addInfolink(SMWInfolink $link) {
		$this->m_infolinks[] = $link;
	}

	/**
	 * Servicelinks are special kinds of infolinks that are created from current parameters
	 * and in-wiki specification of URL templates. This method adds the current property's
	 * servicelinks found in the messages. The number and content of the parameters is
	 * depending on the datatype, and the service link message is usually crafted with a
	 * particular datatype in mind.
	 */
	public function addServiceLinks() {
		if ($this->m_hasservicelinks) return;
		if ( ($this->m_property === NULL) || ($this->m_property->getWikiPageValue() === NULL) ) return; // no property known
		$args = $this->getServiceLinkParams();
		if ($args === false) return; // no services supported
		array_unshift($args, ''); // add a 0 element as placeholder
		$servicelinks = smwfGetStore()->getPropertyValues($this->m_property->getWikiPageValue(), SMWPropertyValue::makeProperty('_SERV'));

		foreach ($servicelinks as $dv) {
			wfLoadExtensionMessages('SemanticMediaWiki');
			$args[0] = 'smw_service_' . str_replace(' ', '_', $dv->getWikiValue()); // messages distinguish ' ' from '_'
			$text = call_user_func_array('wfMsgForContent', $args);
			$links = preg_split("/[\n][\s]?/u", $text);
			foreach ($links as $link) {
				$linkdat = explode('|',$link,2);
				if (count($linkdat) == 2)
					$this->addInfolink(SMWInfolink::newExternalLink($linkdat[0],trim($linkdat[1])));
			}
		}
		$this->m_hasservicelinks = true;
	}

	/**
	 * Define a particular output format. Output formats are user-supplied strings
	 * that the datavalue may (or may not) use to customise its return value. For
	 * example, quantities with units of measurement may interpret the string as
	 * a desired output unit. In other cases, the output format might be built-in
	 * and subject to internationalisation (which the datavalue has to implement).
	 * In any case, an empty string resets the output format to the default.
	 *
	 * There is one predeeind output format that all datavalues should respect: the
	 * format '-' indicates "plain" output that is most useful for further processing
	 * the value in a template. It should not use any wiki markup or beautification,
	 * and it should also avoid localization to the current language. When users
	 * explicitly specify an empty format string in a query, it is normalized to "-"
	 * to avoid confusion. Note that empty format strings are not interpreted in
	 * this way when directly passed to this function.
	 */
	public function setOutputFormat($formatstring) {
		$this->m_outformat = $formatstring; // just store it, subclasses may or may not use this
	}

	/**
	 * Add a new error string or array of such strings to the error list.
	 * @note All error strings must be wiki and html-safe! No further escaping
	 * will happen!
	 */
	public function addError($error) {
		if (is_array($error)) {
			$this->m_errors = array_merge($this->m_errors, $error);
			$this->m_haserrors = $this->m_haserrors || (count($error)>0);
		} else {
			$this->m_errors[] = $error;
			$this->m_haserrors = true;
		}
	}

	/**
	 * Clear error messages. This function is provided temporarily to allow
	 * n-ary to do this. Eventually, n-ary should implement its setDBkeys()
	 * properly so that this function will vanish again.
	 * @note Do not use this function in external code.
	 */
	protected function clearErrors() {
		$this->m_errors = array();
		$this->m_haserrors = false;
	}

///// Abstract processing methods /////

	/**
	 * Initialise the datavalue from the given value string.
	 * The format of this strings might be any acceptable user input
	 * and especially includes the output of getWikiValue().
	 */
	abstract protected function parseUserValue($value);

	/**
	 * Initialise the datavalue from the given value string and unit.
	 * The format of both strings strictly corresponds to the output
	 * of this implementation for getDBkeys().
	 */
	abstract protected function parseDBkeys($args);

///// Get methods /////


	/**
	 * Return an array of values that characterize the given datavalue
	 * completely, and that are sufficient to reproduce a value of identical
	 * content using the function setDBkeys(). The value array must use number
	 * keys that agree with the array's natural order (in which the data was
	 * added), and the array MUST contain at least one value in any case.
	 * Moreover, the order and type of the array's entries must be as described
	 * in by getSignature(); see its documentation for details. The only
	 * exception are classes that inherit from SMWContainerValue which must
	 * adhere to the special format of this class.
	 *
	 * The array should only contain components required for storing and
	 * sorting. It should provide a compact form for the data that is still
	 * easy to unserialize into a new object. Many datatypes will use arrays
	 * with only one entry here.
	 */
	abstract public function getDBkeys();

	/**
	 * Return a signature string that encodes the order and type of the data
	 * that is contained in the array given by getDBkeys(). Single letters are
	 * used to encode different datatypes. The signature is used to determine
	 * how to store data of this kind. The available type letters are:
	 * - t for strings of the same maximal length as MediaWiki title names,
	 * - l for arbitrarily long strings; searching/sorting with such data may
	 *     be limited for performance reasons,
	 * - w for strings as used in MediaWiki for encoding interwiki prefixes
	 * - u for short ("unit") strings; used for units of measurement in SMW
	 * - n for namespace numbers (or other similar integers)
	 * - f for floating point numbers of double precision
	 * - c for the special container format used by SMWContainerValue; if used
	 *     then the signature must be 'c' without any other fields.
	 *
	 * Do not use any other letters in signatures of datavalues. For example,
	 * a wiki page consists of a title, namespace, interwiki prefix, and a
	 * sortkey for ordering it, so its signature is "tnwt". The below default
	 * definition provides a workable fallback, but it is recommended to
	 * define the signature explicitly in all datavalues that implement
	 * getDBkeys() anew.
	 */
	public function getSignature() {
		return 't';
	}

	/**
	 * This function specifies the index of the DB key that should be used for
	 * sorting values of this type. It refers to the array that is returned by
	 * getDBkeys() and specified by getSignature(), where the first index is 0.
	 * For example, a wiki page type with signature "tnwt" would set this value
	 * to 3 so that page are ordered by their sortkey (the second "t" field).
	 * The order that is used (e.g. numeric or lexicographic) is determined by
	 * the type of the resepctive field. If no ordering is supported for this
	 * data value, then -1 can be returned here.
	 */
	public function getValueIndex() {
		return 0;
	}

	/**
	 * This function specifies the index of the DB key that should be used for
	 * string-matching values of this type. SMW supports some query conditions
	 * that involve string patterns. Since numerical sort fields cannot be used
	 * for this, this index might differ from getValueIndex(). Otherwise, all
	 * documentation of getValueIndex() applies.
	 * @note Any given storage implementation might decide to not support
	 * string matching conditions for the specified value if not available for
	 * its type.
	 */
	public function getLabelIndex() {
		return 0;
	}

	/**
	 * Returns a short textual representation for this data value. If the value
	 * was initialised from a user supplied string, then this original string
	 * should be reflected in this short version (i.e. no normalisation should
	 * normally happen). There might, however, be additional parts such as code
	 * for generating tooltips. The output is in wiki text.
	 *
	 * The parameter $linked controls linking of values such as titles and should
	 * be non-NULL and non-false if this is desired.
	 */
	abstract public function getShortWikiText($linked = NULL);

	/**
	 * Returns a short textual representation for this data value. If the value
	 * was initialised from a user supplied string, then this original string
	 * should be reflected in this short version (i.e. no normalisation should
	 * normally happen). There might, however, be additional parts such as code
	 * for generating tooltips. The output is in HTML text.
	 *
	 * The parameter $linker controls linking of values such as titles and should
	 * be some Linker object (or NULL for no linking).
	 */
	abstract public function getShortHTMLText($linker = NULL);

	/**
	 * Return the long textual description of the value, as printed for
	 * example in the factbox. If errors occurred, return the error message
	 * The result always is a wiki-source string.
	 *
	 * The parameter $linked controls linking of values such as titles and should
	 * be non-NULL and non-false if this is desired.
	 */
	abstract public function getLongWikiText($linked = NULL);

	/**
	 * Return the long textual description of the value, as printed for
	 * example in the factbox. If errors occurred, return the error message
	 * The result always is an HTML string.
	 *
	 * The parameter $linker controls linking of values such as titles and should
	 * be some Linker object (or NULL for no linking).
	 */
	abstract public function getLongHTMLText($linker = NULL);

	/**
	 * Returns a short textual representation for this data value. If the value
	 * was initialised from a user supplied string, then this original string
	 * should be reflected in this short version (i.e. no normalisation should
	 * normally happen). There might, however, be additional parts such as code
	 * for generating tooltips. The output is in the specified format.
	 *
	 * The parameter $linker controls linking of values such as titles and should
	 * be some Linker object (for HTML output), or NULL for no linking.
	 */
	public function getShortText($outputformat, $linker = NULL) {
		switch ($outputformat) {
			case SMW_OUTPUT_WIKI: return $this->getShortWikiText($linker);
			case SMW_OUTPUT_HTML: case SMW_OUTPUT_FILE: default: return $this->getShortHTMLText($linker);
		}
	}

	/**
	 * Return the long textual description of the value, as printed for
	 * example in the factbox. If errors occurred, return the error message.
	 * The output is in the specified format.
	 *
	 * The parameter $linker controls linking of values such as titles and should
	 * be some Linker object (for HTML output), or NULL for no linking.
	 */
	public function getLongText($outputformat, $linker = NULL) {
		switch ($outputformat) {
			case SMW_OUTPUT_WIKI: return $this->getLongWikiText($linker);
			case SMW_OUTPUT_HTML: case SMW_OUTPUT_FILE: default: return $this->getLongHTMLText($linker);
		}
	}

	/**
	 * Return text serialisation of info links. Ensures more uniform layout
	 * throughout wiki (Factbox, Property pages, ...).
	 */
	public function getInfolinkText($outputformat, $linker=NULL) {
		$result = '';
		$first = true;
		$extralinks = array();
		switch ($outputformat) {
		case SMW_OUTPUT_WIKI:
			foreach ($this->getInfolinks() as $link) {
				if ($first) {
					$result .= '<!-- -->&nbsp;&nbsp;' . $link->getWikiText();
						// the comment is needed to prevent MediaWiki from linking URL-strings together with the nbsps!
					$first = false;
				} else {
					$extralinks[] = $link->getWikiText();
				}
			}
			break;
		case SMW_OUTPUT_HTML: case SMW_OUTPUT_FILE: default:
			foreach ($this->getInfolinks() as $link) {
				if ($first) {
					$result .= '&nbsp;&nbsp;' . $link->getHTML($linker);
					$first = false;
				} else {
					$extralinks[] = $link->getHTML($linker);
				}
			}
			break;
		}
		if (count($extralinks) > 0) {
			$result .= smwfEncodeMessages($extralinks, 'info', ', <!--br-->');
		}
		return $result;
	}

	/**
	 * Return the plain wiki version of the value, or
	 * FALSE if no such version is available. The returned
	 * string suffices to reobtain the same DataValue
	 * when passing it as an input string to setUserValue().
	 * Thus it also includes units, if any.
	 */
	abstract public function getWikiValue();

	/**
	 * Return the numeric representation of the value that can be
	 * used for ordering values of this datatype. The given number
	 * can be approximate and need not completely reflect the contents
	 * of a data value. It merely is used for comparing two such
	 * values. NULL is returned if no such number is provided, but
	 * it is recommended to use isNumeric() to check for this case.
	 * @note Storage implementations can assume numerical values to
	 * be completely determined from the given datavalue (i.e. from the
	 * vector returned by getDBkeys().
	 */
	public function getNumericValue() {
		return NULL;
	}

	/**
	 * Return a short string that unambiguously specify the type of this value.
	 * This value will globally be used to identify the type of a value (in spite
	 * of the class it actually belongs to, which can still implement various types).
	 */
	public function getTypeID() {
		return $this->m_typeid;
	}

	/**
	 * Return an array of SMWLink objects that provide additional resources
	 * for the given value.
	 * Captions can contain some HTML markup which is admissible for wiki
	 * text, but no more. Result might have no entries but is always an array.
	 */
	public function getInfolinks() {
		if ($this->isValid() && ($this->m_property !== NULL) && ($this->m_property->getWikiPageValue() !== NULL) ) {
			if (!$this->m_hasssearchlink) { // add default search link
				$this->m_hasssearchlink = true;
				$this->m_infolinks[] = SMWInfolink::newPropertySearchLink('+', $this->m_property->getWikiValue(), $this->getWikiValue());
			}
			if (!$this->m_hasservicelinks) { // add further service links
				$this->addServiceLinks();
			}
		}
		return $this->m_infolinks;
	}

	/**
	 * Overwritten by callers to supply an array of parameters that can be used for
	 * creating servicelinks. The number and content of values in the parameter array
	 * may vary, depending on the concrete datatype.
	 */
	protected function getServiceLinkParams() {
		return false;
	}

	/**
	 * Return a string that identifies the value of the object, and that can
	 * be used to compare different value objects.
	 * Possibly overwritten by subclasses (e.g. to ensure that returned value is
	 * normalised first)
	 */
	public function getHash() {
		return $this->isValid()?implode("\t", $this->getDBkeys()):implode("\t", $this->m_errors);
	}

	/**
	 * Return TRUE if values of the given type generally have a numeric version,
	 * i.e. if getNumericValue returns a meaningful numeric sortkey.
	 * Possibly overwritten by subclasses.
	 */
	public function isNumeric() {
		return false;
	}

	/**
	 * Return TRUE if a value was defined and understood by the given type,
	 * and false if parsing errors occured or no value was given.
	 */
	public function isValid() {
		$this->unstub();
		return ( (!$this->m_haserrors) && $this->m_isset );
	}

	/**
	 * Return a string that displays all error messages as a tooltip, or
	 * an empty string if no errors happened.
	 */
	public function getErrorText() {
		$this->unstub();
		return smwfEncodeMessages($this->m_errors);
	}

	/**
	 * Return an array of error messages, or an empty array
	 * if no errors occurred.
	 */
	public function getErrors() {
		$this->unstub();
		return $this->m_errors;
	}

	/**
	 * Create an SMWExpData object that encodes the given data value in an exportable
	 * way. This representation is used by exporters, e.g. to be further decomposed into
	 * RDF triples or to generate OWL/XML serialisations.
	 * If the value is empty or invalid, NULL is returned.
	 */
	public function getExportData() { // default implementation: encode values as untyped string
		if ($this->isValid()) {
			$lit = new SMWExpLiteral(smwfHTMLtoUTF8(implode(';',$this->getDBkeys())), $this);
			return new SMWExpData($lit);
		} else {
			return NULL;
		}
	}

	/**
	 * Check if property is range restricted and, if so, whether the current value is allowed.
	 * Creates an error if the value is illegal.
	 */
	protected function checkAllowedValues() {
		if ( ($this->m_property === NULL) || ($this->m_property->getWikiPageValue() === NULL) ) return; // no property known
		$allowedvalues = smwfGetStore()->getPropertyValues($this->m_property->getWikiPageValue(), SMWPropertyValue::makeProperty('_PVAL'));
		if (count($allowedvalues) == 0) return;
		$hash = $this->getHash();
		$value = SMWDataValueFactory::newTypeIDValue($this->getTypeID());
		$accept = false;
		$valuestring = '';
		foreach ($allowedvalues as $stringvalue) {
			$value->setUserValue($stringvalue->getWikiValue());
			if ($hash === $value->getHash()) {
				$accept = true;
				break;
			} else {
				if ($valuestring != '') {
					$valuestring .= ', ';
				}
				$valuestring .= $value->getShortWikiText();
			}
		}
		if (!$accept) {
			wfLoadExtensionMessages('SemanticMediaWiki');
			$this->addError(wfMsgForContent('smw_notinenum', $this->getWikiValue(), $valuestring));
		}
	}


	/**
	 * Set the xsd value (and compute other representations if possible).
	 * The given value is a string that was provided by getXSDValue() (all
	 * implementations should support round-tripping).
	 * @deprecated Use setDBkeys(). This function will vanish before SMW 1.6.
	 */
	public function setXSDValue($value, $unit = '') {
		$this->setDBkeys(array($value, $unit));
	}

	/**
	 * Initialise the datavalue from the given value string and unit.
	 * The format of both strings strictly corresponds to the output
	 * of this implementation for getXSDValue() and getUnit().
	 * @deprecated Use parseDBkeys(). This function will vanish before SMW 1.6.
	 */
	protected function parseXSDValue($value, $unit) {
		$this->parseDBkeys(array($value, $unit));
	}

	/**
	 * Return the XSD compliant version of the value, or FALSE if parsing the
	 * value failed and no XSD version is available. If the datatype has units,
	 * then this value is given in the unit provided by getUnit().
	 * @deprecated Use getDBkeys(). This function will vanish before SMW 1.6.
	 */
	public function getXSDValue() {
		$keys = $this->getDBkeys();
		return array_key_exists(0,$keys)?$keys[0]:'';
	}

	/**
	 * Return the unit in which the returned value is to be interpreted.
	 * This string is a plain UTF-8 string without wiki or html markup.
	 * Returns the empty string if no unit is given for the value.
	 * Possibly overwritten by subclasses.
	 * @deprecated Use getDBkeys(). This function will vanish before SMW 1.6.
	 */
	public function getUnit() {
		return ''; // empty unit
	}

}



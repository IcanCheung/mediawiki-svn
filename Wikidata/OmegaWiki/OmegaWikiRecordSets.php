<?php

require_once('OmegaWikiAttributes.php');
require_once('Record.php');
require_once('RecordSet.php');
require_once('WikiDataAPI.php');
require_once('Transaction.php');
require_once('WikiDataTables.php');
require_once('RecordSetQueries.php');
require_once('DefinedMeaningModel.php');
require_once('ViewInformation.php');

function getSynonymSQLForLanguage($languageId, array &$definedMeaningIds) {
	$dc=wdGetDataSetContext();

	return 
		"SELECT {$dc}_defined_meaning.defined_meaning_id AS defined_meaning_id, {$dc}_expression_ns.spelling AS label " .
		" FROM {$dc}_defined_meaning, {$dc}_syntrans, {$dc}_expression_ns " .
		" WHERE {$dc}_defined_meaning.defined_meaning_id IN (" . implode(", ", $definedMeaningIds) . ")" .
		" AND " . getLatestTransactionRestriction("{$dc}_syntrans") .
		" AND " . getLatestTransactionRestriction("{$dc}_expression_ns") .
		" AND " . getLatestTransactionRestriction("{$dc}_defined_meaning") .
		" AND {$dc}_expression_ns.language_id=" . $languageId .
		" AND {$dc}_expression_ns.expression_id={$dc}_syntrans.expression_id " .
		" AND {$dc}_defined_meaning.defined_meaning_id={$dc}_syntrans.defined_meaning_id " . 
		" AND {$dc}_syntrans.identical_meaning=1 " .
		" GROUP BY {$dc}_defined_meaning.defined_meaning_id";
}

function getSynonymSQLForAnyLanguage(array &$definedMeaningIds) {
	$dc=wdGetDataSetContext();

	return 
		"SELECT {$dc}_defined_meaning.defined_meaning_id AS defined_meaning_id, {$dc}_expression_ns.spelling AS label " .
		" FROM {$dc}_defined_meaning, {$dc}_syntrans, {$dc}_expression_ns " .
		" WHERE {$dc}_defined_meaning.defined_meaning_id IN (" . implode(", ", $definedMeaningIds) . ")" .
		" AND " . getLatestTransactionRestriction("{$dc}_syntrans") .
		" AND " . getLatestTransactionRestriction("{$dc}_expression_ns") .
		" AND " . getLatestTransactionRestriction("{$dc}_defined_meaning") .
		" AND {$dc}_expression_ns.expression_id={$dc}_syntrans.expression_id " .
		" AND {$dc}_defined_meaning.defined_meaning_id={$dc}_syntrans.defined_meaning_id " . 
		" AND {$dc}_syntrans.identical_meaning=1 " .
		" GROUP BY {$dc}_defined_meaning.defined_meaning_id";
}

function getDefiningSQLForLanguage($languageId, array &$definedMeaningIds) {
	$dc=wdGetDataSetContext();

	return 
		"SELECT {$dc}_defined_meaning.defined_meaning_id AS defined_meaning_id, {$dc}_expression_ns.spelling AS label " .
		" FROM {$dc}_defined_meaning, {$dc}_syntrans, {$dc}_expression_ns " .
		" WHERE {$dc}_defined_meaning.defined_meaning_id IN (" . implode(", ", $definedMeaningIds) . ")" .
		" AND " . getLatestTransactionRestriction("{$dc}_syntrans") .
		" AND " . getLatestTransactionRestriction("{$dc}_expression_ns") .
		" AND " . getLatestTransactionRestriction("{$dc}_defined_meaning") .
		" AND {$dc}_expression_ns.expression_id={$dc}_syntrans.expression_id " .
		" AND {$dc}_defined_meaning.defined_meaning_id={$dc}_syntrans.defined_meaning_id " . 
		" AND {$dc}_syntrans.identical_meaning=1 " .
		" AND {$dc}_defined_meaning.expression_id={$dc}_expression_ns.expression_id " .
		" AND {$dc}_expression_ns.language_id=" . $languageId .
		" GROUP BY {$dc}_defined_meaning.defined_meaning_id";
}

function fetchDefinedMeaningReferenceRecords($sql, array &$definedMeaningIds, array &$definedMeaningReferenceRecords, $usedAs='defined-meaning') {
	$dc=wdGetDataSetContext();

	global
		$definedMeaningReferenceStructure, $definedMeaningIdAttribute, $definedMeaningLabelAttribute,
		$definedMeaningDefiningExpressionAttribute;

	$foundDefinedMeaningIds = array();	

	$dbr =& wfGetDB(DB_SLAVE);
	$queryResult = $dbr->query($sql);

	while ($row = $dbr->fetchObject($queryResult)) {
		$definedMeaningId = $row->defined_meaning_id;

		$specificStructure=clone $definedMeaningReferenceStructure;
		$specificStructure->setStructureType($usedAs);		
		$record = new ArrayRecord($specificStructure);
		$record->setAttributeValue($definedMeaningIdAttribute, $definedMeaningId);
		$record->setAttributeValue($definedMeaningLabelAttribute, $row->label);
				
		$definedMeaningReferenceRecords[$definedMeaningId] = $record;
		$foundDefinedMeaningIds[] = $definedMeaningId;
	}
	
	$definedMeaningIds = array_diff($definedMeaningIds, $foundDefinedMeaningIds);
}

function fetchDefinedMeaningDefiningExpressions(array &$definedMeaningIds, array &$definedMeaningReferenceRecords) {
	global
		$definedMeaningReferenceStructure, $definedMeaningIdAttribute, $definedMeaningLabelAttribute,
		$definedMeaningDefiningExpressionAttribute;

	$dc=wdGetDataSetContext();
	
	$dbr =& wfGetDB(DB_SLAVE);
	$queryResult = $dbr->query(
		"SELECT {$dc}_defined_meaning.defined_meaning_id AS defined_meaning_id, {$dc}_expression_ns.spelling" .
		" FROM {$dc}_defined_meaning, {$dc}_expression_ns " .
		" WHERE {$dc}_defined_meaning.expression_id={$dc}_expression_ns.expression_id " .
		" AND " . getLatestTransactionRestriction("{$dc}_defined_meaning") .
		" AND " . getLatestTransactionRestriction("{$dc}_expression_ns") . 
		" AND {$dc}_defined_meaning.defined_meaning_id IN (". implode(", ", $definedMeaningIds) .")"
	);

	while ($row = $dbr->fetchObject($queryResult)) {
		$definedMeaningReferenceRecord = $definedMeaningReferenceRecords[$row->defined_meaning_id];
		
		if ($definedMeaningReferenceRecord == null) {
			$definedMeaningReferenceRecord = new ArrayRecord($definedMeaningReferenceStructure);
			$definedMeaningReferenceRecord->setAttributeValue($definedMeaningIdAttribute, $row->defined_meaning_id);
			$definedMeaningReferenceRecord->setAttributeValue($definedMeaningLabelAttribute, $row->spelling);
			$definedMeaningReferenceRecords[$row->defined_meaning_id] = $definedMeaningReferenceRecord; 
		}
		
		$definedMeaningReferenceRecord->setAttributeValue($definedMeaningDefiningExpressionAttribute, $row->spelling);
	}	
}

function getNullDefinedMeaningReferenceRecord() {
	global
		$definedMeaningReferenceStructure, $definedMeaningIdAttribute, $definedMeaningLabelAttribute,
		$definedMeaningDefiningExpressionAttribute;
	
	$record = new ArrayRecord($definedMeaningReferenceStructure);
	$record->setAttributeValue($definedMeaningIdAttribute, 0);
	$record->setAttributeValue($definedMeaningLabelAttribute, "");
	$record->setAttributeValue($definedMeaningDefiningExpressionAttribute, "");
	
	return $record;
}

function getDefinedMeaningReferenceRecords(array $definedMeaningIds, $usedAs) {
	global
		$wgUser;
	
//	$startTime = microtime(true);

	$result = array();
	$definedMeaningIdsForExpressions = $definedMeaningIds;

	if (count($definedMeaningIds) > 0) {
		$userLanguage = getLanguageIdForCode($wgUser->getOption('language'));
		
		if ($userLanguage > 0)
			$definingLanguage = $userLanguage;
		else
			$definingLanguage = 85;
			
		fetchDefinedMeaningReferenceRecords(
			getDefiningSQLForLanguage($definingLanguage, $definedMeaningIds),
			$definedMeaningIds,
			$result,
			$usedAs
		);
	
		if (count($definedMeaningIds) > 0) {
			if ($userLanguage > 0)
				fetchDefinedMeaningReferenceRecords(
					getSynonymSQLForLanguage($userLanguage, $definedMeaningIds),
					$definedMeaningIds,
					$result,
					$usedAs
					
				);
	
			if (count($definedMeaningIds) > 0) {
				fetchDefinedMeaningReferenceRecords(
					getSynonymSQLForLanguage(85, $definedMeaningIds),
					$definedMeaningIds,
					$result,
					$usedAs
				);
		
				if (count($definedMeaningIds) > 0) {
					fetchDefinedMeaningReferenceRecords(
						getSynonymSQLForAnyLanguage($definedMeaningIds),
						$definedMeaningIds,
						$result,
						$usedAs
					);
				}
			}
		}
		
		fetchDefinedMeaningDefiningExpressions($definedMeaningIdsForExpressions, $result);
		$result[0] = getNullDefinedMeaningReferenceRecord();
	}

//	$queriesTime = microtime(true) - $startTime;
//	echo "<!-- Defined meaning reference queries: " . $queriesTime . " -->\n";

	return $result;
}

function expandDefinedMeaningReferencesInRecordSet(RecordSet $recordSet, array $definedMeaningAttributes) {
	$definedMeaningReferenceRecords=array();

	foreach($definedMeaningAttributes as $dmatt) {
		$tmpArray = getDefinedMeaningReferenceRecords(getUniqueIdsInRecordSet($recordSet, array($dmatt)), $dmatt->id);
		$definedMeaningReferenceRecords+=$tmpArray;

	}

	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);
		foreach($definedMeaningAttributes as $definedMeaningAttribute)
			$record->setAttributeValue(
				$definedMeaningAttribute, 
				$definedMeaningReferenceRecords[$record->getAttributeValue($definedMeaningAttribute)]
			);
	} 
}

function expandTranslatedContentInRecord(Record $record, Attribute $idAttribute, Attribute $translatedContentAttribute, ViewInformation $viewInformation) {
	$record->setAttributeValue(
		$translatedContentAttribute, 
		getTranslatedContentValue($record->getAttributeValue($idAttribute), $viewInformation)
	);
}

function expandTranslatedContentsInRecordSet(RecordSet $recordSet, Attribute $idAttribute, Attribute $translatedContentAttribute, ViewInformation $viewInformation) {
	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) 
		expandTranslatedContentInRecord($recordSet->getRecord($i), $idAttribute, $translatedContentAttribute, $viewInformation);
}									

function getExpressionReferenceRecords($expressionIds) {
	global
		$expressionStructure, $languageAttribute, $spellingAttribute;
	
	$dc=wdGetDataSetContext();

	if (count($expressionIds) > 0) {
		$dbr =& wfGetDB(DB_SLAVE);
		$queryResult = $dbr->query(
			"SELECT expression_id, language_id, spelling" .
			" FROM {$dc}_expression_ns" .
			" WHERE expression_id IN (". implode(', ', $expressionIds) .")" .
			" AND ". getLatestTransactionRestriction("{$dc}_expression_ns")
		);
		
		$result = array();
	
		while ($row = $dbr->fetchObject($queryResult)) {
			$record = new ArrayRecord($expressionStructure);
			$record->setAttributeValue($languageAttribute, $row->language_id);
			$record->setAttributeValue($spellingAttribute, $row->spelling);
			
			$result[$row->expression_id] = $record;
		}
			
		return $result;
	}
	else
		return array();
}

function expandExpressionReferencesInRecordSet(RecordSet $recordSet, array $expressionAttributes) {
	$expressionReferenceRecords = getExpressionReferenceRecords(getUniqueIdsInRecordSet($recordSet, $expressionAttributes));

	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);
		
		foreach($expressionAttributes as $expressionAttribute)
			$record->setAttributeValue(
				$expressionAttribute, 
				$expressionReferenceRecords[$record->getAttributeValue($expressionAttribute)]
			);
	} 
}

function getExpressionSpellings(array $expressionIds) {
	global
		$expressionAttribute;
	
	$dc=wdGetDataSetContext();

	if (count($expressionIds) > 0) {
		$dbr =& wfGetDB(DB_SLAVE);
		$queryResult = $dbr->query(
			"SELECT expression_id, spelling" .
			" FROM {$dc}_expression_ns" .
			" WHERE expression_id IN (". implode(', ', $expressionIds) .")" .
			" AND ". getLatestTransactionRestriction("{$dc}_expression_ns")
		);
		
		$result = array();
	
		while ($row = $dbr->fetchObject($queryResult)) 
			$result[$row->expression_id] = $row->spelling;
			
		return $result;
	}
	else
		return array();
}

function expandExpressionSpellingsInRecordSet(RecordSet $recordSet, array $expressionAttributes) {
	$expressionSpellings = getExpressionSpellings(getUniqueIdsInRecordSet($recordSet, $expressionAttributes));

	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);
		
		foreach($expressionAttributes as $expressionAttribute)
			$record->setAttributeValue(
				$expressionAttribute, 
				$expressionSpellings[$record->getAttributeValue($expressionAttribute)]
			);
	} 
}

function getTextReferences(array $textIds) {
	$dc=wdGetDataSetContext();
	if (count($textIds) > 0) {
		$dbr =& wfGetDB(DB_SLAVE);
		$queryResult = $dbr->query(
			"SELECT text_id, text_text" .
			" FROM {$dc}_text" .
			" WHERE text_id IN (". implode(', ', $textIds) .")"
		);
		
		$result = array();
	
		while ($row = $dbr->fetchObject($queryResult)) 
			$result[$row->text_id] = $row->text_text;
			
		return $result;
	}
	else
		return array();
}

function expandTextReferencesInRecordSet(RecordSet $recordSet, array $textAttributes) {
	$textReferences = getTextReferences(getUniqueIdsInRecordSet($recordSet, $textAttributes));

	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);

		foreach($textAttributes as $textAttribute) {
			$textId = $record->getAttributeValue($textAttribute);
			
			if (isset($textReferences[$textId])) 
				$textValue = $textReferences[$textId]; 
			else
				$textValue = "";
			
			$record->setAttributeValue($textAttribute, $textValue);
		}
	} 
}

function getExpressionMeaningsRecordSet($expressionId, $exactMeaning, ViewInformation $viewInformation) {
	global
		$expressionMeaningStructure, $definedMeaningIdAttribute;

	$dc=wdGetDataSetContext();
	$identicalMeaning = $exactMeaning ? 1 : 0;

	$recordSet = new ArrayRecordSet($expressionMeaningStructure, new Structure($definedMeaningIdAttribute));

	$dbr =& wfGetDB(DB_SLAVE);
	$queryResult = $dbr->query(
		"SELECT defined_meaning_id FROM {$dc}_syntrans" .
		" WHERE expression_id=$expressionId AND identical_meaning=" . $identicalMeaning .
		" AND ". getLatestTransactionRestriction("{$dc}_syntrans")
	);

	while($definedMeaning = $dbr->fetchObject($queryResult)) {
		$definedMeaningId = $definedMeaning->defined_meaning_id;
		$dmModel=new DefinedMeaningModel($definedMeaningId, $viewInformation);
		$recordSet->addRecord(
			array(
				$definedMeaningId, 
				getDefinedMeaningDefinition($definedMeaningId), 
				$dmModel->getRecord()
			)
		);
	}

	return $recordSet;
}

function getExpressionMeaningsRecord($expressionId, ViewInformation $viewInformation) {
	global
		$expressionMeaningsStructure, $expressionExactMeaningsAttribute, $expressionApproximateMeaningsAttribute;
		
	$record = new ArrayRecord($expressionMeaningsStructure);
	$record->setAttributeValue($expressionExactMeaningsAttribute, getExpressionMeaningsRecordSet($expressionId, true, $viewInformation));
	$record->setAttributeValue($expressionApproximateMeaningsAttribute, getExpressionMeaningsRecordSet($expressionId, false, $viewInformation));
	
	return $record;
}

function getExpressionsRecordSet($spelling, ViewInformation $viewInformation) {
	global
		$expressionIdAttribute, $expressionAttribute, $languageAttribute, $expressionMeaningsAttribute, $expressionsStructure;

	$dc=wdGetDataSetContext();

	$languageRestriction = $viewInformation->filterLanguageId != 0 ? " AND language_id=". $viewInformation->filterLanguageId : "";

	$dbr =& wfGetDB(DB_SLAVE);
	$queryResult = $dbr->query(
		"SELECT expression_id, language_id " .
		" FROM {$dc}_expression_ns" .
		" WHERE spelling=BINARY " . $dbr->addQuotes($spelling) .
		" AND " . getLatestTransactionRestriction("{$dc}_expression_ns") .
		$languageRestriction .
		" AND EXISTS (" .
			"SELECT expression_id " .
			" FROM {$dc}_syntrans " .
			" WHERE {$dc}_syntrans.expression_id={$dc}_expression_ns.expression_id" .
			" AND ". getLatestTransactionRestriction("{$dc}_syntrans") 
		.")"
	);
	
	$result = new ArrayRecordSet($expressionsStructure, new Structure("expression-id", $expressionIdAttribute));
	$languageStructure = new Structure("language", $languageAttribute);

	while($expression = $dbr->fetchObject($queryResult)) {
		$expressionRecord = new ArrayRecord($languageStructure);
		$expressionRecord->setAttributeValue($languageAttribute, $expression->language_id);

		$result->addRecord(array(
			$expression->expression_id, 
			$expressionRecord, 
			getExpressionMeaningsRecord($expression->expression_id, $viewInformation)
		));
	}

	return $result;
}

function getExpressionIdThatHasSynonyms($spelling, $languageId) {
	$dc=wdGetDataSetContext();

	$dbr =& wfGetDB(DB_SLAVE);
	$queryResult = $dbr->query(
		"SELECT expression_id, language_id " .
		" FROM {$dc}_expression_ns" .
		" WHERE spelling=BINARY " . $dbr->addQuotes($spelling) .
		" AND " . getLatestTransactionRestriction("{$dc}_expression_ns") .
		" AND language_id=$languageId" .
		" AND EXISTS (" .
			"SELECT expression_id " .
			" FROM {$dc}_syntrans " .
			" WHERE {$dc}_syntrans.expression_id={$dc}_expression_ns.expression_id" .
			" AND ". getLatestTransactionRestriction("{$dc}_syntrans") 
		.")"
	);
	
	if ($expression = $dbr->fetchObject($queryResult)) 
		return $expression->expression_id;
	else
		return 0;
}
 

function getClassAttributesRecordSet($definedMeaningId, ViewInformation $viewInformation) {
	global
		$classAttributesTable, $classAttributeIdAttribute, $classAttributeLevelAttribute, $classAttributeAttributeAttribute, $classAttributeTypeAttribute, $optionAttributeOptionsAttribute,
		$classAttributesStructure;

	$recordSet = queryRecordSet(
		$classAttributesStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$classAttributeIdAttribute,
		array(
			'object_id' => $classAttributeIdAttribute,
			'level_mid' => $classAttributeLevelAttribute,
			'attribute_mid' => $classAttributeAttributeAttribute,
			'attribute_type' => $classAttributeTypeAttribute
		),
		$classAttributesTable,
		array("class_mid=$definedMeaningId")
	);
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($classAttributeLevelAttribute ,$classAttributeAttributeAttribute));
	expandOptionAttributeOptionsInRecordSet($recordSet, $classAttributeIdAttribute, $viewInformation);

	return $recordSet;
}

function expandOptionAttributeOptionsInRecordSet(RecordSet $recordSet, Attribute $attributeIdAttribute, ViewInformation $viewInformation) {
	global
		$definedMeaningIdAttribute, $optionAttributeOptionsAttribute;

	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);

		$record->setAttributeValue($optionAttributeOptionsAttribute, getOptionAttributeOptionsRecordSet($record->getAttributeValue($attributeIdAttribute), $viewInformation));
	}
}

function getAlternativeDefinitionsRecordSet($definedMeaningId, ViewInformation $viewInformation) {
	global
		$alternativeDefinitionsTable, $definitionIdAttribute, $alternativeDefinitionAttribute, $sourceAttribute,
		$alternativeDefinitionsStructure;

	$recordSet = queryRecordSet(
		$alternativeDefinitionsStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$definitionIdAttribute,
		array(
			'meaning_text_tcid' => $definitionIdAttribute, 
			'source_id' => $sourceAttribute
		),
		$alternativeDefinitionsTable,
		array("meaning_mid=$definedMeaningId")
	);

	$recordSet->getStructure()->addAttribute($alternativeDefinitionAttribute);
	
	expandTranslatedContentsInRecordSet($recordSet, $definitionIdAttribute, $alternativeDefinitionAttribute, $viewInformation);									
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($sourceAttribute));

	return $recordSet;
}

function getDefinedMeaningDefinitionRecord($definedMeaningId, ViewInformation $viewInformation) {
	global
		$definitionAttribute, $translatedTextAttribute, $objectAttributesAttribute;
		
	$definitionId = getDefinedMeaningDefinitionId($definedMeaningId);
	$record = new ArrayRecord(new Structure($definitionAttribute));
	$record->setAttributeValue($translatedTextAttribute, getTranslatedContentValue($definitionId, $viewInformation));
	
	$objectAttributesRecord = getObjectAttributesRecord($definitionId, $viewInformation, $objectAttributesAttribute->id);
	$record->setAttributeValue($objectAttributesAttribute, $objectAttributesRecord);
	
	applyPropertyToColumnFiltersToRecord($record, $objectAttributesRecord, $viewInformation);

	return $record;
}

function applyPropertyToColumnFiltersToRecord(Record $destinationRecord, Record $sourceRecord, ViewInformation $viewInformation) {
	foreach ($viewInformation->getPropertyToColumnFilters() as $propertyToColumnFilter) { 
		$destinationRecord->setAttributeValue(
			$propertyToColumnFilter->getAttribute(), 
			filterObjectAttributesRecord($sourceRecord, $propertyToColumnFilter->attributeIDs)
		);		
	}
}

function applyPropertyToColumnFiltersToRecordSet(RecordSet $recordSet, Attribute $sourceAttribute, ViewInformation $viewInformation) {
	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);
		$attributeValuesRecord = $recordSet->getAttributeValue($sourceAttribute);
		
		applyPropertyToColumnFiltersToRecord($record, $attributeValuesRecord, $viewInformation);
	}	
}

function getObjectAttributesRecord($objectId, ViewInformation $viewInformation, $structuralOverride = null) {
	global
		$objectIdAttribute, 
		$urlAttributeValuesAttribute, $textAttributeValuesAttribute, 
		$translatedTextAttributeValuesAttribute, $optionAttributeValuesAttribute,
		$definedMeaningAttributesAttribute; 

	if ($structuralOverride) 
		$record = new ArrayRecord(new Structure($structuralOverride, $definedMeaningAttributesAttribute));
	else 
		$record = new ArrayRecord(new Structure($definedMeaningAttributesAttribute));
	
	$record->setAttributeValue($objectIdAttribute, $objectId);
	$record->setAttributeValue($textAttributeValuesAttribute, getTextAttributesValuesRecordSet(array($objectId), $viewInformation));
	$record->setAttributeValue($translatedTextAttributeValuesAttribute, getTranslatedTextAttributeValuesRecordSet(array($objectId), $viewInformation));
	$record->setAttributeValue($urlAttributeValuesAttribute, getURLAttributeValuesRecordSet(array($objectId), $viewInformation));	
	$record->setAttributeValue($optionAttributeValuesAttribute, getOptionAttributeValuesRecordSet(array($objectId), $viewInformation));	

	return $record;
}

function filterAttributeValues(RecordSet $sourceRecordSet, Attribute $attributeAttribute, array &$attributeIds) {
	global
		$definedMeaningIdAttribute;
	
	$result = new ArrayRecordSet($sourceRecordSet->getStructure(), $sourceRecordSet->getKey());
	$i = 0; 
	
	while ($i < $sourceRecordSet->getRecordCount()) {
		$record = $sourceRecordSet->getRecord($i);
		
		if (in_array($record->getAttributeValue($attributeAttribute)->getAttributeValue($definedMeaningIdAttribute), $attributeIds)) {
			$result->add($record);
			$sourceRecordSet->remove($i);		
		}
		else
			$i++;
	}
	
	return $result;
}

function filterObjectAttributesRecord(Record $sourceRecord, array &$attributeIds) {
	global
		$definedMeaningAttributesAttribute, $objectIdAttribute, 
		$textAttributeValuesAttribute, $textAttributeAttribute,
		$translatedTextAttributeAttribute, $translatedTextAttributeValuesAttribute,
		$urlAttributeAttribute, $urlAttributeValuesAttribute, 
		$optionAttributeAttribute, $optionAttributeValuesAttribute;
	
	$result = new ArrayRecord(new Structure($definedMeaningAttributesAttribute));
	$result->setAttributeValue($objectIdAttribute, $sourceRecord->getAttributeValue($objectIdAttribute));
	
	$result->setAttributeValue($textAttributeValuesAttribute, filterAttributeValues(
		$sourceRecord->getAttributeValue($textAttributeValuesAttribute), 
		$textAttributeAttribute,
		$attributeIds
	));
	
	$result->setAttributeValue($translatedTextAttributeValuesAttribute, filterAttributeValues( 
		$sourceRecord->getAttributeValue($translatedTextAttributeValuesAttribute),
		$translatedTextAttributeAttribute,
		$attributeIds
	));
	
	$result->setAttributeValue($urlAttributeValuesAttribute, filterAttributeValues(
		$sourceRecord->getAttributeValue($urlAttributeValuesAttribute), 
		$urlAttributeAttribute,
		$attributeIds
	));	
	
	$result->setAttributeValue($optionAttributeValuesAttribute, filterAttributeValues(
		$sourceRecord->getAttributeValue($optionAttributeValuesAttribute),
		$optionAttributeAttribute,
		$attributeIds
	));	
	
	return $result;
}

function getTranslatedContentValue($translatedContentId, ViewInformation $viewInformation) {
	global
		$textAttribute;
	
	if ($viewInformation->filterLanguageId == 0)
		return getTranslatedContentRecordSet($translatedContentId, $viewInformation);
	else {
		$recordSet = getFilteredTranslatedContentRecordSet($translatedContentId, $viewInformation);
		
		if (count($viewInformation->queryTransactionInformation->versioningAttributes()) > 0) 
			return $recordSet;
		else {
			if ($recordSet->getRecordCount() > 0) 
				return $recordSet->getRecord(0)->getAttributeValue($textAttribute);
			else	
				return "";
		}
	}
}

function getTranslatedContentRecordSet($translatedContentId, ViewInformation $viewInformation) {
	global
		$translatedContentTable, $languageAttribute, $textAttribute,
		$translatedTextStructure;

	$recordSet = queryRecordSet(
		$translatedTextStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$languageAttribute,
		array(
			'language_id' => $languageAttribute, 
			'text_id' => $textAttribute
		),
		$translatedContentTable,
		array("translated_content_id=$translatedContentId")
	);
	
	expandTextReferencesInRecordSet($recordSet, array($textAttribute));
	
	return $recordSet;
} 

function getFilteredTranslatedContentRecordSet($translatedContentId, ViewInformation $viewInformation) {
	global
		$translatedContentTable, $languageAttribute, $textAttribute;

	$recordSet = queryRecordSet(
		null,
		$viewInformation->queryTransactionInformation,
		$languageAttribute,
		array(
			'language_id' => $languageAttribute, 
			'text_id' => $textAttribute
		),
		$translatedContentTable,
		array(
			"translated_content_id=$translatedContentId",
			"language_id=" . $viewInformation->filterLanguageId
		)
	);
	
	expandTextReferencesInRecordSet($recordSet, array($textAttribute));
	
	return $recordSet;
}

function getSynonymAndTranslationRecordSet($definedMeaningId, ViewInformation $viewInformation) {
	global
		$syntransTable, $syntransIdAttribute, $expressionAttribute, $identicalMeaningAttribute, $objectAttributesAttribute,
		$synonymsTranslationsStructure;

	$dc=wdGetDataSetContext();
	$restrictions = array("defined_meaning_id=$definedMeaningId");
	if ($viewInformation->filterLanguageId != 0) 
		$restrictions[] =
			"expression_id IN (" .
				"SELECT expressions.expression_id" .
				" FROM {$dc}_expression_ns AS expressions" .
				" WHERE expressions.expression_id=expression_id" .
				" AND language_id=" . $viewInformation->filterLanguageId .
				" AND " . getLatestTransactionRestriction('expressions') .
			")";
	
	$recordSet = queryRecordSet(
		$synonymsTranslationsStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$syntransIdAttribute,
		array(
			'syntrans_sid' => $syntransIdAttribute, 
			'expression_id' => $expressionAttribute,
			'identical_meaning' => $identicalMeaningAttribute
		),
		$syntransTable,
		$restrictions
	);
	
	if ($viewInformation->filterLanguageId == 0)
		expandExpressionReferencesInRecordSet($recordSet, array($expressionAttribute));
	else
		expandExpressionSpellingsInRecordSet($recordSet, array($expressionAttribute));

	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $syntransIdAttribute, $viewInformation);
	return $recordSet;
}

function expandObjectAttributesAttribute(RecordSet $recordSet, Attribute $attributeToExpand, Attribute $objectIdAttribute, ViewInformation $viewInformation) {
	global
		$textAttributeObjectAttribute, $textAttributeValuesAttribute, 
		$translatedTextAttributeObjectAttribute, $translatedTextAttributeValuesAttribute,
		$urlAttributeObjectAttribute, $urlAttributeValuesAttribute,
		$optionAttributeObjectAttribute, $optionAttributeValuesAttribute;
		
	$recordSetStructure = $recordSet->getStructure();
	$recordSetStructure->addAttribute($attributeToExpand);
			
	$objectAttributesRecordStructure = $attributeToExpand->type;
	$objectIds = getUniqueIdsInRecordSet($recordSet, array($objectIdAttribute));
	
	if (count($objectIds) > 0) {
		for ($i = 0; $i < count($objectIds); $i++) {
			$record = new ArrayRecord($objectAttributesRecordStructure);
			$objectAttributesRecords[$objectIds[$i]] = $record;
		}

		// Text attributes		
		$allTextAttributeValuesRecordSet = getTextAttributesValuesRecordSet($objectIds, $viewInformation); 
		$textAttributeValuesRecordSets = 
			splitRecordSet(
				$allTextAttributeValuesRecordSet,
				$textAttributeObjectAttribute
			);	
			
		$emptyTextAttributesRecordSet = new ArrayRecordSet($allTextAttributeValuesRecordSet->getStructure(), $allTextAttributeValuesRecordSet->getKey());
		
		// Translated text attributes	
		$allTranslatedTextAttributeValuesRecordSet = getTranslatedTextAttributeValuesRecordSet($objectIds, $viewInformation); 
		$translatedTextAttributeValuesRecordSets = 
			splitRecordSet(
				$allTranslatedTextAttributeValuesRecordSet,
				$translatedTextAttributeObjectAttribute
			);	
			
		$emptyTranslatedTextAttributesRecordSet = new ArrayRecordSet($allTranslatedTextAttributeValuesRecordSet->getStructure(), $allTranslatedTextAttributeValuesRecordSet->getKey());

		// URL attributes		
		$allURLAttributeValuesRecordSet = getURLAttributeValuesRecordSet($objectIds, $viewInformation); 
		$urlAttributeValuesRecordSets = 
			splitRecordSet(
				$allURLAttributeValuesRecordSet,
				$urlAttributeObjectAttribute
			);	
			
		$emptyURLAttributesRecordSet = new ArrayRecordSet($allURLAttributeValuesRecordSet->getStructure(), $allURLAttributeValuesRecordSet->getKey());
		
		// Option attributes		
		$allOptionAttributeValuesRecordSet = getOptionAttributeValuesRecordSet($objectIds, $viewInformation); 
		$optionAttributeValuesRecordSets = 
			splitRecordSet(
				$allOptionAttributeValuesRecordSet,
				$optionAttributeObjectAttribute
			);	
			
		
		$emptyOptionAttributesRecordSet = new ArrayRecordSet($allOptionAttributeValuesRecordSet->getStructure(), $allOptionAttributeValuesRecordSet->getKey());
		
		for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
			$record = $recordSet->getRecord($i);
			$objectId = $record->getAttributeValue($objectIdAttribute);
			
			// Text attributes
			if (isset($textAttributeValuesRecordSets[$objectId]))
				$textAttributeValuesRecordSet = $textAttributeValuesRecordSets[$objectId];
			else 
				$textAttributeValuesRecordSet = $emptyTextAttributesRecordSet;

			// Translated text attributes
			if (isset($translatedTextAttributeValuesRecordSets[$objectId]))
				$translatedTextAttributeValuesRecordSet = $translatedTextAttributeValuesRecordSets[$objectId];				
			else 
				$translatedTextAttributeValuesRecordSet = $emptyTranslatedTextAttributesRecordSet;

			// URL attributes
			if (isset($urlAttributeValuesRecordSets[$objectId]))
				$urlAttributeValuesRecordSet = $urlAttributeValuesRecordSets[$objectId];
			else 
				$urlAttributeValuesRecordSet = $emptyURLAttributesRecordSet;

			// Option attributes
			if (isset($optionAttributeValuesRecordSets[$objectId]))
				$optionAttributeValuesRecordSet = $optionAttributeValuesRecordSets[$objectId]; 
			else
				$optionAttributeValuesRecordSet = $emptyOptionAttributesRecordSet;

			$objectAttributesRecord = new ArrayRecord($objectAttributesRecordStructure);
			$objectAttributesRecord->setAttributeValue($objectIdAttribute, $objectId);
			$objectAttributesRecord->setAttributeValue($textAttributeValuesAttribute, $textAttributeValuesRecordSet);
			$objectAttributesRecord->setAttributeValue($translatedTextAttributeValuesAttribute, $translatedTextAttributeValuesRecordSet);
			$objectAttributesRecord->setAttributeValue($urlAttributeValuesAttribute, $urlAttributeValuesRecordSet);
			$objectAttributesRecord->setAttributeValue($optionAttributeValuesAttribute, $optionAttributeValuesRecordSet);
			
			$record->setAttributeValue($attributeToExpand, $objectAttributesRecord);
			applyPropertyToColumnFiltersToRecord($record, $objectAttributesRecord, $viewInformation);
		}
	}	
}

function getDefinedMeaningReferenceRecord($definedMeaningId) {
	global
		$definedMeaningReferenceStructure, $definedMeaningIdAttribute, $definedMeaningLabelAttribute,
		$definedMeaningDefiningExpressionAttribute;
	
	$record = new ArrayRecord($definedMeaningReferenceStructure);
	$record->setAttributeValue($definedMeaningIdAttribute, $definedMeaningId);
	$record->setAttributeValue($definedMeaningLabelAttribute, definedMeaningExpression($definedMeaningId));
	$record->setAttributeValue($definedMeaningDefiningExpressionAttribute, definingExpression($definedMeaningId));
	
	return $record;
}

function getDefinedMeaningRelationsRecordSet($definedMeaningId, array $filterRelationTypes, ViewInformation $viewInformation) {
	global
		$meaningRelationsTable, $relationIdAttribute, $relationTypeAttribute, 
		$objectAttributesAttribute, $otherDefinedMeaningAttribute,
		$relationStructure;

	$restrictions = array("meaning1_mid=$definedMeaningId");

	if (count($filterRelationTypes) > 0) 
		$restrictions[] = "relationtype_mid NOT IN (". implode(", ", $filterRelationTypes) .")";

	$recordSet = queryRecordSet(
		$relationStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$relationIdAttribute,
		array(
			'relation_id' => $relationIdAttribute, 
			'relationtype_mid' => $relationTypeAttribute, 
			'meaning2_mid' => $otherDefinedMeaningAttribute
		),
		$meaningRelationsTable,
		$restrictions,
		array('add_transaction_id')
	);
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($relationTypeAttribute, $otherDefinedMeaningAttribute));
	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $relationIdAttribute, $viewInformation);
	
	return $recordSet;
}

function getDefinedMeaningReciprocalRelationsRecordSet($definedMeaningId, ViewInformation $viewInformation) {
	global
		$meaningRelationsTable, $relationIdAttribute, $relationTypeAttribute, 
		$otherDefinedMeaningAttribute, $objectAttributesAttribute,
		$reciprocalRelationsAttribute;

	$recordSet = queryRecordSet(
		$reciprocalRelationsAttribute->id,
		$viewInformation->queryTransactionInformation,
		$relationIdAttribute,
		array(
			'relation_id' => $relationIdAttribute, 
			'relationtype_mid' => $relationTypeAttribute, 
			'meaning1_mid' => $otherDefinedMeaningAttribute
		),
		$meaningRelationsTable,
		array("meaning2_mid=$definedMeaningId"),
		array('relationtype_mid')
	);
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($relationTypeAttribute, $otherDefinedMeaningAttribute));
	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $relationIdAttribute, $viewInformation);
	
	return $recordSet;
}

function getPossiblySynonymousRecordSet($definedMeaningId, ViewInformation $viewInformation) {
	global
		$meaningRelationsTable, $possiblySynonymousIdAttribute, $possibleSynonymAttribute, 
		$objectAttributesAttribute, $otherDefinedMeaningAttribute;

	$recordSet = queryRecordSet(
		null,
		$viewInformation->queryTransactionInformation,
		$possiblySynonymousIdAttribute,
		array(
			'relation_id' => $possiblySynonymousIdAttribute, 
			'meaning2_mid' => $possibleSynonymAttribute
		),
		$meaningRelationsTable,
		array(
			"meaning1_mid=$definedMeaningId",
			"relationtype_mid=" . $viewInformation->possiblySynonymousRelationTypeId
		),
		array('add_transaction_id')
	);
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($possibleSynonymAttribute));
	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $possiblySynonymousIdAttribute, $viewInformation);
	
	return $recordSet;
}

function getGotoSourceRecord($record) {
	global
		$gotoSourceStructure, $collectionIdAttribute, $sourceIdentifierAttribute;	
		
	$result = new ArrayRecord($gotoSourceStructure);
	$result->setAttributeValue($collectionIdAttribute, $record->getAttributeValue($collectionIdAttribute));
	$result->setAttributeValue($sourceIdentifierAttribute, $record->getAttributeValue($sourceIdentifierAttribute));
	
	return $result;
}

function getDefinedMeaningCollectionMembershipRecordSet($definedMeaningId, ViewInformation $viewInformation) {
	global
		$collectionMembershipsTable, $collectionIdAttribute, $collectionMeaningAttribute, $sourceIdentifierAttribute,
		$gotoSourceAttribute, $collectionMembershipStructure;

	$recordSet = queryRecordSet(
		$collectionMembershipStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$collectionIdAttribute,
		array(
			'collection_id' => $collectionIdAttribute,
			'internal_member_id' => $sourceIdentifierAttribute
		),
		$collectionMembershipsTable,
		array("member_mid=$definedMeaningId")
	);

	$recordSet->getStructure()->addAttribute($collectionMeaningAttribute);

	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);
		$record->setAttributeValue($collectionMeaningAttribute, getCollectionMeaningId($record->getAttributeValue($collectionIdAttribute)));
		$record->setAttributeValue($gotoSourceAttribute, getGotoSourceRecord($record));	
	}
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($collectionMeaningAttribute));
	
	return $recordSet;
}

function getTextAttributesValuesRecordSet(array $objectIds, ViewInformation $viewInformation) {
	global
		$textAttributeValuesTable, $textAttributeIdAttribute, $textAttributeObjectAttribute,
		$textAttributeAttribute, $textAttribute, $objectAttributesAttribute,
		$textAttributeValuesStructure;

	$recordSet = queryRecordSet(
		$textAttributeValuesStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$textAttributeIdAttribute,
		array(
			'value_id' => $textAttributeIdAttribute,
			'object_id' => $textAttributeObjectAttribute,
			'attribute_mid' => $textAttributeAttribute,
			'text' => $textAttribute
		),
		$textAttributeValuesTable,
		array("object_id IN (" . implode(", ", $objectIds) . ")")
	);
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($textAttributeAttribute));
	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $textAttributeIdAttribute, $viewInformation);	
	
	return $recordSet;
}

function getURLAttributeValuesRecordSet(array $objectIds, ViewInformation $viewInformation) {
	global
		$urlAttributeValuesTable, $urlAttributeIdAttribute, $urlAttributeObjectAttribute,
		$urlAttributeAttribute, $urlAttribute, $objectAttributesAttribute,
		$urlAttributeValuesStructure;

	$recordSet = queryRecordSet(
		$urlAttributeValuesStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$urlAttributeIdAttribute,
		array(
			'value_id' => $urlAttributeIdAttribute,
			'object_id' => $urlAttributeObjectAttribute,
			'attribute_mid' => $urlAttributeAttribute,
			'url' => $urlAttribute
		),
		$urlAttributeValuesTable,
		array("object_id IN (" . implode(", ", $objectIds) . ")")
	);
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($urlAttributeAttribute));
	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $urlAttributeIdAttribute, $viewInformation);	
	
	return $recordSet;
}

function getTranslatedTextAttributeValuesRecordSet(array $objectIds, ViewInformation $viewInformation) {
	global
		$translatedTextAttributeIdAttribute, $translatedContentAttributeValuesTable, $translatedTextAttributeAttribute,
		$objectAttributesAttribute, $translatedTextAttributeObjectAttribute, $translatedTextValueAttribute, $translatedTextValueIdAttribute,
		$translatedTextAttributeValuesStructure;

	$recordSet = queryRecordSet(
		$translatedTextAttributeValuesStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$translatedTextAttributeIdAttribute,
		array(
			'value_id' => $translatedTextAttributeIdAttribute,
			'object_id' => $translatedTextAttributeObjectAttribute,
			'attribute_mid' => $translatedTextAttributeAttribute,
			'value_tcid' => $translatedTextValueIdAttribute
		),
		$translatedContentAttributeValuesTable,
		array("object_id IN (" . implode(", ", $objectIds) . ")")
	);
	
	$recordSet->getStructure()->addAttribute($translatedTextValueAttribute);
	
	expandTranslatedContentsInRecordSet($recordSet, $translatedTextValueIdAttribute, $translatedTextValueAttribute, $viewInformation);
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($translatedTextAttributeAttribute));
	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $translatedTextAttributeIdAttribute, $viewInformation);
	return $recordSet;
}

function getOptionAttributeOptionsRecordSet($attributeId, ViewInformation $viewInformation) {
	global
		$optionAttributeOptionIdAttribute, $optionAttributeAttribute, $optionAttributeOptionAttribute, $languageAttribute, $optionAttributeOptionsTable;

	$recordSet = queryRecordSet(
		null,
		$viewInformation->queryTransactionInformation,
		$optionAttributeOptionIdAttribute,
		array(
			'option_id' => $optionAttributeOptionIdAttribute,
			'attribute_id' => $optionAttributeAttribute,
			'option_mid' => $optionAttributeOptionAttribute,
			'language_id' => $languageAttribute
		),
		$optionAttributeOptionsTable,
		array('attribute_id = ' . $attributeId)
	);

	expandDefinedMeaningReferencesInRecordSet($recordSet, array($optionAttributeOptionAttribute));

	return $recordSet;
}

function getOptionAttributeValuesRecordSet(array $objectIds, ViewInformation $viewInformation) {
	global
		$optionAttributeIdAttribute, $optionAttributeObjectAttribute, $optionAttributeOptionIdAttribute, $optionAttributeAttribute,$optionAttributeOptionAttribute, $optionAttributeValuesTable, $objectAttributesAttribute,
		$optionAttributeValuesStructure;

	$recordSet = queryRecordSet(
		$optionAttributeValuesStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$optionAttributeIdAttribute,
		array(
			'value_id' => $optionAttributeIdAttribute,
			'object_id' => $optionAttributeObjectAttribute,
			'option_id' => $optionAttributeOptionIdAttribute
		),
		$optionAttributeValuesTable,
		array("object_id IN (" . implode(", ", $objectIds) . ")")
	);

	expandOptionsInRecordSet($recordSet, $viewInformation);
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($optionAttributeAttribute, $optionAttributeOptionAttribute));
	expandObjectAttributesAttribute($recordSet, $objectAttributesAttribute, $optionAttributeIdAttribute, $viewInformation);

	return $recordSet;
}

/* XXX: This can probably be combined with other functions. In fact, it probably should be. Do it. */
function expandOptionsInRecordSet(RecordSet $recordSet, ViewInformation $viewInformation) {
	global
		$optionAttributeOptionIdAttribute, $optionAttributeIdAttribute, $optionAttributeAttribute, $optionAttributeOptionAttribute, $optionAttributeOptionsTable, $classAttributesTable;

	for ($i = 0; $i < $recordSet->getRecordCount(); $i++) {
		$record = $recordSet->getRecord($i);

		$optionRecordSet = queryRecordSet(
			null,
			$viewInformation->queryTransactionInformation,
			$optionAttributeOptionIdAttribute,
			array(
				'attribute_id' => $optionAttributeIdAttribute,
				'option_mid' => $optionAttributeOptionAttribute
			),
			$optionAttributeOptionsTable,
			array('option_id = ' . $record->getAttributeValue($optionAttributeOptionIdAttribute))
		);

		$optionRecord = $optionRecordSet->getRecord(0);
		$record->setAttributeValue(
			$optionAttributeOptionAttribute, 
			$optionRecord->getAttributeValue($optionAttributeOptionAttribute)
		);

		$optionRecordSet = queryRecordSet(
			null,
			$viewInformation->queryTransactionInformation,
			$optionAttributeIdAttribute,
			array('attribute_mid' => $optionAttributeAttribute),
			$classAttributesTable,
			array('object_id = ' . $optionRecord->getAttributeValue($optionAttributeIdAttribute))
		);
	
		$optionRecord = $optionRecordSet->getRecord(0);
		$record->setAttributeValue(
			$optionAttributeAttribute,
			$optionRecord->getAttributeValue($optionAttributeAttribute)
		);
	} 
}

function getDefinedMeaningClassMembershipRecordSet($definedMeaningId, ViewInformation $viewInformation) {
	global
		$classMembershipsTable, $classMembershipIdAttribute, $classAttribute,
		$classMembershipStructure;

	$recordSet = queryRecordSet(
		$classMembershipStructure->getStructureType(),
		$viewInformation->queryTransactionInformation,
		$classMembershipIdAttribute,
		array(
			'class_membership_id' => $classMembershipIdAttribute, 
			'class_mid' => $classAttribute
		),
		$classMembershipsTable,
		array("class_member_mid=$definedMeaningId")
	);
	
	expandDefinedMeaningReferencesInRecordSet($recordSet, array($classAttribute));
	
	return $recordSet;
}

function getDefiningExpressionRecord($definedMeaningId) {

		global 		
			$definedMeaningCompleteDefiningExpressionAttribute,
			$definedMeaningDefiningExpressionAttribute,
			$expressionIdAttribute,
		  	$languageAttribute;	

		$definingExpression=definingExpressionRow($definedMeaningId);
		$definingExpressionRecord = new ArrayRecord($definedMeaningCompleteDefiningExpressionAttribute->type);
		$definingExpressionRecord->setAttributeValue($expressionIdAttribute, $definingExpression[0]);
		$definingExpressionRecord->setAttributeValue($definedMeaningDefiningExpressionAttribute, $definingExpression[1]);
		$definingExpressionRecord->setAttributeValue($languageAttribute, $definingExpression[2]);
		return $definingExpressionRecord;

}
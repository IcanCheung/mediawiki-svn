<?php

require_once('Wikidata.php');
require_once('Transaction.php');
require_once('Expression.php');
require_once('forms.php');
require_once('Attribute.php');
require_once('type.php');
require_once('languages.php');
require_once('HTMLtable.php');
require_once('WiktionaryZRecordSets.php');
require_once('WiktionaryZEditors.php');

/**
 * Load and modify content in a WiktionaryZ-enabled
 * namespace.
 *
 * @package MediaWiki
 */
class WiktionaryZ extends DefaultWikidataApplication {
	function view() {
		global
			$wgOut, $wgTitle;

		parent::view();

		$spelling = $wgTitle->getText();
		$wgOut->addHTML(getExpressionsEditor($spelling, false)->view(new IdStack("expression"), getExpressionsRecordSet($spelling, new QueryLatestTransactionInformation())));
		$wgOut->addHTML(DefaultEditor::getExpansionCss());
		$wgOut->addHTML("<script language='javascript'><!--\nexpandEditors();\n--></script>");

		# We may later want to disable the regular page component
		# $wgOut->setPageTitleArray($this->mTitle->getTitleArray());
	}

	function history() {
		global
			$wgOut, $wgTitle;

		parent::history();

		$spelling = $wgTitle->getText();
		$wgOut->addHTML(getExpressionsEditor($spelling, $this->showRecordLifeSpan)->view(new IdStack("expression"), getExpressionsRecordSet($spelling, $this->queryTransactionInformation)));
		$wgOut->addHTML(DefaultEditor::getExpansionCss());
		$wgOut->addHTML("<script language='javascript'><!--\nexpandEditors();\n--></script>");

		$titleArray = $wgTitle->getTitleArray();
		$titleArray["actionprefix"] = wfMsg('wz_history');
		$wgOut->setPageTitleArray($titleArray);
	}

	function saveForm() {
		global
			$wgTitle, $wgUser, $wgRequest;

		$summary = $wgRequest->getText('summary');

		startNewTransaction($wgUser->getID(), wfGetIP(), $summary);

		$spelling = $wgTitle->getText();
		getExpressionsEditor($spelling, false)->save(new IdStack("expression"), getExpressionsRecordSet($spelling, new QueryLatestTransactionInformation()));

		Title::touchArray(array($wgTitle));
		$now = wfTimestampNow();
		RecentChange::notifyEdit($now, $wgTitle, false, $wgUser, $summary,
			0, $now, false, '', 0, 0, 0);
	}

	function edit() {
		global
			$wgOut, $wgTitle, $wgUser, $wgRequest;

		if ($wgRequest->getText('save') != '')
			$this->saveForm();

		parent::edit();

		$spelling = $wgTitle->getText();

		$this->outputEditHeader();
		$wgOut->addHTML(getExpressionsEditor($spelling, false)->edit(new IdStack("expression"), getExpressionsRecordSet($spelling, new QueryLatestTransactionInformation())));
		$this->outputEditFooter();

		$wgOut->addHTML(DefaultEditor::getExpansionCss());
		$wgOut->addHTML("<script language='javascript'><!--\nexpandEditors();\n--></script>");

		$titleArray = $wgTitle->getTitleArray();
		$titleArray["actionprefix"] = wfMsg('editing');
		$wgOut->setPageTitleArray($titleArray);
	}
}

?>

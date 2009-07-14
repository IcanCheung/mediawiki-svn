<?php

if ( !defined( 'MEDIAWIKI' ) )
	die();

$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'Liquid Threads',
	'version'        => '2.0-alpha',
	'url'            => 'http://www.mediawiki.org/wiki/Extension:LiquidThreads',
	'author'         => array( 'David McCabe', 'Andrew Garrett' ),
	'description'    => 'Add threading discussions to talk pages',
	'descriptionmsg' => 'lqt-desc',
);

require( 'LqtFunctions.php' );

define( 'NS_LQT_THREAD', efArrayDefault( 'egLqtNamespaceNumbers', 'Thread', 90 ) );
define( 'NS_LQT_THREAD_TALK', efArrayDefault( 'egLqtNamespaceNumbers', 'Thread_talk', 91 ) );
define( 'NS_LQT_SUMMARY', efArrayDefault( 'egLqtNamespaceNumbers', 'Summary', 92 ) );
define( 'NS_LQT_SUMMARY_TALK', efArrayDefault( 'egLqtNamespaceNumbers', 'Summary_talk', 93 ) );
define( 'LQT_NEWEST_CHANGES', 'nc' );
define( 'LQT_NEWEST_THREADS', 'nt' );
define( 'LQT_OLDEST_THREADS', 'ot' );

// FIXME: would be neat if it was possible to somehow localise this.
$wgCanonicalNamespaceNames[NS_LQT_THREAD]		= 'Thread';
$wgCanonicalNamespaceNames[NS_LQT_THREAD_TALK]	= 'Thread_talk';
$wgCanonicalNamespaceNames[NS_LQT_SUMMARY]		= 'Summary';
$wgCanonicalNamespaceNames[NS_LQT_SUMMARY_TALK]	= 'Summary_talk';

// FIXME: would be neat if it was possible to somehow localise this.
$wgExtraNamespaces[NS_LQT_THREAD]	= 'Thread';
$wgExtraNamespaces[NS_LQT_THREAD_TALK] = 'Thread_talk';
$wgExtraNamespaces[NS_LQT_SUMMARY] = 'Summary';
$wgExtraNamespaces[NS_LQT_SUMMARY_TALK] = 'Summary_talk';

// Localisation
$dir = dirname( __FILE__ ) . '/';
$wgExtensionMessagesFiles['LiquidThreads'] = $dir . 'i18n/Lqt.i18n.php';
$wgExtensionAliasesFiles['LiquidThreads'] = $dir . 'i18n/Lqt.alias.php';

// Parser Function Setup
$wgExtensionFunctions[] = 'lqtSetupParserFunctions';

// Hooks
$wgHooks['SpecialWatchlistQuery'][] = 'efLqtBeforeWatchlistHook';
$wgHooks['MediaWikiPerformAction'][] = 'LqtDispatch::tryPage';
$wgHooks['SpecialMovepageAfterMove'][] = 'LqtDispatch::onPageMove';
$wgHooks['LinkerMakeLinkObj'][] = 'LqtDispatch::makeLinkObj';
$wgHooks['SkinTemplateTabAction'][] = 'LqtDispatch::tabAction';
$wgHooks['OldChangesListRecentChangesLine'][] = 'LqtDispatch::customizeOldChangesList';
$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'LqtDispatch::setNewtalkHTML';
$wgHooks['TitleGetRestrictions'][] = 'Thread::getRestrictionsForTitle';
$wgHooks['GetPreferences'][] = 'lqtGetPreferences';
$wgHooks['ArticleEditUpdateNewTalk'][] = 'lqtUpdateNewtalkOnEdit';
$wgHooks['LanguageGetMagic'][] = 'LiquidThreadsMagicWords::getMagicWords';

// Special pages
#$wgSpecialPages['UndeleteThread'] = 'SpecialUndeleteThread';
$wgSpecialPages['DeleteThread'] = 'SpecialDeleteThread';
$wgSpecialPages['MoveThread'] = 'SpecialMoveThread';
$wgSpecialPages['NewMessages'] = 'SpecialNewMessages';
$wgSpecialPages['SplitThread'] = 'SpecialSplitThread';
$wgSpecialPageGroups['NewMessages'] = 'wiki';

// Classes
$wgAutoloadClasses['LqtDispatch'] = $dir . 'classes/LqtDispatch.php';
$wgAutoloadClasses['LqtView'] = $dir . 'classes/LqtView.php';
$wgAutoloadClasses['ThreadHistoryIterator'] = $dir . 'classes/LqtThreadHistoryIterator.php';
$wgAutoloadClasses['HistoricalThread'] = $dir . 'classes/LqtHistoricalThread.php';
$wgAutoloadClasses['Thread'] = $dir . 'classes/LqtThread.php';
$wgAutoloadClasses['Threads'] = $dir . 'classes/LqtThreads.php';
$wgAutoloadClasses['NewMessages'] = $dir . 'classes/LqtNewMessages.php';
$wgAutoloadClasses['LiquidThreadsMagicWords'] = $dir . 'i18n/LiquidThreads.magic.php';
$wgAutoloadClasses['LqtParserFunctions'] = $dir . 'classes/LqtParserFunctions.php';

// Page classes
$wgAutoloadClasses['TalkpageView'] = $dir . 'pages/TalkpageView.php';
$wgAutoloadClasses['TalkpageArchiveView'] = $dir . 'pages/TalkpageArchiveView.php';
$wgAutoloadClasses['ThreadPermalinkView'] = $dir . 'pages/ThreadPermalinkView.php';
$wgAutoloadClasses['TalkpageHeaderView'] = $dir . 'pages/TalkpageHeaderView.php';
$wgAutoloadClasses['IndividualThreadHistoryView'] = $dir . 'pages/IndividualThreadHistoryView.php';
$wgAutoloadClasses['ThreadDiffView'] = $dir . 'pages/ThreadDiffView.php';
$wgAutoloadClasses['ThreadWatchView'] = $dir . 'pages/ThreadWatchView.php';
$wgAutoloadClasses['ThreadProtectionFormView'] = $dir . 'pages/ThreadProtectionFormView.php';
$wgAutoloadClasses['ThreadHistoryListingView'] = $dir . 'pages/ThreadHistoryListingView.php';
$wgAutoloadClasses['ThreadHistoricalRevisionView'] = $dir . 'pages/ThreadHistoricalRevisionView.php';
$wgAutoloadClasses['SummaryPageView'] = $dir . 'pages/SummaryPageView.php';
$wgAutoloadClasses['NewUserMessagesView'] = $dir . 'pages/NewUserMessagesView.php';

$wgAutoloadClasses['ThreadActionPage'] = "$dir/pages/ThreadActionPage.php";

#$wgAutoloadClasses['SpecialUndeleteThread'] = $dir . "pages/SpecialUndeleteThread.php";
$wgAutoloadClasses['SpecialMoveThread'] = $dir . 'pages/SpecialMoveThread.php';
$wgAutoloadClasses['SpecialDeleteThread'] = $dir . 'pages/SpecialDeleteThread.php';
$wgAutoloadClasses['SpecialNewMessages'] = $dir . 'pages/SpecialNewMessages.php';
$wgAutoloadClasses['SpecialSplitThread'] = "$dir/pages/SpecialSplitThread.php";

// Backwards-compatibility
$wgAutoloadClasses['Article_LQT_Compat'] = $dir . 'compat/LqtCompatArticle.php';
if ( version_compare( $wgVersion, '1.16', '<' ) ) {
	$wgAutoloadClasses['HTMLForm'] = "$dir/compat/HTMLForm.php";
}

// Logging
$wgLogTypes[] = 'liquidthreads';
$wgLogNames['liquidthreads']          = 'lqt-log-name';
$wgLogHeaders['liquidthreads']        = 'lqt-log-header';
$wgLogActionsHandlers['liquidthreads/move'] = 'lqtFormatMoveLogEntry';

// Preferences
$wgDefaultUserOptions['lqtnotifytalk'] = true;

/** CONFIGURATION SECTION */

/* Number of days a thread needs to have existed to be considered for summarizing and archival */
$wgLqtThreadArchiveStartDays = 14;

/* Number of days a thread needs to be inactive to be considered for summarizing and archival */
$wgLqtThreadArchiveInactiveDays = 5;

/* Allows activation of LiquidThreads on individual pages */
$wgLqtPages = array();

/* Allows switching LiquidThreads off for regular talk pages
	(intended for testing and transition) */
$wgLqtTalkPages = true;

/* Whether or not to activate LiquidThreads email notifications */
$wgLqtEnotif = true;

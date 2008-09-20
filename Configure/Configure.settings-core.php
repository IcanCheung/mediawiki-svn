<?php
if ( !defined( 'MEDIAWIKI' ) ) die();
/**
 * @file
 * @ingroup Extensions
 */

/**
 * Array mapping all editable settings to their type depending of their section
 * First two keys will be used to show sections
 * These settings are more or less in the same order as
 * http://www.mediawiki.org/wiki/Manual:Configuration_settings
 */
$settings = array(
	'general' => array(
		'general' => array(
			'wgSitename' => 'text',
			'wgVersion' => 'text',
		),
		'paths' => array(
			'wgActionPaths' => 'array',
			'wgAppleTouchIcon' => 'text',
			'wgArticlePath' => 'text',
			'wgDirectoryMode' => 'int',
			'wgDiff' => 'text',
			'wgDiff3' => 'text',
			'wgFavicon' => 'text',
			'wgLogo' => 'text',
			'wgMathDirectory' => 'text',
			'wgMathPath' => 'text',
			'wgRedirectScript' => 'text',
			'wgPhpCli' => 'text',
			'wgProto' => 'text',
			'wgScript' => 'text',
			'wgScriptExtension' => 'text',
			'wgScriptPath' => 'text',
			'wgServer' => 'text',
			'wgServerName' => 'text',
			'wgSQLiteDataDirMode' => 'int',
			'wgStyleDirectory' => 'text',
			'wgStylePath' => 'text',
			'wgStyleSheetPath' => 'text',
			'wgTmpDirectory' => 'text',
			'wgUploadBaseUrl' => 'text',
			'wgUsePathInfo' => 'bool',
			'wgUploadDirectory' => 'text',
			'wgUploadNavigationUrl' => 'text',
			'wgUploadPath' => 'text',
			'wgVariantArticlePath' => 'text',
		),
	),
	'db' => array(
		'db' => array(
			'wgAllDBsAreLocalhost' => 'bool',
			'wgCheckDBSchema' => 'bool',
			'wgDBAvgStatusPoll' => 'int',
			'wgDBconnection' => 'text',
			'wgDBerrorLog' => 'text',
			'wgDBname' => 'text',
			'wgDBpassword' => 'text',
			'wgDBport' => 'int',
			'wgDBserver' => 'text',
			'wgDBtype' => array( 'mysql' => 'MySQL', 'postgres' => 'PostreSQL' ),
			'wgDBuser' => 'text',
			'wgLegacySchemaConversion' => 'bool',
			'wgLocalDatabases' => 'array',
			'wgSearchType' => 'text',
			'wgSharedDB' => 'text',
			'wgSharedPrefix' => 'text',
			'wgSharedTables'  => 'array',
		),
		'load-balancing' => array(
			'wgAlternateMaster' => 'array',
			'wgDBClusterTimeout' => 'int',
			'wgDBservers' => 'array',
			'wgDefaultExternalStore' => 'array',
			'wgExternalServers' => 'array',
			'wgLBFactoryConf' => 'array',
			'wgMasterWaitTimeout' => 'int',
			'wgSlaveLagCritical' => 'int',
			'wgSlaveLagWarning' => 'int',
		),
		'mysql' => array(
			'wgDBmysql4' => 'bool',
			'wgDBmysql5' => 'bool',
			'wgDBprefix' => 'text',
			'wgDBTableOptions' => 'text',
			'wgDBtransactions' => 'bool',
		),
		'postgres' => array(
			'wgDBmwschema' => 'text',
			'wgDBts2schema' => 'text',
		),
		'sqlite' => array(
			'wgSQLiteDataDir' => 'text',
		),
	),
	'email' => array(
		'email' => array(
			'wgEmailAuthentication' => 'bool',
			'wgEmergencyContact' => 'text',
			'wgEnableEmail' => 'bool',
			'wgEnableUserEmail' => 'bool',
			'wgNoReplyAddress' => 'text',
			'wgPasswordSender' => 'text',
			'wgPasswordReminderResendTime' => 'int',
			'wgSMTP' => 'array',
			'wgUserEmailUseReplyTo' => 'bool',
		),
		'enotif' => array(
			'wgEnotifFromEditor' => 'bool',
			'wgEnotifImpersonal' => 'bool',
			'wgEnotifMaxRecips' => 'int',
			'wgEnotifMinorEdits' => 'bool',
			'wgEnotifRevealEditorAddress' => 'bool',
			'wgEnotifUseJobQ' => 'bool',
			'wgEnotifUserTalk' => 'bool',
			'wgEnotifWatchlist' => 'bool',
			'wgUsersNotifedOnAllChanges' => 'array',
			'wgUsersNotifiedOnAllChanges' => 'array',
		),
	),
	'localization' => array(
		'localization' => array(
			'wgAmericanDates' => 'bool',
			'wgDisableLangConversion' => 'bool',
			'wgDisableTitleConversion' => 'bool',
			'wgEditEncoding' => 'text',
			'wgForceUIMsgAsContentMsg' => 'array',
			'wgInputEncoding' => 'text',
			'wgInterwikiMagic' => 'bool',
			'wgLanguageCode' => 'lang',
			'wgLegacyEncoding' => 'text',
			'wgLoginLanguageSelector' => 'bool',
			'wgOutputEncoding' => 'text',
			'wgTranslateNumerals' => 'bool',
			'wgUseDatabaseMessages' => 'bool',
			'wgUseDynamicDates' => 'bool',
		),
		'timezone' => array(
			'wgLocaltimezone' => 'text',
			'wgLocalTZoffset' => 'int',
		),
		'zh-conversion' => array(
			'wgUseZhdaemon' => 'bool',
			'wgZhdaemonHost' => 'text',
			'wgZhdaemonPort' => 'int',
		),
		'html' => array(
			'wgXMLMimeTypes' => 'array',
			'wgDocType' => 'text',
			'wgDTD' => 'text',
			'wgMimeType' => 'text',
			'wgXhtmlDefaultNamespace' => 'text',
			'wgXhtmlNamespaces' => 'array',
		),
	),
	'debug' => array(
		'debug' => array(
			'wgColorErrors' => 'bool',
			'wgDebugComments' => 'bool',
			'wgDebugDumpSql' => 'bool',
			'wgDebugLogFile' => 'text',
			'wgDebugLogGroups' => 'array',
			'wgDebugRawPage' => 'bool',
			'wgDebugRedirects' => 'bool',
			'wgLogQueries' => 'bool',
			'wgShowExceptionDetails' => 'bool',
			'wgShowSQLErrors' => 'bool',
			'wgStatsMethod' => array( 'cache' => 'Cache', 'udp' => 'UDP', 0 => 'None' ),
		),
		'profiling' => array(
			'wgDebugFunctionEntry' => 'bool',
			'wgDebugProfiling' => 'bool',
			'wgDebugSquid' => 'bool',
			'wgProfileCallTree' => 'bool',
			'wgProfileLimit' => 'int',
			'wgProfileOnly' => 'bool',
			'wgProfilePerHost' => 'bool',
			'wgProfileSampleRate' => 'int',
			'wgProfileToDatabase' => 'bool',
			'wgProfilerType' => 'text',
			'wgProfiling' => 'bool',
			'wgUDPProfilerHost' => 'text',
			'wgUDPProfilerPort' => 'int',
		),
	),
	'site' => array(
		'site' => array(
			'wgArticleRobotPolicies' => 'array',
			'wgBreakFrames' => 'bool',
			'wgCapitalLinks' => 'bool',
			'wgDefaultLanguageVariant' => 'text',
			'wgDefaultRobotPolicy' => 'text',
			'wgExemptFromUserRobotsControl' => 'array',
			'wgExtraLanguageNames' => 'array',
			'wgExtraRandompageSQL' => 'text',
			'wgExtraSubtitle' => 'text',
			'wgHideInterlanguageLinks' => 'bool',
			'wgLegalTitleChars' => 'text',
			'wgMaxArticleSize' => 'int',
			'wgMetadataWhitelist' => 'text',
			'wgNoFollowLinks' => 'bool',
			'wgPageShowWatchingUsers' => 'bool',
			'wgRestrictionLevels' => 'array',
			'wgSiteNotice' => 'text',
			'wgSiteSupportPage' => 'text',
			'wgStyleVersion' => 'int',
			'wgUrlProtocols' => 'array',
			'wgUseExternalEditor' => 'bool',
			'wgUseMetadataEdit' => 'bool',
		),
		'ajax' => array(
			'wgUseAjax' => 'bool',
			'wgAjaxExportList' => 'array',
			'wgAjaxSearch' => 'bool',
			'wgAjaxUploadDestCheck' => 'bool',
			'wgAjaxWatch' => 'bool',
			'wgLivePreview' => 'bool',
		),
		'css-js' => array(
			'wgAllowUserCss' => 'bool',
			'wgAllowUserJs' => 'bool',
			'wgUseSiteCss' => 'bool',
			'wgUseSiteJs' => 'bool',
			'wgHandheldStyle' => 'text',
			'wgHandheldForIPhone' => 'bool',
		),
	),
	'namespaces' => array(
		'namespaces' => array(
			'wgContentNamespaces' => 'array',
			'wgExtraNamespaces' => 'array',
			'wgMetaNamespace' => 'text',
			'wgMetaNamespaceTalk' => 'text',
			'wgNamespaceAliases' => 'array',
			'wgNamespaceProtection' => 'array',
			'wgNamespaceRobotPolicies' => 'array',
			'wgNamespacesToBeSearchedDefault' => 'array',
			'wgNamespacesWithSubpages' => 'array',
			'wgNoFollowNsExceptions' => 'array',
			'wgNonincludableNamespaces' => 'array',
			'wgSitemapNamespaces' => 'array',
		),
	),
	'stats' => array(
		'stats' => array(
			'wgCountCategorizedImagesAsUsed' => 'bool',
			'wgDisableCounters' => 'bool',
			'wgHitcounterUpdateFreq' => 'int',
			'wgUseCommaCount' => 'bool',
			'wgWantedPagesThreshold' => 'int',
		),
	),
	'skin' => array(
		'skin' => array(
			'wgDefaultSkin' => 'text',
			'wgSkipSkin' => 'text',
			'wgSkipSkins' => 'array',
			'wgValidSkinNames' => 'array',
		),
	),
	'category' => array(
		'category' => array(
			'wgCategoryMagicGallery' => 'bool',
			'wgCategoryPagingLimit' => 'int',
			'wgCategoryPrefixedDefaultSortkey' => 'bool',
			'wgUseCategoryBrowser' => 'bool',
		),
	),
	'cache' => array(
		'cache' => array(
			'wgMainCacheType' => array( -1 => 'Anything', 0 => 'None',
	                            1 => 'DB', 2 => 'Memcached',
	                            3 => 'Accel', 4 => 'DBA' ),
	        'wgCacheEpoch' => 'text',
			'wgCachePages' => 'bool',
			'wgClockSkewFudge' => 'int',
			'wgFileCacheDirectory' => 'text',
			'wgForcedRawSMaxage' => 'int',
			'wgQueryCacheLimit' => 'int',
			'wgRevisionCacheExpiry' => 'int',
			'wgThumbnailEpoch' => 'text',
			'wgTranscludeCacheExpiry' => 'int',
			'wgUseFileCache' => 'bool',
			'wgUseGzip' => 'bool',
			'wgUseWatchlistCache' => 'bool',
			'wgWLCacheTimeout' => 'int',
		),
		'pcache' => array(
			'wgParserCacheType' => array( -1 => 'Anything', 0 => 'None',
			                              1 => 'DB', 2 => 'Memcached',
			                              3 => 'Accel', 4 => 'DBA' ),
			'wgEnableParserCache' => 'bool',
			'wgEnableSidebarCache' => 'bool',
			'wgRenderHashAppend' => 'text',
			'wgSidebarCacheExpiry' => 'int',
			'wgUseETag' => 'bool',
		),
		'messagecache' => array(
			'wgMessageCacheType' => array( -1 => 'Anything', 0 => 'None',
			                               1 => 'DB', 2 => 'Memcached',
			                               3 => 'Accel', 4 => 'DBA' ),
			'wgLocalMessageCache' => 'text',
			'wgMsgCacheExpiry' => 'int',
			'wgCachedMessageArrays' => 'text',
			'wgCheckSerialized' => 'bool',
			'wgLocalMessageCacheSerialized' => 'bool',
			'wgMaxMsgCacheEntrySize' => 'int',
		),
		'memcached' => array(
			'wgLinkCacheMemcached' => 'bool',
			'wgMemCachedDebug' => 'bool',
			'wgMemCachedPersistent' => 'bool',
			'wgMemCachedServers' => 'array',
			'wgSessionsInMemcached' => 'bool',
			'wgUseMemCached' => 'bool',
		),
	),
	'interwiki' => array(
		'interwiki' => array(
			'wgDisableHardRedirects' => 'bool',
			'wgEnableScaryTranscluding' => 'bool',
			'wgImportSources' => 'array',
			'wgInterwikiCache' => 'text',
			'wgInterwikiExpiry' => 'int',
			'wgInterwikiFallbackSite' => 'text',
			'wgInterwikiScopes' => 'int',
			'wgLocalInterwiki' => 'text',
			'wgRedirectSources' => 'array',
		),
	),
	'access' => array(
		'access' => array(
			'wgAutopromote' => 'array',
			'wgAccountCreationThrottle' => 'int',
			'wgAllowPageInfo' => 'bool',
			'wgAutoblockExpiry' => 'int',
			'wgDeleteRevisionsLimit' => 'int',
			'wgDisabledActions' => 'array',
			'wgEmailConfirmToEdit' => 'bool',
			'wgEnableCascadingProtection' => 'bool',
			'wgEnableAPI' => 'bool',
			'wgEnableWriteAPI' => 'bool',
			'wgFilterCallback' => 'text',
			'wgImplicitGroups' => 'array',
			'wgPasswordAttemptThrottle' => 'array',
			'wgPasswordSalt' => 'bool',
			'wgReadOnly' => 'text',
			'wgReadOnlyFile' => 'text',
			'wgRestrictionTypes' => 'array',
			'wgSpamRegex' => 'text',
			'wgWhitelistRead' => 'array',
		),
		'block' => array(
			'wgBlockAllowsUTEdit' => 'bool',
			'wgSysopEmailBans' => 'bool',
			'wgSysopRangeBans' => 'bool',
			'wgSysopUserBans' => 'bool',
		),
	),
	'groups' => array(
		'groups' => array(
			'wgGroupPermissions' => 'array',
			'wgAddGroups' => 'array',
			'wgRemoveGroups' => 'array',
			'wgGroupsAddToSelf' => 'array',
			'wgGroupsRemoveFromSelf' => 'array',
		),
	),
	'rates' => array(
		'rates' => array(
			'wgRateLimitLog' => 'text',
			'wgRateLimits' => 'array',
			'wgRateLimitsExcludedGroups' => 'array',
		),
	),
	'proxy' => array(
		'proxy' => array(
			'wgBlockOpenProxies' => 'bool',
			'wgEnableSorbs' => 'bool',
			'wgProxyKey' => 'text',
			'wgProxyList' => 'array',
			'wgProxyMemcExpiry' => 'int',
			'wgProxyPorts' => 'array',
			'wgProxyScriptPath' => 'text',
			'wgProxyWhitelist' => 'array',
			'wgSecretKey' => 'text',
			'wgSorbsUrl' => 'text',
		),
	),
	'squid' => array(
		'squid' => array(
			'wgInternalServer' => 'text',
			'wgMaxSquidPurgeTitles' => 'int',
			'wgSquidMaxage' => 'int',
			'wgSquidServers' => 'array',
			'wgSquidServersNoPurge' => 'array',
			'wgUseESI' => 'bool',
			'wgUseSquid' => 'bool',
		),
	),
	'cookie' => array(
		'cookie' => array(
			'wgCacheVaryCookies' => 'array',
			'wgCookieDomain' => 'text',
			'wgCookieExpiration' => 'int',
			'wgCookieHttpOnly' => 'bool',
			'wgCookiePath' => 'text',
			'wgCookiePrefix' => 'text',
			'wgCookieSecure' => 'bool',
			'wgDisableCookieCheck' => 'bool',
			'wgHttpOnlyBlacklist' => 'array',
			'wgSessionName' => 'text',
		),
	),
	'reduction' => array(
		'reduction' => array(
			'wgDisableQueryPages' => 'bool',
			'wgDisableQueryPageUpdate' => 'array',
			'wgDisableSearchContext' => 'bool',
			'wgDisableSearchUpdate' => 'bool',
			'wgDisableTextSearch' => 'bool',
			'wgAPIMaxDBRows' => 'int',
			'wgMaximumMovedPages' => 'int',
			'wgMiserMode' => 'bool',
			'wgShowHostnames' => 'bool',
			'wgUseDumbLinkUpdate' => 'bool',
		),
	),
	'upload' => array(
		'upload' => array(
			'wgAjaxLicensePreview' => 'bool',
			'wgAllowCopyUploads' => 'bool',
			'wgCheckFileExtensions' => 'bool',
			'wgEnableUploads' => 'bool',
			'wgFileBlacklist' => 'array',
			'wgFileExtensions' => 'array',
			'wgFileStore' => 'array',
			'wgHashedUploadDirectory' => 'bool',
			'wgLocalFileRepo' => 'array',
			'wgRemoteUploads' => 'bool',
			'wgStrictFileExtensions' => 'bool',
			'wgUploadSizeWarning' => 'int',
			'wgMaxUploadSize' => 'int',
			'wgHTTPTimeout' => 'int',
			'wgHTTPProxy' => 'text',
			'wgSaveDeletedFiles' => 'bool',
		),
		'sharedupload' => array(
			'wgCacheSharedUploads' => 'bool',
			'wgForeignFileRepos' => 'array',
			'wgFetchCommonsDescriptions' => 'bool',
			'wgHashedSharedUploadDirectory' => 'bool',
			'wgRepositoryBaseUrl' => 'text',
			'wgSharedThumbnailScriptPath' => 'text',
			'wgSharedUploadDBname' => 'text',
			'wgSharedUploadDBprefix' => 'text',
			'wgSharedUploadDirectory' => 'text',
			'wgSharedUploadPath' => 'text',
			'wgUseSharedUploads' => 'bool',
		),
		'mime' => array(
			'wgJsMimeType' => 'text',
			'wgLoadFileinfoExtension' => 'bool',
			'wgMimeDetectorCommand' => 'text',
			'wgMimeInfoFile' => 'text',
			'wgMimeTypeFile' => 'text',
			'wgTrivialMimeDetection' => 'bool',
			'wgVerifyMimeType' => 'bool',
			'wgMimeTypeBlacklist' => 'array',
		),
	),
	'images' => array(
		'images' => array(
			'wgAllowImageMoving' => 'bool',
			'wgCustomConvertCommand' => 'text',
			'wgFileRedirects' => 'bool',
			'wgGenerateThumbnailOnParse' => 'bool',
			'wgIgnoreImageErrors' => 'bool',
			'wgImageLimits' => 'array',
			'wgMaxImageArea' => 'int',
			'wgMediaHandlers' => 'array',
			'wgThumbnailScriptPath' => 'text',
			'wgThumbUpright' => 'text',
			'wgShowEXIF' => 'bool',
			'wgUseImageResize' => 'bool',
			'wgThumbLimits' => 'array',
			'wgTrustedMediaFormats' => 'array',
		),
		'djvu' => array(
			'wgDjvuDump' => 'text',
			'wgDjvuOutputExtension' => 'text',
			'wgDjvuPostProcessor' => 'text',
			'wgDjvuRenderer' => 'text',
			'wgDjvuToXML' => 'text',
		),
		'imagemagick' => array(
			'wgImageMagickConvertCommand' => 'text',
			'wgSharpenParameter' => 'int',
			'wgSharpenReductionThreshold' => 'text',
			'wgUseImageMagick' => 'bool',
		),
		'svg' => array(
			'wgAllowTitlesInSVG' => 'bool',
			'wgSVGConverter' => 'text',
			'wgSVGConverterPath' => 'text',
			'wgSVGConverters' => 'array',
			'wgSVGMaxSize' => 'int',
		),
		'antivirus' => array(
			'wgAntivirus' => 'text',
			'wgAntivirusRequired' => 'bool',
			'wgAntivirusSetup' => 'array',
		),
	),
	'parser' => array(
		'parser' => array(
			'wgAllowDisplayTitle' => 'bool',
			'wgAllowExternalImages' => 'bool',
			'wgAllowExternalImagesFrom' => 'text',
			'wgEnableImageWhitelist' => 'bool',
			'wgExpensiveParserFunctionLimit' => 'int',
			'wgCleanSignatures' => 'bool',
			'wgGrammarForms' => 'array',
			'wgLinkHolderBatchSize' => 'int',
			'wgMaxPPExpandDepth' => 'int',
			'wgMaxPPNodeCount' => 'int',
			'wgMaxTemplateDepth' => 'int',
			'wgMaxTocLevel' => 'int',
			'wgParserConf' => 'array',
			'wgParserCacheExpireTime' => 'int',
			'wgParserTestFiles' => 'array',
			'wgRestrictDisplayTitle' => 'bool',
			'wgUseXMLparser' => 'bool',
		),
		'html' => array(
			'wgRawHtml' => 'bool',
			'wgUserHtml' => 'bool',
		),
		'tex' => array(
			'wgTexvc' => 'text',
			'wgUseTeX' => 'bool',
		),
		'tidy' => array(
			'wgAlwaysUseTidy' => 'bool',
			'wgDebugTidy' => 'bool',
			'wgTidyBin' => 'text',
			'wgTidyConf' => 'text',
			'wgTidyInternal' => 'bool',
			'wgTidyOpts' => 'text',
			'wgUseTidy' => 'bool',
			'wgValidateAllHtml' => 'bool',
		),
	),
	'specialpages' => array(
		'specialpages' => array(
			'wgAllowSpecialInclusion' => 'bool',
			'wgExportAllowHistory' => 'bool',
			'wgExportAllowListContributors' => 'bool',
			'wgExportMaxHistory' => 'int',
			'wgImportTargetNamespace' => 'text',
			'wgLogActions' => 'array',
			'wgLogActionsHandlers' => 'array',
			'wgLogHeaders' => 'array',
			'wgLogNames' => 'array',
			'wgLogRestrictions' => 'array',
			'wgLogTypes' => 'array',
			'wgMaxRedirectLinksRetrieved' => 'int',
			'wgSortSpecialPages' => 'bool',
			'wgSpecialPageGroups' => 'array',
			'wgSpecialVersionShowHooks' => 'bool',
			'wgUseNPPatrol' => 'bool',
		),
		'recentchanges' => array(
			'wgAllowCategorizedRecentChanges' => 'bool',
			'wgPutIPinRC' => 'bool',
			'wgRCChangedSizeThreshold' => 'int',
			'wgRCFilterByAge' => 'bool',
			'wgRCLinkLimits' => 'array',
			'wgRCLinkDays' => 'array',
			'wgRCMaxAge' => 'int',
			'wgRCShowChangedSize' => 'bool',
			'wgRCShowWatchingUsers' => 'bool',
			'wgShowUpdatedMarker' => 'bool',
			'wgUseRCPatrol' => 'bool',
			'wgRC2UDPAddress' => 'text',
			'wgRC2UDPOmitBots' => 'bool',
			'wgRC2UDPPort' => 'int',
			'wgRC2UDPPrefix' => 'text',
		),
	),
	'users' => array(
		'users' => array(
			'wgActiveUserDays' => 'int',
			'wgActiveUserEditCount' => 'int',
			'wgAutoConfirmAge' => 'int',
			'wgAutoConfirmCount' => 'int',
			'wgAllowRealName' => 'bool',
			'wgDefaultUserOptions' => 'array',
			'wgDisableAnonTalk' => 'bool',
			'wgMaxNameChars' => 'int',
			'wgMaxSigChars' => 'int',
			'wgMinimalPasswordLength' => 'int',
			'wgNewUserLog' => 'bool',
			'wgReservedUsernames' => 'array',
			'wgShowIPinHeader' => 'bool',
			'wgBrowserBlackList' => 'array',
		),
	),
	'feed' => array(
		'feed' => array(
			'wgFeed' => 'bool',
			'wgFeedCacheTimeout' => 'int',
			'wgFeedDiffCutoff' => 'int',
			'wgFeedLimit' => 'int',
			'wgOverrideSiteFeed' => 'array',
		),
	),
	'copyright' => array(
		'copyright' => array(
			'wgCheckCopyrightUpload' => 'bool',
			'wgCopyrightIcon' => 'text',
			'wgEnableCreativeCommonsRdf' => 'bool',
			'wgEnableDublinCoreRdf' => 'bool',
			'wgMaxCredits' => 'int',
			'wgRightsIcon' => 'text',
			'wgRightsPage' => 'text',
			'wgRightsText' => 'text',
			'wgRightsUrl' => 'bool',
			'wgShowCreditsIfMax' => 'bool',
			'wgUseCopyrightUpload' => 'bool',
		),
	),
	'job' => array(
		'job' => array(
			'wgJobRunRate' => 'int',
			'wgJobClasses' => 'array',
			'wgUpdateRowsPerJob' => 'int',
		),
	),
	'extension' => array(
		'extension' => array(
			'wgAllowSlowParserFunctions' => 'bool',
			'wgAPIListModules' => 'array',
			'wgAPIMetaModules' => 'array',
			'wgAPIModules' => 'array',
			'wgAPIPropModules' => 'array',
			'wgAutoloadClasses' => 'array',
			'wgAvailableRights' => 'array',
			'wgDisableInternalSearch' => 'bool',
			'wgExceptionHooks' => 'array',
			'wgExtensionAliasesFiles' => 'array',
			'wgExtensionCredits' => 'array',
			'wgExtensionFunctions' => 'array',
			'wgExtensionMessagesFiles' => 'array',
			'wgExternalStores' => 'array',
			'wgHooks' => 'array',
			'wgPagePropLinkInvalidations' => 'array',
			'wgParserOutputHooks' => 'array',
			'wgSpecialPageCacheUpdates' => 'array',
			'wgSpecialPages' => 'array',
			'wgSkinExtensionFunctions' => 'array',
		),
	),
	'search' => array(
		'search' => array(
			'wgAdvancedSearchHighlighting' => 'bool',
			'wgEnableMWSuggest' => 'bool',
			'wgGoToEdit' => 'bool',
			'wgMWSuggestTemplate' => 'text',
			'wgOpenSearchTemplate' => 'text',
			'wgSearchForwardUrl' => 'text',
			'wgSearchHighlightBoundaries' => 'text',
		),
	),
	'htcp' => array(
		'htcp' => array(
			'wgHTCPMulticastAddress' => 'text',
			'wgHTCPMulticastTTL' => 'int',
			'wgHTCPPort' => 'int',
		),
	),
	'misc' => array(
		'misc' => array(
			'wgAntiLockFlags' => 'int',
			'wgCommandLineMode' => 'bool',
			'wgCommandLineDarkBg' => 'bool',
			'wgCompressRevisions' => 'bool',
			'wgDisableOutputCompression' => 'bool',
			'wgEnableHtmlDiff' => 'bool',
			'wgExternalDiffEngine' => 'text',
			'wgMaxShellFileSize' => 'int',
			'wgMaxShellMemory' => 'int',
			'wgUpdateRowsPerQuery' => 'int',
			'wgUseAutomaticEditSummaries' => 'bool',
			'wgUseTrackbacks' => 'bool',
		),
	),
);

/**
 * As there can be a lot of array types, try to define their type
 *
 * Types used:
 * - simple: single dimension array with numeric key
 * - assoc:  single dimension array with associative key => val
 * - ns-bool:   single dimension array with namespaces numbers in the key and a
 *              boolean value
 * - ns-text:   same as ns-bool but with a string in the value
 * - ns-simple: like simple, but values are restricted to namespaces index
 * - group-bool: two dimensions array with group name in first key, right name
 *               in the second and boolean value
 * - group-array: two dimensions array with group name in first key and then
 *                a 'simple' array
 * - array: other types of arrays not currenty supported
 */
$arrayDefs = array(
	'wgActionPaths' => 'assoc',
# Db
	'wgAlternateMaster' => 'assoc',
	'wgDBservers' => 'array',
	'wgDefaultExternalStore' => 'simple',
	'wgLocalDatabases' => 'simple',
	'wgLBFactoryConf' => 'array',
	'wgExternalServers' => 'array',
	'wgSharedTables'  => 'simple',
# Email
	'wgSMTP' => 'assoc',
	'wgUsersNotifedOnAllChanges' => 'simple',
	'wgUsersNotifiedOnAllChanges' => 'simple',
# Localization
	'wgForceUIMsgAsContentMsg' => 'simple',
	'wgXMLMimeTypes' => 'assoc',
	'wgXhtmlNamespaces' => 'assoc',
	'wgDebugLogGroups' => 'assoc',
# Site custom
	'wgAjaxExportList' => 'simple',
	'wgDefaultUserOptions' => 'assoc',
	'wgExtraLanguageNames' => 'assoc',
	'wgRestrictionLevels' => 'simple',
	'wgUrlProtocols' => 'simple',
	'wgContentNamespaces' => 'ns-simple',
	'wgExemptFromUserRobotsControl' => 'ns-simple',
	'wgExtraNamespaces' => 'assoc',
	'wgNamespaceAliases' => 'assoc',
	'wgNamespaceProtection' => 'ns-array',
	'wgNamespaceRobotPolicies' => 'ns-text',
	'wgNamespacesToBeSearchedDefault' => 'ns-bool',
	'wgNamespacesWithSubpages' => 'ns-bool',
	'wgNoFollowNsExceptions' => 'ns-text',
	'wgNonincludableNamespaces' => 'ns-simple',
	'wgSitemapNamespaces' => 'ns-simple',
	'wgArticleRobotPolicies' => 'assoc',
# Skins
	'wgSkipSkins' => 'simple',
	'wgValidSkinNames' => 'assoc',
# Cache
	'wgMemCachedServers' => 'simple',
# Interwiki
	'wgImportSources' => 'simple',
# Access
	'wgAutopromote' => 'array',
	'wgAddGroups' => 'group-array',
	'wgDisabledActions' => 'simple',
	'wgGroupPermissions' => 'group-bool',
	'wgGroupsAddToSelf' => 'group-array',
	'wgGroupsRemoveFromSelf' => 'group-array',
	'wgImplicitGroups' => 'simple',
	'wgPasswordAttemptThrottle' => 'simple',
	'wgRemoveGroups' => 'group-array',
	'wgWhitelistRead' => 'simple',
# Rate limits
	'wgRateLimits' => 'array',
	'wgRateLimitsExcludedGroups' => 'simple',
# Proxies
	'wgProxyList' => 'simple',
	'wgProxyPorts' => 'simple',
	'wgProxyWhitelist' => 'simple',
# Squid
	'wgSquidServers' => 'simple',
	'wgSquidServersNoPurge' => 'simple',
# Cookie
	'wgCacheVaryCookies' => 'simple',
	'wgHttpOnlyBlacklist' => 'simple',
# Reduction
	'wgDisableQueryPageUpdate' => 'simple',
# Uploads
	'wgFileBlacklist' => 'simple',
	'wgFileExtensions' => 'simple',
	'wgFileStore' => 'array',
	'wgLocalFileRepo' => 'assoc',
	'wgForeignFileRepos' => 'array',
	'wgMimeTypeBlacklist' => 'simple',
# Images
	'wgImageLimits' => 'simple-dual',
	'wgMediaHandlers' => 'assoc',
	'wgSVGConverters' => 'assoc',
	'wgThumbLimits' => 'simple',
	'wgTrustedMediaFormats' => 'simple',
	'wgAntivirusSetup' => 'array',
# Parser
	'wgParserConf' => 'assoc',
	'wgParserTestFiles' => 'simple',
# Users
	'wgReservedUsernames' => 'simple',
	'wgBrowserBlackList' => 'simple',
# Feed
	'wgOverrideSiteFeed' => 'assoc',
# Special pages
	'wgLogActions' => 'assoc',
	'wgLogActionsHandlers' => 'assoc',
	'wgLogHeaders' => 'assoc',
	'wgLogNames' => 'assoc',
	'wgLogRestrictions' => 'assoc',
	'wgLogTypes' => 'simple',
	'wgSpecialPageGroups' => 'assoc',
	'wgRCLinkLimits' => 'simple',
	'wgRCLinkDays' => 'simple',
# Extensions
	'wgAPIListModules' => 'assoc',
	'wgAPIMetaModules' => 'assoc',
	'wgAPIModules' => 'assoc',
	'wgAPIPropModules' => 'assoc',
	'wgAvailableRights' => 'simple',
	'wgExceptionHooks' => 'array',
	'wgExtensionAliasesFiles' => 'array',
	'wgExtensionCredits' => 'array',
	'wgExtensionFunctions' => 'simple',
	'wgExtensionMessagesFiles' => 'assoc',
	'wgExternalStores' => 'simple',
	'wgSpecialPageCacheUpdates' => 'array',
	'wgSpecialPages' => 'assoc',
# Misc
	'wgGrammarForms' => 'array',
	'wgRedirectSources' => 'simple',
	'wgRestrictionTypes' => 'simple',
);

/**
 * Value to be used when setting matches empty()
 */
$emptyValues = array(
	'wgSharedDB' => null,
	'wgLocalMessageCache' => null,
	'wgExternalDiffEngine' => false,
);

/**
 * Settings that can be modified only by users with 'configure-all' right
 */
$editRestricted = array(
# General
	'wgActionPaths',
	'wgAppleTouchIcon',
	'wgArticlePath',
	'wgDirectoryMode',
	'wgDiff',
	'wgDiff3',
	'wgFavicon',
	'wgLogo',
	'wgMathDirectory',
	'wgMathPath',
	'wgProto',
	'wgRedirectScript',
	'wgScript',
	'wgScriptExtension',
	'wgScriptPath',
	'wgServer',
	'wgServerName',
	'wgStyleDirectory',
	'wgStylePath',
	'wgStyleSheetPath',
	'wgTmpDirectory',
	'wgUsePathInfo',
	'wgUploadBaseUrl',
	'wgUploadDirectory',
	'wgUploadNavigationUrl',
	'wgUploadPath',
	'wgVariantArticlePath',
# Db
	'wgAllDBsAreLocalhost',
	'wgAlternateMaster',
	'wgCheckDBSchema',
	'wgDBAvgStatusPoll',
	'wgDBClusterTimeout',
	'wgDBerrorLog',
	'wgDBmwschema',
	'wgDBmysql5',
	'wgDBname',
	'wgDBpassword',
	'wgDBport',
	'wgDBprefix',
	'wgDBserver',
	'wgDBservers',
	'wgDBTableOptions',
	'wgDBtransactions',
	'wgDBts2schema',
	'wgDBtype',
	'wgDBuser',
	'wgDefaultExternalStore',
	'wgLBFactoryConf',
	'wgLegacySchemaConversion',
	'wgLocalDatabases',
	'wgMasterWaitTimeout',
	'wgSearchType',
	'wgSharedDB',
	'wgSharedPrefix',
	'wgSharedTables',
	'wgSlaveLagCritical',
	'wgSlaveLagWarning',
	'wgSQLiteDataDir',
	'wgExternalServers',
# Emal
	'wgSMTP',
# Debug
	'wgDebugLogFile',
	'wgDebugLogGroups',
	'wgUDPProfilerHost',
	'wgUDPProfilerPort',
# Cache
	'wgFileCacheDirectory',
	'wgLocalMessageCache',
	'wgMemCachedServers',
# Access
	'wgAddGroups',
	'wgGroupPermissions',
	'wgGroupsAddToSelf',
	'wgGroupsRemoveFromSelf',
	'wgRemoveGroups',
	'wgReadOnlyFile',
# Rate limits
	'wgRateLimitLog',
# Proxies
	'wgProxyKey',
	'wgProxyScriptPath',
	'wgSecretKey',
# Squid
	'wgInternalServer',
	'wgSquidServers',
	'wgSquidServersNoPurge',
# Img
	'wgFileStore',
	'wgHTTPProxy',
	'wgLocalFileRepo',
	'wgThumbnailScriptPath',
# Parser
	'wgTidyBin',
	'wgTidyConf',
# Special pages
	'wgRC2UDPAddress',
	'wgRC2UDPPort',
# Extensions
	'wgDisableInternalSearch',
	'wgExternalStores',
# htcp
	'wgHTCPMulticastAddress',
	'wgHTCPPort',
# Misc
	'wgMWSuggestTemplate',
	'wgOpenSearchTemplate',
);

/**
 * Settings that can be viewed only by users with 'viewconfig-all' right
 * because they can contain passwords
 */
$viewRestricted = array(
# Db
	'wgDBpassword',
	'wgDBservers',
	'wgLBFactoryConf',
	'wgExternalServers',
# Emal
	'wgSMTP',
# Proxy
	'wgProxyKey',
	'wgSecretKey',
);

/**
 * Array of settings that doesn't have to be modified, because they should only
 * be set by extensions, ...
 */
$notEditableSettings = array(
	'wgAPIListModules',
	'wgAPIMetaModules',
	'wgAPIModules',
	'wgAPIPropModules',
	'wgAjaxExportList',
	'wgAuth',
	'wgAutoloadClasses',
	'wgAvailableRights',
	'wgCommandLineMode',
	'wgConf',
	'wgDBconnection', // Too old
	'wgDBmysql4', // Too old
	'wgEditEncoding', // Too old
	'wgExceptionHooks',
	'wgExtensionAliasesFiles',
	'wgExtensionCredits',
	'wgExtensionFunctions',
	'wgExtensionMessagesFiles',
	'wgFilterCallback',
	'wgHooks',
	'wgInputEncoding', // Too old
	'wgJobClasses',
	'wgLogActions',
	'wgLogActionsHandlers',
	'wgLogHeaders',
	'wgLogNames',
	'wgLogTypes',
	'wgOutputEncoding', // Too old
	'wgPagePropLinkInvalidations',
	'wgParserOutputHooks',
	'wgParserTestFiles',
	'wgSkinExtensionFunctions',
	'wgSpecialPageCacheUpdates',
	'wgSpecialPages',
	'wgStyleSheetPath',
	'wgStyleVersion',
	'wgTrivialMimeDetection',
	'wgUseMemCached', // Too old
	'wgVersion',
);

/**
 * Array of settings depending of the Core version
 */
$settingsVersion = array(
# 1.8.0
	'wgAllowCopyUploads' => array( array( '1.8alpha', '>=' ) ),
	'wgDBmwschema' => array( array( '1.8alpha', '>=' ) ),
	'wgDBts2schema' => array( array( '1.8alpha', '>=' ) ),
	'wgDjvuPostProcessor' => array( array( '1.8alpha', '>=' ) ),
	'wgDjvuRenderer' => array( array( '1.8alpha', '>=' ) ),
	'wgDjvuToXML' => array( array( '1.8alpha', '>=' ) ),
	'wgMaxShellFileSize' => array( array( '1.8alpha', '>=' ) ),
	'wgMaxUploadSize' => array( array( '1.8alpha', '>=' ) ),
	'wgRevisionCacheExpiry' => array( array( '1.8alpha', '>=' ) ),
	'wgUseETag' => array( array( '1.8alpha', '>=' ) ),
# 1.8.1
	'wgEnableAPI' => array( array( '1.8.1', '>=' ) ),
	'wgEnableWriteAPI' => array( array( '1.8.1', '>=' ) ),
	'wgShowExceptionDetails' => array( array( '1.8.1', '>=' ) ),
# 1.9
	'wgAjaxWatch' => array( array( '1.9alpha', '>=' ) ),
	'wgBreakFrames' => array( array( '1.9alpha', '>=' ) ),
	'wgDefaultLanguageVariant' => array( array( '1.9alpha', '>=' ) ),
	'wgDisableQueryPageUpdate' => array( array( '1.9alpha', '>=' ) ),
	'wgMaxMsgCacheEntrySize' => array( array( '1.9alpha', '>=' ) ),
	'wgParserTestFiles' => array( array( '1.9alpha', '>=' ) ),
	'wgPasswordReminderResendTime' => array( array( '1.9alpha', '>=' ) ),
	'wgQueryCacheLimit' => array( array( '1.9alpha', '>=' ) ),
	'wgRCChangedSizeThreshold' => array( array( '1.9alpha', '>=' ) ),
	'wgRCShowChangedSize' => array( array( '1.9alpha', '>=' ) ),
	'wgStyleVersion' => array( array( '1.9alpha', '>=' ) ),
	'wgVariantArticlePath' => array( array( '1.9alpha', '>=' ) ),
	'wgXhtmlDefaultNamespace' => array( array( '1.9alpha', '>=' ) ),
	'wgXhtmlNamespaces' => array( array( '1.9alpha', '>=' ) ),
	'wgSorbsUrl' => array( array( '1.9alpha', '>=' ) ),
# 1.10
	'wgAutoConfirmCount' => array( array( '1.10alpha', '>=' ) ),
	'wgCommandLineDarkBg' => array( array( '1.10alpha', '>=' ) ),
	'wgDBTableOptions' => array( array( '1.10alpha', '>=' ) ),
	'wgDisableOutputCompression' => array( array( '1.10alpha', '>=' ) ),
	'wgMediaHandlers' => array( array( '1.10alpha', '>=' ) ),
	'wgNamespaceAliases' => array( array( '1.10alpha', '>=' ) ),
	'wgNamespaceProtection' => array( array( '1.10alpha', '>=' ) ),
	'wgNonincludableNamespaces' => array( array( '1.10alpha', '>=' ) ),
	'wgSharpenReductionThreshold' => array( array( '1.10alpha', '>=' ) ),
	'wgSharpenParameter' => array( array( '1.10alpha', '>=' ) ),
	'wgDjvuDump' => array( array( '1.10alpha', '>=' ) ),
	'wgDjvuOutputExtension' => array( array( '1.10alpha', '>=' ) ),
# 1.11
	'wgAPIModules' => array( array( '1.11alpha', '>=' ) ),
	'wgAddGroups' => array( array( '1.11alpha', '>=' ) ),
	'wgAjaxLicensePreview' => array( array( '1.11alpha', '>=' ) ),
	'wgAjaxUploadDestCheck' => array( array( '1.11alpha', '>=' ) ),
	'wgArticleRobotPolicies' => array( array( '1.11alpha', '>=' ) ),
	'wgEnotifImpersonal' => array( array( '1.11alpha', '>=' ) ),
	'wgEnotifMaxRecips' => array( array( '1.11alpha', '>=' ) ),
	'wgEnotifUseJobQ' => array( array( '1.11alpha', '>=' ) ),
	'wgExtensionMessagesFiles' => array( array( '1.11alpha', '>=' ) ),
	'wgForeignFileRepos' => array( array( '1.11alpha', '>=' ) ),
	'wgJobClasses' => array( array( '1.11alpha', '>=' ) ),
	'wgLocalFileRepo' => array( array( '1.11alpha', '>=' ) ),
	'wgMaxSigChars' => array( array( '1.11alpha', '>=' ) ),
	'wgParserOutputHooks' => array( array( '1.11alpha', '>=' ) ),
	'wgRemoveGroups' => array( array( '1.11alpha', '>=' ) ),
	'wgScriptExtension' => array( array( '1.11alpha', '>=' ) ),
	'wgShowHostnames' => array( array( '1.11alpha', '>=' ) ),
	'wgSlaveLagCritical' => array( array( '1.11alpha', '>=' ) ),
	'wgSlaveLagWarning' => array( array( '1.11alpha', '>=' ) ),
	'wgSysopEmailBans' => array( array( '1.11alpha', '>=' ) ),
	'wgThumbUpright' => array( array( '1.11alpha', '>=' ) ),
# 1.12
	'wgAppleTouchIcon' => array( array( '1.12alpha', '>=' ) ),
	'wgAutopromote' => array( array( '1.12alpha', '>=' ) ),
	'wgImplicitGroups' => array( array( '1.12alpha', '>=' ) ),
	'wgCheckSerialized' => array( array( '1.12alpha', '>=' ) ),
	'wgDBAvgStatusPoll' => array( array( '1.12alpha', '>=' ) ),
	'wgDebugTidy' => array( array( '1.12alpha', '>=' ) ),
	'wgDefaultRobotPolicy' => array( array( '1.12alpha', '>=' ) ),
	'wgDeleteRevisionsLimit' => array( array( '1.12alpha', '>=' ) ),
	'wgExtraLanguageNames' => array( array( '1.12alpha', '>=' ) ),
	'wgGroupsAddToSelf' => array( array( '1.12alpha', '>=' ) ),
	'wgGroupsRemoveFromSelf' => array( array( '1.12alpha', '>=' ) ),
	'wgForcedRawSMaxage' => array( array( '1.12alpha', '>=' ) ),
	'wgMaxPPNodeCount' => array( array( '1.12alpha', '>=' ) ),
	'wgParserConf' => array( array( '1.12alpha', '>=' ) ),
	'wgMaxTemplateDepth' => array( array( '1.12alpha', '>=' ) ),
	'wgSidebarCacheExpiry' => array( array( '1.12alpha', '>=' ) ),
	'wgStatsMethod' => array( array( '1.12alpha', '>=' ) ),
	'wgUseNPPatrol' => array( array( '1.12alpha', '>=' ) ),
	'wgUserEmailUseReplyTo' => array( array( '1.12alpha', '>=' ) ),
	'wgValidateAllHtml' => array( array( '1.12alpha', '>=' ) ),
# 1.13
	'wgFeed' => array( array( '1.13alpha', '>=' ) ),
	'wgPagePropLinkInvalidations' => array( array( '1.13alpha', '>=' ) ),
	'wgMaxRedirectLinksRetrieved' => array( array( '1.13alpha', '>=' ) ),
	'wgMaxPPExpandDepth' => array( array( '1.13alpha', '>=' ) ),
	'wgLBFactoryConf' => array( array( '1.13alpha', '>=' ) ),
	'wgExpensiveParserFunctionLimit' => array( array( '1.13alpha', '>=' ) ),
	'wgUsersNotifiedOnAllChanges' => array( array( '1.13alpha', '>=' ) ),
	'wgAllDBsAreLocalhost' => array( array( '1.13alpha', '>=' ) ),
	'wgCookieHttpOnly' => array( array( '1.13alpha', '>=' ) ),
	'wgLogRestrictions' => array( array( '1.13alpha', '>=' ) ),
	'wgEnableMWSuggest' => array( array( '1.13alpha', '>=' ) ),
	'wgMWSuggestTemplate' => array( array( '1.13alpha', '>=' ) ),
	'wgOpenSearchTemplate' => array( array( '1.13alpha', '>=' ) ),
	'wgAPIMaxDBRows' => array( array( '1.13alpha', '>=' ) ),
	'wgSitemapNamespaces' => array( array( '1.13alpha', '>=' ) ),
	'wgCacheVaryCookies' => array( array( '1.13alpha', '>=' ) ),
	'wgHttpOnlyBlacklist' => array( array( '1.13alpha', '>=' ) ),
	'wgSpecialPageGroups' => array( array( '1.13alpha', '>=' ) ),
	'wgAllowImageMoving' => array( array( '1.13alpha', '>=' ) ),
	'wgAdvancedSearchHighlighting' => array( array( '1.13alpha', '>=' ) ),
	'wgSearchHighlightBoundaries' => array( array( '1.13alpha', '>=' ) ),
	'wgAvailableRights' => array( array( '1.13alpha', '>=' ) ),
	'wgSharedPrefix' => array( array( '1.13alpha', '>=' ) ),
	'wgSharedTables' => array( array( '1.13alpha', '>=' ) ),
	'wgSQLiteDataDir' => array( array( '1.13alpha', '>=' ) ),
	'wgUseAutomaticEditSummaries' => array( array( '1.13alpha', '>=' ) ),
	'wgRCFilterByAge' => array( array( '1.13alpha', '>=' ) ),
	'wgRCLinkLimits' => array( array( '1.13alpha', '>=' ) ),
	'wgRCLinkDays' => array( array( '1.13alpha', '>=' ) ),
	'wgMaximumMovedPages' => array( array( '1.13alpha', '>=' ) ),
	'wgSpecialVersionShowHooks' => array( array( '1.13alpha', '>=' ) ),
	'wgActiveUserDays' => array( array( '1.13alpha', '>=' ) ),
	'wgActiveUserEditCount' => array( array( '1.13alpha', '>=' ) ),
	'wgRC2UDPOmitBots' => array( array( '1.13alpha', '>=' ) ),
	'wgExtensionAliasesFiles' => array( array( '1.13alpha', '>=' ) ),
	'wgXMLMimeTypes' => array( array( '1.13alpha', '>=' ) ),
	'wgDirectoryMode' => array( array( '1.13alpha', '>=' ) ),
	'wgDiff' => array( array( '1.13alpha', '>=' ) ),
# 1.14	
	'wgExemptFromUserRobotsControl' => array( array( '1.14alpha', '>=' ) ),
	'wgHandheldStyle' => array( array( '1.14alpha', '>=' ) ),
	'wgHandheldForIPhone' => array( array( '1.14alpha', '>=' ) ),
	'wgCleanSignatures' => array( array( '1.14alpha', '>=' ) ),
	'wgDisableTitleConversion' => array( array( '1.14alpha', '>=' ) ),
	'wgOverrideSiteFeed' => array( array( '1.14alpha', '>=' ) ),
	'wgPasswordAttemptThrottle' => array( array( '1.14alpha', '>=' ) ),
	'wgCategoryPrefixedDefaultSortkey' => array( array( '1.14alpha', '>=' ) ),
	'wgSQLiteDataDirMode' => array( array( '1.14alpha', '>=' ) ),
	'wgEnableHtmlDiff' => array( array( '1.14alpha', '>=' ) ),
	'wgRestrictDisplayTitle' => array( array( '1.14alpha', '>=' ) ),
	'wgPhpCli' => array( array( '1.14alpha', '>=' ) ),
	'wgLinkHolderBatchSize' => array( array( '1.14alpha', '>=' ) ),
	'wgEnableImageWhitelist' => array( array( '1.14alpha', '>=' ) ),
	'wgSpecialPageCacheUpdates' => array( array( '1.14alpha', '>=' ) ),
	'wgNewUserLog' => array( array( '1.14alpha', '>=' ) ),
	'wgRenderHashAppend' => array( array( '1.14alpha', '>=' ) ),
## Obsolete
	'wgProfileSampleRate' => array( array( '1.8alpha', '<' ) ),
	'wgProfilerType' => array( array( '1.8alpha', '<' ) ),
	'wgProfiling' => array( array( '1.8alpha', '<' ) ),
	'wgUseXMLparser' => array( array( '1.8alpha', '<' ) ),
	'wgUseWatchlistCache' => array( array( '1.9alpha', '<' ) ),
	'wgWLCacheTimeout' => array( array( '1.9alpha', '<' ) ),
	'wgUseImageResize' => array( array( '1.10alpha', '<' ) ),
	'wgUserHtml' => array( array( '1.10alpha', '<' ) ),
	'wgSaveDeletedFiles' => array( array( '1.11alpha', '<' ) ),
	'wgAlternateMaster' => array( array( '1.13alpha', '<' ) ),
	'wgLinkCacheMemcached' => array( array( '1.13alpha', '<' ) ),
## Both
	'wgAjaxSearch' => array(
		array( '1.8alpha', '>=' ),
		array( '1.14alpha', '<' ),
	),
	'wgAlternateMaster' => array(
		array( '1.10alpha', '>=' ),
		array( '1.13alpha', '<' ),
	),
	'wgEnableCascadingProtection' => array(
		array( '1.10alpha', '>=' ),
		array( '1.13alpha', '<' ),
	),
	'wgUsersNotifedOnAllChanges' => array(
		array( '1.10alpha', '>=' ),
		array( '1.13alpha', '<' ),
	),
	'wgFileRedirects' => array(
		array( '1.12alpha', '>=' ),
		array( '1.13alpha', '<' ),
	),
);

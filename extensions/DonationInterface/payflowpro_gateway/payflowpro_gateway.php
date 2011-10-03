<?php

# Alert the user that this is not a valid entry point to MediaWiki if they try to access the special pages file directly.
if ( !defined( 'MEDIAWIKI' ) ) {
	echo <<<EOT
To install PayflowPro Gateway extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/payflowpro_gateway/payflowpro_gateway.php" );
EOT;
	exit( 1 );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['specialpage'][] = array(
	'name' => 'PayflowPro Gateway',
	'author' => 'Four Kitchens',
	'version' => '1.0.0',
	'descriptionmsg' => 'payflowpro_gateway-desc',
	'url' => 'http://www.mediawiki.org/wiki/Extension:PayflowProGateway',
);

// Set up the new special page
$dir = dirname( __FILE__ ) . '/';
$wgAutoloadClasses['PayflowProGateway'] = $dir . 'payflowpro_gateway.body.php';
$wgAutoloadClasses['PayflowProAdapter'] = $dir . 'payflowpro.adapter.php';

$wgExtensionMessagesFiles['PayflowProGateway'] = $dir . 'payflowpro_gateway.i18n.php';
$wgExtensionMessagesFiles['PayflowProGatewayCountries'] = $dir . 'payflowpro_gateway.countries.i18n.php';
$wgExtensionMessagesFiles['PayflowProGatewayUSStates'] = $dir . 'payflowpro_gateway.us-states.i18n.php';
$wgExtensionAliasesFiles['PayflowProGateway'] = $dir . 'payflowpro_gateway.alias.php';
$wgSpecialPages['PayflowProGateway'] = 'PayflowProGateway';
$wgAjaxExportList[] = "fnPayflowProofofWork";


// set defaults, these should be assigned in LocalSettings.php
$wgPayflowProGatewayURL = 'https://payflowpro.paypal.com';
$wgPayflowProGatewayTestingURL = 'https://pilot-payflowpro.paypal.com'; // Payflow testing URL

$wgPayFlowProGatewayCSSVersion = 1;

$wgPayflowProGatewayPartnerID = ''; // PayPal or original authorized reseller
$wgPayflowProGatewayVendorID = ''; // paypal merchant login ID
$wgPayflowProGatewayUserID = ''; // if one or more users are set up, authorized user ID, else same as VENDOR
$wgPayflowProGatewayPassword = ''; // merchant login password
// a boolean to determine if we're in testing mode
$wgPayflowProGatewayTest = FALSE;

// timeout in seconds for communicating with paypal
$wgPayflowProGatewayTimeout = 5;

/**
 * The default form to use
 */
$wgPayflowProGatewayDefaultForm = 'TwoStepTwoColumn';

/**
 * A string or array of strings for making tokens more secure
 *
 * Please set this!  If you do not, tokens are easy to get around, which can
 * potentially leave you and your users vulnerable to CSRF or other forms of
 * attack.
 */
$wgPayflowProGatewaySalt = $wgSecretKey;

$wgPayflowProGatewayDBserver = $wgDBserver;
$wgPayflowProGatewayDBname = $wgDBname;
$wgPayflowProGatewayDBuser = $wgDBuser;
$wgPayflowProGatewayDBpassword = $wgDBpassword;

/**
 * A string that can contain wikitext to display at the head of the credit card form
 *
 * This string gets run like so: $wg->addHtml( $wg->Parse( $wgpayflowGatewayHeader ))
 * You can use '@language' as a placeholder token to extract the user's language.
 *
 */
$wgPayflowProGatewayHeader = NULL;

/**
 * A string containing full URL for Javascript-disabled credit card form redirect
 */
$wgPayflowProGatewayNoScriptRedirect = null;

/**
 * Proxy settings
 *
 * If you need to use an HTTP proxy for outgoing traffic,
 * set wgPayflowGatweayUseHTTPProxy=TRUE and set $wgPayflowProGatewayHTTPProxy
 * to the proxy desination.
 *  eg:
 *  $wgPayflowProGatewayUseHTTPProxy=TRUE;
 *  $wgPayflowProGatewayHTTPProxy='192.168.1.1:3128'
 */
$wgPayflowProGatewayUseHTTPProxy = FALSE;
$wgPayflowProGatewayHTTPProxy = '';

/**
 * Set the max-age value for Squid
 *
 * If you have Squid enabled for caching, use this variable to configure
 * the s-max-age for cached requests.
 * @var int Time in seconds
 */
$wgPayflowProGatewaySMaxAge = 6000;

/**
 * Directory for HTML forms (used by RapidHtml form class)
 * @var string
 */
$wgPayflowProGatewayHtmlFormDir = dirname( __FILE__ ) . "/forms/html";

/**
 * An array of allowed HTML forms.
 * 
 * Be sure to use full paths.  If your HTML form is not listed here, it will
 * /never/ be loaded by the rapid html form loader!
 * @var string
 */
$wgPayflowProGatewayAllowedHtmlForms = $wgDonationInterfaceAllowedHtmlForms;

/**
 * Configure PayflowproGateway to use syslog for log messages rather than wfDebugLog
 * 
 * @var bool
 */
$wgPayflowProGatewayUseSyslog = false;

/**
 * Configure price ceiling and floor for valid contribution amount.  Values 
 * should be in USD.
 */
$wgPayflowProGatewayPriceFloor = '1.00';
$wgPayflowProGatewayPriceCeiling = '10000.00';

/**
 * Hooks required to interface with the donation extension (include <donate> on page)
 *
 * gwValue supplies the value of the form option, the name that appears on the form
 * and the currencies supported by the gateway in the $values array
 */
$wgHooks['DonationInterface_Value'][] = 'pfpGatewayValue';
$wgHooks['DonationInterface_Page'][] = 'pfpGatewayPage';

// enable the API
$wgAPIModules['pfp'] = 'ApiPayflowProGateway';
$wgAutoloadClasses['ApiPayflowProGateway'] = $dir . 'api_payflowpro_gateway.php';

/**
 * Hook to register form value and display name of this gateway
 * also supplies currencies supported by this gateway
 */
function pfpGatewayValue( &$values ) {
	$values['payflow'] = array(
		'gateway' => 'payflow',
		'display_name' => 'Credit Card',
		'form_value' => 'payflow',
		'currencies' => array(
			'GBP' => 'GBP: British Pound',
			'EUR' => 'EUR: Euro',
			'USD' => 'USD: U.S. Dollar',
			'AUD' => 'AUD: Australian Dollar',
			'CAD' => 'CAD: Canadian Dollar',
			'JPY' => 'JPY: Japanese Yen',
		),
	);

	return true;
}

/**
 *  Hook to supply the page address of the payment gateway
 *
 * The user will redirected here with supplied data with input data appended (GET).
 * For example, if $url[$key] = index.php?title=Special:PayflowProGateway
 * the result might look like this: http://www.yourdomain.com/index.php?title=Special:PayflowProGateway&amount=75.00&currency_code=USD&payment_method=payflow
 */
function pfpGatewayPage( &$url ) {
	global $wgScript;

	$url['payflow'] = $wgScript . "?title=Special:PayflowProGateway";
	return true;
}

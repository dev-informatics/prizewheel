<?php

namespace Application\Model;
// Get the realpath of the ROOT constant.

ini_set('display_errors', 1);

chdir('..');

define('ROOT', getcwd());

$root = realpath(dirname(__DIR__));

require $root.DIRECTORY_SEPARATOR.'init_autoloader.php';

chdir('jobs');

$path = array
(
	$root,
	$root.DIRECTORY_SEPARATOR.'module'.DIRECTORY_SEPARATOR.'Application'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Application'.DIRECTORY_SEPARATOR.'Model',
	get_include_path()
);

set_include_path(implode(PATH_SEPARATOR, $path));

spl_autoload_register(function($class) use($root){
	require_once $root.'/module/Application/src/'.$class.'.php';
});

/****END OF MY CODE****/

/** MassPay NVP example; last modified 08MAY23.
 *
 *  Pay one or more recipients. 
*/

$environment = 'sandbox';	// or 'beta-sandbox' or 'live'

/**
 * Send HTTP POST Request
 *
 * @param	string	The API method name
 * @param	string	The POST Message fields in &name=value pair format
 * @return	array	Parsed HTTP Response body
 */
function PPHttpPost($methodName_, $nvpStr_, ConfigurationEntryTable $configurationEntryTable) {
	global $environment;

	// Set up your API credentials, PayPal end point, and API version.
	$API_UserName = urlencode($configurationEntryTable->getConfigurationEntryByName('paypal api username')->value());
	$API_Password = urlencode($configurationEntryTable->getConfigurationEntryByName('paypal api password')->value());
	$API_Signature = urlencode($configurationEntryTable->getConfigurationEntryByName('paypal api signature')->value());
	$API_Endpoint = "https://api-3t.paypal.com/nvp";
	if("sandbox" === $environment || "beta-sandbox" === $environment) {
		$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
	}
	$version = urlencode('51.0');

	// Set the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	// Turn off the server and peer verification (TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);

	// Set the API operation, version, and API signature in the request.
	$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

	// Set the request as a POST FIELD for curl.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

	// Get response from the server.
	$httpResponse = curl_exec($ch);

	if(!$httpResponse) {
		error_log("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		return false;
	}

	// Extract the response details.
	$httpResponseAr = explode("&", $httpResponse);

	$httpParsedResponseAr = array();
	foreach ($httpResponseAr as $i => $value) {
		$tmpAr = explode("=", $value);
		if(sizeof($tmpAr) > 1) {
			$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
		}
	}

	if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
		error_log("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		return false;
	}

	return $httpParsedResponseAr;
}

/****START OF MY CODE*****/
$adapter = new \Zend\Db\Adapter\Adapter(array(
		'driver' => 'Pdo',
		'dsn' => 'mysql:dbname=prizewheel_mvc;host=localhost',
		'username' => 'root',
		'password' => 'password',
		'driver_options' => array(
				\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		)
));

$affiliateResultSet = new \Zend\Db\ResultSet\ResultSet();
$affiliateResultSet->setArrayObjectPrototype(new Affiliate());
$affiliateTableGateway = new \Zend\Db\TableGateway\TableGateway('affiliates', $adapter, null, $affiliateResultSet);
$affiliateTable = new AffiliateTable($affiliateTableGateway);

$affiliatePayoutEntryResultSet = new \Zend\Db\ResultSet\ResultSet();
$affiliatePayoutEntryResultSet->setArrayObjectPrototype(new AffiliatePayoutEntry());
$affiliatePayoutEntryTableGateway = new \Zend\Db\TableGateway\TableGateway('affiliate_payout_entries', $adapter, null, $affiliatePayoutEntryResultSet);
$affiliatePayoutEntryTable = new AffiliatePayoutEntryTable($affiliatePayoutEntryTableGateway);

$advertisementClickResultSet = new \Zend\Db\ResultSet\ResultSet();
$advertisementClickResultSet->setArrayObjectPrototype(new AdvertisementClick());
$advertisementClickTableGateway = new \Zend\Db\TableGateway\TableGateway('advertisement_clicks', $adapter, null, $advertisementClickResultSet);
$advertisementClickTable = new AdvertisementClickTable($advertisementClickTableGateway);

$configurationEntryResultSet = new \Zend\Db\ResultSet\ResultSet();
$configurationEntryResultSet->setArrayObjectPrototype(new ConfigurationEntry());
$configurationEntryTableGateway = new \Zend\Db\TableGateway\TableGateway('configuration_entries', $adapter, null, $configurationEntryResultSet);
$configurationEntryTable = new ConfigurationEntryTable($configurationEntryTableGateway);

// Set request-specific fields.
$emailSubject =urlencode('example_email_subject');
$receiverType = urlencode('EmailAddress');
$currency = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

// Add request-specific fields to the request string.
$nvpStr="&EMAILSUBJECT=$emailSubject&RECEIVERTYPE=$receiverType&CURRENCYCODE=$currency";

$uselessCount = 0;

$affiliateCount = $affiliateTable->getCount();
$indexHeight = ceil($affiliateCount / 250);

for($i = 1; $i <= $indexHeight; $i++){

	$affiliates = $affiliateTable->fetchAll($i, 250, $uselessCount);
	
	$receiversArray = array();
	
	foreach($affiliates as $affiliate){
		$affiliateClickCount = $advertisementClickTable->fetchCountByAffiliateId($affiliate->id());
		$rate = (float)$configurationEntryTable->getConfigurationEntryByName('affiliate payout rate')->value();
		$paidRewards = $affiliatePayoutEntryTable->getAffiliatePayoutTotal($affiliate->id());
		$totalRewards = ($rate * (float)$affiliateClickCount);
		$unpaidRewards = (float)($totalRewards - $paidRewards);
		
		if($unpaidRewards > 0){
			$receiversArray[] = array(
				'receiverEmail' => $affiliate->emailAddress(),
				'amount' => number_format($unpaidRewards, 2, '.', ''),
				'uniqueId' => $affiliate->id().'|'.time(),
				'note' => 'Prize Wheel Affiliate Payout'
			);
		} // if
	} // foreach
	
	// Check to see if this batch has any payouts.
	// If not, continue to the next iteration.
	if(count($receiversArray) == 0){
		continue;
	} // if
	
	$nvpStr = "";
	
	foreach($receiversArray as $j => $receiverData) {
		$receiverEmail = urlencode($receiverData['receiverEmail']);
		$amount = urlencode($receiverData['amount']);
		$uniqueId = urlencode($receiverData['uniqueId']);
		$note = urlencode($receiverData['note']);
		$nvpStr .= "&L_EMAIL$j=$receiverEmail&L_Amt$j=$amount&L_UNIQUEID$j=$uniqueId&L_NOTE$j=$note";
	} // foreach
	
	// Execute the API operation; see the PPHttpPost function above.
	$httpParsedResponseAr = PPHttpPost('MassPay', $nvpStr, $configurationEntryTable);
	
	$logMessage = "";
	
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
		
		$logMessage = 'MassPay Completed Successfully: '.print_r($httpParsedResponseAr, true);
					
		fwrite(STDOUT, $logMessage);
		error_log('Prize Wheel Affiliate Payout Job Message: ' . $logMessage);
	} else  {
		
		$logMessage = 'MassPay failed: ' . print_r($httpParsedResponseAr, true);
		
		fwrite(STDOUT, $logMessage);
		error_log('Prize Wheel Affiliate Payout Job Message: ' . $logMessage);
	} // else
} // for
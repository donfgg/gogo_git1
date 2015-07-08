<?php
/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
/* You must fill in the "Service Logins
/* values below for the example to work	
/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

/*********** Shipping Services ************/
/* Here's an array of all the standard
/* shipping rates. You'll probably want to
/* comment out the ones you don't want 
/******************************************/
// UPS
$services['ups']['14'] = 'Next Day Air Early AM';
$services['ups']['01'] = 'Next Day Air';
$services['ups']['65'] = 'Saver';
$services['ups']['59'] = '2nd Day Air Early AM';
$services['ups']['02'] = '2nd Day Air';
$services['ups']['12'] = '3 Day Select';
$services['ups']['03'] = 'Ground';
$services['ups']['11'] = 'Standard';
$services['ups']['07'] = 'Worldwide Express';
$services['ups']['54'] = 'Worldwide Express Plus';
$services['ups']['08'] = 'Worldwide Expedited';
// USPS
$services['usps']['EXPRESS'] = 'Express';
$services['usps']['PRIORITY'] = 'Priority';
$services['usps']['PARCEL'] = 'Parcel';
//$services['usps']['FIRST CLASS'] = 'First Class';
//$services['usps']['EXPRESS SH'] = 'Express SH';
//$services['usps']['BPM'] = 'BPM';
$services['usps']['MEDIA '] = 'Media';
$services['usps']['LIBRARY'] = 'Library';
/*
// FedEx
$services['fedex']['PRIORITYOVERNIGHT'] = 'Priority Overnight';
$services['fedex']['STANDARDOVERNIGHT'] = 'Standard Overnight';
$services['fedex']['FIRSTOVERNIGHT'] = 'First Overnight';
$services['fedex']['FEDEX2DAY'] = '2 Day';
$services['fedex']['FEDEXEXPRESSSAVER'] = 'Express Saver';
$services['fedex']['FEDEXGROUND'] = 'Ground';
$services['fedex']['FEDEX1DAYFREIGHT'] = 'Overnight Day Freight';
$services['fedex']['FEDEX2DAYFREIGHT'] = '2 Day Freight';
$services['fedex']['FEDEX3DAYFREIGHT'] = '3 Day Freight';
$services['fedex']['GROUNDHOMEDELIVERY'] = 'Home Delivery';
$services['fedex']['INTERNATIONALECONOMY'] = 'International Economy';
$services['fedex']['INTERNATIONALFIRST'] = 'International First';
$services['fedex']['INTERNATIONALPRIORITY'] = 'International Priority';
*/


// Config
$config = array(
	// Services
	'services' => $services,
	// Weight
	'weight' => 1, // Default = 1
	'weight_units' => 'lb', // lb (default), oz, gram, kg
	// Size
	'size_length' => 8, // Default = 8
	'size_width' => 4, // Default = 4
	'size_height' => 2, // Default = 2
	'size_units' => 'in', // in (default), feet, cm
	// From
	'from_zip' => 90004, 
	'from_state' => "CA", // Only Required for FedEx
	'from_country' => "US",
	// To
	'to_zip' => 90703,
	'to_state' => "CA", // Only Required for FedEx
	'to_country' => "US"
	
	// Service Logins
	/*
	'ups_access' => '7C7065B28FCD67B0', // UPS Access License Key
	'ups_user' => 'soccershopusa', // UPS Username  
	'ups_pass' => 'soccer1', // UPS Password  
	'ups_account' => 'X4847A', // UPS Account Number
	'usps_user' => '447SOCCE3087', // USPS User Name
	'fedex_account' => '', // FedEX Account Number
	'fedex_meter' => '' // FedEx Meter Number
	*/ 
);

// Shipping Calculator Class
require_once "ShippingCalculator.php";
// Create Class (with config array)
$ship = new ShippingCalculator($config);
// Get Rates
$rates = $ship->calculate('',11);

// Print Array of Rates

print "
Rates for sending a ".$config['weight']." ".$config['weight_units'].", ".$config['size_length']." x ".$config['size_width']." x ".$config['size_height']." ".$config['size_units']." package from ".$config['from_zip']." to ".$config['to_zip'].":
<xmp>";
print_r($rates);
print "</xmp>";

/*
echo "<pre>";
var_dump($rates);
echo "</pre>";
*/


/******* Setting Options After Class Creation ********
If you would rather not set all the config options 
when you first create an instance of the class you can
set them like this:

$ship = new ShippingCalculator ();
$ship->set_value('from_zip','12345');

..where the first variable is the name of the value 
and the second variable is the value
/*****************************************************/


/***************** Single Rate ***********************
If you only want to get one rate you can pass the 
company and service code via the 'calculate' method

$ship = new ShippingCalculator ($config);
$rates = $ship->calculate('usps','FIRST CLASS')

..this would return a rates array like 
$rates =>
	'usps' =>
		'FIRST CLASS' = rate;
/*****************************************************/



/***************** Printing Rates *********************
.. and finally, if you wanted to loop through the 
returned rates and print radio buttons so your user 
could select a shipping method you can do something 
like this:
*/
echo "<select name=''>";
foreach($rates as $company => $codes) {
	foreach($codes as $code => $rate)
		if ($rate) {
			echo "<option value='".$rate."' /> $".$rate . " [ " . strtoupper($company) . " ] " . $services[$company][$code] . "</option>";
		}
}
echo "</select>";
/*
which will print the radio buttons, each having the 
value of the respective shipping code which displaying
the more user friendly name of the shipping method.
/*****************************************************/

?>
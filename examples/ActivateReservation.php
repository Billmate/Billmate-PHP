<?php

require_once '../BillMate.php';

// Dependencies from http://phpxmlrpc.sourceforge.net/
include("../xmlrpc-2.2.2/lib/xmlrpc.inc");
include("../xmlrpc-2.2.2/lib/xmlrpcs.inc");

$eid = 1111; /* Replace with your eid. You can find it in Billmate-Online*/
$key = 111111111111; /* Replace with your secret. You can find it in Billmate-Online*/
$ssl = true; 
$debug = true; /* View more detailed information about the server communication */ 


$b = new BillMate($eid,$key,$ssl,$debug);
$reservationno = "103";
$personalnumber = "5560000753";
$billingaddress = $shippingaddress = array(
	"email" => "test@test.com",
    "telno" => "0760123456",
    "cellno" => "0760123456",
    "fname" => "First name",
    "lname" => "Last name",
    "company" => "",
    "street" => "Streetname no",
    "zip" => "ZipCode",
    "city" => "City",
    "country" => "Sweden",
);
$articles = array(
	array(
		"goods" => array
            (
                artno => "VGN-TXN27N/B",
                title => 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC',
                price => 337499,
                vat => 25,
                discount => 0,
                flags => 32
            ),
        "qty" => 1
	),
	array(
		"goods" => array
	        (
	            artno => "flatrate_flatrate",
	            title => 'Frakt - Fixed',
	            price => 6250,
	            vat => 25,
	            discount => 0,
	            flags => 40
	        ),
	    "qty" => 1
	),
	array(
		"goods" => array
	        (
	            artno => "invoice_fee",
	            title => 'Faktureringsavgift',
	            price => 3625,
	            vat => 25,
	            discount => 0,
	            flags => 48
	        ),
	    "qty" => 1
	)
	
);

$additionalinfo = array(
	"order1"=>"O12345",
	"order2"=>"654321",
	"comment"=>"Comment text",
	"flags"=>0,
	"reference"=>"",
	"reference_code"=>"",
	"currency"=>0,
	"country"=>209,
	"language"=>138,
	"pclass"=>-1,
	"shipInfo"=>array("delay_adjust"=>"1"),
	"travelInfo"=>array(),
	"incomeInfo"=>array(),
	"bankInfo"=>array(),
	"sid"=>array("time"=>microtime(true)),
	"extraInfo"=>array()
);
try {
	$result = $b->ActivateReservation($reservationno,$personalnumber,$billingaddress,$shippingaddress,$articles,$additionalinfo);  
} catch(Exception $e) {
    //Something went wrong
//    echo "{$e->getMessage()} (#{$e->getCode()})\n";
}
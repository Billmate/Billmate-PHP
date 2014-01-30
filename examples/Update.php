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

$rno = "2544";
$billingaddress = $shippingaddress = array(
	"email" => "test@test.com",
    "telno" => "0760123456",
    "cellno" => "0760123456",
    "fname" => "Firstname",
    "lname" => "Lastname",
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
                price => 200000,
                vat => 12,
                discount => 0,
                flags => 0
            ),
        "qty" => 1
	),
	array(
		"goods" => array
	        (
	            artno => "flatrate_flatrate",
	            title => 'Frakt - Fixed',
	            price => 25000,
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
	            price => 12500,
	            vat => 25,
	            discount => 0,
	            flags => 48
	        ),
	    "qty" => 1
	)
	
);
$order1 = "O12345";
$order2 = "654321";

try {
	$result = $b->Update($rno,$billingaddress,$shippingaddress,$articles,$order1,$order2);  
} catch(Exception $e) {

}
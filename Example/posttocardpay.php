<?php

require_once('Billmate.php');

define('ID'),0000) // Set your ID, you can find it in Billmate Online.
define('SECRET',0000000) // Set your secret, you can find it in Billmate Online.

define('CARDPAY',8);
define('BANKPAY',16);
define('SITE_URL', 'http://www.yoursiteurl.com'); // Set this to your store url.
define('SSL'), true); // Set this to your SSL setting, true or false.
//define('SALE',1);
//define('AUTHORIZE',0);
define('AUTOACTIVATE', 0) // Set 0 for no auto activatem set to 1 for auto activate
define('PROMPTNAME',0); // Set 0 for no name prompt on payment windows. Set 1 for name prompt.
define('THREEDSECURE',1); // Set 0 for no 3D Secure on card transactions. Set 1 for 3D secure requirement.
define('TEST'), false); // Set to true for live mode, set to false for test mode
define('DEBUG', false); // Set to true for debug messages, set to false for no debug messages.

$orderValues['PaymentData'] = array(
    'method' => CARDPAY,
    'currency' => 'SEK',
    'country' => 'SE', // Country in ISA Alpha 2 format
    'orderid' => $_POST['order_id'], // Your order id
    'autoactivate' => AUTOACTIVATE, // Could be SALE or AUTHORIZE, see declaration.
    'language' => 'sv'
);

$orderValues['PaymentInfo'] = array(
    'paymentdate' => (string)date('Y-m-d')
);

$orderValues['Card'] = array(
    '3dsecure' => THREEDSECURE, // Use 3D secure the value is 1 else 0, Defined on top.
    'promptname' => PROMPTNAME, // Do customer need to enter their name in Payment window? Defined on top.
    'accepturl' => SITE_URL.'/accepturl.php',  // Enter your domain and path to accepturl.php
    'cancelurl' => SITE_URL.'/cancel.php', 	 // Customer cancels their order.
    'callbackurl' => SITE_URL.'/callback.php', // This script is used if for example a customer closes their window after payment.
    'returnmethod' => 'POST'
);

$orderValues['Customer'] = array(
    'nr' => isset($_POST['customer_id']) ? $_POST['customer_id'] : 0,
);

$orderValues['Customer']['Billing'] = array(
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'company' => isset($_POST['company']) ? $_POST['company'] : '',
    'street' => $_POST['street'],
    'zip' => $_POST['postcode'],
    'city' => $_POST['city'],
    'country' => $_POST['country'],
    'phone' => $_POST['phone'],
    'email' => $_POST['email']
);

if(!isset($_POST['shiptobilling'])){
    $orderValues['Customer']['Shipping'] = array(
        'firstname' => $_POST['shipping_firstname'],
        'lastname' => $_POST['shipping_lastname'],
        'company' => isset($_POST['shipping_company']) ? $_POST['shipping_company'] : '',
        'street' => $_POST['shipping_street'],
        'zip' => $_POST['shipping_postcode'],
        'city' => $_POST['shipping_city'],
        'country' => $_POST['shipping_country'],
        'phone' => $_POST['shipping_phone'],
    );
}

$orderValues['Articles'][] = array(
	'quantity' => $_POST['article_quantity'],
	'artnr' => $_POST['article_id'],
	'title' =>   $_POST['article_title'],
	'aprice' => $_POST['article_price'] * 100, // The price for one unit without TAX
	'taxrate' => 25, // It work to send a post with taxrate and add it here
	'withouttax' => $_POST['article_price'] * $_POST['article_quantity'] * 100 // The total amount of Articles times aprice
);

$total = $_POST['article_price'] * $_POST['article_quantity'] * 100;
$totalTax = $total * 0.25;

// Is shipping price set and over 0?
if(isset($_POST['shipping_price']) && $_POST['shipping_price'] > 0){
	$orderValues['Cart']['Shipping'] = array(
        'withouttax' => $_POST['shipping_price'] * 100,
        'taxrate' => (int)25
    );
	$total += $_POST['shipping_price'] * 100;
	$totalTax += ($_POST['shipping_price'] * 100) * 0.25;
}

// If you send a post total_amount
$round = 0;

if(isset($_POST['total_amount']))
	$round = $_POST['total_amount'] - $total;

$orderValues['Cart']['Total'] = array(
    'withouttax' => $total,
    'tax' => (int)$totalTax,
    'rounding' => $round,
    'withtax' =>(int) $total + (int)$totalTax + (int) $round
);

$billmate = new Billmate(ID, SECRET, SSL, TEST, DEBUG);

$result = $billmate->addPayment($orderValues);

if(isset($result['code'])){
    // Something went wrong, display error
	echo 'Something went wrong';
	echo  $result['message'];
} else {
	// All went good, redirect customer to Billmate payment window
	header('Location: '.$result['url']);
}

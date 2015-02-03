<?php
$post = (!empty($_POST)) ? $_POST : $_GET;


require_once('Billmate.php');

$eid = '7270'; // Change to yours
$secret = '606250886062'; // Change to yours.

$billmate = new Billmate($eid,$secret);
$result = $billmate->verify_hash($post);
/*
 *  the result will contain if all goes well
 *	$result['number']  the invoice number in Billmate online
 *	$result['orderid'] the orderid that is sent to Billmate
 *	$result['status']  the status the payment has. Created, Paid, Factoring, Service, Pending, and Cancelled
 *	$result['url'] 		the invoice url to show customer maybe
 */
// the customer has cancel their payment with order id $result['orderid']

// You should maybe mark the order as canceled?

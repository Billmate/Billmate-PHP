<?php

$post = (!empty($_POST)) ? $_POST : $_GET;


require_once('Billmate.php');

define('ID',0000); // Set your ID, you can find it in Billmate Online.
define('SECRET',0000000); // Set your secret, you can find it in Billmate Online.

$billmate = new Billmate(ID,SECRET);
$result = $billmate->verify_hash($post);
/*
 *  the result will contain if all goes well
 *	$result['number']  the invoice number in Billmate online
 *	$result['orderid'] the orderid that is sent to Billmate
 *	$result['status']  the status the payment has. Created, Paid, Factoring, Service, Pending, and Cancelled
 *	$result['url'] 		the invoice url to show customer maybe
 */
if(isset($result['code']) || isset($result['error'])){
	// There are some errors handle it in your system
	echo 'There was a problem when the payment was processed';
	echo 'Reason: '. $result['message'];
} else {
	// There was no errors, mark order as paid in your system.
	echo 'Your order with order number '. $result['orderid']. ' were successful and have status ' .$result['status'];
}


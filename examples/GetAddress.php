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

try {
	//Test Company:
    //450708-2222
    
    //Test People:
    //556000-0753
    //556738-7914
    //870624-0721
    
    //Rejected:
    //840203-4840
    
    //Personal number should be fit to luhn algorithm
    
    $addr = $b->GetAddress($personalnumber);
    
    //Result:
//    print_r($addr);
    
} catch(Exception $e) {
    //Something went wrong
//    echo "{$e->getMessage()} (#{$e->getCode()})\n";
}

<?php


/* funkcija da korisnik moze da dodaje stvari u korpu, brise ih i azurira */
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

$obj=new add_to_cart();


/* dodavanje u korpu */
if($type=='add'){
	$obj->addProduct($pid,$qty);
}

/* uklanjanje stvari iz korpe */
if($type=='remove'){
	$obj->removeProduct($pid);
}

/* azuriranje korpe */
if($type=='update'){
	$obj->updateProduct($pid,$qty);
}

/* objavljuje ukupan broj stvari u korpi */
echo $obj->totalProduct();
?>
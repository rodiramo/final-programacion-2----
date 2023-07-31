<?php


use Classes\Models\Cart;

require_once __DIR__ . '/../bootstrap/init.php';
//require_once __DIR__ . '/../../classes/itemTrace.php';

$cart_byUser_id = $_POST['cart_byUser_id'];

try {
	(new Cart) -> delete($cart_byUser_id);

	$_SESSION['msgFeedback'] = "The item was deleted!";
	header("Location: ../index.php?s=cart");
	exit;
} catch (Exception $e) {
	$_SESSION['msgFeedback'] = "[$e]]";

	header("Location: ../index.php?s=cart");
	exit;
}
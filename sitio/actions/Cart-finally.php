<?php 

use Classes\Models\Cart_Finally;

require_once __DIR__ . '/../bootstrap/init.php';

try {
	(new Cart_Finally) -> insertCartFinally();

	$_SESSION['msgFeedback'] = "Thanks for your Purschase! Enjoy it.";
	header("Location: ../index.php?s=cart");
	exit;
} catch (Exception $e) {
	$_SESSION['msgFeedback'] = "[$e]]";

	header("Location: ../index.php?s=cart");
	exit;
}


?>
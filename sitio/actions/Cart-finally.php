<?php 

use Classes\Models\CartFinally;

require_once __DIR__ . '/../bootstrap/init.php';

try {
	(new CartFinally) -> insertCartFinally();

	$_SESSION['msgFeedback'] = "Thanks for your Purschase! You can check it in your profile";
	header("Location: ../index.php?s=cart");
	exit;
} catch (Exception $e) {
	$_SESSION['msgFeedback'] = "[$e]]";

	header("Location: ../index.php?s=cart");
	exit;
}


?>
<?php
use Classes\Auth\ResetPassword;
use Classes\Models\User;

require_once __DIR__ . '/../bootstrap/init.php';

$email = $_POST['email'];


$user = (new User)->bringByEmail($email);

if(!$user) {
	$_SESSION['msgError'] = "A user with this email address does not exists";
	$_SESSION['data-form'] = $_POST;
	header("Location: ../index.php?s=reset-password");
	exit;
}

try {
	(new ResetPassword)->requestReset($user);

	$_SESSION['msgFeedback'] = "An email has been sent to reset password, please check your inbox or spam folder.";
	header("Location: ../index.php?s=login");
	exit;
} catch (Exception $e) {
	$_SESSION['msgError'] = "Error with sending the email. " . $e->getMessage();
	$_SESSION['data-form'] = $_POST;
	header("Location: ../index.php?s=reset-password");
	exit;	
}
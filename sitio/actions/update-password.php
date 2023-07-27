<?php
use Classes\Auth\ResetPassword;
use Classes\Models\User;

require_once __DIR__ . '/../bootstrap/init.php';

$password 			= $_POST['password'];
$password_confirm 	= $_POST['password_confirm'];
$email 				= $_POST['email'];
$token 				= $_POST['token'];


$user= (new User)->bringByEmail($email);


$reset = new ResetPassword;

if(!$reset->validToken($token, $user)) {
	$_SESSION['msgError'] = "This link is invalid or it has expired, please try again.";
	header("Location: ../index.php?s=reset-password");
	exit;
}

try {
	$user->editPassword(password_hash($password, PASSWORD_DEFAULT));

	$_SESSION['msgFeedback'] = "Your password has been successfully updated, you can now login!";
	header("Location: ../index.php?s=login");
	exit;
} catch (\Exception $e) {
	$_SESSION['msgError'] = "Unexpected error, please try again later :(";
	header("Location: ../index.php?s=new-password&token=" . $token . "&email=" . $email);
	exit;
}
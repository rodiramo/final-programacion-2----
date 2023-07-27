<?php

use Classes\Auth\Auth;

require_once __DIR__ . '/../bootstrap/init.php';

$email = $_POST['email'];
$password = $_POST['password'];


$auth = new Auth;

if(!$auth->login($email, $password)) {
	$_SESSION['msgError'] = "The password or email is incorrect.";

	$_SESSION['data-form'] = $_POST;
	header("Location: ../index.php?s=login");
	exit;
}

$_SESSION['msgFeedback'] = "¡Welcome Back!";
header("Location: ../index.php?s=home");
exit;
<?php
use Classes\Models\User;

require_once __DIR__ . '/../bootstrap/init.php';

$email 		= $_POST['email'];
$password 	= $_POST['password'];
$name	= $_POST['name'];
$surname = $_POST['surname'];


try {
	(new User)->newUser([
		'rol_fk' => 2, 
		'email' => $email,
    	'name' => $name,
		'surname' => $surname,
		'password' => password_hash($password, PASSWORD_DEFAULT),
	]);

	$_SESSION['msgFeedback'] = "Your account has been successfully created.";

	header("Location: ../index.php?s=login");
	exit;
} catch (Exception $e) {
	$_SESSION['data-form'] = $_POST;
	$_SESSION['msgError'] = "Error to create user, check the email and password.";
	header("Location: ../index.php?s=register");
	exit;
}
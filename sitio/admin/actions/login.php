<?php


use Classes\Auth\Auth;
require_once __DIR__ . '/../../bootstrap/init.php';


$email = $_POST['email'];
$password = $_POST['password'];

$auth = new Auth;

if(!$auth->login($email, $password))
{ 
   $_SESSION['msgError'] = "Error, user or password wrong.";
   $_SESSION['data-form'] = $_POST;
   header("Location: ../index.php?s=login");
   exit; 
}
else
{
   $_SESSION['msgFeedback'] = "Welcome back!";
   header("Location: ../index.php?s=home");
   exit;
}
<?php


use Classes\Models\Cart;
use Classes\Auth\Auth;


require_once __DIR__ . '/../bootstrap/init.php';


$auth = new Auth;



$id = $_POST['product_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];

if(!$auth->authenticated()) {
	$_SESSION['msgError'] = "You need to be logged in to perform that action";
	header('Location: ../index.php?s=login');
	exit;
}


try {
	(new Cart)->create([
		'user_fk' => $auth->getUserId(),
		'name' => $name,
		'price' => $price,
		'image' => $image,
	]);

	$_SESSION['msgFeedback'] = 'The product was added to the cart!';

	header('Location: ../index.php?s=cart'); 
	exit;
} catch (Exception $e) {
	$_SESSION['data-form'] = $_POST;
	$_SESSION['msgError'] = "The product couldnt get added to the cart, please try again";

	header('Location: ../index.php?s=products'); 

	exit;
}
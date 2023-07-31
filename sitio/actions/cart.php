<?php


use Classes\Models\Cart;
use Classes\Auth\Auth;
use Classes\Models\Product;

require_once __DIR__ . '/../bootstrap/init.php';


$auth = new Auth;



$product_id = $_POST['product_id'];


if(!$auth->authenticated()) {
	$_SESSION['msgError'] = "You need to be logged in to perform that action";
	header('Location: ../index.php?s=login');
	exit;
}


try {

	$product = (new Product) ->viewById($product_id);
	$cart = (new Cart);
	
	if($cart->viewById($product_id))
	{
		$cart->update($product_id, $product->getPrice());
	}
	else
	{	
		$cart->create([
			'user_id' 		=> $auth->getUserId(),
			'product_id' 	=> $product_id,
			'price' 		=> $product->getPrice()
		]);
	
	}

	
	$_SESSION['msgFeedback'] = 'The product was added to the cart!';

	header('Location: ../index.php?s=cart'); 
	exit;
} catch (Exception $e) {
	$_SESSION['data-form'] = $_POST;
	$_SESSION['msgError'] = $e->getMessage();

	header('Location: ../index.php?s=products'); 

	exit;
}
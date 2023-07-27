<?php


use Classes\Auth\Auth;
use Classes\Models\Product;

require_once __DIR__ . '/../../bootstrap/init.php';
//require_once __DIR__ . '/../../classes/itemTrace.php';


$auth = new Auth;
if(!$auth->admin()) {
	$_SESSION['msgError'] = "You need to be signed in as an Admin to view the content of this page.";
	header('Location: ../index.php?s=login');
	exit;
}

$id = $_GET['id'];

try {
	$product= (new Product)->viewById($id);

	//img
	if(!empty($product->getImg())) {
		if(file_exists(ROUTE_IMGS . '/' . $product->getImg())) {
			// unlink es la función en php para eliminar un archivo.
			unlink(ROUTE_IMGS . '/' . $product->getImg());
		}
	}


	(new Product)->delete($id);


	$_SESSION['msgFeedback'] = "The product was deleted!";
	header("Location: ../index.php?s=product");
	exit;
} catch (Exception $e) {
	$_SESSION['msgFeedback'] = "[$e]]";

	header("Location: ../index.php?s=product");
	exit;
}
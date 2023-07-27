<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);


use Classes\Auth\Auth;
use Classes\Models\Product;
use Intervention\Image\ImageManagerStatic as Image;

require_once __DIR__ . '/../../bootstrap/init.php';


$auth = new Auth;
if(!$auth->authenticated()) {
	$_SESSION['msgError'] = "You need to be signed in as an Admin to view the content of this page.";
	header('Location: ../index.php?s=login');
	exit;
}

// CAPTURE DATA FROM FORM

$product_id   		= $_GET['id'];
$name               = $_POST['name'];
$category           = $_POST['category'];
$type               = $_POST['type'];
$description        = $_POST['description'];
$price              = $_POST['price'];
$img                = $_FILES['img'];
$img_desc           = $_POST['img_desc'];



//VALIDATE
$errors = [];

if(empty($name)) {
	$errors['name'] = "The name must contain characters";
} else if(strlen($name) < 2) {
	$errors['name'] = "The name must have at least two characters";
}

if(empty($description)) {
	$errors['description'] = "You must put a description";
}

if(empty($category)) {
	$errors['category'] = "You must pick a Category";
}

if(empty($type)) {
	$errors['type'] = "You must pick a Family";
}

if(empty($price)) {
	$errors['price'] = "Please state the price";
}




if(count($errors) > 0) {
	
	$_SESSION['errors'] = $errors;
	$_SESSION['data-form'] = $_POST;

	header('Location: ../index.php?s=product-edit&id=' . $id);
	exit;
}


//BRING PRODUCT
$product = (new Product)->viewById($product_id);

//IMG
if(!empty($img['tmp_name'])) {
	$imgName = time() . "_" . $img['name'];

	Image::make($img['tmp_name'])
		->fit(350,439 )
		->save(ROUTE_IMGS . '/' . $imgName);
	
}
//Edit
try {
	
	$product -> edit(
	$product -> getProductId() ,
	[
	'name'           => $name,
	'category'       => $category,
	'type'           => $type,
	'description'    => $description,
	'price'          => $price,
	'img'            => $imgName ?? $product->getImg(),
	'img_desc'       =>	$img_desc,
	'id_categoria' 	 => 1,
]);
	// $user = (new Usuario)->getUsuarioId(); // Obtenemos el idUsuario activo.

	// $accion = "Edición de producto"; // Le pasamos la accion por parametro.
 
	// (new ItemTrace)->insertItemTrace($accion, $user, $product_id); // Insertamos.
//img
if(!empty($product->getImg())) {
	$imagenChica = ROUTE_IMGS . '/' . $product->getImg();
	if(file_exists($imagenChica)) unlink($imagenChica);
}

	$_SESSION['msgFeedback'] = 'The product was successfully edited!';

	header('Location: ../index.php?s=product'); 
	exit;
} catch (Exception $e) {
	$_SESSION['msgFeedback'] = $e;
	header('Location: ../index.php?s=product-edit&id=' . $product_id);
	exit;
}
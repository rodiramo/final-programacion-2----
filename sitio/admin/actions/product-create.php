<?php



use Classes\Auth\Auth;
use Classes\Models\Product;
use Intervention\Image\ImageManagerStatic as Image;

require_once __DIR__ . '/../../bootstrap/init.php';



$auth = new Auth;
if(!$auth->admin()) {
	$_SESSION['msgError'] = "You need to be signed in as an Admin to view the content of this page.";
	header('Location: ../index.php?s=login');
	exit;
}



//form data
$name               = $_POST['name'];
$category           = $_POST['category'];
$type               = $_POST['type'];
$description        = $_POST['description'];
$price              = $_POST['price'];
$img                = $_FILES['img'];
$img_desc           = $_POST['img_desc'];
 
//validate

$errors = [];
if(empty($name)) {
	$errors['name'] = "The title cant be empty";
} else if(strlen($name) < 2) {
	$errors['name'] = "The title must have at least two characters";
}

if(empty($category)) {
	$errors['category'] = "The Category cant be empty";
}

if(empty($description)) {
	$errors['description'] = "The Description cant be empty";
}

if(empty($type)) {
	$errors['type'] = "You must pick a Family";
}

if(empty($price)) {
	$errors['price'] = "The price cant be empty";
}


if(count($errors) > 0) {
	$_SESSION['errors'] = $errors;
	$_SESSION['data-form'] = $_POST;
	header('Location: ../index.php?s=product-publish');
	exit;
}

//img
if(!empty($img['tmp_name'])) {
	$imgName = time() . "_" . $img['name'];
	
	Image::make($img['tmp_name'])
		->fit(350, 439)
		->save(ROUTE_IMGS . "/" . $imgName);
	}

try {
	
	(new Product)->createProduct([
		'name'           => $name,
		'category'       => $category,
		'type'           => $type,
		'description'    => $description,
		'price'          => $price,
		'img'            => $imgName ?? null,
		'img_desc'       => $img_desc,
		'user_fk' 			=> 1 ?? null,
		'category_fk' 		=> 1 ?? null,
	]);


	
	// $maxId = (new Product)->getMaxId(); // Obtenemos el ultimo id insertado del producto.

	// $user = (new Usuario)->getUsuarioId(); // Obtenemos el idUsuario activo.

	// $accion = "Creación de producto"; // Le pasamos la accion por parametro.
 
	// (new ItemTrace)->insertItemTrace($accion, $user, $maxId); // Insertamos.



	$_SESSION['msgFeedback'] = 'The Product Was Succesfully Made :D';
	header('Location: ../index.php?s=product'); 
	exit;

}catch (Exception $e) {

	header('Location: ../index.php?s=product-publish');
	exit;
}
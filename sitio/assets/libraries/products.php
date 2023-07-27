<?php

use Classes\Models\Product;

/**
 * 
 *@return Product[]
 * 
 */


function productTodo() : array{
    
$contenido = file_get_contents(__DIR__ . '/../api/productos.json');

$data = json_decode($contenido, true);

$salida = [];


foreach($data as $item){
    $product = new Product;
$product->uploadDataArray($item);
$salida[] = $product;

}
return $salida;
}


/**
 * Retorna la noticia correspondiente al $id provisto.
 *
 * @param int $id
 * @return Product
 */

function viewById(int $id): Product
{

 $products = productTodo();
  
  foreach($products as $product){
      if($id === $product->product_id){
          return $product;
      }
  }
}
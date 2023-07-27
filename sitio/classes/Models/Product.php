<?php


namespace Classes\Models;

use PDO;
use Exception;

use Classes\DB\DB;

class Product{

private int       $product_id;
private string    $name;
private string    $category;
private string    $type;
private string    $description;  
private string    $price;
private ?string   $img;
private ?string   $img_desc;


/**
 * guarda los datos de $data
 * @param array $data
 * 
 */

 public function uploadDataArray(array $data): void
{

$this->product_id              = $data['product_id'];
$this->name                    = $data['name'];
$this->category                = $data['category'];
$this->type                    = $data['type'];
$this->description             = $data['description'];
$this->price                   = $data['price'];
$this->img                     = $data['img'];
$this->img_desc                = $data['img_desc'];



 }
 /**
  * 
  * @return Product[]
  * 
  */
public function todo() :  array
{
      $db = DB::getConexion();
      $query = "SELECT * FROM products";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

         return $stmt->fetchAll();

}

/**
 * 
 * @param int $id
 * 
 * @return Product|null
 * 
 */

 public function viewById(int $id): ?Product
 {

   $db = (new DB)->getConexion();
   $query = "SELECT * FROM products
           WHERE product_id = ?";
   $stmt = $db->prepare($query);
   $stmt->execute([$id]);
   $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

   $product = $stmt->fetch();
   
   if(!$product) return null;
        
   return $product;
 }


 /**
  *  CREATES
  */

 public function createProduct(array $data)
 {
     $db = (new DB)->getConexion();
     $query = "INSERT INTO products 
     (
      user_fk,
      category_fk,
      name, 
      category, 
      type, 
      description,
      price, 
      img, 
      img_desc) 
             VALUES ( 
               :user_fk,
               :category_fk,
               :name, 
               :category, 
               :type, 
               :description,
               :price, 
               :img, 
               :img_desc)";
     $stmt = $db->prepare($query);
  
     $stmt->execute([
         'user_fk'           => $data['user_fk'],
         'category_fk'       => $data['category_fk'],
         'name'           => $data['name'],
         'category'       => $data['category'],         
         'type'           => $data['type'],
         'description'    => $data['description'],
         'price'          => $data['price'],
         'img'            => $data['img'],
         'img_desc'       => $data['img_desc'],
     ]);
 }

/**
 * EDITS
 *  */
 public function edit(int $id, array $data)
 {
   $db = DB::getConexion();

   $db->beginTransaction();
try{
     $query = "UPDATE products
               SET
               user_fk = :user_fk,
               category_fk = :category_fk,
                 name             = :name,
                 category         = :category,
                 type             = :type,
                 description      = :description,
                 price            = :price,
                 img              = :img,
                 img_desc         = :img_desc
                 WHERE product_id        = :product_id;";
     $stmt = $db->prepare($query);
     $stmt->execute([   
      'user_fk'            => $data['user_fk'],
     'category_fk'            => $data['category_fk'],
         'name'             => $data['name'],
         'category'         => $data['category'],         
         'type'             => $data['type'],
         'description'      => $data['description'],
         'price'            => $data['price'],
         'img'              => $data['img'],
         'img_desc'         => $data['img_desc'],
         'product_id'              => $id
     ]);
     $db->commit();
   }catch (Exception $e) {
      $db->rollBack();
  }     
 }

 /**
  * DELETES PRODUCT
  */
 public function delete(int $id)
 {
      $db = DB::getConexion();
     $query = "DELETE FROM products 
             WHERE product_id = ?";
     $stmt = $db->prepare($query);
     $stmt->execute([$id]);
 }



 public function getMaxId():int
 {
   $db = (new DB)->getConexion();
   $query = "SELECT max(product_id) 
               FROM   products";

   $stmt = $db->prepare($query);
   $stmt->execute();

   $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

   $maxId =  $stmt->fetch();

   return $maxId;
 }


 /*** SETTERS Y GETTERS  ***/

/* get value of id */
public function getProductId(): int
{
   return $this->product_id;
} 
/* set value of id */
 public function setProductId(int $product_id)
{
   $this->product_id = $product_id;
}


/* get value of name */
public function getTitle(): string
{
   return $this->name;
}          
/* set value of name */
public function setProductTitle(string $name)
{
   $this->name= $name;
}


/* get value of category */            
public function getCategory(): string
{
   return $this->category;
}
/* set value of category */
public function setProductCategory(string $category)
{
   $this->category = $category;
}


/* get value of family */
public function getType(): string
{
   return $this->type;
}
/* set value of family */
public function setProductType(string $type)
{
   $this->type = $type;
}

/* get value of desc */
public function getDescription(): string
{
   return $this->description;
}
 /* set value of desc */
public function setProductDescription(string $description)
{
   $this->description = $description;
}


/* get value of price */
public function getPrice(): string
{
   return $this->price;
}
/* set value of price */
public function setProductPrice(string $price)
{
   $this->price = $price;
}




/* get value of img */
public function getImg(): ?string
{
   return $this->img;
}
/* set value of img */
public function setProductImg(?string $img)
{
   $this->img = $img;
}

/* get value of img desc */
public function getImgDesc(): ?string
{
   return $this->img_desc;
}
/* set value of omg desc*/
public function setProductImgDesc(?string $img_desc)
{
   $this->img_desc = $img_desc;
}

}
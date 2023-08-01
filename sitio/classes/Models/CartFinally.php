<?php

namespace Classes\Models;

use PDO;
use Classes\DB\DB;
use Exception;



class CartFinally extends Model
{  
	 protected string $table = 'cart_finally';
 
	private int $cartProductsFinally_id;
	private int $product_id;
	private int $user_id;
	private string $name;
	private string $price;
	private string $img;
	private int $cant;
	protected int $cartFinally_id = 0;
    protected string $fecha = '';
    protected float $finally_price = 0.0;
	public function getCartFinallyId(): int
    {
        return $this->cartFinally_id;
    }
	public function uploadDataArray(array $row)
	{
		//$this->cartFinally_id = $row['cartFinally_id'];
        //$this->product_id    = $row['product_id'];
        //$this->name         = $row['name'];
        //$this->user_id         = $row['user_id'];
        //$this->price         = $row['price'];
        //$this->img             = $row['img'];
        //$this->cant            = $row['cant'];
        $this->fecha        = $row['fecha'];
        $this->finally_price= $row['finally_price'];
	}

	
	public function viewById(int $user_id): ?CartFinally
{
    $db = (new DB)->getConexion();
    $query = "SELECT * FROM cart_finally CF WHERE CF.user_id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $cart = $stmt->fetch();

    if (!$cart) return null;

    return $cart;
}


public function getLatestPurchasesForUser(int $user_id)
{
    $db = DB::getConexion();
    $query = "SELECT c.cartProductsFinally_id, cf.cartFinally_id, c.product_id, p.name, c.user_id, c.price, p.img, 'image' AS img_desc, c.cant, cf.finally_price
              FROM cartProducts_finally c
              INNER JOIN cart_finally cf ON c.cartFinally_id = cf.cartFinally_id
              INNER JOIN products p ON c.product_id = p.product_id
              WHERE c.user_id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

    return $stmt->fetchAll();
}


    public function insertCartFinally()
    {   $db = (new DB)->getConexion();
        $db->beginTransaction();

        $isError = false;

        try{
            
            $query = "INSERT INTO cart_finally 
            (
             fecha,
             finally_price) 
             SELECT CURRENT_DATE(), SUM(price) FROM cart;";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $db->commit();
        }
        catch(Exception $e)
        {
                $db->rollBack();
                $isError = true;
        }
     
        if(!$isError)
        {
            self::insertCartProducts();
            self::deleteCart();
        }

    }

    protected function insertCartProducts()
    {
        $db = (new DB)->getConexion();
        $query = "INSERT INTO cartproducts_finally (user_id, product_id, cant, price, cartFinally_id)
                    SELECT user_id, product_id, cant, price, (SELECT MAX(cartFinally_id) FROM cart_finally)
                        FROM cart;";
        $stmt = $db->prepare($query);
        $stmt->execute();

    }

    protected function deleteCart(){
        $db = (new DB)->getConexion();
        $query = "DELETE FROM cart;";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
 

	/********* SETTERS & GETTERS *********/

	public function getcartProductsFinally_id(): int
	{
		return $this->cartProductsFinally_id;
	}

	public function getProductsFinally_id(int $cartProductsFinally_id)
	{
		$this->cartProductsFinally_id = $cartProductsFinally_id;
	}


	public function getCart_byUser_id(): int
	{
		return $this->cartFinally_id;
	}

	public function setCart_byUser_id(int $cartFinally_id)
	{
		$this->cartFinally_id = $cartFinally_id;
	}

	public function getId(): int
	{
		return $this->product_id;
	}

	public function setId(int $id)
	{
		$this->product_id = $id;
	}


	public function getUserFk(): int
	{
		return $this->user_id;
	}

	public function setUserFk(int $user_id)
	{
		$this->user_id = $user_id;
	}



	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}


	public function getPrice(): string
	{
		return $this->price;
	}

	public function setPrice(string $price)
	{
		$this->price = $price;
	}

	public function getImage(): string
	{
		return $this->img;
	}

	public function setImage(string $img)
	{
		$this->img = $img;
	}

	public function getCant(): int
	{
		return $this->cant;
	}

	public function setCant(int $cant)
	{
		$this->cant = $cant;
	}
    
    public function getFecha(): string
	{
		return $this->fecha;
	}

	public function setFecha(string $fecha)
	{
		$this->fecha = $fecha;
	}


    public function getFinalPrice(): string
	{
		return $this->finally_price;
	}

	public function setFinalPrice(string $finally_price)
	{
		$this->finally_price = $finally_price;
	}
}

?>
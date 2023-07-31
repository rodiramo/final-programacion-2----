<?php

namespace Classes\Models;

use PDO, Classes\DB\DB, Exception;


class Cart_Finally
{
    private int $cartFinally_id;
	private int $product_id;
	private int $user_id;
	private string $name;
	private string $price;
	private string $img;
	private int $cant;
    private string $fecha;
    private string $finally_price;


	/**
	 * 
	 * @param int $cartFinally_id
	 * 
	 * @return Cart_Finally|null
	 * 
	 */

	public function viewById(int $id): ?Cart_Finally
	{

		$db = (new DB)->getConexion();
		$query = "SELECT P.name, P.img, CF.fecha, CF.finally_price, CP.cant, CP.price, CF.cartFinally_id, CP.user_id, P.product_id FROM cart_finally CF
        INNER JOIN cartproducts_finally CP ON CF.cartFinally_id = CP.cartFinally_id
        INNER JOIN products P ON P.product_id = CP.product_id
           WHERE CP.user_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

		$cart = $stmt->fetch();

		if (!$cart) return null;

		return $cart;
	}


	public function uploadDataArray(array $row)
	{
		$this->cartFinally_id = $row['cartFinally_id'];
		$this->product_id	= $row['product_id'];
		$this->name 		= $row['name'];
		$this->user_id 		= $row['user_id'];
		$this->price 		= $row['price'];
		$this->img 		    = $row['img'];
		$this->cant			= $row['cant'];
        $this->fecha        = $row['fecha'];
        $this->finally_price= $row['finally_price'];
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
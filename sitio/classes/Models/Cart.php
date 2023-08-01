<?php

namespace Classes\Models;


use PDO;
use Classes\DB\DB;
use Exception;

class Cart extends Model
{

	private int $cart_byUser_id;
	private int $product_id;
	private int $user_id;
	private string $name;
	private string $price;
	private string $image;
	private int $cant;

	public function uploadDataArray(array $row)
	{
		$this->cart_byUser_id = $row['cart_byUser_id'];
		$this->product_id	= $row['product_id'];
		$this->name 		= $row['name'];
		$this->user_id 		= $row['user_id'];
		$this->price 		= $row['price'];
		$this->image 		= $row['image'];
		$this->cant			= $row['cant'];
	}

	/**
	 * 
	 * @param int $id
	 * 
	 * @return Cart|null
	 * 
	 */

	public function viewById(int $id): ?Cart
	{

		$db = (new DB)->getConexion();
		$query = "SELECT * FROM cart
           WHERE product_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

		$cart = $stmt->fetch();

		if (!$cart) return null;

		return $cart;
	}


	
	/**
	 * 
	 * @return Cart[]
	 * 
	 */
	public function todo(): array
	{
		$db = (new DB)->getConexion();
		$query = "SELECT c.cart_byUser_id,  c.product_id, name, user_id, c.price, img 'image', cant FROM cart c
	  			INNER JOIN products p ON c.product_id = p.product_id";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

		return $stmt->fetchAll();
	}

	public function create(array $data)
	{
		$db = DB::getConexion();
		$query = "INSERT INTO cart (user_id, product_id, cant, price) 
                VALUES (:user_id, :product_id, 1, :price)";
		$stmt = $db->prepare($query);

		$stmt->execute([
			'user_id'            => $data['user_id'],
			'product_id'               => $data['product_id'],
			'price' 			=> $data['price']
		]);
	}

	public function delete(int $cart_byUser_id)
	{
		$db = DB::getConexion();
		$query = "DELETE FROM cart WHERE cart_byUser_id = ?";
		$smt = $db->prepare($query);
		$smt->execute([$cart_byUser_id]);
	}

	public function update(int $product_id, int $price)
	{
		$db = DB::getConexion();
		$db->beginTransaction();
		try {

			$query = "UPDATE cart c SET 
			c.price = c.price + :price , 
			c.cant = c.cant + 1
				WHERE c.product_id = :product_id;";
			
			$smt = $db->prepare($query);
			
			$smt->execute([
				'product_id' 	=> $product_id,
				'price' 		=> $price
						]);
			
			$db->commit();
		} catch (Exception $e)
		{
			$db->rollBack();
		}
	}


	/********* SETTERS & GETTERS *********/
	public function getCart_byUser_id(): int
	{
		return $this->cart_byUser_id;
	}

	public function setCart_byUser_id(int $cart_byUser_id)
	{
		$this->cart_byUser_id = $cart_byUser_id;
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
		return $this->image;
	}

	public function setImage(string $image)
	{
		$this->image = $image;
	}

	public function getCant(): int
	{
		return $this->cant;
	}

	public function setCant(int $cant)
	{
		$this->cant = $cant;
	}
}

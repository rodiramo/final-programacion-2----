<?php
namespace Classes\Models;


use PDO;
use Classes\DB\DB;

class Cart extends Model {

	private int $product_id;
    private int $user_fk ;
    private string $name;
    private string $price;
    private string $image;
    

    public function uploadDataArray(array $row)
	{
		$this->product_id	= $row['id'];
		$this->name 		= $row['name'];
		$this->user_fk 		= $row['user_fk'];
		$this->price 		= $row['price'];
		$this->image 		= $row['image'];
	}

     /**
  * 
  * @return Cart[]
  * 
  */
    public function todo() :  array
{   
      $db = (new DB) -> getConexion();
      $query = "SELECT * FROM cart";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

         return $stmt->fetchAll();

}

    public function create(array $data)
    {
        $db = DB::getConexion();
        $query = "INSERT INTO cart (user_fk,  name, price, image) 
                VALUES (:user_fk, :name, :price, :image)";
        $stmt = $db->prepare($query);

        $stmt->execute([
            'user_fk'            => $data['user_fk'],
            'name'               => $data['name'],
            'price'              => $data['price'],
            'image'              => $data['image'],
        ]);
    }


	/********* SETTERS & GETTERS *********/
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
		return $this->user_fk;
	}

	public function setUserFk(int $user_fk)
	{
		$this->user_fk = $user_fk;
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

	







}
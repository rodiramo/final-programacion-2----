<?php

namespace Classes\Models;

use PDO;
use Classes\DB\DB;

class User extends Model
{
	private int $user_id;
	private int $rol_fk;
	private string $email;
	private string $password;
	private ?string $name;
	private ?string $surname;
	private ?string $avatar;

	
	protected string $table = 'users';

	public function uploadDataArray(array $row)
	{
		$this->user_id = $row['user_id'];
		$this->rol_fk = $row['rol_fk'];
		$this->email = $row['email'];
		$this->password = $row['password'];
		$this->name = $row['name'];
		$this->surname = $row['surname'];
		$this->avatar = $row['avatar'];

	}

	/**
	 * Create user
	 */
	public function newUser(array $data)
	{
		$db = DB::getConexion();
		$query = "INSERT INTO users (rol_fk, name, surname, email, password) 
				VALUES (:rol_fk, :name, :surname, :email, :password)";
		$stmt = $db->prepare($query);
		$stmt->execute([
			'rol_fk' 	=> $data['rol_fk'],
			'name' 	=> $data['name'],
			'surname' 	=> $data['surname'],
			'email' 	=> $data['email'],
			'password' 	=> $data['password'],
		]);
	}



	public function bringById(int $id): self|null
	{
		$db = (new DB)->getConexion();
		$query = "SELECT * FROM users WHERE user_id = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

		$user = $stmt->fetch();

		if(!$user) return null;

		return $user;
	}

	public function bringByEmail(string $email): self|null
	{
		$db = (new DB)->getConexion();
		$query = "SELECT * FROM users 
				WHERE email = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$email]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

		$user = $stmt->fetch();

		if(!$user) return null;

		return $user;
	}


	public function editPassword(string $password)
	{
		$db = DB::getConexion();
		$query = "UPDATE users
				SET password = :password
				WHERE user_id = :user_id";
		$stmt = $db->prepare($query);
		$stmt->execute([
			'password' => $password,
			'user_id' => $this->user_id,
		]);
	}




	/******************** Setters & Getters ********************/
	public function getUserId(): int
	{
		return $this->user_id;
	}

	public function setUserId(int $id)
	{
		$this->user_id = $id;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email)
	{
		$this->email = $email;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function setPassword(string $password)
	{
		$this->password = $password;
	}
	
	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}
	public function getSurname(): string
	{
		return $this->surname;
	}

	public function setSurname(string $surname)
	{
		$this->surname = $surname;
	}
	
	
	public function getRolFk(): int
	{
		return $this->rol_fk;
	}

	public function setRolFk(int $rol_fk)
	{
		$this->rol_fk = $rol_fk;
	}
}
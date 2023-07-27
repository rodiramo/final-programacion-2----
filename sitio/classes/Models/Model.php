<?php

namespace Classes\Models;

use PDO;
use Classes\DB\DB;

class Model
{
	/** @var string */
	protected string $table = '';

	public function todo(): array
	{
		$db = DB::getConexion();
		$query = "SELECT * FROM " . $this->table;
		$stmt = $db->prepare($query);
		
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

		return $stmt->fetchAll();
	}
}
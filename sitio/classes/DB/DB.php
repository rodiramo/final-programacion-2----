<?php

namespace Classes\DB;

use PDO;
use Exception;

class DB
{
	public const DB_HOST = 'localhost';
	public const DB_USER = 'root';
	public const DB_PASS = '';
	public const DB_NAME = 'dw3_diazramos';


	
	private static ?PDO $db = null;
	/**
	 * PDO.
	 * 
	 * @throws PDOException
	 */
	public static function getConexion(): PDO
	{
		if(self::$db === null) {
			self::$db = self::openConection();
		}

		return self::$db;
	}

	private static function openConection(): PDO
	{
		$db_dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

		try {
			return new PDO($db_dsn, self::DB_USER, self::DB_PASS);	
		} catch (Exception $e) {
			echo "Error connecting to MySQL";
			exit;
		}
	}
}
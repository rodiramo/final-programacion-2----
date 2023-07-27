<?php
namespace Classes\Models;

use PDO;
use Classes\DB\DB;

class Category
{
	private int $id_categoria;
	private string $nombre;

	public function cargarDatosDeArray(array $row)
	{
		$this->id_categoria	= $row['id_categoria'];
		$this->nombre 		= $row['nombre'];
	}

	public function getTodasParaNoticia(int $id): ?array
	{
		$db = DB::getConexion();
        $query = "SELECT e.* 
                FROM noticias_tienen_etiquetas nte
                JOIN categorias e
                ON nte.etiqueta_fk = e.id_categoria
                WHERE nte.noticia_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
	}

	public function todo(): array
	{
		$db = DB::getConexion();
		$query = "SELECT * FROM categorias";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

		return $stmt->fetchAll();
	}

	/********* SETTERS & GETTERS *********/
	public function getEtiquetaId(): int
	{
		return $this->id_categoria;
	}

	public function setEtiquetaId(int $id_categoria)
	{
		$this->id_categoria = $id_categoria;
	}

	public function getNombre(): string
	{
		return $this->nombre;
	}

	public function setNombre(string $nombre)
	{
		$this->nombre = $nombre;
	}
}
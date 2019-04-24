<?php

require_once 'model/conexion.php';
	


class Categorias extends Noticias{
	
	private $pdo;

	
	public $categoria_id;
	public $categoria_texto;

	
	public function __CONSTRUCT(){
		try{
			$this->pdo = Conexion::Conectar();     
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}


	
	public function ListarTipoCategorias()
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT * FROM categorias");

			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


}

?>
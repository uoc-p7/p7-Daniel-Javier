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

	public function VerCategoriaID($categoria_id){

		try 
            {                
                $sql = $this->pdo->prepare("SELECT categoria_texto FROM categorias WHERE categoria_id =".$categoria_id);
                $sql->execute();    
                return $sql->fetchAll(PDO::FETCH_OBJ);

            } 
            catch (Exception $e) 
            {
                die($e->getMessage());
            }

	}


}

?>
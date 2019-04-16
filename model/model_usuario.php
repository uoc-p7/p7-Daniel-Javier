<?php

require_once 'model/conexion.php';		


class Usuario{
	
	private $pdo;
	
	public $username;
	public $roles_id;
	public $nombre;
	public $password;
	public $email;
	
	public function __CONSTRUCT(){
		try{
			$this->pdo = Conexion::Conectar();     
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data){

		try {

		$sql = "INSERT INTO usuarios (username,roles_id,nombre,password,email) 
				VALUES (?, ?, ?, ?, ?)";
				
		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->username,
                    $data->roles_id, 
                    $data->nombre, 
                    $data->password,
                    $data->email
                )
			);
		} catch (Exception $e) {

			echo "Nombre de usuario duplicado, introduzca otro.<br>";
			die($e->getMessage());
		}
	}
	
}

?>
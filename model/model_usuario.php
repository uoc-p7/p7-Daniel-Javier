<?php

require_once 'model/conexion.php';		


class Usuario{
	
	private $pdo;
	
	public $username;
	public $roles_id;
	public $nombre;
	public $password;
	public $email;
	public $sesion;
	
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

	public function Validar($user){
		
		$sql = "SELECT a.username, b.roles_descripcion as roles_descripcion
		FROM usuarios a 
		INNER JOIN roles b where 
		(a.username = :username  AND a.password = :password) and a.roles_id = b.roles_id ;"; 

		$result = $this->pdo->prepare($sql); 
		$result->bindValue	(':username', $user->username, PDO::PARAM_STR);
		$result->bindValue(':password', $user->password, PDO::PARAM_STR);
		$result->execute(); 
		$count = $result->rowCount();
		$data=$result->fetch(PDO::FETCH_OBJ);
		
		if($count){
			$_SESSION['username']=$data->username;
			$sesion=$_SESSION['username'];

			$_SESSION['roles_descripcion']=$data->roles_descripcion;
			$sesionrol=$_SESSION['roles_descripcion'];

			echo "Login perfecto.<br>";
			echo "Nombre del user: ".$sesion;

			header("Location: index.php");
		}else{
			echo "Usuario no registrado.";  
		} 
	}

	
}

?>
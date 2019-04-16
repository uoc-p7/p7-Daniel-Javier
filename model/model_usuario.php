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
	
}
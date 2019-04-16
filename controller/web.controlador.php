<?php

require_once 'model/model_usuario.php';		

class WebControlador{
	
	private $usuario;

	public function __CONSTRUCT(){
		
		$this->usuario= new Usuario();

    }
    
    public function Index(){
		
        require_once 'view/header.php';
        require_once 'view/contenedor/home_index.php';
        require_once 'view/footer.php';
    }
	
	public function Registrar_usuario(){
		
		$user= new Usuario();
		
		require_once 'view/header.php';
        require_once 'view/contenedor/registro_usuarios.php';
        require_once 'view/footer.php';

	}
	
	public function Login_usuario(){
		
		$user= new Usuario();
		
		require_once 'view/header.php';
        require_once 'view/contenedor/login_usuarios.php';
        require_once 'view/footer.php';

	}

	public function Guardar_usuarios(){


		$user = new Usuario();
        
        $user->username = $_REQUEST['username'];
        $user->roles_id = $_REQUEST['roles_id'];
        $user->nombre = $_REQUEST['nombre'];
        $user->password = $_REQUEST['password'];
        $user->email = $_REQUEST['email'];

       	$this->usuario->Registrar($user);
        
        echo "Usuario registrado con exito, <a href='index.php'>volver</a>";
	}

}

?>
<?php

require_once 'model/model_usuario.php';		
require_once 'model/model_keywords.php';
require_once 'model/model_noticias.php';			

class WebControlador{
	
	private $usuario;
	private $noticia;
	private $keyword;

	public function __CONSTRUCT(){
		
		$this->usuario= new Usuario();
		$this->keyword= new Keywords();
		$this->noticia= new Noticias();

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

	public function Anadir_noticia(){
		$notice= new Noticias();
		$kw= new Keywords();
		
		if ($_SESSION["roles_descripcion"] == 'Periodista' ) {		
			
			require_once 'view/header.php';
			require_once 'view/contenedor/vista_add_noticias.php';
			require_once 'view/footer.php';
		}

		elseif ($_SESSION["roles_descripcion"] == 'Editor' ) {		
			
			echo "Necesitas tener rol Periodista para acceder a esta página";
		}

		
		else {
			header("Location: index.php?c=Web&a=Login_usuario");
		}
	}

	
	public function Iniciar_sesion(){
		
		$user = new Usuario();
		
		$user->username = $_REQUEST['username'];
		$user->password = $_REQUEST['password'];
		
		$this->usuario->Validar($user);

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



	//Controller para las kw

	public function Guardar_keyword(){

		$kw= new Keywords();

		$kw->keyword_texto = $_REQUEST['keyword_texto'];

		$this->keyword->insertarKw($kw);
	}


	//Controller para las noticias

	public function Guardar_noticia(){

		$notice= new Noticias();
		$kw= new Keywords();				
		$fecha_actual = date("Y-m-d");
		
		if ($_FILES['noticia_imagen']['size'] <> FALSE )
		{
			$image = addslashes(file_get_contents($_FILES['noticia_imagen']['tmp_name']));
			$notice->noticia_imagen = $image;
		}

		else
		{
			$notice->noticia_imagen = '';
		}

		$notice->usuario_periodista = $_SESSION['username'];
		$notice->usuario_editor= 'Pendiente';
		$notice->categoria_id = $_REQUEST['categoria_id']; ;
		$notice->noticia_titulo = $_REQUEST['noticia_titulo'];
		$notice->noticia_subtitulo = $_REQUEST['noticia_subtitulo'];
		$notice->noticia_texto = $_REQUEST['noticia_texto'];		
		$notice->fecha_creacion = $fecha_actual;
				
		$kw->keyword_texto = $_REQUEST['keyword_texto'];


		$this->noticia->insertaNoticiaPeriodista($notice);		
		$this->keyword->insertarKw($kw);

		echo "Noticia añadida con éxito, <a href='index.php'>volver</a>";
	}


}

?>


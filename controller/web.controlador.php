<?php

require_once 'model/model_usuario.php';		
require_once 'model/model_keywords.php';
require_once 'model/model_noticias.php';
require_once 'model/modelo_categorias.php';				

class WebControlador{
	
	private $usuario;
	private $noticia;
	private $keyword;
	private $categorias;

	public function __CONSTRUCT(){
		
		$this->usuario= new Usuario();
		$this->keyword= new Keywords();
		$this->noticia= new Noticias();
		$this->categorias= new Categorias();

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

	//Accedemos a un listado de las noticias pendientes

	public function Editar_noticia(){

		$notice= new Noticias();
		$kw= new Keywords();
		
		if ($_SESSION["roles_descripcion"] == 'Editor' ) {		
			
			require_once 'view/header.php';
			require_once 'view/contenedor/vista_edit_noticias.php';
			require_once 'view/footer.php';
		}

		elseif ($_SESSION["roles_descripcion"] == 'Editor' ) {		
			
			echo "Necesitas tener rol Editor para acceder a esta página";
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

		//para la carga de la imagen
		$foto = $_FILES['ruta_imagen']['name'];
		$ruta = $_FILES['ruta_imagen']['tmp_name'];
		$destino = "images/".$foto;
		copy($ruta,$destino);	


		$notice->usuario_periodista = $_SESSION['username'];
		$notice->usuario_editor= 'Pendiente';
		$notice->categoria_id = $_REQUEST['categoria_id']; ;
		$notice->noticia_titulo = $_REQUEST['noticia_titulo'];
		$notice->noticia_subtitulo = $_REQUEST['noticia_subtitulo'];
		$notice->noticia_texto = $_REQUEST['noticia_texto'];		
		$notice->fecha_creacion = $fecha_actual;
		$notice->ruta_imagen = $destino;		
		$kw->keyword_texto = $_REQUEST['keyword_texto'];


		$this->noticia->insertaNoticiaPeriodista($notice);		
		$this->keyword->insertarKw($kw);

		echo "Noticia añadida con éxito, <a href='index.php'>volver</a>";
	}

	//Accedemos a la página donde editamos la noticia seleccionada

	public function Vistaeditarpendiente(){

		$notice= new Noticias();

		if(isset($_REQUEST['noticia_id'])){
            $notice = $this->noticia->Obtener($_REQUEST['noticia_id']);
        }

		require_once 'view/header.php';
		require_once 'view/contenedor/vista_edit_noticias2.php';
		require_once 'view/footer.php';
	}

	//Cambiamos los datos de la noticia pendiente

	public function Actualizar_noticia(){

		$notice= new Noticias();
		$fecha_mod = date("Y-m-d");


		//para la carga de la imagen
		$foto = $_FILES['ruta_imagen']['name'];
		$ruta = $_FILES['ruta_imagen']['tmp_name'];
		$destino = "images/".$foto;
		copy($ruta,$destino);

        $notice->noticia_id = $_REQUEST['noticia_id'];
        $notice->noticia_titulo = $_REQUEST['noticia_titulo'];
        $notice->noticia_subtitulo = $_REQUEST['noticia_subtitulo'];
		$notice->noticia_texto = $_REQUEST['noticia_texto'];
		$notice->usuario_editor= $_SESSION['username'];
		$notice->fecha_modificacion = $fecha_mod;
		$notice->ruta_imagen= $destino;



        $this->noticia->Modificar_not_pendiente($notice);
        
        header('Location: index.php');


	}

	//Eliminar noticia.

	public function Eliminarnoticia(){

		$this->noticia->Eliminar_noticia($_REQUEST['noticia_id']);
        header('Location: index.php');

	}

	public function ListarMenuCategorias(){
		
		$cat = new Categorias();
		
		$this->cat->ListarTipoCategorias();
	}
	

	public function VerNoticiasCategorias(){

        $notcatsel = new Noticias();
  

        
        if(isset($_REQUEST['categoria_id'])){
            $notcatsel = $this->noticia->ObtenerNoticiaCategoria($_REQUEST['categoria_id']);           
            
        require_once 'view/header.php';
        require_once 'view/contenedor/vista_categoria_noticias.php';
        require_once 'view/footer.php';
 
        }
        else {
			header("Location: index.php?c=Web&a=Login_usuario");
		}
    }


	


}

?>


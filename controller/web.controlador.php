<?php

require_once 'model/model_usuario.php';		
require_once 'model/model_keywords.php';
require_once 'model/model_noticias.php';
require_once 'model/modelo_categorias.php';
require_once 'model/model_noticias_keywords.php';
require_once 'model/conexion.php';				

class WebControlador{
	
	private $usuario;
	private $noticia;
	private $keyword;
	private $categorias;
	private $pdo;
	private $noticias_keywords;

	public function __CONSTRUCT(){
		
		$this->usuario= new Usuario();
		$this->keyword= new Keywords();
		$this->noticia= new Noticias();
		$this->categorias= new Categorias();
		$this->noticias_keywords= new Noticias_keywords();
		$this->pdo = Conexion::Conectar(); 

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

		elseif ($_SESSION["roles_descripcion"] != 'Periodista' ) {		
			
			echo "<center>Necesitas tener rol Periodista o ser Goku para acceder a esta página. <a href='index.php'>Volver</a><br><br><img src='images/no.webp' alt='no'></center>";
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

		elseif ($_SESSION["roles_descripcion"] != 'Editor' ) {		
			
			echo "<center>Necesitas tener rol Editor o ser Goku para acceder a esta página. <a href='index.php'>Volver</a><br><br><img src='images/no.webp' alt='no'></center>";
		}

		
		else {
			header("Location: index.php?c=Web&a=Login_usuario");
		}
	}


	
	public function Iniciar_sesion(){
		
		$user = new Usuario();
		
		$user->username = $_REQUEST['username'];
		$pwd = $_REQUEST['password'];
		$password = sha1($pwd);
		$user->password = $password;
		
		$this->usuario->Validar($user);

	}
	
	public function Guardar_usuarios(){


		$user = new Usuario();
        
        $user->username = $_REQUEST['username'];
        $user->roles_id = $_REQUEST['roles_id'];
        $user->nombre = $_REQUEST['nombre'];
		$pwd = $_REQUEST['password'];
		$password = sha1($pwd);		
		$user->password = $password ;
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
		$notice_kw = new Noticias_keywords();			
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

		
		try {

		//iniciamos transacción. 
			$this->pdo->beginTransaction();

			//inserta las noticia
			$this->noticia->insertaNoticiaPeriodista($notice);
			
			//obtiene id de última noticia insertada
			$lastidnoticia = $this->noticia->GetUltimaNoticiaInsertada();

			//inserta cada palabra clave en una fila
			$palabrasclave =  explode(",",$_REQUEST["keyword_texto"]);	
			foreach ($palabrasclave as $valor) {
				$kw->keyword_texto = ltrim(strtolower(($valor)));	
				$this->keyword->insertarKw($kw);		

				//obtiene id's de las últimas kw insertadas
				$lastidkeyword=$this->keyword->UltimaKwInsertada();
	
				//inserta id's de noticias y keywords en noticias_keyword
				$this->noticias_keywords->InsertaIdKwNoticaKeywords($lastidnoticia,$lastidkeyword);
								
			}

			$this->pdo->commit();

		} catch (Exception $e) {
                
			$this->pdo->rollBack();		

			echo "Error en la inserción de la noticia<br>";
			die($e->getMessage());
		}

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
	

	public function Admin(){

        $user = new Usuario();

        if ($_SESSION["roles_descripcion"] == 'Administración' ) {		
			
			require_once 'view/header.php';
			require_once 'view/contenedor/vista_admin.php';
			require_once 'view/footer.php';

		}elseif($_SESSION["roles_descripcion"] != 'Administración' ){

			echo "<center>Necesitas tener rol Administrador o ser Goku para acceder a esta página.  <a href='index.php'>Volver</a><br><br><img src='images/no.webp' alt='no'></center>";
		}
		
		else {

			header("Location: index.php?c=Web&a=Login_usuario");
		}
	}
	
	public function Administracion_user(){

        $user = new Usuario();

        if ($_SESSION["roles_descripcion"] == 'Administración' ) {		
			
			require_once 'view/header.php';
			require_once 'view/contenedor/vista_administracion_usuarios.php';
			require_once 'view/footer.php';

		}elseif($_SESSION["roles_descripcion"] != 'Administración' ){

			echo "<center>Necesitas tener rol Administrador o ser Goku para acceder a esta página. <a href='index.php'>Volver</a><br><br><img src='images/no.webp' alt='no'></center>";
		}
		
		else { 

			header("Location: index.php?c=Web&a=Login_usuario");
		}
    }

	public function Editar_Usuario(){

		$user = new Usuario();
        
        if(isset($_REQUEST['username'])){
            $user = $this->usuario->Obtener_usuario($_REQUEST['username']);
        }
        
        require_once 'view/header.php';
        require_once 'view/contenedor/vista_editar_usuario.php';
        require_once 'view/footer.php';

	}

	public function Guardar_Usuario(){

        $user = new Usuario();
        
        $user->roles_id = $_REQUEST['roles_id'];
		$user->nombre = $_REQUEST['nombre'];
        $user->password = $_REQUEST['password'];
		$user->email = $_REQUEST['email'];
		$user->username = $_REQUEST['username'];


        $this->usuario->Actualizar_usuario($user);
        
        header("Location: index.php?c=Web&a=Admin");

	}
	
	public function Eliminar_Usuario(){

        $this->usuario->Eliminar_user($_REQUEST['username']);
        header("Location: index.php?c=Web&a=Admin");

    }

	public function Administracion_not(){

		$notice= new Noticias();
        if ($_SESSION["roles_descripcion"] == 'Administración' ) {		
			
			require_once 'view/header.php';
			require_once 'view/contenedor/vista_administracion_noticias.php';
			require_once 'view/footer.php';
			
		}elseif($_SESSION["roles_descripcion"] != 'Administración' ){

			echo "<center>Necesitas tener rol Administrador o ser Goku para acceder a esta página. <a href='index.php'>Volver</a><br><br><img src='images/no.webp' alt='no'></center>";
		}
		
		else {
			header("Location: index.php?c=Web&a=Login_usuario");
		}

	}

	public function Editar_Noticia_Admin(){

		$notice = new Noticias();
        
        if(isset($_REQUEST['noticia_id'])){
            $notice = $this->noticia->Obtener_noticias_admin($_REQUEST['noticia_id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/contenedor/vista_editar_noticias_admin.php';
        require_once 'view/footer.php';

	}

	public function Editar_Noticia_Add(){

		$notice = new Noticias();

		$foto = $_FILES['ruta_imagen']['name'];
		$ruta = $_FILES['ruta_imagen']['tmp_name'];
		$destino = "images/".$foto;
		copy($ruta,$destino);
        

		$notice->noticia_id = $_REQUEST['noticia_id'];
        $notice->noticia_titulo = $_REQUEST['noticia_titulo'];
        $notice->noticia_subtitulo = $_REQUEST['noticia_subtitulo'];
		$notice->noticia_texto = $_REQUEST['noticia_texto'];
		$notice->categoria_id= $_REQUEST['categoria_id'];
		$notice->ruta_imagen= $destino;

        $this->noticia->Actualizar_not_admin($notice);
        
        header("Location: index.php?c=Web&a=Admin");

	}


}

?>


<?php

require_once 'model/conexion.php';
require_once 'model/model_keywords.php';			

    class  Noticias {

        private $pdo;

        public $noticia_id;
        public $usuario_periodista;
        public $usuario_editor;
        public $categoria_id;
        public $noticia_titulo;
        public $noticia_subtitulo;
        public $noticia_texto;
        public $notica_imagen;
        public $fecha_creacion;
        public $fecha_modificacion;
        public $fecha_publicacion; 
        public $ruta_imagen;
        public $keyword_texto;    

        public function __CONSTRUCT(){
            try{
                $this->pdo = Conexion::Conectar();     
            }
            catch(Exception $e){
                die($e->getMessage());
            }
        }
        


        public function insertaNoticiaPeriodista (Noticias $data){

            try {            
                    
                $sql = "INSERT INTO noticias (usuario_periodista,usuario_editor,categoria_id,noticia_titulo,noticia_subtitulo,noticia_texto,ruta_imagen,fecha_creacion) 
                VALUES (?,?,?,?,?,?,?,?)";
                        
                $this->pdo->prepare($sql)
                    ->execute(
                        array(
                            $data->usuario_periodista,
                            $data->usuario_editor,
                            $data->categoria_id,
                            $data->noticia_titulo,
                            $data->noticia_subtitulo,
                            $data->noticia_texto,
                            $data->ruta_imagen,
                            $data->fecha_creacion
                            
                        )
                    );
                  
                } catch (Exception $e) {   
                    echo "Error creando noticia<br>";
                    die($e->getMessage());
                }
        }

        //función que obtiene el id de la última noticia insertada
        public function GetUltimaNoticiaInsertada (){
            $lastInsertIdNoticia = $this->pdo->lastInsertId(); 
            return $lastInsertIdNoticia;            
        }




        //Listado de noticias pendientes

        public function Listarpendientes(){

            try{
			        $result = array();
			        $sql = $this->pdo->prepare("SELECT * FROM noticias WHERE usuario_editor='pendiente'");
			        $sql->execute();
			        return $sql->fetchAll(PDO::FETCH_OBJ);
		        }catch(Exception $e){
                    die($e->getMessage());
		        }

        }

        //Obtenemos la noticia pendiente seleccionada a través de la noticia_id

        public function Obtener($noticia_id){
        
            try{ 
			        $sql = $this->pdo->prepare("SELECT * FROM noticias WHERE noticia_id = ?");
			        $sql->execute(array($noticia_id));
			        return $sql->fetch(PDO::FETCH_OBJ);
		        } catch (Exception $e) {
			        die($e->getMessage());
		        }
        }
        
        public function Modificar_not_pendiente($data){

            try{
			        $sql = "UPDATE noticias SET 
						noticia_titulo = ?, 
						noticia_subtitulo = ?,
                        noticia_texto = ?,
                        usuario_editor = ?,
                        ruta_imagen = ?,
                        fecha_modificacion = ?
				    WHERE noticia_id = ?";

			    $this->pdo->prepare($sql)
			        ->execute(
				        array(
                            $data->noticia_titulo, 
                            $data->noticia_subtitulo,
                            $data->noticia_texto,
                            $data->usuario_editor,
                            $data->ruta_imagen,
                            $data->fecha_modificacion,
                            $data->noticia_id
					    )
				    );
		        } catch (Exception $e) {
			        die($e->getMessage());
		            }
        }

        public function Eliminar_noticia($noticia_id){

            try {
			    $sql = $this->pdo
			            ->prepare("DELETE FROM noticias WHERE noticia_id = ?");			          

			    $sql->execute(array($noticia_id));
		    } catch (Exception $e) {
			    die($e->getMessage());
		    }
        }

        public function ObtenerNoticiaCategoria($categoria_id)
        {
            try 
            {                
                $stm = $this->pdo->prepare("SELECT a.noticia_id, b.categoria_id as descripcion_categoria, a.usuario_periodista, a.usuario_editor, a.noticia_titulo, a.noticia_subtitulo, a.noticia_texto, a.ruta_imagen, 
                (select  GROUP_CONCAT(d.keyword_texto SEPARATOR ', ')) as keyword_texto
                FROM noticias a 
                inner join categorias b
                inner join noticias_keyword c
                inner join keywords d
                where a.categoria_id = b.categoria_id 
                and a.noticia_id = c.noticia_id
                and c.keyword_id = d.keyword_id
                and a.categoria_id = '$categoria_id' ");
    
                $stm->execute();    
                return $stm->fetchAll(PDO::FETCH_OBJ);

            } 
            catch (Exception $e) 
            {
                die($e->getMessage());
            }
        }

        public function Listar_noticias_admin(){

            try{
                $result = array();
                $sql = $this->pdo->prepare("SELECT * FROM noticias");
                $sql->execute();
                return $sql->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
    
        }

        public function Obtener_noticias_admin($noticia_id){

            try{
                $sql = $this->pdo
                    ->prepare("SELECT * FROM noticias WHERE noticia_id = ?");         
                    $sql->execute(array($noticia_id));
                return $sql->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
    
        }

        public function Actualizar_not_admin($data){

            try{
                $sql = "UPDATE noticias SET 
                            noticia_titulo = ?,
                            noticia_subtitulo = ?,
                            noticia_texto = ?,
                            categoria_id = ?,
                            ruta_imagen = ?
                        WHERE noticia_id = ?";
    
                $this->pdo->prepare($sql)
                     ->execute(
                        array(
                            $data->noticia_titulo,
                            $data->noticia_subtitulo,
                            $data->noticia_texto,
                            $data->categoria_id,
                            $data->ruta_imagen,
                            $data->noticia_id
    
                        )
                    );
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }




}



  
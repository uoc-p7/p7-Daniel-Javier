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
    
                
                $sql = "INSERT INTO noticias (usuario_periodista,usuario_editor,categoria_id,noticia_titulo,noticia_subtitulo,noticia_texto,noticia_imagen,fecha_creacion) 
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
                            $data->noticia_imagen,
                            $data->fecha_creacion
                        )
                    );
                } catch (Exception $e) {
    
                    echo "Error creando noticia<br>";
                    die($e->getMessage());
                }
        }
    }



  
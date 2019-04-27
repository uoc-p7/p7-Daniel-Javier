<?php

require_once 'model/conexion.php';		

    class Noticias_keywords {

    private $pdo;
    public $noticia_id;
    public $keyword_id;

  

    public function __CONSTRUCT(){
        try{
            $this->pdo = Conexion::Conectar();     
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }



    //función que inserta ids de keywors y noticias
    //en la tabla noticias_keywords para relacionarla con las noticias
    public function InsertaIdKwNoticaKeywords ($noticia_id,$keyword_id){

        try {            
            $sql = $this->pdo->prepare("INSERT INTO noticias_keyword (noticia_id,keyword_id) VALUES (?,?)");    
            $sql->execute(array($noticia_id, $keyword_id));
            } catch (Exception $e) {
                   
                echo "Error<br>";
                die($e->getMessage());
             }
    }

}
?>


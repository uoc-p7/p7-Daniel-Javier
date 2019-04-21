<?php

require_once 'model/conexion.php';		

    class Keywords {

    private $pdo;

    public $keyword_id;
    public $keyword_texto;
  

    public function __CONSTRUCT(){
        try{
            $this->pdo = Conexion::Conectar();     
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    
    public function insertarKw (Keywords $data){
        try {
            
            $sql = "INSERT INTO keywords (keyword_texto) VALUES (?);";
                    
            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->keyword_texto
                    )
                );
            } catch (Exception $e) {
                echo "Error<br>";
                die($e->getMessage());
            }
    }
    
    
    

}


?>


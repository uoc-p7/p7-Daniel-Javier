<?php

class WebControlador{

	public function __CONSTRUCT(){

    }
    
    public function Index(){
        require_once 'vista/header.php';
        require_once 'vista/contenedor/index.php';
        require_once 'vista/footer.php';
    }
}

?>
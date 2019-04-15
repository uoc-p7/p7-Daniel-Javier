<?php

$controller = 'web';

// Si no tenemos declarada la variable c iniciamos el Index
if(!isset($_REQUEST['c'])) {
    require_once "controlador/$controller.controlador.php";
    $controller = ucwords($controller) . 'Controlador';
    $controller = new $controller;
    $controller->Index();    
}
else {
    
}
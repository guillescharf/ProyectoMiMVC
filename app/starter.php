<?php

    //Cargamos todas nuestras librerias
    require_once('config/config.php');

    //Autoload de librerias 
    spl_autoload_register(function($className){
        require_once 'libs/' . $className . '.php';
    });

?>
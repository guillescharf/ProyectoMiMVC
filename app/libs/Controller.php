<?php

    //Se encarga de cargar los modelos y las vistas
    class Controller{
        //cargar modelo
        public function model($model){
            require_once "../app/models/" . $model . ".php";
            return new $model();
        }

        public function view($view, $data=[]){
            //corroboro si existe la vista
            if(file_exists("../app/views/" . $view . ".php")){
                require_once "../app/views/" . $view . ".php";
            }else{
                die("View not found");
            }
        }        
    }

?>
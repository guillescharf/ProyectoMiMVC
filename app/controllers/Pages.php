<?php

    class Pages extends Controller{

        public function __construct(){
            
        }

        public function index(){
            $datos = [
                'titulo' => "Bienvenidos a mi MVC"
            ];
            $this->view("pages/home", $datos);
        }

    }
?>
<?php
    /*
    Mapear la URL ingresada en el navegador...
    1- controlador
    2- metodo
    3- parametro
    */

    class Core{
        protected $CurrentController = "Pages";
        protected $ControllerFile = '../app/controllers/Pages.php';
        protected $CurrentMethod = "index";
        protected $CurrentParam = [];

        public function __construct(){
            $url = $this->getURL();

            //si hay parametros en la URL, Busco controlador y metodos asociados
            if($url){                
                //Busco si existe el controlador asociado a la url
                if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                    $controllerName = ucwords($url[0]);
                    $controllerFile = '../app/controllers/' . $controllerName . '.php';                 
                    $this->CurrentController = $controllerName;                
                    unset($url[0]);
                }
            }

            //requiero el controlador a utilizar
            require_once($this->ControllerFile);

            //Instancio la clase a utilizar
            $this->CurrentController = new $this->CurrentController;

            if(isset($url[1])){
                //chequear la segunda parte de la url que seria el metodo
                if(method_exists($this->CurrentController, $url[1])){
                    $this->CurrentMethod = $url[1];
                    unset($url[1]);
                }                
            }

            //obtengo lso parametros pasados
            $this->CurrentParam = $url ? array_values($url) : [];
            call_user_func_array([$this->CurrentController, $this->CurrentMethod], $this->CurrentParam);
        }

        public function getURL(){
            
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }

    }

?>
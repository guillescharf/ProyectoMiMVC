<?php
    class DataBase{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASS;
        private $database = DB_NAME;

        private $dvh;  //Data Base Handler
        private $stmt;  //Statement
        private $error;

        public function __construct(){
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try{
                $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
                $this->dbh->exec('set names utf8');
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }
        //Preparamos la cunsulta
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }
            }

            $this->stmt->bindValue($param, $value, $type);
            
        }
        //Ejecutamos la consulta
        public function execute(){
            return $this->stmt->execute();
        }
        //obtener todos los registros
        public function rows(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);            
        }
        // Obtener un solo registro
        public function row(){
            $this->execute();            
            return $this->stmt->fetch(PDO::FETCH_OBJ);            
        }
        // Obtener cantidad de registros
        public function rowCount(){
            return $this->stmt-rowCount();
        }



    }
?>
<?php 

    class Database {
        
        // database properties
        private $host = 'localhost';
        private $username = 'root';
        private $password = '##########';
        private $database_name = '## database_name ##';
        private $conn;


        // connect to db
        public function db_connect()
        {
            try {

                // create an instance of PDO 
                $this->conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->database_name, $this->username, $this->password);

                // how to handle errors => throw them as exceptions
                $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            } catch (PDOException $ex) {

                // handle exceptions
                echo 'Error pccured: ' . $ex->getMessage();

                die();
            
            }
            
            return $this->conn;
        }
    }
?>
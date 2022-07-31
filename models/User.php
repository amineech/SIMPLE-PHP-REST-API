<?php 

    // User model
    class User {

        // database access property
        private $conn;

        // properties
        public $id;
        public $lastname;
        public $firstname;
        public $age;
        public $status;

        // constructor 
        public function __construct( $database ) {
            $this->conn = $database;
        }

        // all users 
        public function get_users() {
            
            // query
            $query = "select * from users";

            // prepare the query
            $sql = $this->conn->prepare($query);

            // execute the query
            $sql->execute();

            // number of rows returned
            $rows = $sql->rowCount();

            $users = array();

            if($rows> 0) {
                while($user = $sql->fetch(PDO::FETCH_ASSOC)){
                    $row = [
                        'id' => $user['id'],
                        'lastname' => $user['nom'],
                        'firstname' => $user['prenom'],
                        'age' => $user['age'],
                        'status' => $user['marie']
                    ];
                    array_push($users, $row);
                }
            }

            return $users;
        }

        // user by id
        public function user_by_id($id) {

            // query
            $query = 'select * from users where id = ?';

            // prepare the query
            $sql = $this->conn->prepare($query);

            // execute the query
            $sql->execute([ $id ]);

            // number of rows returned
            $row = $sql->rowCount();

            $user = array();

            if($row > 0) {

                $result = $sql->fetch(PDO::FETCH_ASSOC);

                // change column's names
                $user['id'] = $result['id'];
                $user['lastname'] = $result['nom'];
                $user['firstname'] = $result['prenom'];
                $user['age'] = $result['age'];
                $user['status'] = $result['marie'];

            } else {
                $user = null;
            }

            return $user;
        }

        // delete user by id
        public function delete_by_id($id) {

            // first query 
            $query = 'select * from users where id = ?';

            // prepare the first query
            $sql = $this->conn->prepare($query);

            // execute the first query
            $sql->execute([ $id ]);

            $user_status = false;

            if($sql->rowCount() > 0){

                // user exists
                $user_status = true;

                // second query
                $query = 'delete from users where id = ?';

                // prepare the second query
                $sql= $this->conn->prepare($query);

                // execute the second query
                $sql->execute([ $id ]);
            }

            return $user_status;
        }

        // add user
        public function add_user() {
            
            // query 
            $query = 'insert into users (nom, prenom, age, marie) values (?, ?, ?, ?)';

            // prepare the query
            $sql = $this->conn->prepare($query);
            
            /* * some explanation:
            * htmlspecialchars(): converts some predefined characters to HTML entities.
            * strip_tags(): string a string from HTML tags 
            */

            // data cleaning
            $this->lastname = htmlspecialchars(strip_tags($this->lastname));
            $this->firstname = htmlspecialchars(strip_tags($this->firstname));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->status = htmlspecialchars(strip_tags($this->status));
            
            // bind parameters
            $sql->bindParam(1, $this->lastname, PDO::PARAM_STR);
            $sql->bindParam(2, $this->firstname, PDO::PARAM_STR);
            $sql->bindParam(3, $this->age, PDO::PARAM_INT);
            $sql->bindParam(4, $this->status, PDO::PARAM_BOOL);

            // execute the query
            if($sql->execute()) 
                return true;

            // if execution goes wrong
            $errors = $sql->erroInfo();
            
            echo '<pre>';
            print_r($errors);
            echo '</pre>';

            return false;                
        }

        // update user
        public function update_user() {

            // query 
            $query = 'update users set nom = ?, prenom = ?, age = ?, marie = ? where id = ?';

            // prepare the query
            $sql = $this->conn->prepare($query);

            /* * some explanation:
            * htmlspecialchars(): converts some predefined characters to HTML entities.
            * strip_tags(): string a string from HTML tags 
            */

            // data cleaning
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->lastname = htmlspecialchars(strip_tags($this->lastname));
            $this->firstname = htmlspecialchars(strip_tags($this->firstname));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->status = htmlspecialchars(strip_tags($this->status));

            // bind parameters
            $sql->bindParam(1, $this->lastname, PDO::PARAM_STR);
            $sql->bindParam(2, $this->firstname, PDO::PARAM_STR);
            $sql->bindParam(3, $this->age, PDO::PARAM_INT);
            $sql->bindParam(4, $this->status, PDO::PARAM_BOOL);
            $sql->bindParam(5, $this->id, PDO::PARAM_INT);

            // execute the query
            if($sql->execute()) 
                return true;

            // if execution goes wrong
            $errors = $sql->erroInfo();
            
            echo '<pre>';
            print_r($errors);
            echo '</pre>';

            return false; 
        }
    }
?>
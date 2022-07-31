<?php 

    // database
    include('../config/db.php');

    // model
    include('../models/User.php');

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $db_instance = new Database();

        $db = $db_instance->db_connect();

        $User = new User($db);

        $deleted = $User->delete_by_id($id);

        // output
        echo $deleted ? 'user deleted successfully !' : 'no user with id = ' . $id . ' is found !';
    }

?>
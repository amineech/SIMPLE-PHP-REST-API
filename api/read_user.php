<?php 

    // database
    include("../config/db.php");
    
    // model
    include('../models/User.php');

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $db_instance = new Database();

        $db = $db_instance->db_connect();

        $User = new User($db);

        // get user
        $user = $User->user_by_id($id);

        // output
        echo $user === null ? 'no user with id = ' . $id . ' is found' :  json_encode($user, JSON_PRETTY_PRINT);
    }
?>
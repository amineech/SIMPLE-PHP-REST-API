<?php 

     // database
     include('../config/db.php');

     // model
     include('../models/User.php');

     $db_instance = new Database();

     $db = $db_instance->db_connect();

     $User = new User($db);

    // get all users 
     $users = $User->get_users();

    // output
     echo count($users) > 0 ? json_encode($users, JSON_PRETTY_PRINT) : 'no users found !';
?>
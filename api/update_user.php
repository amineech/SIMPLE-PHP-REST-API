<?php

    // database
    include('../config/db.php');

    // model
    include('../models/User.php');

    $db_instance = new Database();

    $db = $db_instance->db_connect();

    /**
     * the 'php://' along with file_get_contents() function help 
     * us receive JSON data as a file and read it into a string
     * 
     * json_decode() function helps us to decode the JSON string
    */

    // post request's body load (raw data)
    $json_data = file_get_contents('php://input');
        
    // decode the json string 
    $data = json_decode($json_data);

    $User = new User($db);

    // set User properties
    $User->id = $data->id;
    $User->lastname = $data->lastname;
    $User->firstname = $data->firstname;
    $User->age = $data->age;
    $User->status = $data->status;

    // update user
    if($User->update_user())
        echo 'User updated !';
    else
        echo 'Error occured, please try again !';

?>

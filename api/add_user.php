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

    // fill User properties
    $User->lastname = $data->firstname;
    $User->firstname = $data->lastname;
    $User->age = intval($data->age);
    $User->status = $data->status;

    // add user
    if($User->add_user())
        echo 'User added !'; 
    else 
        echo 'Error occured, please try again !'; 

?>
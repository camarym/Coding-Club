<?php

    $serverName = 'localhost';
    $username = 'hcifactors_camary';
    $password = 'Camary1234!';
    $database = 'hcifactors_camary';
    $bool_connected = false;


    // Establish the connection
    $conn = mysqli_connect($serverName, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        echo 'Connection failed: please email error message "' . mysqli_connect_error() . '" to info@hcifactors.com';
        $bool_connected = false;
    } else {
        $bool_connected = true;
    }

?>
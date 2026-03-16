<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "itbloggersdb";

    $Connection = new mysqli($host, $user, $pass, $db);
    if(!$Connection){
        die("Error Connecting to DataBase: ". $Connection->connect_error);
    }
?>
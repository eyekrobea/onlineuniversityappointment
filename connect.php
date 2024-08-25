<?php

//! implement with PDO 

$server = "localhost";
$user = "root";
$password = "";
$db_name = "online-uni";

try {
    $conn = new PDO("mysql:host=$server;dbname=$db_name", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
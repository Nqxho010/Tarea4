<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "usuarios_db";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    die("Conexio fallida");
} 


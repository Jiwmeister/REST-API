<?php
$host = 'localhost';
$user = 'root';
$pass = '1234';
$db   = 'modul9';

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die('connection failed:' . $conn->connect_error);
}
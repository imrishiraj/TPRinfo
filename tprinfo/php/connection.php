<?php

//localhost
$servername = "localhost";
$username = "root";
$dbname = "tprinfo";
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Live Server
/*
$servername = "localhost";
$username = "admintapkey";
$password = "admin@tapkey";
$dbname = "tapkey";
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
*/

?>
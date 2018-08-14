<?php

$conn = new mysqli("localhost", "root", "", "sahara_assessment");

$conn = new mysqli('localhost', 'root', '', 'sahara_assessment');
	if($conn->connect_error){
	   die("Connection failed: " . $conn->connect_error);
	}

$host   = 'localhost';
$dbname = 'sahara_assessment';
$username = "root";
$password = "";
$conn = new PDO('mysql:host=localhost;dbname=sahara_assessment', $username, $password) or die ("connection_failed");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            

?>
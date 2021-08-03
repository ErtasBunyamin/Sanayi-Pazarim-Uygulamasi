<?php
$username = "root";
$password = "12345678";
$sunucu	= "localhost";
$database = "sanayi_pazarim";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection Succesfuliy"






?>
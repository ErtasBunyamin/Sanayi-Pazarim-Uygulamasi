<?php
function OpenCon()
{
    $username = "root";
    $password = "12345678";
    $sunucu = "localhost";
    $database = "sanayi_pazarim";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$database) or die("Connect failed: %s\n". $conn -> error);
    //echo "Connection Succesfully";
    return $conn;
}
function CloseCon($conn)
{
    $conn -> close();
}
?>
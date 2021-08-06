<?php 
session_start();
if(!isset($_SESSION['loggedinAdmin']) && $_SESSION['loggedinAdmin'] != TRUE){
	header("location: login.php");
	exit();
}
 ?>
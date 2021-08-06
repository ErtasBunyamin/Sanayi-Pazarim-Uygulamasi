<?php
session_start();
unset($_SESSION["loggedinAdmin"]);
unset($_SESSION["id"]);
unset($_SESSION["name"]);
header("location: login.php");
exit();
?>
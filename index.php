<?php 
require "includes/connection.php";
session_start();
if (!$_SESSION['username']){
    header("Location: register.php");
    die();
}
?>

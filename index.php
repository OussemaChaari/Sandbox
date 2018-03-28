<?php 
require "includes/connection.php";
session_start();
/*if ($_SESSION['loggedIn']==true){
    header("Location: Register.php");
    die();
}else{*/
    echo "Hello ". $_SESSION['fname'];

?>
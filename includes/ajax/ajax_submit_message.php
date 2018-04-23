<?php
session_start();
$root=$_SERVER['DOCUMENT_ROOT']."/Social/public";
require "$root/includes/connection.php";
require "$root/includes/classes/Message.php";
require "$root/includes/classes/User.php";

var_dump($_POST['msgBody']);

$message = new Message($con,$_SESSION["username"],$_SESSION['userPosts']);
$message->submitMessage($_POST['msgBody']);

?>
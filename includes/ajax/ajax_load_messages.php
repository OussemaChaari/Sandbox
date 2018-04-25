<?php
session_start();
$root=$_SERVER['DOCUMENT_ROOT']."/Social/public";
require "$root/includes/connection.php";
require "$root/includes/classes/Message.php";
require "$root/includes/classes/User.php";

$max = 5;
$user=$_SESSION['username'];

$user=$_SESSION['username'];
if (isset($_POST['msger']) && !empty($_POST['msger'])) 
    $otherUser=$_POST['msger'];
else
    $otherUser=$_SESSION['userPosts'];

$messages = new Message($con,$user,$otherUser);
$messages->loadMessages($max-1,$_POST["convPage"],$user,$otherUser);

$_POST['msger']="";

?>
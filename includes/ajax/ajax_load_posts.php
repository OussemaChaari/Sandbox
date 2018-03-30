<?php
session_start();
$root=$_SERVER['DOCUMENT_ROOT']."/Social/public";
require "$root/includes/connection.php";
require "$root/includes/classes/User.php";
require "$root/includes/classes/Post.php";

$max = 10;

$posts = new Post($con,$_REQUEST['username']);
$posts->LoadPosts($max,$_REQUEST['page']);

?>
<?php 
    echo "LOGGIN OUT";
    session_start();
    session_destroy();
    header("Location: ../../register.php");
?>
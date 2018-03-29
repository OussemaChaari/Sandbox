<?php 

function validate($input)
{
    return strtolower(trim(stripslashes(htmlspecialchars($input))));
}

function checkLength($str,$minNum,$maxNum){
    return (strlen($str)>=$minNum && strlen($str)<=$maxNum);              
}

?>
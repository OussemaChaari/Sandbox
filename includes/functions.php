<?php 

function validate($input)
{
    return strtolower(trim(stripslashes(htmlspecialchars($input))));
}

?>
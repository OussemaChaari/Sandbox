<?php 

function validate($input)
{
    return strtolower(trim(stripslashes(htmlspecialchars($input))));
}

function checkLength($str,$minNum,$maxNum){
    return (strlen($str)>=$minNum && strlen($str)<=$maxNum);              
}

function userExists($con,$usertoCheck){
    $query=mysqli_query($con,"SELECT * FROM users WHERE username='$usertoCheck'");
    $result= mysqli_fetch_assoc($query);
    if ($result)
        return true;
    else
        return false;
}

function getTimeFrame($dateAdded){
    $str="";
    $now=date("Y-m-d H:i:s");
    $start= new DateTime($dateAdded);
    $end = new DateTime($now);
    $interval = $start->diff($end);
    if($interval->m >=1)
        $str = $interval->m==1? "1 month": $interval->m . " months";
    elseif($interval->d >= 1)
        $str = $interval->d ==1? "1 day": $interval->d . " days";
    elseif($interval->h>= 1)
        $str= $interval->h==1 ? "1 hour": $interval->h . " hours";
    elseif($interval->i>=1)
        $str= $interval->i==1? "1 minute": $interval->i . " minutes";
    $str.= empty($str)? "Just now": " ago";
    return $str;
}
?>
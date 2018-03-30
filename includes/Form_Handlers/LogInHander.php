<?php
    $loginErrors=[];

 if (isset($_POST['login_btn'])){
    $login_email=validate($_POST['login_email']);
    
    $login_pw=htmlentities(trim($_POST['login_password']));


    if(empty($login_email) || empty($login_pw)){
        array_push($loginErrors,"Email/Password Cannot be empty");
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($loginErrors,"Incorrect email format");
    }elseif($login_email){
        $query="SELECT * FROM users WHERE email='$login_email'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result) ==1){
            $result=mysqli_fetch_assoc($result);
            $pwCheck=password_verify($login_pw,$result['pw']);
            if($pwCheck){
                $_SESSION['username']=$result['username'];
                header('Location: index.php');
            }else{
                array_push($loginErrors,"Wrong Password, Are you $login_email ?");
            }
        }else{
            array_push($loginErrors,"User $login_email doesn't exist");
        }
    }
 }


?>
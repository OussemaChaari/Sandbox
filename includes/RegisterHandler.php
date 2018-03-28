<?php 

$fname = $lname = $email = $email2 = $pw = $pw2 = $result = $username= "";
$regErrors =$successMsgs= [];


if (isset($_POST['register'])) {
    $username= validate($_POST['reg_user']);
    $fname = validate($_POST['reg_fname']);
    $lname = validate($_POST['reg_lname']);
    $email = validate($_POST['reg_email']);
    $email2 = validate($_POST['reg_email2']);
    $pw = trim($_POST['reg_pw']);
    $pw2 = trim($_POST['reg_pw2']);
    empty($fname) ? array_push($regErrors, "First Name Field is required") : $_SESSION['fname'] = $fname;
    empty($lname) ? array_push($regErrors, "Last Name Field is required") : $_SESSION['lname'] = $lname;
    $_SESSION['username']=$username;
    $result = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

    if (empty($email)) { //Email Validation
        array_push($regErrors, "Email field can not be empty");
    } elseif ($email !== $email2) {
        array_push($regErrors, "Emails do not match");
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email'] = $email;
        } else {
            array_push($regErrors, "Email is invalid");
        }
    } elseif (mysqli_num_rows($result) > 0) {
        array_push($regErrors, "Email already exists");
    }

    if (empty($pw)) { //Password Validation
        array_push($regErrors, "Password Fields are required");
    } elseif ($pw != $pw2) {
        array_push($regErrors, "Passwords do not match");
    } elseif (!preg_match('/[A-Za-z0-9]/', $pw)) {
        array_push($regErrors, "You can not use special characters");
    } else {
        $pw = password_hash($pw, PASSWORD_DEFAULT);
    }

    if (empty($regErrors)){
        $insertion="INSERT INTO users (id,first_name,last_name,username,email,pw,signup_date) VALUES (NULL,'$fname','$lname','$username','$email','$pw',CURRENT_TIMESTAMP)";
        $result= mysqli_query($con,$insertion);
        if($result){
            array_push($successMsgs,"User $email Added !!! ");
            $_SESSION['loggedIn']=true;
        }
    }
}
?>
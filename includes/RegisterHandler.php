<?php 

$fname = $lname = $email = $email2 = $pw = $pw2 = $result = $username= "";
$regErrors =$successMsgs= [];


if (isset($_POST['register'])) {
    //Getting Data from the form
    $username= validate($_POST['reg_user']);
    $fname = validate($_POST['reg_fname']);
    $lname = validate($_POST['reg_lname']);
    $email = validate($_POST['reg_email']);
    $email2 = validate($_POST['reg_email2']);
    $pw = $_POST['reg_pw'];
    $pw2 = $_POST['reg_pw2'];
    empty($fname) && !checkLength($fname,2,25) ? array_push($regErrors, "First Name Field is required") : $_SESSION['fname'] = $fname;
    empty($lname) && !checkLength($lname,2,25) ? array_push($regErrors, "Last Name Field is required") : $_SESSION['lname'] = $lname;
    $_SESSION['username']=$username;
    $result = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

    //Email Validation
    if (empty($email))
        array_push($regErrors, "Email field can not be empty");
    elseif ($email !== $email2){
        array_push($regErrors, "Emails do not match");
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            $_SESSION['email'] = $email;
        else
            array_push($regErrors, "Email is invalid");
    }elseif (mysqli_num_rows($result) > 0)
        array_push($regErrors, "Email already exists");

    //Password Validation
    if (empty($pw))
        array_push($regErrors, "Password Fields are required");
    elseif ($pw != $pw2)
        array_push($regErrors, "Passwords do not match");
    elseif (preg_match('/[^A-Za-z0-9\s+]/', $pw))
        array_push($regErrors, "You can not use special characters");
    elseif(!checkLength($pw,6,100))
        array_push($regErrors,"Password should have at least 6 characters");
    else
        $pw = password_hash($pw, PASSWORD_DEFAULT);

    //Validating User Name
    if (empty($username))
        array_push($regErrors,"User name cannot be emty");
    elseif (preg_match('/[^A-Za-z0-9]/',$username))
        array_push($regErrors,"You can not use special characters for the username");
    elseif(!checkLength($username,6,100))
        array_push($regErrors,"The username should be at least 6 characters");
    else {
        $usernameCheck=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($usernameCheck)>0)
            array_push($regErrors,"The username" . $username . " already exists");
    }



    //Adding Data to Db
    if (empty($regErrors)){
        $insertion="INSERT INTO users (id,first_name,last_name,username,email,pw,signup_date) VALUES (NULL,'$fname','$lname','$username','$email','$pw',CURRENT_TIMESTAMP)";
        $result= mysqli_query($con,$insertion);
        if($result){
            array_push($successMsgs,"User $email Added !!! ");
            $_SESSION['username']=$username;
        }
    }
    mysqli_close($con);
}
?>
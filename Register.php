<?php
require "includes/connection.php";
session_start();
require ("includes/functions.php");
require "includes/RegisterHandler.php";
require "includes/LogInHander.php";
?>



    <html lang="en">

    <head>
        <title>Title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="styles/bootstrap.css">
        <link rel="stylesheet" href="styles/font-awesome.min.css">
        <link rel="stylesheet" href="styles/style.css">
    </head>

    <body>


        <div class="container">

            <div class="pt-4 row">
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class=" form-inline">
                        <div class="form-group p-x-2  pull-right">
                            <input type="text" name="login_email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group px-2">
                            <input type="password" name="login_password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group px-2">
                            <input class="form-check-input" type="checkbox" name="login-Rem" id="Check">
                            <label class="form-check-label" for="Check">Remember Me</label>
                        </div>
                        <input class="btn btn-sm btn-primary px-2 d-inline-block" name="login_btn" type="submit" value="Sign In">
                    </div>
                </form>
            </div>

            <div class="row">

                <div class="col-md-5"></div>
                <div class="col-md-2"></div>

                <div class="col-md-5">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group pt-4">
                            <input type="text" name="reg_fname" class="form-control" value="<?php echo isset($_SESSION['fname']) ? $_SESSION['fname'] : '' ?>"
                                placeholder="First Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="reg_lname" class="form-control" value="<?php echo isset($_SESSION['lname']) ? $_SESSION['lname'] : '' ?>"
                                placeholder="Last Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="reg_user" class="form-control" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>"
                                placeholder="Last Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="reg_email" class="form-control" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>"
                                placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="reg_email2" class="form-control" placeholder="Confirm Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="reg_pw" class="form-control" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="reg_pw2" class="form-control" placeholder="Confirm Password" />
                        </div>
                        <input type="submit" value="Sign Up" name="register" class="btn btn-primary" />
                    </form>

                    <!-- Failed Feedback -->
                    <?php foreach ($regErrors as $error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo "$error"; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endforeach;?>

                    <?php foreach ($successMsgs as $successMsg): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo "$successMsg"; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endforeach;?>
                </div>

            </div>



        </div>
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/tether.min.js"></script>
        <script src="scripts/bootstrap.min.js"></script>
    </body>

    </html>
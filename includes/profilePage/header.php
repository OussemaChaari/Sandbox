<?php 
    $username=$_SESSION['username'];
    $query="SELECT * FROM users WHERE username='$username'";
    $result=mysqli_query($con,$query);
    $result=mysqli_fetch_assoc($result);
?>

<html lang="en">

<head>
    <title>Connecto !! </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="#">Connecto</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" id="username">
                        <a class="nav-link" href="index.php">
                            <span>
                                <?php echo $result['first_name']; ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-cog"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-users"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                    <div class="dropdown messengerWidget">
                        <button class="nav-link btn btn-link messages dropdown-toggle"  data-toggle="dropdown" >
                            <i class="fa fa-envelope"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right  recentMessages ">
                            <div class="text-center">
                            </div>
                        </div>
                    </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="includes/nav_handlers/logout.php">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
    <div id="profile" class="row no-gutter">
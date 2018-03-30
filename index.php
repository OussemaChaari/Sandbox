<?php 
require "includes/connection.php";
session_start();
if (!$_SESSION['username']){
    header("Location: register.php");
    die();
}
require "includes/profilePage/header.php";
?>

        <div class="col-md-3" id="profileAside">
            <div class="card">
                <img class="img-top" id="profilePic" src="<?php echo $result['profile_pic']; ?>">
                <div class="card-body text-center">
                    <a class="card-text" href="#"><?php echo $result['first_name'] ." ". $result['last_name'];?></a>
                    <p>Likes: <?php echo $result['num_likes']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="profileMain">
            <div class="d-flex justify-content-between" id="postWrapper">
                <textarea name="post_text" placeholder="Got something to say ?"  id="postText"></textarea>
                <input type="submit" id="postBtn" value="Post!">
            </div>
            <div id="feed">
                <div class="post"></div>
            </div>
        </div>

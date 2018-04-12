<?php 
require "includes/connection.php";
include "includes/classes/User.php";
include "includes/classes/Post.php";
session_start();
if (!$_SESSION['username']) {
    header("Location: register.php");
    die();
}
include "includes/profilePage/header.php";
$profile_username=$_GET['profile_username'];
$mainUser;
$friend_btn;
if (isset($profile_username) && mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE username='$profile_username'"))>0){
    $profile=new User($con,$profile_username);
    $mainUser=new User($con,$_SESSION['username']); 
}else{
    header ("Location: 404.php");
}
$_SESSION['userPosts']=$profile_username;



$post = new Post($con, $_SESSION['username']);
if (isset($_POST['post_btn'])) {
    $post->submitPost($_POST['post_text'], $_SESSION['userPosts']);
}
if (isset($_POST['comment_btn'])){
    $post->addComment();
}
if (isset($_POST['remove_comment'])){
    $comment_id=$_POST['comment_id'];
    $post_id = $_POST['post_id'];
    $post->deleteComment($comment_id,$post_id);
}
if (isset($_POST['remove_post'])){
    $postId=$_POST['post_id'];
    $post->deletePost($postId);
}
if (isset($_POST['like_btn'])){
    $postId=(int)$_POST['post_id'];
    $post->likePost($postId);
}



if ($profile->isFriend($_SESSION['username'])){
    $friend_btn='<button name="friend_btn" type="submit" class="btn btn-danger">Remove Friend</button>';
}elseif ($profile->isPending($_SESSION['username'])){
    $friend_btn='<button name="friend_btn" type="disabled" class="btn">Invitation pending...</button>';
}elseif($profile_username!=$_SESSION['username']){
        $friend_btn='<button name="friend_btn" type="submit" class="btn btn-success">Add Friend</button>';
    }

if (isset($_POST['friend_btn'])){
    if ($profile->isFriend($_SESSION['username'])){
        $friend_btn='<button name="friend_btn" type="submit" class="btn btn-danger">Remove Friend</button>';
        $profile->removeFriend($_SESSION['username']);
        $mainUser->removeFriend($profile_username);
    }elseif ($profile->isPending($_SESSION['username'])){
        $friend_btn='<button name="friend_btn" type="disabled" class="btn">Invitation pending...</button>';
    }else{
        $friend_btn='<button name="friend_btn" type="submit" class="btn btn-success">Add Friend</button>';
        $mainUser->addPending($profile_username);
        $profile->addPending($_SESSION['username']);
    }
    header ("Location: $profile_username");
}

?>

<div class="col-md-3" id="profileAside">
    <div class="card">
        <img class="img-top" id="profilePic" src="<?php echo $profile->getProfilePic();?>">
        <div class="card-body text-center">
            <a class="card-text" href="#">
                <?php echo $profile->getFullName();?>
            </a>
            <p>Likes: 
                <?php echo $profile->getNumLikes(); ?>
            </p>
            <p>Posts: 
            <?php echo $profile->getNumPosts(); ?>
            </p>
            <p>Friends:
            <?php echo $profile->getNumFriends(); ?>
            </p>
        <div class="addButtons text-center">
        <form action="" method="post"> 
            <?php echo $friend_btn ; ?>          
        </form>
        </div>
        </div>
        
    </div>
</div>

<div class="col-md-9" id="profileMain">
    <form class="d-flex justify-content-between" id="postWrapper" action="" method="post">
        <input type="text" name="post_text" placeholder="Tell <?php echo $profile->getFullName(); ?> What's on your mind" class="postText"></input>
        <input type="submit" name="post_btn" id="postBtn" value="Post!">
    </form>
    <div id="feed">
        
    </div>
</div>
<?php include "includes/profilePage/footer.php"; ?>
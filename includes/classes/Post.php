<?php
$root = $_SERVER['DOCUMENT_ROOT'] . "/Social/public";
include "$root/includes/functions.php";

class Post
{
    private $userObj;
    private $con;

    public function __construct($con, $user)
    {
        $this->con = $con;
        $this->userObj = new User($con, $user);
    }

    public function submitPost($body, $user_to)
    {
        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this->con, $body);
        $isEmpty = preg_replace('/\s+/', '', $body);

        if (!empty($isEmpty)) {
            $added_by = $this->userObj->getUsername();
            if ($user_to == $added_by) {
                $user_to = "";
            }
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES(NULL,'$body','$added_by',CURRENT_TIMESTAMP,'$user_to',0)");
            $postId = mysqli_insert_id($this->con);
            $this->userObj->updateNumPosts(1);
        }
    }

    public function deletePost($postId)
    {
        //TODO: DO THAT TOO

    }

    public function deleteComment($commentId)
    {
        //TODO: DO THAT TOO    
    }

    public function addComment()
    {
        $commentBody = strip_tags($_POST['insert_comment']);
        $commentBody = mysqli_real_escape_string($this->con, $commentBody);
        $postId = $_POST['post_id'];
        $isEmpty = preg_replace('/\s+/', '', $commentBody);
        if (!empty($isEmpty)) {
            $added_by = $this->userObj->getUsername();
            $query = mysqli_query($this->con, "INSERT INTO comments VALUES(NULL,'$commentBody','$added_by',$postId,CURRENT_TIMESTAMP)");
        }
    }

    public function loadPosts($limit, $page)
    {
        $start = 0;
        if ($page == 1)
            $start = 0;
        else
            $start = ($page - 1) * $limit;


        $data = mysqli_query($this->con, "SELECT * FROM posts ORDER BY date_added DESC");

        if (mysqli_num_rows($data) > 0) {
            $count = 1;
            $iterations = 0;

            while ($row = mysqli_fetch_assoc($data)) {//get All the posts from latest to oldest
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $user_to = $row['user_to'];
                $likes = $row['likes'];
                $date_added = $row['date_added'];
                $postId = $row['id'];

                if ($user_to != "") {//check if the post is on the user's own wall or on others wall
                    $userToObj = new User($this->con, $user_to);
                    $userToFName = $userToObj->getFullName();
                }
                if ($iterations++ < $start)
                    continue;

                if ($count > $limit)
                    break;
                else
                    $count++;


                if (userExists($this->con, $added_by)) {//get the added_by data if the account has not been deleted
                    $addedByObj = new User($this->con, $added_by);
                    $addedByFName = $addedByObj->getFullName();
                    $addedByPic = $addedByObj->getProfilePic();
                    $date_added = getTimeFrame($date_added);//this function exists in functions.php which returns the time passes since the post has been added

                    ?>


                    <div class='post'>
                        <div class='postHead d-flex'>

                            <a href="<?php echo $added_by; ?>"><img width="50" height="50" id='postPic'
                                                                    src='<?php echo $addedByPic; ?>'></a>
                            <a href='<?php echo $added_by; ?>'><?php echo $addedByFName; ?></a>
                            <?php echo $user_to != "" ? "to <a href='" . $user_to . "'> " . $userToFName . "</a>" : ""; ?>
                            <span id="timeFrame" class="text-muted"><?php echo $date_added ?></span>
                        </div>
                        <div class="postBody">
                            <p><?php echo $body; ?></p>
                        </div>
                        <div class="interactionBox">
                            <button class="btn btn-link"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like (0)
                            </button>
                            <button class="btn btn-link" id="comment">Comment (0)</button>
                            <div id="commentWrapper" class="d-flex justify-content-start">
                                <a href="<?php echo $added_by; ?>"><img width="50" height="50" id='postPic'
                                                                        src='<?php echo $_SESSION['userProfile']; ?>'></a>
                                <form method="post" action="<?php htmlentities($_SERVER['PHP_SELF']); ?>">
                                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                                    <input type="text" name="insert_comment" class="commentText">
                                    <button name="comment_btn" type="submit" class="commentBtn"><i
                                                class="fa fa-commenting" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <?php
                            $comments_query = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id = $postId ORDER BY commented_on DESC");
                            while ($comments_result = mysqli_fetch_assoc($comments_query)) {
                                $commenter_username = $comments_result['commented_by'];
                                $commenter_query = mysqli_query($this->con, "SELECT first_name,last_name,profile_pic FROM users WHERE username='$commenter_username'");
                                $commenter_result = mysqli_fetch_assoc($commenter_query);
                                $comment_time = getTimeFrame($comments_result['commented_on']);
                                $commenter_pic = $commenter_result['profile_pic'];
                                $commenter_fname = $commenter_result['first_name'] . " " . $commenter_result['last_name'];
                                ?>
                                <div class="commentSnap">
                                    <div class="commentInfo d-flex">
                                        <a href="<?php echo $commenter_username; ?>"><img width="50" height="50" id="postPic" src="<?php echo $commenter_pic; ?>"></a>
                                        <a href='<?php echo $commenter_username; ?>'><?php echo $commenter_fname; ?></a>
                                        <?php if ($_SESSION['username']==$commenter_username){?>
                                        <a class="close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                        <?php } ?>
                                        <span id="commentTime" class="text-muted"><?php echo $comment_time ?></span>
                                    </div>
                                    <p><?php echo $comments_result['comment_body']; ?></p>
                                </div>
                            <?php }
                            ?>


                        </div>
                    </div>

                    <?php
                } else {
                    continue;
                }
            } ?>
            <script>

            </script>

        <?php }
    }
}

?>





















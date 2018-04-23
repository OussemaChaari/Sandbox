<?php
$root = $_SERVER['DOCUMENT_ROOT'] . "/Social/public";
include "$root/includes/functions.php";


class Message
{
    private $userObj;
    private $otherUserObj;
    private $con;

    public function __construct($con, $user, $other_user)
    {
        $this->con = $con;
        $this->userObj = new User($con, $user);
        $this->otherUserObj = new User($con, $other_user);
    }

    public function submitMessage($body){
        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this->con, $body);
        $isEmpty = preg_replace('/\s+/', '', $body);
        var_dump($body);
        $senderUserName = $this->userObj->getUsername();
        $otherUsername = $this->otherUserObj->getUsername();
        if (!empty($isEmpty)) {
            $query = mysqli_query($this->con, "INSERT INTO messages VALUES(NULL,'$otherUsername','$senderUserName','$body',CURRENT_TIMESTAMP)");
            $id = mysqli_insert_id($this->con);
            $time_sent=mysqli_query($this->con,"SELECT date_sent FROM messages WHERE id=$id");
            $time_sent=mysqli_fetch_assoc($time_sent);
            $date_sent=$time_sent['date_sent'];
            $time_sent=getTimeFrame($date_sent);
            ?>
                        <div class="d-flex justify-content-start user-conv conversation-div">
                            <a href="<?php echo $this->userObj->getUsername(); ?>">
                                <img id="convHead" src="<?php echo $this->userObj->getProfilePic(); ?>">
                            </a>
                        <p class="convText userConvText"><?php echo $body; ?></p>
                        <input type="hidden" value="<?php echo $date_sent ?>" id="msgtimeStamp">
                        <span class="mx-4 align-self-end mr-auto text-muted"><?php echo $time_sent ; ?></span>
                    </div>
                    <hr>

       <?php }
    }

    public function loadMessages($limit, $page, $user, $otherUser){
        $discussion_query = mysqli_query($this->con, "SELECT * FROM messages WHERE (user_to='$user' OR user_to='$otherUser') AND (user_from='$user' OR user_from='$otherUser') ORDER BY date_sent ASC");
        $discussion_lines = mysqli_num_rows($discussion_query);
        $start= $discussion_lines;
        if ($page == 1) {
            $start -= $limit;
            $end = $discussion_lines;
        } else {
            $start -= $page * $limit;
            $end = $start + $limit -1;
        }

        if (mysqli_num_rows($discussion_query) < 1) { ?>
            <p class="text-muted">Start a conversation with <?php echo $this->otherUserObj->getUsername(); ?></p>
        <?php } else {
            $count = $start;
            $iterations = 1;
            while ($row = mysqli_fetch_assoc($discussion_query)) {
                $user_to = $row['user_to'];
                $user_from = $row['user_from'];
                $body = $row['body'];
                $time_sent=getTimeFrame($row['date_sent']);

                if ($iterations < $start) {
                    $iterations++;
                    continue;
                }
                var_dump($row['date_sent']);
                //echo "iterations: ".$iterations." start: ".$start. " count: ".$count." end: ".$end;
                    if ($count == $start){
                     if ( $start > 0){  ?>
                        <button class="text-center btn btn-link" id="moreMessages">Display more messages</button>
                    <?php } else {  ?>
                        <p class="text-center">No more messages</p>
                    <?php }
                    }
                if ($count > $end) {   
                    break;
                }else
                    $count++;             

                if ($user_from == $user) { ?>
                    <div class="d-flex justify-content-start user-conv conversation-div">
                        <a href="<?php echo $this->userObj->getUsername(); ?>">
                            <img id="convHead" src="<?php echo $this->userObj->getProfilePic(); ?>">
                        </a>
                        <p class="convText userConvText"><?php echo $body; ?></p>
                        <input type="hidden" value="<?php echo $row['date_sent'] ?>" id="msgtimeStamp">
                        <span class="mx-4 align-self-end mr-auto text-muted"><?php echo $time_sent ; ?></span>
                    </div>
                    <hr>
                <?php } else { ?>
                    <div class="d-flex justify-content-start other-conv conversation-div">
                        <a href="<?php echo $this->otherUserObj->getUsername(); ?>">
                            <img id="convHead" src="<?php echo $this->otherUserObj->getProfilePic(); ?>">
                        </a>
                        <p class="convText otherConvText"><?php echo $body; ?></p>
                        <input type="hidden" value="<?php echo $row['date_sent'] ?>" id="msgtimeStamp">
                        <span class="mx-4 align-self-end ml-auto text-muted"><?php echo $time_sent ; ?></span>
                    </div>
                    <hr>
                <?php }
            }
        }
    }


    public function loadNewMessages($lastTimeStamp, $user, $otherUser){// this will only display the other user lines so: TODO : Remove everything related to user
        $discussion_query = mysqli_query($this->con, "SELECT * FROM messages WHERE (user_to='$user' OR user_to='$otherUser') AND (user_from='$user' OR user_from='$otherUser') AND (UNIX_TIMESTAMP(date_sent) > UNIX_TIMESTAMP('$lastTimeStamp'))  ORDER BY date_sent ASC");
        while ($row = mysqli_fetch_assoc($discussion_query)) {
            $user_to = $row['user_to'];
            $user_from = $row['user_from'];
            $body = $row['body'];
            $time_sent=getTimeFrame($row['date_sent']);

            if ($user_from == $user) { ?>
                <div class="d-flex justify-content-start user-conv conversation-div">
                    <a href="<?php echo $this->userObj->getUsername(); ?>">
                        <img id="convHead" src="<?php echo $this->userObj->getProfilePic(); ?>">
                    </a>
                    <p class="convText userConvText"><?php echo $body; ?></p>
                    <input type="hidden" value="<?php echo $row['date_sent'] ?>" id="msgtimeStamp">
                    <span class="mx-4 align-self-end mr-auto text-muted"><?php echo $time_sent ; ?></span>
                </div>
                <hr>
            <?php } else { ?>
                <div class="d-flex justify-content-start other-conv conversation-div">
                    <a href="<?php echo $this->otherUserObj->getUsername(); ?>">
                        <img id="convHead" src="<?php echo $this->otherUserObj->getProfilePic(); ?>">
                    </a>
                    <p class="convText otherConvText"><?php echo $body; ?></p>
                    <input type="hidden" value="<?php echo $row['date_sent'] ?>" id="msgtimeStamp">
                    <span class="mx-4 align-self-end ml-auto text-muted"><?php echo $time_sent ; ?></span>
                </div>
                <hr>
            <?php }
        }
    }


}

?>
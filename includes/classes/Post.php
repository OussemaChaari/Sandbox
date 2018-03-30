<?php
class Post{
    private $userObj;
    private $con;

    public function __construct($con, $user){
        $this->con=$con;
        $this->userObj=new User($con,$user);
    }

    public function submitPost($body, $user_to){
        $body=strip_tags($body);
        $body=mysqli_real_escape_string($this->con,$body);
        $isEmpty=preg_replace('/\s+/','',$body);

        if (!empty($isEmpty)){
            $added_by= $this->userObj->getUsername();
            if ($user_to == $added_by){
                $user_to="";
            }
            $query = mysqli_query($this->con,"INSERT INTO posts VALUES(NULL,'$body','$added_by',CURRENT_TIMESTAMP,'$user_to',0)");
            $postId = mysqli_insert_id($this->con);
            $this->userObj->updateNumPosts(1);
        }
        
    }
}
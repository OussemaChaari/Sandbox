<?php
class User{
    private $user;
    private $con;

    public function __construct($con, $user){
        $this->con = $con;
        $userquery=mysqli_query($this->con,"SELECT * FROM users WHERE username='$user'");
        $this->user=mysqli_fetch_assoc($userquery);
    }

    public function updateNumPosts($num){
        $numPosts = $this->user['num_posts'];
        $numPosts+=$num;
        $tempUsername=$this->user['username'];
        $update_query= mysqli_query($this->con,"UPDATE users SET num_posts=$numPosts WHERE username='$tempUsername'");
    }

    public function getFullName(){
        return $this->user['first_name'] . " " . $this->user['last_name'];
    }

    public function getUsername(){
        return $this->user['username'];
    }

    public function getProfilePic(){
        return $this->user['profile_pic'];
    }
}
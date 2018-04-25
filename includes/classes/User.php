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

    public function getNumPosts(){
        return $this->user['num_posts'];
    }

    public function getNumLikes(){
        return $this->user['num_likes'];
    }

    public function getNumFriends(){
        $friends_arr=explode(',',$this->user['friends_array']);
        return count($friends_arr)-1;
    }

    public function addFriend($friend_to_add){
        $friends=$this->user['friends_array'];
        $friends=$friends.','.$friend_to_add;
        $username=$this->user['username'];
        mysqli_query($this->con,"UPDATE users SET friends_array='$friends' WHERE username='$username' ");
    }

    public function removeFriend($friend_to_remove){
        $friends=$this->user['friends_array'];
        $friends=explode(',',$friends);
        $index=array_search($friend_to_remove,$friends);
        unset($friends[$index]);
        $friends=implode(',',$friends);
        $username=$this->user['username'];
        mysqli_query($this->con,"UPDATE users SET friends_array='$friends' WHERE username='$username' ");
    }

    public function addPending($friend_to_add){
        $friends=$this->user['friends_pending'];
        $friends=$friends.','.$friend_to_add;
        $username=$this->user['username'];
        mysqli_query($this->con,"UPDATE users SET friends_pending='$friends' WHERE username='$username' ");
    }

    public function getFriends(){
        return explode(',',$this->user['friends_array']);
    }

    public function isFriend($friend){
        $friends_arr=explode(',',$this->user['friends_array']);
        return (in_array($friend,$friends_arr));
    }

    public function isPending($friend){
        $pending_arr=explode(',',$this->user['friends_pending']);
        return (in_array($_SESSION['username'],$pending_arr));
    }

    public function getFullName(){
        return $this->user['first_name'] . " " . $this->user['last_name'];
    }

    public function getFirstName(){
        return $this->user['first_name'] ;
    }

    public function getUsername(){
        return $this->user['username'];
    }

    public function getProfilePic(){
        return $this->user['profile_pic'];
    }
}
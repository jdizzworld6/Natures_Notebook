<?php

// Friend class to add friend to users account
class Friends{
    private $f_id_friends;
    private $f_id_your_friends;
    private $u_id_user;
    private $u_first_name;
    private $u_last_name;
    private $u_profile_image;


// creating a user class with user information
    public function __construct($f_id_your_friends, $u_id_user, $u_first_name, $u_last_name, $u_profile_image, $f_id_friends=null){
        $this->f_id_friends = $f_id_friends;
        $this->f_id_your_friends = $f_id_your_friends;
        $this->u_id_user = $u_id_user;
        $this->u_first_name = $u_first_name;
        $this->u_last_name = $u_last_name;
        $this->u_profile_image = $u_profile_image;
    }
    public function getIdFriends(){
        return $this->f_id_friends;
    }
    public function getIdYourFriends(){
        return $this->f_id_your_friends;
    }
    public function getIdUser(){
        return $this->u_id_user;
    }
    public function getFirstName(){
        return $this->u_first_name;
    }
    public function getLastName(){
        return $this->u_last_name;
    }
    public function getProfileImage(){
        return $this->u_profile_image;
    }
    public function setIdFriends($f_id_friends){
        $this->f_id_friends = $f_id_friends;
    }
    public function setIdYourFriends($f_id_your_friends){
        $this->f_id_your_friends = $f_id_your_friends;
    }
    public function setIdUser($u_id_user){
        $this->u_id_user = $u_id_user;
    }
    public function setFirstName($u_first_name){
        $this->u_first_name = $u_first_name;
    }
    public function setLastName($u_last_name){
        $this->u_last_name = $u_last_name;
    }
    public function setProfileImage($u_profile_image){
        $this->u_profile_image = $u_profile_image;
    }
    
}

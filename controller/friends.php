<?php
// Friend class to add friend to users account
class Friends{
    private $id_friends;
    private $id_user;
    private $id_your_friends;

// creating a user class with user information
    public function __construct($id_user, $id_your_friends, $id_friends=null){
        $this->id_friends = $id_friends;
        $this->id_user = $id_user;
        $this->id_your_friends = $id_your_friends;
    }
    // create setters
    public function setIdFriends($id_friends){
        $this->id_friends = $id_friends;
    }
    public function setIdUser($id_user){
        $this->id_user = $id_user;
    }
    public function setIdYourFriends($id_your_friends){
        $this->id_your_friends = $id_your_friends;
    }
    // create getters
    public function getIdFriends(){
        return $this->id_friends;
    }
    public function getIdUser(){
        return $this->id_user;
    }
    public function getIdYourFriends(){
        return $this->id_your_friends;
    }
    
}
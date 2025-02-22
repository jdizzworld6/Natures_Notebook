<?php

class User{
    private $id_user;
    private $first_name;
    private $last_name;
    private $profile_image;
    private $date_of_birth;
    private $phone_number;
    private $address;
    private $city;
    private $state;
    private $zip;
    private $email;
    private $username;
    private $password;
    private $user_level;
    private $count_created;

// creating a user class with user information
    public function __construct($first_name, $last_name, $date_of_birth, $phone_number, $address, $city, $state, $zip, $email, $username, $password, $user_level, $count_created ,$profile_image = null, $id_user=null){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->profile_image = $profile_image;
        $this->date_of_birth = $date_of_birth;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->email = $email;
        $this->username = $username;
        $this->password =$password;
        $this->user_level = $user_level;
        $this->count_created = $count_created;
        $this->id_user = $id_user;
    }

    // create setters
    public function setId_user($id_user){
        $this->id_user = $id_user;
    }
    public function setFirst_name($first_name){
        $this->first_name = $first_name;
    }
    public function setLast_name($last_name){
        $this->last_name = $last_name;
    }
    public function setProfile_image($profile_image){
        $this->profile_image = $profile_image;
    }
    public function setDate_of_birth($date_of_birth){
        $this->date_of_birth = $date_of_birth;
    }
    public function setPhone_number($phone_number){
        $this->phone_number = $phone_number;
    }
    public function setAddress($address){
        $this->address = $address;
    }
    public function setCity($city){
        $this->city = $city;
    }
    public function setState($state){
        $this->state = $state;
    }
    public function setzip($zip){
        $this->zip = $zip;
    }
    public function setemail($email){
        $this->email = $email;
    }
    public function setusername($username){
        $this->username = $username;
    }
    public function setpassword($password){
        $this->password = $password;
    }
    public function setuser_level($user_level){
        $this->user_level = $user_level;
    }
    public function setcount_created($count_created){
        $this->count_created = $count_created;
    }
// creating getters
    public function getId_user(){
        return $this->id_user;
    }
    public function getFirst_name(){
        return $this->first_name;
    }
    public function getLast_name(){
        return $this->last_name;
    }

    public function getProfile_image() {
        return $this->profile_image;
    }
    public function getDate_of_birth(){
        return $this->date_of_birth;
    }
    public function getPhone_number(){
        return $this->phone_number;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getCity(){
        return $this->city;
    }
    public function getState(){
        return $this->state;
    }
    public function getZip(){
        return $this->zip;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getUserLevel(){
        return $this->user_level;
    }
    public function getCountCreated(){
        return $this->count_created;
    }





 
    
}
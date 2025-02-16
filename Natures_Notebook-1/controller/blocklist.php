<?php

class Blocklist{
    private $id_blocklist;
    private $phone_number;
    private $email;

// creating a user class with user information
    public function __construct($phone_number, $email, $id_blocklist = null){
        $this->id_blocklist = $id_blocklist;
        $this->phone_number = $phone_number;
        $this->email = $email;
    }

    public function getIdBlocklist(){
        return $this->id_blocklist;
    }
    public function getPhoneNumber(){
        return $this->phone_number;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setIdBlocklist($id_blocklist){
        $this->id_blocklist = $id_blocklist;
    }
    public function setPhoneNumber($phone_number){
        $this->phone_number = $phone_number;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    
}
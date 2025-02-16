<?php

class Photo{
    private $id_photo;
    private $id_user;
    private $id_photo_category;
    private $photo_name;
    private $description;
    private $photo_url;
    private $upload_date;
    private $location;

// creating a user class with user information
    public function __construct($id_user, $id_photo_category, $photo_name, $description, $photo_url, $upload_date, $location, $id_photo=null){
        $this->id_user = $id_user;
        $this->id_photo_category = $id_photo_category;
        $this->photo_name = $photo_name;
        $this->description = $description;
        $this->photo_url = $photo_url;
        $this->upload_date = $upload_date;
        $this->id_photo = $id_photo;
        $this->location = $location;
    }
    // create setters
    public function setId_photo($id_photo){
        $this->id_photo = $id_photo;
    }
    public function setId_user($id_user){
        $this->id_user = $id_user;
    }
    public function setId_photo_category($id_photo_category){
        $this->id_photo_category = $id_photo_category;
    }
    public function setPhoto_name($photo_name){
        $this->photo_name = $photo_name;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setPhoto_url($photo_url){
        $this->photo_url = $photo_url;
    }
    public function setUpload_date($upload_date){
        $this->upload_date = $upload_date;
    }
    public function setLocation($location){
        $this->location = $location;
    }

    // create getters
    public function getId_photo(){
        return $this->id_photo;
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function getId_photo_category(){
        return $this->id_photo_category;
    }
    public function getPhoto_name(){
        return $this->photo_name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPhoto_url(){
        return $this->photo_url;
    }
    public function getUpload_date(){
        return $this->upload_date;
    }
    public function getLocation(){
        return $this->location;
    }
    
}
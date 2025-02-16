<?php

class PhotoCategory{
    private $id_photo_category;
    private $category_name;
    private $category_description;


// creating a user class with user information
    public function __construct($category_name, $category_description, $id_photo_category=null){
        $this->id_photo_category = $id_photo_category;
        $this->category_name = $category_name;
        $this->category_description = $category_description;
    }

    // create setters
    public function setIdPhotoCategory($id_photo_category){
        $this->id_photo_category = $id_photo_category;
    }
    public function setCategoryName($category_name){
        $this->category_name = $category_name;
    }
    public function setCategoryDescription($category_description){
        $this->category_description = $category_description;
    }
    // create getters
    public function getIdPhotoCategory(){
        return $this->id_photo_category;
    }
    public function getCategoryName(){
        return $this->category_name;
    }
    public function getCategoryDescription(){
        return $this->category_description;
    }

    
}
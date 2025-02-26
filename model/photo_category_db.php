<?php
// Creating a class to connect to database then querying results
require_once 'database.php';

class PhotoCategoryDB {
    // Query for getting single user by id
    public static function getPhotoCategoryById($id_photo_category){
        $db = new Database();
        $dbConn = $db->getDBConn();

        $id_photo_category = (int)$id_photo_category;

        if ($dbConn){
            $query = "Select * From photo_category Where id_photo_category = $id_photo_category"; 
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    // Query for getting all users
    public static function getAllPhotoCategory(){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "Select * From photo_category"; 
            return $dbConn->query($query);
        } else {
            return false;
        }
    }
    // Query for getting deleting user
    public static function deletePhotoCategory($id_photo_category){
        $db = new Database();
        $dbConn = $db->getDBConn();
        if($dbConn){
            $query = "Delete From photo_category Where id_photo_category = $id_photo_category";

        return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for adding new user into database
    public static function addPhotoCategory($category_name, $category_description) {
        $db = new Database();
        $dbConn = $db->getDbConn();


        if ($dbConn) {
            $query = "Insert Into photo_category (category_name, category_description) Values ('" . $category_name . "', '" . $category_description . "')";

            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for updating existing user in database 
    public static function updatePhotoCategory($id_photo_category, $category_name, $category_description) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "Update photo_category Set category_name = '$category_name', 
            category_description = '$category_description'
            Where id_photo_category = $id_photo_category";
            
            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }

}
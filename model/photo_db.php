<?php
// Creating a class to connect to database then querying results
require_once 'database.php';

class PhotoDB {
    // Query for getting single photo by id
    // tested
    public static function getPhotoById($id_photo){
        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_photo = (int)$id_photo;

        if ($dbConn){
            $query = "Select * From photo Where id_photo = $id_photo"; 
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    // Query for getting all photos
    // tested
    public static function getAllPhotos(){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "Select * From photo Order By upload_date Desc"; 
            return $dbConn->query($query);
        } else {
            return false;
        }
    }

    // Get all photos in one category
    // tested
    public static function getAllPhotosCategory($id_photo_category){

        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_photo_category = (int)$id_photo_category;

        if ($dbConn){
            $query = "Select * From photo Where id_photo_category = $id_photo_category Order By upload_date Desc";
            return $dbConn->query($query);
        } else {
            return false;
        }
    }

    // Get all photos for one user
    // tested
    public static function getAllPhotosUser($id_user){

        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_user = (int)$id_user;

        if ($dbConn){
            $query = "Select * From photo Where id_user = $id_user Order By upload_date Desc";
            return $dbConn->query($query);
        } else {
            return false;
        }
    }

    // Get all photos for one user by one category
    // tested / changed location without testing
    public static function getAllPhotosUserAndCategory($id_user, $id_photo_category){

        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_user = (int)$id_user;
        $id_photo_category = (int)$id_photo_category;

        if ($dbConn){
            $query = "Select p.id_photo, p.id_user, p.id_photo_category, p.photo_name, p.description, p.photo_url, p.upload_date, p.location
             From photo p 
             JOIN
             photo_category pc on p.id_photo_category = pc.id_photo_category
             where p.id_user = $id_user And p.id_photo_category = $id_photo_category
             Order By upload_date Desc";
            return $dbConn->query($query);
        } else {
            return false;
        }
    }

    // Query for deleting photo
    // tested
    public static function deletePhoto($id_photo){
        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_photo = (int)$id_photo;
        if($dbConn){
            $query = "Delete From photo Where id_photo = $id_photo";

        return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for adding new user into database
    // tested changed location without testing
    public static function addPhoto($id_user, $id_photo_category, $photo_name, $description, $photo_url, $upload_date, $location) {
        $db = new Database();
        $dbConn = $db->getDbConn();
        $id_user = (int)$id_user;
        $id_photo_category = (int)$id_photo_category;

        if ($dbConn) {
            $query = "Insert Into photo (id_user, id_photo_category, photo_name, description, photo_url, upload_date, location)
                Values(
                $id_user, 
                $id_photo_category, 
                \"" .$photo_name . "\",
                \"" .$description . "\",
                \"" .$photo_url . "\",
                \"" .$upload_date . "\",
                \"" .$location. "\")";

            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for updating existing user in database 
    // tested changed location without testing
    public static function updatePhoto($id_photo, $id_user, $id_photo_category, $photo_name, $description, $photo_url, $upload_date, $location) {
        $db = new Database();
        $dbConn = $db->getDbConn();
        $id_photo = (int)$id_photo;
        $id_user = (int)$id_user;
        $id_photo_category = (int)$id_photo_category;

        if ($dbConn) {
            if ($dbConn) {
                $query = "Update photo Set id_user = $id_user,
                    id_photo_category = $id_photo_category,
                    photo_name = \"" . $photo_name . "\",
                    description = \"" . $description . "\",
                    photo_url = \"" . $photo_url . "\",
                    upload_date = \"" . $upload_date. "\",
                    location = \"" . $location . "\"
                    Where id_photo = $id_photo";
            
            return $dbConn->query($query) === true;
        } else {
            return false;
            }
        }
    }

}
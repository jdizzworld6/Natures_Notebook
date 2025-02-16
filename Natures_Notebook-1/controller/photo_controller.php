<?php

require_once '../model/photo_db.php';
require_once 'photo.php';

// Parsing query results
// tested changed location without testing
class PhotoController {
    public static function rowToPhoto($row) {
        $photo = new Photo(
            $row['id_user'],
            $row['id_photo_category'],
            $row['photo_name'],
            $row['description'],
            $row['photo_url'],
            $row['upload_date'],
            $row['location'],
            $row['id_photo']
        );
        return $photo;
    }
// Get all photos
// tested
    public static function getAllPhotosByUser($userID){
        $queryRes = PhotoDB::getAllPhotosUser($userID);
        
        if ($queryRes){
            $photos = [];
            while ($row = $queryRes->fetch_assoc()){
                $photos[] = self::rowToPhoto($row);
            }
            return $photos;
        } else {
            return false;
        }
    }
// Get photo by ID
// tested
    public static function getPhotoById($id){
        $queryRes = PhotoDB::getPhotoById($id);
        
        if ($queryRes){
            return self::rowToPhoto($queryRes);
        } else {
            return false;
        }
    }
// Delete photo
// tested
    public static function deletePhoto($id_photo){
        return PhotoDB::deletePhoto($id_photo);
    }
// Add photo
// tested changed location without testing
    public static function addPhoto($photo){
        return PhotoDB::addPhoto(
            $photo->getId_user(),
            $photo->getId_photo_category(),
            $photo->getPhoto_name(),
            $photo->getDescription(),
            $photo->getPhoto_url(),
            $photo->getUpload_date(),
            $photo->getLocation()
        );
    }
// Update photo
// tested changed location without testing
    public static function updatePhoto($photo){
        return PhotoDB::updatePhoto(
            $photo->getId_photo(),
            $photo->getId_user(),
            $photo->getId_photo_category(),
            $photo->getPhoto_name(),
            $photo->getDescription(),
            $photo->getPhoto_url(),
            $photo->getUpload_date(),
            $photo->getLocation()
        );
    }


}
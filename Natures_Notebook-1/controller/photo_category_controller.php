<?php

require_once '../model/photo_category_db.php';
require_once 'photo_category.php';

class PhotoCategoryController {
    // parse query into Array of Arrays
    public static function rowToPhotoCateogory($row) {
        $PhotoCateogry = new PhotoCategory(
            $row['category_name'],
            $row['category_description'],
            $row['id_photo_category']
        );
        return $PhotoCateogry;
    }
    // Get all photo categories
    // tested
    public static function getAllPhotoCategory(){
        $queryRes = PhotoCategoryDB::getAllPhotoCategory();
        
        if ($queryRes){
            $friends = [];
            while ($row = $queryRes->fetch_assoc()){
                $friends[] = self::rowToPhotoCateogory($row);
            }
            return $friends;
        } else {
            return false;
        }
    }
    // Get photo category by id
    // tested
    public static function getCategoryById($id_photo_category){
        $queryRes = PhotoCategoryDB::getPhotoCategoryById($id_photo_category);
        
        if ($queryRes){
            return self::rowToPhotoCateogory($queryRes);
        } else {
            return false;
        }
    }
    // Delete photo category by id
    // tested
    public static function deletePhotoCategory($id_photo_category){
        return PhotoCategoryDB::deletePhotoCategory($id_photo_category);
    }
    // Add photo category
    // tested
    public static function addPhotoCategory($photo_category){
        return PhotoCategoryDB::addPhotoCategory(
            $photo_category->getCategoryName(),
            $photo_category->getCategoryDescription()
        );
    }
    // Update photo category
    // tested
    public static function updatePhotoCategory($photo_category){
        return PhotoCategoryDB::updatePhotoCategory(
            $photo_category->getIdPhotoCategory(),
            $photo_category->getCategoryName(),
            $photo_category->getCategoryDescription()
        );
    }



}
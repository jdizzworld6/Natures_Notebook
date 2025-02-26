<?php
// Creating a class to connect to database then querying results
require_once 'database.php';

class UsersDB {
    // Query for getting single user by id
    public static function getUserById($id){
        $db = new Database();
        $dbConn = $db->getDBConn();
        $id = (int)$id;

        if ($dbConn){
            $query = "Select * From users Where id_user = $id"; 
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    // Query for getting all users
    public static function getAllUsers($id_user = null){
        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_user = (int)$id_user;
        
        if ($dbConn){
            if ($id_user != null){
                $id_user = (int)$id_user;
                $query = "Select * From users Where id_user != $id_user"; 
            } else {
                $query = "Select * From users"; 
            }
            return $dbConn->query($query);
        } else {
            return false;
        }
    }
    // Query for getting deleting user
    public static function deleteUser($id_user){
        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_user = (int)$id_user;
        if($dbConn){
            $query = "Delete From users Where id_user = $id_user";

        return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for adding new user into database
    public static function addUser($first_name, $last_name, $date_of_birth, $phone_number, $address, $city, $state, $zip, $email, $username, $password, $user_level = 2) {
        $db = new Database();
        $dbConn = $db->getDbConn();
        $count_created = date('m/d/Y H:i:s');

        if ($dbConn) {
            $query = "Insert Into users (first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, profile_image, user_level, count_created) Values ('$first_name',
                '$last_name',
                '$date_of_birth',
                '$phone_number',
                '$address',
                '$city',
                '$state',
                '$zip',
                '$email',
                '$username',
                '$password',
                '',
                $user_level,
                '$count_created')";

            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for updating existing user in database 
    public static function updateUser($id_user, $first_name, $last_name, $date_of_birth, $phone_number, $address, $city, $state, $zip, $email, $username, $password) {
        $db = new Database();
        $dbConn = $db->getDbConn();
        $id_user = (int)$id_user;
        if ($dbConn) {
            $query = "Update users Set first_name = '$first_name',
                last_name = '$last_name',
                date_of_birth = '$date_of_birth',
                phone_number = '$phone_number',
                address = '$address',
                city = '$city',
                state = '$state',
                zip = '$zip',
                email = '$email',
                username = '$username',
                password = '$password' Where id_user = $id_user";
            
            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }

    public static function updateProfilePhoto($id_user, $profile_image){
        $db = new Database();
        $dbConn = $db->getDBConn();
        $id_user = (int)$id_user;
        if ($dbConn) {
            $query = "Update users Set profile_image = '$profile_image' Where id_user = $id_user";
            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    public static function getUserValidation($username, $password){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "Select * From users Where username = '$username' and password = '$password'"; 
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public static function getUserByUsernamePassword($userName, $password){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "Select * From users Where username = '$userName' and password = '$password'"; 
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }

    }

}
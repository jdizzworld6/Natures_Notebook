<?php
// Creating a class to connect to database then querying results
require_once 'database.php';

class BlocklistDB {
    // Query for getting single user by id
    public static function getBlocklistById($id){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "Select * From blocklist Where id_blocklist = '$id'"; 
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    // Query for getting all users
    public static function getAllBlocklist(){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "Select * From blocklist"; 
            return $dbConn->query($query);
        } else {
            return false;
        }
    }
    // Query for getting deleting user
    public static function deleteBlocklist($id_blocklist){
        $db = new Database();
        $dbConn = $db->getDBConn();
        if($dbConn){
            $query = "Delete From blocklist Where id_blocklist = $id_blocklist";

        return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for adding new user into database
    public static function addBlocklist($phone_number, $email) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "Insert blocklist (phone_number, email) Values ('" . $phone_number . "', '" . $email . "')";

            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }
    // Query for updating existing user in database 
    public static function updateBlocklist($phone_number, $email, $id_blocklist) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "Update blocklist Set phone_number = '$phone_number',
                email = '$email' 
                Where id_blocklist = $id_blocklist";
            
            return $dbConn->query($query) === true;
        } else {
            return false;
        }
    }

}
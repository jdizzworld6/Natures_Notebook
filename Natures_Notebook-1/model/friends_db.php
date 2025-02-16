<?php
// Creating a class to connect to database then querying results
require_once 'database.php';

class FriendDB {
    // Query for getting single friend by id
    // tested
    public static function getFriendById($id_friends){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "
            SELECT f.id_friends, f.id_your_friends, u.id_user, u.first_name, u.last_name, u.profile_image
            FROM users u
            Inner JOIN friends f on f.id_user = u.id_user
            where f.id_friends = $id_friends            "; 
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    // Query for getting all of your friends
    // tested
    public static function getAllFriends($id_user){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "
            SELECT f.id_friends, f.id_user, f.id_your_friends, u.first_name, u.last_name, u.profile_image
            FROM friends f
            join
            users u on f.id_your_friends = u.id_user
            Where f.id_user = $id_user
            "; 
            return $dbConn->query($query);
        } else {
            return false;
        }
    }
    // delete friend by id
    // tested
    public static function getDeleteFriend($id_friends){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "
            DELETE FROM friends
            WHERE id_friends = $id_friends";

            return $dbConn->query($query);
        } else {
            return false;
        }
    }
    // add friend
    // tested
    public static function getAddFriend($id_user, $id_your_friends){
        $db = new Database();
        $dbConn = $db->getDBConn();

        if ($dbConn){
            $query = "
            INSERT INTO friends (id_user, id_your_friends)
            VALUES ($id_user, $id_your_friends)";

            return $dbConn->query($query);
        } else {
            return false;
        }
    }
}
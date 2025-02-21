<?php

require_once '../model/friends_db.php';
require_once 'friends.php';


// User controlls for freinds relationship with users
class FriendsController {
    public static function rowToFriend($row) {
        $friend = new Friends(
            $row['id_your_friends'],
            $row['id_user'],
            $row['first_name'],
            $row['last_name'],
            $row['profile_image'],
            $row['id_friends']
        );
        return $friend;
    }
    // retrieve all friends
    public static function getAllFriends($id_user){
        $queryRes = FriendDB::getAllFriends($id_user);
        
        if ($queryRes){
            $friends = [];
            while ($row = $queryRes->fetch_assoc()){
                $friends[] = self::rowToFriend($row);
            }
            return $friends;
        } else {
            return false;
        }
    }
// retrieve friend by id
    public static function getFriendById($id_friends){
        $queryRes = FriendDB::getFriendById($id_friends->getIdFriends());
        
        if ($queryRes){
            return self::rowToFriend($queryRes);
        } else {
            return false;
        }
    }
// delete friend from user
    public static function deleteFriend($id_user, $id_friends){
        return FriendDB::getDeleteFriend($id_user, $id_friends);
    }
// add friend
    public static function addFriend($id_user, $id_friends){
        return FriendDB::getAddFriend($id_user, $id_friends);
    }

    public static function getFiendStatus($id_user, $id_friends){
        $queryRes = FriendDB::getFriendsStatus($id_user, $id_friends);
        
        if ($queryRes->num_rows == 1){
            return true;
        } else {
            return false;
        }
    }



}
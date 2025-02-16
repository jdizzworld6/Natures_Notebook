<?php

require_once '../model/friends_db.php';
require_once 'friends.php';

// User controlls for freinds relationship with users
class FriendsController {
    public static function rowToFriend($row) {
        $friend = new Friends(
            $row['id_user'],
            $row['id_your_friends'],
            $row['id_friends']
        );
        return $friend;
    }
    // retrieve all friends
    public static function getAllFriends($friends){
        $queryRes = FriendDB::getAllFriends($friends->getIdUser());
        
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
    public static function getFriendById($friends){
        $queryRes = FriendDB::getFriendById($friends->getIdFriends());
        
        if ($queryRes){
            return self::rowToFriend($queryRes);
        } else {
            return false;
        }
    }
// delete friend from user
    public static function deleteFriend($friends){
        return FriendDB::getDeleteFriend($friends->getIdFriends());
    }
// add friend
    public static function addFriend($friends){
        return FriendDB::getAddFriend($friends->getIdUser(), $friends->getIdYourFriends());
    }



}
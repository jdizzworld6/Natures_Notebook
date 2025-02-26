<?php

include_once dirname(__FILE__) . '/../model/user_db.php';
require_once 'users.php';


class UsersController {
    public static function rowToUsers($row) {

        // parse User into array of arrays
        $users = new User(
            $row['first_name'],
            $row['last_name'],
            $row['date_of_birth'],
            $row['phone_number'],
            $row['address'],
            $row['city'],
            $row['state'],
            $row['zip'],
            $row['email'],
            $row['username'],
            $row['password'],
            $row['user_level'],
            $row['count_created'],
            $row['profile_image'],
            $row['id_user']
        );
        return $users;
    }
    // get all users
    // tested
    public static function getAllUsers($id_user = null){
        $queryRes = UsersDB::getAllUsers($id_user);
        
        if ($queryRes){
            $users = [];
            while ($row = $queryRes->fetch_assoc()){
                $users[] = self::rowToUsers($row);
            }
            return $users;
        } else {
            return false;
        }
    }
    // get user by id
    // tested
    public static function getUserById($id){
        $queryRes = UsersDB::getUserById($id);
        
        if ($queryRes){
            return self::rowToUsers($queryRes);
        } else {
            return false;
        }
    }
    // delete user by id
    // tested
    public static function deleteUser($id_user){
        return UsersDB::deleteUser($id_user);
    }
    // add user
    // tested
    public static function addUser($user){
        return UsersDB::addUser(
            $user->getFirst_name(),
            $user->getLast_name(),
            $user->getDate_of_birth(),
            $user->getPhone_number(),
            $user->getAddress(),
            $user->getCity(),
            $user->getState(),
            $user->getZip(),
            $user->getEmail(),
            $user->getUsername(),
            $user->getPassword(),
            $user->getUserLevel()
        );
    }
    // update user
    // tested
    public static function updateUser($user){
        return UsersDB::updateUser(
            $user->getId_user(),
            $user->getFirst_name(),
            $user->getLast_name(),
            $user->getDate_of_birth(),
            $user->getPhone_number(),
            $user->getAddress(),
            $user->getCity(),
            $user->getState(),
            $user->getZip(),
            $user->getEmail(),
            $user->getUsername(),
            $user->getPassword()
        );
    }
    public static function updateUserProfileImage($id_user, $profile_image){
        return UsersDB::updateProfilePhoto(
            $id_user,
            $profile_image
        );
    }
    // validate user by username and password
    // tested
    public static function validUser($userID, $password){
        // running query to recieve results from query
        $queryRes = UsersDB::getUserValidation($userID, $password);
        // changing query results to new user and getting user level
        if($queryRes){
            $user = self::rowToUsers($queryRes);
            if ($user->getPassword() === $password){
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getUserByUserNamePassword($userName, $password){
        // running query to recieve results from query
        $queryRes = UsersDB::getUserByUsernamePassword($userName, $password);
        // changing query results to new user and getting user level
        if($queryRes){
            $user = self::rowToUsers($queryRes);
            if ($user->getPassword() === $password){
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
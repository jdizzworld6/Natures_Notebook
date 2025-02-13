<?php

require_once '../model/database.php';
require_once '../model/user_db.php';
require_once '../model/photo_category_db.php';
require_once '../model/photo_db.php';
require_once '../model/friends_db.php';
require_once '../model/blocklist_db.php';

// $db1 = new Database();

// $result = UsersDB::addUser('Jeremy', 'Hansen', '05-25-2025', '406-855-0787', '1209 Bench Blvd', 'Billings', 'MT', '59102', 'jerhan@ecpi.com', 'jdizzworld', 'password123', 1);

// $result = UsersDB::updateUser(16,"fname","lname","1983-01-02", '555-555-5555', '354 Semor st', 'Belmore', 'AL', '59999', 'test@gmail.com', 'testusername', 'testpassword');



// PhotoCategoryDB::addPhotoCategory('Wild Flowers', 'Flowers grown in the wild');

// $result = PhotoCategoryDB::getPhotoCategoryById(2);

// $result = PhotoCategoryDB::getAllPhotoCategory();

// $result = PhotoCategoryDB::deletePhotoCategory(1);

// $result = PhotoCategoryDB::updateCategoryDescription(2,"Wild Mushrooms", "Colorfull Mushrooms");

// $result = PhotoDB::addPhoto(1,1,"Something_mushroom", "My mushroom", "mypathtomushroom.png", '2025-05-25');


// $r = PhotoDB::getPhotoById(1);
// $r = PhotoDB::getAllPhotos();

// $r = PhotoDB::updatePhoto(1,2,2,'test', 'test', 'test', '2025-02-02');

// $r = PhotoDB::getAllPhotosCategory(2);

// $r = PhotoDB::getAllPhotosUser(2);
// $r = PhotoDB::getAllPhotosUserAndCategory(3,4);

// PhotoDB::deletePhoto(2);

// $r = FriendDB::getAllFriends(1);



// $r = BlocklistDB::getAllBlocklist();
// $r = BlocklistDB::getBlocklistById(1);
// $r = BlocklistDB::deleteBlocklist(1);
// $r = BlocklistDB::addBlocklist('406-666-8888', 'test2@gmail.com');
$r = BlocklistDB::updateBlocklist('406-855-0555', 'test1@gmail.com', 1);

$test = "test";


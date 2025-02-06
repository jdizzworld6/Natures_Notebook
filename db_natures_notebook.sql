Drop DATABASE IF EXISTS db_natures_notebook;
CREATE DATABASE db_natures_notebook DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_natures_notebook;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(60),
    last_name VARCHAR(60),
    profile_image VARCHAR(150),
    date_of_birth DATE,
    phone_number VARCHAR(14),
    address VARCHAR(100),
    city varchar(50),
    state varchar(6),
    zip varchar(10),
    email varchar(70),
    username varchar(30),
    password varchar(60),
    user_level int,
    count_created datetime
);
DROP TABLE if EXISTS photo;
Create TABLE photo (
    id_photo int AUTO_INCREMENT PRIMARY KEY,
    id_user int, -- Foriegn Key for users table
    id_photo_category int, -- Foriegn Key for photo_category table
    photo_name varchar(100),
    description varchar(1000),
    photo_url varchar(150),
    upload_date datetime,
    FOREIGN KEY (id_user) REFERENCES users(id_user) -- one to many with users tbl
    );
 
 DROP TABLE if EXISTS friends;
 CREATE TABLE friends (
     id_friends int AUTO_INCREMENT PRIMARY KEY,
     id_user int, -- Foreign key for one to many users tbl
     id_your_friends int,
     FOREIGN KEY (id_user) REFERENCES users(id_user) -- one to many with users tbl
     );
 DROP TABLE if EXISTS photo_category;
 CREATE TABLE photo_category (
     id_photo_category int AUTO_INCREMENT PRIMARY KEY,
     category_name varchar(60),
     category_description varchar(500)
     );
     
 DROP TABLE if EXISTS blocklist;
 CREATE TABLE blocklist (
     id_blocklist int AUTO_INCREMENT PRIMARY KEY,
     phone_number varchar(14),
     email varchar(70)
     );


 -- User 1
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (1, 'John', 'Doe', '1990-01-15', '555-1234', '123 Main St', 'Anytown', 'CA', '12345', 'john.doe@example.com', 'johndoe', 'password123', 1, 1);

-- User 2
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (2, 'Jane', 'Smith', '1985-07-04', '555-5678', '456 Oak Ave', 'Othertown', 'NY', '56789', 'jane.smith@example.com', 'janesmith', 'password456', 2, 1);

-- User 3
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (3, 'David', 'Lee', '1992-11-20', '555-9012', '789 Elm St', 'Someville', 'TX', '78901', 'david.lee@example.com', 'davidlee', 'password789', 1, 1);

-- User 4
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (4, 'Sarah', 'Jones', '1988-03-10', '555-3456', '101 Pine Rd', 'Anytown', 'CA', '12345', 'sarah.jones@example.com', 'sarahjones', 'password123', 2, 1);

-- User 5
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (5, 'Michael', 'Brown', '1979-05-25', '555-7890', '200 Oak Ave', 'Othertown', 'NY', '56789', 'michael.brown@example.com', 'michaelbrown', 'password456', 1, 1);

-- User 6
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (6, 'Emily', 'Davis', '1995-09-18', '555-1234', '300 Elm St', 'Someville', 'TX', '78901', 'emily.davis@example.com', 'emilydavis', 'password789', 2, 1);

-- User 7
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (7, 'James', 'Garcia', '1982-12-12', '555-5678', '400 Pine Rd', 'Anytown', 'CA', '12345', 'james.garcia@example.com', 'jamesgarcia', 'password123', 1, 1);

-- User 8
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (8, 'Karen', 'Wilson', '1989-06-21', '555-9012', '500 Oak Ave', 'Othertown', 'NY', '56789', 'karen.wilson@example.com', 'karenwilson', 'password456', 2, 1);

-- User 9
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (9, 'Robert', 'Martinez', '1977-08-08', '555-3456', '600 Elm St', 'Someville', 'TX', '78901', 'robert.martinez@example.com', 'robertmartinez', 'password789', 1, 1);

-- User 10
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (10, 'Linda', 'Anderson', '1984-04-15', '555-7890', '700 Pine Rd', 'Anytown', 'CA', '12345', 'linda.anderson@example.com', 'lindaanderson', 'password123', 2, 1);

-- User 11
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (11, 'Thomas', 'Jackson', '1991-10-30', '555-1234', '800 Oak Ave', 'Othertown', 'NY', '56789', 'thomas.jackson@example.com', 'thomasjackson', 'password456', 1, 1);

-- User 12
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (12, 'Maria', 'Perez', '1987-02-20', '555-9012', '900 Elm St', 'Someville', 'TX', '78901', 'maria.perez@example.com', 'mariaperez', 'password789', 2, 1);

-- User 13
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (13, 'Charles', 'Young', '1983-07-05', '555-3456', '1000 Pine Rd', 'Anytown', 'CA', '12345', 'charles.young@example.com', 'charlesyoung', 'password123', 1, 1);

-- User 14
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (14, 'Christopher', 'Brown', '1994-11-15', '555-7890', '1100 Oak Ave', 'Othertown', 'NY', '56789', 'christopher.brown@example.com', 'christopherbrown', 'password456', 2, 1);

-- User 15
INSERT INTO users (id_user, first_name, last_name, date_of_birth, phone_number, address, city, state, zip, email, username, password, user_level, count_created) 
VALUES (15, 'Daniel', 'Davis', '1980-09-02', '555-1234', '1200 Elm St', 'Someville', 'TX', '78901', 'daniel.davis@example.com', 'danieldavis', 'password789', 1, 1);

DROP USER if EXISTS BusyBees;
CREATE USER BusyBees@'%' IDENTIFIED BY 'SierJerSDC480';


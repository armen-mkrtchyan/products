<?php

$servername = 'mysql:host=localhost; dbname=user';
$username = "root";
$password = "";

try {
    $conn = new PDO($servername, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS `users` (
    id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   login VARCHAR (255) NOT NULL,
    password VARCHAR(255)NOT NULL,
  cookie_key VARCHAR(255) NULL
)";
    // use exec() because no results are returned
    $conn->exec($sql);
//    echo "Table MyGuests created successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


$cat = "CREATE TABLE IF NOT EXISTS `categories`(
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR (255),
create_time DATETIME,
update_time TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)";

$conn->exec($cat);

$models ="CREATE TABLE IF NOT EXISTS `models`(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255),
category_id INT(11),
create_time DATE,
update_time TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)";


$conn->exec($models);

$product = "CREATE TABLE IF NOT EXISTS `product`(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
category_id INT(11),
model_id INT(11),
img_path VARCHAR(255),
isNew TINYINT(1),
desc_info TEXT,
price INT(11),
create_time DATE,
update_time TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)";

$conn->exec($product);

//$cars = 'INSERT INTO `categories`(name,create_time,update_time) VALUES("BMW",now(),now())';
//
//$conn->exec($cars);
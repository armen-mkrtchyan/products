<?php

include 'connect.php';

$id = $_POST['id'];
$name = $_POST['name'];


$update = $conn->prepare("UPDATE `categories` SET `name`='$name' WHERE `id`='$id'");
$update->execute();

echo "true";
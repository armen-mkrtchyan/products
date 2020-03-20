<?php
include 'connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$f_id=$_POST["faterID"];

$update = $conn->prepare("UPDATE `models` SET `name`='$name',`category_id`='$id' WHERE `id`='$f_id'");
$update->execute();

echo "true";
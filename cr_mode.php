<?php

include "connect.php";
$name = $_POST['name'];
$sel=$_POST["sel"];

$ins = "INSERT INTO `models` SET `name`='$name ',`category_id`='$sel' ";
$conn->exec($ins);

header("Location:models.php");
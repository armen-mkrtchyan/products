<?php
include 'connect.php';

$href = $_POST['href'];
$sql = "DELETE FROM `categories` WHERE id='$href'";

$conn->exec($sql);
if (isset($href)){
    echo "true";
}
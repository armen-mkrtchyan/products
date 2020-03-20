<?php
include 'connect.php';

$href = $_POST['href'];
$sql = "DELETE FROM `models` WHERE id='$href'";

$conn->exec($sql);
if (isset($href)){
    echo "true";
}
<?php
session_start();
//include_once "connect.php";
global $dbLogin;
$dbName = $_COOKIE["name"];
//$sql = "UPDATE `users` SET cookie_key=NULL WHERE login='$dbName'";
//$stmt = $conn->prepare($sql);
//$stmt->execute();
setcookie("Cookie_key", $ccKey, time() - 3600, "/");
setcookie("name",  $dbLogin, time() - 3600, "/");
if (isset($_SESSION["name"])) {
    unset($_SESSION["name"]);
}
header("Location:index.php");

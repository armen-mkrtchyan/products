<?php
session_start();
include_once "connect.php";
$login = $_POST['login'];
$pass = $_POST['pass'];
$chekt = $_POST["ch"];
//echo $globID = '';
if (!empty($login && $pass)) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE login='$login' AND password='$pass'");
    $stmt->execute();

    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbLogin = $info[0]["login"];
    $dbPassword = $info[0]["password"];
    $globID = $dbId = $info[0]["id"];
    if ($login == $dbLogin) {
        if ($pass == $dbPassword) {
            for ($i = 0; $i <= 20; $i++) {
                if ($i % 2 == 0) {
                    $ccKey .= chr(mt_rand(97, 122));
                } else {
                    $ccKey .= mt_rand(1, 90);
                }
            }
            $_SESSION["login"] = $dbLogin;
            $_SESSION["id"] = $dbId;
            $_SESSION["bool"]=true;

            $sql = "UPDATE `users` SET cookie_key='$ccKey' WHERE id='$dbId'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
//            if($chekt !=='on'){
//                echo 1;
//            }

            if ($chekt == "on") {
                setcookie("Cookie_key", "$ccKey", time() + 60 * 60 * 24, "/");
                setcookie("name", "$dbLogin", time() + 60 * 60 * 24, "/");
            }
            header("Location:admin.php");

        } else {
            $_SESSION["dbpass"] = "sxal password";
            header("Location:index.php");
        }
    } else {
        $_SESSION["dbLogin"] = "sxal login";
        header("Location:index.php");
    }
} else {
    $_SESSION["empty"] = "mutkagrek informachia";
    header("Location:index.php");
}
$ccKey = "";
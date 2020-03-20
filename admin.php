<?php
session_start();

//$indeficatorId = $_SESSION["id"];
//$cok=$_SESSION["cook"];


//$ChekCook = $info[0]["cookie_key"];
//$Chekname = $info[0]["login"];

if (!empty($_SESSION["login"]) && $_SESSION["bool"] == true) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 pl-0 menu_style">
                <div class="text-center">
                    <div><h3 class="menu pt-4">Menu</h3></div>

                </div>
                <div class="links_one">
                    <a class="btn btn-primary mb-2" href="models.php" role="button">Models</a>
                </div>
                <div class="links_two">
                    <a class="btn btn-primary mb-2" href="cars.php" role="button">Category</a>
                </div>
                <div class="links_three">
                    <a class="btn btn-primary mb-2" href="product.php" role="button">Product</a>
                </div>
                <div class="links_for">
                    <a class="btn btn-primary mb-2 ex" href="logout.php" role="button">Exit</a>
                </div>

            </div>
<!--            <div class="col-10">-->
<!---->
<!--            </div>-->


    <?php


} else if (isset($_COOKIE["name"]) && isset($_COOKIE["Cookie_key"])) {
    include_once "connect.php";
    $Cok = $_COOKIE["Cookie_key"];
    $Cname = $_COOKIE["name"];
    echo "<pre>";
    var_dump($Cok);
    var_dump($Cname);
    $stmt = $conn->prepare("SELECT * FROM `users`");
    $stmt->execute();

    $CookInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($Cname == $CookInfo[0]['login'] && $Cok == $CookInfo[0]["cookie_key"]) {
        ?>
        <h1>COOKIE Run</h1>
        <a href="logout.php">Exit</a>
        <?php
    } else {
        header("Location:index.php");
        die();
    }

} else {

    header("Location:index.php");
    die();
}
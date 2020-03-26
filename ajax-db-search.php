<?php
include "connect.php";

if (isset($_POST['query'])) {
//var_dump($id);
    $query = $conn->prepare("SELECT * FROM `product` WHERE `name`  LIKE '{$_POST['query']}%'");
    $query->execute();



    if ($query->rowCount() > 0) {
        while ($product = $query->fetchAll(PDO::FETCH_ASSOC)) {
            echo json_encode($product);
        }
    } else {
        echo "<p style='color:red'>Product not found...</p>";
    }

}

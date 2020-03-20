<?php
include "connect.php";
$cat = $conn->prepare("SELECT * FROM `categories`");
$cat->execute();
$result = $cat->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
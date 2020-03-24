<?php
include "connect.php";

$del = $_POST['href'];

$del_rows = "DELETE FROM `product` WHERE id= '$del'";

$conn->exec($del_rows);

echo 1;

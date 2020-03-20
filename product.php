<?php
ob_start();
include "connect.php";


$models_category = $conn->query("SELECT
`pro`.*, `cate`.`name` AS `cate_name`, `model`.`name`  AS `mode_name` 
FROM
`product` AS `pro`
LEFT JOIN `categories` AS `cate` ON `pro`.category_id = `cate`.id
LEFT JOIN `models` AS `model` ON `pro`.`model_id` = `model`.`id`");

$models_category->execute();
$result = $models_category->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php include "admin.php" ?>
<div class="col-10">
    <a href="create_product.php">Create product</a>
    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">Category_name</th>
            <th scope="col">Model</th>
            <th scope="col">isNew</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Desc</th>
            <th scope="col">Create time</th>
            <th scope="col">Update time</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"></th>
                <td>fdsf</td>
                <td>fdsf</td>
                <td>fdsf</td>
                <td>fdsf</td>
                <td>fdss</td>
                <td>fdssf</td>
                <td>fdsf</td>
                <td>gfdg</td>
                <td>gfdgd</td>
                <td>
                    <button type="button" class="change" data-id=""><i
                                class="fa fa-pencil-square-o edit" aria-hidden="true"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="delete" data-id=""><i class="fa fa-trash del"
                                                                                      aria-hidden="true"></i>
                    </button>
                </td>

            </tr>

        </tbody>
    </table>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>

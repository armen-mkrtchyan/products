<?php
ob_start();
include "connect.php";
$pro = $conn->prepare("SELECT * FROM categories");
$pro->execute();
$result = $pro->fetchAll(PDO::FETCH_ASSOC);

$mod = $conn->prepare("SELECT * from models");
$mod->execute();
$models = $mod->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<body>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <div class="mb-4">
                <label for="">New Product</label>
            <input type="text" class="form-control" name="pro" placeholder="Enter new product">
            </div>
            <label for="exampleFormControlSelect1">PRODUCT  model</label>
            <select class="form-control" id="selectmodel" name="model">
                <?php foreach ($models as $m):?>
                    <option value="<?=$m['id']?>"><?=$m['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select class="form-control" id="exampleFormControlSelect1" name="sel">
                <?php foreach ($result as $r):?>
                    <option value="<?=$r['id']?>"><?=$r['name']?></option>
                <?php endforeach; ?>
            </select>
            <label for="">Image</label>
            <input type="text" class="form-control" name="img" placeholder="Enter a Image path">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="0">
            <label class="form-check-label" for="exampleRadios1">
                Old
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="1">
            <label class="form-check-label" for="exampleRadios2">
                New
            </label>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
        </div>
        <label for="">Product Price</label>
        <input type="number" class="form-control" name="price" placeholder="Enter a price">

        <button class="btn btn-primary mt-2" type="submit" name="submit">Submit</button>

    </form>

</div>

<?php if(isset($_POST['submit'])) {
    $product = $_POST['pro'];
    $model_id = $_POST['model'];
    $category_id = $_POST['sel'];
    $img_path = $_POST['img'];
    $old = $_POST['exampleRadios'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];

    $q = "INSERT INTO `product` (`name`,`img_path`,`isNew`, `model_id` ,`category_id`,`desc_info`,`price`,`create_time`,`update_time`) 
    VALUES ('$product','$img_path',$old,$model_id,$category_id,'$desc','$price',now(),now())";

    $newProduct = $conn->prepare($q);

    $newProduct->execute();
    header("Location:product.php");

}
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php
ob_start();
session_start();
include "connect.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$notesOnePage = 4;

$from = ($page - 1) * $notesOnePage;

$models_category = $conn->query("SELECT
`pro`.*, `cate`.`name` AS `cate_name`, `model`.`name`  AS `mode_name` 
FROM
`product` AS `pro`
LEFT JOIN `categories` AS `cate` ON `pro`.category_id = `cate`.id
LEFT JOIN `models` AS `model` ON `pro`.`model_id` = `model`.`id` LIMIT $from,$notesOnePage");

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
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.4.1.min.js"></script>

</head>
<body>
<?php include "admin.php" ?>
<div class="col-10">
    <div class="creat mb-2"><a class="btn btn-info" href="create_product.php" role="button">Create product</a></div>
    <?php include "seach.php";

    ?>
<div>


    <div class="table" id="table">
    <table class="table table-bordered table-dark" >
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
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

        <tbody >
        <?php foreach ($result as $item =>$val):?>
            <tr>
                <th scope="row"><?=$val['id']?></th>
                <td><?=$val['name']?></td>
                <td><?=$val['cate_name']?></td>
                <td><?=$val['mode_name']?></td>
                <td><?=$val['isNew']?></td>
                <td><?=$val['price']?></td>
                <td><?=$val['img_path']?></td>
                <td><?=$val['desc_info']?></td>
                <td><?=$val['create_time']?></td>
                <td><?=$val['update_time']?></td>
                <td>
                    <button type="button" class="change" data-id="<?=$val['id']?>"><i
                                class="fa fa-pencil-square-o edit" aria-hidden="true"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="delete" data-id="<?=$val['id']?>"><i class="fa fa-trash del"
                                                                                      aria-hidden="true"></i>
                    </button>
                </td>

            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
    <?php $countPage = $conn->query("SELECT COUNT(id) as count FROM `product`");


    $countPage->execute();

    $count =  $countPage->fetchAll(PDO::FETCH_ASSOC)[0]["count"];
    $pagesCount = ceil($count / $notesOnePage);

    for($i = 1;$i <= $pagesCount;$i++){
        if($pagesCount == 1) break;
        if($page == $i){
            echo "<a href='?page=$i' class='act'>$i </a>";
        }else{
            echo "<a href='?page=$i'>$i </a>";
        }

    } ?>

    </div>
</div>
<script>
 $('.delete').click(function () {
    let delRow = $(this).attr('data-id');
let c = confirm("delete?");
if(c) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'delete_product.php',
        data: {href: delRow},
        success: function (res) {
            window.location = 'product.php';
        }
    })
}

 });
$('.change').click(function() {
    let idCh = $(this).attr("data-id");
    let id = $(this).closest("tr")[0].cells[0].innerText;
    // console.log(id);
    let pro_name = $(this).closest("tr")[0].cells[1].innerText;
    let cat_name = $(this).closest("tr")[0].cells[2].innerText;
    let mod_name = $(this).closest("tr")[0].cells[3].innerText;
    let is_new = $(this).closest("tr")[0].cells[4].innerText;
    let price = $(this).closest("tr")[0].cells[5].innerText;
    let image = $(this).closest("tr")[0].cells[6].innerText;
    let desc = $(this).closest("tr")[0].cells[7].innerText;
    //
    window.location = `edit_product.php?product=${id}`;


})


</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"-->
<!--        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"-->
<!--        crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>

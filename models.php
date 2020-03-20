<?php
include "connect.php";
ob_start();

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$notesOnePage = 4;

$from = ($page - 1) * $notesOnePage;

$models_category = $conn->query("SELECT  `mod`.*, `cat`.`name` AS `cat_name`
FROM `models` AS `mod`
         LEFT JOIN `categories` AS `cat`
                   ON `mod`.`category_id` = `cat`.`id`  LIMIT $from,$notesOnePage");
$models_category->execute();
$arrModels = $models_category->fetchAll(PDO::FETCH_ASSOC);


//var_dump($pagesCount);

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
    <a class="btn btn-primary" href="create_models.php" role="button">Create Models</a>
    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category_name</th>
            <th scope="col">name</th>
            <th scope="col">Create time</th>
            <th scope="col">Updat time</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arrModels as $c): ?>
            <tr>
                <th scope="row"><?= $c['id'] ?></th>
                <td><?= $c['cat_name'] ?></td>
                <td><?= $c['name'] ?></td>
                <td><?= $c['create_time'] ?></td>
                <td><?= $c['update_time'] ?></td>
                <td>
                    <button type="button" class="change" data-id="<?= $c['id']; ?>"><i
                                class="fa fa-pencil-square-o edit" aria-hidden="true"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="delete" data-id="<?= $c['id'] ?>"><i class="fa fa-trash del"
                                                                                      aria-hidden="true"></i>
                    </button>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php

 $countPage = $conn->query("SELECT COUNT(id) as count FROM `models`");


$countPage->execute();

$count =  $countPage->fetchAll(PDO::FETCH_ASSOC)[0]["count"];
$pagesCount = ceil($count / $notesOnePage);

    for($i = 1;$i <= $pagesCount;$i++){
        if($page == $i){
            echo "<a href='?page=$i' class='act'>$i </a>";
        }else{
            echo "<a href='?page=$i'>$i </a>";
        }

    }


//?>
</div>
<script>
    $('.change').on('click', function () {
        let idCh = $(this).attr("data-id");
        let id = $(this).closest("tr")[0].cells[0].innerText;
        let name = $(this).closest("tr")[0].cells[1].innerText;
        $('.col-10').before(`<form id="formUp">
                            <input type="text" id="InputVal" value="${name}" class="ml-3 mb-2">
                             <select name="" id="seletc">
                                <option>---</option>
                                </select>
                            <button type="button" data-id="${idCh}" class="btn btn-success save">Save</button>
                          <form>`);
        $.ajax({
            url: "select-php.php",
            type: "post",
            dataType: "json",
            success: function (data) {
                console.log(data);
                data.forEach((i) => (
                    $("#seletc").append(`
                   <option value="${i.id}">${i.name}</option>
                `)
                ));

            }
        });
        $('.save').on('click', function () {
            let _id = $(this).attr('data-id');
            let IntVale = $("#InputVal").val();
            let selectVale = $("#seletc").val();
            console.log(_id);
            // $("#formUp").remove();
            // let name_change = $(this)[0].parentElement[0].value;

            $.ajax({
                url: 'edit_mod.php',
                type: 'post',
                dataType: 'json',
                data: {id: selectVale, name: IntVale, faterID: _id},
                success: function (data) {
                    if (data === true) {
                        window.location = "models.php";

                    }

                }
            })
        });
    });

    $('.delete').click(function () {
        let del = $(this).attr('data-id');
        console.log(del);
        let c = confirm('delete?');
        if (c) {
            $.ajax({
                url: 'del-for-models.php',
                type: 'post',
                dataType: 'json',
                data: {href: del},
                success: function (res) {
                    if (res === true) {
                        // window.location = "models.php?";
                        window.location.reload();
                    }
                }
            })
        }
    })

</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
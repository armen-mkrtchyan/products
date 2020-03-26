<?php
ob_start();
include 'connect.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$notesOnePage = 4;

$from = ($page - 1) * $notesOnePage;


$cat = $conn->prepare("SELECT * FROM `categories` ORDER BY id DESC LIMIT $from,$notesOnePage");
$cat->execute();
$result = $cat->fetchAll(PDO::FETCH_ASSOC);
//include 'admin.php'


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
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-3.4.1.min.js"></script>

    </head>
    <body>

    <?php include "admin.php"; ?>

<div class="col-10">
    <a class="btn btn-primary mb-2" href="create_cat.php" role="button">Create Category</a>
        <table class="table table-striped">

            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">Create Date</th>
                <th scope="col">Update Date</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($result as $p): ?>
                <tr id="del<?=$p['id']?>">
                    <th scope="row"><?= $p['id'] ?></th>
                    <td><?= $p['name'] ?></td>
                    <td> <?= $p['create_time'] ?></td>
                    <td><?= $p['update_time'] ?></td>
                    <td>
                        <button type="button" class="change"><i class="fa fa-pencil-square-o edit" aria-hidden="true"></i></button>
                    </td>
                    <td>
                   <button type="button" class="delete" data-id="<?=$p['id']?>"><i class="fa fa-trash del" aria-hidden="true"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
<?php $countPage = $conn->query("SELECT COUNT(id) as count FROM `categories`");


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

    <script>
        $('.change').on('click', function () {
            let id = $(this).closest("tr")[0].cells[0].innerText;
            let name = $(this).closest("tr")[0].cells[1].innerText;
            $('.container-fluid').before(`<form id="formUp">
                            <input type="text" value="${name}" class="ml-3 mb-2">
                            <button type="button" data-id="${id}" class="btn btn-success save">Save</button>
                          <form>`);

            $('.save').on('click', function () {
                let _id = $(this).attr('data-id');
                // $("#formUp").remove();
                let name_change = $(this)[0].parentElement[0].value;

                $.ajax({
                    url: 'edit.php',
                    type: 'post',
                    dataType: 'json',
                    data: {id:_id, name:name_change},
                    success: function (data) {
                        window.location="cars.php";
                    }
                })
            });
        });
    </script>

<script>
  $('.delete').click(function(){
     let del = $(this).attr('data-id');
      let c = confirm('delete?');
     if(c){
         $.ajax({
             url:'delete.php',
             type:'post',
             dataType: 'json',
             data:{href:del},
             success:function(res) {
                 if (res===true){
                     $("#del"+del).remove();
                 }

             }


         })
     }


  })

</script>

</div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"-->
<!--            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"-->
<!--            crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    </body>
</html>
    <?php

?>


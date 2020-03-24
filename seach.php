<?php ob_start();  include 'connect.php'?>

<script src="js/jquery-3.4.1.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">
<input type="text" name="search" id="search" autocomplete="off" placeholder="search product">



<script>

    function _delete(id) {
        let c = confirm("delete?");
        if(c) {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: 'delete_product.php',
                data: {href: id},
                success: function (res) {
                    window.location = 'product.php';
                }
            })
        }

    }

    function update() {
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


    }

    $(document).ready(function(){

        $("#search").keyup(function(){
            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: 'ajax-db-search.php',
                    method: 'POST',
                    dataType:'json',
                    data: {query:query},
                    success:function(data){
                        if(data){


                            $('#table').children().remove();
                            let button = '<div><a class="btn btn-danger mt-2 mb-2" href="product.php" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back all product</a></div> ';

                            $('#table').append(button);

                            let tableData = '<table class="table table-bordered table-dark"><thead >\n' +
                                '        <tr>\n' +
                                '            <th scope="col">#</th>\n' +
                                '            <th scope="col">Product</th>\n' +
                                '            <th scope="col">Category_name</th>\n' +
                                '            <th scope="col">Model</th>\n' +
                                '            <th scope="col">isNew</th>\n' +
                                '            <th scope="col">Price</th>\n' +
                                '            <th scope="col">Image</th>\n' +
                                '            <th scope="col">Desc</th>\n' +
                                '            <th scope="col">Create time</th>\n' +
                                '            <th scope="col">Update time</th>\n' +
                                '            <th scope="col">Edit</th>\n' +
                                '            <th scope="col">Delete</th>\n' +
                                '        </tr>\n' +
                                '        </thead>';


                      data.forEach((i)=>{
                          tableData += (`

        <tbody>

            <tr>
                <th scope="row">${i.id}</th>
                <td>${i.name}</td>
                <td>${i.category_id}</td>
                <td>${i.model_id}</td>
                <td>${i.img_path}</td>
                <td>${i.isNew}</td>
                <td>${i.desc_info}</td>
                <td>${i.price}</td>
                <td>${i.create_time}</td>
                <td>${i.update_time}</td>
                <td>
                    <button type="button" class="change" onclick="update()" data-id="${i.id}"><i
                                class="fa fa-pencil-square-o edit" aria-hidden="true"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="delete" onclick="_delete(${i.id})" data-id="${i.id}"><i class="fa fa-trash del"
                                                                                      aria-hidden="true"></i>
                    </button>
                </td>

            </tr>
        </tbody>
`)
                      });
                            tableData+="</table>";
                            $('#table').append(tableData)

                        }
                    }
                });
            } else {
                $('#output').css('display', 'none');
            }
        });
    });




</script>

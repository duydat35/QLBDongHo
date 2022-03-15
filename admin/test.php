<?php
include_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Home</title>
    </head>
<body>
    <!-- main right -->
    <div class="container">
        <div class="main__title mb-3 rounded">
            Quản lý sản phẩm
        </div>
        <div class="main__content shadow p-3 bg-white rounded ">
            <!-- top -->
            <div class="main__top">
                <div >
                    <div class="input-group">
                        <div class="form-outline">
                            <input id="Search" type="" onkeyup="searchTable()" class="form-control" placeholder="Nhập tên đồng hồ" required style="width: 350px"/>
                        </div> 
                        <button class="btn search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div> 
                <a href="index.php?page=add_product">
                    <button class="btn__main" style="height: 46.6px;">
                        <i class="fas fa-plus"></i> 
                        Thêm mới    
                    </button >
                </a>
            </div>
            <!-- table -->
            <div class="main__table">
                <table class="table" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" onclick="sortTable(0)" class="sort">Mã Sản Phẩm</th>
                            <th scope="col" onclick="sortTable(1)" class="sort">Tên Đồng Hồ</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col" onclick="sortTable(3)" class="sort">Thương Hiệu</th>
                            <th scope="col" onclick="sortTable(4)" class="sort">Giá</th>
                            <th  colspan="3">Tác vụ</th>
                            <!-- <th scope="col">Sửa</th>
                            <th scope="col">Xóa</th>    
                            <th scope="col">Chi tiết</th> -->
                        </tr>
                    </thead>    
                    <!-- <tbody>
                    <tr class= "table__row text-center">
                        <td>1</td>
                        <td>ĐỒNG HỒ CASIO MTP-1374L-1AVDF</td>
                        <td class="img-center"><img class="img-size-s" src="../image/dong-ho-casio-1.jpg"></td>
                        <td>Casio</td>
                        <td>1000</td>
                        <td class="text-center"><a href="test.php?page=edit_product" style="color: green;"><i class="fas fa-tools"></i></a></td>
                        <td class="text-center"><a href="#" style="color: red;"><i class="fas fa-trash-alt"></i></a></td>
                    </tr> 
                    <tr class= "table__row text-center">
                        <td >3</td>
                        <td>sĐỒNG HỒ CASIO MTP-1374L-1AVDF</td>
                        <td class="img-center"><img class="img-size-s" src="../image/dong-ho-casio-2.jpg"></td>
                        <td>Casio</td>
                        <td>1000</td>
                        <td class="text-center"><a href="#" style="color: green;"><i class="fas fa-tools"></i></a></td>
                        <td class="text-center"><a href="#" style="color: red;"><i class="fas fa-trash-alt"></i></a></td>
                    </tr> 
                    <tr class= "table__row text-center">
                        <td>2</td>
                        <td>aĐỒNG HỒ CASIO MTP-1374L-1AVDF</td>
                        <td class="img-center"><img class="img-size-s" src="../image/dong-ho-casino-3.webp"></td>
                        <td>Casio</td>
                        <td>1000</td>
                        <td class="text-center"><a href="#" style="color: green;"><i class="fas fa-tools"></i></a></td>
                        <td class="text-center"><a href="#" style="color: red;"><i class="fas fa-trash-alt"></i></a></td>
                    </tr> 
                    </tbody> -->
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM sanpham";
                        $result_set=mysqli_query($con, $sql);
                        $n=0;
                            while($row=mysqli_fetch_row($result_set))
                            {
                                // var_dump($arr);
                                ?>
                                    <tr class= "table__row text-center">
                                        <td><?php echo $row[1] ?></td>
                                        <td class="img-center"><img class="img-size-s" src="../image/<?php echo $row[2] ?>"></td>
                                        <td><?php echo $row[3] ?></td>
                                        <td><?php echo $row[4] ?></td>
                                        <td ><a href="index.php?page=edit_product&ID=<?php echo $row[0] ?>" style="color: green;"><i class="fas fa-tools"></i></td>
                                        <td ><a href="javascript:Delete_ID('<?php echo $row[0] ?>')" style="color: red;"><i class="fas fa-trash-alt"></i></td>
                                        <td ><a class="submit"  data-id='<?php echo $row[0] ?>' style="color: #4399e3;" ><i class="fas fa-info-circle"></i></a> </td>
                                    </tr> 
                                 <?php
                            }
                        ?>
                    </tbody>
                </table>
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="submit" data-id="107">
                    Launch demo modal
                    </button> -->

                    <!-- Modal -->
                    <p id="as"></p>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chi tiêt đồng h</h5>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                        </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
    
<script type="text/javascript">
  $(document).ready(function(){
   $('.submit').click(function(){ // Click to only happen on announce links
    //  $("#modal_body").val($(this).data('id'));
    //   $('#exampleModal').modal('show');
        var ID = $(this).data('id');
        $.ajax({
                url: 'ajaxfile.php',
                type: 'POST',
                data: {ID:ID},
                success: function(trave){
                    $('.modal-body').html(trave);
                    $('#exampleModal').modal('show');    
                }
        });
   });
});

</script>
<script>        
function Delete_ID(id)
{
    if(confirm('Bạn có muốn xóa'))
    {
        window.location.href="delete_produ  ct.php?ID="+id;
    }
}

function hic() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("MaID");
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      document.getElementById("as").innerHTML = td.textContent;
    }       
  }
}
</script>
<script src="./table.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
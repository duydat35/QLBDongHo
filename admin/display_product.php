<?php
include_once 'config.php';
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <title>Home</title>
</head>
<body>
    <!-- main right -->
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
                            <th scope="col" onclick="sortTableNumber(0)" class="sort">Mã</th>
                            <th scope="col" onclick="sortTable(1)" class="sort">Tên Đồng Hồ</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col" onclick="sortTable(3)" class="sort">Thương Hiệu</th>
                            <th scope="col" onclick="sortTableNumber(4)" class="sort">Giá</th>
                            <th  colspan="3">Tác vụ</th>
                        </tr>
                    </thead>   
                    
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM sanpham ORDER BY MaSP DESC";
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            {
                                ?>
                                    <tr class= "table__row text-center">
                                        <td  scope="row" style="width:60px !important; padding: 10px 0 !important;"><?php echo $row['MaSP'] ?></td>
                                        <td ><?php echo $row['TenSP'] ?></td>
                                        <td  class="img-center"><img class="img-size-s" src="../image/<?php echo $row['AnhSP'] ?>"></td>
                                        <td ><?php echo $row['ThuongHieu'] ?></td>
                                        <td ><?php echo number_format(floatval($row['Gia'])); ?></td>
                                        <td style="padding: 10px 3px !important; width: 27px" ><a class="submit" data-id='<?php echo $row['MaSP'] ?>'  style="color: #4399e3;"><i class="fas fa-info-circle"></i></td>
                                        <td style="padding: 10px 3px !important; width: 27px" ><a href="index.php?page=edit_product&ID=<?php echo $row['MaSP'] ?>" style="color: green;"><i class="fas fa-tools"></i></td>
                                        <td style="padding: 10px 3px !important; width: 27px" ><a href="javascript:Delete_ID('<?php echo $row['MaSP'] ?>')" style="color: red;"><i class="fas fa-trash-alt"></i></td>
                                        
                                    </tr> 
                                 <?php
                            }
                        }
                        ?>
                    </tbody>
                    
                </table>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 60% !important">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: var(--color-third);">
                            <h5 class="modal-title " id="exampleModalLabel">Chi tiết đồng hồ</h5>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>        
// details Tabale

$(document).ready(function(){
  $('.submit').click(function(){ // Click to only happen on announce links
   //  $("#modal_body").val($(this).data('id'));
    //  $('#exampleModal').modal('show');
       var ID = $(this).data('id');
      //  alert(ID);
       $.ajax({
               url: 'info_product.php',
               type: 'POST',
               data: {ID:ID},
               success: function(trave){
                   $('.modal-body').html(trave);
                   $('#exampleModal').modal('show');    
               }
       });
  });
});


function Delete_ID(id)
{
    if(confirm('Bạn có muốn xóa'))
    {
        window.location.href="delete_product.php?ID="+id;
    }
}
</script>
<script src="./table.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
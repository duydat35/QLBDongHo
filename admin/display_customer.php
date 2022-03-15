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
    
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <title>Home</title>
    </head>
<body>
    <!-- main right -->
    <div class="container">
        <div class="main__title mb-3 rounded">
            Quản lý khách hàng
        </div>
        <div class="main__content shadow p-3 bg-white rounded ">
            <!-- top -->
            <div class="main__top">
                <div >
                    <div class="input-group">
                        <div class="form-outline">
                            <input id="Search" type="" onkeyup="searchTable()" class="form-control" placeholder="Nhập tên khách hàng" required style="width: 350px"/>
                        </div> 
                        <button class="btn search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div> 
                <!-- <a href="index.php?page=add_customer">
                    <button class="btn__main" style="height: 46.6px;">
                        <i class="fas fa-plus"></i> 
                        Thêm mới    
                    </button >
                </a> -->
            </div>
            <!-- table -->
            <div class="main__table">
                <table class="table" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" onclick="sortTableNumber(0)" class="sort">Mã</th>
                            <th scope="col" onclick="sortTable(1)" class="sort">Tên Khách Hàng</th>
                            <th scope="col">Giới Tính</th>
                            <th scope="col" onclick="sortTableNumber(3)" class="sort">Điện Thoại</th>
                            <th scope="col" onclick="sortTable(4)" class="sort">Địa Chỉ</th>
                            <th colspan="3" style="min-width: 85px;">Tác vụ</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM khachhang";
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_row($result_set))
                            {
                                ?>
                                    <tr class= "table__row text-center">
                                        <td scope="row" style="width:60px !important; padding: 10px 0 !important;"><?php echo $row[0] ?></td>
                                        <td><?php echo $row[1] ?></td>
                                        <td><?php echo $row[3] ?></td>
                                        <td><?php echo $row[2] ?></td>
                                        <td><?php echo $row[6] ?></td>
                                        <td style="padding: 10px 3px !important; width: 27px" ><a class="submit" data-id='<?php echo $row[0] ?>' style="color: #4399e3;"><i class="fas fa-info-circle"></i></td>
                                        <td style="padding: 10px 3px !important; width: 27px" ><a href="index.php?page=edit_customer&ID=<?php echo $row[0] ?>" style="color: green;"><i class="fas fa-tools"></i></td>
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
                            <h5 class="modal-title " id="exampleModalLabel">Chi tiết khách hàng</h5>
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
    </div>
<script>        
$(document).ready(function(){
  $('.submit').click(function(){ // Click to only happen on announce links
   //  $("#modal_body").val($(this).data('id'));
    //  $('#exampleModal').modal('show');
       var ID = $(this).data('id');
      //  alert(ID);
       $.ajax({
               url: 'info_customer.php',
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
<script src="./table.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
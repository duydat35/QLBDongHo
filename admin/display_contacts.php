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
            Quản lý liên hệ
        </div>
        <div class="main__content shadow p-3 bg-white rounded ">
            <!-- top -->
            <div class="main__top">
                <div >
                    <div class="input-group">
                        <div class="form-outline">
                            <input id="Search" type="" onkeyup="searchTable()" class="form-control" placeholder="Nhập từ khóa tìm kiếm" required style="width: 350px"/>
                        </div> 
                        <button class="btn search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div> 
            </div>
            <div class="main__table">
                <table class="table" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" onclick="sortTableNumber(0)" class="sort" style="width:60px !important; padding: 10px 0 !important;">Mã</th>
                            <th scope="col" onclick="sortTable(1)" class="sort">Tên Khách Hàng</th>
                            <th scope="col" onclick="sortTable(2)" class="sort">Email</th>
                            <th scope="col" >Tiêu đề</th>
                            <th colspan="3">Tác vụ</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM lienhe ORDER BY MaLH DESC";
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            {
                                ?>
                                    <tr class= "table__row text-center">
                                        <td scope="row"><?php echo $row['MaLH'] ?></td>
                                        <td><?php echo $row['TenKH'] ?></td>
                                        <td><?php echo $row['Email'] ?></td>
                                        <td><?php echo $row['TieuDe'] ?></td>
                                        <td style="padding: 10px 3px !important;" ><a class="submit" data-id='<?php echo $row['MaLH'] ?>' style="color: #4399e3;"><i class="fas fa-info-circle"></i></td>
                                    
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
                            <h5 class="modal-title " id="exampleModalLabel">Chi tiết liên hệ</h5>
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
  $('.submit').click(function(){
       var ID = $(this).data('id');
      //  alert(ID);
       $.ajax({
               url: 'info_contacts.php',
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
<?php
include_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Home</title>
</head>
<body>
<?php
    include_once 'config.php';
    // Lấy dữ liệu từ data lên text
    if(isset($_GET['ID']))
    {
        $sql="SELECT * FROM dathang,khachhang,ctdathang WHERE khachhang.MaKH = dathang.MaKH 
        AND ctdathang.MaPhieuDat = dathang.MaPhieuDat 
        AND dathang.MaPhieuDat='".$_GET['ID']."'GROUP BY dathang.MaPhieuDat ";
        $result_set=mysqli_query($con, $sql);
        $fetched_row=mysqli_fetch_array($result_set);
    } 
    //Sửa dữ liệu
    if(isset($_POST["btn-update"]))
    { 
        // lấy giá trị
        $TrangThai = $_POST['TrangThai'];
        //sửa dũ liệu
        $sql = "UPDATE dathang SET TrangThai='$TrangThai' WHERE MaPhieuDat=".$_GET['ID'];
            if(mysqli_query($con, $sql))
            {   
                ?> 
                <script> 
                alert("Cập nhật thành công");
                window.location.href='index.php?page=display_order'; 
                </script> <?php
            }
            else
            {
                ?> 
                <script> 
                alert("Cập nhật không thành công");
                </script> <?php
            }   
    }
    if(isset($_POST['btn-back']))
        {
            header("Location: index.php?page=display_order");
        } ?>
    <div class="container">
    <div class="main__title mb-3 rounded">
            Sửa trạng thái đơn hàng
        </div>
        <div class="main__content main__edit shadow bg-white rounded ">
            <form method="post">    
                <div class="flex"><span class="span-block">Tên khách hàng </span><input type="text" name="TenKH"  value="<?php echo $fetched_row['TenKH']; ?>" required class="form-control text" disabled/></div>
                <div class="flex"><span class="span-block">Số điện thoại </span><input type="text" name="SDT"  value="<?php echo $fetched_row['SDT']; ?>" required class="form-control text" disabled/></div>
                <div class="flex" style=" justify-content:flex-start !important;"><span class="span-block">Trạng thái</span>
                    <select id="selectList" class="form-select text" style="width: 300px !important; margin-left: 27px" aria-label="Default select example" onclick="getTextSelect()"> 
                    <option value="ChoXacNhan">Chờ xác nhận</option>
                    <option value="DaXacNhan">Đã xác nhận</option>
                    <option value="ĐangGiao">Đang giao</option>
                    <option value="HoanThanh">Hoàn thành</option>
                    </select>
                </div>
                <div class="flex" style="justify-content: center;">
                <button class="btn__main" style="padding: 10px 20px" type="submit" name="btn-update"> Cập nhật </button>
                <button class="btn__main" style="padding: 10px 20px" type="submit" name="btn-back"> Quay lại </button>
                </div>
                <input type="hidden" id="TrangThaiAn" name="TrangThai" value="Chờ xác nhận">
            </form>
        </div>
    </div>

<script>
function getTextSelect(){
    var trangThai = $('#selectList :selected').text();
    $('#TrangThaiAn').val(trangThai);}
 </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
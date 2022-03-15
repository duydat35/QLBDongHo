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
    <title>Home</title>
</head>
<body>
<?php
    include_once 'config.php';
    // Lấy dữ liệu từ data lên text
    if(isset($_GET['ID']))
{
	$sql_query="SELECT * FROM khachhang WHERE MaKH =".$_GET['ID'];
	$result_set=mysqli_query($con, $sql_query);
	$fetched_row=mysqli_fetch_array($result_set);
}
    //Sửa dữ liệu
    if(isset($_POST["btn-update"]))
    {
        // lấy giá trị
        $tenKH = $_POST['tenKH'];
        $gioitinh = $_POST['gioitinh'];
        $ngaysinh = $_POST['ngaysinh'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $diachi = $_POST['diachi'];
        $yeucau = $_POST['yeucau'];
        //sửa dũ liệu
        $sql_query = "UPDATE khachhang SET tenKH='$tenKH',gioitinh='$gioitinh',ngaysinh='$ngaysinh',
        sdt='$sdt',email='$email',diachi='$diachi',yeucau='$yeucau' WHERE maKH =".$_GET['ID'];
        
        if(mysqli_query($con, $sql_query))
            {   
                ?> 
                <script> 
                alert("Cập nhật thành công");
                window.location.href='index.php?page=display_customer'; 
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
            header("Location: index.php?page=display_customer");
        } ?>
    <div class="container">
        <div class="main__title mb-3 rounded">Sửa thông tin khách hàng</div>
        <div class="main__content main__edit shadow bg-white rounded ">
            <form method="post">    
                <div class="flex"><span class="span-block">Tên khách hàng</span><input type="text" name="tenKH"  value="<?php echo $fetched_row['TenKH']; ?>" required class="form-control text"/></div>
                <div class="flex"><span class="span-block">Giới tính</span><input type="text" name="gioitinh"  value="<?php echo $fetched_row['GioiTinh']; ?>" required class="form-control text"/></div>
                <div class="flex"><span class="span-block">Ngày sinh</span><input type="text" name="ngaysinh"  value="<?php echo $fetched_row['NgaySinh']; ?>" required class="form-control text"/></div>
                <div class="flex"><span class="span-block">Điện thoại</span><input type="text" name="sdt"  value="<?php echo $fetched_row['SDT']; ?>" required class="form-control text"/></div>
                <div class="flex"><span class="span-block">Email</span><input type="text" name="email"  value="<?php echo $fetched_row['Email']; ?>" required class="form-control text"/></div>
                <div class="flex"><span class="span-block">Địa chỉ</span><input type="text" name="diachi"  value="<?php echo $fetched_row['DiaChi']; ?>" required class="form-control text"/></div>
                <div class="flex"><span class="span-block">Yêu cầu</span><textarea type="text" name="yeucau" style="height: 200px;" class="form-control text"><?php echo $fetched_row['YeuCau']; ?></textarea></div>
                 
               
                <div class="flex" style="justify-content: center;">
                <button class="btn__main" style="padding: 10px 20px" type="submit" name="btn-update"> Cập nhật </button>
                <button class="btn__main" style="padding: 10px 20px" type="submit" name="btn-back"> Quay lại </button>
                </div>
            </form>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
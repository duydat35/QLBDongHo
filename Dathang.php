<?php
include_once './admin/config.php';
include_once 'cart.php';


if (getCountProducts() > 0) 
{
    if(isset($_SESSION['OrderProduct']))
    {
        $products = $_SESSION['OrderProduct'];
        $total=0;
        foreach ($products as $productId => $productQuantity) 
        {
            $sql = "SELECT * FROM sanpham WHERE MaSP=".$productId;
            $result_set=mysqli_query($con, $sql);
            if(mysqli_num_rows($result_set)>0)
            {
                $row=mysqli_fetch_array($result_set);
                $price = $row['Gia']*$productQuantity;
                $total += $price; 
            }
        }
        if(isset($_POST['btnOrder']))
        {
            $ngaysinh =  date('Y-m-d', strtotime($_POST['txtDate'])) ;
            $tenKH = $_POST['txtName'];
            $diachi = $_POST['txtAddress'];
            $gioitinh = $_POST['txtSex'];
            $sdt = $_POST['txtPhone'];
            $email = $_POST['txtEmail'];
            $yeucau = $_POST['txtNote'];
            $sql_addKhachHang = "INSERT INTO `khachhang`( `tenKH`, `sdt`, `gioitinh`, `ngaysinh`, `email`, `diachi`, `yeucau`) 
            VALUES ('$tenKH','$sdt','$gioitinh','$ngaysinh','$email','$diachi','$yeucau')";

            if(mysqli_query($con, $sql_addKhachHang))
            {   
                $maKhachHang = mysqli_fetch_row(mysqli_query($con, "SELECT MaKH FROM khachhang ORDER BY MaKH DESC LIMIT 1"))[0]; 
                $sql_addDatHang = "INSERT INTO dathang (MaKH,ThoiGianDat, `TrangThai`, `TongTien`) 
                VALUES('$maKhachHang', CURRENT_TIME(), 'Chờ xác nhận', '$total')";
                if(mysqli_query($con, $sql_addDatHang))
                {  
                    $maDatHang = mysqli_fetch_row(mysqli_query($con, "SELECT MaPhieuDat FROM dathang ORDER BY MaPhieuDat DESC LIMIT 1"))[0]; 
                    foreach ($products as $productId => $productQuantity)
                    {
                        $row=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM sanpham WHERE MaSP=".$productId));
                        $price = $row['Gia']*$productQuantity;
                        $sql_addChiTietDatHang= "INSERT INTO `ctdathang` ( `MaSP`, `SoLuong`, `MaPhieuDat`, `ThanhTien`) 
                        VALUES ('$productId', '$productQuantity', '$maDatHang','$price' )";
                        mysqli_query($con, $sql_addChiTietDatHang);
                        
                    }
                    unset($_SESSION['OrderProduct']);
                    header("Location: TTDonHang.php?orderId=$maDatHang");
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="SanPham.css" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Đặt hàng</title>
</head>
<body>
    <!-- header -->
    <div class="header">
        <div class="d_header-top">
            <div class="d_header-top-content ">
                <div class="d_header-top-left  ">
                   <a href="index.php"><img src="image/logo2.png" style="height: 100px;"></a>
                </div>
                <div class="d_header-top-center ">
                    <div class="d_search">
                        <form >
                            <div class="d_flex-box">
                            <input id="searchValue" onkeyup="searchList()" type="text" class ="form-control" placeholder="Tìm kiếm">
                            <button class="d_btn-search btn "><i class="fas fa-search" style="color: white;"></i></button>
                            </div>
                            <ul id="searchList" class="search_list">
                                <?php
                                     $sql = "SELECT * FROM sanpham ";
                                    $result_set=mysqli_query($con, $sql);
                                    if(mysqli_num_rows($result_set)>0)
                                    {
                                        while($row=mysqli_fetch_array($result_set))
                                        { 
                                ?>
                                        <li>
                                        <a href="CTSanPham.php?ID=<?=$row['MaSP']?>" class="d-flex text-d text-decoration-none">
                                            <img class="search_list-img" src="./image/<?=$row['AnhSP']?>">
                                            <div class="search_list-text d-flex flex-column justify-content-center">
                                                <h6><?=$row['TenSP']?></h6>
                                                <p><?=number_format(floatval($row['Gia'])); ?><sup> đ</sup></p>
                                            </div>
                                        </a>
                                        </li>
                                <?php  } 
                                    } ?>
                            </ul>
                        </form>
                    </div>
                </div>
                <div class="d_header-top-right ">
                    <a href="giohang.php" class="text-decoration-none">
                        <div class="d_cart d_text d_color-white-bold">
                            <i class="fas fa-cart-plus" style="font-size: 28px;"></i>
                            <p class="d_cart_text">Giỏ hàng: <span><?php echo getCountProducts(); ?></span></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- end header -->
    <!-- menu -->
    <div id="navArea" class="position-sticky d_nav-bottom" style="top:0px; z-index: 1;">
        <div  class="d_menu">
            <div   class="d_menu_content">
                <ul class="d_menu_main text-uppercase">
                    <li><a href="index.php" class="text-decoration-none d_color-white-bold ">Trang chủ</a></li>
                    <li class="sub-menu"><a href="SanPham.php" class="text-decoration-none d_color-white-bold d_active">Sản phẩm <i class="fa fa-caret-down"></i></a>
                    <div class="sub__menu"> 
                        <div class="d-flex text-start text-capitalize">
                            <div class="sub__menu-column ">
                            <h6>Thương hiệu</h6>
                            <?php 
                                $thuongHieu= "SELECT DISTINCT ThuongHieu FROM `sanpham` ";
                                $resultThuongHieu=mysqli_query($con, $thuongHieu);
                                if(mysqli_num_rows($resultThuongHieu)>0)
                                {
                                    while($row=mysqli_fetch_array($resultThuongHieu))
                                    { 
                                ?>
                                <a href="SanPham.php?TH=<?= $row['ThuongHieu'];?>" class="text-decoration-none text-black text-start "><?= $row['ThuongHieu']; ?></a>
                                <?php
                                    }
                                }
                            ?>
                            </div>
                            <div class="sub__menu-column ">
                            <h6>Xuất xứ</h6>
                            <?php 
                                $XuatXu= "SELECT DISTINCT XuatXu FROM `sanpham` ";
                                $resultXuatXu=mysqli_query($con, $XuatXu);
                                if(mysqli_num_rows($resultXuatXu)>0)
                                {
                                    while($row=mysqli_fetch_array($resultXuatXu))
                                    { 
                                ?>
                                <a href="SanPham.php?XX=<?= $row['XuatXu']; ?>" class="text-decoration-none text-black text-start "><?= $row['XuatXu']; ?></a>
                                <?php
                                    }
                                }
                            ?>
                            </div>
                            <div class="sub__menu-column ">
                            <h6>Đối tượng</h6>
                            <?php 
                                $doiTuong= "SELECT DISTINCT DoiTuong FROM `sanpham`";
                                $resultDoiTuong=mysqli_query($con, $doiTuong);
                                if(mysqli_num_rows($resultDoiTuong)>0)
                                {
                                    while($row=mysqli_fetch_array($resultDoiTuong))
                                    { 
                                ?>
                                <a href="SanPham.php?DT=<?= $row['DoiTuong'];?>" class="text-decoration-none text-black text-start "><?= $row['DoiTuong']; ?></a>
                                <?php
                                    }
                                }
                            ?>
                            <h6 style="margin-top: 25px;">Bộ máy và Năng lượng</h6>
                            <?php 
                                $boMay= "SELECT DISTINCT BoMay FROM `sanpham`";
                                $resultBoMay=mysqli_query($con, $boMay);
                                if(mysqli_num_rows($resultBoMay)>0)
                                {
                                    while($row=mysqli_fetch_array($resultBoMay))
                                    { 
                                ?>
                                <a href="SanPham.php?BM=<?= $row['BoMay'];?>" class="text-decoration-none text-black text-start "><?= $row['BoMay']; ?></a>
                                <?php
                                    }
                                }
                            ?>
                            </div>
                            <div class="sub__menu-column  sub__menu-column-lagre" >
                                <div class="sub__menu-slide" data-flickity= '{"pageDots": false , "wrapAround": true, "autoPlay": 1000, "pauseAutoPlayOnHover": false }'>
                                    <img src="./image/banner_menu1.jpg">
                                    <img src="./image/banner_menu2.jpg">
                                    <img src="./image/banner_menu3.jpg">
                                </div>
                            </div>
                        </div>
                    </div>    
                    </li>
                    <li><a href="#" class="text-decoration-none d_color-white-bold ">Giới thiệu</a></li>
                    <li><a href="#" class="text-decoration-none d_color-white-bold ">Tin tức</a></li>
                    <li><a href="phanhoi.php" class="text-decoration-none d_color-white-bold ">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end menu -->
        <div class="container ">
            <form method="post" action="Dathang.php">
                <div class="row pt-0 mt-5">
                    <div class="main__info col">
                        <div class="customer__details">
                            <div class="customer__details-title">
                                <h3>THÔNG TIN THANH TOÁN</h3>
                            </div>
                            <div class="customer__details-info">
                                <p>
                                    <label>Họ và tên *</label>
                                    <input type="text" name="txtName" class="customer__details-text" required >
                                </p>
                                <p>
                                    <label>Ngày sinh</label>
                                    <input type="date" name="txtDate" class="customer__details-text" required >
                                </p>
                                <p>
                                    <label>Địa chỉ *</label>
                                    <input type="text" name="txtAddress" class="customer__details-text" required placeholder="Số nhà và tên đường">
                                </p>
                                <p>
                                    <label>Giới tính</label>
                                    <input type="text" name="txtSex" class="customer__details-text" required>
                                </p>
                                <p>
                                    <label>Số điện thoại *</label>
                                    <input type="text" name="txtPhone" class="customer__details-text" required>
                                </p>    
                                <p>
                                    <label>Địa chỉ email</label>
                                    <input type="text" name="txtEmail" class="customer__details-text" >
                                </p> 
                                <p>
                                    <label>Ghi chú đơn hàng</label>
                                    <textarea type="text" name="txtNote" class="customer__details-text" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
                                </p> 
                            </div>
                        </div>
                    </div>
                    <div class="main__order col">
                        <div class="checkout__sidebar">
                            <div class="checkout__sidebar-title">
                                <h3>ĐƠN HÀNG CỦA BẠN</h3>
                            </div>
                            <?php if(isset($_SESSION['OrderProduct'])) { ?>
                            <div class="order_review">
                                <table>
                                    <thead>
                                        <tr style="border-bottom: 3px solid #ececec;">
                                            <th class="tb_left">Sản phẩm</th>
                                            <th class="tb_right">Tổng</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $products = $_SESSION['OrderProduct'];
                                    $total=0;
                                    foreach ($products as $productId => $productQuantity) 
                                    {
                                        $sql = "SELECT * FROM sanpham WHERE MaSP=".$productId;
                                        $result_set=mysqli_query($con, $sql);
                                        if(mysqli_num_rows($result_set)>0)
                                        {
                                            $row=mysqli_fetch_array($result_set);
                                            $price = $row['Gia']*$productQuantity;
                                            $total += $price;
                                                ?>
                                            <tr>
                                                <td class="tb_left"><?php echo $row['TenSP']; ?> × <?php echo $productQuantity ?></td>
                                                <td class="tb_right"><?php echo number_format(floatval($price), 0, ".", ","); ?><sup> đ</sup></td>
                                            </tr>
                                            <?php
                                        } 
                                    }
                                    ?>
                                        <tr>
                                            <th class="tb_left" style="font-size: 17px;">Tổng cộng</th>
                                            <td class="tb_right"><?php echo number_format(floatval($total), 0, ".", ","); ?><sup> đ</sup></td>
                                        </tr>
                                        <tr>
                                            <th class="tb_left" style="font-size: 17px; color: #666666;">Giao hàng</th>
                                            <td class="tb_right" style="font-size: 16px; color: #222222;">Giao hàng miễn phí</td>
                                        </tr>
                                        <tr style="border-bottom: 3px solid #ececec;" >
                                            <th class="tb_left" style="font-size: 17px; padding-bottom: 15px;">Tổng </th>
                                            <th class="tb_right"style="padding-bottom: 15px;"><?php echo number_format(floatval($total), 0, ".", ","); ?><sup> đ</sup></th>
                                        </tr>
                                    </tbody>
                                </table>
                                    <?php  }
                                    else 
                                    { ?>
                                    <span style='display: block; margin-top: 15px; color: red; text-transform: uppercase; font-size: 20px; font-weight: 500'>Đơn hàng của bạn trống vui lòng <a href="SanPham.php" style="color: black;">quay lại</a> mua hàng</span>
                                    <?php }
                                    ?>
                                <div class="place_order">
                                    <button  class="btn btn-add" name="btnOrder">Đặt hàng</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end main -->
    </div>
    <!-- footer -->
    <div class="d_footer">
        <footer class="py-2">
          <ul class="nav justify-content-center border-bottom pb-2 mb-3">
            <li class="nav-item"><a href="index.php" class="nav-link px-2 text-white opacity">Trang chủ</a></li>
            <li class="nav-item"><a href="SanPham.php" class="nav-link px-2 text-white opacity">Sản phẩm</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white opacity">Giới thiệu</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white opacity">Tin tức </a></li>
            <li class="nav-item"><a href="phanhoi.php" class="nav-link px-2 text-white opacity">Liên hệ</a></li>
          </ul>
          <div class="container d_footer-flex">
            <p class="d_footer-text text-muted">&copy; Đại học Điện Lực</p>
            <div class="d_footer-logo">
                <img src="image/logo2.png" style="height: 80px">
            </div>
            <ul class= "d_footer-social justify-content-end ">
                <li class="ms-3"><a class="text-muted fs-5" href="#"><i class="fab fa-facebook"></i></a></li>
                <li class="ms-3"><a class="text-muted fs-5" href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="ms-3"><a class="text-muted fs-5" href="#"><i class="fab fa-twitter"></i></li>
            </ul>
         </div>
        </footer>
    </div>
      <!-- end footer -->
<?php 
    //  unset($_SESSION['OrderProduct']);
?>
<script src="scroll.js"></script>
<script src="search.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
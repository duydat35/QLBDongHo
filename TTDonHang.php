<?php
include_once './admin/config.php';
include_once 'cart.php';

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
    <title>Thông tin đơn hàng</title>
</head>
<body>
    <!-- header -->
    <div class="header">
        <div class="d_header-top">
            <div class="d_header-top-content ">
                <div class="d_header-top-left  ">
                   <a href="#"><img src="image/logo2.png" style="height: 100px;"></a>
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
                    <li><a href="TrangChu.php" class="text-decoration-none d_color-white-bold ">Trang chủ</a></li>
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
            <div style= "min-height: 340px" class="main d-flex">
                <div class="details_oder-left">
                    <div class="details_oder-title">
                        <h3> Thông tin đơn hàng</h3>
                    </div>
                    <?php 
                        $orderId = '';
                        if(isset($_POST['TenKH']))
                            $TenKH=$_POST['TenKH'];
                        if(isset($_POST['DienThoai']))
                            $DienThoai=$_POST['DienThoai'];
                        if(isset($_POST['TenKH']) && isset($_POST['DienThoai']))
                        {
                            $kiemTraMaKH = mysqli_query($con,"SELECT MaKH FROM khachhang WHERE TenKH LIKE '%$TenKH%' AND SDT='$DienThoai'");
                            if(mysqli_num_rows($kiemTraMaKH) > 0)
                            {   
                                $maKhachHang = mysqli_fetch_array($kiemTraMaKH)['MaKH'];
                                $orderId = mysqli_fetch_array(mysqli_query($con,"SELECT MaPhieuDat FROM dathang WHERE MaKH = '$maKhachHang'"))["MaPhieuDat"];
                            }
                            else 
                            {
                                echo "<span style='display: block; margin-top: 15px; color: red; 
                                text-transform: uppercase; font-size: 22px; font-weight: 400'>Kiểm tra lại thông tin <a href='phanhoi.php' style='text-decoration: none;'>Quay Lại</a> </span> ";
                            }
                        }
                        //TenKH + SDT
                        if(isset($_GET['orderId']))
                        {
                            $orderId = $_GET['orderId']; 
                        }
                        if($orderId != '')
                        {
                        // Ma order
                        $sql = "SELECT * FROM dathang,khachhang WHERE khachhang.MaKH = dathang.MaKH AND MaPhieuDat =".$orderId ;
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            { 
                        ?>
                        <div class="details_oder-info">
                            <p>Mã đơn hàng: <?php echo $row['MaPhieuDat']; ?></p>
                            <p>Thời gian đặt: <?php echo date("d-m-Y",strtotime($row['ThoiGianDat'])); ?></p>
                            <p>Số lượng sản phẩm: <?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM ctdathang WHERE MaPhieuDat=".$orderId))[0]; ?></p>
                            <p>Tình trạng: <span style="color: red;"><?php echo $row['TrangThai']; ?></span></p>
                            <p>Địa chỉ: <?php echo $row['DiaChi']; ?></p>
                            <p>Yêu cầu: <?php echo $row['YeuCau']; ?></p>
                        </div>
                        <?php 
                            }
                        }
                    ?>
                </div>
                <div class="details_oder-right">
                    <div class="details_oder-slide" data-flickity = '{"pageDots": false , "groupCells": 1, "wrapAround": true , "autoPlay": 3000 , "selectedAttraction": 0.014}'>
                    <?php 
                        $sql = "SELECT * FROM sanpham,ctdathang WHERE ctdathang.MaSP = sanpham.MaSP AND MaPhieuDat=".$orderId ;
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            { 
                    ?> 
                        <div  class="details_oder-item d-flex justify-content-between" >
                            <div class="details_oder-img">
                                <img src="./image/<?php echo $row['AnhSP']; ?>" style="width:200px !important; ">
                            </div>
                            <div class="details_oder-desc d-flex flex-row">
                                <div class="details_oder-info-product" >
                                    <a href="CTSanPham.php?ID=<?php echo $row['MaSP']; ?>" style="margin-bottom: 5px !important;"><?php echo $row['TenSP']; ?></a>
                                    <p style="margin-top: 5px;">Số lượng: <?php echo $row['SoLuong']; ?></p>
                                    <p>Thương hiệu: <?php echo $row['ThuongHieu']; ?></p>
                                    <p>Xuất xứ: <?php echo $row['XuatXu']; ?></p>
                                </div>     
                                <div class="details_oder-price d-flex align-items-center justify-content-end">
                                    <p><?php echo number_format(floatval( $row['Gia'])); ?><sup>đ</sup></p>
                                </div>                 
                            </div>
                        </div>
                       <?php 
                            }
                        }    
                    }
                       ?> 
                    </div>
                </div>
            </div>
        </div>
        <!-- end main -->
    </div>
    <!-- footer -->
    <div class="d_footer">
        <footer class="py-2">
          <ul class="nav justify-content-center border-bottom pb-2 mb-3">
            <li class="nav-item"><a href="TrangChu.php" class="nav-link px-2 text-white opacity">Trang chủ</a></li>
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
<script src="scroll.js"></script>
<script src="search.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
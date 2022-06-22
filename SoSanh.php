
<?php
include_once './admin/config.php';
include_once 'cart.php';

$productOne = "";
$productTwo = "";
$productThree = "";

if(isset($_POST['product_one']))
        $productOne = $_POST['product_one'];
    if(isset($_POST['product_two']))
        $productTwo = $_POST['product_two'];
    if(isset($_POST['product_three']))
        $productThree = $_POST['product_three'];
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
    <title>So sánh sản phẩm</title>
</head>
<body>
    <!-- header -->
    <div class="header">
        <div class="d_header-top">
            <div class="d_header-top-content ">
                <div class="d_header-top-left  ">
                   <a href="index.php"><img src="./image/logo2.png" style="height: 100px;"></a>
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
                            <i class="fas fa-cart-plus" style="font-size: 25px;"></i>
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
                                <a href="SanPham.php?DT=<?= $row['BoMay'];?>" class="text-decoration-none text-black text-start "><?= $row['BoMay']; ?></a>
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
    <div class="container main">
    <div class="d_shop-title">
            <div class="d_title-row text-uppercase">
                <a href="index.php" class="d_text_gray text-decoration-none">trang chủ</a>
                <span class="d_divider d_text_gray">/</span>
                <a href="SanPham.php" class="d_text_gray text-decoration-none ">Sản phẩm</a>
                <span class="d_divider d_text_gray">/</span>
                <a href="#" class="text_active d_text_gray text-decoration-none ">So Sánh</a>
            </div>
        </div>
        <div class="compare_main d-flex">
            <div class="compare-box_details">
                <strong>Thông số kỹ thuật chi tiết</strong>
            </div>
            <div class="compare-product">
                <?php 
                $sql = "SELECT * FROM sanpham WHERE MaSP=".$productOne;
                $result_set=mysqli_query($con, $sql);
                if(mysqli_num_rows($result_set)>0)
                {
                  while($row=mysqli_fetch_array($result_set))
                  {
                ?>
                    <div class="compare-top">
                        <a href="CTSanPham.php?ID=<?=$row['MaSP']?>" class="d-flex flex-column align-items-center justify-content-center">
                        <img src="./image/<?=$row['AnhSP']?>" style="width: 150px" >
                        <h6 ><?=$row['TenSP']?></h6>
                        <p><?=number_format(floatval($row['Gia'])); ?><sup> đ</sup></p>
                        </a>
                    </div>
                    <div class="compare-bottom">
                        <ul class="compare-list">
                            <li>
                                <small>Đối tượng sử dụng</small>
                                <p><?=$row['DoiTuong']?></p>
                            </li>
                            <li>
                                <small>Bộ máy & năng lượng</small>
                                <p><?=$row['BoMay']?></p>
                            </li>
                            <li>
                                <small>Chất liệu dây</small>
                                <p><?=$row['ChatLieuDay']?></p>
                            </li>
                            <li>
                                <small>Năm Sản Xuất</small>
                                <p><?=$row['NamSX']?></p>
                            </li>
                            <li>
                                <small>Đường kính mặt</small>
                                <p><?=$row['DuongKinhMat']?></p>
                            </li>
                            <li>
                                <small>Thương Hiệu</small>
                                <p><?=$row['ThuongHieu']?></p>
                            </li>
                            <li>
                                <small>xuât xứ</small>
                                <p><?=$row['XuatXu']?></p>
                            </li>
                        </ul>
                        <div class="text-center">
                            <a href="giohang.php?IDproduct=<?php echo $row['MaSP']; ?>"><button class="btn btn-add">Thêm vào giỏ</button></a>
                        </div>
                    </div>
                <?php 
                  }
                } 
                ?>
            </div>
            <div class="compare-product">
                <?php 
                $sql = "SELECT * FROM sanpham WHERE MaSP=".$productTwo;
                $result_set=mysqli_query($con, $sql);
                if(mysqli_num_rows($result_set)>0)
                {
                  while($row=mysqli_fetch_array($result_set))
                  {
                ?>
                    <div class="compare-top">
                        <a href="CTSanPham.php?ID=<?=$row['MaSP']?>" class="d-flex flex-column align-items-center justify-content-center">
                        <img src="./image/<?=$row['AnhSP']?>" style="width: 150px" >
                        <h6 ><?=$row['TenSP']?></h6>
                        <p><?=number_format(floatval($row['Gia'])); ?><sup> đ</sup></p>
                        </a>
                    </div>
                    <div class="compare-bottom">
                        <ul class="compare-list d-flex flex-column justify-content-end">
                            <li class="d-flex align-items-end">
                                <p><?=$row['DoiTuong']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['BoMay']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['ChatLieuDay']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['NamSX']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['DuongKinhMat']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['ThuongHieu']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['XuatXu']?></p>
                            </li>
                        </ul>
                        <div class="text-center">
                        <a href="giohang.php?IDproduct=<?php echo $row['MaSP']; ?>"><button class="btn btn-add">Thêm vào giỏ</button></a>
                        </div>
                    </div>
                <?php 
                  }
                } 
                ?>
            </div>
            <div class="compare-product">
                <?php 
                if($productThree!= "")
                {
                $sql = "SELECT * FROM sanpham WHERE MaSP=".$productThree;
                $result_set=mysqli_query($con, $sql);
                if(mysqli_num_rows($result_set)>0)
                {
                  while($row=mysqli_fetch_array($result_set))
                  {
                ?>
                    <div class="compare-top">
                        <a href="CTSanPham.php?ID=<?=$row['MaSP']?>" class="d-flex flex-column align-items-center justify-content-center">
                        <img src="./image/<?=$row['AnhSP']?>" style="width: 150px" >
                        <h6 ><?=$row['TenSP']?></h6>
                        <p><?=number_format(floatval($row['Gia'])); ?><sup> đ</sup></p>
                        </a>
                    </div>
                    <div class="compare-bottom">
                        <ul class="compare-list d-flex flex-column justify-content-end">
                            <li class="d-flex align-items-end">
                                <p><?=$row['DoiTuong']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['BoMay']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['ChatLieuDay']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['NamSX']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['DuongKinhMat']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['ThuongHieu']?></p>
                            </li>
                            <li class="d-flex align-items-end">
                                <p><?=$row['XuatXu']?></p>
                            </li>
                        </ul>
                        <div class="text-center">
                        <a href="giohang.php?IDproduct=<?php echo $row['MaSP']; ?>"><button class="btn btn-add">Thêm vào giỏ</button></a>
                        </div>
                    </div>
                <?php 
                  }
                } }
                ?>
            </div>
        </div>
        <div class="main__footer">
                <div class="main__footer-title">
                    <h3>SẢN PHẨM TƯƠNG TỰ</h3>
                </div>
                <div class="main__footer-list " data-flickity= '{"pageDots": false , "draggable": true, "wrapAround": true, "autoPlay": 2000, "pauseAutoPlayOnHover": true}'>
                <?php
                        $sql = "SELECT * FROM sanpham";
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            {
                                ?>
                                    <div class="main__footer-product">
                                        <div class="card">
                                            <a href="CTSanPham.php?ID=<?php echo $row['MaSP'] ?>"><img src="./image/<?php echo $row['AnhSP'] ?>" style="height: 224px; width: 224px;" alt="..."></a>
                                            <div class="card-body">
                                            <div class="cart-icon">
                                                <a href="giohang.php?IDproduct=<?php echo $row['MaSP']; ?>">
                                                    <i class="fas fa-shopping-bag"><span class="tooltiptext">Thêm giỏ hàng </span></i>
                                                </a>
                                            </div>
                                            <h6 class="card-title text-uppercase"><a href="CTSanPham.php?ID=<?php echo $row['MaSP'] ?>" class="text-decoration-none text-black"><?php echo $row['TenSP'] ?></a></h6>
                                            <p class="card-text"><?php echo number_format(floatval($row['Gia']), 0, ".", ",");?><sup> đ</sup></p>
                                            
                                            <!-- <button type="button" class="margin-left btn-add btn ">Thêm vào giỏ</button> -->
                                            </div>
                                        </div>
                                    </div>
                                 <?php
                            }
                        }
                    ?>
                </div>
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
<script src="scroll.js"></script>
<script src="search.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
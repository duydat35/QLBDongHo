
<?php
include_once './admin/config.php';
include_once 'cart.php';
include_once 'FilterSanPham.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SanPham.css" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <title>SanPham</title>
    
</head>
<body>
    <!-- header -->
    <div class="header">
        <div class="d_header-top">
            <div class="d_header-top-content ">
                <div class="d_header-top-left  ">
                   <a href="TrangChu.php"><img src="./image/logo2.png" style="height: 100px;"></a>
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
                            <p class="d_cart_text">Giỏ hàng: <?php echo getCountProducts(); ?></p>
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
                                $thuongHieu= "SELECT DISTINCT ThuongHieu FROM `sanpham` ORDER BY ThuongHieu";
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
                                $XuatXu= "SELECT DISTINCT XuatXu FROM `sanpham` ORDER BY XuatXu";
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
        <div class="d_shop-title">
            <div class="d_title-row text-uppercase">
                <a href="TrangChu.php" class="d_text_gray text-decoration-none">trang chủ</a>
                <span class="d_divider d_text_gray">/</span>
                <a href="SanPham.php" class="text_active d_text_gray text-decoration-none ">Sản phẩm</a>
            </div>
        </div>
        <!-- end shop title -->
        <div class="d_main">
            <div class="d_row">
                <div class="d_col d_large-3">
                    <span class="d_title-list text-uppercase fs-6" style="font-weight: 500;">Đối tượng</span>
                    <div class="d_divider-small"></div>
                    <div class="d_margin-bottom-20">
                    <ul class="list-group list-group-flush d_padding-15" style="height: 100% !important;">
                        <?php 
                        $doiTuong= "SELECT DISTINCT DoiTuong FROM `sanpham` ";
                        $resultDoiTuong=mysqli_query($con, $doiTuong);
                        if(mysqli_num_rows($resultDoiTuong)>0)
                        {
                            while($row=mysqli_fetch_array($resultDoiTuong))
                            { 
                        ?>
                        <li class="list-group-item"><a href="SanPham.php?DT=<?= $row['DoiTuong'];?>" class="text-decoration-none text-black"><?= $row['DoiTuong']; ?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    </div>
                    <span class="d_title-list text-uppercase fs-6" style="font-weight: 500;">thương hiệu</span>
                    <div class="d_divider-small"></div>
                    <div class="d_margin-bottom-20">
                    <ul class="list-group list-group-flush d_padding-15">
                        <?php 
                        $thuongHieu= "SELECT DISTINCT ThuongHieu FROM `sanpham` ORDER BY ThuongHieu";
                        $resultThuongHieu=mysqli_query($con, $thuongHieu);
                        if(mysqli_num_rows($resultThuongHieu)>0)
                        {
                            while($row=mysqli_fetch_array($resultThuongHieu))
                            { 
                        ?>
                        <li class="list-group-item"><a href="SanPham.php?TH=<?= $row['ThuongHieu'];?>" class="text-decoration-none text-black"><?= $row['ThuongHieu']; ?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    </div>
                    <span class="d_title-list text-uppercase fs-6" style="font-weight: 500;">Xuất xứ</span>
                    <div class="d_divider-small"></div>
                    <div class="d_margin-bottom-20">
                    <ul class="list-group list-group-flush d_padding-15">
                        <?php 
                        $XuatXu= "SELECT DISTINCT XuatXu FROM `sanpham` ORDER BY XuatXu";
                        $resultXuatXu=mysqli_query($con, $XuatXu);
                        if(mysqli_num_rows($resultXuatXu)>0)
                        {
                            while($row=mysqli_fetch_array($resultXuatXu))
                            { 
                        ?>
                        <li class="list-group-item"><a href="SanPham.php?XX=<?= $row['XuatXu']; ?>" class="text-decoration-none text-black"><?= $row['XuatXu']; ?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    </div>
                    <span class="d_title-list text-uppercase fs-6" style="font-weight: 500;">Bộ máy & năng lượng</span>
                    <div class="d_divider-small"></div>
                    <div class="d_margin-bottom-20">
                    <ul class="list-group list-group-flush d_padding-15" style="height: 100% !important;">
                        <?php 
                        $boMay= "SELECT DISTINCT BoMay FROM `sanpham` ";
                        $resultBoMay=mysqli_query($con, $boMay);
                        if(mysqli_num_rows($resultBoMay)>0)
                        {
                            while($row=mysqli_fetch_array($resultBoMay))
                            { 
                        ?>
                        <li class="list-group-item"><a href="SanPham.php?BM=<?= $row['BoMay'];?>" class="text-decoration-none text-black"><?= $row['BoMay']; ?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    </div>
                    <span class="d_title-list text-uppercase fs-6" style="font-weight: 500;">Lọc theo giá</span>
                    <div class="d_divider-small"></div>
                    <div class="d_margin-bottom-20">            
                    <ul class="list-group list-group-flush d_padding-15">
                        <li class="list-group-item"><a href="SanPham.php?Min=1&Max=2000000" class="text-decoration-none text-black">0 <sup>₫</sup> - 2.000.000 <sup>₫</sup></a></li>
                        <li class="list-group-item"><a href="SanPham.php?Min=2000000&Max=4000000" class="text-decoration-none text-black">2.000.000 <sup>₫</sup> - 4.000.000 <sup>₫</sup></a></li>
                        <li class="list-group-item"><a href="SanPham.php?Min=4000000&Max=8000000" class="text-decoration-none text-black">4.000.000 <sup>₫</sup> - 8.000.000 <sup>₫</sup></a></li>
                        <li class="list-group-item"><a href="SanPham.php?Min=8000000&Max=20000000" class="text-decoration-none text-black">8.000.000 <sup>₫</sup> - 20.000.000 <sup>₫</sup></a></li>
                        <li class="list-group-item"><a href="SanPham.php?Min=20000000&Max=100000000" class="text-decoration-none text-black">20.000.000 <sup>₫</sup> - 100.000.000 <sup>₫</sup></a></li>
                    </ul>
                    </div>
                </div>
                <div class="d_col d_large-9">
                    <div class="sort_product">
                        <select id="selectList" class="form-select text" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"> 
                        <option <?php if(!isset($_GET['sort'])) { ?> selected <?php } ?> value="SanPham.php">Sắp xếp giá</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="?<?=$filterparam?><?=$sortparam?>field=Gia&sort=asc">Thấp đến cao</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="?<?=$filterparam?><?=$sortparam?>field=Gia&sort=desc">Cao đến thấp</option>
                        </select>
                        <div style="clear: both;" ></div>
                    </div>
                    <div class="d_flex-row">
                    <?php
                        // phan trang
                        $itemPerPage = !empty($_GET['per_page'])?$_GET['per_page']:9; // sản phẩm mỗi trang
                        $currentPage = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
                        $offSet = ($currentPage-1)* $itemPerPage;
                        $sql = "SELECT * FROM sanpham $filter $sort LIMIT $itemPerPage OFFSET $offSet";
                        $totalProduct = mysqli_num_rows(mysqli_query($con, "SELECT * FROM sanpham $filter"));
                        $totalPages = ceil($totalProduct / $itemPerPage);
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            {
                                ?>
                                    <div class="d_block">
                                        <div class="card">
                                        <a href="CTSanPham.php?ID=<?php echo $row['MaSP'] ?>"><img  style="height:300px" src="./image/<?php echo $row['AnhSP'] ?>" class="card-img-top" alt="..."></a>
                                            <div class="card-body">
                                            <div class="cart-icon">
                                                <a href="giohang.php?IDproduct=<?php echo $row['MaSP']; ?>"><i class="fas fa-shopping-bag"><span class="tooltiptext">Thêm giỏ hàng </span></i></a>
                                            </div>
                                            <h6 class="card-title text-uppercase"><a href="CTSanPham.php?ID=<?php echo $row['MaSP'] ?>" class="text-decoration-none text-black"><?php echo $row['TenSP'] ?></a></h6>
                                            <p class="card-text"><?php echo number_format(floatval($row['Gia']), 0, ".", ","); ?><sup> ₫</sup></p>
                                            <p class="text-center" style="font-size:16px; margin-bottom: 0;"><a class="card-compare text-center" data-id='<?php echo $row['MaSP'] ?>'><i class="fas fa-plus-circle"></i> So sánh</a></p>
                                            </div>
                                        </div>
                                    </div>
                                 <?php
                            }
                        }
                        ?> 
                    </div>
                    <nav>
                    <ul class="pagination pagination-sm justify-content-center pagination_edit">
                    <?php 
                        if ($currentPage > 0) 
                        {
                            $prev_page = $currentPage - 1;
                    ?>
                        <li class="page-item">
                        <a class="page-link" href="?<?=$filterparam?><?=$sortparam?>per_page=<?php echo $itemPerPage; ?>&page=<?php echo $prev_page;?>">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php } else { 
                    ?>
                            <a class="page-link">
                            <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php 
                        }
                        for($num = 1; $num <= $totalPages; $num++) 
                        { 
                            if($num != $currentPage) 
                            {
                                if ($num > ($currentPage-3) && ($num<$currentPage+3)) 
                                {
                    ?>
                            <li class="page-item"><a class="page-link" href="?<?=$filterparam?><?=$sortparam?>per_page=<?php echo $itemPerPage; ?>&page=<?php echo $num; ?>"><?php echo $num; ?></a></li>
                    <?php   
                                 }
                            } 
                            else 
                            { 
                    ?>
                                <li class="page-item active"><a class="page-link" ><?php echo $num; ?></a></li>
                    <?php 
                            } 
                        }
                        if ($currentPage < $totalPages) 
                        {
                            $next_page = $currentPage + 1;
                     ?>
                        <li class="page-item">
                        <a class="page-link" href="?<?=$filterparam?><?=$sortparam?>per_page=<?php echo $itemPerPage; ?>&page=<?php echo $next_page;?>">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    <?php 
                        } else 
                        { 
                    ?>
                            <a class="page-link">
                            <span aria-hidden="true">&raquo;</span>
                            </a>
                    <?php
                        }
                    ?>
                        </li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="stickcompare d-flex" id="stickcompare">
            <ul class="stickcompare_product d-flex">

            </ul>
            <div class="stickcompare_product-btn">
                <form method="post" action="sosanh.php">
                <input value="" type="hidden" name="product_one" id="product_one">
                <input value="" type="hidden" name="product_two" id="product_two">
                <input value="" type="hidden" name="product_three" id="product_three">
                <button id='btn-compare'class="btn btn-compare" type="submit">So sánh ngay</button>
                </form>
                <a class="compare_deleteAll">Xóa tất cả sản phẩm</a>
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
<script>        
var index = 0;
var quanitySpace = 3;
$(document).ready(function(){
   

  $('.card-compare').click(function(){
       var ID = $(this).data('id');
       $.ajax({
               url: 'compare_product.php',
               type: 'POST',
               data: {ID:ID},
               success: function(trave){
                if(index < 3 || quanitySpace==3)
                {   
                    $('#stickcompare').css('visibility','visible'); 
                    $('#stickcompare').css('bottom','0');   
                    $('#stickcompare').css('opacity','1'); 
                    $('.stickcompare_product').append(trave);
                    index++;
                    if(index > 1)
                    {$('#btn-compare').addClass('btn-add');}
                    if(index > 3)
                    { quanitySpace=1;}
                }
                }
       });
  });
  $('.compare_deleteAll').click(function(){
      $('.compare_product').remove();
      $('#stickcompare').css('visibility','hidden');
      $('#stickcompare').css('opacity','0');  
      index = 0;
      quanitySpace = 3;
      $('#btn-compare').removeClass('btn-add');
  });
});
</script>
<script src="scroll.js"></script>
<script src="search.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
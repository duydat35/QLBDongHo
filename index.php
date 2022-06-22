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
   <title>Trangchu</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <link href="TrangChu.css" rel="stylesheet">
    <!-- <script type="text/javascript" src="./css/owl.carousel.min.css"></script>
    <script type="text/javascript" src="./js/owl.carousel.min.js"></script> -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>
<body>
     <!-- top_Navigation -->
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


     <!-- Navigation -->
     <div id="navArea" class="position-sticky d_nav-bottom" style="top:0px; z-index: 20;">
        <div  class="d_menu">
            <div   class="d_menu_content">
                <ul class="d_menu_main text-uppercase">
                    <li><a href="TrangChu.php" class="text-decoration-none d_color-white-bold d_active">Trang chủ</a></li>
                    <li class="sub-menu"><a href="SanPham.php" class="text-decoration-none d_color-white-bold ">Sản phẩm <i class="fa fa-caret-down"></i></a>
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
     <!-- Carousel -->
        <!-- Flickity HTML init -->
        <div class="carousel" data-flickity='{"autoPlay": 2000, "freeScroll": true, "wrapAround": true }'>
          <div class="carousel-cell">
            <div class="carousel-caption d-none d-md-block" id="carousel_caption1">
              <h4>DH EPU</h4>
              <h1 class="display-2">Đồng hồ Classico</h1>
              <p>Với sự phất triển của công nghệ ,nhiều những mẫu đồng hồ nam chính hãng ra đời  đa dạng về phong cách, kiểu dáng, màu sắc, kích cỡ…</p>
                    <a href="SanPham.php"><button type="button" class="btn btn-outline-light btn-lg">
                        Xem sản phẩm
                    </button></a>
            </div>
          </div>
          <div class="carousel-cell one">
            <div class="carousel-caption d-none d-md-block" id="carousel_caption2">
              <h4>DH EPU</h4>
              <h1 class="display-2">Đồng hồ Classico</h1>
              <p>Với sự phất triển của công nghệ ,nhiều những mẫu đồng hồ nam chính hãng ra đời  đa dạng về phong cách, kiểu dáng, màu sắc, kích cỡ…</p>
              <a href="SanPham.php"><button type="button" class="btn btn-outline-light btn-lg">
                  Xem sản phẩm
              </button></a>
            </div>
          </div>
       
        </div>

     <!-- row-trend -->
     <div class="n_row-trend">
      <div class="n_row-trend-ctn">
        <div class="container overflow-hidden">
          <div class="row gx-5">
            <div class="col" id="col_Trend1">
             <div class="p-3 border bg-light">
               <img src="./image/trend-1.jpg" alt="">
               <div class="carousel-caption d-none d-md-block">
                <h4>Xu hướng 2021</h4>
                <p>Đồng Hồ Nam</p>
              </div>
             </div>
            </div>
            <div class="col" id="col_Trend2">
              <div class="p-3 border bg-light">
                <img src="./image/trend-2.jpg" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <h4>Xu hướng 2021</h4>
                  <p>Đồng Hồ Nữ</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
  
   
     <!-- n_bestSale -->
    <div class="n_bestSale" id="bestSale">
      <div class="wpb_text_column wpb_content_element ">
        <div class="wpb_wrapper">
        <h3 class="title a-center"><span><span >Sản Phẩm Bán Chạy</span></span></h3>
        </div>
      </div>
        <!-- Flickity HTML init -->
        <div class="main__footer-list " data-flickity= '{"pageDots": false , "draggable": true, "wrapAround": true, "autoPlay": 3000, "pauseAutoPlayOnHover": true}'>
          <?php
            $sql = "SELECT sanpham.MaSP,AnhSP, TenSP, Gia, SUM(SoLuong) AS SoLuong FROM ctdathang,sanpham WHERE sanpham.MaSP=ctdathang.MaSP GROUP BY sanpham.MaSP ORDER BY soluong DESC LIMIT 8";
            $result_set=mysqli_query($con, $sql);
            if(mysqli_num_rows($result_set)>0)
            {
                while($row=mysqli_fetch_array($result_set))
                {
                    ?>
                        <div class="main__footer-product">
                            <div class="card">
                                <a href="CTSanPham.php?ID=<?php echo $row['MaSP'] ?>"><img src="./image/<?php echo $row['AnhSP'] ?>" style="height: 300px; width: 300px;" alt="..."></a>
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

    <!-- about us -->
    <div class="n_about_us">
     <div class="n_about_us-ctn">
      <div class="wpb_text_column wpb_content_element ">
        <div class="wpb_wrapper">
        <h3 class="title a-center"><span><span style="font-size: 12pt;">Về chúng tôi</span></span></h3>
        </div>
        </div>
        <div class="n_about_card">
          <div class="card card_about hic" id="card_about1" style="width: 18rem;">
            <img src="./image/anhgioithieu1.jpg" class="card-img-top" alt="..." style="height: 262px;">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
          <div class="card card_about hic" id="card_about2" style="width: 18rem;">
            <img src="./image/gt2.jpg" class="card-img-top" alt="..." style="height: 262px;">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
          <div class="card card_about hic" id="card_about3" style="width: 18rem;">
            <img src="./image/anhgioithieu1.jpg" class="card-img-top" alt="..." style="height: 262px;">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
     </div>
    </div>
  
    
     <!-- thuonghieu -->
    <div id="n_logoPartner">
          <div class="wpb_wrapper">
            <h3 class="title a-center"><span><span style="font-size: 12pt;">Thương Hiệu </span></span></h3>
            <div class="carousel_bestsale">
              <div class="b_carousel  "
                 data-flickity='{ "pageDots": false , "draggable": true, "wrapAround": true, "autoPlay": 3000, "pauseAutoPlayOnHover": true }'>
                <div class="b_carousel-cell">
                  <div class="card">
                  <img src="./image/No1_BOSS_Opt.jpg" class="card-img-top" alt="...">
                  </div>
                </div>
                <div class="b_carousel-cell">
                  <div class="card">
                    <a href="SanPham.php">
                    <img src="./image/No1_VW_Opt.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                    </div>
                  </div>
                </div>
                <div class="b_carousel-cell">
                  <div class="card">
                    <a href="SanPham.php">
                    <img src="./image/No1_OB_Opt.jpg" class="card-img-top" alt="...">
                    </a>
                  </div>
                </div>
                <div class="b_carousel-cell">
                  <div class="card">
                    <a href="SanPham.php">
                      <img src="./image/No1_MK_Opt.jpg" class="card-img-top" alt="...">
                    </a>
                  </div>
                </div>
                <div class="b_carousel-cell">
                  <div class="card">
                    <a href="SanPham.php">
                      <img src="./image/No1_Tommy_Opt.jpg" class="card-img-top" alt="...">
                    </a>
                  </div>
                </div>
                <div class="b_carousel-cell">
                  <div class="card">
                    <a href="SanPham.php">
                      <img src="./image/No1_VW_Opt.jpg" class="card-img-top" alt="...">
                    </a>
                  </div>
                </div>
                <div class="b_carousel-cell">
                  <a href="SanPham.php">
                  <img src="./image/No1_Rotary_Opt.jpg" class="card-img-top" alt="...">
                  </a>
                </div>
                <div class="b_carousel-cell">
                  <a href="SanPham.php">
                  <img src="./image/No1_MK_Opt.jpg" class="card-img-top" alt="...">
                  </a>
                </div>
              </div>
            </div>
            
          </div>
    </div>
    

    <!-- n_footer" -->
    <div class="n_footer">
      <footer class="py-2">
        <ul class="nav justify-content-center border-bottom pb-2 mb-3">
          <li class="nav-item"><a href="TrangChu.php" class="nav-link px-2 text-white opacity ">Trang chủ</a></li>
          <li class="nav-item"><a href="SanPham.php" class="nav-link px-2 text-white opacity">Sản phẩm</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-white opacity">Giới thiệu</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-white opacity">Tin tức </a></li>
          <li class="nav-item"><a href="phanhoi.php" class="nav-link px-2 text-white opacity">Liên hệ</a></li>
        </ul>
        <div class="container n_footer-flex">
          <p class="n_footer-text text-muted">&copy; Đại học Điện Lực</p>
          <div class="n_footer-logo">
              <img src="image/logo2.png" style="height: 80px">
          </div>
          <ul class= "n_footer-social justify-content-end ">
              <li class="ms-3"><a class="text-muted fs-5" href="#"><i class="fab fa-facebook"></i></a></li>
              <li class="ms-3"><a class="text-muted fs-5" href="#"><i class="fab fa-instagram"></i></a></li>
              <li class="ms-3"><a class="text-muted fs-5" href="#"><i class="fab fa-twitter"></i></li>
          </ul>
       </div>
      </footer>
    </div>
<script >
window.addEventListener("load", function() {
    var caption1 = document.getElementById("carousel_caption1");
    caption1.classList.add("fadeRight");
    var caption2 = document.getElementById("carousel_caption2");
    caption2.classList.add("fadeRight");
});

window.addEventListener("scroll", function() {

  var trend1 = document.getElementById("col_Trend1");
  var trend2 = document.getElementById("col_Trend2");

  var bestSale = document.getElementById("bestSale");

  var card_about1 = document.getElementById("card_about1");
  var card_about2 = document.getElementById("card_about2");
  var card_about3 = document.getElementById("card_about3");

  var logoPartner = document.getElementById("n_logoPartner")

  if (window.pageYOffset > 100) {
    trend1.classList.add("trend_fadeTop");
    setTimeout(function(){trend2.classList.add("trend_fadeTop")},400);
  } 

  if (window.pageYOffset > 300) {
    bestSale.classList.add("betSale_fadeRight");
    setTimeout(function(){bestSale.classList.add("betSale_fadeLeft")},800);
  } 

  if (window.pageYOffset > 900) {
    card_about1.classList.add("trend_fadeTop");
    card_about2.classList.add("trend_fadeTop");
    card_about3.classList.add("trend_fadeTop");
  } 

  if (window.pageYOffset > 1100) {
    logoPartner.classList.add("betSale_fadeRight");
    setTimeout(function(){logoPartner.classList.add("betSale_fadeLeft")},800);
  } 
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
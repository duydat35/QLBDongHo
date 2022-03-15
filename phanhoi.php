<?php
    include_once './admin/config.php';
    include_once 'cart.php';
    if(isset($_POST["btn-search"])){
      $tukhoa = $_POST["tukhoa"];
      header('location:SanPham.php?tukhoa='.$tukhoa);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phản hồi</title>
    <link href="phanhoi.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
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
    <!-- end header -->
    <!-- menu -->
    <div id="navArea" class="position-sticky d_nav-bottom" style="top:0px; z-index: 1;">
        <div  class="d_menu">
            <div   class="d_menu_content">
                <ul class="d_menu_main text-uppercase">
                    <li><a href="TrangChu.php" class="text-decoration-none d_color-white-bold ">Trang chủ</a></li>
                    <li class="sub-menu"><a href="SanPham.php" class="text-decoration-none d_color-white-bold">Sản phẩm <i class="fa fa-caret-down"></i></a>
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
                    <li><a href="phanhoi.php" class="text-decoration-none d_color-white-bold d_active">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>

     <!-- n_breadcrumb -->
<div class="container">
    <div class="d_shop-title d-flex justify-content-between">
      <div class="d_title-row text-uppercase">
          <a href="TrangChu.php" class="d_text_gray text-decoration-none">trang chủ</a>
          <span class="d_divider d_text_gray">/</span>
          <a href="phanhoi.php" class="text_active d_text_gray text-decoration-none ">Liên hệ</a>
      </div>
    <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Kiểm tra đơn hàng
    </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhập thông tin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="TTDonHang.php">
                <div class="modal-body">
                <span class="span-block">Họ tên: </span><input type="text" class="form-control" name="TenKH" required placeholder="Họ và tên"><br>
                <span class="span-block">Số Điện thoại: </span><input type="text" class="form-control" name="DienThoai" required placeholder="Số điện thoại">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-add">Kiểm tra</button>
                </div>
                </div>
            </form>
        </div>
        </div>
    </div>

  <?php
    include_once './admin/config.php';
    if(isset($_POST["btn-add"]))
      {
          // lấy giá trị
          $TenKH = $_POST['TenKH'];
          $DienThoai = $_POST['DienThoai'];
          $Email = $_POST['Email'];
          $TieuDe = $_POST['TieuDe'];
          $NoiDung = $_POST['NoiDung'];
          //thêm dũ liệu
          $sql = "INSERT INTO lienhe (TenKH,DienThoai,Email,TieuDe,ThoiGian,NoiDung)  
          VALUES('$TenKH','$DienThoai','$Email','$TieuDe',CURRENT_TIME(),'$NoiDung')";
  
          if(mysqli_query($con, $sql))
          {   
            ?> 
            <script> 
            alert("Phản hồi thành công");
            </script> <?php
            
          }
          else
          {
              ?> 
              <script> 
              alert("Phản hồi không thành công");
              </script> <?php
          }
      }

  ?>


    <!-- feedback -->
  <div class="n_feedback">
    <form method="post" action="phanhoi.php">
    <div class="n_feedback_ctn">
      <h3>Liên hệ với chúng tôi - MONA</h3>
      <div class="name_phone">
          <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" name="TenKH" placeholder="Họ và tên:">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" name="DienThoai" placeholder="Số điện thoại:">
          </div>
      </div>
      <div class="name_phone">
          <div class="mb-3">
            <input type="email" class="form-control" id="exampleFormControlInput1" name="Email" placeholder="Email: name@example.com">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" name="TieuDe" placeholder="Tiêu đề:">
          </div>
        </div>
        <div class="mb-3">
            <textarea class="form-control" id="exampleFormControlTextarea1" name="NoiDung" placeholder="Nội dung:" rows="5"></textarea>
            <!-- <input type="text" class="form-control" id="exampleFormControlTextarea1" name="NoiDung" placeholder="Nội dung:"> -->
        </div>
        <div class="cart_buttons"> 
          <button type="submit" class=" button cart_button_clear" name="btn-add"> Gửi phản hồi</button> 
        </div>
    </div>
    </form>
  </div> 
</div>
    <!-- n_footer -->
    <div class="n_footer">
      <footer class="py-2">
        <ul class="nav justify-content-center border-bottom pb-2 mb-3">
          <li class="nav-item"><a href="TrangChu.php" class="nav-link px-2 text-white opacity ">Trang chủ</a></li>
          <li class="nav-item"><a href="SanPham.php" class="nav-link px-2 text-white opacity">Sản phẩm</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-white opacity">Giới thiệu</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-white opacity">Tin tức </a></li>
          <li class="nav-item"><a href="phanhoi.php" class="nav-link px-2 text-white opacity ">Liên hệ</a></li>
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

<script src="scroll.js"></script>
<script src="search.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
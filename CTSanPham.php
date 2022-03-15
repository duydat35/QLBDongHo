
<?php
include_once './admin/config.php';
include_once 'cart.php';
if(isset($_POST['btnRate']))
{
    $TenKH = $_POST['Name'];
    $SDT = $_POST['SDT'];
    $AnhSP1 = $_POST['AnhSP1'];
    $AnhSP2 = $_POST['AnhSP2'];
    $AnhSP3 = $_POST['AnhSP3'];
    $Cmt = $_POST['Comment'];
    $MaSP = $_GET['ID'];
    $Sao = $_POST['rating']; 

    $kiemTraMaKH = mysqli_query($con,"SELECT MaKH FROM khachhang WHERE TenKH = '$TenKH' AND SDT='$SDT'");

    if(mysqli_num_rows($kiemTraMaKH) > 0)
    {   
        $maKhachHang = mysqli_fetch_array($kiemTraMaKH)['MaKH'];
        $addRate= "INSERT INTO `danhgia` (`MaSP`, `MaKH`, `SoSao`, `ThoiGian`, `BinhLuan`, `AnhSP1`, `AnhSP2`, `AnhSP3`) 
        VALUES ('$MaSP', '$maKhachHang', '$Sao',CURRENT_TIME(), '$Cmt ', '$AnhSP1', '$AnhSP2', '$AnhSP3');"; 
        if(mysqli_query($con, $addRate))
        {
        ?><script>
            alert("Đánh giá thành công");
        </script> <?php 
        }
    }
    else
    {
        ?><script>
            alert("Bạn chưa mua hàng!Vui lòng mua hàng");
        </script> <?php 
    }

    // $maKhachHang = mysqli_fetch_row(mysqli_query($con,
    // "SELECT MaKH FROM khachhang WHERE TenKH = '$TenKH' AND SDT='$SDT'"))[0];
    // mua sản phẩm đề đánh giá thì bắt vào num_row > 0 của select * dathang where makh and masp
    //thêm dữ liệu 

    
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
    <title>Sản Phẩm</title>
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
        <div class="container main">
            <div class="main__left">
            <?php
            $sql = "SELECT * FROM sanpham WHERE MaSP=".$_GET['ID'];
            $result_set=mysqli_query($con, $sql);
            if(mysqli_num_rows($result_set)>0)
            {
                while($row=mysqli_fetch_array($result_set))
                {
                    ?>
                    <div class="main__carousel-top " data-flickity= '{"pageDots": false , "draggable": true, "wrapAround": true, "autoPlay": 3000, "pauseAutoPlayOnHover": true}'>
                        <div class="w-100"><img class="w-100" src="./image/<?php echo $row['AnhSP'] ?>" alt="..." style="height: 550px; width: 100%;"></div>
                        <div class="w-100"><img class="w-100" src="./image/<?php echo $row['AnhSP2'] ?>" alt="..." style="height: 550px; width: 100%;"></div>
                        <div class="w-100"><img class="w-100" src="./image/<?php echo $row['AnhSP3'] ?>" alt="..." style="height: 550px; width: 100%;"></div>
                    </div>
                    <div class="main__carousel-bot " data-flickity='{ "asNavFor": ".main__carousel-top", "contain": true, "pageDots": false ,"wrapAround": false}' >
                            <div class="control-img"><img src="./image/<?php echo $row['AnhSP'] ?>" alt="..." style="height: 130px; width: 100%;"></div>
                            <div class="control-img"><img src="./image/<?php echo $row['AnhSP2'] ?>" alt="..." style="height: 130px; width: 100%;"></div>
                            <div class="control-img"><img src="./image/<?php echo $row['AnhSP3'] ?>" alt="..." style="height: 130px; width: 100%;"></div>
                    </div>
            </div>
            <div class="main__right">
                <div class="d_shop-title">
                    <div class="d_title-row text-uppercase">
                        <a href="TrangChu.php" class="d_text_gray text-decoration-none ">trang chủ</a>
                        <span class="d_divider d_text_gray">/</span>
                        <a href="SanPham.php" class="d_text_gray text-decoration-none ">Sản phẩm</a>
                        <span class="d_divider d_text_gray">/</span>
                        <a href="SanPham.php" class="text_active d_text_gray text-decoration-none "><?=$row['ThuongHieu']?></a>
                    </div>
                </div>
                <div class="main__product-name text-uppercase">
                    <h2><?php  echo $row['TenSP'] ?></h2>
                </div>
                <div class="divider"></div>
                <div class="main__product-price"><?php echo number_format(floatval($row['Gia']), 0, ".", ",");?><sup> đ</sup></div>
                <div class="main__product-desc"><?php echo $row['MoTa']; ?></div> 
                <div class="main__product-cart">
                    <div class="cart__number">
                        <div class="buttons_added">
                            <form method="post" action="giohang.php?ID=<?php echo $row['MaSP']; ?>">
                                <input class="minus is-form" type="button" value="-">
                                <input aria-label="quantity" class="input-qty" max="10" min="1" name="txtProductQuantity" type="number" value="1">
                                <input class="plus is-form" type="button" value="+">
                            
                        </div>
                    </div>
                    <button type="submit" class="btn-add btn text-uppercase">Thêm vào giỏ</button>
                            </form>
                </div>
                <div class="main__product-info">
                    <span class="span-block">Mã: MTP-1374L-1AVDF</span>
                    <span class="span-block">Danh mục: <a href="SanPham.php"> Đồng hồ , </a><a href="SanPham.php?TH=<?= $row['ThuongHieu'];?>"><?=$row['ThuongHieu']?>, </a><a href="SanPham.php?BM=<?= $row['BoMay'];?>"><?= $row['BoMay']; ?></a></span>
                </div>
                <?php
                }
            }
            ?>
            </div>
            <div class="main__bot">
                <div class="product-tab"> 
                    <div class="tab product-info tab-active">
                        <a>Thông tin bổ sung</a>
                    </div>
                    <div class="tab product-review ">
                        <a>Xem Đánh giá</a>
                    </div>
                    <div class="tab product-review">
                        <a>Đánh giá</a>
                    </div>
                   
                </div>
                <div class="tab-panel">
                    <div class="panel panel-info panel-active">
                        <table class="panel-table">
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM sanpham WHERE MaSP=".$_GET['ID'];
                            $result_set=mysqli_query($con, $sql);
                            if(mysqli_num_rows($result_set)>0)
                            {
                                $row=mysqli_fetch_array($result_set); ?>
                                <tr>
                                    <th>BỘ MÁY & NĂNG LƯỢNG</th>
                                    <td><a href="SanPham.php?BM=<?= $row['BoMay'];?>"><?=$row['BoMay']?></a></td>
                                </tr>
                                <tr>
                                    <th>CHẤT LIỆU DÂY</th>
                                    <td><a href="SanPham.php?DT=<?= $row['DoiTuong'];?>"><?=$row['ChatLieuDay']?></a> </td>
                                </tr>
                                <tr>
                                    <th>NĂM SẢN XUẤT</th>
                                    <td><a href="SanPham.php?DT=<?= $row['DoiTuong'];?>"><?=$row['NamSX']?></a></td>
                                </tr>
                                <tr>
                                    <th>ĐỐI TƯỢNG</th>
                                    <td><a href="SanPham.php?DT=<?= $row['DoiTuong'];?>"><?=$row['DoiTuong']?></a></td>
                                </tr>
                                <tr>
                                    <th>ĐƯỜNG KÍNH MẶT</th>
                                    <td><a href="SanPham.php?DT=<?= $row['DoiTuong'];?>"><?=$row['DuongKinhMat']?></a></td>
                                </tr>
                                <tr>
                                    <th>THƯƠNG HIỆU</th>
                                    <td><a href="SanPham.php?TH=<?= $row['ThuongHieu'];?>"><?=$row['ThuongHieu']?></a></td>
                                </tr>
                                <tr>
                                    <th>XUẤT XỨ</th>
                                    <td><a href="SanPham.php?XX=<?= $row['XuatXu'];?>"><?=$row['XuatXu']?></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel panel-comment ">
                        <div class="review-comment">
                        <?php 
                        $rate = "SELECT * FROM danhgia,khachhang WHERE khachhang.MaKH= danhgia.MaKH AND MaSP=".$_GET['ID']."
                        ORDER BY ThoiGian DESC ";
                        $result_set=mysqli_query($con, $rate);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            {
                        ?>
                            <div class="comment">
                                <div class="comment-user d-flex">
                                    <div class="comment-left" > 
                                        <div class="comment-avatar border">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="comment-main">
                                        <p class="comment-name"><?php echo $row['TenKH'] ?></p>
                                        <div class="comment-rate">       
                                            <?php for($i=1;$i<=5;$i++)
                                            {
                                                if($i<=$row['SoSao'])
                                                {
                                                   ?> <i class="fas fa-star yellow"></i> <?php
                                                }
                                            }
                                             ?>
                                        </div>
                                        <div class="comment-text">
                                            <p><?php echo $row['BinhLuan'] ?></p>
                                        </div>
                                        <div class="comment-img d-flex">
                                            <?php if($row['AnhSP1']!='') { ?><img src="./image/<?php echo $row['AnhSP1'] ?>" style="width: 100px; margin-left:8px"> <?php } ?>
                                            <?php if($row['AnhSP2']!='') { ?><img src="./image/<?php echo $row['AnhSP2'] ?>" style="width: 100px; margin-left:8px"> <?php } ?>
                                            <?php if($row['AnhSP3']!='') { ?><img src="./image/<?php echo $row['AnhSP3'] ?>" style="width: 100px; margin-left:8px"> <?php } ?>
                                        </div>
                                        <div class="comment-time">
                                        <?php echo date("d-m-Y H:i",strtotime($row  ['ThoiGian'])); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            }
                        }else {
                            ?> <span>Sản phẩm chưa có đánh giá</span> <?php
                        }
                        ?>
                        </div>
                    </div>
                    <div class="panel panel-review">
                        <form method="post" action="" >
                        <div style="margin-left: 70px">
                        <div class="rating" style="font-size: 25px;">
                            <i class="fas fa-star vote" data-index="0"></i>
                            <i class="fas fa-star vote" data-index="1"></i>
                            <i class="fas fa-star vote" data-index="2"></i>
                            <i class="fas fa-star vote" data-index="3"></i>
                            <i class="fas fa-star vote" data-index="4"></i>    
                            <input type="hidden"  id="rating" name="rating">
                        </div>
                        <div class="flex">
                            <div class="mb-3">
                                <span class="block">Họ và tên </span><input type="text" name="Name" 
                                class="form-control" placeholder="Họ và tên"  required>
                            </div>
                            <div class="mb-3">
                                <span class="block">Số điện thoại </span><input type="text" name="SDT" 
                                class="form-control" placeholder="Số điện thoại"  required>
                            </div>
                         </div>
                            <div class="mb-3 w-100">
                              <span class="block" style="width:100%">Ảnh sản phẩm</span> 
                              <input style="width: 30.7% !important;" type="file" class="form-control" name="AnhSP1" >
                              <input style="width: 30.7% !important;" type="file" class="form-control" name="AnhSP2" >
                              <input style="width: 30.7% !important;" type="file" class="form-control" name="AnhSP3" >
                            </div>
                          <div class="mb-3">
                            <span class="block">Nhận xét của bạn </span>
                            <textarea style="width: 920px !important; margin-left: 2px;" name="Comment" 
                            class="form-control" placeholder="" rows="3" required></textarea>
                          </div>
                          <div class="flex"> 
                            <button type="submit" class="btn btn-add" name="btnRate"> Gửi đánh giá</button> 
                        </div></div>
                        </form>
                    </div>
                    
                    
                    
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
                                            <h6 class="card-title text-uppercase" ><a href="CTSanPham.php?ID=<?php echo $row['MaSP'] ?>" class="text-decoration-none text-black" style="font-size: 14px;"><?php echo $row['TenSP'] ?></a></h6>
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
    $('input.input-qty').each(function() {
        var $this = $(this),
        qty = $this.parent().find('.is-form'),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'))
        if (min == 0) {
        var d = 0
        } else d = min
        $(qty).on('click', function() {
        if ($(this).hasClass('minus')) {
            if (d > min) d += -1
        } else if ($(this).hasClass('plus')) {
            var x = Number($this.val()) + 1
            if (x <= max) d += 1
        }
        $this.attr('value', d).val(d)
        })
    })
</script>
<script>
    var a = document.querySelector.bind(document);
    var b = document.querySelectorAll.bind(document);
    
    var tab = b('.tab');
    var panel = b('.panel');

    tab.forEach((tab,index) => {
        tab.onclick = function () {
            var panes = panel[index]

            a('.tab.tab-active').classList.remove('tab-active');
            a('.panel.panel-active').classList.remove('panel-active');

            this.classList.add('tab-active');
            panes.classList.add('panel-active');
        }
    });
</script>
<script>
var ratedIndex = -1;

$(document).ready(function () {
    resetStarColors();


    $('.vote').on('click', function () {
        ratedIndex = parseInt($(this).data('index'));
        $('#rating').val(ratedIndex+1);
    });

    $('.vote').mouseover(function () {
        resetStarColors();
        var currentIndex = parseInt($(this).data('index'));
        setStars(currentIndex);
        
    });

    $('.vote').mouseleave(function () {
        resetStarColors();

        if (ratedIndex != -1)
            setStars(ratedIndex);
    });
});

function setStars(max) {
    for (var i=0; i <= max; i++)
        $('.vote:eq('+i+')').css('color', '#FF9727');
}

function resetStarColors() {
    $('.vote').css('color', 'gray');
}

</script>
<script src="scroll.js"></script>
<script src="search.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
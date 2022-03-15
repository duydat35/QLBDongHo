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
    <div class="container">
        <!-- <div class="main__title mb-3 rounded">
            Sản phẩm
        </div> -->
        <div class="card-row">
            <div class="card__product shadow-lg bg-1" >
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h2>
                    <?php echo mysqli_fetch_row(mysqli_query($con, "SELECT sum(soluong) FROM ctdathang,dathang WHERE ctdathang.MaPhieuDat = dathang.MaPhieuDat"))[0]; ?>
                    </h2>
                    <span style="display:block">Số lượng đồng hồ bán ra</span>
                </div>
            </div>
            <div class="card__product shadow-lg bg-2">
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h3>
                    <?php echo mysqli_fetch_row(mysqli_query($con, "SELECT ThuongHieu,SUM(soluong) FROM sanpham,ctdathang WHERE ctdathang.MaSP = sanpham.MaSP GROUP BY ThuongHieu ORDER BY SUM(soluong) DESC"))[0]; ?>
                    </h3>
                    <span style="display:block">Thương hiệu ưa chuộng</span>
                </div>
            </div>      
            <div class="card__product shadow-lg bg-3">
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h2>
                    <?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(DISTINCT ThuongHieu) FROM sanpham"))[0]; ?>
                    </h2>
                    <span style="display:block">Thương hiệu đồng hành</span>
                </div>
            </div>
        <!-- </div> -->
        <!-- <div class="main__title mb-3 rounded">
            Khách hàng
        </div> -->
        <!-- <div class="card-row"> -->
            <div class="card__product shadow-lg bg-1 ">
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h2>
                    <?php echo mysqli_num_rows(mysqli_query($con, " SELECT COUNT(dathang.makh) FROM khachhang,dathang WHERE khachhang.MaKH = dathang.MaKH  GROUP BY dathang.makh HAVING COUNT(dathang.makh) > 1")); ?>
                    </h2>
                    <span style="display:block">Khách hàng quay trở lại</span>
                </div>  
            </div>
            <div class="card__product shadow-lg bg-2">
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h2>
                        <?php echo 2021-mysqli_fetch_row(mysqli_query($con, "SELECT YEAR(ngaysinh) from khachhang,dathang WHERE khachhang.MaKH = dathang.MaKH  HAVING COUNT(*) >= ALL(SELECT COUNT(*) 
                                                                                                                                                                            from khachhang,dathang WHERE khachhang.MaKH = dathang.MaKH )"))[0]; ?>
                    </h2>
                    <span style="display:block">Độ tuổi mua nhiều nhất</span>
                </div>
            </div>
            <div class="card__product shadow-lg bg-3">
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h2 style="font-size: 32px;">
                    <?php echo number_format(floatval(mysqli_fetch_row(mysqli_query($con, "SELECT SUM(TongTien) FROM dathang"))[0])); ?>
                    </h2>
                    <span style="display:block">Tổng doanh thu</span>
                </div>
            </div>
        <!--  </div> -->
        <!-- <div class="main__title mb-3 rounded">
            Đơn hàng
        </div> -->
        <!-- <div class="card-row"> --> 
            <div class="card__product shadow-lg bg-1 ">
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h2>
                    <?php echo mysqli_fetch_row(mysqli_query($con, " SELECT COUNT(*) FROM dathang"))[0]; ?>
                    </h2>
                    <span style="display:block">Tổng đơn hàng</span>
                </div>
            </div>
            <div class="card__product shadow-lg bg-2">
                <div class="card__left">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card__right">
                    <h2>
                    <?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM dathang WHERE TrangThai <> 'Hoàn thành'"))[0]; ?>
                    </h2>
                    <span style="display:block">Đơn hàng chưa hoàn thành</span>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
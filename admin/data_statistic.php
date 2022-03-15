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
    <link rel="stylesheet" href="data_statistic.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Home</title>
</head>
<body>
<?php
    include_once 'config.php';

     date_default_timezone_set('Asia/Ho_Chi_Minh');
     $time = date('d/m/Y', time());
     $date = date('Y-m-d', time());
    ?>
    <div class="container">
        <div class="main__title mb-3 rounded">Thống kê báo cáo</div>
        <div class="main__content main__edit shadow bg-white rounded ">
            <form method="post">    
                <div class="box-data border rounded"> 
                    <p>Hoạt động trong ngày <?php echo $time ?> </p>
                    <ul><a href="#"><i class="fas fa-sync-alt" aria-hidden="true"></i></a></ul>
                </div>
                <div class="form_tt border">
                    <div class="row">
                        <div class="col">
                            <div class="p-3 border bg-light rounded">
                                <div class="row_order title_order d-flex align-items-center">
                                    <i class="fas fa-calculator" aria-hidden="true"> Đơn Đặt hàng</i >  
                                    <span><?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) from dathang WHERE ThoiGianDat = '$date'"))[0]; ?></span>
                                </div>
                                <div class="row_order row_tt">
                                    <span>Đơn chờ xác nhận</span>
                                    <span><?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) from dathang WHERE TrangThai = 'Chờ xác nhận' AND ThoiGianDat = '$date'"))[0]; ?></span>
                                </div>
                                <div class="row_order row_tt">
                                    <span>Đơn đang giao</span>
                                    <span><?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) from dathang WHERE TrangThai = 'Đang giao' AND ThoiGianDat = '$date'"))[0]; ?></span>
                                </div>
                                <div class="row_order row_tt">
                                    <span>Đơn hoàn thành</span>
                                    <span><?php echo mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) from dathang WHERE TrangThai = 'Hoàn thành' AND ThoiGianDat = '$date'"))[0]; ?></span>
                                </div>
                            
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border bg-light rounded">
                                <div class="row_order title_order d-flex align-items-center">
                                    <i class="fas fa-calculator" aria-hidden="true">  Tiền thu</i >  
                                    <span><?php echo number_format(floatval(mysqli_fetch_row(mysqli_query($con, "SELECT sum(TongTien)FROM dathang WHERE ThoiGianDat = '$date'"))[0])); ?></span>
                                </div>
                                <div class="row_order row_tt">
                                    <span>Đồng hồ bán được</span>
                                    <span>
                                    <?php echo mysqli_fetch_row(mysqli_query($con, "SELECT sum(soluong) FROM ctdathang,dathang WHERE ThoiGianDat = '$date' AND ctdathang.MaPhieuDat = dathang.MaPhieuDat"))[0]; ?>
                                    </span>
                                </div>
                                <div class="row_order row_tt">
                                    <span>Đơn chưa hoàn thành</span>
                                    <span>
                                    <?php echo number_format(floatval(mysqli_fetch_row(mysqli_query($con, "SELECT sum(TongTien)FROM dathang 
                                    WHERE ThoiGianDat = '$date' AND TrangThai <> 'Hoàn Thành'"))[0])); ?>
                                    </span>
                                </div>
                                <div class="row_order row_tt">
                                    <span>Đơn hoàn thành</span>
                                    <span>
                                    <?php echo number_format(floatval(mysqli_fetch_row(mysqli_query($con, "SELECT sum(TongTien)FROM dathang 
                                    WHERE ThoiGianDat = '$date' AND TrangThai = 'Hoàn Thành'"))[0])); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form class="data-table" action="index.php?page=search_date" method="post">
                <div class="main__top">
                    <div class="input-group">
                        <div class="tk">
                            <div class="form-outline " style="display: flex;">
                                <input id="date_begin" name="date_begin" type="date" class="form-control" placeholder="Ngày 24/4/2021" required style="width: 300px;font-size: 18px ; margin-right: 20px">
                                <input id="date_end" name="date_end" type="date"  class="form-control" placeholder="Ngày 25/4/2021" required style="width: 300px;font-size: 18px ; margin-right: 20px">
                            </div>
                            <button  class="btn search-btn" type="submit" name="btn-search_date" > <i class="fas fa-search"></i></button>
                        </div>
                        <div><a href="index.php?page=statistic_chart" style="color: #4399e3;"><i class="fas fa-info-circle"></i> Biểu đồ</a></div>
                    </div>
                </div>
            </form>
            <div class="main__table">
                <table class="table" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" onclick="sortTableNumber(0)" class="sort">Mã Phiếu Đặt</th>
                            <th scope="col" >Tên Khách Hàng</th>
                            <th scope="col" onclick="sortTable(2)" class="sort">Thời Gian</th>
                            <th scope="col" onclick="sortTable(3)" class="sort">Trạng thái</th>
                            <th scope="col" onclick="sortTableNumber(4)" class="sort">Tổng Tiền</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php
                        $sql = " SELECT * FROM dathang,khachhang WHERE dathang.MaKH = khachhang.MaKH ";
                        $result_set=mysqli_query($con, $sql);
                        if(mysqli_num_rows($result_set)>0)
                        {
                            while($row=mysqli_fetch_array($result_set))
                            {
                                ?>
                                    <tr class= "table__row text-center">
                                        <td scope="row"><?php echo $row['MaPhieuDat'] ?></td>
                                        <td><?php echo $row['TenKH'] ?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row['ThoiGianDat']))?></td>
                                        <td><?php echo $row['TrangThai'] ?></td>
                                        <td><?php echo number_format(floatval($row['TongTien']));?></td>
                                    </tr> 
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class= "d-flex justify-content-end align-items-center" style="margin-right: 30px;">
                    <h4 style="margin: 0 300px 0 0;">Tổng cộng</h4>
                    <?php 
                    echo number_format(floatval(mysqli_fetch_row(mysqli_query($con, "SELECT SUM(TongTien) FROM dathang"))[0])); 
                    ?>
                </div>
            </div>
            </form>
        </div>
    </div>
<script src="./table.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
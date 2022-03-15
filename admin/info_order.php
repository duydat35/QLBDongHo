<?php 
include_once 'config.php';
if(isset($_POST['ID']))
{
    $orderID = $_POST['ID'];

    $sql = "SELECT * FROM dathang,khachhang,ctdathang,sanpham WHERE khachhang.MaKH = dathang.MaKH 
            AND ctdathang.MaPhieuDat = dathang.MaPhieuDat 
            AND sanpham.MaSP = ctdathang.MaSP
            AND dathang.MaPhieuDat=".$orderID;
    $sql2 = "SELECT * FROM dathang,khachhang WHERE MaPhieuDat=".$orderID."
    AND khachhang.MaKH = dathang.MaKH ";
    $result_set=mysqli_query($con, $sql);
    $result_set1=mysqli_query($con, $sql2);
        if(mysqli_num_rows($result_set)>0)
        {
            $row1=mysqli_fetch_array($result_set1); ?>
            <div class="text-center">
                
                <h6 class="text-uppercase">Địa chỉ: <?php echo $row1['DiaChi']; ?></h6> 
            </div>
            <?php
            while($row=mysqli_fetch_array($result_set))
            {
                ?>
                <table  style = "border:0 ;width:100% ; color: #333; margin-bottom: 15px">
                    <tr style="border-bottom: 1px solid rgba(0,0,0,0.1)">
                        <td width="300"><img src="../image/<?php echo $row['AnhSP']; ?>">
                        <td style="padding:20px;">
                        <p style="font-weight: 500; margin-bottom: 8px;">Tên đồng hồ: <?php echo $row['TenSP']; ?></p>
                        <p style="margin-bottom: 5px">Mã đồng hồ: <?php echo $row['MaSP']; ?></p>
                        <p style="margin-bottom: 5px">Thương hiệu: <?php echo $row['ThuongHieu']; ?></p>
                        <p style="margin-bottom: 5px">Số lượng đặt:  <?php echo $row['SoLuong']; ?></p>
                        <p style="margin-bottom: 5px">Giá tiền:  <?php echo number_format(floatval($row['ThanhTien']), 0, ".", ","); ?></p>
                        </td>
                    </tr>
                </table>
                <?php   
            }
           ?> </table><h6 class="">Yêu cầu <?php echo $row1['YeuCau']; ?></h6>  <?php
        }
}
?>
<?php 
include_once 'config.php';

$customerID = $_POST['ID'];

$sql = "SELECT * FROM khachhang WHERE MaKH =".$customerID;
$result_set=mysqli_query($con, $sql);
    if(mysqli_num_rows($result_set)>0)
    {
        while($row=mysqli_fetch_row($result_set))
        {
            ?>
                <table style = "border:0 ;width:100%">
                <tr>
                    
                    <td style="padding:20px;">
                    <p style="font-weight: 500;">Mã khách hàng: <?php echo $row[0]; ?></p>
                    <p>Tên khách hàng: <?php echo $row[1]; ?></p>
                    <p>Giới tính: <?php echo $row[3]; ?></p>
                    <p>Ngày sinh: <?php echo date("d-m-Y",strtotime($row[4])) ?></p>
                    <p>Điện thoại: <?php echo $row[2]; ?></p>
                    <p>Email: <?php echo $row[5]; ?></p>
                    <p>Địa chỉ: <?php echo $row[6]; ?></p>
                    <p>Yêu cầu: <?php echo $row[7]; ?></p>
                </table>
            <?php
        }
    }
?>
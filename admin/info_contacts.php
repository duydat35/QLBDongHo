<?php 
include_once 'config.php';

$contactsID = $_POST['ID'];

$sql = "SELECT * FROM lienhe WHERE MaLH =".$contactsID;
$result_set=mysqli_query($con, $sql);
    if(mysqli_num_rows($result_set)>0)
    {
        while($row=mysqli_fetch_array($result_set))
        {
            ?>
                <table style = "border:0 ;width:100%">
                <tr>
                    <td style="padding:20px;">
                    <p style="font-weight: 500;">Mã liên hệ: <?php echo $row['MaLH']; ?></p>
                    <p>Tên khách hàng: <?php echo $row['TenKH']; ?></p>
                    <p>Email: <?php echo $row['Email']; ?></p>
                    <p>Số điện thoại: <?php echo $row['DienThoai']; ?></p>
                    <p>Tiêu đề: <?php echo $row['TieuDe']; ?></p>
                    <p>Thời gian: <?php echo $row['ThoiGian']; ?></p>
                    <p>Nội dung: <?php echo $row['NoiDung']; ?></p>
                </table>
            <?php
        }
    }
?>
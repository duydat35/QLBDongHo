<?php
    include_once 'config.php';

    if(isset($_GET['ID']))
    {
        $order_ID = $_GET['ID'];

        $sql = "DELETE FROM ctdathang WHERE MaPhieuDat = ".$order_ID ; 
        $sql2 = "DELETE FROM dathang WHERE MaPhieuDat = ".$order_ID;
        mysqli_query($con,$sql);
        mysqli_query($con,$sql2);
        header("location:index.php?page=display_order");
    }
?>
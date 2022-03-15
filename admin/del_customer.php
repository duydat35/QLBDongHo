<?php
include_once 'config.php';

    if(isset($_GET['delete_id']))
    {
        $sql = "DELETE FROM KhachHang WHERE MaKH=".$_GET['delete_id'];
        mysqli_query($con,$sql);
        header("location:index.php?page=display_customer");
    }
?>
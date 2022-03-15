<?php
    include_once 'config.php';

    if(isset($_GET['ID']))
    {
        $sql = "DELETE FROM sanpham WHERE MaSP=".$_GET['ID'];
        mysqli_query($con,$sql);
        header("location:index.php?page=display_product");
    }
?>
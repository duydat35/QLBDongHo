<?php
include_once 'config.php';
session_start();
$login= $_SESSION['login'];
if($login=="")
{
header('location:login.php');
}

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
    <title>Trang chủ</title>
</head>
<body>
<!-- navbar -->
    <nav class="navbar">
        <div class="navbar__title">
            <div class="navbar__menu">
                <button class="navbar__menu-btn" id="menu-btn" onclick=test()><i class="fas fa-bars"></i></button>
            </div>
            <span>Welcome Admin</span>
        </div>
        <div class="navbar__user">
            <div class="navbar__icon">
                <img src="../image/user.png">
            </div>
            <div class="navbar__logout">
                <a href="logout.php" >Đăng xuất</a>    
            </div>
        </div>
    </nav> 
<!-- main -->   
<div class="main">
    <!-- mainleft -->
    <div class="sidebar" id="sidebar">
        <div class="logo" id="sidebar_list">
            <a href="../index.php"><img src="../image/logo2.png"></a>
        </div>
        <ul class="list">
            <li class="list__item">
                <a href="index.php"><i class="fas fa-home"></i>Trang chủ</a>
            </li>
            <li class="list__item">
                <a href="index.php?page=display_product"><i class="fas fa-clock"></i>Quản lý sản phẩm</a>
            </li>
            <li class="list__item">
                <a href="index.php?page=display_order"><i class="fas fa-cart-plus"></i>Quản lý đơn hàng</a>
            </li>
            <li class="list__item">
                <a href="index.php?page=display_customer"><i class="fas fa-users"></i>Quản lý khách hàng</a>
            </li>
            <li class="list__item">
                <a href="index.php?page=display_contacts"><i class="fas fa-comment-dots"></i>Quản lý phản hồi</a>
            </li>       
            <li class="list__item">
                <a href="index.php?page=data_statistic"><i class="fas fa-chart-bar"></i>Thống kê</a>
            </li>
        </ul>
    </div>
    <!-- main right -->
    <div class="container">
    <?php 
		@$page=  $_GET['page'];
		  if($page!="")
		  {
		  	if($page=="display_product")
			{
				include('display_product.php');
			}
		  	if($page=="edit_product")
			{
				include('edit_product.php');
			}
            if($page=="add_product")
			{
				include('add_product.php');
			}
            if($page=="display_customer")
			{
				include('display_customer.php');
			}
            if($page=="edit_customer")
			{
				include('edit_customer.php');
			}
            if($page=="display_order")
			{
				include('display_order.php');
			}
            if($page=="edit_order")
			{
				include('edit_order.php');
			}
            if($page=="display_contacts")
			{
				include('display_contacts.php');
			}
            if($page=="data_statistic")
			{
				include('data_statistic.php');
			}
            if($page=="search_date")
			{
				include('search_date.php');
			}
            if($page=="statistic_chart")
			{
				include('statistic_chart.php');
			}
          }
          else
          {
            include('home.php');
          }  
          ?>   
    </div>
<script>
    var sidebar = document.getElementById('sidebar');
    var ul = document.getElementById('sidebar_list');
    var btn = document.getElementById('menu-btn');
    var li = ul.getElementsByTagName("li");
    function test()
    {   
        // li.style.opacity="0";
        sidebar.classList.toggle("display-block");
        
    }  
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>         
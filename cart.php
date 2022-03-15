<?php
include_once './admin/config.php';
session_start();

function getCountProducts() {
  if (isset($_SESSION['OrderProduct'])) {
      return count($_SESSION['OrderProduct']);
  } else {
      return 0;
  }
}

function deleteProductFromCart($productId) {
    unset($_SESSION['OrderProduct'][$productId]);
}

$orderProduct = array();//= n
if (isset($_SESSION['OrderProduct'])) {
  $orderProduct = $_SESSION['OrderProduct'];
}

// $addProductId = '';
$addProductQuantity = 0;
if (isset($_POST['txtProductQuantity'])) {
    $addProductId =  $_GET['ID'];
    $addProductQuantity = $_POST['txtProductQuantity'];
    
    if (!isset($orderProduct[$addProductId])) {
        $orderProduct[$addProductId] = intval($addProductQuantity);
    } else {
        $orderProduct[$addProductId] = $orderProduct[$addProductId] + intval($addProductQuantity);
    }
    
    $_SESSION['OrderProduct'] = $orderProduct;
}
else if (isset($_GET['IDproduct'])) {
    $addProductId =  $_GET['IDproduct'];
    $addProductQuantity = 1;
    
    if (!isset($orderProduct[$addProductId])) {
        $orderProduct[$addProductId] = intval($addProductQuantity);
    } else {
        $orderProduct[$addProductId] = $orderProduct[$addProductId] + intval($addProductQuantity);
    }
    
    $_SESSION['OrderProduct'] = $orderProduct;
}

// var_dump($_SESSION['OrderProduct']);


?>
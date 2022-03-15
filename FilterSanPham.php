<?php 
$sortparam = '';
$filterparam= '';
//filter 
$filter ='';
$ThuongHieu = isset($_GET['TH'])?$_GET['TH']:'';
if(!empty($ThuongHieu))
{   
    $filter = "WHERE ThuongHieu = '$ThuongHieu'";
    $filterparam = "TH=$ThuongHieu&";
    // $param = "?TH=$ThuongHieu&";
}
$XuatXu = isset($_GET['XX'])?$_GET['XX']:'';
if(!empty($XuatXu))
{   
    $filter = "WHERE XuatXu = '$XuatXu'";
    $filterparam = "XX=$XuatXu&";
    // $param = "?TH=$ThuongHieu&";
}
$DoiTuong = isset($_GET['DT'])?$_GET['DT']:'';
if(!empty($DoiTuong))
{   
    $filter = "WHERE DoiTuong = '$DoiTuong'";
    $filterparam = "DT=$DoiTuong&";
    // $param = "?TH=$ThuongHieu&";
}
$BoMay = isset($_GET['BM'])?$_GET['BM']:'';
if(!empty($BoMay))
{   
    $filter = "WHERE BoMay = '$BoMay'";
    $filterparam = "BM=$BoMay&";
    // $param = "?TH=$ThuongHieu&";
}
$MinGia = isset($_GET['Min'])?$_GET['Min']:'';
$MaxGia = isset($_GET['Max'])?$_GET['Max']:'';
if(!empty($MinGia) && !empty($MaxGia))
{   
    $filter = "WHERE Gia BETWEEN '$MinGia' AND '$MaxGia'";
    $filterparam = "Min=$MinGia&Max=$MaxGia&";
}

//sap xep
$sort='ORDER BY Gia DESC';
$sortName = isset($_GET['field']) ? $_GET['field'] : "";
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : "";
if(!empty($sortName) && !empty($sortOrder) )
{
    $sort = "ORDER BY `sanpham`.`$sortName` $sortOrder";
    $sortparam = "field=$sortName&sort=$sortOrder&";
}

?>
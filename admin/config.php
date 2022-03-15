<?php
    $host="localhost";
    $user="root";
    $password="";
    $databaname="dongho";

    $con=mysqli_connect($host,$user,$password);
    mysqli_select_db($con,$databaname);
    mysqli_set_charset($con,"utf8");
?>


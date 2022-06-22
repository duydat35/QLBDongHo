<?php
    $host="us-cdbr-east-05.cleardb.net";
    $user="bbe3c1eb6cfb37";
    $password="6489e4dd";
    $databaname="heroku_f4bb5cf861ae6aa";

    $con=mysqli_connect($host,$user,$password);
    mysqli_select_db($con,$databaname);
    mysqli_set_charset($con,"utf8");

   
    // $host="localhost";
    // $user="root";
    // $password="";
    // $databaname="dongho";

    // $con=mysqli_connect($host,$user,$password);
    // mysqli_select_db($con,$databaname);
    // mysqli_set_charset($con,"utf8");
?>


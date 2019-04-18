<?php
$host = "localhost";
$dbname = "gps";
$username = "root";
$password ="";
$con = mysqli_connect($host,$username,$password,$dbname);

if (mysqli_error($con)){
    echo "error";
}

if ((isset($_GET['long']) && isset($_GET[['lati']])) == FALSE){
    die();
}
 $long = $_GET['long'];
 $lati = $_GET['lati'];

 $con ->query ("insert into `gpsdata` (longt,lati)
        values('$long','$lati')");
 
?>
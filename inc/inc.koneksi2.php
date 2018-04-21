<?php
$serverName = "192.168.1.237";
$connectionInfo = array( "Database"=>"rspdhi", "UID"=>"rs", "PWD"=>"rsiyrs");
$conn = sqlsrv_connect($serverName,$connectionInfo);

if($conn) {
}else{
     echo "Tidak Bisa Koneksi Ke Database<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>
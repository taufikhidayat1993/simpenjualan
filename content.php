<?php


$mod = $_GET['module'];
$sql="	SELECT 
DIR,
MENU_URL
FROM
RS_MENU WHERE MENU_URL='$mod'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
$row_count = sqlsrv_num_rows($stmt1);
if ($mod=='home'){
	  include "modul/home/home.php";
}

else if($row_count > 0){
 if ($mod==$data['MENU_URL']){
    include "modul/".$data['DIR'].".php";
}

}
else if($mod=='pendaftaran'){
	include"modul/pg_pendaftaran/pendaftaran.php";
}else if($mod=='radiologi'){
	include"modul/pg_radiologi/radiologi.php";
}else if($mod=='laboratorium'){
	include"modul/pg_laboratorium/laboratorium.php";
}else if($mod=='diagnosa'){
	include"modul/pg_diagnosa/diagnosa.php";
}else if($mod=='cetak_sep'){
	include"modul/pg_sep/cetak_sep.php";
}else{
include "modul/home/home.php";
}

?>

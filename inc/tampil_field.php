<?php
function nama_dokter($dr_id){
include "inc.koneksi.php";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="select NAME from RS_DOKTER  where DR_ID = '".$dr_id."'";
$stmt = sqlsrv_query($conn,$sql,$params,$options);
$data=sqlsrv_fetch_array($stmt);

return $data['NAME'];
}

function poliklinik($dr_id){
include "inc.koneksi.php";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="select NAME from RS_POLIKLINIK  where POLI_ID = '".$dr_id."'";
$stmt = sqlsrv_query($conn,$sql,$params,$options);
$data=sqlsrv_fetch_array($stmt);

return $data['NAME'];
}
function asuransi($id){
	include "inc.koneksi.php";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="select  ASURANSI_ID from RS_PASIEN  where PASIEN_ID = '".$id."'";
$stmt = sqlsrv_query($conn,$sql,$params,$options);
$data=sqlsrv_fetch_array($stmt);

return $data['ASURANSI_ID'];
}

?>
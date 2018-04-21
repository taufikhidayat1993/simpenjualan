<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
session_start();
$op=$_GET['op'];
if($op=='detailpoli'){
	$poli=$_POST['poli'];
$sql="
		SELECT
DR_ID,
NAME
FROM
RS_DOKTER WHERE POLI_ID='$poli'";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
ECHO"<option value=''>-------</option>";
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
										
											echo"<option value='$data[DR_ID]' selected>$data[NAME]</option>";	
										
										
									}



	
}if($op=='tambahalergi'){
	$ket_alergi=$_POST['ket_alergi'];
	$pasien_id=$_POST['pasien_id'];
	$sql="update RS_PASIEN set ALERGI='$ket_alergi' WHERE pasien_id='$pasien_id'";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
sqlsrv_query($conn,$sql,$params,$options);
	
}if($op=='detail_alergi'){
	$pasien_id=$_POST['id_pasien'];
	$sql="SELECT ALERGI FROM RS_PASIEN WHERE PASIEN_ID='$pasien_id'";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$stm=sqlsrv_query($conn,$sql,$params);
$data=sqlsrv_fetch_array($stm,SQLSRV_FETCH_ASSOC);
echo $data['ALERGI'];
	
}

?>
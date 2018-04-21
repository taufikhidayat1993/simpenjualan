<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
include"../../inc/label.php";

include"../../inc/tampil_field.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );	
$op=$_GET['op'];

if($op=='detaildokter'){
	$id=$_POST['id'];
	$sql="SELECT Q.DR_ID, Q.NAME  FROM rs.RS_PASIEN_MEDIS AS P LEFT JOIN rs.RS_DOKTER AS Q ON P.DR_ID = Q.DR_ID
           WHERE P.MEDIS_ID='".$id."'";		   
		   $stmt = sqlsrv_query( $conn, $sql , $params, $options );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	   $params['dr_name'] = $data['NAME'];
	    $params['kd_dokter'] = $data['DR_ID'];	 
 }
  echo json_encode($params);
}if($op=='detaildiagnosa'){
	$id=$_POST['id'];
	$sql="SELECT Q.DR_ID, Q.NAME  FROM rs.RS_PASIEN_MEDIS AS P LEFT JOIN rs.RS_DOKTER AS Q ON P.DR_ID = Q.DR_ID
           WHERE P.MEDIS_ID='".$id."'";		   
		   $stmt = sqlsrv_query( $conn, $sql , $params, $options );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	   $params['dr_name'] = $data['NAME'];
	    $params['kd_dokter'] = $data['DR_ID'];	 
 }
  echo json_encode($params);
}


?>
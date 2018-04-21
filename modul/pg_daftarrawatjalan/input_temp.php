<?php
error_reporting();
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";

session_start();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$params = array();

$id_lab   =   $_POST['id_lab'];
$medis_id =  $_POST['medis_id'];
$sql3="select ICD9 FROM RS_LAB_GROUP where ID=$id_lab";
$quer = sqlsrv_query($conn,$sql3,$params);
$row=sqlsrv_fetch_array($quer,SQLSRV_FETCH_ASSOC);
	$sq="select * from RS_TMPLAB WHERE id_lab='$id_lab' AND trx_id='$medis_id'";
	$d = sqlsrv_query($conn,$sq,$params,$options);
	$hit= sqlsrv_num_rows($d);
	if($hit > 0){
	
		$sql="DELETE FROM RS_TMPLAB WHERE id_lab=$id_lab and trx_id='$medis_id'";
	}else {
$sql="INSERT into RS_TMPLAB (id_lab,trx_id,icd9)values('$id_lab','$medis_id','".$row['ICD9']."')";
	}
 sqlsrv_query($conn,$sql,$params);
//echo "<tr><td colspan=3>".$sql."</td></tr>";

?>
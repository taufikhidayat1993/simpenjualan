<?php
error_reporting();
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";

session_start();

$medis_id=$_POST['medis_id'];
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$temp=$_POST['group'];
$nama=$_POST['nama'];
$params = array();
$sql="select ID,NAME,GROUP1 FROM RS_LAB_GROUP where 1=1";
if($temp!=''){
	$sql.=" and GROUP1='$temp'";
}
if($nama!=''){
	$sql.=" and NAME LIKE '%$nama%'";
}
$sql.=" order by group1";
$stmt = sqlsrv_query( $conn,$sql,$params);
//echo "<tr><td colspan=3>".$sql."</td></tr>";
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	$sq="select * from RS_TMPLAB WHERE id_lab='$data[ID]' AND trx_id='$medis_id'";
	$d = sqlsrv_query($conn,$sq,$params,$options);
	$hit= sqlsrv_num_rows($d);
	if($hit > 0){
		$cek="checked";
	}else{
		$cek="";
	}
	echo"<tr><td><input type='checkbox' onclick='javascript:Ceklab(".$data['ID'].",\"".$medis_id."\");' $cek ></td>
	<td>$data[NAME]</td><td>$data[GROUP1]</td></tr>";
}
?>
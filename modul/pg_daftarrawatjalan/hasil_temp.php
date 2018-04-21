<?php
error_reporting();
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";

session_start();
$params = array();
$sql="select b.NAME as nama_lab,b.GROUP1,a.id_lab FROM RS_TMPLAB a left join RS_LAB_GROUP b on a.id_lab=b.id and a.modiby='$_SESSION[username]'";

$stmt = sqlsrv_query( $conn,$sql,$params);
//echo "<tr><td colspan=3>".$sql."</td></tr>";
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	echo"<tr>
	<td>$data[nama_lab]</td><td>$data[GROUP1]</td>
	</tr>";
}
?>
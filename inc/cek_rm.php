	<?php
	function CheckKey($data) {
				include"../../inc/inc.koneksi.php";				
									
$sql="SELECT
rs.RS_PASIEN.NO_RM
FROM
rs.RS_PASIEN WHERE  NO_RM='$data' ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$dataku=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$ket=sqlsrv_num_rows($stmt);
if ($ket>0) {
	
	$a=$dataku['NO_RM']+1;
	sqlsrv_query( $conn, "update RM set RM='$a'" , $params, $options );
return (CheckKey($a));
} else {
sqlsrv_query( $conn, "update RM set RM='$data'" , $params, $options );
return $data;
}
}
?>
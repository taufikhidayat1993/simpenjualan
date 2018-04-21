<?php
include "../../inc/inc.koneksi.php";

$PID= $_GET['PID'];

$sql=("
SELECT
P.OPNAME_ID,
P.PASIEN_ID,
Q.NO_RM,
Q.NAME,
LOWER(Q.ADDRESS) AS ADDRESS,
RS.FN_GET_ASURANSI_PASIEN (P.PASIEN_ID) AS ASURANSI_PASIEN,
CONVERT(VARCHAR(11),P.DATETIME_IN,106) AS DATE_IN,
CONVERT(VARCHAR(8),P.DATETIME_IN,108) AS TIME_IN,
R.NAME AS KAMAR_NAME,
R.KELAS_ID AS ID_KELAS,
p.note,
Q.GENDER,
JK = CASE Q.GENDER WHEN 1 THEN 'L' WHEN 2 THEN 'P' END,
S.NAME AS NAME_KELAS

FROM
rs.RS_PASIEN_OPNAME AS P
LEFT JOIN rs.RS_KAMAR AS R ON P.KAMAR_ID = R.KAMAR_ID
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
INNER JOIN rs.RS_KELAS AS S ON R.KELAS_ID = S.KELAS_ID
WHERE
P.PASIEN_ID = Q.PASIEN_ID AND
P.STATUS_BAYAR = '0'
AND P.PASIEN_ID = '$PID'
");
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
	if ($row_count > 0){

    session_start();
	  	$r = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

		$_SESSION['OPNAME_ID'] = $r['OPNAME_ID'];
		$_SESSION['NO_RM']     = $r['NO_RM'];
		$_SESSION['NAME']     	= $r['NAME'];
		$_SESSION['JK']      	= $r['JK'];
    $_SESSION['ADDRESS']  	= $r['ADDRESS'];
		header('location:media_pasienranap.php');
	}else{
	?>
    <script>
	alert('Maaf, data pasien tidak ditemukan.');
	window.location.href='../../media.php?module=tampildatapasienranap';
	</script>
    <?php
	}

?>

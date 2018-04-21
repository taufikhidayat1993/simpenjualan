<?php
include "inc/inc.koneksi.php";

$PID= $_GET['PID'];

$sql=("
SELECT
P.MEDIS_ID,
P.PASIEN_ID,
Q.NO_RM,
Q.NAME,
LOWER(Q.ADDRESS) AS ADDRESS,
asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM' WHEN 3 THEN R.NAME END,
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,106) AS DATE_MEDIS,
CONVERT(VARCHAR(8),P.DATETIME_MEDIS,108) AS TIME_MEDIS,
S.NAME AS POLI_NAME,
P.ANTRIAN,
P.RUJUKAN_DATA_ID,
T.NAME AS nama_dokter,
T.DR_ID,
Q.GENDER,
gender=CASE Q.GENDER WHEN 1 THEN 'L' WHEN 2 THEN 'P' END

FROM
rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE
P.PASIEN_ID = Q.PASIEN_ID AND
P.STATUS_BAYAR = '0' AND P.PASIEN_ID = '$PID'
");
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
	if ($row_count > 0){

    session_start();
	  	$r = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

		$_SESSION['MEDIS_ID'] = $r['MEDIS_ID'];
		$_SESSION['PASIEN_ID'] = $r['PASIEN_ID'];
		$_SESSION['NO_RM']     = $r['NO_RM'];
		$_SESSION['NAME']     	= $r['NAME'];
		$_SESSION['JK']      	= $r['gender'];
    $_SESSION['ADDRESS']  	= $r['ADDRESS'];
		header('location:media.php?rawajalan=pasien&act=datapasien');
	}else{
	?>
    <script>
	alert('Maaf, data pasien tidak ditemukan.');
	window.location.href='media.php?module=tampildatapasienrajal';
	</script>
    <?php
	}

?>

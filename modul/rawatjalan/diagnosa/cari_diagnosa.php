<?php
session_start();
include '../../../inc/inc.koneksi.php';
include "../../../inc/fungsi_tanggal.php";

$IDdiagnosa= $_POST['IDdiagnosa'];
$seq_no= $_POST['seq_no'];

//--- query delete diagnosa pasien di RS_DIAGNOSA
$sql = "SELECT
P.*,
Q.NAME AS DR_NAME,
CONVERT(VARCHAR(10),P.DT_DIAGNOSA,110) AS DATE_DIAG
FROM
	rs.RS_DIAGNOSA P
LEFT JOIN rs.RS_DOKTER Q ON P.DR_ID = Q.DR_ID
WHERE
	P.DIAGNOSA_ID = '$IDdiagnosa'
AND P.SEQ_NO = '$seq_no'";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt= sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
if ($row_count>0){
while ($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){

	//$data['IDdiagnosa']= $data[DIAGNOSA_ID];v
	$data['IDdokter']= $data['DR_ID'];
	$data['dokter']= $data['DR_NAME'];
	$data['IDpenyakit']=$data['PENYAKIT_ID'];
//	$data['diagnosa']=$data[DIAGNOSA];
	$data['anamnesa']= $data['NOTE'];
	$data['tgl']=$data['DATE_DIAG'];
//  $data['seq_no']=$data[SEQ_NO];

		echo json_encode($data);
}
}else{
	//$data['IDdiagnosa']= $data[DIAGNOSA_ID];v
	$data['IDdokter']= $data['DR_ID'];
	$data['dokter']= $data['DR_NAME'];
	$data['IDpenyakit']=$data['PENYAKIT_ID'];
//	$data['diagnosa']=$data[DIAGNOSA];
	$data['anamnesa']= $data['NOTE'];
	$data['tgl']=$data['DATE_DIAG'];
//  $data['seq_no']=$data[SEQ_NO];
	echo json_encode($data);

}
?>

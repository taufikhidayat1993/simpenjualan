<?php
session_start();
include '../../../inc/inc.koneksi.php';
include "../../../inc/fungsi_tanggal.php";
//include '../../../auth.php';

$table1		="rs.RS_DIAGNOSA";
$table2		="rs.RS_MEDICAL_RECORD";

$IDdokter			=$_POST['IDdokter'];
$dokter				=$_POST['dokter'];
$IDpenyakit		=$_POST['IDpenyakit'];
$diagnosa			=$_POST['diagnosa'];
$anamnesa			=$_POST['anamnesa'];
$tgl					=jin_date_sql($_POST['tgl']);
$IDdiagnosa		=(string) ($_SESSION['MEDIS_ID']);
$IDuser				=$_SESSION['username'];

// ---- cek SEQ_NO di tabel RS_DIAGNOSA
$sql="IF EXISTS (
	SELECT
		SEQ_NO
	FROM
		$table1
	WHERE
		DIAGNOSA_ID = '$IDdiagnosa'
) SELECT
	MAX (SEQ_NO) AS SEQ_NO
FROM
	$table1
WHERE
	DIAGNOSA_ID = '$IDdiagnosa'
ELSE
	SELECT
		SEQ_NO
	FROM
		$table1
	WHERE
		DIAGNOSA_ID = '$IDdiagnosa'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);


if(empty($data["SEQ_NO"])){
$seq_no=1;
}else{
$seq_no=($data["SEQ_NO"]+1);
}

// --------input data diagnosa ke RS_DIAGNOSA
$inputdiagnosa = "INSERT INTO $table1
(DIAGNOSA_ID,SEQ_NO,DIAGNOSA,DIAGNOSA_TYPE,DR_ID,DT_DIAGNOSA,PENYAKIT_ID,NOTE,MODIBY,MODIDATE)
VALUES
('$IDdiagnosa','$seq_no','$diagnosa','2','$IDdokter','$tgl','$IDpenyakit','$anamnesa','$IDuser',GETDATE())";
sqlsrv_query($conn,$inputdiagnosa);

// ---- cari ID pasien di tabel RS_MEDICAL_RECORD
$sql1="SELECT LEFT('$IDdiagnosa',12) AS ID_PASIEN";
$params1 = array();
$options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql1 , $params1, $options1 );
$row_count1 = sqlsrv_num_rows( $stmt1 );
$data1=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);

$IDpasien=$data1["ID_PASIEN"];

// ---- cek SEQ_NO di tabel RS_MEDICAL_RECORD
$sql2="IF EXISTS (
	SELECT
		SEQ_NO
	FROM
		$table2
	WHERE
		PASIEN_ID = '$IDpasien'
) SELECT
	MAX (SEQ_NO) AS SEQ_NO
FROM
	$table2
WHERE
	PASIEN_ID = '$IDpasien'
ELSE
	SELECT
		SEQ_NO
	FROM
		$table2
	WHERE
		PASIEN_ID = '$IDpasien'";
$params2 = array();
$options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt2 = sqlsrv_query( $conn, $sql2 , $params2, $options2 );
$row_count2 = sqlsrv_num_rows( $stmt2 );
$data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC);


if(empty($data2["SEQ_NO"])){
$seq_no1=1;
}else{
$seq_no1=($data2["SEQ_NO"]+1);
}
// --------input data diagnosa ke RS_MEDICAL_RECORD
$inputmedicalrecord = "INSERT INTO $table2
(PASIEN_ID,SEQ_NO,DATA_MEDIS,NOTE,DT_RECORD,DR_ID,MODIBY,MODIDATE,DIAGNOSA_ID,SEQ_NO1)
VALUES ('$IDpasien','$seq_no','$diagnosa','$anamnesa','$tgl','$IDdokter','$IDuser',GETDATE(),'$IDdiagnosa','$seq_no1')";
sqlsrv_query($conn,$inputmedicalrecord);
?>

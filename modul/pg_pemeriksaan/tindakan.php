<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";


session_start();
include"../../inc/fungsi_indotgl.php";

$op=$_GET['op'];

if($op == 'simpan_tindakan'){
	$medis_id=$_POST['medis_id'];
	$opsi=$_POST['opsi'];
	$opsidata=$_POST['opsidata'];
	$pisah = explode('|',$_POST['tindakan']);
	$tindakan=$pisah[0];
	$harga=$pisah[1];
	$dokter=$_POST['dokter'];
	$catatan=$_POST['catatan'];
    $tanggal=tgl_time($_POST['tanggal']);
	$cito=$_POST['cito'];
	$note=$catatan."".$cito;
$sql="IF EXISTS (
	SELECT
		SEQ_NO
	FROM
		RS_MEDIS_TINDAKAN 
	WHERE
		MEDIS_ID = '".$medis_id."'

)  SELECT
	MAX (SEQ_NO) AS SEQ_NO
FROM
	RS_MEDIS_TINDAKAN 
WHERE
	MEDIS_ID = '".$medis_id."' 
ELSE
	SELECT
		SEQ_NO
	FROM
		RS_MEDIS_TINDAKAN 
	WHERE
		MEDIS_ID = '".$medis_id."'";
$stmt = sqlsrv_query( $conn, $sql , $params, $options );	
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

if($data['SEQ_NO']==0){
	$seq_no= 1;
}else{
  $seq_no= $data['SEQ_NO']+1;
}
if($opsi==0){
	$dokter=$dokter;
	$perawat="NULL";
}else{
	$dokter="NULL";
	$perawat=$dokter;
}
if($opsidata==0){
	$field="TINDAKAN_ID";
}else if($opsidata==1){
	$field="OPERASI_ID";		
}else {
	$field="PERSALINAN_ID";
}
$sql2="INSERT INTO RS_MEDIS_TINDAKAN (MEDIS_ID,SEQ_NO,".$field.",
       DR_ID,DATE_TIME,NOTE,PERAWAT_ID,TINDAKAN_MODE,HARGA,BILL_TYPE,MODIBY,MODIDATE)VALUES ('".$medis_id."','".$seq_no."','".$tindakan."','".$dokter."','".$tanggal."','".$note."','".$perawat."','".$opsi."',
		  '".$harga."','','".$_SESSION['nama']."',GETDATE())";	
sqlsrv_query( $conn, $sql2 , $params, $options );	
}if($op == 'daftartindakan'){
	$medis_id=$_POST['medis_id'];
	$sql="SELECT
	CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	P.TINDAKAN_ID 
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	P.OPERASI_ID 
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			P.PERSALINAN_ID
		END
	) 
END 
END AS TINDAKAN,
 CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	Q.NAME 
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	R.NAME 
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			S.NAME
		END
	) 
END 
END AS TINDAKAN_NAME,
 P.SEQ_NO,
 P.HARGA,
 CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	'5'
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	'3' 
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			'4'
		END
	) 
END 
END AS TINDAKAN_TYPE,
 CASE
WHEN DR.NAME IS NOT NULL THEN
	DR.NAME
ELSE
	PR.NAME
END AS PETUGAS_NAME,
 P.NOTE,
 P.DATE_TIME,
 p.MEDIS_ID
FROM
	RS_MEDIS_TINDAKAN P 
LEFT JOIN RS_TINDAKAN Q ON P.TINDAKAN_ID = Q.TINDAKAN_ID 
LEFT JOIN RS_OPERASI R ON P.OPERASI_ID = R.OPERASI_ID 
LEFT JOIN RS_PERSALINAN S ON P.PERSALINAN_ID = S.PERSALINAN_ID
LEFT JOIN RS_DOKTER DR ON P.DR_ID = DR.DR_ID 
LEFT JOIN RS_PERAWAT PR ON P.PERAWAT_ID = PR.PERAWAT_ID 
WHERE
	P.MEDIS_ID = '".$medis_id."'          
ORDER BY
	P.SEQ_NO ";
	$stmt = sqlsrv_query($conn,$sql,$params,$options);	
		while($row=sqlsrv_fetch_array($stmt)){
	echo"<tr onclick='hapus_tindakan(\"".$row['MEDIS_ID']."\",\"".$row['SEQ_NO']."\")'>
	<td>".$row['TINDAKAN']."</td>
	<td>".$row['TINDAKAN_NAME']."</td>
    <td>".$row['PETUGAS_NAME']."</td>
	<td>".$row['NOTE']."</td>
  
		</tr>";
	}
}if($op == 'hapustindakan'){
	
	$medis_id=$_POST['medis_id'];
$code_item=$_POST['code_item'];
$sql="DELETE FROM RS_MEDIS_TINDAKAN WHERE MEDIS_ID='".$medis_id."' AND SEQ_NO='".$code_item."'";
	sqlsrv_query($conn,$sql,$params,$options);
}
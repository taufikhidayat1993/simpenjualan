<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$op=$_GET['op'];

if($op=='simpandiagnosa'){
	
$table2		="rs.RS_MEDICAL_RECORD";
$IDdiagnosa=$_POST['medis_id'];
$diagnosa=$_POST['diagnosa'];
$pasien=$_POST['pasien_id'];
$IDdokter			=$_POST['dokter'];
$IDuser				=$_SESSION['username'];
$tipe               =$_POST['tipe'];

$obyektif=$_POST['obyektif'];
	$planing=$_POST['planning'];
	$bb=$_POST['bb'];
	$resp=$_POST['resp'];
	$nadi=$_POST['nadi'];
	$tensi=$_POST['tensi'];
	$resep=$_POST['resep'];
	$tb=$_POST['tb'];
	$suhu =$_POST['suhu'];
	$subyektif=$_POST['subyektif'];
	$note = "- Subyektif: $subyektif \n
                     Obyektif : $obyektif \n
                        * Vital Signs :  \n
                             TD    : $tensi mmHg  \n
                             N     : $nadi x/menit \n
                             RR    : $resp x/menit  \n
                             S     : $suhu &deg C  \n
                             Nyeri : $nyeri \n
                             BB    : $bb KG \n
                             TB    : $tb CM \n
                    - Assesment    :  \n
                    - Planing/ Terapi : $planing";
	$sql="IF EXISTS (
	SELECT
		SEQ_NO
	FROM
		RS_DIAGNOSA
	WHERE
		DIAGNOSA_ID = '$IDdiagnosa'
) SELECT
	MAX (SEQ_NO) AS SEQ_NO
FROM
	RS_DIAGNOSA
WHERE
	DIAGNOSA_ID = '$IDdiagnosa'
ELSE
	SELECT
		SEQ_NO
	FROM
		RS_DIAGNOSA
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
$inputdiagnosa = "INSERT INTO RS_DIAGNOSA
(DIAGNOSA_ID,SEQ_NO,DIAGNOSA,DIAGNOSA_TYPE,DR_ID,DT_DIAGNOSA,PENYAKIT_ID,NOTE,MODIBY,MODIDATE,PS,APPROVED)
VALUES
('$IDdiagnosa','$seq_no','$diagnosa','2','$IDdokter','$tgl_sekarang2','','$note','$IDuser',GETDATE(),'$tipe',0)";
sqlsrv_query($conn,$inputdiagnosa);


$sql2="IF EXISTS(SELECT SEQ_NO FROM RS_MEDICAL_RECORD 
WHERE PASIEN_ID='$pasien') SELECT MAX(SEQ_NO) AS SEQ_NO FROM RS_MEDICAL_RECORD 
           WHERE PASIEN_ID='$pasien' ELSE SELECT SEQ_NO FROM RS_MEDICAL_RECORD WHERE PASIEN_ID='$pasien'";
		   $stmt2 = sqlsrv_query( $conn, $sql2 , $params, $options );
		   $data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC);
		   if(empty($data2["SEQ_NO"])){
$seq_no1=1;
}else{
$seq_no1=($data2["SEQ_NO"]+1);
}
$inputmedical="INSERT INTO RS_MEDICAL_RECORD (PASIEN_ID,SEQ_NO,DATA_MEDIS,NOTE,DT_RECORD,DR_ID,MODIBY,MODIDATE,DIAGNOSA_ID,SEQ_NO1) 
           VALUES ('$pasien','$seq_no1','$diagnosa','$note','$tgl_sekarang2','$IDdokter','$_SESSION[nama]',GETDATE(),'$IDdiagnosa','$seq_no')";
		   sqlsrv_query($conn,$inputmedical);
}
else if($op=='simpan_diagnosa'){
	$table1		="rs.RS_DIAGNOSA";
$table2		="rs.RS_MEDICAL_RECORD";
$IDdiagnosa=$_POST['medis_id'];
$IDpenyakit=$_POST['kode_diagnosa'];
$pasien=$_POST['pasien_id'];
$IDdokter			=$_POST['dokter_id'];
$IDuser				=$_SESSION['username'];
$tipe               =$_POST['tipe'];


$obyektif=$_POST['obyektif'];
	$planing=$_POST['planning'];
	$bb=$_POST['bb'];
	$resp=$_POST['resp'];
	$nadi=$_POST['nadi'];
	$tensi=$_POST['tensi'];
	$resep=$_POST['resep'];
	$tb=$_POST['tb'];
	$suhu =$_POST['suhu'];
	$subyektif=$_POST['subyektif'];
	  $note = "- Subyektif: $subyektif \n
                     Obyektif : $obyektif \n
                        * Vital Signs :  \n
                             TD    : $tensi mmHg  \n
                             N     : $nadi x/menit \n
                             RR    : $resp x/menit  \n
                             S     : $suhu &deg C  \n
                             Nyeri : $nyeri \n
                             BB    : $bb KG \n
                             TB    : $tb CM \n
                    - Assesment    :  \n
                    - Planing/ Terapi : $planing";
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
$sql2="IF EXISTS(SELECT SEQ_NO FROM RS_MEDICAL_RECORD 
WHERE PASIEN_ID='$pasien') SELECT MAX(SEQ_NO) AS SEQ_NO FROM RS_MEDICAL_RECORD 
           WHERE PASIEN_ID='$pasien' ELSE SELECT SEQ_NO FROM RS_MEDICAL_RECORD WHERE PASIEN_ID='$pasien'";
		   $stmt2 = sqlsrv_query( $conn, $sql2 , $params, $options );
		   $data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC);
		   if(empty($data2["SEQ_NO"])){
$seq_no1=1;
}else{
$seq_no1=($data2["SEQ_NO"]+1);
}
// --------input data diagnosa ke RS_DIAGNOSA
$sql="select NAME from RS_PENYAKIT WHERE PENYAKIT_ID='$IDpenyakit'";
$stmt2= sqlsrv_query( $conn, $sql , $params, $options );
$data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC);
$inputdiagnosa = "INSERT INTO RS_DIAGNOSA
(DIAGNOSA_ID,SEQ_NO,DIAGNOSA,NOTE,DIAGNOSA_TYPE,DR_ID,DT_DIAGNOSA,PENYAKIT_ID,MODIBY,MODIDATE,PS,APPROVED)
VALUES
('$IDdiagnosa','$seq_no','$data2[NAME]','$note','2','$IDdokter','$tgl_sekarang2','$IDpenyakit','$IDuser',GETDATE(),'$tipe',0)";

$inputmedical="INSERT INTO RS_MEDICAL_RECORD (PASIEN_ID,SEQ_NO,DATA_MEDIS,NOTE,DT_RECORD,DR_ID,MODIBY,MODIDATE,DIAGNOSA_ID,SEQ_NO1) 
           VALUES ('$pasien','$seq_no1','$data2[NAME]','$note','$tgl_sekarang2','$IDdokter','$_SESSION[nama]',GETDATE(),'$IDdiagnosa','$seq_no')";
$hit_diagnosa="select DIAGNOSA from  RS_DIAGNOSA where DIAGNOSA_ID='$IDdiagnosa' and PENYAKIT_ID='$IDpenyakit'";
$tampil=sqlsrv_num_rows(sqlsrv_query($conn,$hit_diagnosa,array(),$options));

if($tampil > 0){
	echo $tampil;
}else{
	sqlsrv_query($conn,$inputdiagnosa);
	sqlsrv_query($conn,$inputmedical);
		echo $inputmedical;
}
// ---- cari ID pasien di tabel RS_MEDICAL_RECORD


}
// simpan prosedur
else if($_GET['op']=='simpan_procedure'){
	$option=array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$kode_procedure=$_POST['kode_diagnosa'];
	$medis_id=$_POST['medis_id'];
	$sql="select NAME from RS_PROSEDUR WHERE ICD9='$kode_procedure'";
$data2=sqlsrv_fetch_array(sqlsrv_query($conn,$sql,array()),SQLSRV_FETCH_ASSOC);
$hit_procedure="select nama from  RS_PROCEDURE_PASIEN where TRX_ID='$medis_id' and ICD9='$kode_procedure'";
$tampil=sqlsrv_num_rows(sqlsrv_query($conn,$hit_procedure,array(),$option));
$inputprocedure = "INSERT INTO RS_PROCEDURE_PASIEN (TRX_ID,ICD9,MODIBY,MODIDATE,nama)
           VALUES ('$medis_id','$kode_procedure','$_SESSION[username]','$tgl_sekarang2','$data2[NAME]')";
if($tampil > 0){
echo $tampil;
}else{
sqlsrv_query($conn,$inputprocedure,array());
echo $tampil;
}

}else if($_GET['op']=='simpanpros'){
	$prosedur=$_POST['prosedur'];
	$medis_id=$_POST['medis_id'];
	$inputprocedure = "INSERT INTO RS_PROCEDURE_PASIEN (TRX_ID,ICD9,MODIBY,MODIDATE,nama)
           VALUES ('$medis_id','','$_SESSION[username]','$tgl_sekarang2','$prosedur')";
	sqlsrv_query($conn,$inputprocedure,array());
	
}else if($_GET['op']=='hapusprocedure'){
	$id=$_POST['kode_diagnosa'];
		$sql="delete from rs_procedure_pasien where id =  '$id'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
}if($op=='simpan_tindakan'){
	$rawat=$_POST['kategori'];
	
	$dokter= $_POST['dokter'];
	if($_POST['mode']=='dokter'){
				$mode='0';
			}else{
				$mode='1';
			}

$medis_id=$_POST['medis_id'];
$tindakan_id=$_POST['kode_diagnosa'];
$IDuser				=$_SESSION['username'];
if($rawat=="RJ"){
$sql="IF EXISTS (
	SELECT
		SEQ_NO
	FROM
		RS_MEDIS_TINDAKAN
	WHERE
		MEDIS_ID = '$medis_id'
) SELECT
	MAX (SEQ_NO) AS SEQ_NO
FROM
	RS_MEDIS_TINDAKAN
WHERE
	MEDIS_ID = '$medis_id'
ELSE
	SELECT
		SEQ_NO
	FROM
		RS_MEDIS_TINDAKAN
	WHERE
		MEDIS_ID = '$medis_id'";
}else{
	
$sql="IF EXISTS (
	SELECT
		SEQ_NO
	FROM
		RS_OPNAME_TINDAKAN 
	WHERE
		OPNAME_ID = '$medis_id'
)   SELECT
	MAX(SEQ_NO) AS SEQ_NO
FROM
	RS_OPNAME_TINDAKAN  
WHERE
	OPNAME_ID = '$medis_id'  
ELSE
	  SELECT
		SEQ_NO
	FROM
		RS_OPNAME_TINDAKAN  
	WHERE
		OPNAME_ID = '$medis_id'";
	
	
	
}
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
$sql2="select NAME,HARGA from RS_TINDAKAN WHERE TINDAKAN_ID='$tindakan_id'";
$stmt2= sqlsrv_query( $conn, $sql2 , $params, $options );
$data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC);
if($rawat=="RJ"){
$inputdiagnosa = "INSERT INTO RS_MEDIS_TINDAKAN (MEDIS_ID,SEQ_NO,TINDAKAN_ID,DR_ID,DATE_TIME,NOTE,
PERAWAT_ID,TINDAKAN_MODE,
HARGA,BILL_TYPE,
MODIBY,MODIDATE) 
VALUES ('$medis_id','$seq_no','$tindakan_id',
'$dokter','$tgl_sekarang2','$data2[NAME]','NULL','$mode','$data2[HARGA]','','$_SESSION[username]','$tgl_sekarang2')";

$hit_tindakan="select MEDIS_ID from   RS_MEDIS_TINDAKAN where MEDIS_ID='$medis_id' and TINDAKAN_ID='$tindakan_id'";
}else{
	$inputdiagnosa = "INSERT INTO RS_OPNAME_TINDAKAN (
	OPNAME_ID,
	SEQ_NO,
	TINDAKAN_ID,
	DR_ID,
	DATE_TIME,
	NOTE,
  PERAWAT_ID,
	TINDAKAN_MODE,
  HARGA,
	BILL_TYPE,
  MODIBY,
	MODIDATE
) 
VALUES
	(
	    '$medis_id',
		'$seq_no',
		'$tindakan_id',
		'$dokter',
		'$tgl_sekarang2',
		'$data2[NAME]',
		'NULL',
		'$mode',
		'$data2[HARGA]',
		'',
		'$_SESSION[username]',
		GETDATE()
	)";
	$hit_tindakan="select OPNAME_ID from   RS_OPNAME_TINDAKAN where OPNAME_ID='$medis_id' and TINDAKAN_ID='$tindakan_id'";
}
$tampil=sqlsrv_num_rows(sqlsrv_query($conn,$hit_tindakan,array(),$options));
if($tampil > 0 ){
	echo $tampil."".$inputdiagnosa;
}else{
	sqlsrv_query($conn,$inputdiagnosa);
		echo $tampil."".$inputdiagnosa;
}
// ---- cari ID pasien di tabel RS_MEDICAL_RECORD



}else if($_GET['op']=='salin_diagnosa'){
	$no=1;
	   $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$param=array();
	$med=$_POST['medis_id'];
	$medis_id=$_POST['medis_id2'];
	$dokter=$_POST['dokter_id'];
	$pasien=$_POST['pasien_id'];
	$sql="DELETE FROM RS_DIAGNOSA WHERE DIAGNOSA_ID='$med'";
	sqlsrv_query($conn,$sql,$param);
	sqlsrv_query($conn,"DELETE FROM RS_MEDICAL_RECORD WHERE DIAGNOSA_ID='$med'");
	$sql2="select DIAGNOSA_ID,SEQ_NO,DIAGNOSA,PS,DIAGNOSA_TYPE,DR_ID,DT_DIAGNOSA,PENYAKIT_ID from RS_DIAGNOSA WHERE DIAGNOSA_ID='$medis_id'";
$stmt2= sqlsrv_query( $conn,$sql2,array());
while($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
	if($no==1){
		$ps=1;
	}else{
		$ps=0;
	}
$inputdiagnosa = "INSERT INTO RS_DIAGNOSA
(DIAGNOSA_ID,SEQ_NO,DIAGNOSA,DIAGNOSA_TYPE,DR_ID,DT_DIAGNOSA,PENYAKIT_ID,NOTE,MODIBY,MODIDATE,PS,APPROVED)
VALUES
('$med','$data2[SEQ_NO]','$data2[DIAGNOSA]','2','$dokter','$tgl_sekarang2','$data2[PENYAKIT_ID]','','$_SESSION[username]',GETDATE(),'$ps',0)";
sqlsrv_query( $conn,$inputdiagnosa,array());
$sql2="IF EXISTS(SELECT SEQ_NO FROM RS_MEDICAL_RECORD 
WHERE PASIEN_ID='$pasien') SELECT MAX(SEQ_NO) AS SEQ_NO FROM RS_MEDICAL_RECORD 
           WHERE PASIEN_ID='$pasien' ELSE SELECT SEQ_NO FROM RS_MEDICAL_RECORD WHERE PASIEN_ID='$pasien'";
		   $stmt3 = sqlsrv_query($conn,$sql2,$param,$options);
		   $data5=sqlsrv_fetch_array($stmt3,SQLSRV_FETCH_ASSOC);
		   if(empty($data2["SEQ_NO"])){
$seq_no1=1;
}else{
$seq_no1=($data5["SEQ_NO"]+1);
}
$inputmedical="INSERT INTO RS_MEDICAL_RECORD (PASIEN_ID,SEQ_NO,DATA_MEDIS,NOTE,DT_RECORD,DR_ID,MODIBY,MODIDATE,DIAGNOSA_ID,SEQ_NO1) 
           VALUES ('$pasien','$seq_no1','$data2[DIAGNOSA]','','$tgl_sekarang2','$dokter','$_SESSION[username]','$tgl_sekarang2','$med','$data2[SEQ_NO]')";
		   sqlsrv_query($conn,$inputmedical);
echo $inputdiagnosa;
$no++;
}
	 
}else if($_GET['op']=='salin_procedure'){
	$param=array();
	$med=$_POST['medis_id'];
	$medis_id=$_POST['medis_id2'];
	$dokter=$_POST['dokter_id'];
	$sql="DELETE FROM RS_PROCEDURE_PASIEN WHERE TRX_ID='$med'";
	 sqlsrv_query($conn,$sql,$param);
	 		 $sql2="select TRX_ID,nama,ICD9 from RS_PROCEDURE_PASIEN WHERE TRX_ID='$medis_id'";
$stmt2= sqlsrv_query( $conn,$sql2,array());
while($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
$inputdiagnosa = "INSERT INTO RS_PROCEDURE_PASIEN (TRX_ID,ICD9,MODIBY,MODIDATE,nama)
           VALUES ('$med','$data2[ICD9]','$_SESSION[username]','$tgl_sekarang2','$data2[nama]')";
sqlsrv_query( $conn,$inputdiagnosa,array());

}
	 
}else if($_GET['op']=='selesai'){
	$id=$_POST['medis_id'];
	$dokter=$_POST['dokter_id'];
	$poli=$_POST['poli'];
	$pasien_id=$_POST['pasien_id'];
	$nyeri=$_POST['nyeri'];
    $obyektif=$_POST['obyektif'];
	$planing=$_POST['planning'];
	$bb=$_POST['bb'];
	$resp=$_POST['resp'];
	$nadi=$_POST['nadi'];
	$tensi=$_POST['tensi'];
	$resep=$_POST['resep'];
	$tb=$_POST['tb'];
	$suhu =$_POST['suhu'];
	$subyektif=$_POST['subyektif'];
	$sql ="select * from rs_periksa where trx_id = '$id'";
    $params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $row_count = sqlsrv_num_rows($stmt);
      $note = "- Subyektif: $subyektif \n
                     Obyektif : $obyektif \n
                        * Vital Signs :  \n
                             TD    : $tensi mmHg  \n
                             N     : $nadi x/menit \n
                             RR    : $resp x/menit  \n
                             S     : $suhu &deg C  \n
                             Nyeri : $nyeri \n
                             BB    : $bb KG \n
                             TB    : $tb CM \n
                    - Assesment    :  \n
                    - Planing/ Terapi : $planing";
if($row_count > 0){
	$sql2="update rs_periksa set DT_PERIKSA='$tgl_sekarang2',
	DR_ID='$_SESSION[dokter]',SEQ=1,
	SUBYEKTIF='$_POST[subyektif]',
	OBYEKTIF='$obyektif',
    ASSESMENT = '', 
	PEMERIKSAAN='$note',
	PLANING='$planing', 
	tensi = '$_POST[tensi]',
	suhu = '$_POST[suhu]',
	nadi= '$_POST[nadi]',
	resp = '$_POST[resp]',
	bb = '$_POST[bb]',
    tb = '$_POST[tb]',
	nyeri = '$_POST[nyeri]'
    where trx_id = '$id'";
	sqlsrv_query($conn,$sql2 ,$params,$options);
	echo $sql2."".$row_count;
}else{
		$sql2="insert into rs_periksa(TRX_ID,DT_PERIKSA,PEMERIKSAAN,DR_ID,SEQ,SUBYEKTIF,OBYEKTIF,ASSESMENT,PLANING,tensi, suhu, nadi, resp, bb, tb, nyeri) 
	values ('$id','$time','$note','$_SESSION[dokter]',1,'$_POST[subyektif]','','$obyektif','$planing','$_POST[tensi]','$_POST[suhu]','$_POST[nadi]',
	'$_POST[resp]','$bb','$_POST[tb]','$_POST[nyeri]')";
		sqlsrv_query( $conn, $sql2 , $params, $options );
}
	
	if($poli==''){
		$nm_poli="KLINIK UMUM";
	}else{
		$nm_poli=$poli;
	}
     $updatesql="select RESEP FROM RS_ANTRI_RESEP WHERE RESEP_ID='".$id."'";
	 $tampil_hit=sqlsrv_query($conn,$updatesql,$params,$options);
	 $row_count2 = sqlsrv_num_rows($tampil_hit);
	
if($row_count2 > 0){	
	 $update = "UPDATE RS_ANTRI_RESEP SET RESEP_FIX ='$resep' ,RESEP = '$resep',DOKTER_ID='$dokter',MODIBY='$_SESSION[nama]',MODIDATE='$tgl_sekarang2' WHERE RESEP_ID = '$id'";
	 sqlsrv_query($conn,$update,$params);
echo $update;
}else{
	$ket="RAJAL|".$nm_poli;
	 $insert = "INSERT INTO RS_ANTRI_RESEP(RESEP_ID,RESEP,DOKTER_ID,MODIBY,MODIDATE,KET,PASIEN_ID,APPROVED,RESEP_FIX) VALUES('$id','$resep','$dokter','$_SESSION[nama]','$tgl_sekarang2','$ket','$pasien_id',2,'$resep')";
	sqlsrv_query($conn,$insert,$params); 

}

}
else if($_GET['op']=='selesai2'){
	$id=$_POST['medis_id'];
	$dokter=$_POST['dokter_id'];
	$poli=$_POST['poli'];
	$pasien_id=$_POST['pasien_id'];
	$nyeri=$_POST['nyeri'];
    $obyektif=$_POST['obyektif'];
	$planing=$_POST['planning'];
	$bb=$_POST['bb'];
	$resp=$_POST['resp'];
	$nadi=$_POST['nadi'];
	$tensi=$_POST['tensi'];
	$resep=$_POST['resep'];
	$tb=$_POST['tb'];
	$suhu =$_POST['suhu'];
	$subyektif=$_POST['subyektif'];
	$sql ="select * from rs_periksa where trx_id = '$id'";
    $params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $row_count = sqlsrv_num_rows($stmt);
      $note = "- Subyektif: $subyektif \n
                     Obyektif : $obyektif \n
                        * Vital Signs :  \n
                             TD    : $tensi mmHg  \n
                             N     : $nadi x/menit \n
                             RR    : $resp x/menit  \n
                             S     : $suhu &deg C  \n
                             Nyeri : $nyeri \n
                             BB    : $bb KG \n
                             TB    : $tb CM \n
                    - Assesment    :  \n
                    - Planing/ Terapi : $planing";
if($row_count > 0){
	$sql2="update rs_periksa set DT_PERIKSA='$tgl_sekarang2',
	DR_ID='$_SESSION[dokter]',SEQ=1,
	SUBYEKTIF='$_POST[subyektif]',
	OBYEKTIF='$obyektif',
    ASSESMENT = '', 
	PEMERIKSAAN='$note',
	PLANING='$planing', 
	tensi = '$_POST[tensi]',
	suhu = '$_POST[suhu]',
	nadi= '$_POST[nadi]',
	resp = '$_POST[resp]',
	bb = '$_POST[bb]',
    tb = '$_POST[tb]',
	nyeri = '$_POST[nyeri]'
    where trx_id = '$id'";
	sqlsrv_query($conn,$sql2 ,$params,$options);
	echo $sql2."".$row_count;
}else{
	$sql2="insert into rs_periksa(TRX_ID,DT_PERIKSA,PEMERIKSAAN,DR_ID,SEQ,SUBYEKTIF,OBYEKTIF,ASSESMENT,PLANING,tensi, suhu, nadi, resp, bb, tb, nyeri) 
	values ('$id','$time','$note','$_SESSION[dokter]',1,'$_POST[subyektif]','','$obyektif','$planing','$_POST[tensi]','$_POST[suhu]','$_POST[nadi]',
    '$_POST[resp]','$bb','$_POST[tb]','$_POST[nyeri]')";
	sqlsrv_query($conn,$sql2,$params,$options);
}
}
else if($_GET['op']=='salin_resep'){
	$param=array();
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$medis_id=$_POST['medis_id2'];/*Medis Id Yang Di Copi*/
	$med=$_POST['medis_id'];/*Medis Filter */
	$dokter=$_POST['dokter_id'];
	$poli=$_POST['poli'];
	$pasien_id=$_POST['pasien_id'];
	$resep=$_POST['resep'];
	if($poli==''){
		$nm_poli="KLINIK UMUM";
	}else{
		$nm_poli=$poli;
	}

	 /* Queri Tampil Data resep untuk di salin */
	 $tampil=sqlsrv_query($conn,"select RESEP FROM RS_ANTRI_RESEP WHERE RESEP_ID='$medis_id'",$param);
	 $data2=sqlsrv_fetch_array($tampil,SQLSRV_FETCH_ASSOC);
	 /*----------------------*/
	  $tampil_hit=sqlsrv_query($conn,"select RESEP FROM RS_ANTRI_RESEP WHERE RESEP_ID='$med'",$param,$options);
	 $row_count = sqlsrv_num_rows($tampil_hit);
	
if($row_count > 0){	
	 $opsi= "UPDATE RS_ANTRI_RESEP SET RESEP_FIX ='$resep' ,RESEP = '$resep',DOKTER_ID='$dokter',MODIBY='$_SESSION[nama]',MODIDATE='$tgl_sekarang2' WHERE RESEP_ID = '$med'";
	
	 
}else{
	$ket="RAJAL|".$nm_poli;
	 $opsi = "INSERT INTO RS_ANTRI_RESEP(RESEP_ID,RESEP,DOKTER_ID,MODIBY,MODIDATE,KET,PASIEN_ID,APPROVED,RESEP_FIX) VALUES('$med','$resep','$dokter','$_SESSION[nama]','$tgl_sekarang2','$ket','$pasien_id',2,'$resep')";
	 }
sqlsrv_query($conn,$opsi,$param); 
}else if($_GET['op']=='opsi'){
	$opsi=$_POST['opsi'];
	$medis_id=$_POST['medis_id'];
	 $insert = "update RS_PASIEN_MEDIS set STATUS_ANTRI=$opsi WHERE MEDIS_ID='$medis_id'";
	sqlsrv_query($conn,$insert,$param); 
}else if($_GET['op']=='simpan_alergi'){
	$alergi=$_POST['alergi'];
	$pasien=$_POST['pasien_id'];
	 $insert = "update RS_PASIEN set ALERGI='$alergi' WHERE PASIEN_ID='$pasien'";
	sqlsrv_query($conn,$insert); 

}else if($_GET['op']=='ubahdiagnosa'){
		$id=$_POST['kode_diagnosa'];
	$seq=$_POST['seq'];
	$sql="update rs_diagnosa set PS=1  where diagnosa_id = '$id' and seq_no = '$seq'";
	$sql2="update rs_diagnosa set PS=0  where diagnosa_id = '$id' and seq_no != '$seq'";
    $stmt = sqlsrv_query($conn,$sql);
	sqlsrv_query($conn,$sql2);
	
}
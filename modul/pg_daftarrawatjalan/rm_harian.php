<style>
body {
	font-family: "Arial", Helvetica, sans-serif;
}
table.header tr td {
	vertical-align:top;
}
</style>
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
$id=$_GET['medis_id'];
if($_GET['rawat']=='RJ'){
	$tabel="RS_PASIEN_MEDIS";
	$id2="MEDIS_ID";
	$dr="DR_ID";
}ELSE{
	$tabel="RS_PASIEN_OPNAME";
	$id2="OPNAME_ID";
	$dr="DPJP";
}
$sql="SELECT B. NAME AS DOKTER_NAME,
A.DR_ID AS DOKTER,A.STATUS_ANTRI,D.PASIEN_ID,A.ANTRIAN,
D.NAME AS NAMA_PASIEN,D.NO_RM,
D.ADDRESS,
D.ALERGI,
CONVERT(VARCHAR(11),A.DATETIME_MEDIS,106) AS DATETIME,
 CONVERT(VARCHAR(11),D.TGL_LAHIR,103) AS TGL_LAHIR,
  CONVERT(VARCHAR(11),D.TGL_LAHIR,120) AS TGL_LAHIR2,
  E.NAME AS ASURANSI,D.ASURANSI_POLIS
 FROM $tabel A JOIN RS_DOKTER B ON A.DR_ID=B.DR_ID JOIN RS_POLIKLINIK C ON A.POLI_ID=C.POLI_ID JOIN RS_PASIEN D ON A.PASIEN_ID=D.PASIEN_ID LEFT JOIN RS_ASURANSI E ON D.ASURANSI_ID=E.ASURANSI_ID WHERE A.$id2='$id'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

$sql1="SELECT  * FROM RS_PERIKSA WHERE TRX_ID  = '$id' ";
$stmt1 = sqlsrv_query( $conn, $sql1 , $params);
$data1=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
?>
<table  style="border-bottom:#000 solid 1px; ">
<tr>
<td width="90px;"><img src="../../assets/pages/img/logo-med.png" width="70px"></td>
<td width="500px;">
<span style="font-size:19px;font-weight:700;">RUMAH SAKIT ISLAM YOGYAKARTA PDHI</span><br>
Jl. Solo Km 12.5 Kalasan, Sleman Yogyakarta<br>
Telp. (0274) 498000 (Hunting), Telp.498464<br>
</td>
<th width="150px;">REKAM MEDIS HARIAN</th>
</table>
<table class="header" style="margin-top:10px;">
<tr>
<td>RM & Nama </td><td>:</td><td><?php echo $data['NO_RM']."/".$data['NAMA_PASIEN'];?> </td>
</tr>
<tr>
<td>Tanggal Lahir/Umur </td><td>:</td><td>Tanggal Lahir : <?php echo $data['TGL_LAHIR']; ?> <br>
Umur :<?php echo umur_tahun($data['TGL_LAHIR']); ?> Tahun
</td>
</tr>
<tr>
<td>Alamat </td><td>:</td><td><?php echo $data['ADDRESS']; ?></td>
</tr>
<tr>
<td>Asuransi</td><td>:</td><td>Asuransi : <?php echo $data['ASURANSI']; ?>
<BR>No Asuransi : <?php echo $data['ASURANSI_POLIS']; ?> </td>
</tr>
<tr>
<td>Alergi</td><td>:</td><td>Alergi : <?php echo $data['ALERGI']; ?></td>
</tr>
</table>
<div style="border-bottom:#000 solid 1px; width:760px;margin-top:18px;">
<span style="font-size:19px;font-weight:600;" > 
TANGGAL PEMERIKSAAN    :       <?php echo $data['DATETIME'];?>
</span>
</div>
<table width="100%" style="border:#000 solid 1px;margin-top:8px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;"><strong>PEMERIKSAAN</strong></td></tr>
<tr>
<td>Dokter  : <?php echo $data['DOKTER_NAME']; ?><br><br>
-Subyektif :<?php echo $data1['SUBYEKTIF']; ?><br>
-Obyektif  : <?php echo $data1['OBYEKTIF']; ?><br>
&nbsp;&nbsp; *Vital Signs<br>
<table style="margin-left:20px;" >
<?php 
echo"<tr>
<td>TD</td><td>:</td><td>".$data1['TENSI']." mmHg</td></tr>
<tr>
<td>N</td><td>:</td><td>".$data1['NADI']." x/menit</td></tr>
<tr>
<td>RR</td><td>:</td><td>".$data1['RESP']." x/menit</td></tr>
<tr>
<td>S</td><td>:</td><td>".$data1['SUHU']." &deg C</td></tr>
<tr>
<td>Nyeri</td><td>:</td><td></td></tr>
<tr>
<td>BB</td><td>:</td><td>".$data1['BB']." KG</td></tr>
<tr>
<td>TB</td><td>:</td><td>".$data1['TB']." CM</td></tr>
";
?>
</table>
-Assetment :<br>
-Planning/Terapi  :<?php echo $data1['PLANING']; ?><br>
</td></tr>


</table>
<table width="100%" style="border:#000 solid 1px;margin-top:8px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;"><strong>DIAGNOSA(ICD10)</strong></td></tr>
<tr><td>
<ol>
<?php
		$diag="select ps,diagnosa, penyakit_id, seq_no from rs_diagnosa where diagnosa_id = '$id' order by PS desc, seq_no";
$diagn = sqlsrv_query($conn,$diag,array());
 while($data_diag=sqlsrv_fetch_array($diagn,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data_diag['diagnosa']."</li> ";
  }
?>
</ol>
</td></tr>
</table>
<table width="100%" style="border:#000 solid 1px;margin-top:8px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;"><strong>PROCEDURE</strong></td></tr>
<tr><td>
<ol>
<?php
$pros="SELECT a.NAMa, A.ICD9,A.ID FROM rs.RS_PROCEDURE_PASIEN AS A where A.TRX_ID = '$id' order by A.ID";
$prose = sqlsrv_query($conn,$pros,array());

 while($data_pros=sqlsrv_fetch_array($prose,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data_pros['NAMa']."</li> ";
  }
  ?>
</ol>
</td></tr>
</table>
<table width="100%" style="border:#000 solid 1px;margin-top:8px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;"><strong>TINDAKAN</strong></td></tr>
<tr><td><?php 	
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
 CONVERT(VARCHAR(8),P.DATE_TIME,108) AS TIME_TINDAKAN,
 CONVERT(VARCHAR(11),P.DATE_TIME,106) AS DATE_TINDAKAN,
 P.DATE_TIME
FROM
	rs.RS_MEDIS_TINDAKAN P
LEFT JOIN rs.RS_TINDAKAN Q ON P.TINDAKAN_ID = Q.TINDAKAN_ID
LEFT JOIN rs.RS_OPERASI R ON P.OPERASI_ID = R.OPERASI_ID
LEFT JOIN rs.RS_PERSALINAN S ON P.PERSALINAN_ID = S.PERSALINAN_ID
LEFT JOIN rs.RS_DOKTER DR ON P.DR_ID = DR.DR_ID
LEFT JOIN rs.RS_PERAWAT PR ON P.PERAWAT_ID = PR.PERAWAT_ID
WHERE
	P.MEDIS_ID = '$id'
ORDER BY
	P.SEQ_NO
      ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$no=1;
 echo"<ol>";
  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 
	  echo "<li>".$data['TINDAKAN_NAME']."<br> Petugas:".$data['PETUGAS_NAME']."<br> Ket :$data[NOTE] <br> Waktu : $data[DATE_TINDAKAN]  $data[TIME_TINDAKAN]</li>";
  
  }
  echo"</ol>";
								?>	</td></tr>
</table>
<table width="100%" style="border:#000 solid 1px;margin-top:8px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;"><strong>RESEP</strong></td></tr>
<tr><td>
<?php
error_reporting(0);
 $sql = "SELECT RESEP FROM RS_ANTRI_RESEP WHERE RESEP_ID = '$_GET[medis_id]' ";
	 $sql2="SELECT    S.ITEM_NAME, R.JUMLAH FROM    rs.RS_RESEP AS Q LEFT JOIN rs.RS_RESEP_DETAIL AS R ON Q.RESEP_ID = R.RESEP_ID LEFT JOIN rs.RS_MASTER_ITEM AS S ON R.ITEM_CODE = S.ITEM_CODE WHERE Q.MEDIS_ID ='$id'";
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();
$stmt = sqlsrv_query($conn,$sql,$params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$stmt2 = sqlsrv_query($conn,$sql2,$params,$options);
$count=sqlsrv_num_rows($stmt2);
if($data['RESEP']!=''){
		echo nl2br($data['RESEP']);
}else {	
if($count>0){	
		while($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
		echo $data2['ITEM_NAME']."<br>     Jumlah : ".$data2['JUMLAH']."<br>";
		}
}else{
	echo"Tidak Ada Resep";
}
}
?></td></tr>
</table>
<table width="100%" style="border:#000 solid 1px;margin-top:8px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;"><strong>LABORATORIUM</strong></td></tr>
<tr><td>
<?php
	

			$id=$_GET['medis_id'];

	$rawat=$_GET['rawat'];
	if($rawat=="RJ"){
		$get="MEDIS_ID";
		$tabel="RS_MEDIS_DETAIL";
		
	}else{
		$get="OPNAME_ID";
		$tabel="RS_OPNAME_DETAIL";
	}
	 $sql = "SELECT resep FROM RS_ANTRI_RESEP WHERE resep_id = '$id' ";
	 $sql2="SELECT
	P.LAB_CODE,
	P.NAME,
	Q.NOTE,
	Q.SEQ_NO,
 CONVERT(VARCHAR(11),Q.MODIDATE,103) AS WAKTU,
	DR.NAME AS DOKTER_NAME,
	PR.NAME AS PERAWAT_NAME
FROM
	RS_LAB_ITEM P,
	$tabel Q
LEFT JOIN RS_DOKTER DR ON Q.DR_ID = DR.DR_ID
LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID = PR.PERAWAT_ID
WHERE
	P.LAB_CODE = Q.DETAIL_CODE
AND Q.$get = '$id'
AND Q.DETAIL_TYPE = 1
ORDER BY
	Q.MODIDATE DESC";
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();
$stmt = sqlsrv_query($conn,$sql,$params);
$stmt2 = sqlsrv_query($conn,$sql2,$params,$options);
$data=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC);
$count=sqlsrv_num_rows($stmt2);

if($data['LAB_CODE']!=''){
		echo $data['NAME']."(".$data['LAB_CODE'].")<br> Hasil: <br>".$data['NOTE']."<br> <br> Dokter :".$data['DOKTER_NAME']."<br> Laboran :".$data['PERAWAT_NAME']."<br> Waktu :".$data['WAKTU'];
}else {	

	echo"Tidak Ada pemeriksaan Laboratorium";
}

?>
</td></tr>
</table>
<table width="100%" style="border:#000 solid 1px;margin-top:8px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;"><strong>RADIOLOGI</strong></td></tr>
<tr><td><?php
	$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$id=$_GET['medis_id'];
$rawat=	$_GET['rawat'];
		if($rawat=='RJ'){
		$tabel1="RS_MEDIS_DETAIL";
		$tabel2="MEDIS_ID";
		}else{
			$tabel1="RS_OPNAME_DETAIL";
		$tabel2="OPNAME_ID";
	
		}
	
   $sql = "SELECT P.RADIO_ID,P.NAME,Q.NOTE,Q.SEQ_NO,CONVERT(VARCHAR(20),Q.MODIDATE,113) AS TIME,
   DR.NAME AS DOKTER_NAME, PR.NAME AS PERAWAT_NAME FROM RS_RADIOLOGI P, $tabel1 AS Q 
   LEFT JOIN RS_DOKTER DR ON Q.DR_ID=DR.DR_ID LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID=PR.PERAWAT_ID WHERE P.RADIO_ID=Q.DETAIL_CODE 
   AND Q.$tabel2='$id' AND Q.DETAIL_TYPE='2' ORDER BY Q.MODIDATE DESC";
$stmt = sqlsrv_query($conn,$sql,$params,$options);
$count=sqlsrv_num_rows($stmt);
$no=1;
if($count>0){
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 echo $no."".$data['NAME']."<br> HASIL : <br>".nl2br($data['NOTE'])."<BR>-Dokter :".$data['DOKTER_NAME']."<br> 
	 Waktu :".$data['TIME'];
	 
	 $no++;
 }
}else{
	echo"Tidak ada pemeriksaan atau dokter tidak mengentry";
}

?></td></tr>
</table>
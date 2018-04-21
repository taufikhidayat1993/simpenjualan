<style>
body {
	font-family: "Arial", Helvetica, sans-serif;
}
</style>
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/library.php";
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
C.NAME AS NAMA_POLI,
D.ADDRESS,
D.ALERGI,
CONVERT(VARCHAR(11),A.DATETIME_MEDIS,106) AS DATETIME,
CONVERT(VARCHAR(11),A.DATETIME_MEDIS,105) AS DATETIME2,
CONVERT(VARCHAR(11),A.DATETIME_MEDIS,120) AS DATETIME3,
 CONVERT(VARCHAR(11),D.TGL_LAHIR,103) AS TGL_LAHIR,
  CONVERT(VARCHAR(11),D.TGL_LAHIR,120) AS TGL_LAHIR2,
  E.NAME AS ASURANSI,D.ASURANSI_POLIS
 FROM $tabel A JOIN RS_DOKTER B ON A.DR_ID=B.DR_ID JOIN RS_POLIKLINIK C ON A.POLI_ID=C.POLI_ID JOIN RS_PASIEN D ON A.PASIEN_ID=D.PASIEN_ID LEFT JOIN RS_ASURANSI E ON D.ASURANSI_ID=E.ASURANSI_ID WHERE A.$id2='$id'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$dr_name=$data['DOKTER_NAME'];
$sql1="SELECT  * FROM RS_PERIKSA WHERE TRX_ID  = '$id' ";
$stmt1 = sqlsrv_query( $conn, $sql1 , $params);
$data1=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
?>
<table style="border-bottom:#000 solid 1px;">
<tr>
<td width="90px;"><img src="../../assets/pages/img/logo-med.png" width="70px"></td>
<td width="500px;">
<span style="font-size:19px;font-weight:700;">RUMAH SAKIT ISLAM YOGYAKARTA PDHI</span><br>
Jl. Solo Km 12.5 Kalasan, Sleman Yogyakarta<br>
Telp. (0274) 498000 (Hunting), Telp.498464<br>
</td>
<th width="150px;"></th>
</table>
<table style="margin-top:10px;" cellspacing="8">
<tr>
<td>Hari/ Tanggal </td><td>:</td><td><?php echo hari($data['DATETIME3'])."/".$data['DATETIME2']; ?></td>
</tr>
<tr>
<td>Klinik </td><td>:</td><td><?php echo $data['NAMA_POLI']; ?></td>
</tr>
<tr>
<td>RM & Nama </td><td>:</td><td><?php echo $data['NO_RM']."/".$data['NAMA_PASIEN'];?> </td>
</tr>
<tr>
<td>Tanggal Lahir</td><td>:</td><td><?php echo $data['TGL_LAHIR']; ?></td>
</tr>

</table>
<div style="background-color:#DCDCDC; width:760px;text-align:center;margin-top:18px;">
<span style="font-size:17px;font-weight:600;" > 
RESUME PELAYANAN RAWAT JALAN        
</span>
</div>
<table width="760px;" style="margin-top:8px;" cellspacing="8">
<tr>
<td style="border-bottom:#000 solid 1px;font-align:left;"><strong>Subyektif</strong></td>
</tr>
<tr>
<td>
<?php echo $data1['SUBYEKTIF']; ?><br>
</td></tr>
<tr>
<td style="border-bottom:#000 solid 1px;font-align:left;"><strong>Obyektif</strong></td>
</tr>
<tr>
<td>
<?php echo $data1['OBYEKTIF']; ?><br>
</td></tr>
<tr>
<td style="border-bottom:#000 solid 1px;font-align:left;"><strong>Vital Sign</strong></td>
</tr>
<tr><td colspan="2">
<table cellspacing="7">
<tr>
<?php 
echo"<tr>
<td>Tensi</td><td>:</td><td style='width:200px;'>".$data1['TENSI']." mmHg</td><td>BB</td><td>:</td><td style='width:200px;'>".$data1['BB']." KG</td><td>Resp</td><td>:</td><td style='width:200px;'>".$data1['RESP']." x/menit</td></tr>
<tr>
<td>Suhu</td><td>:</td><td>".$data1['SUHU']." &deg C</td><td>TB</td><td>:</td><td>".$data1['TB']." CM</td><td>Nyeri</td><td>:</td><td>".$data1['NYERI']." (1-10)</td></tr>
<tr>
<tr>
<td>Nadi</td><td>:</td><td>".$data1['NADI']." x/menit</td><td colspan=6></td></tr>

";
?>
</tr>
</table>
</td>
</table>
<table width="760px;" style="margin-top:3px;">
<tr>
<td style="background-color:#DCDCDC;font-align:left;border-bottom:#000 solid 1px;"><strong>DIAGNOSA(ICD10)</strong></td></tr>
<tr><td>
<ul style='list-style: none;'>
<?php
		$diag="select diagnosa, penyakit_id, seq_no,
keterangan =
CASE ps
WHEN '1' THEN 'Primer'
WHEN '0' THEN 'Sekunder'
ELSE 'Sekunder'
END		from rs_diagnosa where diagnosa_id = '$id' order by PS desc, seq_no";
$diagn = sqlsrv_query($conn,$diag,array());
 while($data_diag=sqlsrv_fetch_array($diagn,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data_diag['keterangan']."&nbsp;&nbsp;:&nbsp; ".$data_diag['diagnosa']."</li> ";
  }
?>
</ul>
</td></tr>
</table>
<table  width="760px;" style="margin-top:3px;">
<tr>
<td  style="background-color:#DCDCDC;font-align:left;border-bottom:#000 solid 1px;"><strong>Penunjang/Terapi</strong></td></tr>
<tr><td>
<ul style='list-style: none;'>
<?php
$pros="SELECT a.NAMa, A.ICD9,A.ID FROM rs.RS_PROCEDURE_PASIEN AS A where A.TRX_ID = '$id' order by A.ID";
$prose = sqlsrv_query($conn,$pros,array());

 while($data_pros=sqlsrv_fetch_array($prose,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data_pros['NAMa']."</li> ";
  }
  ?>
</ul>
</td></tr>
</table>
<table width="760px;" style="margin-top:3px;">
<tr>
<td  style="background-color:#DCDCDC;font-align:left;border-bottom:#000 solid 1px;"><strong>TINDAKAN</strong></td></tr>
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
 echo"<ul style='list-style: none;'>";
  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 
	  echo "<li>".$data['TINDAKAN_NAME']."</li>";
  
  }
  echo"</ul>";
								?>	</td></tr>
</table>
<table width="760px;" style="margin-top:3px;" cellspacing="8">
<tr>
<td  style="background-color:#DCDCDC;font-align:left;border-bottom:#000 solid 1px;"><strong>RESEP</strong></td></tr>
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
<span style="float:right;text-align:center;">
DOKTER
<br>
<br>
<br>
<br>
<br>
<?php echo $dr_name; ?>
</span>

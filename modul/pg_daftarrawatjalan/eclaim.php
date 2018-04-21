<?php
include"../../inc/inc.koneksi.php";
include"../../inc/library.php";
$params = array();
$get_sep=$_GET['no_sep'];
$sql="SELECT
rs.RS_SEP.NO_SEP,
rs.RS_SEP.TRX_ID,
rs.RS_SEP.TGL_SEP,
CONVERT(VARCHAR(10),TGL_SEP,120) AS TGL_SEP,
CONVERT(VARCHAR(10),TGL_LAHIR,120) AS TGL_LAHIR,
rs.RS_SEP.NO_KARTU,
rs.RS_SEP.NAMA,
rs.RS_SEP.JK,
rs.RS_SEP.POLI,
rs.RS_SEP.ASAL_FASKES,
rs.RS_SEP.DIAGNOSA,
rs.RS_SEP.CATATAN,
rs.RS_SEP.PESERTA,
rs.RS_SEP.COB,
rs.RS_SEP.JENIS_RAWAT,
rs.RS_SEP.KELAS_RAWAT,
rs.RS_SEP.CETAKAN,
rs.RS_SEP.RAWAT,
rs.RS_SEP.NO_RM

FROM
rs.RS_SEP
WHERE
rs.RS_SEP.NO_SEP=
'".$get_sep."'";
$stmt = sqlsrv_query( $conn, $sql , $params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$tgl_sep=$data['TGL_SEP'];
$nosep=$data['NO_SEP'];
$norm=$data['NO_RM'];0
?>
<style>
body {
	font-family: "Arial", Helvetica, sans-serif;

}
table.konten{
	font-size:12px;
}
ul{
	padding-left:3px;
}
</style>
<style type="text/css" media="print">
    .page-break  { display:block; page-break-before:always; }
</style>
<div style="width:670px;" class="page-break">
<table><tr><td>
<div style="margin-left:0px;"><img src="../../assets/img/logo-bpjs.png" width="200"></div></td><td>
<div style="text-align:center;"><h4>SURAT ELEGIBILITAS PESERTA RSIY PDHI</h4></div></td></tr></table>
<?php echo"
<table class='konten' >
<tr><td>No. SEP</td><td>:</td><td>".$data['NO_SEP']."</td><td></td><td></td><td></td><td></td></tr>
<tr><td>Tgl. SEP</td><td>:</td><td>".tglku($tgl_sep)."</td><td></td><td></td><td></td><td></td></tr>
<tr><td>No. Kartu</td><td>:</td><td>".$data['NO_KARTU']."</td><td></td><td></td><td></td><td></td></tr>
<tr><td>Nama Peserta</td><td>:</td><td>".$data['NAMA']."</td><td></td><td>Peserta</td><td>:</td><td>".$data['PESERTA']."</td></tr>
<tr><td>Tgl. Lahir</td><td>:</td><td>".tglku($data['TGL_LAHIR'])."</td><td></td><td></td><td></td><td></td></tr>
<tr><td>Jns. Kelamin</td><td>:</td><td>".$data['JK']."</td><td></td><td>COB</td><td>:</td><td>".$data['COB']."</td></tr>
<tr><td>Poli Tujuan</td><td>:</td><td>".$data['POLI']."</td><td></td><td>Jns. Rawat</td><td>:</td><td>".$data['JENIS_RAWAT']."</td></tr>
<tr><td>Asal Faskes Tk.I</td><td>:</td><td>".$data['ASAL_FASKES']."</td><td></td><td>Kls. Rawat</td><td>:</td><td>".$data['KELAS_RAWAT']."</td></tr>
<tr><td>Diagnosa Awal</td><td>:</td><td>".$data['DIAGNOSA']."</td><td></td><td colspan=3 rowspan=3 valign='top'><table class='konten'><tr><td style='border-bottom:1px solid #000;'>Pasien/Keluarga Pasien<br><br><br></td><td style='width:15px;'></td>
<td style='border-bottom:1px solid #000;'>Petugas BPJS Kesehatan<br><br><br></td></tr></table></td></tr>
<tr><td>Catatan</td><td>:</td><td>".$data['CATATAN']."</td><td></td></tr>
<tr><td colspan='4'><span style='font-size:10px;width:255px;'>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.</span><div  style='font-size:10px;width:255px;'>*SEP bukan sebagai bukti penjaminan peserta Cetakan ke 126/02/2018 17:43:4</div></td></tr>
</table>"; 

$id=$data['TRX_ID'];
if($data['RAWAT']=='RJ'){
	$tabel="RS_PASIEN_MEDIS";
	$id2="MEDIS_ID";
	$dr="DR_ID";
}ELSE{
	$tabel="RS_PASIEN_OPNAME";
	$id2="OPNAME_ID";
	$dr="DPJP";
}
$sql2="SELECT B. NAME AS DOKTER_NAME,
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

$stmt2 = sqlsrv_query( $conn, $sql2 , $params);
$dataku=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC);
$dr_name=$data['DOKTER_NAME'];
$sql1="SELECT  * FROM RS_PERIKSA WHERE TRX_ID  = '$id' ";
$stmt1 = sqlsrv_query( $conn, $sql1 , $params);
$data1=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
?>

</div>

<div class="page-break">
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
<table class="konten" style="margin-top:10px;" cellspacing="8">
<tr>
<td>Hari/ Tanggal </td><td>:</td><td><?php echo hari($dataku['DATETIME3'])."/".$dataku['DATETIME2']; ?></td>
</tr>
<tr>
<td>Klinik </td><td>:</td><td><?php echo $dataku['NAMA_POLI']; ?></td>
</tr>
<tr>
<td>RM & Nama </td><td>:</td><td><?php echo $dataku['NO_RM']."/".$dataku['NAMA_PASIEN'];?> </td>
</tr>
<tr>
<td>Tanggal Lahir</td><td>:</td><td><?php echo $dataku['TGL_LAHIR']; ?></td>
</tr>

</table>
<div style="background-color:#DCDCDC; width:760px;text-align:center;margin-top:18px;">
<span style="font-size:17px;font-weight:600;" > 
RESUME PELAYANAN RAWAT JALAN        
</span>
</div>
<table class="konten" width="760px;" style="margin-top:8px;" cellspacing="8">
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
<table cellspacing="7" class="konten">
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
<table width="760px;" style="margin-top:3px;" class="konten">
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
<table  width="760px;" style="margin-top:3px;" class="konten">
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
<table width="760px;" style="margin-top:3px;"class="konten">
<tr>
<td  style="background-color:#DCDCDC;font-align:left;border-bottom:#000 solid 1px;"><strong>TINDAKAN</strong></td></tr>
<tr><td><?php 	
$sql3="SELECT
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


$stmt3 = sqlsrv_query( $conn, $sql3 , $params);
$no=1;
 echo"<ul style='list-style: none;'>";
  while($datar=sqlsrv_fetch_array($stmt3,SQLSRV_FETCH_ASSOC)){
	 
	  echo "<li>".$datar['TINDAKAN_NAME']."</li>";
  
  }
  echo"</ul>";
								?>	
								</td></tr>
</table>
<table width="760px;" style="margin-top:3px;" cellspacing="8" class="konten">
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
if($dataku['RESEP']!=''){
		echo nl2br($dataku['RESEP']);
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
</div>
<?php
$sqlrujukan="select param_value from rs_param where param_code = 'URLKLAIMWEB' or param_code ='SCPATHWEB'"; 
$queryrujukan = sqlsrv_query($conn,$sqlrujukan,$params);
$no=1;
while($datarujukan=sqlsrv_fetch_array($queryrujukan,SQLSRV_FETCH_ASSOC)){
$dir[$no]=$datarujukan['param_value'];
$no++;	
}
$folder1=str_replace("-",".","$tgl_sep");

echo "<div class='page-break'><h4> SURAT RUJUKAN</h4><img src='../../".$dir[2]."/".$folder1."/".$nosep."/".$nosep."-Surat_Rujukan.jpg' width='600'></div>";
echo "<div class='page-break'><h4>SURAT KONTROL/ SKDP</h4><img src='../../".$dir[2]."/".$folder1."/".$nosep."/".$nosep."-Surat_Kontrol_SKDP.jpg' width='600'></div>";
echo "<div class='page-break'><h4>SURAT PERINTAH HD</h4><img src='../../".$dir[2]."/".$folder1."/".$nosep."/".$nosep."-Surat_Perintah_HD.jpg' width='600'></div>";
echo "<div class='page-break'><h4>KARTU BPSJS</h4><img src='../../".$dir[1]."/".create($norm,2)."/".$norm."/SOSIAL/".$norm."-SOSIAL-BPJS.jpg' width='600'></div>";
echo "<div class='page-break'><h4>KARTU TANDA PENDUDUK (KTP)</h4><img src='../../".$dir[1]."/".create($norm,2)."/".$norm."/SOSIAL/".$norm."-SOSIAL-KTP.jpg' width='600'></div>";
echo "<div class='page-break'><h4>KARTU KELUARGA (KK)</h4><img src='../../".$dir[1]."/".create($norm,2)."/".$norm."/SOSIAL/".$norm."-SOSIAL-KK.jpg' width='600'></div>";
?>

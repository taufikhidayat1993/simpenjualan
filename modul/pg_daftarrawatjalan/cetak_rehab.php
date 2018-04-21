<style>
body {
	font-family: "Arial", Helvetica, sans-serif;
}
</style>
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/fungsi_indotgl.php";
include"../../inc/library.php";
$id=$_GET['medis_id'];
$idnya=$_GET['id'];
if($_GET['rawat']=='RJ'){
	$tabel="RS_PASIEN_MEDIS";
	$id2="MEDIS_ID";
	$dr="DR_ID";
}ELSE{
	$tabel="RS_PASIEN_OPNAME";
	$id2="OPNAME_ID";
	$dr="DPJP";
}
$sql="SELECT
	B.NO_RM,
	B.NAME,
	B.ADDRESS,
	B.asuransi_polis,
	CONVERT(VARCHAR(11),B.TGL_LAHIR,103) AS TGL_LAHIR
FROM
	rs.RS_PASIEN_MEDIS AS A
LEFT JOIN rs.RS_PASIEN AS B ON A.PASIEN_ID = B.PASIEN_ID
WHERE
	A.MEDIS_ID = '$id'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

$sql1="select CONVERT(VARCHAR(20),TGL,120) AS TANGGAL,TERAPI,ANJURAN,DIAGNOSA,KLINIK,DOKTER from rs_pesan_kontrol where id = '$idnya'";
$stmt1 = sqlsrv_query( $conn, $sql1 , $params);
$data1=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
?>
<table >
<tr >
<td width="90px;"><img src="../../assets/pages/img/logo-med.png" width="70px"></td>
<td width="600px" align="center">
<h2>RUMAH SAKIT ISLAM YOGYAKARTA PDHI</h2>
<span style="font-size:17px;">Jl. Solo Km 12.5 Kalasan, Sleman Yogyakarta Telp (0274) 49800 (Hunting)<br>
Telp. (0274) 498000 (Hunting), Telp.498464<br></span>
</td>
<tr><td style="border-bottom:#000 solid 1px;border-style: double;" colspan="2"></td>
<tr><th colspan="2"><span style="font-size:19px;" >SURATN KONTROL REHABILITASI MEDIK</span></td></tr>

</table>
<table style="margin-top:10px;" cellpadding="5">

<tr>
<td>No. RM</td><td>:</td><th style="border:#000 solid 1px;width:300px;"><span style="font-size:19px;" ><?php echo $data['NO_RM']; ?></span> </th>
</tr>
<tr>
<td>Nama </td><td>:</td><td><?php echo $data['NAME'];?></td>
</tr>
<tr>
<td>Usia </td><td>:</td><td><?php echo umur2($data['TGL_LAHIR']); ?></td>
</tr>
<tr>
<td>Alamat</td><td>:</td><td><?php echo $data['ADDRESS']; ?></td>
</tr>
<tr>
<td>Diagnosa</td><td>:</td><td><?php echo nl2br($data1['DIAGNOSA']); ?></td>
</tr>
<tr>
<td>Terapi</td><td>:</td><td><?php echo nl2br($data1['TERAPI']); ?></td>
</tr>

<tr>
<td>Tgl Surat Rujukan</td><td>:</td><td></td>
</tr>
<tr>
<td>Kontrol Kombali</td><td>:</td><td><?php echo $data1['KLINIK'].", ".$data1['DOKTER']; ?></td>
</tr>
<tr>
<td colspan="3">Demikian harap menjadikan maklum dan terimakasih atas kerjasamanya.</td>
</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" width="600px">
<tr><th>Tgl Dan Jam</th><th>Terapi</th><th>Paraf</th><th>Tgl Dan Jam</th><th>Terapi</th><th>Paraf</th></tr>
<?php for ($i=0;$i<=9;$i++){
	?>
<tr style="height:30px;"><td></td><td></td><td></td><td></td><td></td><td></td></tr>
<?
}
?>
</table>
<br>
<br>

<table width="760px;" style="">
<tr><td style="width:50%;border:#000 solid 1px;margin-top:8px;padding:7px;"><strong>*Saat Jadwal Kontrol Mohon Konfirmasi Kedatangan Di Unit Pendaftaran <br> *Syarat yang WAJIB dikumpulkan saat kontrol untuk pasien BPJS :</strong><br>
1. Surat Kontrol ini <br>
2. Fotocopy KK<br>
3. Fotocopy KTP<br>
4. Fotocopy Kartu JKN/KIS/BPJS<br>
5. Rujukan Internal dari DPJP Utama<br>
(Saraf, Anak, Dalam, Kandungan, Orthopedi, dll)<br>
6. Surat Rujukan PPK1 Yang Lama</td><td style="width:15%;"></td><td align="center">Yogyakarta, <?php echo tgl_indo($tgl_sekarang2); ?><br>
<img src="192.168.1.245/serverttd/SPPD.bmp">
<?php echo $data1['DOKTER']; ?>
</td></tr>
</table>


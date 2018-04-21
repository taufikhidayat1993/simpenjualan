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
<table style="border-bottom:#000 solid 1px;">
<tr>
<td width="90px;"><img src="../../assets/pages/img/logo-med.png" width="70px"></td>
<td width="500px;">
<span style="font-size:19px;font-weight:700;">RUMAH SAKIT ISLAM YOGYAKARTA PDHI</span><br>
Jl. Solo Km 12.5 Kalasan, Sleman Yogyakarta<br>
Telp. (0274) 498000 (Hunting), Telp.498464<br>
</td>
<th width="150px;">SURAT KONTROL RAWAT JALAN II</th>
</table>
<table style="margin-top:10px;" cellpadding="5">
<tr><td colspan="3">Assalamualaikum Wr. Wb. <br>Dengan Hormat, Kami Dokter RSIY PDHI Menerangkan Bahwa :</td></tr>
<tr>
<td>No. RM</td><td>:</td><th style="border:#000 solid 1px;width:300px;"><span ><?php echo $data['NO_RM']; ?></span> </th>
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
<td valign="top">Anjuran</td><td valign="top">:</td><td><?php echo nl2br($data1['ANJURAN']); ?></td>
</tr>
<tr>
<td>Kontrol</td><td>:</td><td>Hari/Tanggal <?php echo tglhari($data1['TANGGAL']); ?></td>
</tr>
<tr>
<td>Poliklinik</td><td>:</td><td><?php echo $data1['KLINIK'].", ".$data1['DOKTER']; ?></td>
</tr>
<tr>
<td colspan="3">Demikian harap menjadikan maklum dan terimakasih atas kerjasamanya.<br>
Wassalamualaikum Wr. Wb.</td>
</tr>
</table>
<br>
<br>

<table width="760px;" style="">
<tr><td style="width:50%;border:#000 solid 1px;margin-top:8px;padding:7px;"><strong>*Saat Jadwal Kontrol Mohon Konfirmasi Kedatangan Di Unit Pendaftaran <br> *Syarat yang WAJIB dikumpulkan saat kontrol untuk pasien BPJS :</strong><br>
1. Surat Kontrol ini <br>
2. Fotocopy KK<br>
3. Fotocopy KTP<br>
4. Fotocopy Kartu JKN/KIS/BPJS</td><td style="width:15%;"></td><td align="center">Yogyakarta, <?php echo tgl_indo($tgl_sekarang2); ?><br>
<br><br><br><br>
<?php echo $data1['DOKTER']; ?>
</td></tr>
</table>


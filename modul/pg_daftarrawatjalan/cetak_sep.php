<?php
include"../../inc/inc.koneksi2.php";
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

<?php
include"../../inc/inc.koneksi.php";
include"../../inc/library.php";
include"../../inc/fungsi_indotgl.php";
$tanggal=$_GET['tanggal'];
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql1="SELECT
rs.RS_DOKTER.POLI_ID,
rs.RS_POLIKLINIK.POLI_ID,
rs.RS_DOKTER.NAME,
rs.RS_POLIKLINIK.NAME AS POLI

FROM
rs.RS_DOKTER
INNER JOIN rs.RS_POLIKLINIK ON rs.RS_DOKTER.POLI_ID = rs.RS_POLIKLINIK.POLI_ID
WHERE
rs.RS_DOKTER.DR_ID = '".$_GET['dokter']."' AND
rs.RS_DOKTER.POLI_ID = '".$_GET['poliklinik']."'";
$st = sqlsrv_query($conn,$sql1,$params,$options);
$dataku=sqlsrv_fetch_array($st,SQLSRV_FETCH_ASSOC)

?>
<h4 style="text-align:center;text-transform: uppercase;

"> DAFTAR PASIEN RAWAT JALAN <BR> RUMAH SAKIT ISLAM YOGYAKARTA <BR>
TANGGAL <?php echo tgl_indo($tanggal); ?> </h4>
<HR>
<table>
<tr>
<td>Poliklinik</td>
<td>:</td>
<td><?php echo $dataku['POLI']; ?></td>
</tr>
<tr>
<td>Dokter</td>
<td>:</td>
<td><?php echo $dataku['NAME']; ?></td>
</tr>


</table>
<table border="1" cellpadding="3" cellspacing="0">
<thead>
<tr>
<th>NO</th><th>NO RM </th><th>NAMA PASIEN</th><th>ALAMAT</th><th>TELP</th><th>NO ANTRIAN</th>
</tr>
</thead>
<?php
$dokter=$_GET['dokter'];
$poli=$_GET['poliklinik'];
$tanggal=$_GET['tanggal'];
$sql="SELECT 
P.MEDIS_ID,
P.PASIEN_ID,
Q.NO_RM,
Q.TELEPHONE as TELP,
Q.NAME,
Q.ALERGI,
LOWER(Q.ADDRESS) AS ADDRESS,
asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM' WHEN 3 THEN R.NAME END,
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,106) AS DATE_MEDIS,
CONVERT(VARCHAR(8),P.DATETIME_MEDIS,108) AS TIME_MEDIS,
S.NAME AS POLI_NAME,
P.ANTRIAN,
P.RUJUKAN_DATA_ID,
P.NORUJUKAN,
T.NAME AS nama_dokter,
T.DR_ID,
Q.GENDER,
R.NAME AS NAMA_AS,
gender=CASE Q.GENDER WHEN 1 THEN 'L' WHEN 2 THEN 'P' END
FROM
rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE
P.PASIEN_ID = Q.PASIEN_ID AND
P.STATUS_BAYAR = '0'
AND CONVERT(VARCHAR(11),P.DATETIME_MEDIS,120) ='".$tanggal."' 
AND P.DR_ID ='".$dokter."'
AND P.POLI_ID ='".$poli."'
ORDER  By P.ANTRIAN DESC";
$stmt=sqlsrv_query($conn,$sql);

$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$no=1;

 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 echo "<tr><td>$no</td><td>$data[NO_RM]</td><td>".$data['NAME']."</td><td>".$data['ADDRESS']."</td><td>$data[TELP]</td><td align='center'>$data[ANTRIAN]</td></tr>";
	 $no++;
 }

?>
</table>
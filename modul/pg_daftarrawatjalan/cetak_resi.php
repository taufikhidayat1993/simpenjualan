<?php
include"../../inc/inc.koneksi.php";
include"../../inc/library.php";
	$sql="SELECT
	B.NAME,
	B.NO_RM,
	B.ADDRESS,
	CONVERT(varchar(12),A.TGL_RESEP,106) AS TANGGAL
FROM
	RS_RESEP A
LEFT JOIN RS_PASIEN B ON A.PASIEN_ID = B.PASIEN_ID
WHERE
	A.RESEP_NO = '".$_GET['no_resep']."'";
	$data=sqlsrv_query($conn,$sql,$params,$options);
	$r=sqlsrv_fetch_array($data,SQLSRV_FETCH_ASSOC);
?>
<table style="border-bottom:#000 solid 1px;">
<tr><th colspan="3">RS ISLAM YOGYAKARTA PDHI RESI APOTIK</th></tr>
<tr><td>NO RESEP</td><td>:</td><td><?php echo $_GET['no_resep']; ?></td></tr>
<tr><td>NO RM</td><td>:</td><td><?php echo $r['NAME']; ?></td></tr>
<tr><td>NAMA PASIEN</td><td>:</td><td><?php echo $r['NO_RM']; ?></td></tr>
<tr><td>ALAMAT</td><td>:</td><td><?php echo $r['ADDRESS']; ?></td></tr>
<tr><td>TANGGAL</td><td>:</td><td><?php echo $r['TANGGAL']; ?> </td></tr>
</table>
<table style="border-collapse:collapse">


<thead>
<tr style="border-bottom:#000 solid 1px;">
<th>NO</th><th>ITEM OBAT</th><th>JUMLAH</th><th></th>
</tr>
</thead>
<tbody>
<?
    $no=1;
	$jumlah=0;
	$total=0;
	$medis_id=$_GET['medis_id'];
	$sql="select A.RESEP_ID,A.RESEP_TYPE,A.TOTAL_PRICE,B.ITEM_NAME,A.ITEM_PRICE,A.NOTE,A.ITEM_CODE,A.JUMLAH from RS_RESEP_DETAIL A JOIN RS_MASTER_ITEM B ON A.ITEM_CODE=B.ITEM_CODE WHERE A.RESEP_ID='".$medis_id."'";
	$data=sqlsrv_query($conn,$sql,$params,$options);
	while($row=sqlsrv_fetch_array($data)){
		echo"<tr ><td>$no.</td><td>".$row['ITEM_NAME']."
		<br>".$row['NOTE']."</td><td>".$row['JUMLAH']."</td><th></th></tr>";
	$no++;
	$jumlah=$jumlah+$row['JUMLAH'];
	$total=$total+$row['TOTAL_PRICE'];
	}
	?>
	</tbody>
	<thead>
<tr style="border-bottom:#000 solid 1px;">
<th colspan="2">TOTAL</th><tD><?php echo $jumlah; ?></td><th><?php echo $total; ?></th>
</tr>
</thead>
</table>
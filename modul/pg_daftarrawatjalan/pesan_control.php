<?php
include"../../inc/inc.koneksi.php";

include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";
include"../../inc/fungsi_radiologi.php";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
$medis_id=$_POST['medis_id'];


$sql="SELECT
	CONVERT (VARCHAR(14), TGL, 103) AS tanggal,
	KLINIK,
	ID,
	MEDIS_ID,
	OPNAME_ID,
	KET,
	DR_ID,
	POLI_ID
FROM
	rs_pesan_KONTROL
WHERE
	 OPNAME_ID = '$medis_id'";
$quer= sqlsrv_query($conn,$sql,$params,$options);
 while($data=sqlsrv_fetch_array($quer,SQLSRV_FETCH_ASSOC)) {
	 echo"<tr ><td style='width:120px;'>".$data['tanggal']."</td>
	 <td style='width:200px;'>".$data['POLI_ID']."</td>
	 <td >".$data['DR_ID']."</td><td>
	 <button class='btn btn-sm red' onclick='hapus_pesan(".$data['ID'].",\"".$data['OPNAME_ID']."\")'>
	 <i class='fa fa-times'>
	 </i>
	 </button><div class='btn-group'>
															<button type='button' class='btn btn-primary'>Cetak</button>
															<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-delay='1000' data-close-others='true'><i class='fa fa-angle-down'></i></button>
															<ul class='dropdown-menu' role='menu'>
																
																<li>
																	<a onclick='cetak_skdp(".$data['ID'].",\"".$data['OPNAME_ID']."\")'>
																	Surat Kontrol </a>
																</li>
																<li>
																	<a onclick='cetak_rehab(".$data['ID'].",\"".$data['OPNAME_ID']."\")'>
																	Surat Kontrol Rehab </a>
																</li>
															</ul>
														</div></td></tr>";

 }

?>
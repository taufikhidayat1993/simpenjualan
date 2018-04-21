<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$op=$_GET['op'];
if($op=='caripasien'){
	error_reporting(0);
	if($_POST['pasien']!=''){
		$pasien=$_POST['pasien'];
	}
$opsi=$_POST['opsi'];
$poli=$_POST['poli'];
if($opsi==0){
	$status="P.STATUS_ANTRI <> 2";
	$order="ASC";
}else{
	$status="P.STATUS_ANTRI = 2 ";
	$order="DESC";
}
$dokter=trim($_SESSION['dokter']);
$dok=trim($_POST['dokter']);
if($_SESSION['level']!='dokter'){
	$cari ="AND  P.POLI_ID  = '$poli' and P.DR_ID LIKE '$dok%'";
}else {
	$cari="AND  P.POLI_ID  = '$_SESSION[polid]' and P.DR_ID  = '$_SESSION[dokter]'";
}
$tgl= "CONVERT(VARCHAR(10),GETDATE(),103)";
$sql1 = "SELECT  P.ANTRIAN ,
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,106) AS DATE_MEDIS,
P.DR_ID AS DOKTER,
P.MEDIS_ID,P.PASIEN_ID,P.STATUS_ANTRI, Q.NO_RM,Q.NAME,Q.ADDRESS,asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM'
 WHEN 3 THEN R.NAME END From 
 rs.RS_PASIEN_MEDIS AS P left JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID 
 left JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID left JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID =S.POLI_ID
 LEFT JOIN rs.RS_DOKTER ON P.DR_ID = rs.RS_DOKTER.DR_ID  Where CONVERT(VARCHAR(10),P.DATETIME_MEDIS,103) = $tgl
$cari and P.PASIEN_ID = Q.PASIEN_ID AND $status and Q.NAME like '%$pasien%'  Order By P.ANTRIAN $order";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$no=1;

 while($data1=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 
	 
	 echo"<tr style='cursor:pointer;' >
	 <td >$data1[ANTRIAN]</td>
	 <td >$data1[NO_RM]</td><td  > $data1[NAME]</td><td >$data1[ADDRESS]</td>
	 <td  style='width:100px;'>$data1[asuransi_pasien]</td><td><div class='btn-group btn-group-solid'>";
	 if($_SESSION['level']=='dokter'){
		 echo"	
		
		 <a class='btn blue' onclick='GetMed(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\",\"".$data1['STATUS_ANTRI']."\")'>
		 Rekam Medis</a>
		<button type='button' class='btn blue' onclick='Entribhp(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\",\"RJ\",\"".$data1['DOKTER']."\")'> Entri BHP</button>";
		if($data1['STATUS_ANTRI']==2){
echo"<button type='button' class='btn blue' onclick='CetakSurat(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\")'> Cetak Surat</button>
<button type='button' class='btn green' onclick='CetakSuratResume(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\",\"RJ\")'> Cetak Resume Medis</button>
		";
		}
	 }else if ($_SESSION['level']=='rjalan'){
		 if($opsi==0){
		  echo"	
		   <button type='button' class='btn green' onclick='Tindakan(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\",\"".$data1['NAME']."\")'></i> Tindakan</button>
<button type='button' class='btn green' onclick='VitalSign(\"".$data1['MEDIS_ID']."\")'><span style='width:40px;'> Vital Sign</span></button>
<button type='button' class='btn green' onclick='GetMedisId(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\",\"".$data1['DATE_MEDIS']."\")'></i> Rekam Medis</button>
<button type='button' class='btn blue' onclick='Entribhp(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\",\"RJ\",\"".$data1['DOKTER']."\")'> Entri BHP</button>";
		 }else{
echo"	
<button type='button' class='btn green' onclick='GetMedisId(\"".$data1['MEDIS_ID']."\",\"".$data1['PASIEN_ID']."\",\"".$data1['DATE_MEDIS']."\")'></i> Tindakan</button>
<button type='button' class='btn green' onclick='VitalSign(\"".$data1['MEDIS_ID']."\")'><span style='width:40px;'> Entri BHP</span></button><div class='btn-group btn-group-solid'>
<button type='button' class='btn green dropdown-toggle' aria-expanded='true' data-toggle='dropdown' >
<i class='fa fa-print'></i> Cetak <i class='fa fa-angle-down'></i></button>
<ul class='dropdown-menu'>
<li><a href='#'>Surat Kontrol</a></li>
<li><a href='#'>SKDP</a></li>
<li><a href='#'>Surat Kontrol Rehap</a></li>
<li><a href='#'>Resume Medis</a></li>
</ul>
</div>";

		 }
	 }												
													
													
														echo"
														
													
													</div></td></tr>";
	 
 }


						
}else if($op=='caripoli'){
	$dokter=trim($_POST['dokter']);
	$sql1 = "SELECT B.NAME AS POLI FROM RS_DOKTER A LEFT JOIN RS_POLIKLINIK B ON A.POLI_ID=B.POLI_ID WHERE A.DR_ID LIKE '$dokter%' ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
$data1=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
echo $data1['POLI'];
}else if($op=='detail_periksa'){
		$id=$_POST['id'];
	$sql ="select * from rs_periksa where trx_id = '$id'";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 $params = $data;
}
  echo json_encode($params);
}else if($op=='input_sign'){
	$id=$_POST['medis_id'];
	$sql ="select * from rs_periksa where trx_id = '$id'";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows($stmt);
if($row_count > 0){
	$sql2="update rs_periksa set DT_PERIKSA='$tgl_sekarang2',
	DR_ID='$_SESSION[dokter]',SEQ=1,
	SUBYEKTIF='$_POST[subyektif]',
	OBYEKTIF='',
    ASSESMENT = '' , 
	PLANING='', 
	tensi = '$_POST[tensi]',
	suhu = '$_POST[suhu]',
	nadi= '$_POST[nadi]',
	resp = '$_POST[resp]',
	bb = '$_POST[bb]',
    tb = '$_POST[tb]',
	nyeri = '$_POST[nyeri]',
	LK='$_POST[lk]'
    where trx_id = '$id'";
	sqlsrv_query( $conn, $sql2 , $params, $options );
	echo $sql2."".$row_count;
}else{
	$sql2="insert into rs_periksa(TRX_ID,DT_PERIKSA,DR_ID,SEQ,SUBYEKTIF,OBYEKTIF,ASSESMENT,PLANING,tensi, suhu, nadi, resp, bb, tb, nyeri) 
	values ('$id','$time','$_SESSION[dokter]',1,'$_POST[subyektif]','','','','$_POST[tensi]','$_POST[suhu]','$_POST[nadi]',
	'$_POST[resep]','$_POST[bb]','$_POST[tb]','$_POST[nyeri]')";
		sqlsrv_query( $conn, $sql2 , $params, $options );
		echo $sql2;
}
	
	
}
?>
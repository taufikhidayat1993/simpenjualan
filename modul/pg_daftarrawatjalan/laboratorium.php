
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$op=$_GET['op'];
if($op=='view'){
	
	$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$id=$_GET['id'];
$rawat=	$_GET['rawat'];
		if($rawat=='RJ'){
		$tabel1="RS_MEDIS_DETAIL";
		$tabel2="MEDIS_ID";
		}else{
			$tabel1="RS_OPNAME_DETAIL";
		$tabel2="OPNAME_ID";
	
		}
	
   $sql = "SELECT P.LAB_CODE,P.NAME,Q.NOTE,Q.SEQ_NO,Q.MODIDATE, " & _
                   "DR.NAME AS DOKTER_NAME, PR.NAME AS PERAWAT_NAME " & _
                   "FROM RS_LAB_ITEM P, " & IIf(Rawat = "RI", "RS_OPNAME_DETAIL", "RS_MEDIS_DETAIL") & " Q " & _
                   "LEFT JOIN RS_DOKTER DR ON Q.DR_ID=DR.DR_ID " & _
                   "LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID=PR.PERAWAT_ID " & _
                   "WHERE P.LAB_CODE=Q.DETAIL_CODE " & _
                   "AND Q." & IIf(Rawat = "RI", "OPNAME_ID", "MEDIS_ID") & "='" & TrxID & "' " & _
                   "AND Q.DETAIL_TYPE='1' ORDER BY Q.MODIDATE DESC";
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
}
?>
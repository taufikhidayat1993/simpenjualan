<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
if($_GET['op']=='diagnosa'){
		$id=$_POST['id'];
				$sql="select 
				CASE PS
				WHEN '1' THEN 'P' ELSE 'S' END as tipe,
				diagnosa,PS, penyakit_id, seq_no from rs_diagnosa where diagnosa_id = '$id' order by PS desc, seq_no";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	if($data['tipe']=='P'){
		$color="background-color:#4caf50;color:#fff;";
	}else{
		$color="";
	}
								echo"<tr style='$color'><td  style='cursor:pointer'  onClick=hapus_diagnosa(\"".addslashes($id)."\",".$data['seq_no'].",".$data['PS'].");>$data[diagnosa]</td>
								<td  style='cursor:pointer'  onClick=hapus_diagnosa(\"".addslashes($id)."\",".$data['seq_no'].",".$data['PS'].");>$data[penyakit_id]</td>
									<td><a class='btn btn-xs blue' onClick=ubah(\"".addslashes($id)."\",".$data['seq_no'].");>
								$data[tipe]
									</a></td></tr>";
}
							
}else if($_GET['op']=='hapusdiagnosa'){
	$id=$_POST['kode_diagnosa'];
	$seq=$_POST['seq'];
	$tipe=$_POST['tipe'];
	$sql="delete from rs_diagnosa where diagnosa_id = '$id' and seq_no = '$seq'";
	$sql2="delete from RS_MEDICAL_RECORD where DIAGNOSA_ID= '$id' and SEQ_NO1 = '$seq'";
    $stmt = sqlsrv_query($conn,$sql);

$no=1;	
	if($tipe=1){
			$sql3="SELECT  * FROM  RS_DIAGNOSA where DIAGNOSA_ID = '$id' and PS=0";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query( $conn, $sql3 , $params, $options);
while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	if($no==1){
$sql3="update RS_DIAGNOSA SET PS=1 WHERE DIAGNOSA_ID='$id' AND seq_no = '".$row['SEQ_NO']."'";
sqlsrv_query( $conn, $sql3 , $params);
	}
		
$no++;		
	}
}else{
		sqlsrv_query($conn,$sql2);	
	
}
}
if($_GET['op']=='procedure'){
	$id=$_GET['id'];
				$sql="SELECT a.NAMa, A.ICD9,A.ID FROM rs.RS_PROCEDURE_PASIEN AS A where A.TRX_ID = '$id' order by A.ID";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
								echo"<tr style='cursor:pointer'  onClick=hapus_procedure(\"".addslashes($id)."\",".$data['ID'].");><td>$data[NAMa]</td><td>$data[ICD9]</td></tr>";
}
}
if($_GET['op']=='tindakan'){
	if($_GET['rawat']=='RJ'){
		$tabel="RS_MEDIS_TINDAKAN";
		$idnya="MEDIS_ID";
		$raj="RJ";
	}else{
		$tabel="RS_OPNAME_TINDAKAN";
		$idnya="OPNAME_ID";
		$raj="RI";
	}
	$id=$_GET['id'];
$sql="SELECT
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
P.SEQ_NO 
FROM
$tabel as P	
LEFT JOIN RS_TINDAKAN Q ON P.TINDAKAN_ID = Q.TINDAKAN_ID 
LEFT JOIN RS_OPERASI R ON P.OPERASI_ID = R.OPERASI_ID 
LEFT JOIN RS_PERSALINAN S ON P.PERSALINAN_ID = S.PERSALINAN_ID
LEFT JOIN RS_DOKTER DR ON P.DR_ID=DR.DR_ID 
LEFT JOIN RS_PERAWAT PR ON P.PERAWAT_ID=PR.PERAWAT_ID 
WHERE P.$idnya='$id'
ORDER BY P.DATE_TIME desc";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
								echo"<tr style='cursor:pointer'onClick=hapus_tindakan(\"".addslashes($id)."\",".$data['SEQ_NO'].",\"".$raj."\");>
								<td>".$data['TINDAKAN_NAME']."</td><td>".$data['TINDAKAN']."</td></tr>";
}

}else if($_GET['op']=='hapustindakan'){
	$id=$_POST['kode_diagnosa'];
	$seq=$_POST['seq'];
		$sql="delete from RS_MEDIS_TINDAKAN where MEDIS_ID = '$id' and seq_no = '$seq'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
}else if($_GET['op']=='pemeriksaan'){
		$id=$_POST['id'];
			$sql5="SELECT  * FROM RS_PERIKSA WHERE TRX_ID  = '$id' ";
$stmt5 = sqlsrv_query( $conn, $sql5);
$data5=sqlsrv_fetch_array($stmt5,SQLSRV_FETCH_ASSOC);

 echo "-Subyektif    : ".$data5['SUBYEKTIF']."  <br>-Obyektif     : ".$data5['OBYEKTIF']." Obyektif <br>
 * Vital Signs :<br>
 <table >
<tr><td > TD  </td> <td>:  ".$data5['TENSI']." </td><td>mmHg</td><td > Nyeri </td> <td>:  ".$data5['NYERI']." </td><td> nyeri</td><td > S </td> <td>:  ".$data5['SUHU']." </td><td>&deg C</td></tr>
<tr><td > N </td> <td>:  ".$data5['NADI']." </td><td>x/menit</td><td > BB  </td> <td>:  ".$data5['BB']." </td><td>KG </td><td colspan='3'></td></tr>
<tr><td > RR </td> <td>:  ".$data5['RESP']." </td><td>x/menit</td><td >  TB  </td> <td>:  ".$data5['TB']." </td><td>CM </td><td colspan='3'></td></tr>

</table>  
 - Assesment :  ass <br>
 - Planing/Terapi :<br> ".nl2br($data5['PLANING']);
	
}else if($_GET['op']=='premiere'){
$id=$_GET['id'];
	$sql="SELECT  * FROM  RS_DIAGNOSA where DIAGNOSA_ID = '$id' and PS=1";
$params = array();

$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query( $conn, $sql , $params, $options);
$count=sqlsrv_num_rows($stmt);
if($count>0){
	                               echo'<label class="radio-inline">											
										<input type="radio" name="tipe_diagnosa" id="tipe_diagnosa" value="1" disabled>Primary </label>
										<label class="radio-inline">
										<input type="radio" name="tipe_diagnosa" id="tipe_diagnosa" value="0" checked>Secondary</label>';
}else{
    echo'<label class="radio-inline">											
										<input type="radio" name="tipe_diagnosa" id="tipe_diagnosa" value="1" checked >Primary </label>
										<label class="radio-inline">
										<input type="radio" name="tipe_diagnosa" id="tipe_diagnosa" value="0">Secondary</label>';
}
}
	
	



?>
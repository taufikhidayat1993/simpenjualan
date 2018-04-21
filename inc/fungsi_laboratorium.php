<?php


	function laboratorium($nama) {
include "inc.koneksi.php";
$nam = str_replace(' ', '_', $nama);
	echo'<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">'.$nama.'</h3>
									</div>
									<div class="panel-body">
								<ul class="feeds">';	
										
$params = array();
$sql="SELECT NAME,ID,ICD9 FROM 	RS_LAB_GROUP where GROUP1='".$nama."'";
$stmt = sqlsrv_query( $conn, $sql , $params);
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
									echo"<li>
								<div class='col1'>					
								     <input type='checkbox'   value='".$data['ICD9'].",".$data['NAME']."' name='".$nam."'/> ".$data['NAME']."
								</div>
								<div class='col2'>
								</div>
								</li>";
}
								ECHO'</ul>
									</div>
	</div>';
	
	}
function simpan_laboratorium($medis_id,$kode) {	
session_start();
include "inc.koneksi.php";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="select trx_id from rs_procedure_pasien where trx_id = '".$medis_id."' and icd9 = '".$kode."'";
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows($stmt);
	if($row_count == 0 ){
			$sql1="select name from rs_prosedur where icd9 = '".$kode."'";
			$stmt1 = sqlsrv_query( $conn, $sql1, $params, $options);
			$data=sqlsrv_fetch_array($stmt1);
			$sql2="insert into rs_procedure_pasien(trx_id, icd9, modidate,modiby,nama) values('".$medis_id."','".$kode."',getdate(),'".$_SESSION['dokter']."','".$data['name']."')";
			sqlsrv_query( $conn, $sql2 , $params);		 
	}
}
	function simpan_laboratorium2($masuk) {	
session_start();
 $hasile= explode(",",$masuk);	
 $medis_id=$hasile[0];
 $kode=$hasile[1];

		include "inc.koneksi.php";
		$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sqldelete="delete from rs_procedure_pasien where trx_id = '".$medis_id."' and icd9 in('90.59','91.39','90.44','90.99')";
	sqlsrv_query( $conn, $sqldelete , $params);
	$sql="select trx_id from rs_procedure_pasien where trx_id = '".$medis_id."' and icd9 = '".$kode."'";
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows($stmt);
		if($row_count ==0){
			$sql1="select name from rs_prosedur where icd9 = '".$kode."'";
			$stmt1 = sqlsrv_query( $conn, $sql1, $params, $options);
			$data=sqlsrv_fetch_array($stmt1);
			$sql2="insert into rs_procedure_pasien(trx_id, icd9, modidate,modiby,nama) values('".$medis_id."','".$kode."',getdate(),'".$_SESSION['dokter']."','".$data['name']."')";
			sqlsrv_query( $conn, $sql2 , $params);
		}
	}
?>
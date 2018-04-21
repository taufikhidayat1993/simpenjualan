
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
include"../../inc/label.php";

include"../../inc/tampil_field.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );	
$op=$_GET['op'];

if($op=='detaildiagnosa'){
	$id=$_POST['medis_id'];
	$sql="SELECT P.DIAGNOSA_ID,DIAGNOSA,P.SEQ_NO,P.PENYAKIT_ID,P.NOTE,Q.NAME AS DR_NAME, CONVERT (VARCHAR(20),P.DT_DIAGNOSA, 113) as myDate
           FROM RS_DIAGNOSA P 
           LEFT JOIN RS_DOKTER Q ON P.DR_ID=Q.DR_ID 
           WHERE P.DIAGNOSA_ID='".$id."' 
           ORDER BY P.SEQ_NO";
		    echo"<table class='table table-striped table-hover' style='font-size:12px;'>
	 <thead>
	 <tr>
	
	  <th>Diagnosa</th>
	  <th>Anamnesa</th>
	  <th>Dokter</th>
	   <th>Tanggal</th>
	 </tr>
	 </thead><tbody>";
		   	$stmt = sqlsrv_query($conn,$sql,$params,$options);	
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	
	echo"<tr><td>".$data['DIAGNOSA']."</td><td>".$data['NOTE']."</td><td>".$data['DR_NAME']."</td><td>".$data['myDate']."</td></tr>";
 }
 echo" <tbody></table>";
	
}
if($op=='caripasien'){
	$pasien_id=$_POST['pasien_id'];
	$sql="SELECT
 	CONVERT (VARCHAR(20),RS_DIAGNOSA.DT_DIAGNOSA, 113) as myDate,
	RS_DIAGNOSA.DIAGNOSA_ID,
	RS_DIAGNOSA.DIAGNOSA,
	RS_DIAGNOSA.SEQ_NO,
	RS_DIAGNOSA.PENYAKIT_ID,
	RS_DIAGNOSA.NOTE,
	RS_DOKTER.NAME AS DR_NAME,
	RS_DIAGNOSA.MODIDATE
FROM
RS_DIAGNOSA
INNER JOIN RS_PASIEN_MEDIS ON rs.RS_DIAGNOSA.DIAGNOSA_ID = rs.RS_PASIEN_MEDIS.MEDIS_ID
LEFT JOIN RS_DOKTER ON rs.RS_DIAGNOSA.DR_ID = rs.RS_DOKTER.DR_ID
WHERE
	RS_PASIEN_MEDIS.PASIEN_ID = '".$pasien_id."'
UNION
	
		SELECT
		CONVERT (VARCHAR(20),RS_DIAGNOSA.DT_DIAGNOSA, 113) as myDate,			
			RS_DIAGNOSA.DIAGNOSA_ID,
			RS_DIAGNOSA.DIAGNOSA,
			RS_DIAGNOSA.SEQ_NO,
			rs.RS_DIAGNOSA.PENYAKIT_ID,
			rs.RS_DIAGNOSA.NOTE,
			RS_DOKTER.NAME AS DR_NAME,
			RS_DIAGNOSA.MODIDATE
		FROM
			RS_DIAGNOSA
		INNER JOIN rs.RS_PASIEN_OPNAME ON rs.RS_DIAGNOSA.DIAGNOSA_ID = rs.RS_PASIEN_OPNAME.OPNAME_ID
		LEFT JOIN rs.RS_DOKTER ON rs.RS_DIAGNOSA.DR_ID = rs.RS_DOKTER.DR_ID
		WHERE
			RS_PASIEN_OPNAME.PASIEN_ID = '".$pasien_id."'
	
ORDER BY
	rs.RS_DIAGNOSA.modidate  DESC";
	
	$stmt = sqlsrv_query($conn,$sql,$params,$options);	
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 $date1 = explode('-',$data['DT_DIAGNOSA']);

 
	 echo"<tr><td style='width:80;'>".$data[myDate]."</td><td style='width:200px;'>".$data['DIAGNOSA']."</td><td style='width:200px;'>".nl2br($data['NOTE'])."</td><td>".$data['DR_NAME']."</td></tr>";
 }

}
 
if($op=='daftarlab'){
	$id=$_POST['medis_id'];
	$pasien_id=$_POST['pasien_id'];
	$sql="SELECT 'LABORATORIUM' AS TIPE,P.LAB_CODE AS DATA,P.NAME,Q.MEDIS_ID,Q.NOTE,Q.SEQ_NO,CONVERT(VARCHAR(20),Q.MODIDATE,113) as TANGGAL,
                   RS.FN_GET_LABRADIOPRICE(P.LAB_CODE,'1','".asuransi($pasien_id)."') AS HARGA,
DR.NAME AS DOKTER_NAME, PR.NAME AS PERAWAT_NAME 
                   FROM RS_LAB_ITEM P, RS_MEDIS_DETAIL Q LEFT JOIN RS_DOKTER DR ON Q.DR_ID=DR.DR_ID 
LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID=PR.PERAWAT_ID WHERE P.LAB_CODE=Q.DETAIL_CODE AND Q.MEDIS_ID='".$id."' 
AND Q.DETAIL_TYPE='1'";
	$stmt = sqlsrv_query($conn,$sql,$params,$options);	
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 echo"<tr><td>".$data['DATA']."</td><td>".$data['NAME']."</td><td>".$data['NAME']."</td><td>".$data['TANGGAL']."</td>
	  <td>".$data['DOKTER_NAME']."</td>
	 <td>".$data['PERAWAT_NAME']."</td>";
	 echo'<td><a onClick="hapuslab(\''.$data['MEDIS_ID'].'\',\''.$data['SEQ_NO'].'\',\''.$pasien_id.'\');" ><i class="fa fa-trash-o"></i></a></td>';
	 echo"</tr>";
 }
	
}

if($op=='hapus_lab'){
	$medis_id=$_POST['medis_id'];
	$seq_no=$_POST['seq_no'];
	$deletemedis="DELETE FROM RS_MEDIS_DETAIL
               WHERE MEDIS_ID='".$medis_id."' 
               AND SEQ_NO='".$seq_no."'";
    sqlsrv_query($conn,$deletemedis,$params);
	
		$deletetemplab="DELETE FROM RS_TEMPLAB WHERE MEDIS_ID='".$medis_id."'
		AND SEQ_NO='".$seq_no."'";
    sqlsrv_query($conn,$deletetemplab,$params);
	echo $deletemedis;
}
if($op=='cari_lab'){
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];			 			
			  $sql="
	SELECT LAB_CODE AS DATA_ID,NAME,HARGA 
                   FROM RS_LAB_ITEM
                   WHERE NAME LIKE '%".$queryString."%' 
                   ORDER BY LAB_ID,NAME ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
			if(strlen($queryString) >1) {
				if($stmt) {
				echo '
				<div class="pane pane--table1">
  <div class="pane-hScroll1">
				<table style="100%" >
				<thead style="color:#000;font-size:11px;"><tr><th style="width:120;">DATA ID</th>
				<th style="width:230px;" >NAMA</th></tr></thead></table> <div class="pane-vScroll"> <table width="100%" id="table" style="font-size:11px;"><tbody>';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
								
	         			echo '<tr style="cursor:pointer" class="rows" onClick="fil(\''.$data['DATA_ID'].'\',\''.$data['NAME'].'\',\''.$data['HARGA'].'\');">
						<td style="width:70px;">'.$data['DATA_ID'].'</td><td class=tanggal style="width:230px;">'.$data['NAME'].'</td></tr>';
	         		}
				echo '
				<tr><td colspan=3>	<script type="text/javascript">	
  $(".pane-hScroll1").scroll(function() {
  $(".pane-vScroll").width($(".pane-hScroll1").width() + $(".pane-hScroll1").scrollLeft());
  });
	</script>
			<style>
{
  box-sizing: border-box;
}


.pane {
  background: #eee;
}
.pane-hScroll1 {
  overflow: auto;


}
.pane-vScroll {
     overflow-y: auto;
    overflow-x: hidden;
    height: 200px;
    background: white;
    color: #524c4c;
}
.pane--table2 thead {
    display: table-row;
}
</style></td>
				</tbody></table></div></div></div>';
					
				} else {
					echo 'Data Tidak Di Temukan';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'Minimal 1 Karakter';
		}
		}
}
if($op=='tambahlab'){
	$id=$_POST['id'];
	
		$sql2="select diagnosa from rs_diagnosa where diagnosa_id = '".$id."'";
		   $stmt2 = sqlsrv_query($conn,$sql2,$params,$options);	
		   $diag="";
 while($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
	 $diag .= $data2['diagnosa']."; \n";
 }
		$sql="SELECT * from RS_ANTRI_LAB WHERE id_trx='".$id."'";
	    $stmt = sqlsrv_query($conn,$sql,$params,$options);	
	$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
			 echo  ltrim("DIAGNOSA : \n ".$diag." PERMINTAAN PEMERIKSAAN : \n".$data['PERMINTAAN']);
		 
		 
}

if($op=='simpan_rad'){
	
	$id=$_POST['id'];
	$dokter=$_POST['dokter'];
	$perawat=$_POST['perawat'];
	$kode=$_POST['kode_lab'];
	$keterangan=$_POST['keterangan'];
	$harga=$_POST['harga'];
	$tindakan=$_POST['tindakan'];
	$params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = "IF EXISTS(SELECT SEQ_NO FROM RS_MEDIS_DETAIL 
           WHERE MEDIS_ID='".$id."') SELECT MAX(SEQ_NO) AS SEQ_NO FROM RS_MEDIS_DETAIL WHERE MEDIS_ID ='".$id."' 
		   ELSE SELECT SEQ_NO FROM RS_MEDIS_DETAIL WHERE MEDIS_ID ='".$id."'";
		
    $stmt = sqlsrv_query($conn,$sql,$params,$options);	
	$data=sqlsrv_fetch_array($stmt);
	if( $data['SEQ_NO'] == ''){
					$inseq_no=1;
	}else {
					$inseq_no= $data['SEQ_NO']+1;
	}
    $sql2 = "INSERT INTO RS_MEDIS_DETAIL (MEDIS_ID,DETAIL_CODE,DR_ID,PERAWAT_ID,DETAIL_TYPE,NOTE,SEQ_NO,MODIBY,MODIDATE,harga)
           VALUES ('".$id."','".$kode."','".$dokter."','".$perawat."','1','".$keterangan."','".$inseq_no."','".$_SESSION['username']."',GETDATE(),'".$harga."')";
	sqlsrv_query($conn,$sql2);		
	$sql_medis_detail ="SELECT * FROM RS_PASIEN_MEDIS where MEDIS_ID = '".$id."'";
	$stmt_pasien = sqlsrv_query($conn,$sql_medis_detail,$params,$options);	
	$get_pasien =sqlsrv_fetch_array($stmt_pasien);
		
	$sql_pasien ="SELECT * FROM RS_PASIEN where PASIEN_ID = '".$get_pasien['PASIEN_ID']."'";	
	$stmt_data_pasien = sqlsrv_query($conn,$sql_pasien,$params,$options);	
	$get_data_pasien =sqlsrv_fetch_array($stmt_data_pasien);	
	if($get_data_pasien['GENDER']==1){
		$jk="L";
	}else {
		$jk="P";
	}
	
   $nama_dokter= nama_dokter($dokter);
   $nama_poli=poliklinik($get_pasien['POLI_ID']);
    
$sql3 = "INSERT INTO RS_TEMPLAB (MEDIS_ID,RM,NAMA,UMUR,RUANGAN,DOKTER,DETAIL_CODE,NM_TINDAKAN,HASIL,RAWAT,DETAIL_TYPE, SEQ_NO, PASIEN_ID,MODIDATE,SEX)
 VALUES 
('".$id."','".$get_data_pasien['NO_RM']."',
'".$get_data_pasien['NAME']."',
'".$get_data_pasien['UMUR']."','
".$nama_poli."',
'".$nama_dokter."',
'".$kode."',
'".$tindakan."',
'".$keterangan."',
'Ralan',
'1',
'".$inseq_no."',
'".$get_data_pasien['PASIEN_ID']."',
GETDATE(),
'".$jk."')";

sqlsrv_query($conn,$sql3);	

echo  $sql2;

}

?>


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
if($op=='daftarlab'){
	$id=$_POST['medis_id'];
	$pasien_id=$_POST['pasien_id'];
	$sql="SELECT 'RADIOLOGI' AS TIPE,P.RADIO_ID AS DATA,P.NAME,Q.NOTE,Q.SEQ_NO,Q.MODIDATE,
                   RS.FN_GET_LABRADIOPRICE(P.RADIO_ID,'2','".asuransi($pasien_id)."') AS HARGA,
                   DR.NAME AS DOKTER_NAME, PR.NAME AS PERAWAT_NAME 
                   FROM RS_RADIOLOGI P, RS_MEDIS_DETAIL Q
                   LEFT JOIN RS_DOKTER DR ON Q.DR_ID=DR.DR_ID 
                   LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID=PR.PERAWAT_ID 
                   WHERE P.RADIO_ID=Q.DETAIL_CODE 
                   AND Q.MEDIS_ID='".$id."' 
                   AND Q.DETAIL_TYPE='2'
                   ORDER BY TIPE, P.NAME";
	/*$sql="SELECT 'LABORATORIUM' AS TIPE,P.LAB_CODE AS DATA,P.NAME,Q.MEDIS_ID,Q.NOTE,Q.SEQ_NO,CONVERT(VARCHAR(20),Q.MODIDATE,113) as TANGGAL,
                   RS.FN_GET_LABRADIOPRICE(P.LAB_CODE,'1','".asuransi($pasien_id)."') AS HARGA,
DR.NAME AS DOKTER_NAME, PR.NAME AS PERAWAT_NAME 
                   FROM RS_LAB_ITEM P, RS_MEDIS_DETAIL Q LEFT JOIN RS_DOKTER DR ON Q.DR_ID=DR.DR_ID 
LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID=PR.PERAWAT_ID WHERE P.LAB_CODE=Q.DETAIL_CODE AND Q.MEDIS_ID='".$id."' 
AND Q.DETAIL_TYPE='1'";
				   */
				  $stmt = sqlsrv_query($conn,$sql,$params,$options);	
				  
				
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 echo"<tr><td>".$data['DATA']."</td><td>".$data['NAME']."</td><td>".$data['NOTE']."</td><td>".$data['TANGGAL']."</td>
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
if($op=='cari_rad'){
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];			 			
			  $sql="
	SELECT RADIO_ID AS DATA_ID,NAME,HARGA
                   FROM RS_RADIOLOGI 
                   WHERE NAME LIKE '%".$queryString."%' ORDER BY NAME,RADIO_ID ";
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
	$aa = $_POST['aa'];
	$ab = $_POST['ab'];
	$ac = $_POST['ac'];
	$ad = $_POST['ad'];
	$ba = $_POST['ba'];
	$bb = $_POST['bb'];
	$bc = $_POST['bc'];
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
           VALUES ('".$id."','".$kode."','".$dokter."','".$perawat."','2','".$keterangan."','".$inseq_no."','".$_SESSION['username']."',GETDATE(),'".$harga."')";
          
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
     $sql3 = "INSERT INTO RS_TEMPLAB (MEDIS_ID,RM,NAMA,UMUR,RUANGAN,DOKTER,DETAIL_CODE,NM_TINDAKAN,HASIL,RAWAT,DETAIL_TYPE, SEQ_NO, PASIEN_ID,MODIDATE,SEX)VALUES ('".$id."','".$get_data_pasien['NO_RM']."','".$get_data_pasien['NAME']."',
	 '".$get_data_pasien['UMUR']."','".$nama_poli."','".$nama_dokter."','".$kode."','".$tindakan."','".$keterangan."','Ralan','2',
'".$inseq_no."',
'".$get_data_pasien['PASIEN_ID']."',
GETDATE(),
'".$jk."')";
  $sql4 = "INSERT INTO RS_TEMPRADIOLOGI (
	MEDIS_ID,
	DETAIL_CODE,
	DR_ID,
	PERAWAT_ID,
	DETAIL_TYPE,
	SEQ_NO,
	MODIBY,
	MODIDATE,
	harga,
	ket,
	RM,
	bagian,
	NOFOTO,
	noreg,
	pasien_id,
	nama,
	alamat,
	kv,
	ma,
	s,
	u8x10,
	u11x14,
	ctscan,
	dental
)
VALUES
	(
		'".$id."',
		'".$kode."',
		'".$nama_dokter."',
		'".$perawat."',
		'2',
		'".$inseq_no."',
		'".$_SESSION[' username ']."',
		GETDATE(),
		'".$harga."',
		'".$keterangan."',
		'".$get_data_pasien['NO_RM']."',
		'".$nama_poli."',
		'',
		0,
		'".$get_data_pasien['PASIEN_ID']."',
		'".$get_data_pasien['NAME']."',
		'".$get_data_pasien['ADDRESS']."',
		'".$ba."',
		'".$bb."',
		'".$bc."',
		'".$aa."',
		'".$ab."',
		'".$ac."',
		'".$ad."')";

sqlsrv_query($conn,$sql3);	
sqlsrv_query($conn,$sql4);	



}

?>

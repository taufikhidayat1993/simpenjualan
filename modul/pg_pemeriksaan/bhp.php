<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";

$op=$_GET['op'];
if($op=='detail_obat'){

	$kode_obat=$_POST['kode_obat'];
$sql="
SELECT ITEM_CODE,ITEM_NAME,ITEM_PRICE,
DISCOUNT,PPN,
QTY_STOCK FROM RS_MASTER_ITEM WHERE ITEM_CODE='$kode_obat' ORDER BY ITEM_NAME ";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
	echo" 	<div class='form-group'>
									<label class='control-label col-md-3' >
									Nama Item
										</label>
											<div class='col-md-9'>
											<input type='text' class='form-control' id='nama_obat' value=".$data['ITEM_NAME'].">
											</div>
											</div>
											<div class='form-group'>
									<label class='control-label col-md-3' >
									Jumlah
										</label>
											<div class='col-md-9'>
											<input type='text' class='form-control' id='jumlah_obat'  onKeyUp='jumlah(this.value);' autocomplete='off'>
											<input type='hidden' class='form-control' id='harga_obat' value=".$data['ITEM_PRICE'].">
												<input type='hidden' class='form-control' id='total_obat' readonly >
											</div>
											</div>
								    <div class='form-group'>
									<label class='control-label col-md-3' >
									Aturan
										</label>
											<div class='col-md-9'>
											<textarea class='form-control' id='aturan_pakai' rows='10'>
											".$data['']."
											</textarea>
											</div>
											</div>
											
											";
	
}if($op=='modecari'){
	$opsi=$_POST['opsi'];
	if($opsi==0){
		echo'	<div class="form-group">
									<label class="control-label col-md-3" >
									Kode Item
										</label>
											<div class="col-md-9">
											<input type="text" class="form-control" id="nama_obat" placeholder="Cari Nama Obat" onKeyUp="obat(this.value);">
											 <div class="suggestionsBox3" id="suggestions3" style="display: none;">
				   <div class="suggestionList3" id="suggestionsList3"> &nbsp; </div>
				   <button id="closeobat" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
											</div>
											</div>';
	}else{
		echo"mode2";
	}
}if($op=='inputbhp'){
	$params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$id=$_POST['id'];
	$pasien_id=$_POST['pasien_id'];
	$rawat=$_POST['rawat'];
	$dr_id=$_POST['dr_id'];
	if($rawat=='RJ'){
	

$rowe = sqlsrv_query($conn,$sql1,$params,$options);
$row=sqlsrv_fetch_array($rowe,SQLSRV_FETCH_ASSOC);
$count=sqlsrv_num_rows($rowe);
if($count == 0){
	$seq_no="0001";
    
}else{
	$seq_no=str_pad($row['SEQ_NO']+1, 4, "0", STR_PAD_LEFT);
}
$medis=$id."".$seq_no;
$resepno="RJ".$kodetanggal."".$seq_no;
$sql1="IF EXISTS (
	SELECT
		RESEP_ID
	FROM
		RS_RESEP 
	WHERE
		MEDIS_ID = '$id'
)  SELECT
	MAX (
		SUBSTRING (RESEP_ID, LEN(RESEP_ID) - 3, 4)
	) AS SEQ_NO
FROM
	RS_RESEP 
WHERE
	MEDIS_ID = '$id'
ELSE
	 SELECT
		SUBSTRING (RESEP_ID, LEN(RESEP_ID) - 3, 4) AS SEQ_NO
	FROM
		RS_RESEP 
	WHERE
		MEDIS_ID = '$id'";
		
		$sql3="INSERT INTO RS_RESEP (
	RESEP_ID,
	MEDIS_ID,
	RESEP_NO,
	PASIEN_ID,
  DR_ID,
	TGL_RESEP,
	NOTE,
	RESEP_STATUS,
	MODIBY,
	MODIDATE
)
VALUES
	(
		'".$medis."',
		'".$id."',
		'".$resepno."',
		'".$pasien_id."',
		'".$dr_id."',
		'".$time."',
		'',
		'0',
		'".$_SESSION['nama']."',
		GETDATE()
	)";

if($seq_no == "0001"){
	sqlsrv_query($conn,$sql3,$params,$options);	
}
$sql="select top 1 convert(int,right(resep_no,4)) as nomor from rs_resep where CONVERT(VARCHAR(10),TGL_RESEP,110) = CONVERT(VARCHAR(10),GETDATE(),110) and left(resep_no,2) = 'RJ' and len(resep_no) = 14 order by nomor desc";
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
echo $resepno."|".$medis;
	}
}if($op=='simpan'){
	$medis_id=$_POST['medis_id'];
	$total=$_POST['total'];
	$jumlah=$_POST['jumlah'];
	$item_code=$_POST['item_code'];
	$total=$_POST['total'];
	$aturan=$_POST['aturan'];
	$harga=$_POST['harga'];	
	$resep_id=$_POST['resep_id'];
	$sql="INSERT INTO RS_RESEP_DETAIL (RESEP_ID,ITEM_CODE,JUMLAH,ITEM_PRICE,DISCOUNT,PPN,TOTAL_PRICE,RESEP_TYPE,MODIBY,MODIDATE,note) 
                VALUES ('".$resep_id."','".$item_code."','".$jumlah."','".$harga."','0','0','".$total."','1','".$_SESSION['nama']."',GETDATE(),'".$aturan."')";
	sqlsrv_query($conn,$sql,$params,$options);
echo $sql;
}
if($op == 'tampilresepdetail'){
	$medis_id=$_POST['medis_id'];
	$sql="select A.RESEP_ID,A.RESEP_TYPE,A.TOTAL_PRICE,B.ITEM_NAME,A.ITEM_PRICE,A.NOTE,A.ITEM_CODE,A.JUMLAH from RS_RESEP_DETAIL A JOIN RS_MASTER_ITEM B ON A.ITEM_CODE=B.ITEM_CODE WHERE A.RESEP_ID='".$medis_id."'";
	$data=sqlsrv_query($conn,$sql,$params,$options);
	while($row=sqlsrv_fetch_array($data)){
		echo"<tr onclick='hapus_detail(\"".$row['RESEP_ID']."\",\"".$row['ITEM_CODE']."\")'><td>".$row['ITEM_CODE']."</td><td>".$row['ITEM_NAME']."</td><td>".$row['JUMLAH']."</td><td>".$row['NOTE']."</td></tr>";
	}
	
}if($op == 'hapusdetail'){
$medis_id=$_POST['medis_id'];
$code_item=$_POST['code_item'];
$sql="DELETE FROM RS_RESEP_DETAIL WHERE RESEP_ID='".$medis_id."' AND ITEM_CODE='".$code_item."'";
	sqlsrv_query($conn,$sql,$params,$options);
	
}if($op == 'detailbhp'){
	$id_bhp=$_POST['bhp'];
	$sql="SELECT B.ITEM_NAME,A.JUMLAH,HARGA  FROM BHP_DETAIL A LEFT JOIN RS_MASTER_ITEM B ON A.ITEM_CODE=B.ITEM_CODE WHERE ID_BHP='".$id_bhp."'";
	echo"<table class='table table-striped table-hover'>
	<thead><tr><th>Nama Obat</th><th>Jumlah</th><th>Harga</th></tr></thead>";
	$data=sqlsrv_query($conn,$sql,$params,$options);
	while($row=sqlsrv_fetch_array($data)){
		echo"<tr ><td>".$row['ITEM_NAME']."</td><td>".$row['JUMLAH']."</td><td>".$row['HARGA']."</td></tr>";
	}
	echo"</table>";
	
}if($op == 'simpan_paket'){
	$id_bhp=$_POST['id_bhp'];
	$medis_id=$_POST['medis_id'];
	$sql="SELECT B.ITEM_NAME,A.JUMLAH,A.ITEM_CODE,HARGA  FROM BHP_DETAIL A LEFT JOIN RS_MASTER_ITEM B ON A.ITEM_CODE=B.ITEM_CODE WHERE ID_BHP='".$id_bhp."'";
	echo"<table class='table table-striped table-hover'>
	<thead><tr><th>Nama Obat</th><th>Jumlah</th><th>Harga</th></tr></thead>";
	$data=sqlsrv_query($conn,$sql,$params,$options);
	while($row=sqlsrv_fetch_array($data)){
		$total=$row['JUMLAH']*$row['HARGA'];
		$sql2="INSERT INTO RS_RESEP_DETAIL (RESEP_ID,ITEM_CODE,JUMLAH,ITEM_PRICE,DISCOUNT,PPN,TOTAL_PRICE,RESEP_TYPE,MODIBY,MODIDATE,note) 
                VALUES ('".$medis_id."','".$row['ITEM_CODE']."','".$row['JUMLAH']."','".$row['HARGA']."','0','0','".$total."','1','".$_SESSION['nama']."',GETDATE(),'')";
		sqlsrv_query($conn,$sql2,$params,$options);
	}
	
	
	
}

?>
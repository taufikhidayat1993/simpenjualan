<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
session_start();
$op=$_GET['op'];
if($op=='detailpoli'){
	$dokter=$_POST['gerai'];
		
		$pisah = explode('|',$dokter);
		
		echo"<select id='poli_id'  class='form-control select2me'>";
		
$sql="
		SELECT
rs.RS_POLIKLINIK.POLI_ID,
rs.RS_POLIKLINIK.NAME

FROM
rs.RS_POLIKLINIK";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
										if($pisah[1]==$data['POLI_ID']){
											echo"<option value='$data[POLI_ID]' selected>$data[NAME]</option>";	
										}else{										
									echo"<option value='$data[POLI_ID]'>$data[NAME]</option>";	
										}
										
									}
}
echo"<input type='hidden' id='poli_awal' value='$pisah[1]'>";

		echo"</select>";
}if($op=='propinsi'){
	$id=$_POST['propinsi'];
			
$sql="SELECT
KAB_ID,
NAME
FROM
RS_KABUPATEN WHERE PROP_ID='$id'";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		echo"<option value='$data[KAB_ID]'>$data[NAME]</option>"; 
	}
}
if($op=='kabupaten'){
	$id=$_POST['kabupaten'];
			
$sql="SELECT
KEC_ID,
NAME
FROM
RS_KECAMATAN WHERE KAB_ID='$id'";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		echo"<option value='$data[KEC_ID]'>$data[NAME]</option>"; 
	}
}
if($op=='kecamatan'){
	$id=$_POST['kecamatan'];
			
$sql="SELECT
KEL_ID,
NAME
FROM
RS_KELURAHAN WHERE KEC_ID='$id'";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		echo"<option value='$data[KEL_ID]'>$data[NAME]</option>"; 
	}
}

if($op=='detail_pasien'){
	$id_pasien=$_POST['id_pasien'];
	$sql="	SELECT 
rs.RS_PASIEN.PASIEN_ID,
rs.RS_PASIEN.NO_RM,
rs.RS_PASIEN.NAME,
rs.RS_PASIEN.ADDRESS,
rs.RS_PASIEN.NO_ASURANSI,
rs.RS_PASIEN.ASURANSI_ID,
 CONVERT(VARCHAR(11),TGL_DAFTAR,120) AS TGL_DAFTAR,
rs.RS_PASIEN.ASURANSI_POLIS

FROM
rs.RS_PASIEN WHERE rs.RS_PASIEN.PASIEN_ID='$id_pasien' ";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

$nama=$data['NAME'];
$asuransi=$data['ASURANSI_ID'];;
$asuransi_polis=$data['ASURANSI_POLIS'];
?>
	<script>
	
	$("#cek").bind("click", function(event) {
    // get values
	    var no_asuransi = $("#no_asuransi").val();
	
    // Update the details by requesting to the server using ajax
if (no_asuransi ==''){
	 alert("Tidak Ada Nomor Asuransi");
	  exit();
}else {
    $.post("modul/pg_pendaftaran/service.php", {
            no_asuransi: no_asuransi
        }, function (data, status) {
			var user = JSON.parse(data);
      		 if(user.noKunjungan!=''){
			$("#no_rujukan").val(user.noKunjungan);
		    $("#tgl_rujuk").val(user.tgl_kunjungan);
		
		 }else{
		 	alert("Data Rujukan Tidak Ditemukan");
			 exit();
		 }
	      
        }  );
	}
});

	</script>
	<div class="form-group">
										<label class="control-label col-md-3">Nama Pasien<span class="required">
										 </span>
										</label>
										<div class="col-md-4">
										
											<input type="text" id="nama_pasien" id="nama_pasien" value="<?php echo $nama; ?>"  class="form-control" placeholder="Nama Pasien" readonly>
										</div>
												<label class="control-label col-md-1"  style="text-align:left;">No. RM<span class="required"></label>
											<div class="col-md-3">
									
											<input type="text" id="nama_pasien" id="nama_pasien" value="<?php echo $data['NO_RM']; ?>"  class="form-control" placeholder="Nama Pasien" readonly>
											<input type="text" id="tgl_daftar" value="<?php echo $data['TGL_DAFTAR']; ?>"  class="form-control" placeholder="Nama Pasien" readonly>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Alamat <span class="required">
										</span>
										</label>
										<div class="col-md-4">
											<textarea id="alamat" name="alamat" class="form-control" readonly><?php echo $data['ADDRESS']; ?></textarea></td><td colspan="2">
										</div>
										
									</div>
		<h4 class="form-section"></h4>
										<div class="form-group">
										<label class="control-label col-md-3">ASURANSI ID<span class="required">
										 </span>
										</label>
										<div class="col-md-4">
										<select id="id_asuransi" class="form-control">
										<option value="">--PILIH ASURANSI ID--</option>
										 <?php
										 
										 $sql="	SELECT 
ASURANSI_ID,
NAME
FROM
RS_ASURANSI ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
   while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	   if($asuransi==$data['ASURANSI_ID']){
		   $cek="selected";
	   }else{
		   $cek="";
	   }
		echo"<option value='$data[ASURANSI_ID]' $cek>$data[NAME]</option>"; 
	}

										 ?>
										</select>
											<input type="hidden" value="<?php echo $asuransi; ?> " id="asuransi_awal">
										</div>
												<label class="control-label col-md-1"  style="text-align:left;">NO. ASURANSI<span class="required"></label>
											
											<div class="col-md-3">
									<div class="input-group input-medium">
											<input type="text"  id="no_asuransi" value="<?php echo $asuransi_polis; ?>"  class="form-control" placeholder="NO. ASURANSI">
									<input type="hidden" value="<?php  echo $asuransi_polis; ?>" id="no_asuransi_awal">
									<span class="input-group-btn">
											<button class="btn blue" type="button" id="cek">Cek</button>
											</span></div>	</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">No Rujukan<span class="required">
										</span>
										</label>
										<div class="col-md-4">
														<input type="text" id="no_rujukan" class="form-control" placeholder="No Rujukan">
										</div>
										<label class="control-label col-md-1" style="text-align:left;">Tgl Rujuk <span class="required"></label>
										<div class="col-md-3">
															<input type="text" id="tgl_rujuk"  class="input-group date date-picker form-control" data-date-format="dd-mm-yyyy" placeholder="dd/mm/YYY" >
										</div>
									</div>
	<?php
	
}if($_GET['op']=='tambahpasien'){
	?>
		
	<script type="text/javascript">

	
 $("#add_propinsi").change(function(){
	var propinsi= $("#add_propinsi").val();
    $.post("modul/pg_pendaftaran/crud.php?op=propinsi", {
          	propinsi : propinsi
        },
        function (data, status) {			
		$("#add_kabupaten").html(data).show();  
			$("#add_kecamatan").html("<option value='' selected>Pilih Kecamatan</option>");
			$("#add_kelurahan").html("<option value='' selected>Pilih Kelurahan</option>");
        }  );
});
 $("#add_kabupaten").change(function(){
	var kabupaten= $("#add_kabupaten").val();
    $.post("modul/pg_pendaftaran/crud.php?op=kabupaten", {
          	kabupaten : kabupaten
        },
        function (data, status) {			
		$("#add_kecamatan").html(data).show();  
		$("#add_kelurahan").html("<option value=''>Pilih Kelurahan</option>");
        }  );
});
 $("#add_kecamatan").change(function(){
	var kecamatan= $("#add_kecamatan").val();
    $.post("modul/pg_pendaftaran/crud.php?op=kecamatan", {
          	kecamatan : kecamatan
        },
        function (data, status) {			
		$("#add_kelurahan").html(data).show();  
        }  );
});
</script>
													
	<?PHP
								
$sql="	SELECT 
RM
FROM
RM ";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
?>
	<input type="text" id="add_no_rm" value="<?php echo CheckKey($data['RM']); ?>"   class="form-control" placeholder="Nomor Rekam Medis" readonly>
<?php
}if($_GET['op']=='asuransi'){
	if($_POST['data']==1){
	
$sql="	SELECT 
ASURANSI_ID,
NAME
FROM
RS_ASURANSI ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
?>
	<div class="form-group">
										<label class="control-label col-md-4">Asuransi<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_asuransi" class="form-control select2me">
									<option value="">--Pilih Asuransi--</option>
									<?php
									 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	                 echo"<option value='$data[ASURANSI_ID]'>$data[NAME]</option>";
					  }
									?>
									</select>
										</div>
												
									</div>
									<div class="form-group">
									<label class="control-label col-md-4"  >No Asuran</label>
											<div class="col-md-8">
									<input type="text" id="no_asuransi"   class="form-control" placeholder="No Asuransi" >
										</div>
									</div>
<?php

	}else{
		echo"";
	}
}if($_GET['op']=='cek_umur'){
	$tgl=$_POST['tgl_lahir'];
	$data=$_POST['data'];
	if($data==1){
	echo umur($tgl);
	  $pisah = explode(' ',umur($tgl));
	  echo"<input type='hidden' class='form-control' id='add_umur' placeholder='Usia' value='$pisah[0]'>";
	}else{
		echo"<input type='text' class='form-control' id='add_umur' onkeyup='umur(this.value);' placeholder='Usia'>";
	}
	?>
	
		<?php	
}if($_GET['op']=='hitungusia'){
	$usia=$_POST['usia'];
	$tgl_skrg;
	$bln_sekarang;
	$thn_sekarang;
$tahun=$thn_sekarang-$usia;
echo $tgl_skrg."/".$bln_sekarang."/".$tahun;
}if($_GET['op']=='tambahpasienbaru'){
	    $add_no_rm = $_POST['no_rm'];
	  $nama_pasien= $_POST['nama_pasien'];
	   $tgl_lahir=ubahformatTgl($_POST['tgl_lahir']);
	   $umur=$_POST['umur'];
	   $hp=$_POST['hp'];
	   $alamat=$_POST['alamat'];
	   $jk  = $_POST['jk'];
	   $kode_pos=$_POST['kode_pos'];
	   $propinsi=$_POST['propinsi'];
	   $kabupaten=$_POST['kabupaten'];
	   $kecamatan=$_POST['kecamatan'];
	   $kelurahan=$_POST['kelurahan'];
	   $tipe_pasien=$_POST['tipe_pasien'];	   
	   $asuransi=$_POST['asuransi'];
	   $no_asuransi=$_POST['no_asuransi'];
	   $drm=$_POST['drm'];
	   if($tipe_pasien=='option1'){
		   $tipe=1;
	   }else{
		   $tipe=3;
	   }
	   $sql="SP_SAVE_PASIEN		
		'$add_no_rm',
		'$drm',
		'$tipe',
		'$nama_pasien',
		'dd',
		'$asuransi',
		'',
		'$alamat',
		'$propinsi',
		'$kabupaten',
		'$kecamatan',
		'$kelurahan',
		'$kode_pos',
		'Rembang',
		'$tgl_lahir',
		'$jk',
		'1',
		'$hp',
		'$hp',
		'$email',
		'$darah',
		'20',
		'20',
		'$umur',
		'AG00',
		'RA00',
		'PD01',
		'18',
		'$wn',
		'$ayah',
		'$ibu',
		'$pasangan',
		'1',
		'$no_asuransi',
		'$_SESSION[nama]'";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$cek="SELECT PASIEN_ID FROM RS_PASIEN WHERE UPPER(NAME)='$nama_pasien' AND CONVERT(Varchar(10),TGL_LAHIR,101)='$_POST[tgl_lahir]'";
$cekrm="SELECT PASIEN_ID FROM RS_PASIEN WHERE NO_RM='$add_no_rm'";

$data=sqlsrv_query( $conn, $cek , $params, $options );
$row_count = sqlsrv_num_rows($data);
$count_rm = sqlsrv_num_rows($data);
echo $row_count;
if($count_rm > 0){
	echo "2,".CheckKey($add_no_rm);
}else{
if($row_count==0){
	sqlsrv_query($conn,$sql,$params,$options);
	echo "0","";

}else{
		echo "1","";
}
}
}if($_GET['op']=='tambahpendaftaran'){
	$tgl_daftar=$_POST['tgl_daftar'];
	    $pasien_id = $_POST['pasien'];
	    $dokter=$_POST['dokter'];
		$dr=explode('|',$dokter);
		$poli_id=$_POST['poli'];
		$rujukan_id=$_POST['rujukan_id'];
		$rujukan_data_id=$_POST['rujukan_data_id'];
		$no_rujukan=$_POST['no_rujukan'];
		if($_POST['tgl_rujuk']==''){
		$tgl_rujuk="";
		}else{
			$tgl_rujuk=ubahformatTgl($_POST['tgl_rujuk']);
			
		}
		$no_asuransi_awal=$_POST['no_asuransi_awal'];
		$asuransi_awal=$_POST['asuransi_awal'];
		$poli_awal=$_POST['poli_awal'];
		$medis_id=$pasien_id."".$med."".$jam1;
		$hasilan=strlen($medis_id);
		$satu = substr($medis_id, $hasilan-2, $hasilan);
		$tgl=explode(' ',$_POST['tgl_periksa']);
		$tgl_periksa=ubahformatTgl($tgl[0]);
		$jam_periksa=$tgl[1];
		if($tgl==$tgl_daftar){
			$der="update RS_PASIEN SET TGL_DAFTAR='".$tgl[0]."' where PASIEN_ID=' $pasien_id'";
			$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
sqlsrv_query($conn,$der,$params,$options);
		}
$dua = substr($medis_id, 0, $hasilan-2);
$sql2="SELECT PASIEN_ID FROM RS_PASIEN_MEDIS   WHERE PASIEN_ID='$pasien_id' AND POLI_ID='$poli_id' AND CONVERT(VARCHAR(11),DATETIME_MEDIS,103) ='$tgl_sekarang1' ";
$sqli="SELECT MEDIS_ID FROM RS_PASIEN_MEDIS  WHERE MEDIS_ID='$medis_id'";
  $sql="INSERT INTO RS_PASIEN_MEDIS (MEDIS_ID,MEDIS_TRX_TYPE,DR_ID,PASIEN_ID,POLI_ID,
                   RUJUKAN_ID,RUJUKAN_DATA_ID,
                   MEDIS_TYPE,STATUS_BAYAR,MODIBY,DATETIME_MEDIS,MODIDATE,ANTRIAN,NORUJUKAN, TGLRUJUKAN)
				   VALUES ('$medis_id','1','$dr[0]','$pasien_id','$poli_id','$rujukan_id','','1','0','$_SESSION[nama]','$tgl_periksa $jam_periksa','$tgl_sekarang2 $jam_sekarang','','$no_rujukan','$tgl_rujuk')";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$count=sqlsrv_query($conn,$sqli,$params,$options);
$row_count = sqlsrv_num_rows($count);
$row_count3 = sqlsrv_num_rows(sqlsrv_query($conn,$sql2,$params,$options));
if($row_count3>0){
	echo "3 ";
}else{
if($row_count > 0){
	
	$medis_id=$satu."".$dua+1;
echo "1 $medis_id";
}else {
	if($asuransi_awal!=$rujukan_id){
		sqlsrv_query( $conn,"update RS_PASIEN SET ASURANSI_ID='$rujukan_id',ASURANSI_POLIS='$rujukan_data_id' WHERE PASIEN_ID='$pasien_id'" , $params, $options );
	}else if($poli!=$poli_id){
		sqlsrv_query( $conn,"update RS_DOKTER SET POLI_ID='$poli_id' WHERE DR_ID='$dr[0]'" , $params, $options );
	}
	sqlsrv_query($conn,$sql,$params,$options);
	$antri=sqlsrv_query($conn,"select antrian from rs_pasien_medis where medis_id ='$medis_id'", $params, $options );
	$data=sqlsrv_fetch_array($antri,SQLSRV_FETCH_ASSOC);

		echo "0 $data[antrian]";
}
}
}if($op=='edit_pasien'){
	$nama_pasien=$_POST['nama_pasien'];
	$tgl_lahir=ubahformatTgl($_POST['tgl_lahir']);
	$tempat_lahir=$_POST['tempat_lahir'];
	$telepon=$_POST['telepon'];
	$hp=$_POST['hp'];
	$no_identitas=$_POST['no_identitas'];
	$jk=$_POST['jk'];  
	$status=$_POST['status'];  
	$alamat=$_POST['alamat']; 
	$kode_pos=$_POST['kode_pos'];
	$propinsi=$_POST['propinsi'];
	$kabupaten=$_POST['kabupaten'];
	$kecamatan=$_POST['kecamatan'];
	$kelurahan=$_POST['kelurahan'];
	$tipe_pasien=$_POST['tipe_pasien'];
	$agama=$_POST['agama'];
	$ras=$_POST['ras'];
	$pendidikan=$_POST['pendidikan'];
	$pekerjaan=$_POST['pekerjaan'];
	$warga_negara=$_POST['warga_negara'];
	$ayah=$_POST['ayah'];
	$ibu=$_POST['ibu'];
	$pasangan=$_POST['pasangan'];
	$asuransi=$_POST['asuransi'];
	$no_asuransi=$_POST['no_asuransi'];
	$berat=$_POST['berat']; 
	$tinggi=$_POST['tinggi'];
	$gol_darah=$_POST['gol_darah'];
	$pasien_id=$_POST['pasien_id'];
	
	$sql= "update RS_PASIEN SET 
	NAME='$nama_pasien',
	TIPE_PASIEN='$tipe_pasien',
	ADDRESS='$alamat',
	PROP_ID='$propinsi',
	KAB_ID='$kabupaten',
	KEC_ID='$kecamatan',
	KEL_ID='$kelurahan',
	POSTCODE='$kode_pos',
	TEMPAT_LAHIR='$tempat_lahir',
	TGL_LAHIR='$tgl_lahir',
	GOL_DARAH='$gol_darah',
	BERAT='$berat',
	TINGGI='$tinggi',
	AGAMA_ID='$agama',
	STATUS_KAWIN='$status',
	GENDER='$jk',
	PASANGAN='$pasangan',
	WARGA_NEGARA='$warga_negara',
	NAMA_AYAH='$ayah',
	NAMA_IBU='$ibu',
	PEND_ID='$pendidikan',
	RAS_ID='$ras',
	TELEPHONE='telepon',
	MOBILE='$hp',
	EMAIL='$no_identitas',
	ASURANSI_ID='$asuransi',
	ASURANSI_POLIS='$no_asuransi'
	where PASIEN_ID='$pasien_id'
	";
	$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
sqlsrv_query($conn,$sql,$params,$options);
echo $sql;
}
?>


<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
session_start();
$id=$_POST['id'];
$sql="SELECT
PASIEN_ID,
NO_RM,
TIPE_PASIEN,
DR_ID,
NAME,
FAMILY_NAME,
ADDRESS,
PROP_ID,
KAB_ID,
KEC_ID,
KEL_ID,
POSTCODE,
TEMPAT_LAHIR,
 CONVERT(VARCHAR(11),TGL_LAHIR,103) AS TGL_LAHIR,
UMUR,
GOL_DARAH,
BERAT,
TINGGI,
AGAMA_ID,
GENDER,
STATUS_KAWIN,
PASANGAN,
WARGA_NEGARA,
NAMA_AYAH,
NAMA_IBU,
PEND_ID,
PEK_ID,
RAS_ID,
TELEPHONE,
MOBILE,
EMAIL,
TGL_DAFTAR,
ASURANSI_ID,
PRSH_ID,
KELAS_ASURANSI,
JENIS_ANGGOTA,
NO_ASURANSI,
ASURANSI_TYPE_ID,
ASURANSI_INFO,
ASURANSI_PARENT,
ASURANSI_POLIS,
RM_POS,
MODIBY,
MODIDATE,
STATUS_RM,
STATUS_DRM,
STATUS_DAFTAR,
ALERGI
FROM
RS_PASIEN WHERE PASIEN_ID='$id'";

$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
?>
<div class="scroller" data-always-visible="1" data-rail-visible1="1">
<div class="row">
<form action="#" id="form_sample_1" class="form-horizontal">
<div class="row">
<div class="col-md-8">
<div class="row">
<div class="col-md-6">
										<div class="form-group">
		<label class="control-label col-md-4" >No. RM<span class="required"></label>
											<div class="col-md-8" >
										<input type="hidden" id="pasien_id" value="<?php echo $id; ?>">
										<input type="text" value="<?php echo $data['NO_RM']; ?>" readonly>
											
											</div>
										</div>
		
										<div class="form-group">
										<label class="control-label col-md-4">Nama <span class="required" >*
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" value="<?php echo $data['NAME']; ?>" >
										</div>
										
									</div>
										<div class="form-group">
										<label class="control-label col-md-4">Tipe<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<div class="radio-list">
												<label >
											<input type="radio" name="tipe"  id="umum"  value="1"

<?php if($data['TIPE_PASIEN']==1){
	echo "checked";
}			
?>							 onclick="javascript:yesnoCheck();" >Umum</label>
												<label >
												<input type="radio" name="tipe"  id="asuransi"  value="3" 
<?php if($data['TIPE_PASIEN']==3){
	echo "checked";
}		
?>	 onclick="javascript:yesnoCheck();" >						 Asuransi/Perusahaan</label>
		
												
											</div>
										</div>
										
									</div>
									<?php if($data['TIPE_PASIEN']==3){
										?>
										<span id="view_asuransi" >
									<div class="form-group">
										<label class="control-label col-md-4">ASURANSI ID<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
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
   while($data6=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	   if($data6['ASURANSI_ID']==$data['ASURANSI_ID']){
		   $cek="selected";
	   }else{
		   $cek="";
	   }
		echo"<option value='$data6[ASURANSI_ID]' $cek>$data6[NAME]</option>"; 
	}

										 ?>
										</select>
											<input type="hidden" value="<?php echo $asuransi; ?> " id="asuransi_awal">
										</div>
										</DIV>
									<div class="form-group">
										<label class="control-label col-md-4">No. Asuransi<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="no_asuransi" value="<?php echo $data['ASURANSI_POLIS']; ?>"   class="form-control" placeholder="NO ASURANSI" >
										</div>
										
									</div>	
										</span>
										<?php
									}else{
										?>
											<span id="view_asuransi" style="display:none;">
									<div class="form-group">
										<label class="control-label col-md-4">ASURANSI ID<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
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
   while($data6=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 
		echo"<option value='$data6[ASURANSI_ID]' $cek>$data6[NAME]</option>"; 
	}

										 ?>
										</select>
											<input type="hidden" value="<?php echo $asuransi; ?> " id="asuransi_awal">
										</div>
										</DIV>
									<div class="form-group">
										<label class="control-label col-md-4">No. Asuransi<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="no_asuransi" value="<?php echo $data['ASURANSI_POLIS']; ?>"   class="form-control" placeholder="NO ASURANSI" >
										</div>
										
									</div>	
										</span>
										<?
									}
									?>
								
										<div class="form-group">
										<label class="control-label col-md-4">Alamat <span class="required">*
										</span>
										</label>
										<div class="col-md-8">
											<textarea id="alamat" name="alamat" class="form-control" ><?php echo $data['ADDRESS']; ?></textarea></td><td colspan="2">
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Kode Pos<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="kode_pos"   class="form-control" placeholder="Nama Pasien" value="<?php echo $data['POSTCODE']; ?>">
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Propinsi<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
										<option value="">--Pilih Propinsi--</option>
									<?php
$sql="	SELECT 
PROP_ID,
NAME
FROM
RS_PROPINSI ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($dataku=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($data['PROP_ID']==$dataku['PROP_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	                 echo"<option value='$dataku[PROP_ID]' $cek>$dataku[NAME]</option>";
					  }
		
									?>
									
									</select>
										</div>
										</div>
											<div class="form-group">
										<label class="control-label col-md-4">Kabupaten<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_kabupaten" class="form-control select2me">
										<?php
$sql="	SELECT 
KAB_ID,
NAME
FROM
RS_KABUPATEN WHERE PROP_ID='$data[PROP_ID]' ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($data2=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($data2['KAB_ID']==$data['KAB_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	                 echo"<option value='$data2[KAB_ID]' $cek>$data2[NAME]</option>";
					  }
		
									?>
</select>
</div>
</div>	
<div class="form-group">
										<label class="control-label col-md-4">Kecamatan<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_kecamatan" class="form-control select2me">
<?php
$sql="	SELECT 
KEC_ID,
NAME
FROM
RS_KECAMATAN WHERE KAB_ID='$data[KAB_ID]' ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($data3=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($data3['KEC_ID']==$data['KEC_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	 echo"<option value='$data3[KEC_ID]' $cek>$data3[NAME]</option>";
					  }
?>
</select>
</div>
</div>
<div class="form-group">
										<label class="control-label col-md-4">Kelurahan<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_kelurahan" class="form-control select2me">
									<?php
$sql="	SELECT 
KEL_ID,
NAME
FROM
RS_KELURAHAN WHERE KEC_ID='$data[KEC_ID]' ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($data4=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($data4['KEL_ID']==$data['KEL_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	 echo"<option value='$data4[KEL_ID]' $cek>$data4[NAME]</option>";
					  }
?>
                                    </select>
</div>
</div>	
									
									
									</div>
									<div class="col-md-6">
										<div class="form-group">
										<label class="control-label col-md-4">Tgl. Lahir<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
										
											<div class="input-group">
											<span class="input-group-addon">
											<input type="checkbox" id="cek_umur" name="cek_umur" checked>
											</span>
											<div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
												<input type="text" class="form-control date-picker" name="datepicker" id="add_tgl_lahir" value="<?php echo $data['TGL_LAHIR'];?>">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
												</div>
											</div>
										<span id="view_umur" style="padding-top:4px;">
											<?php echo umur($data['TGL_LAHIR']); ?>
											</span>
										</div>
											
											
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tpt Lahir <span class="required">*
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="tempat_lahir"   class="form-control" placeholder="Nama Pasien" value="<?php echo $data['TEMPAT_LAHIR']; ?>">
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Telepon <span class="required">*
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="telepon"  class="form-control" placeholder="Nama Pasien" value="<?php echo $data['TELEPHONE']; ?>">
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">HP <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="hp"   class="form-control" placeholder="Nama Pasien" <?php echo $data['MOBILE']; ?> >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">No. Identitas<span class="required">*
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="no_identitas"   class="form-control" placeholder="Nama Pasien" value="<?php echo $data['EMAIL']; ?>" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Jenis Kelamin 
										</label>
										<div class="col-md-8">
										<div class="radio-list">
									
											<label class="radio-inline">
											<input type="radio" name="jk" id="laki-laki" value="1" <?php
 if($data['GENDER']==1){
	echo"checked";
}	
?>	> Laki-laki </label>
												<label class="radio-inline">
												<input type="radio" name="jk" id="perempuan" value="2"  <?php
 if($data['GENDER']==2){
	echo"checked";
}	
?>	> Perempuan </label>
									
												
											</div>
										</div>
										
									</div>
										<div class="form-group">
									<label class="control-label col-md-4" >Status<span class="required"></label>
											<div class="col-md-8">
									
											<div class="radio-list">
										
												<input type="radio" name="status"  value="0"
<?php
 if($data['STATUS_KAWIN']==0){
	echo"checked";
}else{
	echo"";
}	
?>											> Single </label>
													<label >
												<input type="radio" name="status"  value="1" <?php
 if($data['STATUS_KAWIN']==1){
	echo"checked";
}	
?>	> Menikah </label>
												<label >
												<input type="radio" name="status"  value="2" <?php
 if($data['STATUS_KAWIN']==2){
	echo"checked";
}	
?>	>Menikah/Janda</label>
											
											
											</div>
										</div>
									</div>
									
	<h5 class="form-section">Data Medis ::::::::</h5>
		
								<div class="form-group">
										<label class="control-label col-md-4">Berat<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="berat"  value="<?php echo $data['BERAT']; ?>"  class="form-control" placeholder="Nama Pasien" >
										</div>
										
										
									</div>
									<div class="form-group">
									<label class="control-label col-md-4">Tinggi<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="tinggi" value="<?php echo $data['TINGGI']; ?>"   class="form-control" placeholder="Nama Pasien" >
										</div>
										</div>
										<div class="form-group">
									<label class="control-label col-md-4">Gol. Darah<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<select class="form-control" id="gol_darah">
										
											<option value="NONE" <?php 
											
										if($data['GOL_DARAH']=='NONE'){
											echo"selected";
										}else{
											echo"";
										}
											?>>NONE</option>
											<option value="O" <?php 
											
										if($data['GOL_DARAH']=='O'){
											echo"selected";
										}else{
											echo"";
										}
											?>>O</option>
											<option value="A" <?php 
											
										if($data['GOL_DARAH']=='A'){
											echo"selected";
										}else{
											echo"";
										}
											?>>A</option>
											<option value="B" <?php 
											
										if($data['GOL_DARAH']=='B'){
											echo"selected";
										}else{
											echo"";
										}
											?>>B</option>
											<option value="AB" <?php 
											
										if($data['GOL_DARAH']=='AB'){
											echo"selected";
										}else{
											echo"";
										}
											?>>AB</option>
											</select>
										</div>
										</div>
													
									</div>
									</div>
									<div class="row">
									<div class="col-md-6">
							
								</div>
									
									</div>
									</div>
									<div class="col-md-4">
								<div class="form-group">
										<label class="control-label col-md-4">Agama<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="edit_agama" class="form-control select2me">
<?php
$sql="	SELECT 
AGAMA_ID,
NAME
FROM
RS_AGAMA ORDER BY NAME ASC ";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($agama=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($agama['AGAMA_ID']==$data['AGAMA_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	 echo"<option value='$agama[AGAMA_ID]' $cek>$agama[NAME]</option>";
					  }
?>
</select>
</div>
</div>	
<div class="form-group">
										<label class="control-label col-md-4">RAS<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="edit_ras" class="form-control select2me">
									<?php
$sql="SELECT 
RAS_ID,
NAME
FROM
RS_RAS ORDER BY NAME ASC ";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($ras=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($ras['RAS_ID']==$data['RAS_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	 echo"<option value='$ras[RAS_ID]' $cek>$ras[NAME]</option>";
					  }
?>
                                    </select>
</div>
</div>
<div class="form-group">
										<label class="control-label col-md-4">Pendidikan<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="edit_pendidikan" class="form-control select2me">
											<?php
$sql="SELECT 
PEND_ID,
NAME
FROM
RS_PENDIDIKAN ORDER BY NAME ASC ";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($pend=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($pend['PEND_ID']==$data['PEND_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	 echo"<option value='$pend[PEND_ID]' $cek>$pend[NAME]</option>";
					  }
?>
    
                                    </select>
</div>
</div>
<div class="form-group">
										<label class="control-label col-md-4">Pekerjaan<span class="required">*
										 </span>
										</label>
										<div class="col-md-8">
									<select id="edit_pekerjaan" class="form-control select2me">
									<?php
$sql="SELECT 
PEK_ID,
NAME
FROM
RS_PEKERJAAN ORDER BY NAME ASC ";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($pek=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($pek['PEK_ID']==$data['PEK_ID']){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	 echo"<option value='$pek[PEK_ID]' $cek>$pek[NAME]</option>";
					  }
?>
                                    </select>
</div>
</div>	

									<div class="form-group">
										<label class="control-label col-md-4">Warga Negara <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="warga_negara"   class="form-control" value="<?php echo $data['WARGA_NEGARA']; ?>"placeholder="Warga Negara" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Nama Ayah<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text"  id="nama_ayah"   class="form-control" value="<?php echo $data['NAMA_AYAH']; ?>" placeholder="Nama Ayah" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Nama Ibu <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_ibu"   class="form-control" value="<?php echo $data['NAMA_IBU']; ?>" placeholder="Nama Ibu" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Suami/Istri<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="suami_istri" value="<?php echo $data['PASANGAN']; ?>"   class="form-control" placeholder="Suami/Istri" >
										</div>
										
									</div>	
										<div class="note note-success">								
								<h4 class="block">Upload File Data Sosial</h4>
									<div class="form-group">
										<label class="control-label col-md-4">Kartu BPJS :<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<div  id="cek_bpjs"></div>
										</div>
										
									</div>	
									<div class="form-group">
										<label class="control-label col-md-4">KTP :<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<div  id="cek_ktp"></div>
										</div>
										
									</div>	
									<div class="form-group">
										<label class="control-label col-md-4">Kartu Keluarga :<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<div  id="cek_kk"></div>
										</div>
										
									</div>	
								</div>
								
									</div>
									</div>
									
									</form>
									</div>
									
										<div id="viewhasil">
										</div>
										</div>
								
									
										<script type="text/javascript">
	
 $("#add_propinsi").change(function(){
	var propinsi= $("#add_propinsi").val();
    $.post("modul/pg_pendaftaran/crud.php?op=propinsi", {
          	propinsi : propinsi
        },
        function (data, status) {			
		$("#add_kabupaten").html(data).show();  
			        }  );
});
 $("#add_kabupaten").change(function(){
	var kabupaten= $("#add_kabupaten").val();
    $.post("modul/pg_pendaftaran/crud.php?op=kabupaten", {
          	kabupaten : kabupaten
        },
        function (data, status) {			
		$("#add_kecamatan").html(data).show();  
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
$('#cek_umur').click(function()
{
var tgl_lahir =$("#add_tgl_lahir").val();
   if ($(this).is(':checked'))
    {
		var data=1
          $.post("modul/pg_pendaftaran/crud.php?op=cek_umur", {
            data: data,
			tgl_lahir:tgl_lahir
        }, function (data, status) {
			$("#view_umur").html(data).show(); 
	     
        }  );
       
    }
    //If checkbox is unchecked then disable or enable input
    else
    {

     var 		data=0;
          $.post("modul/pg_pendaftaran/crud.php?op=cek_umur", {
            data: data,
			tgl_lahir:tgl_lahir
        }, function (data, status) {
			$("#view_umur").html(data).show(); 
	     
        }  ); 
    }
});
function umur(usia){
		$.post("modul/pg_pendaftaran/crud.php?op=hitungusia", {usia: ""+usia+""}, function(data, status){
			if(data.length >0) {
				$("#add_tgl_lahir").val(data);
			}
		});
	
}function umur(usia){
		$.post("modul/pg_pendaftaran/crud.php?op=hitungusia", {usia: ""+usia+""}, function(data, status){
			if(data.length >0) {
				$("#add_tgl_lahir").val(data);
			}
		});
	
}
$("#simpan_pasien").bind("click", function(event) {
	   var pasien_id = $("#pasien_id").val();
       var nama_pasien = $("#nama_pasien").val();
	   var tgl_lahir = $("#add_tgl_lahir").val();
	   var tempat_lahir= $("#tempat_lahir").val();
	   var telepon= $("#telepon").val();
	   var hp= $("#hp").val();
	   var no_identitas=$("#no_identitas").val();
	   var jk  = $('input[name=jk]:checked').val();
	   var status  = $('input[name=status]:checked').val();
	   var alamat  = $("#alamat").val();
	   var kode_pos=$("#kode_pos").val();
	   var propinsi=$("#add_propinsi").val();
	   var kabupaten=$("#add_kabupaten").val();
	   var kecamatan=$("#add_kecamatan").val();
	   var kelurahan=$("#add_kelurahan").val();
	   var tipe_pasien=$('input[name=tipe]:checked').val();
	   var agama=$("#edit_agama").val();
	   var ras=$("#edit_ras").val();
	   var pendidikan=$("#edit_pendidikan").val();
	   var pekerjaan=$("#edit_pekerjaan").val();
	   var warga_negara=$("#warga_negara").val();
	   var ayah=$("#nama_ayah").val();
	   var ibu=$("#nama_ibu").val();
	   var pasangan=$("#suami_istri").val();
	   var asuransi=$("#id_asuransi").val();
	   var no_asuransi=$("#no_asuransi").val();
	   var berat= $("#berat").val();
	   var tinggi= $("#tinggi").val();
	   var gol_darah= $("#gol_darah").val();
       
	   if(nama_pasien==''){
		   alert("Nama Pasien Harus Diisi");
		   $("#nama_pasien").focus();
		   exit();
	   }else if(telepon==''){
		   alert("Nomor Telepon Harus Diisi");
		   $("#telepon").focus();
		   exit();
	   }else if(tgl_lahir==''){
		   alert("Tanggal Lahir Harus Diisi");
		   $("#add_tgl_lahir").focus();
		   exit();
	   }else if(tempat_lahir==''){
		   alert("Tempat Lahir Harus Diisi");
		   $("#tempat_lahir").focus();
		   exit();		   
	   }else if(propinsi==''){
		   alert("Nama Provinsi Harus Diisi");
		   exit();		   
	   }else if(kabupaten==''){
		   alert("Nama Kabupaten Harus Diidi");
		   exit();
	   }else if(kecamatan==''){
		   alert("Nama Kecamatan Harus Diisi");
		   exit();
	   }else if(kelurahan==''){
		   alert("Nama Kelurahan Harus Diisi");
		   exit();
	   }else if(agama==''){
		   alert("Agama Harus Diisi");
		   exit();
		}else if(ras==''){
		   alert("Ras Harus Diisi");
		   exit();
	   }else if(pendidikan==''){
		      alert("Pendidikan Harus Diisi");
		   exit();
	   }else if(pekerjaan==''){
		         alert("Pekerjaan Harus Diisi");
		   exit();
	   }else{

    $.post("modul/pg_pendaftaran/crud.php?op=edit_pasien", {
    pasien_id: pasien_id,
    nama_pasien: nama_pasien,
	tgl_lahir: tgl_lahir,
	tempat_lahir: tempat_lahir,
	telepon: telepon,
	hp: hp,
	no_identitas: no_identitas,
	jk: jk,  
	status:status,  
	alamat:alamat, 
	kode_pos:kode_pos,
	propinsi:propinsi,
	kabupaten:kabupaten,
	kecamatan:kecamatan,
	kelurahan:kelurahan,
	tipe_pasien:tipe_pasien,
	agama:agama,
	ras:ras,
	pendidikan:pendidikan,
	pekerjaan:pekerjaan,
	warga_negara:warga_negara,
	ayah:ayah,
	ibu:ibu,
	pasangan:pasangan,
	asuransi:asuransi,
	no_asuransi:no_asuransi,
	berat:berat, 
	tinggi:tinggi,
	gol_darah:gol_darah
        }, function (data, status) {
			alert("Data Pasien Berhasil Disimpan");
			 $("#responsive2").modal("hide");
			 exit();
	     
        }  );
	   }
	
});
function yesnoCheck() {
    if (document.getElementById('asuransi').checked) {
			$("#view_asuransi").show(); 
    } else if(document.getElementById('umum').checked) {
		$("#view_asuransi").hide(); 
    }
}

</script>
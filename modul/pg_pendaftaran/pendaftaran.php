 <script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
		 $("#id_dokter").change(function(){
	var gerai= $("#id_dokter").val();
    $.post("modul/pg_pendaftaran/crud.php?op=detailpoli", {
			gerai : gerai
        },
        function (data, status) {			
		$("#data_dokter").html(data).show();  
		 $("#cari_pasien").focus();
        }  );
});
	$("#caridata").change(function(){
	 var cari = $("#cari").val();
	 var tanggal  = $('input[name=tanggal]:checked').val();
	 var input_cari = $('#form_cari').val();
	 var id_poli= $("#poliklinik").val();
	 var dokter = $("#id_dokter").val();
	 var form_tanggal= $("#form_tanggal").val();
if(cari==''){
	alert("cari masih kosong");
}else{	 
    $.post("modul/pg_daftarrawatjalan/crud.php?op=detailpoli", {
			poli : id_poli,
			dokter : dokter,
			form_tanggal: form_tanggal
	}, function (data, status) {			
		$("#data").html(data).show();  
        }  );
	}
	
});
$("#simpan").bind("click", function(event) {
    // get values
	    var pasien = $("#pasien_id").val();
	    var dokter=$("#id_dokter").val();
		var poli_id=$("#poli_id").val();
		var rujukan_id=$("#id_asuransi").val();
		var rujukan_data_id=$("#no_asuransi").val();
		var no_rujukan=$("#no_rujukan").val();
		var tgl_rujuk=$("#tgl_rujuk").val();
		var tgl_periksa=$("#tgl_periksa").val();
		var asuransi_awal=$("#asuransi_awal").val();
		var no_asuransi_awal=$("#no_asuransi_awal").val();
		var poli_awal=$("#poli_awal").val();
		  var tgl_daftar= $("#tgl_daftar").val();
    // Update the details by requesting to the server using ajax
if(dokter ==''){
	alert("Masukkan Nama Dokter");
	exit();
}else if(pasien ==''){
	alert("Masukkan Data Pasien");
	$("#cari_pasien").focus();
	exit();
}else{
    $.post("modul/pg_pendaftaran/crud.php?op=tambahpendaftaran", {
            pasien: pasien,
			dokter: dokter,
			rujukan_id: rujukan_id,
			rujukan_data_id: rujukan_data_id,
			no_rujukan: no_rujukan,
			tgl_rujuk: tgl_rujuk,
			poli: poli_id,
			tgl_periksa:tgl_periksa,
			asuransi_awal: asuransi_awal,
			no_asuransi_awal: no_asuransi_awal,
			tgl_daftar:tgl_daftar,
			poli_awal:poli_awal			
        }, function (data, status) {
		var confirm=data.split(' ');
		if(confirm[0]==1){
			alert("Nomor Medis ID SUDAH ADA");
		}else if(confirm[0]==3){
			alert("Data Pasien Medis Sudah Ada");
		}else{
			alert("Data Berhasil Disimpan dengan Nomor Antrian "+confirm[1]);
			 $("#data_dokter").hide();
			  $("#detail_pasien").hide();
			  $("#cari_pasien").val("");
			document.getElementById('id_dokter').selectedIndex = -1;
			$('#select2-chosen-1').html("Pilih Nama Dokter");
			 $("#pasien_id").val("");
			 $("#id_dokter").val("");
		}
	       /*$("#showerror").html(data).show(); */
        }  );
}
	
});
	$("#tambahpasienbaru").bind("click", function(event) {
	   var add_no_rm = $("#add_no_rm").val();
	   var nama_pasien= $("#add_nama_pasien").val();
	   var add_tgl_lahir= $("#add_tgl_lahir").val();
	   var add_umur=$("#add_umur").val();
	   var add_hp=$("#add_hp").val();
	   var alamat=$("#alamat").val();
	   var jk  = $('input[name=jk]:checked').val();
	   var kode_pos=$("#add_kode_pos").val();
	   var propinsi=$("#add_propinsi").val();
	   var kabupaten=$("#add_kabupaten").val();
	   var kecamatan=$("#add_kecamatan").val();
	   var kelurahan=$("#add_kelurahan").val();
	   var tipe_pasien=$('input[name=tipe_pasien]:checked').val();
var cek_drm =document.getElementById("drm").value;
	   var asuransi=$("#add_asuransi").val();
	   var no_asuransi=$("#no_asuransi").val();
	  var hasil_drm=$("#hasil_drm").val();
	   if($(this).is('input[name=cek_umur]:checked')){
		  var ceki=1;			   
		   }else{
			   var ceki=0;
		   }
	   if(add_no_rm==''){
		  alert("No Rekam Medis Harus Diisi");		  	
		   $("#add_no_rm").focus();	
		      exit();
	   }else if(nama_pasien==''){
		   alert("Masukkan Nama Pasien");
		   	$("#add_nama_pasien").focus();	
   exit();			
	   }else if(add_tgl_lahir==''){
		    alert("Masukkan Tanggal Lahir Pasien");		   	
		   $("#add_tgl_lahir").focus();		  
		      exit();
	   }else if(alamat==''){
		     alert("Masukkan Alamat Pasien");		   	 
		   $("#add_alamat").focus();	
  exit();		   
	   }else if(add_hp==''){
		        alert("Masukkan Nomor HP");		   	 
		   $("#add_hp").focus();
		     exit();
	   }else if(tipe_pasien=='option2'){
		   if(asuransi==''){
			   alert("Pilih Asuransi");
		   }else if(no_asuransi==''){
			    alert("Masukkan No Asuransi");
				$("#no_asuransi").focus();
		   }
	   }else if(propinsi==''){
		   alert("Pilih Propinsi");
		   exit();
	   }else if(kabupaten==''){
		   alert("Pilih Kabupaten");
		   exit();
	   }else if(kecamatan==''){
		   alert("Pilih Kecamatan");
		   exit();
	   }else if(kelurahan==''){
		   alert("Pilih Kelurahan");
		   exit();
	   }
	   
    // Update the details by requesting to the server using ajax

    $.post("modul/pg_pendaftaran/crud.php?op=tambahpasienbaru", {
            no_rm: add_no_rm,
			nama_pasien: nama_pasien,
			tgl_lahir: add_tgl_lahir,
			umur: add_umur,
			hp: add_hp,
			alamat: alamat,
			jk: jk,
			kode_pos: kode_pos,
			propinsi: propinsi,
			kabupaten: kabupaten,
			kecamatan: kecamatan,
			kelurahan: kelurahan,
			tipe_pasien: tipe_pasien,
			asuransi: asuransi,
			no_asuransi: no_asuransi,
			drm:hasil_drm
        }, function (data, status) {
			var confirm=data.split(',');
			if(confirm[0]==2){
				alert("Nomor Rekam Medis Sudah Digunakan");
				$("#add_no_rm").val(confirm[1]);
				exit();		
			}else if(confirm[0]==1){
					alert("Terdapat pasien dengan nama dan tanggal lahir yang sama Silahkan Cek Ulang Sistem");
			$("#add_nama_pasien").focus();
			exit();
			}else{
				alert("Data Berhasil Disimpan");
				$("#add_nama_pasien").val("");
				$("#add_hp").val("");
				$("#alamat").val("");
				$("#add_umur").val("");
				$("#add_kode_pos").val("");
				  
			}
			/*$("#tampil_hasil").html(data).show();  */
	     
        }  );
	 $("#responsive").modal("hide");
});
$("#tambahpasien").bind("click", function(event) {
      

    $.post("modul/pg_pendaftaran/crud.php?op=tambahpasien", {
        
        }, function (data, status) {
			$("#tambahpas").html(data).show();  
	     
        }  );
	 $("#responsive").modal("show");
});
$("#addpendaftaran").bind("click", function(event) {
       var pasien_id = $("#pasien_id").val();
	   var dokter = $("#id_dokter").val();
	   var poli= $("#poli_id").val();
	   var no_rujukan= $("#no_rujukan").val();
	   var tgl_rujuk= $("#no_rujukan").val();
	 
       $.post("modul/pg_pendaftaran/crud.php?op=tambahpasienbaru", {
            no_rm: add_no_rm,
			nama_pasien: nama_pasien,
			tgl_lahir: add_tgl_lahir,
			umur: add_umur,
			hp: add_hp,
			alamat: add_alamat,
			jk: jk,
			kode_pos: kode_pos,
			propinsi: propinsi,
			kabupaten: kabupaten,
			kecamatan: kecamatan,
			kelurahan: kelurahan,
			tipe_pasien: tipe_pasien,
			asuransi: asuransi,
			no_asuransi: no_asuransi
        }, function (data, status) {
			alert("Berhasil Disimpan")
			$("#tambahpas").html(data).show();  
	     
        }  );
	 $("#responsive").modal("show");
});
$('#cek_rm').click(function()
{
	var no_rm=$("#add_no_rm").val();
   if ($(this).is(':checked'))
    {
          $.post("modul/pg_pendaftaran/crud.php?op=tambahpasien", {
            no_asuransi: no_rm
        }, function (data, status) {
			$("#tambahpas").html(data).show(); 
	     
        }  );
       
    }
    //If checkbox is unchecked then disable or enable input
    else
    {
        $("#add_no_rm").removeAttr("readonly"); 
        $("#to-disable-input").attr("disabled","disabled");
		  $("#add_no_rm").val(""); 
		   $("#add_no_rm").focus(); 
    }
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

$('#drm').click(function(){
   if ($(this).is(':checked'))
    {
		
      $("#hasil_drm").val(1);
    }
    else
    {
      $("#hasil_drm").val(0);
    }
});
});

function yesnoCheck() {
	
    if (document.getElementById('asuransi').checked) {
		var data=1;
         $("#no_asuransi").removeAttr("disabled");
  $.post("modul/pg_pendaftaran/crud.php?op=asuransi", {
            data: data
        }, function (data, status) {
			$("#view_asuransi").html(data).show(); 
	     
        }  );		 
    } else {
		var data=0;
		 $.post("modul/pg_pendaftaran/crud.php?op=asuransi", {
            data: data
        }, function (data, status) {
			$("#view_asuransi").html(data).show(); 
	     
        }  );
		 $("#no_asuransi").attr("disabled","disabled");
    }
}
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_pendaftaran/autosuggest.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			}
		});
	}
}
function umur(usia){
		$.post("modul/pg_pendaftaran/crud.php?op=hitungusia", {usia: ""+usia+""}, function(data, status){
			if(data.length >0) {
				$("#add_tgl_lahir").val(data);
			}
		});
	
}

function fill(thisValue) {
	 $.post("modul/pg_pendaftaran/crud.php?op=detail_pasien", {          
			id_pasien : ""+thisValue+""
        },
        function (data, status) {	
		$("#detail_pasien").html(data).show();  
		$("#kode").val("");  
		$("#pasien_id").val(thisValue);  
		setTimeout("$('#suggestions').fadeOut();", 900);	
        }  );
	
}

function fill2(thisValue) {
	$('#kode').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

</script>

<style>
#result {
	position: absolute;
	height:20px;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:12px;
}
.suggestionsBox {
	position: absolute;
	left: 13px;
	top:0px;
	margin: 26px 0px 0px 0px;
	width: 230px;
	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul.auto {
	font-family:Arial, Helvetica, sans-serif;
	font-size:10px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
</style>

	 <div class="page-content">
<!--
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Form Pendaftaran</a>
						
					</li>
					
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						<i class="fa fa-angle-down"></i>
						</button>
						
					</div>
				</div>
			
</div>
-->
				
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Form Pendaftaran Pasien Rawat Jalan
							</div>
						
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" id="form_sample_1" class="form-horizontal">
							<div id="showerror">
							</div>
								<div class="form-body">
								<h4 class="form-section">Dokter</h4>
									<div class="form-group">
										<label class="control-label col-md-3">Dokter
										</label>
										<div class="col-md-4">
											<select name="options2" class="form-control select2me" id="id_dokter" onchange="ambil_kota($(this).val())">
											<option value="">Pilih Nama Dokter</option>
											<?php
										$sql="SELECT
rs.RS_DOKTER.DR_ID,
rs.RS_DOKTER.NAME,
rs.RS_DOKTER.POLI_ID

FROM
rs.RS_DOKTER where AKTIF=1
 ORDER BY
rs.RS_DOKTER.NAME ASC ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	                  $poli_id=$data["POLI_ID"];
                    $dokterid=$data["DR_ID"];
                      $nama_dokter=$data["NAME"];
					  echo"<option value='$dokterid|$poli_id'>$nama_dokter</option>";
					  }
											?>
												
											</select>
												</div>
												<div class="col-md-3">
												<div id="data_dokter"></div>
												</div>
									
									</div>
										<div class="form-group">
										<label class="control-label col-md-3">Tanggal Periksa
										</label>
										<div class="col-md-4">
										<div class="input-group date datetime-picker margin-bottom-5"  data-date-format="dd/mm/yyyy hh:ii">
															<input type="text" id="tgl_periksa" class="form-control form-filter input-sm" value="<?php echo $tgl_sekarang1." ".$jam; ?> "  name="product_history_date_from" placeholder="From">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
										</div>
										</div>
										
									<h4 class="form-section"></h4>
									<div class="form-group">
										<label class="control-label col-md-3">Cari Nama Pasien <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<div class="input-group input-large">
											 <input type="text" onKeyUp="suggest(this.value);" name="kode_rekening" id="cari_pasien" class="form-control"  placeholder="Format Cari :Nama Pasien , Alamat"  onBlur="fill2();" id="kode" size="15"/> 
				  	<span class="input-group-btn">
											<button class="btn green" type="button" data-toggle="modal"  id="tambahpasien">Tambah</button>
											</span>
											<input type="hidden"  id="pasien_id">
				  </div>
				   <div class="suggestionsBox" id="suggestions" style="display: none;">
				   <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
				   </div>
										</div>
									</div>
									<span id="detail_pasien">
								
									</span>
									<!--
									<div class="form-group">
										<label class="control-label col-md-3">Paket <span class="required">
										</span>
										</label>
										<div class="col-md-4">
														<select id="id_pasien" name="id_pasien" class="form-control select2me">
<option value="">Pilih Paket</option>
</select>
										</div>
										<div class="col-md-4">
														<select id="id_pasien" name="id_pasien" class="form-control select2me">
<option value="">Opt Data</option>
</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Rujukan<span class="required">
										</span>
										</label>
										<div class="col-md-4">
														<select id="id_pasien" name="id_pasien" class="form-control select2me">
<option value="">Opt Rujukan</option>
</select>
										</div>
										<div class="col-md-4">
														<select id="id_pasien" name="id_pasien" class="form-control select2me">
<option value="">Rujukan Data</option>
</select>
										</div>
									</div>-->
									
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
									<div class="checkbox-list">
												<label>
											
											</div>
											</div>
										<div class="col-md-offset-3 col-md-9">
										
											
										
											<button type="button" class="btn green" id="simpan">Simpan</button>
											<a href="?module=daftarrawatjalan" class="btn yellow">Daftar Pasien R. Jalan</a>
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					
					</div>
										
					<div id="responsive" class="modal fade"  aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content" style="height:570px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Pendaftaran Pasien Baru</h4>
										</div>
										<div class="modal-body">
											<div class="scroller" style="height:430px" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
												<form action="#" id="form_sample_1" class="form-horizontal">
							
												
													<div class="form-body" style="height:400px;">
													<div id="tampil_hasil"></div>
													
	<div class="col-md-6">
		<div class="form-group">
		<label class="control-label col-md-4" >No. RM<span class="required"></label>
											<div class="col-md-8" >
										<div class="input-group">
											<span class="input-group-addon">
											<input type="checkbox" name="cek_rm" id="cek_rm" value="option1" checked>No.RM
											</span>
											<span id="tambahpas"></span>
											<span class="input-group-addon">
												<input type="checkbox" name="cek_drm" id="drm"  checked> DRM
												<input type="hidden" id="hasil_drm" value="1">
											</span>
											</div>
										</div>
		</div>
													<div class="form-group">
										<label class="control-label col-md-4">Nama Pasien<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="add_nama_pasien"   class="form-control" placeholder="Nama Pasien Baru" >
										</div>
												
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tanggal Lahir<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
										
											<div class="input-group">
											<span class="input-group-addon">
											<input type="checkbox" id="cek_umur" name="cek_umur">
											</span>
											<div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
												<input type="text" class="form-control" name="datepicker" id="add_tgl_lahir" value="01/01/1970">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
												</div>
											</div>
										<span id="view_umur" style="padding-top:4px;">
											<input type="text" id="add_umur" onKeyUp="umur(this.value);"   class="form-control" placeholder="Umur" >
											</span>
										</div>
											
											
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">HP<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="add_hp"   class="form-control" placeholder="Nomor HP" >
										</div>
												
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Alamat<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<textarea id="alamat" class="form-control"></textarea>
										</div>
												
									</div>
									<div class="form-group">
									<label class="control-label col-md-4" >Jenis Kelamin<span class="required"></label>
											<div class="col-md-8">
									
											<div class="radio-list">
												<label class="radio-inline">
												<input type="radio" name="jk" id="laki-laki" value="1" checked> Laki-laki </label>
												<label class="radio-inline">
												<input type="radio" name="jk" id="perempuan" value="2" > Perempuan </label>
												
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Kode Pos<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<input type="text" id="add_kode_pos"   class="form-control" placeholder="Kode Pos" >
										</div>
												
										</div>
								
									<div class="form-group">
										<label class="control-label col-md-4">Propinsi<span class="required">
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
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 if($data['PROP_ID']=='PV14'){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	                 echo"<option value='$data[PROP_ID]' $cek>$data[NAME]</option>";
					  }
		
									?>
									
									</select>
										</div>
												
									</div>
									<div class="form-group">
									<label class="control-label col-md-4"  >Kabupaten<span class="required"></label>
											<div class="col-md-8">
										<select id="add_kabupaten" class="form-control select2me">
											<option value="">Pilih Kabupaten</option>
									<?php
$sql="	SELECT 
KAB_ID,
NAME
FROM
RS_KABUPATEN WHERE PROP_ID='PV14' ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	
	                 echo"<option value='$data[KAB_ID]' >$data[NAME]</option>";
					  }
		
									?>
										</select>
											
										</div>
									</div>
										<div class="form-group">
										<label class="control-label col-md-4">Kecamatan<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_kecamatan" class="form-control select2me">
									<option value="">Pilih Kecamatan</option>
									<?php
$sql="	SELECT 
KEC_ID,
NAME
FROM
RS_KECAMATAN WHERE KAB_ID='PV1402' ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	
	                 echo"<option value='$data[KEC_ID]' >$data[NAME]</option>";
					  }
		
									?>
									
									</select>
										</div>
												
									</div>
										<div class="form-group">
										<label class="control-label col-md-4"  >Kalurahan<span class="required"></label>
											<div class="col-md-8">
										<select id="add_kelurahan" class="form-control select2me">
										<option value="">Pilih Kelurahan</option>
									<?php
$sql="	SELECT 
KEL_ID,
NAME
FROM
RS_KELURAHAN WHERE KEC_ID='PV140210' ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	
	                 echo"<option value='$data[KEL_ID]' >$data[NAME]</option>";
					  }
		
									?>
										</select>
											
										</div>
										</div>
										</div>
											<div class="col-md-6">
									<div class="form-group">
									<label class="control-label col-md-4" >Tipe Pasien<span class="required"></label>
											<div class="col-md-8">
									
											<div class="radio-list">
												<label class="radio-inline">
												<input type="radio" name="tipe_pasien" onclick="javascript:yesnoCheck();" id="umum" value="option1" checked> Umum</label>
												<label class="radio-inline">
												<input type="radio" name="tipe_pasien" onclick="javascript:yesnoCheck();" id="asuransi" value="option2">Asuransi </label>
												
											</div>
										</div>
										</div>
										<span id="view_asuransi">
								
									</span>
										
												
													</div>
													</div>

</div>								
</form>
													
											
											</div>	
<div class="modal-footer">
											<button type="button" data-dismiss="modal" class="btn default">Close</button>
											<button type="button" class="btn green" id="tambahpasienbaru">Simpan</button>
										</div>											
										</div>
										
										
										</form>
									</div>
								</div>
							</div>
					<!-- END VALIDATION STATES-->
				</div>
			
			</div>
		</div>
			
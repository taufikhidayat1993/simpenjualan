 <script type="text/javascript" src="jquery.js"></script>

<?php
switch($_GET[act]){
  // Tampil Berita
  default:
  ?>
  
  <style>


.table-hover>tbody>tr:hover {background: #0E62ED;color:#fff;}
.table>tbody>tr.selected  {background: #0E62ED;color:#fff;}
.dataTables_filter,.dataTables_length,.dataTables_info,.dataTables_paginate paging_simple_numbers{
	display:none;
}
.pane-vScroll2 {
  overflow-y: auto;
  overflow-x: hidden;
  max-height: 375px;
  color:#000;
}
#sample_5_paginate{
	display:none;
}
.table>tbody>tr>td{
	padding:3px;
}
.suggestionsBox1 {
	left: 13px;
	margin: 0px 0px 0px 0px;

	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
	position:absolute;
}
.tabel th{
	font-size:12px;
	  background-color: #3598dc;
	  color:#fff;
   border-top-left-radius: 5px 5px;
   border-bottom-right-radius: 5% 0%;
   border-top-right-radius: 5px;
   background: #1e5799; /* Old browsers */
   background: -moz-linear-gradient(top,  #1e5799 0%, #207cca 0%, #4db848 0%, #3e9339 100%); /* FF3.6+ */
   background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(0%,#207cca), color-stop(0%,#4db848), color-stop(100%,#3e9339)); /* Chrome,Safari4+ */
   background: -webkit-linear-gradient(top,  #1e5799 0%,#207cca 0%,#4db848 0%,#3e9339 100%); /* Chrome10+,Safari5.1+ */
   background: -o-linear-gradient(top,  #1e5799 0%,#207cca 0%,#4db848 0%,#3e9339 100%); /* Opera 11.10+ */
   background: -ms-linear-gradient(top,  #1e5799 0%,#207cca 0%,#4db848 0%,#3e9339 100%); /* IE10+ */
   background: linear-gradient(to bottom,  #1e5799 0%,#207cca 0%,#4db848 0%,#3e9339 100%); /* W3C */
   filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#3e9339',GradientType=0 );
}
 </style>
	<script type="text/javascript">

$(document).ready(function() {
	
	$("#data").load("modul/pg_daftarrawatjalan/crud.php?op=tampilpasien",{form_tanggal:"<?php echo $tgl_sekarang1;?>",tanggal:1});	

$("#data").html("<img src='assets/global/img/loading.gif' width='50px;'>");  
$("#poliklinik").load("modul/pg_daftarrawatjalan/crud.php?op=get_poli");		


$("#poliklinik").change(function(){
	var tanggal=$("#form_tanggal").val();
	var data = $("#cari").val();
	var id_poli= $("#poliklinik").val();
	if(cari==''){
		alert("hhhh");
	}else{
    $.post("modul/pg_daftarrawatjalan/crud.php?op=detailpoli", {
			poli : id_poli,
			tanggal : tanggal
        },
        function (data, status) {			
		$("#id_dokter1").html(data).show();  
        }  );
	}
});
$("#loadpoli").bind("click", function(event) {
	var tanggal=$("#form_tanggal").val();
	 $.post("modul/pg_daftarrawatjalan/crud.php?op=get_poli", {
			tanggal : tanggal
	}, function (data, status) {			
     $("#poliklinik").html(data).show();
        }  );
	
});
$('#sample_5 tbody tr').click( function() {
var a = $(this).find("td").eq(0).html();
var b = $(this).find("td").eq(1).html();
var c = $(this).find("td").eq(2).html();
var d = $(this).find("td").eq(3).html();
var e = $(this).find("td").eq(4).html();
alert(a);	
//begitu gan .. semoga membantu , CMIIW
});
$("#editrajal").bind("click", function(event) {
	 var dokter = $("#id_dokter").val();
	 var tanggal  = $('#tgl_periksa').val();
	 var poli = $('#id_poli').val();
	 var tgl_rujuk= $("#tgl_rujuk").val();
	 var no_rujukan= $("#no_rujukan").val();
	 var catatan = $("#catatan").val();
	 var assesment = $("#assesment").val();
	 var id=  $("#get_medis").val();	
    $.post("modul/pg_daftarrawatjalan/crud.php?op=editrajal", {
			poli : poli,
			dokter : dokter,
			tgl_rujuk: tgl_rujuk,
			catatan:catatan,
			assesment : assesment,
			id: id,
			no_rujukan : no_rujukan,
			tanggal : tanggal
	}, function (data, status) {			
     $("#responsive").modal("hide");
        }  );
});
$("#caridata").bind("click", function(event) {
	 var cari = $("#cari").val();
	 var tanggal  = $('input[name=tanggal]:checked').val();
	 var input_cari = $('#form_cari').val();
	 var id_poli= $("#poliklinik").val();
	 var dokter = $("#id_dokter1").val();
	 var form_tanggal= $("#form_tanggal").val();
	if(tanggal==0){
		if(input_cari==''){
			alert("Untuk Pencarian Semua Tanggal Masukkan Kata Pencarian");
			$('#form_cari').focus();
			exit();
		}else if(cari==''){
			alert("Untuk Pencarian Semua Tanggal Harus Mengisi Pilihan Kategori");
			exit();
		}
	}else{
		$("#data").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
    $.post("modul/pg_daftarrawatjalan/crud.php?op=tampilpasien", {
			poli : id_poli,
			dokter : dokter,
			form_tanggal: form_tanggal,
			tanggal:tanggal,
			poli : id_poli,
			dokter: dokter,
			cari : cari,
			input_cari : input_cari
	}, function (data, status) {			
		$("#data").html(data).show();  
        }  );
	}
});
$('#ceklist').on("click", function(event){
				if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
				var id = $('input:checked[name=cek]').val();
				  win=window.open('modul/pg_daftarrawatjalan/nota.php?kode='+id,'win','width=300, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
			}else {
				var answer = confirm("Maaf Cek Salah Satu");
			}				
				});	
$('#periksa').on("click", function(event){
	            var id=$("#get_medis").val();
			$("#medis_id").val(id);
				$("#kategori").val("RJ");
				if(id !='' ){  // at-least one checkbox checked
				$("#modal-body8").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
			$.post("modul/pg_daftarrawatjalan/crud.php?op=cek", {
            id: id
        },
        function (data, status) {
			if(data==2){
				var benar=0;
				alert("Pasien Sudah Diperiksa, Anda Hanya Diizinkan Melihat Data Rekam Medis");
				$('#data_periksa').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/crud.php?op=periksa&aksi="+benar+"&id="+id);
				$("#resep").load("modul/pg_daftarrawatjalan/crud.php?op=resep&id="+id);	
	      exit();
			}else if(data==0){
				var benar=1;
				 if(confirm ("Tandai Sebagai Pasien Yang Sedang Diperiksa Dokter ?")==true){
	        	$('#data_periksa').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/crud.php?op=periksa&aksi="+benar+"&id="+id);
			 $("#resep").load("modul/pg_daftarrawatjalan/crud.php?op=resep&id="+id);	
			 }
			}else if(data==1 || data==3){
					var benar=0;
					$('#data_periksa').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/crud.php?op=periksa&aksi="+benar+"&id="+id);
				$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa&id="+id);
				
			}
           }
         );	
			}else {
				var answer = confirm("Maaf Cek Salah Satu");
			}				
				});	
$("#add_alergi").bind("click", function(event) {
var pasien_id=$("#get_pasien").val();
var ket_alergi=$("#ket_alergi").val();
if(ket_alergi==''){
	alert("Keterangan Alergi Harus Diisi");
		 $("#ket_alergi").focus();
		 exit();
}else {
    $.post("modul/pg_pasien/crud.php?op=tambahalergi", {
        pasien_id: pasien_id,
		ket_alergi: ket_alergi
        }, function (data, status) {
			alert("Data Alergi Berhasil Disimapan");
	
	     
        }  );
			 $("#alergi").modal("hide");
}
	
});
$("#ubah_alergi").bind("click", function(event) {
   var id= $("#get_pasien").val();
	    $.post("modul/pg_pasien/crud.php?op=detail_alergi", {
            id_pasien: id
        },
        function (data, status) {
		$("#ket_alergi").val(data);
	}
    );
    $("#alergi").modal("show");
});
$("#edit_pasien").bind("click", function(event) {
	  var id= $("#get_pasien").val();
    $.post("modul/pg_daftarrawatjalan/ubah_pasien.php", {
            id: id
        },
        function (data, status) {
			$("#ubahpasien").html(data).show();  
			return false;
        }
    );
    $("#responsive2").modal("show");
});

$("#simpanlab").bind("click", function(event) {
	var dokter = $("#id_dokterform").val();
	var perawat = $("#id_perawat2").val();
	var tindakan = $("#input_laboratorium").val();
	var id = $("#get_medis").val();
	var keterangan = $("#keterangan").val();
	var kode_lab       = $("#kode_lab").val();
	var harga          = $("#harga").val();
		var pasien_id = $("#get_pasien").val();
	if(dokter == ''){
		alert ("Nama Dokter Harus Diisi");
	}else if (perawat == ''){
		alert ("Nama Petugas Perawat Harus Diisi");
	}else{		
	$.post("modul/pg_laboratorium/crud.php?op=simpan_lab", {
            id: id,
			dokter : dokter,
			perawat : perawat,
			keterangan: keterangan,
			tindakan: tindakan,
			kode_lab: kode_lab,
			harga: harga
        },
        function (data, status) {
				$("#refreshlaboratorium").load("modul/pg_laboratorium/crud.php?op=daftarlab",{medis_id: ""+id+"", pasien_id : ""+pasien_id+""});	
			$("#keterangan").val("");
		    $("#input_laboratorium").val("");
		
		
        }
    );	
	}
});

$("#closediagnosa").bind("click", function(event) {
		$('#suggestions2').fadeOut();
});

	function myTrim(x) {
    return x.replace(/^\s+/,'');
}
$("#urinalisa").bind("click", function(event) {
	 $("#responsive3").modal("show");
});

$("#hematologi").bind("click", function(event) {
	 $("#responsive4").modal("show");
});

$("#feces").bind("click", function(event) {
	 $("#responsive5").modal("show");
});
$("#ubah_data").bind("click", function(event) {
    var id =$("#get_medis").val();
	var pasien_id = $("#get_pasien").val();
	
	if(id==''){
		alert("Mohon Pilih Pasien");
		exit();
	}else{
	
	 $.post("get_value/get_value.php?op=detaildokter", {
			id : id
	}, function (data, status) {
		var row = JSON.parse(data);
			$("#nama_dokter").val(row.dr_name);
		    $("#kode_dokter").val(row.kd_dokter);
	});
		$("#data_pemeriksaan").load("modul/pg_diagnosa/crud.php?op=caripasien",{pasien_id: ""+pasien_id+""});	
	$("#refreshlaboratorium").load("modul/pg_laboratorium/crud.php?op=daftarlab",{medis_id: ""+id+"", pasien_id : ""+pasien_id+""});	
$("#detaildiagnosa").load("modul/pg_diagnosa/crud.php?op=detaildiagnosa",{medis_id: ""+id+""});	
    $.post("modul/pg_laboratorium/crud.php?op=tambahlab", {
            id: id
        },
        function (data, status) {
			var str= myTrim(""+data+"");
		$("#permintaan").val(str);
 
        }
    );
    $("#responsive").modal("show");
	}
	
	
});
	$("#cari").change(function(){
					 var cari = $("#cari").val();
					 if(cari==1){
						document.getElementById("form_cari").placeholder = "Masukkan No. RM";
					 }else if(cari==2){
						 document.getElementById("form_cari").placeholder = "Masukkan ID Pasien ";
					 }else if(cari==3){
						 document.getElementById("form_cari").placeholder = "Masukkan Nama Pasien";
					 }else if(cari==4){
						 document.getElementById("form_cari").placeholder = "Masukkan Alamat";
					 }

	
});			

});
function diagnosa(inputString){
	if(inputString.length == 0) {
		$('#suggestions2').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/diagnosa.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions2').fadeIn();
				$('#suggestionsList2').html(data);
			}
		});
	}
}
function fil(thisValue,nama) {

	  $("#nama_diagnosa").val(""+nama+"");
	    $("#kode_diagnosa").val(""+thisValue+"");
			$('#suggestions2').fadeOut();
	 
}
function hapuslab(medis_id,seq_no,pasien_id){

		$.post("modul/pg_laboratorium/crud.php?op=hapus_lab", {medis_id: ""+medis_id+"",seq_no: ""+seq_no+""}, function(data){			
		$("#refreshlaboratorium").load("modul/pg_laboratorium/crud.php?op=daftarlab",{medis_id: ""+medis_id+"", pasien_id : ""+pasien_id+""});	
		});
}

function yesnoCheck() {
    if (document.getElementById('operasi1').checked) {
	  $("#out_tanggal").hide();
      	 
    } else {
		 $("#out_tanggal").show();
    }
}function GetMedisId(id,id_pasien,tanggal,asuransi,ktp,rujukan,rm,dokter,nama_pasien) {
			$("option:selected",$("#id_dokterform").val(dokter)).text();
    $("#get_medis").val(""+id+"");
	$("#get_pasien").val(""+id_pasien+"");
		$("#tanggal_detail").html(""+tanggal+"");
			$("#name_pasien").html(""+nama_pasien+"");
}

window
  .document
  .body

/* CLICK */

.addEventListener( "click", function( event ) {
  var oTarget = event.target;

 /* FOR input[type="checkbox"] */

if( oTarget.tagName == "INPUT" && oTarget.type == "checkbox" ) {
  var chkbox = document.getElementsByTagName("INPUT"),
  i = 0;
  for( ;i < chkbox.length; i++ ) {
     if( oTarget.name == chkbox[i].name ) {
       if( chkbox[i] == oTarget ) continue;
       chkbox[i].checked = false;
     }
   }
 }

 /* --- */

}, false );

	</script>

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
						<a href="#">Operasional</a>		<i class="fa fa-angle-right"></i>				
					</li>	
<li>
						<a href="#">Rawat Jalan</a>		<i class="fa fa-angle-right"></i>				
					</li>
<li>
						<a href="#">Daftar Rawat Jalan</a>						
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
<div class="row">


										<div id="alergi" class="modal fade"  aria-hidden="true">
								<div class="modal-dialog  modal-sm">
									<div class="modal-content" style="height:200px;width:300px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Input Alergi</h4>
										</div>
										<div class="modal-body">
										
												<div class="row">
												<form action="#" id="form_sample_1" class="form-horizontal">
							
												
													<div class="form-body" style="height:200px;">
													<div class="form-group">
										<div class="col-md-11">
										<input type="hidden" id="id_pasien_alergi">
											<input type="text" id="ket_alergi"   class="form-control" placeholder="Masukkan Alergi Pasien" >
										</div>
										</div>
										<div class="modal-footer">
											<button type="button" data-dismiss="modal" class="btn default">Close</button>
											<button type="button" class="btn green" id="add_alergi">Simpan</button>
										</div>	
																							</div>	
													</div>
													</form>
												
													</div>
													</div>
													</div>
													</div>
													</div>
									
											
<div id="responsive" class="modal fade "  aria-hidden="true">

								<div class="modal-dialog modal-full" >
									<div class="modal-content" style="height:auto;">										
										<div class="modal-body">
										<div class="scroller" style="height:580px;" data-always-visible="1" data-rail-visible1="1">
										
												<div class="row">
												<div class="col-md-6">
                                                   
							<div class="portlet box blue">
<!--<div class="portlet-title ">
							<div class="caption">
								<i class="fa fa-user-md"></i>
								Daftar Diagnosa
							
						
							</div>	
								
						</div>
						-->
						<div class="portlet-body">
						<div class="row">
										<div class="panel panel-info">
						<div class="panel-heading">
										<h3 class="panel-title">Daftar Diagnosa
											<div class="tools" style="float:right;" id="name_pasien" style="padding:5px 0 8px 0;">sfsfsf afafafa adafaf</div>
										</h3>
										
									</div>
									<div class="panel-body" style="height:230;">
									<div id="detaildiagnosa">
									
									</div>
									</div>
									</div>
										</div>
							<div class="row">
							<div class="panel panel-info">
						
									<div class="panel-body">
								<div class="form-group" >
															<label class="control-label col-md-2">Dokter </label>
															<div class="col-md-8">
															<input type="text" id="nama_dokter" class="form-control">
															</div>
															<div class="col-md-2">
															<input type="text" id="kode_dokter" class="form-control">
															</div>
															</div>
																	<div class="form-group" >
															<label class="control-label col-md-2">Diagnosa</label>
															<div class="col-md-8">
															<input type="text" onKeyUp="diagnosa(this.value);"  id="nama_diagnosa" class="form-control">
															</div>
															<div class="col-md-2">
															<input type="text" id="kode_diagnosa" class="form-control">
															</div>
															</div>
																	  <div class="form-group">
																	  <label class="control-label col-md-2"></label>
															<div class="col-md-10">
										  <div class="suggestionsBox1" id="suggestions2" style="display: none;">
				   <div class="suggestionList" id="suggestionsList2"> &nbsp; </div>
				    <button id="closediagnosa" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
															</div>
				
</div>
									</div>
									</div>
						<div class="col-md-6">
							<div class="panel panel-info">
						<div class="panel-heading">
										<h3 class="panel-title">SUBYEKTIF</h3><div id="ouput"></div>
									</div>
									<div class="panel-body">
									<textarea onkeyup="textAreaAdjust(this)" class="form-control" style="overflow:hidden;" placeholder="Input Subyektif" id="edit_subyektif"><?php echo $data5['SUBYEKTIF']; ?></textarea>
									</div>
									</div>
									<div class="panel panel-info">
						<div class="panel-heading">
										<h3 class="panel-title">OBYEKTIF</h3><div id="ouput"></div>
									</div>
									<div class="panel-body">
									<textarea onkeyup="textAreaAdjust(this)" class="form-control" style="overflow:hidden;" placeholder="Input Subyektif" id="edit_subyektif"><?php echo $data5['SUBYEKTIF']; ?></textarea>
									</div>
									</div>
										<div class="panel panel-info">
						<div class="panel-heading">
										<h3 class="panel-title">ASSESMENT</h3><div id="ouput"></div>
									</div>
									<div class="panel-body">
									<textarea onkeyup="textAreaAdjust(this)" class="form-control" style="overflow:hidden;" placeholder="Input Subyektif" id="edit_subyektif"><?php echo $data5['SUBYEKTIF']; ?></textarea>
									</div>
									</div>
									
						</div>
						<div class="col-md-6">
						<div class="panel panel-info">
						<div class="panel-heading">
										<h3 class="panel-title">PLANNING/TERAPI</h3><div id="ouput"></div>
									</div>
									<div class="panel-body">
									<textarea onkeyup="textAreaAdjust(this)" class="form-control" style="overflow:hidden;" placeholder="Input Subyektif" id="edit_subyektif"><?php echo $data5['SUBYEKTIF']; ?></textarea>
									</div>
									</div>
						<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">VITAL SIGN</h3>
									</div>
									
									<div class="panel-body">
									<table class=" " style="font-size:12px;">
									<tr>
									<td>Tensi</td><td>	
									<input type="text"  id="edit_tensi" placeholder="Tensi" class="small" style="width:50px;" value="<?php echo $data5['TENSI']; ?>" ></td>
									<td>mmHg</td>
									<td>BB</td><td ><input type="text"  placeholder="Berat Badan" value="<?php echo $data5['BB']; ?>"  id="edit_bb" class="small" style="width:50px;" ></td>
									<td width="30%">KG</td>
									</tr>
									<tr>
									<td>Suhu</td><td><input type="text"  placeholder="Suhu Badan" style="width:50px;"  class="small" id="edit_suhu" value="<?php echo $data5['SUHU']; ?>"  ></td><td>&deg;C</td><td> TB</td><td><input type="text" placeholder="Tinggi Badan"  id="edit_tb" class="small" style="width:50px;" value="<?php echo $data5['TB']; ?>" ></td><td>CM</td>
									</tr>
									<tr>
									<td>Nadi</td><td><input type="text"  placeholder="Denyut Nadi" style="width:50px;"  class="small" id="edit_nadi" value="<?php echo $data5['NADI']; ?>" ></td><td>X/Menit</td><td>Nyeri</td><td><input type="text" class="small"  id="edit_nyeri" style="width:50px;" placeholder="Nyeri" value="<?php echo $data5['NYERI']; ?>" ></td><td>1-10	</td>
									</tr>
									<tr>
									<td>Resp</td><td><input type="text"  placeholder="Respirasi" style="width:50px;"  class="small"  id="edit_resp" value="<?php echo $data5['RESP']; ?>" ></td><td>X/Menit</td><td colspan="3"></td>
									</tr>
									</table>
									</div>
									</div>
						</div>
						</div>
						</div>
						</div>
			
					</div>
					<div class="col-md-6" >
					<div class="portlet box blue">
<div class="portlet-title ">
							<div class="caption">
								<i class="fa fa-medkit"></i>
								<span class="caption-subject">Riwayat Penyakit</span>
								<span class="caption-helper"></span>
							</div>							
						</div>
						<div class="portlet-body">		
				<table style="width:100%;" class="tabel" >
					<thead>
				
					<tr style="font-weight:700;"><th style="width:90px;">TANGGAL</th>
					<th >DIAGNOSA</th>
					<th >ANAMNESA</th>
					<th >DOKTER</th>
					</tr>
				</thead>
				</table>
					<div class="pane-vScroll2">
					<table id="table" style="width:100%;font-size:11px;" class="table table-striped table-hover" >
				
					<tbody id="data_pemeriksaan">
					</tbody>
					</table>
					</div>
					</div>
					</div>
					<div  style="padding-top:10px;">
					<div class="clearfix">
					<button class="btn btn-lg blue" style="padding:10px;" style="padding:10px 15px 10px 15px;">
					<i class="fa fa-pencil"></i> <br> Edit
					</button>
						<button class="btn btn-lg red" style="padding:10px;" style="padding:10px 15px 10px 15px;">
					<i class="fa fa-trash-o"></i> <br> Hapus
					</button>
					<button class="btn btn-lg green" style="padding:10px;" style="padding:10px 15px 10px 15px;">
					 Buat Surat<br>
					Kontrol/SKDP
					</button>
					</div>
					</div>
						</div>

												
												</div>
											
												</div>
												
												</div></div>
												</div>
												</div>
											
	
	<div class="col-md-12">
					
						<div class="tab-content">
							<div id="tab_2_2" class="tab-pane active">
								<div class="row">
									<div class="col-md-12">
										<table class="header">
										<tr><td><label>
														<input type="radio" onclick="javascript:yesnoCheck();" id="operasi1" name="tanggal" value="0"> Semua Tanggal</label>
														<label></td>
														<td></td>
														<td>
														<label class="control-label col-md-4">Poliklinik</label>
														</td>
														<td>
														
																								<select id="poliklinik" class="form-control">
																					
                                                                                                </select>
																								
														
</td><td >
<button id="loadpoli" class="btn yellow">Reload Poli</button>
</td>
<td ><label class="control-label col-md-4">Dokter :</label></td><td>
<select id="id_dokter1" class="form-control">
                                                                </select></td></tr>
																<td><label>
														<input type="radio" onclick="javascript:yesnoCheck();" id="operasi2" name="tanggal" value="1" checked> Pilih Tanggal</label></td>
																<td>	<div class="input-icon" id="out_tanggal">
															<i class="fa fa-calendar"></i>
															<input id="form_tanggal" class="form-control date-picker" size="16"  value="<?echo $tgl_sekarang1; ?>"   data-date-format="dd/mm/yyyy" data-date-viewmode="years"/><span id="tampil_tanggal"></span>
														</div></td>
																<td colspan="2"><select id="cari" class="form-control"><option value="">Kategori Pilihan</option>
															<option value="1">No. RM   </option>
															<option value="3">Nama Pasien</option>
															<option value="2">ID Pasien</option>	
															<option value="4">Alamat</option>
															</select></td>
																<td colspan="3">	<div class="input-icon col-md-8" style="padding-left:0px;">
															<i class="fa fa-user"></i>
															<input id="form_cari" class="form-control" size="16" type="text"  data-date="12-02-2012" />
														</div><div class="input-icon col-md-4" style="padding-left:0px;"><button type="button" class="btn blue btn-block" id="caridata">CARI<i class="m-icon-swapright m-icon-white"></i></button></div></td>
																
																
										</table>
									</div>
								</div>
							
							
						</div>
				
				</div>
			</div>
			<BR><BR>
				<div class="col-md-12" STYLE="margin-top:5px;">
			<div class="portlet box ">
					
						
					<style>
{
  box-sizing: border-box;
}

table.header th, table.header td {
  padding: 3px 4px;
  border: 1px solid #ddd;
  width: 160px;



}

</style>
						<div class="portlet-body">	

    <table   class="table table-striped table-hover" id="sample_5" style="font-size:12px;">
	
        <?php echo th(12); ?>



	<input type="hidden" id="get_medis">
	<input type="hidden" id="get_pasien"><!-- Mendapatkan ID Medis Untuk Diseleksi !-->

        <tbody id="data">
         
								<?php
								/*
								
$sql="SELECT 
P.MEDIS_ID,
P.PASIEN_ID,
Q.NO_RM,
Q.NAME,
Q.ALERGI,
LOWER(Q.ADDRESS) AS ADDRESS,
asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM' WHEN 3 THEN R.NAME END,
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,106) AS DATE_MEDIS,
CONVERT(VARCHAR(8),P.DATETIME_MEDIS,108) AS TIME_MEDIS,
S.NAME AS POLI_NAME,
P.ANTRIAN,
P.RUJUKAN_DATA_ID,
P.NORUJUKAN,
T.NAME AS nama_dokter,
T.DR_ID,
Q.GENDER,
R.NAME AS NAMA_AS,
gender=CASE Q.GENDER WHEN 1 THEN 'L' WHEN 2 THEN 'P' END

FROM
rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE
P.PASIEN_ID = Q.PASIEN_ID AND
P.STATUS_BAYAR = '0' AND CONVERT(VARCHAR(11),P.DATETIME_MEDIS,103) ='$tgl_sekarang1'

ORDER BY
P.DATETIME_MEDIS DESC";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$no=1;
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                                        $sex=$data["GENDER"];
                                        $rujukan=$data["RUJUKAN_DATA_ID"];
                                        $PASIEN_ID=$data["PASIEN_ID"];
											$sql1="SELECT 	rs.FN_CHECK_DATA_PASIEN_KOSONG('$PASIEN_ID') AS DATA";
$params1 = array();
$options1 = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );			
$stmt1 = sqlsrv_query( $conn, $sql1, $params1, $options1 );	
$dataku=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
if($dataku['DATA']!=''){
	$hasil="active";
}else{
	$hasil="";
}		
										echo"<tr ><td  style='width:50px;'>$no</td><td class='$hasil'  style='width:80px;'><span style='cursor:pointer;' >$data[NO_RM]</span></td>
										<td "; if ($data['ALERGI']!=''){
											echo "class='danger'"; 
										}echo"><span data-toggle='modal' onclick='GetAlergi(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;' >$data[NAME]</span></td><td><span data-toggle='modal' onclick='GetUbahPasien(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;' >$data[ADDRESS]</span></td><td>$data[NAMA_AS]</td><td style='width:110px;'>$data[DATE_MEDIS]</td><td>$data[POLI_NAME]</td>
										<td>$data[nama_dokter]</td><td>$data[ANTRIAN]</td><td>$data[NORUJUKAN]</td></tr>";
										$no++;
 }
*/
?>
							
        </tbody>
      </table>
	  <div class="portlet-title">
						
							<?php if($_SESSION['level']!='operator'){
								?>
							<div class="actions">
								<div class="btn-group">
								<button class="btn red" id="ubah_alergi" >
								<i class="fa fa-plus-circle"></i><div style="padding:0px 10px 0px 10px;">Alergi</div>
									</button>
								<button class="btn purple" id="ubah_data" >
								<i class="fa fa-edit"></i><div>&nbsp;&nbsp;&nbsp;Diagnosa&nbsp;&nbsp;&nbsp;</div>
									</button>
								
								
								</div>
								<?php
							}
							?>
							<div class="form-actions right" style="float:right;">
						<?php echo indikator(12); ?>
						</div>
							</div>
							
						</div>
						
	</div>
		



						</div>
					</div>
						
				</div>

<?php
}
?>



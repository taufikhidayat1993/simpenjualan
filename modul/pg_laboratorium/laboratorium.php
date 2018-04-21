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

$("#simpan_feces").bind("click", function(event) {
var note ='';
	var warna_feses           = $("#warna_feses").val();
	var konsistensi_feses     = $("#konsistensi_feses").val();
	var darah         = $("#darah").val();
	var lendir         = $("#lendir").val();
	var bakteri_mikroskopik      = $("#bakteri_mikroskopik").val();
	var amoeba    = $("#amoeba").val();
	var leukosit    = $("#leukosit_mikroskopik").val();
	var erythrosit  = $("#erythrosit_mikroskopik").val();
	var telur_cacing    = $("#telur_cacing").val();
	var lemak_mikroskopik     = $("#lemak_mikroskopik").val();
	var epithel_mikroskopik     = $("#epithel_mikroskopik").val();
    var jamur     = $("#jamur").val();
		note +=$("#keterangan").val();
	note += "Warna Feses : "+warna_feses+";Konsistensi Feses  : "+konsistensi_feses+"; Darah : "+darah+"; Lendir :"+lendir+"; Amoeba : "+amoeba+"; Leukosit : "+leukosit+"; /lpb erythrosit : "+erythrosit+"; Telur Cacing : "+telur_cacing+"; Lemak : "+lemak_mikroskopik+"; Epithel : "+epithel_mikroskopik+"; Jamur : " +jamur+";"; 

	$("#keterangan").val(""+note+"");
	});
$("#simpan_urine").bind("click", function(event) {
	var note = '';
	var kejernihan = $("#kejernihan").val();
	var warna      = $("#warna").val();
	var bj         = $("#bj").val();
	var ph         = $("#ph").val();
	var keton      = $("#keton").val();
	var protein    = $("#protein").val();
	var glukosa    = $("#glukosa").val();
	var leukosit    = $("#leukosit").val();
	var erythrosit  = $("#erythrosit").val();
	var selinder    = $("#selinder").val();
	var epithel     = $("#epithel").val();
	var bakteri     = $("#bakteri").val();
	var kristal     = $("#kristal").val();
	note +=$("#keterangan").val();
	note += "Kejernihan : "+kejernihan+"; Warna :"+warna+"; BJ :"+bj+"; PH :"+ph+"; Keton : "+keton+"; Protein : "+protein+"; Glukosa : "+glukosa+"; Leukosit :"+leukosit+"; Erythrosit :"+erythrosit+"; Selinder :"+selinder+"; Epithel : " +epithel+"; Bakteri :" +bakteri+"; Kristal : "+kristal+";"; 
$("#keterangan").val(""+note+"");
	});
	
$("#simpan_hematologi").bind("click", function(event) {
	var note ='';
	var hemoglobin = $("#hemoglobin").val();
	var hematokrit      = $("#hematokrit").val();
	var lekosit         = $("#lekosit").val();
	var trombosit         = $("#trombosit").val();
	var erithrosit      = $("#erithrosit").val();
	var pdw    = $("#pdw").val();
	var mpv    = $("#mpv").val();
	var pct    = $("#pct").val();
	var mcv  = $("#mcv").val();
	var mch    = $("#mch").val();
	var mchc     = $("#mchc").val();
	var neutrofil_persen    = $("#neutrofil_persen").val();
	var basofil_persen     = $("#basofil_persen").val();
	var limfosit_persen     = $("#limfosit_persen").val();
	var monosit_persen    = $("#monosit_persen").val();
	
	var neutrofil_pagar    = $("#neutrofil_pagar").val();
	var basofil_pagar     = $("#basofil_pagar").val();
	var limfosit_pagar     = $("#limfosit_pagar").val();
	var monosit_pagar    = $("#monosit_pagar").val();
	
	if(hemoglobin !=''){		
		note += " Hemoglobin : " +$("#hemoglobin").val()+ " g/dl;";
	} 
	if(hematokrit !=''){		
		note += " Hematokrit : " +$("#hematokrit").val()+ " %;";
	}
    if(lekosit !=''){		
		note += " Lekosit : " +$("#lekosit").val()+ " 10^3/uL;";
	} 	
	if(trombosit !=''){		
		note += " Trombosit : " +$("#trombosit").val()+ " 10^3/uL;";
	}
	if(erithrosit !=''){		
		note += " Erithrosit : " +$("#trombosit").val()+ " 10^6/uL;";
	}
	if(erithrosit !=''){		
		note += " Erithrosit : " +$("#trombosit").val()+ " 10^6/uL;";
	}
	if(pdw !=''){		
		note += " PDW (Platelit Distribution Width: " +$("#pdw").val()+ ";";
	}
	if(mpv !=''){		
		note += " MPV (Mean Platelet Volume): " +$("#mpv").val()+ " fL;";
	}
	if(pct !=''){		
		note += " PCT (Platelecrit): " +$("#pct").val()+ " %;";
	}
	if(mcv !=''){		
		note += " MCV: " +$("#mcv").val()+ " fL;";
	}
	if(mch !=''){		
		note += " MCH: " +$("#mch").val()+ " pg;";
	}
	if(mchc !=''){		
		note += " MCHC: " +$("#mch").val()+ " G/dL;";
	}
	if(neutrofil_persen !=''){
		note += " Neutrofil % : " +$("#neutrofil_persen").val()+ " %;";
	}
	if(basofil_persen !=''){
		note += " Basofil % : " +$("#basofil_persen").val()+ " %;";
	}
	if(eosinofil_persen !=''){
		note += " Eosinofil % : " +$("#eosinofil_persen").val()+ " %;";
	}
	if(limfosit_persen !='') {
		note += " Limfosit % : " +$("#limfosit_persen").val()+ " %;";
	}
	if(monosit_persen !='') {
		note += " Monosit % : " +$("#monosit_persen").val()+ " %;";
	}
	
		if(neutrofil_pagar !=''){
		note += " Neutrofil # : " +$("#neutrofil_pagar").val()+ " %;";
	}
	if(basofil_pagar !=''){
		note += " Basofil # : " +$("#basofil_pagar").val()+ " %;";
	}
	if(eosinofil_pagar !=''){
		note += " Eosinofil # : " +$("#eosinofil_pagar").val()+ " %;";
	}
	if(limfosit_pagar !='') {
		note += " Limfosit # : " +$("#limfosit_pagar").val()+ " %;";
	}
	if(monosit_pagar !='') {
		note += " Monosit # : " +$("#monosit_pagar").val()+ " %;";
	}
		note +=$("#keterangan").val();
	$("#keterangan").val(""+note+"");
	
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
	$("#refreshlaboratorium").load("modul/pg_laboratorium/crud.php?op=daftarlab",{medis_id: ""+id+"", pasien_id : ""+pasien_id+""});	

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
function laboratorium(inputString){
	if(inputString.length == 0) {
		$('#suggestions2').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_laboratorium/crud.php?op=cari_lab", {queryString: ""+inputString+""}, function(data){
			if(data.length > 1) {
				$('#suggestions2').fadeIn();
				$('#suggestionsList2').html(data);
			}
		});
	}
	
}
function hapuslab(medis_id,seq_no,pasien_id){

		$.post("modul/pg_laboratorium/crud.php?op=hapus_lab", {medis_id: ""+medis_id+"",seq_no: ""+seq_no+""}, function(data){			
		$("#refreshlaboratorium").load("modul/pg_laboratorium/crud.php?op=daftarlab",{medis_id: ""+medis_id+"", pasien_id : ""+pasien_id+""});	
		});
}
function fil(kode,nama,harga) {
		  $("#input_laboratorium").val(""+nama+"");
		  $("#kode_lab").val(""+kode+"");
		  $("#harga").val(""+harga+"");
		  $('#suggestions2').fadeOut();
}
function yesnoCheck() {
    if (document.getElementById('operasi1').checked) {
	  $("#out_tanggal").hide();
      	 
    } else {
		 $("#out_tanggal").show();
    }
}function GetMedisId(id,id_pasien,tanggal,asuransi,ktp,rujukan,rm,dokter) {
			$("option:selected",$("#id_dokterform").val(dokter)).text();
    $("#get_medis").val(""+id+"");
	$("#get_pasien").val(""+id_pasien+"");
		$("#tanggal_detail").html(""+tanggal+"");
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

<div id="responsive2" class="modal fade"  aria-hidden="true">
								<div class="modal-dialog" style="width:1200px;">
									<div class="modal-content" style="height:570px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Pendaftaran Pasien Baru</h4>
										</div>
										<div class="modal-body" id="ubahpasien">
										
										</div>										
									</div>
									</div>
									</div>
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
									
<div id="data_periksa" class="modal fade"  aria-hidden="true">

								<div class="modal-dialog" style="width:100%;margin: 0px auto;" >
									<div class="modal-content" style="height:650px;">
										<div class="modal-header" style="padding:5px;">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Rawat Jalan</h4>
										</div>
									
										<div style="height:550px" class="modal-body" data-always-visible="1" data-rail-visible1="1">
												
	<div class="col-md-8">
<div class="portlet box blue">
<div class="portlet-title ">
							<div class="caption">
								<i class="fa fa-user font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">REKAM MEDIS PASIEN</span>
								<span class="caption-helper"></span>
							</div>							
						</div>
						<div class="portlet-body">					
					<table class="table table-striped table-bordered table-advance table-hover">
					<tr>
					<thead>
					<th>TIPE</th><th>KODE LAB/RADIOLOGI</th>
					<th>NAMA</th><th>KETERANGAN</th><th>DOKTER</th><th>PETUGAS</th>
					</thead>
					</tr>
					<tbody id="ref">
					
					</tbody>
					</table>
					</div>
					</div>
					</div>
					<div class="col-md-4" >
					<div class="portlet box blue">
                        <div class="portlet-title ">
							<div class="caption">
								<i class="fa fa-user font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">REKAM MEDIS PASIEN</span>
								<span class="caption-helper"></span>
							</div>							
						</div>
						<div class="portlet-body">		
					<form class="form-horizontal" role="form">
											<div class="form-body" style="font-size:14px;font-weight:700px;padding:0px;">										
												<div class="row">
												
														<div class="form-group" >
															<label class="control-label col-md-3">Dokter</label>
															<div class="col-md-9">
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
															</div>
															
<div class="form-group" >
															<label class="control-label col-md-3">Perawat </label>
															<div class="col-md-9">
															<select name="options2" class="form-control select2me" id="id_perawat" onchange="ambil_kota($(this).val())">
											<option value="">Pilih Nama Perawat</option>
											<?php
										$sql="SELECT
NAME,PERAWAT_ID
FROM
RS_PERAWAT 
 ORDER BY
NAME ASC ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	               echo"<option value='".$data["PERAWAT_ID"]."'>".$data["NAME"]."</option>";
					  }
											?>
												
											</select>
															</div>
															</div>
															<div class="form-group" >
															<label class="control-label col-md-3">Laboratorium </label>
															<div class="col-md-9">
																
											 <input type="text" onKeyUp="laboratorium(this.value);" name="kode_rekening" id="kode" class="form-control"  placeholder="Masukkan Data Diagnosa"   size="10" autocomplete="off" /> 
				  
										
				
				 
															</div>
															</div>
															<div class="form-group" >
															<label class="control-label col-md-3">Keterangan </label>
															<div class="col-md-9">
															<textarea class="form-control"></textarea>
															</div>
															</div>
															</div>
											
												</div>
												<div class="form-actions">
												<div class="row">
												<div class="col-md-offset-3 col-md-9">
												<button type="button" class="btn green" id="urinalisa2">
												<i class="fa fa-check"></i>URINALISA
												</button>
												<button type="button" class="btn green" id="simpan_laboratorium">
												<i class="fa fa-check"></i>HEMATOLOGI
												</button>
												<button type="button" class="btn green" id="simpan_laboratorium">
												<i class="fa fa-check"></i>FECES
												</button>
												</div>
												</div>
												</div>
					</form>
					</div>
					</div>
						</div>

												</div>
												<div class="modal-footer">
												<span id="tanggal_detail" style="color:red; font-size:15px; font-weight:700px;float:left;"></span>
												<input type="hidden" id="medis_id">
													<input type="hidden" id="kategori">
											<button type="button" class="btn green" id="cetak_rm">
												<i class="fa fa-print"></i>
												<div>										
													<span id="cetak">CETAK RM</span>
												</div></button>
										<button type="button" class="btn red" id="selesai">
												<i class="fa fa-paper-plane-o"></i>
												<div>
													SELESAI
												</div></button>
										</div>	
												</div>
												
												</div>
												</div>
												
<div id="responsive" class="modal fade "  aria-hidden="true">

								<div class="modal-dialog modal-full" >
									<div class="modal-content" style="height:auto;">										
										<div class="modal-body">
										<div class="scroller" style="height:540px;" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
												<div class="col-md-7">
                                                   
						<div class="portlet-body">					
					<table class="table table-striped table-bordered table-advance table-hover" style="font-size:11px;">
					<thead>
					<tr>					
					<th>KODE LAB</th>
					<th>NAMA</th><th>KETERANGAN</th><th>TANGGAL<th>DOKTER</th><th>PETUGAS</th>				
					<th><i class="fa fa-gear (alias)font-red-sunglo"></i></th></tr>
					</thead>
					<tbody id="refreshlaboratorium">
					</tbody>
					</table>
					</div>
				
					</div>
					<div class="col-md-5" >
					<div class="portlet box blue">
<div class="portlet-title ">
							<div class="caption">
								<i class="fa fa-user font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">Laboratorium</span>
								<span class="caption-helper"></span>
							</div>							
						</div>
						<div class="portlet-body">		
					<form class="form-horizontal" role="form">
											<div class="form-body" style="font-size:14px;font-weight:700px;padding:0px;">										
												<div class="row">
												<div class="col-md-7" >
														<div class="form-group" >
															<label class="control-label col-md-3">Dokter</label>
															<div class="col-md-9">
															<select name="options2" class="form-control" id="id_dokterform" onchange="ambil_kota($(this).val())">
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
	                  $dokterid=$data["DR_ID"];
                      $nama_dokter=$data["NAME"];
					  echo"<option value='$dokterid'>$nama_dokter</option>";
					  }
											?>
												
											</select>
															</div>
															</div>
															
<div class="form-group" >
															<label class="control-label col-md-3">Perawat </label>
															<div class="col-md-9">
															<select name="options2" class="form-control select2me" id="id_perawat2" onchange="ambil_kota($(this).val())">
											<option value="">Pilih Nama Perawat</option>
											<?php
										$sql="SELECT
NAME,PERAWAT_ID
FROM
RS_PERAWAT 
 ORDER BY
NAME ASC ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	               echo"<option value='".$data["PERAWAT_ID"]."'>".$data["NAME"]."</option>";
					  }
											?>
												
											</select>
															</div>
															</div>
															<div class="form-group" >
															<label class="control-label col-md-3">Laboratorium</label>
															<div class="col-md-9">
																
											 <input type="text" onKeyUp="laboratorium(this.value);" name="kode_rekening" id="input_laboratorium" class="form-control"  placeholder="Masukkan Data Diagnosa"   id="kode" size="10" autocomplete="off" /> 
				                             <input type="hidden" id="kode_lab" >
										     <input type="hidden" id="harga" >
										
				
				   <div class="suggestionsBox1" id="suggestions2"  style="display: none;">
				   <div class="suggestionList" id="suggestionsList2"> &nbsp; </div>
				    <button id="closediagnosa" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
															</div>
															</div>
															<div class="form-group" >
															<label class="control-label col-md-3">Keterangan </label>
															<div class="col-md-9">
															<textarea class="form-control" rows="15" id="keterangan"></textarea>
															</div>
															</div>
															</div>
											
											<div class="col-md-5" >
											<div class="form-group" >
															<label class="control-label col-md-12">DAFTAR PERMINTAAN PEMERIKSAAN</label>
															<div class="col-md-12">
															<textarea class="form-control" id="permintaan" rows="22"></textarea>
												</div>
											</div>
											</div>
											</div>
												</div>
												<div class="form-actions">
												<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="button" class="btn green" id="urinalisa">
												<i class="fa fa-check"></i>URINALISA
												</button>
												<button type="button" class="btn green" id="hematologi">
												<i class="fa fa-check"></i>HEMATOLOGI
												</button>
												<button type="button" class="btn green" id="feces">
												<i class="fa fa-check"></i>FECES
												</button>
												</div>
												</div>
												</div>
					</form>
					</div>
					</div>
						</div>

												
												</div>
											
												</div>
													<div class="modal-footer">
												<input type="hidden" id="medis_id">
											<button type="button" data-dismiss="modal" class="btn default">Close</button>
											<button type="button" class="btn green" id="simpanlab">Simpan</button>
										</div>	
												</div></div>
												</div>
												</div>
												<div id="responsive3" class="modal fade "  aria-hidden="true">

								<div class="modal-dialog" >
									<div class="modal-content" >

									
<div class="modal-header" style="padding:5px;"><h4 class="modal-title">HASIL PEMERIKSAAN</H4></div>									
										<div class="modal-body form">
										<div class="scroller" style="height:280px" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
												<form class="form-horizontal" role="form">
												<div class="col-md-6">
														
																			
											
												<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">	URINALISA</h3>
								
							</div>							
					
						<div class="panel-body">	

						<div class="form-group" >
															<label class="control-label col-md-3">Kejernihan</label>
															<div class="col-md-9">
										<select name="options2" class="form-control" id="kejernihan" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="JERNIH">JERNIH</option>
											<option value="KERUH">KERUH</option>
											<option value="AGAK KERUH">AGAK KERUH</option>
										</select>
															</div>
															</div>
										<div class="form-group" >
										<label class="control-label col-md-3">Warna</label>
										<div class="col-md-9">
										<select name="options2" class="form-control" id="warna" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="KUNING">KUNING</option>
											<option value="KUNING TUA">KUNING TUA</option>										
										</select>
										</div>
									   </div>
									   <div class="form-group" >
										<label class="control-label col-md-3">BJ</label>
										<div class="col-md-4">
										<input type="text" class="form-control" id="bj">
										</div>
									   </div>
									   <div class="form-group" >
										<label class="control-label col-md-3">pH</label>
										<div class="col-md-4">
										<input type="text" class="form-control" id="ph">
										</div>
									   </div>
									   <div class="form-group" >
										<label class="control-label col-md-3">Keton :</label>
										<div class="col-md-4">
								<select name="options2" class="form-control" id="keton" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE +">POSITIVE +</option>
                                            <option value="POSITIVE ++">POSITIVE ++</option>	
                                            <option value="POSITIVE +++">POSITIVE +++</option>	
                                        										
										</select>
										</div>
									   </div>
									   <div class="form-group" >
										<label class="control-label col-md-3">Protein</label>
										<div class="col-md-4">
								<select name="options2" class="form-control" id="protein" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE +">POSITIVE +</option>
                                            <option value="POSITIVE ++">POSITIVE ++</option>	
                                            <option value="POSITIVE +++">POSITIVE +++</option>	
											<option value="TRACE">TRACE</option>	
                                        										
										</select>
										</div>
									   </div>
									    <div class="form-group" >
										<label class="control-label col-md-3">Glukosa</label>
										<div class="col-md-4">
								<select name="options2" class="form-control" id="glukosa" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE +">POSITIVE +</option>
                                            <option value="POSITIVE ++">POSITIVE ++</option>	
                                            <option value="POSITIVE +++">POSITIVE +++</option>	
								</select>
										</div>
									   </div>
						</div>
						</div>
														
															
											
											
												</div>
												<div class="col-md-6">
														
																			
											
														<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">	URINALISA[SEDIMEN]</h3>
								
							</div>	
	<div class="panel-body">	
						<div class="form-group" >
															<label class="control-label col-md-3">Leukosit</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="leukosit">
															</div>
															<div class="col-md-2">
															/lpb
															</div>
															</div>
						<div class="form-group" >
															<label class="control-label col-md-3">Erythrosit</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="erythrosit">
															</div>
															<div class="col-md-2">
															/lpb
															</div>
															</div>	
<div class="form-group" >
															<label class="control-label col-md-3">Selinder</label>
															<div class="col-md-9">
														<select name="options2" class="form-control" id="selinder" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE +">POSITIVE +</option>
                                            <option value="POSITIVE ++">POSITIVE ++</option>	
                                            <option value="POSITIVE +++">POSITIVE +++</option>	
								</select>
															</div>
															
</div>	
<div class="form-group" >
															<label class="control-label col-md-3">Epithel</label>
															<div class="col-md-9">
																<select name="options2" class="form-control" id="epithel" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE +">POSITIVE +</option>
                                            <option value="POSITIVE ++">POSITIVE ++</option>	
                                            <option value="POSITIVE +++">POSITIVE +++</option>	
								</select>
															</div>
															
</div>		
<div class="form-group" >
															<label class="control-label col-md-3">Bakteri</label>
															<div class="col-md-9">
														<select name="options2" class="form-control" id="bakteri" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE +">POSITIVE +</option>
                                            <option value="POSITIVE ++">POSITIVE ++</option>	
                                            <option value="POSITIVE +++">POSITIVE +++</option>	
								</select>
															</div>
														
</div>	
<div class="form-group" >
															<label class="control-label col-md-3">Kristal</label>
															<div class="col-md-9">
														<select name="options2" class="form-control" id="kristal" onchange="ambil_kota($(this).val())">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE +">POSITIVE +</option>
                                            <option value="POSITIVE ++">POSITIVE ++</option>	
                                            <option value="POSITIVE +++">POSITIVE +++</option>	
								</select>
															</div>
															
</div>															
						</div>
						</div>
														
															
											
											
												</div>
												
												</form>
												
												</div>
												
												</div>
												<div class="form-actions">
													<button class="btn green" id="simpan_urine" >
								<i class="fa fa-save"></i><div>Simpan</div>
									</button>
												</div>
												</div>
												</div>
												</div>
												</div>
	
	
	<div id="responsive4" class="modal fade "  aria-hidden="true">

								<div class="modal-dialog" >
									<div class="modal-content" >

									
<div class="modal-header" style="padding:5px;"><h4 class="modal-title">PEMERIKSAAN HEMATOLOGI</H4></div>									
										<div class="modal-body form">
										<div class="scroller" style="height:430px" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
												<form class="form-horizontal" role="form">
												<div class="col-md-6">
														
																			
											
												<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">Hematologi</h3>
								
							</div>							
					
						<div class="panel-body">	

						<div class="form-group" >
							<label class="control-label col-md-5">Hemoglobin</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="hemoglobin">
															</div>
															<div class="col-md-2">
															g/dl
															</div>
															</div>
								
						<div class="form-group">						
							<label class="control-label col-md-5">Hematokrit</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="hematokrit">
															</div>
															<div class="col-md-2">
															%
															</div>
							</div>
								<div class="form-group">						
							<label class="control-label col-md-5">Lekosit</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="lekosit">
															</div>
															<div class="col-md-2">
															10^3/UL
															</div>
							</div>
							<div class="form-group">						
							<label class="control-label col-md-5">Trombosit</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="trombosit">
															</div>
															<div class="col-md-2">
															10^3/UL
															</div>
							</div>
							<div class="form-group">						
							<label class="control-label col-md-5">Erithrosit</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="erithrosit">
															</div>
															<div class="col-md-2">
															10^6/UL
															</div>
							</div>
							<div class="form-group">						
							<label class="control-label col-md-5">PDW (Platelit Distribution Width)</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="pdw">
															</div>
															<div class="col-md-2">
															10^6/UL
															</div>
							</div>
								<div class="form-group">						
							<label class="control-label col-md-5">MPV (Mean Platelet Volume)</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="mpv">
															</div>
															<div class="col-md-2">
															fL
															</div>
							</div>
							<div class="form-group">						
							<label class="control-label col-md-5">PCT (Platelecrit)</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="pct">
															</div>
															<div class="col-md-2">
															%
															</div>
							</div>
								
						
						</div>
						</div>
											
												<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">INDEX</h3>
								
							</div>							
					
						<div class="panel-body">
						
						<div class="form-group" >
							<label class="control-label col-md-5">MCV</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="mcv">
															</div>
															<div class="col-md-2">
															fL
															</div>
															</div>
															<div class="form-group" >
							<label class="control-label col-md-5">MCH</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="mch">
															</div>
															<div class="col-md-2">
															pg
															</div>
															</div>
															<div class="form-group" >
							<label class="control-label col-md-5">MCHC</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="mchc">
															</div>
															<div class="col-md-2">
															g/dl
															</div>
															</div>
						
</div>
</div>						
															
											
											
												</div>
												<div class="col-md-6">
														
																			
											
														<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">Hitung Jenis</h3>
								
							</div>	
	<div class="panel-body">	
						<div class="form-group" >
															<label class="control-label col-md-5">Neutrofil %</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="neutrofil_persen">
															</div>
															<div class="col-md-2">
														%
															</div>
															</div>
						<div class="form-group" >
															<label class="control-label col-md-5">Basofil %</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="basofil_persen">
															</div>
															<div class="col-md-2">
														%
															</div>
															</div>	
															<div class="form-group" >
															<label class="control-label col-md-5">Eosinofil %</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="eosinofil_persen">
															</div>
															<div class="col-md-2">
														%
															</div>
															</div>	
															<div class="form-group" >
															<label class="control-label col-md-5">Limfosit %</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="limfosit_persen">
															</div>
											<div class="col-md-2">%</div>
															</div>	
															
															<div class="form-group" >
															<label class="control-label col-md-5">Monosit %</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="monosit_persen">
															</div>
											<div class="col-md-2">%</div>
															</div>	
<div class="form-group" >
															<label class="control-label col-md-5">Neutrofil #</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="neutrofil_pagar">
															</div>
															<div class="col-md-2">
														%
															</div>
															</div>
						<div class="form-group" >
															<label class="control-label col-md-5">Basofil #</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="basofil_pagar">
															</div>
															<div class="col-md-2">
														10 ^ 3/uL
															</div>
															</div>	
															<div class="form-group" >
															<label class="control-label col-md-5">Eosinofil #</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="eosinofil_pagar">
															</div>
															<div class="col-md-2">
														10 ^ 3/uL
															</div>
															</div>
															<div class="form-group" >
															<label class="control-label col-md-5">Limfosit #</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="limfosit_pagar">
															</div>
											<div class="col-md-2">10 ^ 3/uL</div>
															</div>	
															
															<div class="form-group" >
															<label class="control-label col-md-5">Monosit #</label>
															<div class="col-md-4">
																<input type="text" class="form-control" id="monosit_pagar">
															</div>
											<div class="col-md-2">	10 ^ 3/uL</div>
															</div>	
				
						</div>
						</div>
														
															
											
											
												</div>
												
												</form>
												
												</div>
												
												</div>
												<div class="form-actions">
													<button class="btn green" id="simpan_hematologi" >
								<i class="fa fa-save"></i><div>Simpan</div>
									</button>
												</div>
												</div>
												</div>
												</div>
												</div>
	
			<div id="responsive5" class="modal fade "  aria-hidden="true">

								<div class="modal-dialog" style="width:480px;" >
									<div class="modal-content" >

									
<div class="modal-header" style="padding:5px;"><h4 class="modal-title">PEMERIKSAAN FECES</H4></div>									
										<div class="modal-body form">
										<div class="scroller" style="height:480px" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
												<form class="form-horizontal" role="form">
												<div class="col-md-12">
												<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">	MAKROSKOPIK</h3>
								
							</div>							
					
						<div class="panel-body">	

						<div class="form-group" >
															<label class="control-label col-md-5">Warna Feses </label>
															<div class="col-md-5">
										<select name="options2" class="form-control" id="warna_feses">
											<option value=""></option>
											<option value="KUNING">KUNING</option>
											<option value="COKLAT">COKLAT</option>
											<option value="HIJAU">HIJAU</option>
											<option value="HITAM">HITAM</option>
										</select>
															</div>
															</div>
										<div class="form-group" >
										<label class="control-label col-md-5">Konsistensi Feses</label>
										<div class="col-md-5">
										<select name="options2" class="form-control" id="konsistensi_feses" >
											<option value=""></option>
											<option value="CAIR">CAIR</option>
											<option value="AGAK CAIR">AGAK CAIR</option>	
                                            <option value="LEMBEK">LEMBEK</option>	
                                            <option value="PADAT">PADAT</option>												
										</select>
										</div>
									   </div>
									  <div class="form-group" >
										<label class="control-label col-md-5">Darah</label>
										<div class="col-md-5">
										<select name="options2" class="form-control" id="darah" >
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE">POSITIVE</option>	                                            											
										</select>
										</div>
									   </div>
									   <div class="form-group" >
										<label class="control-label col-md-5">Lendir</label>
										<div class="col-md-5">
										<select name="options2" class="form-control" id="lendir" >
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE">POSITIVE</option>	                                            											
										</select>
										</div>
									   </div>
									
					</div>
						</div>
														
							
														<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">MIKROSKOPIK</h3>
								
							</div>	
	<div class="panel-body">	
						<div class="form-group" >
															<label class="control-label col-md-5">Bakteri</label>
															<div class="col-md-5">
									<select name="options2" class="form-control" id="bakteri_mikroskopik">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE">POSITIVE</option>                                           
								    </select>
															</div>
															<div class="col-md-2">
															
															</div>
															</div>
															<div class="form-group" >
															<label class="control-label col-md-5">Amoeba</label>
															<div class="col-md-5">
									<select name="options2" class="form-control" id="amoeba_mikroskopik" >
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="KISTA">KISTA</option>                                           
								    </select>
															</div>
															<div class="col-md-2">
															
															</div>
															</div>
															<div class="form-group" >
															<label class="control-label col-md-5">Leukosit</label>
															<div class="col-md-5">
									<input type="text" class="form-control" id="leukosit_mikroskopik" >
											
															</div>
															<div class="col-md-2">
															/lpb
															</div>
															</div>
						<div class="form-group" >
															<label class="control-label col-md-5">Erythrosit</label>
															<div class="col-md-5">
																<input type="text" class="form-control" id="erythrosit_mikroskopik">
															</div>
															<div class="col-md-2">
													
															</div>
															</div>	
<div class="form-group" >
															<label class="control-label col-md-5">Telur Cacing</label>
															<div class="col-md-5">
														<select name="options2" class="form-control" id="telur_cacing">
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE">POSITIVE</option>
                                          
								</select>
															</div>
															
</div>	
<div class="form-group" >
															<label class="control-label col-md-5">Lemak</label>
															<div class="col-md-5">
																<select name="options2" class="form-control" id="lemak_mikroskopik" >
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE">POSITIVE</option>
                                          
								</select>
															</div>
															
</div>	
<div class="form-group" >
															<label class="control-label col-md-5">Epithel</label>
															<div class="col-md-5">
																<select name="options2" class="form-control" id="epithel_mikroskopik" >
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE">POSITIVE</option>
                                          
								</select>
															</div>
															
</div>		

		
						</div>
						</div>
																						
									
														<div class="panel panel-primary">
<div class="panel-heading">
						<h3 class="panel-title">FESES RUTIN MIKROSKOPIK</h3>
								
							</div>	
	<div class="panel-body">
	<div class="form-group" >
															<label class="control-label col-md-5">Jamur</label>
															<div class="col-md-5">
																<select name="options2" class="form-control" id="jamur" >
											<option value=""></option>
											<option value="NEGATIVE">NEGATIVE</option>
											<option value="POSITIVE">POSITIVE</option>
                                          
								</select>
															</div>
															
</div>	
</div>

</div>	
											
												</div>
											
												</form>
												
												</div>
												
												</div>
												<div class="form-actions">
													<button class="btn green" id="simpan_feces" >
								<i class="fa fa-save"></i><div>Simpan</div>
									</button>
												</div>
												</div>
												</div>
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
								<i class="fa fa-edit"></i><div>&nbsp;&nbsp;&nbsp;LAB&nbsp;&nbsp;&nbsp;</div>
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



              <script type="text/javascript" src="jquery.js"></script>
<?php
switch($_GET[act]){
  // Tampil Berita
  default:
  ?>

   <style>
 .datatab,td{border-collapse:collapse;font:12px verdana,arial,sans-serif;}
.datatab td {padding:8px;}
#table tr td{border-bottom:#bfbfbf solid 1px;}
.datatab th {padding:8px; font-weight:600;border-bottom:#bfbfbf solid 1px;}
.datatab tr:hover td {background: #00aacc;color:#fff;}
.datatab tr.selected2 {background-color: #00aacc;color:#fff;}
tr{cursor: pointer; transition: all .25s ease-in-out}
.selected2{background-color: red; font-weight: bold; color: #0e7309;border-left:#4caf50 solid 8px;}
 input::-webkit-input-placeholder{
	color:  #C0B6B3    ;
	font-family:"Open Sans", sans-serif;
	opacity: 1;

}
.font12 {
	font-size:12px;
}
.table-advance {
		font-size:12px;
}
 </style>
	<script type="text/javascript">

$(document).ready(function() {
	$("#id_dokter").load( "modul/pg_pemeriksaan/perawat_dokter.php?op=dokter",{opsi:0});  
	$("#id_tindakan").load( "modul/pg_pemeriksaan/perawat_dokter.php?op=tindakan",{opsi:0,opsidata:0});  
	
	 $("#id_bhp").change(function(){
		  var x = document.getElementById('simpan_paket');
	var bhp= $("#id_bhp").val();
    $.post("modul/pg_pemeriksaan/bhp.php?op=detailbhp", {
			bhp : bhp
       },function (data, status) {			
		$("#data_bhp").html(data).show();  
	x.style.display = 'block';
        }  );
});	   
	<?php 
	if($_SESSION['level']=='dokter'){
		?>
	$("#data_pemeriksaan").html("<img src='assets/global/img/loading.gif' width='50px;'>");  
	$("#data_pemeriksaan").load("modul/pg_pemeriksaan/crud.php?op=caripasien");	
	<?php
	}
	?>
$("#data_pemeriksaan2").load("modul/pg_pemeriksaan/crud.php?op=caripasien");
$('.pane-hScroll5').scroll(function() {
$('.pane-vScroll2').width($('.pane-hScroll5').width() + $('.pane-hScroll5').scrollLeft());
});
$('.pane--table1').scroll(function() {
  $('.pane--table1 table').width($('.pane--table1').width() + $('.pane--table1').scrollLeft());
});


$("#caripemeriksaan").bind("click", function(event) {
var pasien = $("#nama_pasien").val();
var opsi  = $('input[name=option1]:checked').val();
var dokter = $("#pilih_dokter").val();
$("#data").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
    $.post("modul/pg_pemeriksaan/crud.php?op=caripasien", {
			pasien : pasien,
			opsi : opsi,
dokter : dokter			
	}, function (data, status) {	
		$("#data_pemeriksaan").html(data).show();  
        }  );
});

$("#pilih_dokter").change(function(){
 var pasien = $("#nama_pasien").val();
 var opsi   = $('#opsicari').val();
 var dokter = $("#pilih_dokter").val();
var ss = dokter.split(",");	
$("#data").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
$.post("modul/pg_pemeriksaan/crud.php?op=caripasien", {
			pasien : pasien,
			opsi : opsi,
            dokter : ss[0],
             poli  : ss[1]			
	}, function (data, status) {

			if(opsi == 0){
		$("#data_pemeriksaan").html(data).show();
		}else{
				$("#data_pemeriksaan2").html(data).show();
		}
        }  );
		
$.post("modul/pg_pemeriksaan/crud.php?op=caripoli", {
			 dokter: ss[0]		
	}, function (data, status) {	
		$("#data_poli").html(data);  
        }  );
		
	
});

$("#simpan_sign").bind("click", function(event) {
var medis_id=$("#medis_id7").val();
var bb=$("#BB").val();
var tb=$("#tb").val();
var nyeri=$("#nyeri").val();
var nadi =$("#nadi").val();
var resp=$("#resp").val();
var suhu=$("#suhu").val();
var tensi=$("#tensi").val();
var lk=$("#lk").val();
var subyektif=$("#subyektif").val();
$.post("modul/pg_pemeriksaan/crud.php?op=input_sign", {
        bb: bb,
		tb: tb,
		nyeri: nyeri,
		nadi: nadi,
		suhu: suhu,
		tensi: tensi,
		medis_id: medis_id,
		subyektif: subyektif,
		resp: resp,
		lk: lk
        }, function (data, status) {
		 $("#responsive").modal("hide");
        }  );
});
$("#simpan_paket").bind("click", function(event) {
	var id_bhp   =$("#id_bhp").val();
	var medis_id =$("#medis_id").val();
		$.post("modul/pg_pemeriksaan/bhp.php?op=simpan_paket", {
        id_bhp: id_bhp,
		medis_id: medis_id
        }, function (data, status) {
	       $("#hh").load( "modul/pg_pemeriksaan/bhp.php?op=tampilresepdetail",{medis_id:medis_id});
        });
});
$("#simpan_tindakan").bind("click", function(event) {
	var opsidata  = $('input[name=opsi]:checked').val();
	var opsi      = $('input[name=opsidokter]:checked').val();
    var cito      = $('input[name=cito]:checked').val();
	var medis_id  = $("#medis_id").val();
	var dokter    = $("#id_dokter").val();
	var tindakan  = $("#id_tindakan").val();
	var catatan   = $("#catatan").val();
	var tanggal   = $("#tgl_tindakan").val();
		$.post("modul/pg_pemeriksaan/tindakan.php?op=simpan_tindakan", {
        opsi: opsi,
		opsidata: opsidata,
		dokter: dokter,
		tindakan: tindakan,
		catatan: catatan,
        medis_id: medis_id,
        tanggal: tanggal,
        cito: cito		
        }, function (data, status) {
	     	 $("#list_tindakan").load( "modul/pg_pemeriksaan/tindakan.php?op=daftartindakan",{medis_id: ""+medis_id+""});
        });
});
$("#cetak_resi").bind("click", function(event) {
	var no_resep=$("#no_resep").html();
	var medis_id=$("#medis_id").val();
	win=window.open('modul/pg_daftarrawatjalan/cetak_resi.php?medis_id='+medis_id+'&no_resep='+no_resep,'win','width=900, height=600, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	win.print();
	
});
$("#simpan_resep").bind("click", function(event) {
	var jumlah = $("#jumlah_obat").val();
	var item_code =  $("#item_code").val();
	var harga     =  $("#harga_obat").val();
	var aturan    =  $("#aturan_pakai").val();
	var medis_id  =  $("#medis_id").val();
	var total     =  $("#total_obat").val();
	var nama_obat =  $("#nama_obat").val();
	var resep_id  =  $("#resep_id").val();
	if(item_code ==''){
		alert("Kode Item Harus Diisi");
		$("#item_code").focus();
		exit();
	}else if(jumlah==''){
		alert("Jumlah Item Harus Diisi");	
		$("#jumlah_obat").focus();
			exit();
	}else{
	$.post("modul/pg_pemeriksaan/bhp.php?op=simpan", {
        jumlah: ""+jumlah+"",
		item_code: item_code,
		harga: harga,
		aturan: aturan,
		medis_id: medis_id,
		total: total,
		resep_id: resep_id
        }, function (data, status) {
			$("#item_code").val("");
			$("#nama_obat").val("");
			$("#jumlah_obat").val("");
			$("#harga_obat").val("");
			$("#total_obat").val("");
			$("#aturan_pakai").val("");
	       $("#hh").load( "modul/pg_pemeriksaan/bhp.php?op=tampilresepdetail",{medis_id:resep_id});
        }  );
	}
	
});
});
function yesnoCheck($data) {
	$("#opsicari").val($data);
		 var opsi = $data;
		  var dokter = $("#pilih_dokter").val();
		  	 var ss = dokter.split(","); 
 	$("#data").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
    $.post("modul/pg_pemeriksaan/crud.php?op=caripasien", {
		opsi : opsi,
		dokter: ss[0],
		poli : ss[1]
	}, function (data, status) {
		if(opsi == 0){
		$("#data_pemeriksaan").html(data).show();
		}else{
				$("#data_pemeriksaan2").html(data).show();
		}
        }  );
}
function GetMed(id,id_pasien,status) {
	
		if(status==2){
				var benar=0;
				alert("Pasien Sudah Diperiksa, Anda Hanya Diizinkan Melihat Data Rekam Medis");
				$('#draggable').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/formperiksa.php?aksi="+benar+"&id="+id+"&pasien_id="+id_pasien+"&rawat="+rawat);				
				$('#selesai').hide();	
				
	            exit();
			}else if(status==0){
				var benar=1;
				 if(confirm ("Tandai Sebagai Pasien Yang Sedang Diperiksa Dokter ?")==true){
	        		 window.location = "<?php  echo $url; ?>/media.php?module=pemeriksaan&act=rekammedis&medis_id="+id+"&pasien_id="+id_pasien+"&rwt=RJ&status_antri=belum";
			 }
			}else if(status==1 || status==3){
				var benar=0;
		 window.location = "<?php  echo $url; ?>/media.php?module=pemeriksaan&act=rekammedis&medis_id="+id+"&pasien_id="+id_pasien+"&rwt=RJ&status_antri=sudah";		
			}
		
}
function Opsi(data) {
	  var opsidata  = $('input[name=opsi]:checked').val();
	var opt = data;
	if(opt == 0 ){
		$("#label_opsi").html("Dokter");
			$("#id_dokter").load( "modul/pg_pemeriksaan/perawat_dokter.php?op=dokter",{opsi:0});  
			$("#id_tindakan").load( "modul/pg_pemeriksaan/perawat_dokter.php?op=tindakan",{opsi:0,opsidata: opsidata});  
	}else {
		$("#label_opsi").html("Perawat");
		$("#id_dokter").load( "modul/pg_pemeriksaan/perawat_dokter.php?op=dokter",{opsi:1});  
		$("#id_tindakan").load( "modul/pg_pemeriksaan/perawat_dokter.php?op=tindakan",{opsi:1,opsidata: opsidata});  
	}
	
}
function Opsion(data) {
	  var opsidata  = data;
	var opt = $('input[name=opsidokter]:checked').val();
			$("#id_tindakan").load( "modul/pg_pemeriksaan/perawat_dokter.php?op=tindakan",{opsi:opt,opsidata: opsidata});  	
}
function opsibhp(data) {
    $.post("modul/pg_pemeriksaan/bhp.php?op=modecari", {
		opsi : data		
	}, function (data, status) {	
		$("#model").html(data);		
        }  );
}
function caripasien(inputString){
	 var opsi   = $('#opsicari').val();
    var dokter = $("#pilih_dokter").val();
	 var ss = dokter.split(","); 
 	$("#data").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
    $.post("modul/pg_pemeriksaan/crud.php?op=caripasien", {
			pasien : inputString,
			opsi : opsi,
dokter: ss[0],
		poli : ss[1]	
	}, function (data, status) {
if	(opsi == 0){	
		$("#data_pemeriksaan").html(data).show();  
}else{
	$("#data_pemeriksaan2").html(data).show();  
}
        }  );

}

function Tindakan(id,id_pasien,nama) {
	 $("#list_tindakan").load( "modul/pg_pemeriksaan/tindakan.php?op=daftartindakan",{medis_id: ""+id+""});
		$('#data_tindakan').modal('show');	
		$('#medis_id').val(id);	
		$('#data_pasien').html(""+nama+"");	
}
function filobat2(thisValue) {
	  $.post("modul/pg_pemeriksaan/bhp.php?op=detail_obat", {
            kode_obat: ""+thisValue+""
        },function (data, status) { 
              $("#nama_obat").val(""+thisValue+"");     
        $("#data_resep1").html(data); 					 
$('#suggestions3').fadeOut();    
           });	
	
}function jumlah(thisValue) {
	var a= thisValue;
	var b=  $("#harga_obat").val();
	var c=a*b;
	 $("#total_obat").val(c);
	
}
function inputobatbhp(thisValue) {
var x = document.getElementById('simpan_resep');
    $.post("modul/pg_pemeriksaan/bhp.php?op=detail_obat", {
            kode_obat: ""+thisValue+""
    },function (data, status) { 
      $("#item_code").val(""+thisValue+"");     
      $("#data_resep1").html(data); 					 
$('#suggestions9').fadeOut();   
$("#jumlah_obat").focus();
x.style.display = 'block';
           });		
}
function hapus_detail(medis,code) {
	 if(confirm ("Anda Ingin Menghapus ?")==true){
		   $.post("modul/pg_pemeriksaan/bhp.php?op=hapusdetail", {
            medis_id: ""+medis+"",
			code_item: ""+code+""
        },function (data, status) {          	
		  $("#hh").load( "modul/pg_pemeriksaan/bhp.php?op=tampilresepdetail",{medis_id: ""+medis+""});
		});
	 }
}
function hapus_tindakan(medis,code) {	
	 if(confirm ("Anda Ingin Menghapus ?")==true){
		   $.post("modul/pg_pemeriksaan/tindakan.php?op=hapustindakan", {
            medis_id: ""+medis+"",
			code_item: ""+code+""
        },function (data, status) {          	
			 $("#list_tindakan").load( "modul/pg_pemeriksaan/tindakan.php?op=daftartindakan",{medis_id: ""+medis+""});
		});
	 }
}
function CetakSurat(id,id_pasien) {
	var id=id;
	
	if(id !='' ){ 
		$("#modal-body8").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
        $.post("modul/pg_daftarrawatjalan/cetak.php?op=skdp", {
            id: id,
			id_pasien:id_pasien
        },function (data, status) {          	
			$('#modal_skdp').modal("show");
            $("#data_skdp").html(data).show(); 	
            $("#tanggal").removeClass("datepicker").datepicker(); 
		    $("#tgl_rujuk").removeClass("datepicker").datepicker(); 	
           });	
		}else {
				var answer = confirm("Maaf Cek Salah Satu");
		}
}
function CetakSuratResume(id,id_pasien,rawat) {
	 win=window.open('modul/pg_daftarrawatjalan/Resummedis.php?medis_id='+id+'&pasien_id='+id_pasien+'&rawat='+rawat,'win','width=900, height=600, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	 win.print();	
}
function Entribhp(id,id_pasien,rawat,dr_id) {
	$('#medis_id').val(id);
			var rawat = rawat;
			var id=id;
			$.post("modul/pg_pemeriksaan/bhp.php?op=inputbhp", {
            id: ""+id+"",
			rawat: rawat,
			pasien_id: id_pasien,
			dr_id: ""+dr_id+""
        },
        function (data, status) {
			var res=data.split("|");
			  $("#hh").load( "modul/pg_pemeriksaan/bhp.php?op=tampilresepdetail",{medis_id: ""+res[1]+""});
			$('#no_resep').html(res[0]);	
            $('#resep_id').val(res[1]);			
           }
         );
	  $('#modal_resep').modal("show");
  	
}
function VitalSign($data) {
				  // at-least one checkbox checked
				var id = ""+$data+"";
				  $("#medis_id7").val(id);
			$.post("modul/pg_pemeriksaan/crud.php?op=detail_periksa", {
            id: id
        },
        function (data, status) {
			   var user = JSON.parse(data);
               $("#BB").val(user.BB); 
               $("#tb").val(user.TB);  			   
			   $("#tensi").val(user.TENSI);  
			   $("#nadi").val(user.NADI);  
			   $("#resp").val(user.RESP);
                $("#nyeri").val(user.NYERI);
				 $("#suhu").val(user.SUHU);
				  $("#lk").val(user.LK);
           }
         );
	   $('#responsive').modal('show');							
				}
function obat2(inputString){
	if(inputString.length == 0) {
		$('#suggestions3').show();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/obat2.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions3').fadeIn();
				$('#suggestionsList3').html(data);
			}
		});
	}
}
function nobat2(inputString){
if(inputString.length == 0) {
		$('#suggestions9').show();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/obat2.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions9').fadeIn();
				$('#suggestionsList9').html(data);
			}
		});
	}
}
</script>	
		
	<div class="page-content">

			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
						<li>
						<a href="#">Rawat Jalan</a>
							<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Form Pemeriksaan</a>						
					</li>
					
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle"   data-delay="1000" data-close-others="true" style="font-size:14px;">
					<strong> <?php echo tgl_indo($tgl_sekarang2); ?></strong>
						</button>
				
					</div>
				</div>
				
			
</div>
<div class="row">
<?php

$sql="	SELECT 
A.NAME AS DOKTER,
B.NAME AS POLI,
A.POLI_ID AS POL_ID
FROM
RS_DOKTER A JOIN RS_POLIKLINIK B ON A.POLI_ID=B.POLI_ID WHERE A.DR_ID='$_SESSION[dokter]'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
?>
	<div class="col-xs-12">
		<div class="portlet light bordered" style="padding-left:60px;padding:5px 2px 3px 3px">
									<div class="portlet-body form">
										<form class="form-horizontal" role="form">
											<div class="form-body" style="font-size:14px;font-weight:700px;padding:0px;">										
												<div class="row">
													<div class="col-md-4">
														<div class="form-group" style="margin-bottom:0px;">
															<label class="control-label col-md-3">Dokter <?php echo $_SESSION['level']; ?> </label>
															<div class="col-md-9">
																<?php
						 $sql1="SELECT  
						 DISTINCT T.NAME AS nama,
						 T.DR_ID AS kode,
						 T.POLI_ID AS poli
						 
						  From 
						 rs.RS_PASIEN_MEDIS AS P LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
						 LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID Where CONVERT(VARCHAR(10),P.DATETIME_MEDIS,103) = CONVERT(VARCHAR(10),GETDATE(),103) AND P.STATUS_BAYAR = 0 AND t.name is not null group by t.name, t.dr_id,t.poli_id ORDER BY T.NAME ";
						 $params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
if($_SESSION['level']!='dokter'){
	echo"<div class='input-group'><span class='input-group-addon'>
											<i class='fa fa-user-md'></i>
											</span><select id='pilih_dokter' class='form-control select2me'>
											<option value=''>Pilih Nama Dokter</option>";
	
							 while($data1=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
						
								 echo"	
								 <option value='$data1[kode],$data1[poli]'>$data1[nama]</option>";
							 }
							echo"</select></div>";
}else{
	echo"<input type='hidden' value='$_SESSION[dokter],$_SESSION[polid]' id='pilih_dokter'>
																<p class='orm-control-static'>
																<span class='font'><strong> $data[DOKTER];</strong></span>
																</p>
																";
}
?>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-2">Poliklinik</label>
															<div class="col-md-9">
																<p class="form-control-static">
																		<span class="font" id="data_poli"> <strong><?php echo $data['POLI']; ?></strong></span>
																</p>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>												
												</div>
											</div>
										</form>
									</div>
								
					
						</div>
						
<div class="col-md-12">
				
				
										
<div id="modal_skdp" class="modal fade"  aria-hidden="true">

								<div class="modal-dialog" style="width:90%;" >
									<div class="modal-content" style="height:680px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">SKDP</h4>
										</div>
										<div class="modal-body" >
										<div id="data_skdp" class="scroller" style="height:560px" data-always-visible="1" data-rail-visible1="1">
										
										</div>
									</div>
								</div>
							</div>
</div>

<div id="modal_resep" data-backdrop="static" data-keyboard="false" class="modal fade"  aria-hidden="true">

								<div class="modal-dialog" style="width:90%;" >
									<div class="modal-content" style="height:675px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title" id="no_resep">RESEP</h4>
										</div>
										<div class="modal-body" >
										<div id="data_skdp" class="scroller" style="height:560px" data-always-visible="1" data-rail-visible1="1">
										<div class="col-md-6">
										<table  class="table table-hover">
										<thead>
										<tr>
										<th>KODE ITEM</th>
										<th>NAMA ITEM</th>
										<th>JUMLAH(Rp)</th>
										<th>ATURAN PAKAI</th>
										</tr>
										</thead>
											<tbody id="hh">
										
										</tbody>
										</table>
									
									</div>
										<div class="col-md-6">
										<div class="col-md-12">
										<div class="col-md-12">
											<form action="#" id="form_sample_1" class="form-horizontal">
										
									
										<div class="note note-info">
										<div class="tabbable-custom">
								<ul class="nav nav-tabs">
								<li class="active">
									<a href="#portlet_bhp1" data-toggle="tab" onclick="yesnoCheck(0)">
									PER ITEM</a>
								</li>
						<li >
									<a href="#portlet_bhp2" data-toggle="tab" onclick="yesnoCheck(1)">
									PER PAKET</a>
								</li>
							<input type="hidden" id="medis_id">
									<input type="hidden" id="resep_id">
								
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="portlet_bhp1">
									<div class="form-group">
									<label class="control-label col-md-3" >
									Kode Item
										</label>
											<div class="col-md-9">
											<input type="text" class="form-control" id="item_code" placeholder="Cari Nama Obat" autocomplete="off" onKeyUp="nobat2(this.value);">
											 <div class="suggestionsBox9" id="suggestions9" style="display: none;">
				   <div class="suggestionList9" id="suggestionsList9"> &nbsp; </div>
				   <button id="closeobat" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
											</div>
											</div>
												
											<div id="data_resep1">
										
											</div>
										<div class='modal-footer'>
									<button type='button' class='btn green' id='simpan_resep' style="display:none;">Simpan</button>
							
									</div>
									</div>
									<div class="tab-pane" id="portlet_bhp2">
									<div class="form-group">
									<select class="form-control select2me" id="id_bhp" name="options2" onchange="ambil_kota($(this).val())">
		<?php	
$sql="SELECT * FROM BHP_MASTER";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query($conn,$sql,$params,$options);
while($row=sqlsrv_fetch_array($stmt)){
	echo"<option value='".$row['ID_BHP']."'>".$row['NAMA_BHP']."</option>";

}						
?>
								</select>
								</div>
								<div class="form-group">
								<div id="data_bhp">
								
								</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn green" id="simpan_paket" style="display:none;">Simpan</button>
									
									</div>
								<!--
								<div class="form-group">
									<label class="control-label col-md-3" >
									Nama Racikan 
										</label>
											<div class="col-md-9">
											<input type="text" class="form-control" id="nama_obat1" placeholder="Nama Racikan" onKeyUp="obat(this.value);">
										</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" >
									Harga
										</label>
											<div class="col-md-9">
											<input type="text" class="form-control"  placeholder="Harga" onKeyUp="obat(this.value);">
										</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" >
									PPN
										</label>
											<div class="col-md-9">
											<input type="text" class="form-control" id="ppn" placeholder="PPN" onKeyUp="obat(this.value);">
										</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" >
									DISCOUNT
										</label>
											<div class="col-md-9">
											<input type="text" class="form-control" id="discount"  onKeyUp="obat(this.value);">
										</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" >
									HARGA TOTAL
										</label>
											<div class="col-md-9">
											<input type="text" class="form-control" id="harga_total" placeholder="Harga Total" onKeyUp="obat(this.value);">
										</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" >
									CATATAN
										</label>
											<div class="col-md-9">
											<textarea class="form-control" id="catatan_resep"></textarea>
										</div>
								</div>
								-->
									</div>
								</div>
								</div>
								
											
										</div>
										</form>
										</div>
										<!--
										<div class="col-md-4">
											<form action="#" id="form_sample_1" class="form-horizontal">
												<div class="note note-info">
												<div class="form-group">
									<label class="control-label col-md-12" >
									Refisi Resep Oleh Farmasi
										</label>
											<div class="col-md-12">
											<textarea class="form-control" id="catatan_refisi" rows="10"></textarea>
										</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn green" id="simpan_perubahan">Simpan Perubahan Resep</button>
									</div>
								</div>
											</form>
										</div>
										-->
										</div>
										</div>
										</div>
									
									</div>
										<div class="modal-footer">
									<button type="button" class="btn green" id="cetak_resi">Cetak Resi</button>
											<button type="button" data-dismiss="modal" class="btn red" id="simpan_paket"  ><i class="fa fa-times"></i> Tutup</button>
									</div>
								</div>
							</div>
</div>
																
<div class="col-md-12">										
<div id="responsive" class="modal fade"  tabindex="-1" data-width="760">

								<div class="modal-dialog" >
									<div class="modal-content" style="height:490px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Vital Sign</h4>
										</div>
										<div class="modal-body">
										<div class="scroller" style="height:380px" data-always-visible="1" data-rail-visible1="1">
										
												<div class="row">
													<form action="#" id="form_sample_1" class="form-horizontal">
										<div class="col-md-12">
										<div class="form-group">
		<label class="control-label col-md-4" style="text-align:left;" >Subyektif<span class="required"></label>
											<div class="col-md-12" >
									
												<textarea class="form-control" id="subyektif" style="height:100px;">
												</textarea>

										</div>
		</div>
										</div>
											<div class="col-md-12">
											<div class="col-md-6">
											<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">Tensi
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="tensi" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">mmHg</button></span>	
</div>									
										</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">Suhu
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="suhu" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">&deg; C</button></span>	
</div>									
										</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">Nadi
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="nadi" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">x/Menit</button></span>	
</div>									
										</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">Resp
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="resp" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">x/Menit</button></span>	
</div>									
										</div>
										</div>
										
									
							
										
									</div>
										<div class="col-md-6">
										<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">BB
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="BB" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">KG</button></span>	
</div>									
										</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">TB
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="tb" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">CM</button></span>	
</div>									
										</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">Nyeri
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="nyeri" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">1-10</button></span>	
</div>									
										</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-4" style="text-align:left;">LK
										</label>
										<div class="col-md-8">
										<div class="input-group">
										<input type="text"  id="lk" class="form-control" >	
									
<span class="input-group-btn">	<button class="btn btn-success">CM</button></span>	
</div>									
										</div>
										</div>
										</div>
								
										</div>
										</div>
										</form>
											
												
												</div>
												<div class="modal-footer">
												<input type="hidden" id="medis_id7">
											<button type="button" data-dismiss="modal" class="btn default">Close</button>
											<button type="button" class="btn green" id="simpan_sign">Simpan</button>
										</div>	
												</div>
												</div>
												</div>
												</div>
												<div id="data_periksa" class="modal fade "   tabindex="-1" data-backdrop="static" data-keyboard="false" >

								<div class="modal-dialog modal-dialog modal-full" style="margin: 0px auto;">
									<div class="modal-content" style="height:705px;">									
										<div id="modal-body8" class="modal-body" style="height:500px" data-always-visible="1" data-rail-visible1="1">												
												</div>											
												<input type="hidden" id="medis_id2">
													<input type="hidden" id="kategori" value="RJ">
																					</div>
												</div>
												</div>
												
												<div id="data_tindakan" class="modal fade"   tabindex="-1" data-backdrop="static" data-keyboard="false" >

								<div class="modal-dialog modal-dialog modal-full" style="margin: 0px auto;">
									<div class="modal-content" style="height:600px;">	
<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title" style="float:right;margin-right:10px;">TINDAKAN PASIEN </h4>
											<h4 class="modal-title" id="no_resep"><span id="data_pasien"></span></h4>
										</div>									
										<div id="modal-body8" class="modal-body" style="height:500px" data-always-visible="1" data-rail-visible1="1">
	<div class="col-md-6">	
		<table style="width:100%;border-collapse:collapse;" class="table table-striped table-bordered table-advance table-hover ">
						<thead>
						
						    <tr>						
							<th style="width:120px;">
								 ID TINDAKAN
							</th>
							<th style='width:150px;'>
								NAMA
							</th>
							<th class="hidden-480" style="width:200px;">
								DOKTER/PERAWAT
							</th>
							<th class="hidden-480"  style="width:100px;">
								CATATAN
							</th>
						   </tr>
						</thead>
						<tbody id="list_tindakan">
						
						</tbody>
		</table>
	</div>
	<div class="col-md-6">										
		<form action="#" id="form_sample_1" class="form-horizontal">
			<div class="alert alert-info"  style="padding:3px;margin-bottom:5px;">
		<div class="radio-list" >
											<label class="radio-inline">											
										<input type="radio" name="opsi" value="0" id="optionsRadios4"  checked onclick="Opsion(0)"> Tindakan </label>
											<label class="radio-inline">
										<input type="radio" name="opsi" value="1" id="optionsRadios5"  onclick="Opsion(1)"> Operasi</label>
<label class="radio-inline">
										<input type="radio" name="opsi" value="2" id="optionsRadios5" onclick="Opsion(2)"> Persalinan</label>										
		</div>
		</div>
		<div class="alert alert-info"  style="padding:3px;">
		                            <div class="radio-list" >
										<label class="radio-inline">											
										<input type="radio" name="opsidokter" value="0" id="optionsRadios4" value="dokter" checked onclick="Opsi(0)"> Tindakan Dokter</label>
											<label class="radio-inline">
										<input type="radio" name="opsidokter"  value="1"  id="optionsRadios5" value="perawat" onclick="Opsi(1)"> Tindakan Perawat</label>
		                             </div>
		</div>		
			<div class="form-group">
						<label class="control-label col-md-3" id="label_opsi" > Dokter</label>
							<div class="col-md-9">
							<select  class="form-control select2me" id="id_dokter" >													
											</select>
							</div>
			</div>
			<div class="form-group">
						<label class="control-label col-md-3" id="label_opsi" > Tindakan</label>
							<div class="col-md-6">
								<select  class="form-control select2me" id="id_tindakan" >													
											</select>
							</div>
								<div class="col-md-3">
								<label>
								<input type="checkbox" id="cito" value="-CITO-" name="cito"> CITO (KHUSUS HD) 
								</label>
								</div>
			</div>
			<div class="form-group">
						<label class="control-label col-md-3" >Catatan</label>
							<div class="col-md-9">
							<textarea class="form-control" id="catatan">
							</textarea>
							</div>
			</div>
			<div class="form-group">
										<label class="control-label col-md-3">Tanggal
										</label>
										<div class="col-md-4">
										<div class="input-group date datetime-picker margin-bottom-5"  data-date-format="dd/mm/yyyy hh:ii">
															<input type="text" id="tgl_tindakan" class="form-control form-filter input-sm" value="<?php echo $tgl_sekarang1." ".$jam; ?> "  name="product_history_date_from" placeholder="From">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
										</div>
										</div>
		</form>
    </div>		
	
												</div>	
	<div class='modal-footer'>
									<button type='button' class='btn green' id='simpan_tindakan' >Simpan</button>
							
									</div>													
												<input type="hidden" id="medis_id2">
													<input type="hidden" id="kategori" value="RJ">
																					</div>
												</div>
										
												</div>
</div>

</div>
<div class="row">
<div class="col-xs-12">
		<div class="portlet-body">
							<div class="tabbable-custom">
								<ul class="nav nav-tabs">
								<li class="active">
									<a href="#portlet_tab1" data-toggle="tab" onclick="yesnoCheck(0)">
									PASIEN BELUM DI PERIKSA</a>
								</li>
							<li>
									<a href="#portlet_tab2" data-toggle="tab" onclick="yesnoCheck(1)">
									PASIEN SUDAH DIPERIKSA </a>
								</li>
							
								<li  style="float:right;">
								<input type="hidden" id="opsicari" value="0">
									<div class="input-group input-large" style="float:right;">
											 <input type="text" name="nama_pasien" onKeyUp="caripasien(this.value);"  id="nama_pasien" class="form-control"  placeholder="Cari Nama Pasien"  onBlur="fill2();" id="kode" size="15"/> 
				  	<span class="input-group-addon">
											<i class="fa fa-search"></i>
											</span>
											<input type="hidden"  id="pasien_id">
				  </div>
								</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="portlet_tab1">
										<input type="hidden" id="get_medis">
	<input type="hidden" id="get_pasien">


							<table style="width:100%;border-collapse:collapse;" class="table table-striped table-bordered table-advance table-hover ">
						<thead>
						<tr>
						
							<th style="width:70px;">
								 No. Antri
							</th>
							<th style='width:60px;'>
								No. RM
							</th>
							<th class="hidden-480">
								Nama Pasien
							</th>
							<th class="hidden-480" style="width:300px;">
								Alamat
							</th>
							<th class="hidden-480"  style="width:100px;">
								Tipe Pasien
							</th>
							<th class="hidden-480">
								Aksi
							</th>
						</tr>
						</thead>
						<tbody id="data_pemeriksaan">
					
						</tbody>
						</table>
			
									</div>
									<div class="tab-pane" id="portlet_tab2">
									<input type="hidden" id="get_medis">
	<input type="hidden" id="get_pasien">
<div class="table-scrollable">
							<table style="width:100%;" class="table table-striped table-bordered table-advance table-hover  " >
						<thead>
						<tr>
						
							<th style="width:50px;">
								 No. Antri
							</th>
							<th style='width:60px;'>
								No. RM
							</th>
							<th class="hidden-480" style="width:28%;">
								Nama Pasien
							</th>
							<th class="hidden-480"  style="width:30%;">
								Alamat
							</th>
							<th class="hidden-480" style="width:80px;">
								Tipe Pasien
							</th>
							<th class="hidden-480">
								Aksi
							</th>
						</tr>
						</thead>
						
						<tbody id="data_pemeriksaan2">
						<?php
/*
						    $sql1 = "SELECT  P.ANTRIAN ,P.MEDIS_ID,P.PASIEN_ID, Q.NO_RM,Q.NAME,Q.ADDRESS,asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM' WHEN 3 THEN R.NAME END From rs.RS_PASIEN_MEDIS AS P left JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID left JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID left JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID =S.POLI_ID LEFT JOIN rs.RS_DOKTER ON P.DR_ID = rs.RS_DOKTER.DR_ID  Where CONVERT(VARCHAR(10),P.DATETIME_MEDIS,103) = CONVERT(VARCHAR(10),GETDATE(),103) AND  P.POLI_ID  = '$data[POL_ID]' and P.DR_ID  = '$_SESSION[dokter]' and P.PASIEN_ID = Q.PASIEN_ID AND P.STATUS_BAYAR = '0' AND P.STATUS_ANTRI <> 2  Order By P.ANTRIAN ";
$stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$no=1;
 while($data1=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 echo"<tr><td><input type='checkbox'  class='deleteRow' name='cek' value='".$data1['MEDIS_ID']."'  /></td><td>$data1[ANTRIAN]</td><td>$data1[NO_RM]</td><td>$data1[NAME]</td><td>$data1[ADDRESS]</td><td>$data1[asuransi_pasien]</tr>";
 }
 */
						?>
						</tbody>
				</table>
									</div>
									
								</div>
							</div>
						
						</div>
					</div>
				</div>
				
		
		
</div>
<?php
break;  
case "rekammedis":  
include"inc/umur.php"; 

include"inc/label.php";

if($_GET['status_antri']=='belum'){
		$sql3="update RS_PASIEN_MEDIS set STATUS_ANTRI='1' WHERE MEDIS_ID='".$_GET['medis_id']."' "; 
	 sqlsrv_query( $conn, $sql3);
}
$sql="SELECT B. NAME AS DOKTER_NAME,
A.DR_ID AS DOKTER,A.STATUS_ANTRI,D.PASIEN_ID,C.NAME AS POLI,A.ANTRIAN,D.NAME AS NAMA_PASIEN,D.NO_RM,
D.ALERGI,
 CONVERT(VARCHAR(11),D.TGL_LAHIR,103) AS TGL_LAHIR,
  CONVERT(VARCHAR(11),D.TGL_LAHIR,120) AS TGL_LAHIR2,
  E.NAME AS ASURANSI,D.ASURANSI_POLIS
 FROM RS_PASIEN_MEDIS A JOIN RS_DOKTER B ON A.DR_ID=B.DR_ID JOIN RS_POLIKLINIK C ON A.POLI_ID=C.POLI_ID JOIN RS_PASIEN D ON A.PASIEN_ID=D.PASIEN_ID LEFT JOIN RS_ASURANSI E ON D.ASURANSI_ID=E.ASURANSI_ID WHERE A.MEDIS_ID='".$_GET['medis_id']."'";
$params = array();
$stmt = sqlsrv_query($conn,$sql,$params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$dataku=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$antrian=$data['STATUS_ANTRI'];
	$sql3="update RS_PASIEN_MEDIS set STATUS_ANTRI='1' WHERE MEDIS_ID='".$_GET['medis_id']."' "; ?>
		<style type="text/css">
					.rows:hover {
						background:#CCCCCC;
						cursor:pointer;
					}						
					.obat th{
						background:#CCCCCC;
						font-weight:600;
					}
					.ui-dialog{
						background-color:#fff;
					}
					textarea#pemeriksaan {
    width:97%;
    display:block;
    max-width:100%;
    line-height:1.5;
    padding:15px 15px 30px;
    border-radius:3px;
    border:1px solid #F7E98D;
    font:12px Tahoma, cursive;
    transition:box-shadow 0.5s ease;
    box-shadow:0 4px 6px rgba(0,0,0,0.1);
    font-smoothing:subpixel-antialiased;
    background:linear-gradient(#F9EFAF, #F7E98D);
    background:-o-linear-gradient(#F9EFAF, #F7E98D);
    background:-ms-linear-gradient(#F9EFAF, #F7E98D);
    background:-moz-linear-gradient(#F9EFAF, #F7E98D);
    background:-webkit-linear-gradient(#F9EFAF, #F7E98D);
} textarea#laboratorium, .konten {
	width:100%;
     max-width:100%;
    line-height:1.5;
    border-radius:3px;
    border:1px solid #fcf8e3;
    font:11px Tahoma, cursive;
    transition:box-shadow 0.5s ease;
	background:#fcf8e3;
 
	color:#394c3b;
	overflow-y:auto;

}textarea#resep{
	width:97%;
     max-width:90%;
    line-height:1.5;
    border-radius:3px;
    border:1px solid #fcf8e3;
    font:11px Tahoma, cursive;
    transition:box-shadow 0.5s ease;
	background:#fcf8e3;
 
	color:#394c3b;
	
}
.wrap{
	width: 99.7%;
	 overflow-y:scroll;
	 padding-right:5px;
	 height:700px;
}
.wrop{
	width: 37.5%;
	;
}

/*css3 design scrollbar*/
::-webkit-scrollbar {
    width: 5px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.3);     
    background:  #45a440;    
} 
::-webkit-scrollbar-thumb {
    background: #0a8022;
}

#result {
	position: absolute;
	height:20px;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:12px;
}.suggestionsBox {
	left: 13px;
	margin: 0px 0px 0px 0px;

	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
	position:absolute;
	width:97%;
}
.suggestionsBox5 {

	margin: 0px 0px 0px 0px;

	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
	position:absolute;
}.suggestionsBox3,.suggestionsBox1 {

	left: 13px;
	margin: 0px 0px 0px 0px;
	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
	position:absolute;
}.suggestionList {
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
.pane {
  background: #eee;
}
.pane-hScroll5 {
  overflow: auto;
}
.pane-vScroll2 {
  overflow-y: auto;
  overflow-x: hidden;
  max-height: 295px;
  color:#000;
}
.pane-vScroll table tr{
	font-size:12px;
}
.pane-hScroll1 table tr th{
	font-size:12px;
}
.pane-vScroll2 table {
	font-size:12px;
}
.pane-hScroll2 table tr th{
	font-size:12px;
}
.pane-vScrol3 table{
	font-size:11px;
}
.pane-vScroll3 {
  overflow-y: auto;
  overflow-x: hidden;
  max-height: 420px;
  color:#000;
}
.panel-body.table font12 tr td {
	font-size:12px;
}
table.scroll {width:280px;border:1px #a9c6c9 solid;font:12px verdana,arial,sans-serif;color:#333333;}
table.scroll thead {display:table;width:100%;}
table.scroll tbody {display:block;height:300px;overflow:auto;float:left;width:100%;}
table.scroll tbody tr {display:table;width:100%;}
table.scroll  td.tanggal {width:80px;padding:3px;}
table.scroll  th.tanggal {width:80px;padding:3px;}
table.scroll  td.poli {width:140px;padding:3px;}
table.scroll  th.poli {width:135px;padding:3px;}
table.scroll  td.rj {width:35px;padding:3px;}
table.scroll  th.rj {width:30px;padding:3px;}
table.scroll th {background-color:#000099;color:#ffffff;}
#cetak_rm {
	       color: #fff;
    background-color: #0a8022;
    height: 44px;
     border-color: #0a8022;
     border-bottom: none;
    border-right: none;
    cursor: pointer;
}
#selesai {
	       color: #fff;
    background-color: #0a8022;
     border-color: #0a8022;
     border-bottom: none;
    border-right: none;
    cursor: pointer;
}.tabel th{
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
	<script>
	$(document).ready(function() {
		 var x = document.getElementById('input_pemeriksaan');
         var y = document.getElementById('cetak_rm');
		 $.post("modul/pg_daftarrawatjalan/crud.php?op=cek", {
            id: "<?php echo $_GET['medis_id']; ?>"
        },function (data, status) {
			if(data==2 ){
					 x.style.visibility = 'hidden';
					 y.style.visibility = 'visible';
			}else {
				     x.style.visibility = 'visible';
					   y.style.visibility = 'hidden';
			}
	});
	$("#cetak_rm").bind("click", function(event) {
	var kategori= $("#kategori").val();
    var medis_id= $("#medis_id2").val();
	 win=window.open('modul/pg_daftarrawatjalan/rm_harian.php?medis_id='+medis_id+'&rawat='+kategori,'win','width=900, height=600, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	 win.print();	
	 });
	});
	

function cekdokter() {
	var pasien =$("#id_pasien").val();
var dokter =$("#id_dokter").val();
  // Get the checkbox
  var checkBox = document.getElementById("cek_dokter");
  if (checkBox.checked == true){
	  var set=1;
       $.post("modul/pg_daftarrawatjalan/crud.php?op=datapemeriksaan", {
            set: set,
			pasien:pasien,
			dokter:dokter
        }, function (data, status) {
			$("#dataperiksa").html(data).show(); 
	     
        }  );
  } else {
	  var set=0;
   $.post("modul/pg_daftarrawatjalan/crud.php?op=datapemeriksaan", {
            set: set,
			pasien:pasien,
		    dokter:dokter
        }, function (data, status) {
		$("#dataperiksa").html(data).show(); 
        }  ); 
  }
}
function Tutup(med){
	var medis_id=""+med+"";
	 $.post("modul/pg_daftarrawatjalan/crud.php?op=cekdiagnosa", {
            medis_id: ""+medis_id+""
        }, function (data, status) {
			if(data==0){
				alert("Diagnosa Belum Diinputkan Mohon Inputkan Diagnosa");
			    window.location = "<?php  echo $url; ?>/media.php?module=pemeriksaan";
			}else{
	$('#static2').modal('show');	
			}
		});
}
function option(opsi) {
		var medis_id="<?php echo $_GET['medis_id']; ?>";		
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=opsi", {      
			medis_id : medis_id,
			opsi: opsi
        },
        function (data, status) {	
			window.location = "<?php  echo $url; ?>/media.php?module=pemeriksaan";
        });	
}


function GetMedisId(id,id_pasien,tanggal,rawat) {
	
		  var b = document.getElementById('selesai');
    var id=id;		
$('#medis_id').val(id);


	if(id !='' ){  // at-least one checkbox checked
				$("#modal-body8").html("<img src='assets/global/img/loading.gif' width='50px;'>");  	
			$.post("modul/pg_daftarrawatjalan/crud.php?op=cek", {
            id: id
        },function (data, status) {
			if(data==2){
				var benar=0;
				alert("Pasien Sudah Diperiksa, Anda Hanya Diizinkan Melihat Data Rekam Medis");
				$('#draggable').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/formperiksa.php?aksi="+benar+"&id="+id+"&pasien_id="+id_pasien+"&rawat="+rawat);				
				$('#selesai').hide();	
				
	            exit();
			}else if(data==0){
				var benar=1;
				 if(confirm ("Tandai Sebagai Pasien Yang Sedang Diperiksa Dokter ?")==true){
	        	$('#draggable').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/formperiksa.php?id="+id+"&pasien_id="+id_pasien+"&rawat="+rawat);
			    $("#resep").load("modul/pg_daftarrawatjalan/crud.php?op=resep&id="+id);	
				b.style.display = 'block';
			 }
			}else if(data==1 || data==3){
				var benar=0;
				$('#draggable').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/formperiksa.php?aksi="+benar+"&id="+id+"&pasien_id="+id_pasien+"&rawat="+rawat);
				$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa&id="+id);				
			}
           }
         );	
			}else {
				var answer = confirm("Maaf Cek Salah Satu");
			}
}
	function myTrim(x) {
    return x.replace(/^\s+/,'');
}

	function GetMedis(medis_id,rawat,tanggal){
		 var x = document.getElementById('input_pemeriksaan');
		 var y = document.getElementById('cetak_rm');
		$.post("modul/pg_daftarrawatjalan/crud.php?op=cek", {
            id: medis_id
        },function (data, status) {
			if(data==2){
				 x.style.visibility = 'hidden';
				  y.style.visibility = 'visible';
			}else{
				 x.style.visibility = 'visible';
				 y.style.visibility = 'hidden';
			}
		});
		 	
		
		  $("#medis_filter").val(medis_id);
		   $("#kategori").val(rawat);
		    $("#get_tanggal").html(tanggal);
			 $("#medis_id2").val(medis_id);		  
		$.post("modul/pg_daftarrawatjalan/crud.php?op=pemeriksaan", {medis_id: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#pemeriksaan").val(data);
			}
		});	
			$("#procedure").load( "modul/pg_daftarrawatjalan/crud.php?op=prosedure",{medis_id: ""+medis_id+""});  
	
				
	$("#tindakan,#diagnosa,#laboratorium,#pemeriksaan,#laboratorium").html("<img src='assets/global/img/loading.gif' width='30px;'>");  

		$("#tindakan").load("modul/pg_daftarrawatjalan/crud.php?op=tindakan&medis_id="+medis_id+"&rawat="+rawat);
$.post("modul/pg_daftarrawatjalan/crud.php?op=resep", {medis_id: ""+medis_id+"",rawat : "RJ"}, function(data, status){
			if(data, status) {
				var str= myTrim(""+data+"");
				$("#resep").val(str);
			}
		});			
		
		$("#diagnosa").load("modul/pg_daftarrawatjalan/crud.php?op=diagnosa",{
            medis_id: medis_id
        });	
			$("#pemeriksaan").load("modul/pg_daftarrawatjalan/view.php?op=pemeriksaan",{
            id: medis_id
        });	
		$("#radiologi").load("modul/pg_daftarrawatjalan/radiologi.php?op=view",{
            rawat: rawat,
			id:medis_id
        });	
		$("#laboratorium").load("modul/pg_daftarrawatjalan/crud.php?op=laboratorium&medis_id="+medis_id+"&rawat="+rawat);	
}

function salindiagnosa(med) {
	var medis_id=""+med+"";
	var medis=$("#medis_filter").val();
	var dokter_id=$("#dokter_id").val();
		
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=salin_diagnosa", {          
			medis_id : medis_id,
			medis_id2 : medis,
			dokter_id: dokter_id,
            pasien_id: $("#pasien_id").val()
        },
        function (data, status) {	
			alert("Data Diagnosa Berhasil Digunakan");
			exit();
        }  );
		
}
function salinresep(med) {
		var medis_id=""+med+"";
		var medis=$("#medis_filter").val();
	    var resep = $("#resep").val();
		var dokter_id=$("#dokter_id").val();
		var nama_poli=$("#nama_poli").val();
		var pasien_id=$("#pasien_id").val();
	if(resep==''){
	alert("Tidak Ada Data Resep");
	exit();
	}else{	
	$.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=salin_resep", {          
			medis_id : medis_id,
			medis_id2 : medis,
			dokter_id: dokter_id,
			poli:nama_poli,
			pasien_id:pasien_id,
			resep : resep
        },
        function (data, status) {	

				$('#draggable').modal('show');			
                $("#modal-body8").load( "modul/pg_daftarrawatjalan/formperiksa.php?id="+medis_id+"&rawat=RJ");		
        }  );
	
	}	
}
	</script>
<div class="page-content">
<div class="row" >
<div class="portlet box ">
<div class="portlet-body form">
<div class="form-body">
<div class="col-cm-12">
<div class="col-md-3">	
<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title portlet box blue">
							<div class="caption font-red-sunglo">
								<i class="fa fa-user font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">REKAM MEDIS PASIEN</span>
								<span class="caption-helper"></span>
							</div>							
						</div>
						<div class="portlet-body">
									<form class="form-horizontal" role="form">
											<div class="form-body" style="font-size:13px;font-weight:700px;">
										
												<div class="row">
													<div class="col-md-12">
													
														<div class="form-group">														
															
															<div class="col-md-9">
								<address>
								<strong><span style="color:#3c763d;"><?php echo $data['NAMA_PASIEN']."<br>". $data['NO_RM']; ?></span><br>
							</strong>
							</div></div>
								
														<div class="form-group">														
															<label class="control-label col-md-3">Tgl Lahir</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	<strong>: <?php echo tgl_indo($data['TGL_LAHIR2']); ?></strong>
																</p>
															</div>													
															</div>
															<div class="form-group">														
															<label class="control-label col-md-3">Umur</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	<strong>: <?php echo umur($data['TGL_LAHIR']); ?></strong>
																</p>
															</div>													
															</div>
															<div class="form-group">														
															<label class="control-label col-md-3">Asuransi</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	<strong>: <?php echo $data['ASURANSI']; ?></strong>
																</p>
															</div>													
															</div>
			 <div class="form-group">														
															<label class="control-label col-md-3">No. Asuransi</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	<strong>: <?php echo $data['ASURANSI_POLIS']; ?></strong>
																</p>
															</div>													
															</div>
															<div class="form-group">														
															<label class="control-label col-md-3">Alergi</label>
															<div class="col-md-9">
																<p class="form-control-static"> :
																<div class="btn-group" >
														<button class="btn red dropdown-toggle" type="button" data-toggle="dropdown" id="btn_alergi">
														<span id="alergi_data"><?php if ($data['ALERGI']==''){
															
																echo"Tambah Alergi";
															}else {
															echo $data['ALERGI']; 
														}
															?> </span><i class="fa fa-plus-circle"></i>
														</button>
														<div class="dropdown-menu dropdown-content input-large hold-on-click" role="menu" id="view_alergi">
															<form action="#">
																<div class="input-group">
																	<input type="text" class="form-control" id="input_alergi" placeholder="Alergi" value="<?php echo $data['ALERGI']; ?> ">
																	<span class="input-group-btn">
																	<button class="btn blue" type="button" id="simpan_alergi">Save</button>
																		<button class="btn red" type="button" id="close">Close</button>
																	</span>
																</div>
															</form>
														</div>
													</div>
																</p>
															</div>													
															</div>
															</div>
															</div>
															</div>
															</form>
							
										
							</address>
						
						</div>
						</div>
						<div  class="modal  fade draggable-modal" id="draggable" role="basic" tabindex="-1" >

								<div class="modal-dialog modal-dialog modal-full" style="margin: 0px auto;">
									<div class="modal-content " style="height:705px;">	
<div class="modal-header portlet box blue">
								<div class="portlet-title">
							<div class="caption" style="padding:3px 0 9px 0;">
								<i class="fa fa-gift"></i>Tambah Rekam Medis
							</div>
						
						</div>
										</div>
										<div id="modal-body8" class="modal-body portlet-body" style="height:500px" >												
												</div>											
												<input type="hidden" id="medis_id2">
													<input type="hidden" id="kategori" value="RJ">
													
																					</div>
												</div>
												</div>
					<div style="margin-bottom:5px;"></div>
					<div class="pane pane--table1">
  <div class="pane-hScroll5">
					<table style="width:100%;" class="tabel" >
					<thead>
				
					<tr style="font-weight:700;"><th style="width:90px;">TANGGAL</th><th style="width:50px;">RAWAT</th><th >POLI/DOKTER 
					<span  style="background:yellow;float:right;height:20px;">
											<input type="checkbox" id="cek_dokter" name="cek_dokter" onclick="cekdokter()">
											</span>
											<input type="hidden" id="id_pasien" name="id_dokter" value="<?php echo $data['PASIEN_ID']; ?>">
					<input type="hidden" id="id_dokter" name="id_dokter" value="<?php echo $data['DOKTER']; ?>">
				</th></tr>
					<?php
				
					$sql1="								
					SELECT A.MEDIS_ID AS TRXID,
					CONVERT(VARCHAR(11),A.DATETIME_MEDIS,121) AS DATETIME,
					'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$data[PASIEN_ID]' AND A.STATUS_BAYAR = 1 
Union 
SELECT B.OPNAME_ID AS TRXID, 
CONVERT(VARCHAR(11),B.DATETIME_IN,121) AS DATETIME,
 'RI' AS RAWAT, B.DPJP AS DR,C1.NAME AS NMDOKTER,D1.NAME AS TEMPAT 
From rs.RS_PASIEN_OPNAME AS B LEFT JOIN RS.RS_DOKTER AS C1 ON B.DPJP = C1.DR_ID LEFT JOIN RS.RS_KAMAR AS D1 ON B.KAMAR_ID = D1.KAMAR_ID 
Where B.PASIEN_ID = '$data[PASIEN_ID]' 
union 
SELECT A.MEDIS_ID AS TRXID, 
CONVERT(VARCHAR(11),A.DATETIME_MEDIS,121) AS DATETIME,
'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$data[PASIEN_ID]' AND A.STATUS_BAYAR = 0 AND A.STATUS_ANTRI <> 0  
Order By DATETIME Desc ";
$params1 = array();
$stmt1 = sqlsrv_query( $conn, $sql1 , $params1,$options);
if($benar==1){
$stmt = sqlsrv_query( $conn, $sql3 , $params);
	}
			?>
					</thead>
					</table>
						<div class="pane-vScroll2">
					<table id="table" style="width:100%;font-size:11px;" class="table table-striped table-hover" >
				
					<tbody id="dataperiksa">
					<?php
					$no=1;
					while($datas=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
						
						if($data['DOKTER']==$datas['DR']){
							$color="yellow";
						}else{
							$color="white";
						}
						if($datas['RAWAT']=='RI'){
							$color1="green";
						}else{
							$color1="white";
						}
						if($datas['TEMPAT']=='UGD'){
							$color2="red";
						}else{
							$color2="white";
						}
						
						if($no==1){
							$var1=$datas['TRXID'];
							$var2=$datas['RAWAT'];
							$var3=$datas['DATETIME'];
						}
	echo"<tr ><td style='background-color:$color1;WIDTH:90px;'>	
	<span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\",\"".$datas['RAWAT']."\",\"".tgl_indo($datas['DATETIME'])."\")' style='cursor:pointer;' >".tglku($datas['DATETIME'])."</td>
	<td style='background-color:$color2;width:50px;'>	<span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\",\"".$datas['RAWAT']."\",\"".tgl_indo($datas['DATETIME'])."\")' style='cursor:pointer;' >".$datas['RAWAT']."</span></td>
	<td style='background-color:$color;width:160px;'><span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\",\"".$datas['RAWAT']."\",\"".tgl_indo($datas['DATETIME'])."\")' style='cursor:pointer;' >".$datas['TEMPAT']."<br>".$datas['NMDOKTER']."
	</span></td></tr>";
	$no++;
}
			
echo'<tr><td colspan="3">
   <script>            
            function selectedRow(){                
                var index,
                    table = document.getElementById("table");            
                for(var i = 0; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         // remove the background from the previous selected row
                        if(typeof index !== "undefined"){
                           table.rows[index].classList.toggle("selected2");
                        }
                        console.log(typeof index);
                        // get the selected row index
                        index = this.rowIndex;
                        // add class selected to the row
                        this.classList.toggle("selected2");
                        console.log(typeof index);
                     };
                }
                
            }
            selectedRow();
        </script>
</td></tr>';
		
					?>
					<script type="text/javascript">
					$(document).ready(function() {
	
	              
					$("#medis_filter").val("<?php echo $var1; ?>");
					});
					</script>
					</tbody>
					</table>
					</div>
	</div>
	
	</div>
		
		
</div>

																<input type="hidden" id="dokter_id" value="<?php echo $data['DOKTER']; ?>">
																<input type="hidden" id="medis_filter" >
																	<div class="col-md-9"  >
																	
																	<div class="col-cm-12">
																	
								
				
	<div class="wrap"  style="height:535px;" >
	<div class="row">
																		<div class="col-md-4">
	<div class="portlet-body">
		<div class="scroller note note-success" style="height:300px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
							
								<h4 class="block"><strong>PEMERIKSAAN</strong></h4>
								<span id="pemeriksaan" >
								<?php
										$sql5="SELECT  * FROM RS_PERIKSA WHERE TRX_ID  = '".$var1."' ";
$stmt5 = sqlsrv_query( $conn, $sql5);
$data5=sqlsrv_fetch_array($stmt5,SQLSRV_FETCH_ASSOC);

 echo "-Subyektif    : ".$data5['SUBYEKTIF']."  <br>-Obyektif     : ".$data5['OBYEKTIF']." Obyektif <br>
 * Vital Signs :<br>
 <table style='font-size:11px;'>
<tr><td > TD  </td> <td>:  ".$data5['TENSI']." </td><td>mmHg</td><td > Nyeri </td> <td>:  ".$data5['NYERI']." </td><td> nyeri</td><td > S </td> <td>:  ".$data5['SUHU']." </td><td>&deg C</td></tr>
<tr><td > N </td> <td>:  ".$data5['NADI']." </td><td>x/menit</td><td > BB  </td> <td>:  ".$data5['BB']." </td><td>KG </td><td colspan='3'></td></tr>
<tr><td > RR </td> <td>:  ".$data5['RESP']." </td><td>x/menit</td><td >  TB  </td> <td>:  ".$data5['TB']." </td><td>CM </td><td colspan='3'></td></tr>

</table>  
 - Assesment :  ass <br>
 - Planing/Terapi :<br> ".nl2br($data5['PLANING']);
	
								?>
								</span>
							
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller note note-info" style="height:230px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
			
								<h4 class="block"><strong>TINDAKAN</strong></h4>
										<span id="tindakan" >
										<?php
			$rawat="RJ";				
	if($rawat=='RJ'){
		$tabel="RS_MEDIS_TINDAKAN";
		$idnya="MEDIS_ID";
	}else{
		$tabel="RS_OPNAME_TINDAKAN";
		$idnya="OPNAME_ID";
	}
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

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
CASE WHEN DR.NAME IS NOT NULL THEN DR.NAME ELSE PR.NAME END AS PETUGAS_NAME, P.NOTE, 
 CONVERT(VARCHAR(8),P.DATE_TIME,108) AS TIME_TINDAKAN,
 CONVERT(VARCHAR(11),P.DATE_TIME,106) AS DATE_TINDAKAN,
 P.DATE_TIME
FROM
$tabel as P	
LEFT JOIN RS_TINDAKAN Q ON P.TINDAKAN_ID = Q.TINDAKAN_ID 
LEFT JOIN RS_OPERASI R ON P.OPERASI_ID = R.OPERASI_ID 
LEFT JOIN RS_PERSALINAN S ON P.PERSALINAN_ID = S.PERSALINAN_ID
LEFT JOIN RS_DOKTER DR ON P.DR_ID=DR.DR_ID 
LEFT JOIN RS_PERAWAT PR ON P.PERAWAT_ID=PR.PERAWAT_ID 
WHERE P.$idnya='".$var1."'
ORDER BY P.DATE_TIME desc";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params,$options);
$count=sqlsrv_num_rows($stmt);
$no=1;
if($count > 0){
 echo"<ol style='padding-left:15px;'>";
  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data['TINDAKAN_NAME']."<br> Petugas:".$data['PETUGAS_NAME']."<br> Ket :$data[NOTE] <br> Waktu : $data[DATE_TINDAKAN]  $data[TIME_TINDAKAN]</li>";
    }
  echo"</ol>";
}else{
	echo"Tidak Ada Tindakan Untuk Pasien";
}			
										
										?>
										</span>
							</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="scroller note note-info" style="height:200px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
			
								<h4 class="block"><strong>DIAGNOSA (ICDX)</strong>
<button type="button" class="btn btn-circle btn-success"  style="float:right;font-weight:600;padding:1px 5px 1px 5px;font-size:11px;" onClick="salindiagnosa('<?php echo $_GET['medis_id']; ?>');">Gunakan Diagnosa</button>								</h4>
								
												<div id="diagnosa" >
												<?php
												
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql="SELECT
P.DIAGNOSA_ID,
P.DIAGNOSA,
P.SEQ_NO,
P.PENYAKIT_ID,
P.NOTE,
P.PS,
Q.NAME AS DR_NAME,
P.DT_DIAGNOSA,
CONVERT(VARCHAR(11),P.DT_DIAGNOSA,106) AS DATE_DIAG
FROM
	rs.RS_DIAGNOSA P
LEFT JOIN rs.RS_DOKTER Q ON P.DR_ID = Q.DR_ID
WHERE
	P.DIAGNOSA_ID = '".$var1."'
ORDER BY
	P.PS DESC ";
	echo"<ol style='padding-left:15px;'>";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params,	$options);

$no=1;
$jml=sqlsrv_num_rows($stmt);
if($jml>0){

 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "<li style='padding-left:0px;'>".$data['DIAGNOSA']."(".$data['PENYAKIT_ID'].")/".label_diagnosa($data['PS'])."</li> ";
	  $no++;
  }

  echo"</ol>";

}else{
	echo"Tidak ada diagnosa atau dokter tidak mengentry";
}
												?>
				
</div>	
							</div>
							<div class="scroller note note-danger" style="height:160px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
			
					
								<h4 class="block"><strong>PROCEDURE (ICD9CM)</strong>
								<a class="btn btn-circle btn-success"  style="float:right;font-weight:600;padding:1px 5px 1px 5px;font-size:11px;" onClick="salinprocedure();">Gunakan Procedure</a></h4>
								
								<span id="procedure">
								 <?PHP
								 $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

$sql="SELECT
NAMA
FROM
	RS_PROCEDURE_PASIEN

WHERE TRX_ID='".$var1."'";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params,$options);
$no=1;
$count=sqlsrv_num_rows($stmt);
if($count > 0 AND $var1!='' ){
	echo"<ol style='padding-left:15px;'>";
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data['NAMA']."</li>";
	  $no++;
  }
  echo"</ol>";
}else{
	echo "Tidak Ada Prosedur";
}
								 ?>
								</span>
							</div>
								<div class="scroller note note-success" style="height:170px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
			
					
								<h4 class="block"><strong>LABORATORIUM</strong></h4>
										<span id="laboratorium" >
										<?php
										
$rawat="RJ";

	if($rawat=="RJ"){
		$get="MEDIS_ID";
		$tabel="RS_MEDIS_DETAIL";
		
	}else{
		$get="OPNAME_ID";
		$tabel="RS_OPNAME_DETAIL";
	}

	 $sql="SELECT
	P.LAB_CODE,
	P.NAME,
	Q.NOTE,
	Q.SEQ_NO,
 CONVERT(VARCHAR(11),Q.MODIDATE,103) AS WAKTU,
	DR.NAME AS DOKTER_NAME,
	PR.NAME AS PERAWAT_NAME
FROM
	RS_LAB_ITEM P,
	$tabel Q
LEFT JOIN RS_DOKTER DR ON Q.DR_ID = DR.DR_ID
LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID = PR.PERAWAT_ID
WHERE
	P.LAB_CODE = Q.DETAIL_CODE
AND Q.$get = '".$var1."'
AND Q.DETAIL_TYPE = 1
ORDER BY
	Q.MODIDATE DESC";
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();

$stmt = sqlsrv_query($conn,$sql,$params,$options);

$count=sqlsrv_num_rows($stmt);
if($count > 0){
	echo"<ol style='padding-left:15px;'>";
	while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		echo "<li style='padding-bottom:5px;'>".$data['NAME']."(".$data['LAB_CODE'].")<br> Hasil: <br>".$data['NOTE']."<br> <br> Dokter :".$data['DOKTER_NAME']."<br> Laboran :".$data['PERAWAT_NAME']."<br> Waktu :".$data['WAKTU']."</li>";
		}
		echo "</ol>";
		}else {	
	echo"Tidak Ada pemeriksaan Laboratorium";
}
										
										?></span>
							
</div>
						</div>
						<div class="col-md-4">
						
					
								<h4 class="block"><strong>RESEP</strong>
								<a  class="btn btn-circle btn-success" style="float:right;font-weight:600;padding:1px 5px 1px 5px;font-size:11px;" onClick="salinresep('<?php echo $_GET['medis_id'];?>');">Gunakan Resep</a></h4>
										<div class="scroller note note-warning" style="height:290px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
			
									<textarea id="resep" rows="30" >
									<?php
									$rawat="RJ";
	if($rawat=="RJ"){
		$tabel="MEDIS_ID";
	}else{
		$tabel="OPNAME_ID";
	}
	 $sql = "SELECT resep FROM RS_ANTRI_RESEP WHERE resep_id = '".$var1."' ";
	 $sql2="SELECT    S.ITEM_NAME, R.JUMLAH, R.Note FROM    rs.RS_RESEP AS Q LEFT JOIN rs.RS_RESEP_DETAIL AS R ON Q.RESEP_ID = R.RESEP_ID LEFT JOIN rs.RS_MASTER_ITEM AS S ON R.ITEM_CODE = S.ITEM_CODE WHERE Q.$tabel ='".$var1."'";
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();
$stmt = sqlsrv_query($conn,$sql,$params);
$stmt2 = sqlsrv_query($conn,$sql2,$params,$options);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$count=sqlsrv_num_rows($stmt2);
if($data['resep']!='' AND $var1!='' ){
		echo trim($data['resep']);
}else {	
if($count>0 AND $var1!=''){	
		while($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
		echo "R/ ".$data2['ITEM_NAME'].",     Jumlah : ".$data2['JUMLAH']."\n                ".$data2['Note']." \n--------------------------------------------\n";
		}
}else{
	echo"Tidak Ada Resep";
}
}
									?>
									</textarea>
							</div>
							<div class="note note-info" style="height:185px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
			
					
													
								<h4 class="block"><strong>RADIOLOGI</strong></h4>
										<span id="radiologi" ></span>
							</div>
						</div>
						
						</div>
					
	</div>
	</div>
<div class="form-actions">
<?php

 echo "<button   id='input_pemeriksaan' class='btn blue' style='height:44px;'  onclick='GetMedisId(\"".$_GET['medis_id']."\",\"".$_GET['pasien_id']."\",\"".$tgl_sekarang2."\",\"RJ\")'  >
							<i class='fa fa-folder-open-o'></i> INPUT PEMERIKSAAN
							</button>";


?>
		<button   id='cetak_rm' class='btn blue' style='visibility:hidden;height:44px;'>
						<i class='fa fa-folder-open-o'></i> CETAK RM
		</button>
							<?php if($antrian==2 or $antrian==3){
								
									ECHO'<a   href="?module=pemeriksaan" class="btn btn-lg red" style="height:44px;padding-top:10px;">
							    <i class="fa fa-folder-open-o"></i> TUTUP
							</a>';
							}ELSE{
								?>
							<button   id="tutup" onclick="Tutup('<?php echo $_GET['medis_id'];?>')" class="btn btn-lg red" style="height:44px;">
							    <i class="fa fa-folder-open-o"></i> TUTUP
							</button>
							<?php
							}
							?>
							<div class="btn-set pull-right" >
							<span class="caption-subject font-blue-steel"> <h3 id="get_tanggal"></h3></span>
							</div>
										</div>
</div>
</div>


	
										</div>
										
										<div id="static2" class="bootbox modal fade in" data-backdrop="static"  aria-hidden="true" style="margin-top:90px;">

								<div class="modal-dialog" style="width:650px;">
									<div class="modal-content" style="height:150px;">
										<div class="modal-header" >
											<button type="button" class="close" onclick="Close(0)" aria-hidden="true"></button>
											<h4 class="modal-title"></h4>
										</div>
										<div class="modal-body">
										1. Tekan Yes Untuk Menandai Pasien Yang Sudah Di periksa. <br>
										2. Tekan No Untuk Menandai Pasien Yang Belum Selesai Diperiksa(Data Masih Bisa Diedit).<br>
										3. Tekan Cancel Untuk Tidak Jadi Keluar.
														<div class="modal-footer">
											<button type="button"   data-dismiss="modal" class="btn red" onclick="option(2)">Yes</button>
											<button type="button"  data-dismiss="modal" class="btn yellow" id="add_alergi" onclick="option(3)">No</button>
											<button type="button" data-dismiss="modal" class="btn green" id="add_alergi">Cancel</button>
										</div>	
													</div>
													</div>
													</div>
	</div>
										</div>
	</div>
	

	</div>
	</div>
 <?php
    break;  
}
?>
  <?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
include"../../inc/url.php";
session_start();
include"../../inc/fungsi_indotgl.php";
include"../../inc/fungsi_radiologi.php";
include"../../inc/fungsi_laboratorium.php";
	$id=$_GET['id'];
    $benar=$_GET['aksi'];
$sql="SELECT B. NAME AS DOKTER_NAME,
A.DR_ID AS DOKTER,A.STATUS_ANTRI,D.PASIEN_ID,C.NAME AS POLI,A.ANTRIAN,D.NAME AS NAMA_PASIEN,D.NO_RM,
D.ALERGI,
 CONVERT(VARCHAR(11),D.TGL_LAHIR,103) AS TGL_LAHIR,
  CONVERT(VARCHAR(11),D.TGL_LAHIR,120) AS TGL_LAHIR2,
  E.NAME AS ASURANSI,D.ASURANSI_POLIS
 FROM RS_PASIEN_MEDIS A JOIN RS_DOKTER B ON A.DR_ID=B.DR_ID JOIN RS_POLIKLINIK C ON A.POLI_ID=C.POLI_ID JOIN RS_PASIEN D ON A.PASIEN_ID=D.PASIEN_ID LEFT JOIN RS_ASURANSI E ON D.ASURANSI_ID=E.ASURANSI_ID WHERE A.MEDIS_ID='$id'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$dataku=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
	$sql3="update RS_PASIEN_MEDIS set STATUS_ANTRI='1' WHERE MEDIS_ID='$id' "; 
	 sqlsrv_query( $conn, $sql3);
	
	?>
	<script>
	$("#resep").load("modul/pg_daftarrawatjalan/crud.php?op=resep&id=<?php echo $id; ?>");	
	$("#radiologi").load("modul/pg_daftarrawatjalan/radiologi.php?op=view&id=<?php echo $id; ?>&rawat=RJ");	
	$("#pemeriksaan").load("modul/pg_daftarrawatjalan/view.php?op=pemeriksaan",{id:'<?php echo $id; ?>'});	
	$("#premiere").load("modul/pg_daftarrawatjalan/view.php?op=premiere&id=<?php echo $id; ?>");		
	
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
    $(document).on("click", "#suggestions2", function(){	 
     	$('#suggestions2').fadeOut();
    });
});
<?php

echo javascript('#cranium_mandibula');
echo javascript('#masthoid');
echo javascript('#tmjoint');
echo javascript('#zygomatict');
echo javascript('#cranium_lat');
echo javascript('#cranium_ap');
echo javascript('#sinus_paranasal');
echo javascript("#clavicula");	
echo javascript("#scapula");	
echo javascript("#scapula_ap");	
echo javascript("#shoulderjoint_ap");	
echo javascript("#shoulderjoint_apaxi");	
echo javascript("#humerusap");	
echo javascript("#arcticcubiti");	
echo javascript("#anterbachi");
echo javascript("#wristjoin");		
echo javascript("#manusap");
echo javascript("#jaritangan");	
echo javascript("#thorax_ap");	
echo javascript("#thorax_parulat");	
echo javascript("#thorax_parupalat");
echo javascript("#pelvis_ap");	
echo javascript("#collum_femur");	
echo javascript("#fermur_ap");	
echo javascript("#genu_pa");											
echo javascript("#cruris_ap");	
echo javascript("#ankle_ap");	
echo javascript("#pedis_ap");
echo javascript("#calcaneus");		
echo javascript("#arteriograf");	
?>
	 $("#text_ctscan_vertebrae").keyup(function(e){
		  $("#ctscan_vertebrae").attr("checked",true);
	 });
	  $("#text_phlebografi").keyup(function(e){
		  $("#phlebografi").attr("checked",true);
	 });
	 $("#text_ctscan_extremitas").keyup(function(e){
		  $("#ctscan_extremitas").attr("checked",true);
	 });
$("#text_print3d").keyup(function(e){
		  $("#print3d").attr("checked",true);
});

	function GetMedis(medis_id,rawat,tanggal){
		 var x = document.getElementById('simpan_resep');
		 x.style.display = 'block';
		  $("#medis_filter").val(medis_id);
		   $("#kategori").val(rawat);
		    $("#get_tanggal").html(tanggal);
			 $("#medis_id").val(medis_id);		  
		$.post("modul/pg_daftarrawatjalan/crud.php?op=pemeriksaan", {medis_id: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#pemeriksaan").val(data);
			}
		});	
			$("#procedure").load( "modul/pg_daftarrawatjalan/crud.php?op=prosedure",{medis_id: ""+medis_id+""});  
	
				
	$("#tindakan,#diagnosa,#laboratorium,#pemeriksaan,#laboratorium").html("<img src='assets/global/img/loading.gif' width='30px;'>");  
	$("#resep").html("Menunggu....");  
		$("#tindakan").load("modul/pg_daftarrawatjalan/crud.php?op=tindakan&medis_id="+medis_id+"&rawat="+rawat);	
			$("#resep").load("modul/pg_daftarrawatjalan/crud.php?op=resep&medis_id="+medis_id+"&rawat="+rawat);	
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
function GetPemeriksaan(id) {
    $("#id_pasien_alergi").val(id);
	    $.post("modul/pg_pasien/crud.php?op=detail_alergi", {
            id_pasien: id
        },
        function (data, status) {
		$("#ket_alergi").val(data);
	}
    );
    $("#entri_pemeriksaan").modal("show");
}
function Close(id) { 
    $("#entri_pemeriksaan").modal("hide");
}
function CetakSuratResume1(id,id_pasien,rawat) {
	 win=window.open('modul/pg_daftarrawatjalan/Resummedis.php?medis_id='+id+'&pasien_id='+id_pasien+'&rawat='+rawat,'win','width=900, height=600, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	 win.print();	
}function suggest(inputString){
	
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/procedure.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions').fadeIn();				
				
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			}
		});
	}
}
$("#closeaturan").bind("click", function(event) {
		$('#suggestions5').fadeOut();
});
$("#closetindakan").bind("click", function(event) {
		$('#suggestions1').fadeOut();
});
$("#closeprocedure").bind("click", function(event) {
		$('#suggestions').fadeOut();
});
$("#closediagnosa").bind("click", function(event) {
		$('#suggestions2').fadeOut();
});
$("#closeobat").bind("click", function(event) {
		$('#suggestions3').fadeOut();
});
// Tombol Selesai
$("#tutup_laboratorium").bind("click", function(event) {
		$('#static3').modal('hide');	
});

$("#selesai").bind("click", function(event) {
	var pasien_id=$("#pasien_id5").val();
	var medis_id=$("#medis_filter").val();
	var data_diagnosa=$("#diagnosa").html();
	var dokter_id=$("#dokter_id").val();
	var medis=$("#medis_id").val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=selesai",{ 
	 medis_id:$("#medis_id").val(),
bb:$("#edit_bb").val(),
tb:$("#edit_tb").val(),
nyeri:$("#edit_nyeri").val(),
nadi :$("#edit_nadi").val(),
resp:$("#edit_resp").val(),
suhu:$("#edit_suhu").val(),
tensi:$("#edit_tensi").val(),
subyektif:$("#edit_subyektif").val(),
obyektif:$("#obyektif").val(),
planning: $("#planning").val(),
dokter_id: dokter_id,
pasien_id: $("#pasien_id5").val(),
poli: $("#nama_poli").val(),
resep: $("#edit_resep").val()

	 } ,
        function (data, status) {	
		 window.location = "<?php  echo $url; ?>/media.php?module=pemeriksaan&act=rekammedis&medis_id="+medis+"&pasien_id="+pasien_id+"&rwt=RJ";
		
        }  );	
});


$("#input_lab").bind("click", function(event) {
	var nama=$("#nama_lab").val();
	var data_diagnosa=$("#diagnosa").html();
	var medis = $("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	var group = "";
			$.post("modul/pg_daftarrawatjalan/temp.php", 
			{
			 group: group,
			 nama: nama,
			 medis_id : medis
			 },
			function(data, status){
					$('#static3').modal('show');	
				$("#data_lab").html(data);
			});
			    <!-- $("#hasil_lab").load( "modul/pg_daftarrawatjalan/hasil_temp.php");
				-->
});

$("#input_rad").bind("click", function(event) {
	var nama=$("#nama_lab").val();
	var data_diagnosa=$("#diagnosa").html();
	var medis = $("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	var group = "";
			$.post("modul/pg_daftarrawatjalan/temp.php", 
			{
			 group: group,
			 nama: nama,
			 medis : medis
			 },
			function(data, status){
					$('#static4').modal('show');	
				$("#data_lab").html(data);
			});
			    <!-- $("#hasil_lab").load( "modul/pg_daftarrawatjalan/hasil_temp.php");
				-->
});

$("#tambahprocedure").bind("click", function(event) {
	var medis=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	var prosedur=$("#input_prosedur").val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpanpros",{ 
	 medis_id:$("#medis_id").val(),
     prosedur:$("#input_prosedur").val()
	 },function (data, status) {	
	 $('#suggestions').fadeOut();
	 $("#input_prosedur").val("");
       $("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis+"");
        }  );	
});
$("#tambahdiagnosa").bind("click", function(event){
	var medis=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
		var tipe  = $('input[name=tipe_diagnosa]:checked').val();
	if(medis==''){
		alert("Data Pasien Medis Tidak Ditemukan");
	}else{
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpandiagnosa",{ 
	        medis_id:$("#medis_id").val(),
            diagnosa:$("#input_diagnosa").val(),
	 	    dokter_id: dokter_id,
			tipe: tipe,
			bb:$("#edit_bb").val(),
            tb:$("#edit_tb").val(),
            nyeri:$("#edit_nyeri").val(),
            nadi :$("#edit_nadi").val(),
            resp:$("#edit_resp").val(),
            suhu:$("#edit_suhu").val(),
            tensi:$("#edit_tensi").val(),
            subyektif:$("#edit_subyektif").val(),
			obyektif:$("#obyektif").val(),
			planning: $("#planning").val(),
		     dokter : $("#dokter_id").val(),	 
	        pasien_id : $("#pasien_id").val()
	 },function (data, status) {	
	 $('#suggestions2').fadeOut();
	 $('#input_diagnosa').val("");
     $("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa",{id:""+medis+""});
        }  );	
	}
});

$("#btn_alergi").bind("click", function(event){
		  $('#view_alergi').show();
});
$("#close").bind("click", function(event){
		  $('#view_alergi').hide();
});
$("#simpan_alergi").bind("click", function(event){
	var alergi=$("#input_alergi").val();
	var  pasien_id = $("#id_pasien").val();
	if(alergi==''){
		alert("Data Alergi Masih Kosong");
	}else{
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpan_alergi",{ 
	 alergi: alergi,
   	 pasien_id : pasien_id
	 },function (data, status) {	
	 $('#alergi_data').html(alergi);
	 $('#view_alergi').hide();

     }  );	
	}
});
$("#simpan_radiologi").bind("click", function(event){
	   var checkbox_value = "";
	      var vertebrae = "";
		    var gigi1 = "";
			var gigi2 = "";
			var gigi3 = "";
			var gigi4 = "";
		  var extremitas_atas="";
		  var extremitas_bawah="";
		  var body="";
		  var ultrasonografi="";
		  var ct_scan="";
		  var pemeriksaan_canggih="";
		  var right1="";
		  var left1="";
		  var right2="";
		  var left2="";		
	      var gigi_peripical="";			  
    $("input[name*=cranium]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            checkbox_value += $(this).val() + "|";
        }
    });
	   $("input[name*=vertebrae]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            vertebrae += $(this).val() + "|";
        }
    });
	$("input[name*=extremitas_bawah]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            extremitas_bawah += $(this).val() + "|";
        }
    });
	  $("input[name*=extremitas_atas]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            extremitas_atas += $(this).val() + "|";
        }
    });
	$("input[name*=body]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            body += $(this).val() + "|";
        }
    });
	$("input[name*=ultrasonografi]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            ultrasonografi += $(this).val() + "|";
        }
    });
	$("input[name*=ct_scan]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            ct_scan += $(this).val() + "|";
        }
    });
	$("input[name*=pemeriksaan_canggih]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            pemeriksaan_canggih += $(this).val() + "|";
        }
    });
	 $("input[name=right1]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            right1 += $(this).val() + "|";
        }
    });
		 $("input[name=1]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            gigi1 += $(this).val() + "|";
        }
    });
		 $("input[name=2]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            gigi2 += $(this).val() + "|";
        }
    });
	 $("input[name=3]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            gigi3 += $(this).val() + "|";
        }
    });
	 $("input[name=4]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            gigi4 += $(this).val() + "|";
        }
    });
	 $("input[name*=gigi_peripical]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            gigi_peripical += $(this).val();
        }
    });
	 $.post("modul/pg_daftarrawatjalan/simpan_radiologi.php",{ 
   	 data : checkbox_value,
	 vertebrae : vertebrae,
	 extremitas_atas: extremitas_atas,
	 extremitas_bawah: extremitas_bawah,
	 body: body,
	 ultrasonografi:ultrasonografi,
	 ct_scan: ct_scan,
	 pemeriksaan_canggih : pemeriksaan_canggih,
     ket_cranium:  $("#ket_cranium").val(),
     ket_verterbrae: $("#ket_verterbrae").val(),
     ket_body: $("#ket_body").val(),
     ket_exatas: $("#ket_atas").val(),
     ket_ctscan :  $("#ket_ctscan").val(),
     ket_exbawah:   $("#ket_exbawah").val(),
     ket_lain_lain: $("#ket_lain_lain").val(), 	
     ket_miri: $("#ket_miri").val(), 
     ket_salurancerna : $("#ket_salurancerna").val(),
     ket_salurankencing:  $("#ket_salurankencing").val(),	 
	 ket_ultrasonografi:  $("#ket_salurankencing").val(),
	 text_ctscan_vertebrae: $("#text_ctscan_vertebrae").val(),
	 text_ctscan_extremitas: $("#text_ctscan_extremitas").val(),
	 text_print3d: $("#text_ctscan_extremitas").val(),
     text_phlebografi:  $("#text_phlebografi").val(),
     ket_lain_lain: $("#ket_lain_lain").val(),
     gigi1: gigi1,
     gigi2 : gigi2,
	 gigi3  : gigi3,
     gigi4 : gigi4,
     gigi_peripical : gigi_peripical,
     planning : $("#planning").val() 	 
	 },function (data, status){	
	    $("#static4").modal("hide");
		$('#planning').val(data);
     });
	
});
$("#text_aturan").bind("click", function(event){

	var inputString ="";
	
		$.post("modul/pg_daftarrawatjalan/aturan.php", {queryString:""+inputString+""}, function(data){
			
				$('#suggestions5').show();
				$('#suggestionsList5').html(data);
				
			
		});
	
});
$("#simpan_laboratorium").bind("click", function(event){
	    var jantung = "";
	 var paket = "";
	 var faal_hati = "";
	 var faal_ginjal = "";
	 var feses= "";
	 var elektrolit = "";
	 var imuno_serologi = "";
	 var mikrobiologi = "";
	 var penanda_tumor = "";
	 var hormon = "";
	 var lemak = "";
	 var urinalisa = "";
	 var hematologi ="";
	 var gula_darah ="";
	var  pasien_id = $("#id_pasien").val();	
	var  medis_id =  $("#medis_id").val();	
	
    var  pemeriksaan_lain = $("#pemeriksaan_lain").val();
	$("input[name*=HEMATOLOGI]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            hematologi += $(this).val() + "|";
        }
    });
	 $("input[name*=URINALISA]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            urinalisa += $(this).val() + "|";
        }
    });
	 $("input[name*=LEMAK]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            lemak += $(this).val() + "|";
        }
    });
	 $("input[name*=GULA_DARAH]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            gula_darah += $(this).val() + "|";
        }
    });
	 $("input[name*=HORMON]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            hormon += $(this).val() + "|";
        }
    });
	 $("input[name*=PENANDA_TUMOR]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            penanda_tumor += $(this).val() + "|";
        }
    });
	 $("input[name*=MIKROBIOLOGI]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           mikrobiologi += $(this).val() + "|";
        }
    });
		
	$("input[name*=IMUNO-SEROLOGI]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           imuno_serologi += $(this).val() + "|";
        }
    });

	$("input[name*=ELEKTROLIT]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           elektrolit += $(this).val() + "|";
        }
    });

	$("input[name*=FESES]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           feses += $(this).val() + "|";
        }
    });
	$("input[name*=FAAL_GINJAL]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           faal_ginjal += $(this).val() + "|";
        }
    });
	
	$("input[name*=FAAL_HATI]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           faal_hati += $(this).val() + "|";
        }
    });
	$("input[name*=PAKET]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           paket += $(this).val() + "|";
        }
    });
	$("input[name*=JANTUNG]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
           jantung += $(this).val() + "|";
        }
    });
		
 
	
$.post("modul/pg_daftarrawatjalan/simpan_lab.php",{ 
     hematologi: hematologi, 
	 urinalisa: urinalisa,
	 jantung : jantung,   	
	 paket: paket,
	 faal_hati: faal_hati,	  
	 faal_ginjal: faal_ginjal,
	 feses: feses,	
	 elektrolit: elektrolit,	 	 	
	 imuno_serologi: imuno_serologi,
	 mikrobiologi: mikrobiologi,
	 penanda_tumor: penanda_tumor,    
	 hormon: hormon,
	 gula_darah: gula_darah,

	 lemak: lemak,

	 medis_id: medis_id,
	 
	 pemeriksaan_lain: pemeriksaan_lain,
	    planning : $("#planning").val() 
	 },function (data, status) {	
	$("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis_id+"");
	 	$("#planning").val(data);
	$("#static3").modal("hide");
}  );	
	 
 /*$.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=selesai2",{ 
	 medis_id:$("#medis_id").val(),
bb:$("#edit_bb").val(),
tb:$("#edit_tb").val(),
nyeri:$("#edit_nyeri").val(),
nadi :$("#edit_nadi").val(),
resp:$("#edit_resp").val(),
suhu:$("#edit_suhu").val(),
tensi:$("#edit_tensi").val(),
subyektif:$("#edit_subyektif").val(),
obyektif:$("#obyektif").val(),
planning: $("#planning").val(),
dokter_id: $("#dokter_id").val(),
pasien_id: $("#pasien_id").val(),
poli: $("#nama_poli").val(),
resep: $("#edit_resep").val()
	 },function (data, status) {	

     });	
*/	 
});

function tindakan(inputString){
	
	var opsi  = $('input[name=optionsRadios]:checked').val();
	$('#suggestions').fadeOut();
	if(inputString.length == 0) {
		$('#suggestions1').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/tindakan.php", {queryString: ""+inputString+"",opsi:opsi}, function(data){
			if(data.length > 3) {
				$('#suggestions1').fadeIn();
				$('#suggestionsList1').html(data);
				
			}
		});
	}
}
function aturan1(){
	var inputString="";
	$('#suggestions5').fadeOut();
	if(inputString.length == 0) {
		$('#suggestions5').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/aturan.php", {queryString:""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions5').fadeIn();
				$('#suggestionsList5').html(data);
				
			}
		});
	}
}
function aturan(inputString){

	$('#suggestions5').fadeOut();
	if(inputString.length == 0) {
		$('#suggestions5').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/aturan.php", {queryString:""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions5').fadeIn();
				$('#suggestionsList5').html(data);
				
			}
		});
	}
}
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
	
function obat(inputString){
	if(inputString.length == 0) {
		$('#suggestions3').hide();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/obat.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions3').fadeIn();
				$('#suggestionsList3').html(data);
			}
		});
	}
	}

	
function fil(thisValue,nama) {
	
	var medis_id=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	var tipe  = $('input[name=tipe_diagnosa]:checked').val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpan_diagnosa", {          
			kode_diagnosa : ""+thisValue+"",
			medis_id : medis_id,
			dokter_id: dokter_id,
			tipe: tipe,
			bb:$("#edit_bb").val(),
            tb:$("#edit_tb").val(),
            nyeri:$("#edit_nyeri").val(),
            nadi :$("#edit_nadi").val(),
            resp:$("#edit_resp").val(),
            suhu:$("#edit_suhu").val(),
            tensi:$("#edit_tensi").val(),
            subyektif:$("#edit_subyektif").val(),
			obyektif:$("#obyektif").val(),
			planning: $("#planning").val(),
			pasien_id : $("#pasien_id").val()
        },
        function (data, status) {
if(data > 0){
	alert("Data Sudah Diinputkan");
	$('#suggestions2').fadeOut();
	exit();
}else{			
$("#input_diagnosa").val("");
		$('#suggestions2').fadeOut();
		$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa",{id:""+medis_id+""});
			$("#premiere").load("modul/pg_daftarrawatjalan/view.php?op=premiere&id="+medis_id);	
}
        }  );	
}



$("#input_group").change(function(){
	var group=$("#input_group").val();
	var nama=$("#nama_lab").val();
	$.post("modul/pg_daftarrawatjalan/temp.php", 
			{group: group,
			nama: nama,
			medis_id: $("#medis_id").val() },
			function(data, status){
				$("#data_lab").html(data);
			});
});
	function laboratorium(inputString){
       var group=$("#input_group").val();
		$.post("modul/pg_daftarrawatjalan/temp.php", {nama: inputString,
		group : group}, function(data){
			
			$('#data_lab').html(data);
			
		});
	}
function fill2(thisValue) {
	var medis_id=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpan_procedure", {          
			kode_diagnosa : ""+thisValue+"",
			medis_id : medis_id
        },
        function (data, status) {	
		if(data > 0){
	alert("Data Sudah Diinputkan");
}else{
		$('#input_prosedur').val("");
		$('#suggestions').fadeOut();
		$("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis_id+"");
}
        }  );
	
}function input_aturan(thisValue) {
	$('#text_aturan').val(thisValue);
	$('#suggestions5').fadeOut();
}
   $('#text_aturan').on("keydown",function(event){ 
   var aturan=$("#text_aturan").val();
           if(event.which==13){  
             if(aturan == '') {
				 alert("Mohon Isikan Aturan Pakai");
				 exit();
				  $('#text_aturan').focus();
			 }else{
				 $('#catatan').focus();
				 	$('#suggestions5').fadeOut();
			 }
                //Kode Lain Bisa di Dilanjut disini  
           }  
      });  

function input_tindakan(thisValue) {
	var medis_id=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	var mode  = $('input[name=optionsRadios]:checked').val();
	var kategori ="RJ";
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpan_tindakan", {          
			kode_diagnosa : ""+thisValue+"",
			medis_id : medis_id,
			dokter: dokter_id,
			kategori:kategori,
			mode: mode
        },
        function (data, status) {
		if(data > 0){
	alert("Data Sudah Diinputkan");
		$('#suggestions1').fadeOut();
		exit();
}else{		

$('#suggestions1').fadeOut();
$("#data_tindakan").load( "modul/pg_daftarrawatjalan/view.php?op=tindakan&id="+medis_id+"&rawat="+kategori);
}
        }  );
}
function filobat(thisValue) {
            $('#nama_obat').val(thisValue);
			$('#suggestions3').fadeOut();
			$('#jumlah_obat').focus();	
}
function hapus_diagnosa(thisValue,seq,tipe) {
	if(tipe==1){
		var label="Primary";
	}else{
		var label="";
	}
 if(confirm ("Anda Ingin Menghaous Data Diagnosa "+label+"?")==true){
	 $.post("modul/pg_daftarrawatjalan/view.php?op=hapusdiagnosa", {          
			kode_diagnosa : ""+thisValue+"",
			seq : seq,
			tipe: tipe
        },
        function (data, status) {	
		alert(tipe);
		$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa",{id:""+thisValue+""});
			$("#premiere").load("modul/pg_daftarrawatjalan/view.php?op=premiere&id="+thisValue);	
        }  );
 }else{
	exit(); 
 }
	
}
function ubah(thisValue,seq) {
 if(confirm ("Ubah Diagnosa Menjadi Prrimary ?")==true){
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=ubahdiagnosa", {          
			kode_diagnosa : ""+thisValue+"",
			seq : seq
        },
        function (data, status) {	
		$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa&id="+thisValue+"");
			$("#premiere").load("modul/pg_daftarrawatjalan/view.php?op=premiere&id="+thisValue);	
        }  );
 }else{
	exit();  
 }	
}
function hapus_tindakan(thisValue,seq,tipe) {
 if(confirm ("Hapus Data Tindakan ?")==true){
	 $.post("modul/pg_daftarrawatjalan/view.php?op=hapustindakan", {          
			kode_diagnosa : ""+thisValue+"",
			seq : seq
        },
        function (data, status) {		
		$("#data_tindakan").load( "modul/pg_daftarrawatjalan/view.php?op=tindakan&id="+thisValue+"&rawat="+tipe);
        }  );
 }	
}
function hapus_procedure(medis,thisValue) {
 if(confirm ("Hapus Data Prosedur ?")==true){
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=hapusprocedure", {          
			kode_diagnosa : ""+thisValue+""
        },
        function (data, status) {	
		$("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis+"");
        }  );
 }
	
}
$('#cek_dokter').click(function()
{
var pasien =$("#id_pasien").val();
var dokter =$("#id_dokter").val();
   if ($(this).is(':checked'))
    {
		var set=1;
          $.post("modul/pg_daftarrawatjalan/crud.php?op=datapemeriksaan", {
            set: set,
			pasien:pasien,
			dokter:dokter
        }, function (data, status) {
			$("#dataperiksa").html(data).show(); 
	     
        }  );
       
    }
    //If checkbox is unchecked then disable or enable input
    else
    {
     var set=0;
          $.post("modul/pg_daftarrawatjalan/crud.php?op=datapemeriksaan", {
            set: set,
			pasien:pasien,
		    dokter:dokter
        }, function (data, status) {
		$("#dataperiksa").html(data).show(); 
        }  ); 
    }
});
function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (10+o.scrollHeight)+"px";
}
function Ceklab(id,medis) {
	var id_lab=id;
	$.post("modul/pg_daftarrawatjalan/input_temp.php", {
            id_lab    : id_lab,
			medis_id  : medis
        }, function (data, status) {
			<!-- $("#hasil_lab").load( "modul/pg_daftarrawatjalan/hasil_temp.php"); -->
        }); 
}


/*
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
*/
	</script>
	<div class="row" >
	

																<input type="hidden" id="dokter_id" value="<?php echo $data['DOKTER']; ?>">
																
			
	<?php 
	$sql_status="select STATUS_ANTRI FROM  RS_PASIEN_MEDIS WHERE MEDIS_ID='$id'";	
							$stmt = sqlsrv_query( $conn, $sql_status ,array());
							$data_s=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

			$id=$_GET['id'];
			$sql5="SELECT  * FROM RS_PERIKSA WHERE TRX_ID  = '".$id."' ";
$stmt5 = sqlsrv_query( $conn, $sql5);
$data5=sqlsrv_fetch_array($stmt5,SQLSRV_FETCH_ASSOC);
	?>
		<div class="col-md-12"  >
		<script>
			$("#data_procedure").load("modul/pg_daftarrawatjalan/view.php?op=procedure&id=<?php echo $id; ?>");	
			$("#data_tindakan").load("modul/pg_daftarrawatjalan/view.php?op=tindakan&id=<?php echo $id; ?>&rawat=<?php echo $_GET['rawat']; ?>");	
$("#data_diagnosa").load("modul/pg_daftarrawatjalan/view.php?op=diagnosa",{id:"<?php echo $id; ?>"});	
			/* $("#data_lab").load("modul/pg_daftarrawatjalan/temp.php?group=semua");	*/
		</script>
																	
																	<div class="col-cm-12">


				
				<?php echo"
							<input type='hidden' value=".$data['POLI']." id='nama_poli'>";
							?>
						
						<div class="wrap" style="height:590px;">
						<div class="row">
						<div class="col-md-3">
						<div class="portlet portlet-sortable">
							<div class="scroller note note-info" style="height:80px;padding:7px 5px 5px 5px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
			
								<h5 class="block"><strong>KETERANGAN PASIEN</strong></H5>
				
<?php														
$sqlpasien="SELECT  NAME,NO_RM FROM RS_PASIEN WHERE PASIEN_ID  = '".$_GET['pasien_id']."'";
$querypasien = sqlsrv_query($conn, $sqlpasien);
$datapas=sqlsrv_fetch_array($querypasien,SQLSRV_FETCH_ASSOC);
?>
												
								<strong><span style="color:#3c763d;"><?php echo $datapas['NAME']."<br>". $datapas['NO_RM']; ?></span><br>
						
						
						</div>
						</div>
			
	<div class="panel panel-info">
	<input type="hidden" id="pasien_id5" value="<?php echo $_GET['pasien_id']; ?>"  >
	<input type="hidden" id="medis_id"  value="<?php echo $_GET['id']; ?>" >
	
									<div class="panel-heading">
										<h3 class="panel-title">SUBYEKTIF</h3><div id="ouput"></div>
									</div>
									<div class="panel-body">
									<textarea onkeyup="textAreaAdjust(this)" class="form-control" style="overflow:hidden;" placeholder="Input Subyektif" id="edit_subyektif"><?php echo $data5['SUBYEKTIF']; ?></textarea>
									</div>
								</div>
							
								<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">OBYEKTIF</h3>
									</div>
									
									<div class="panel-body">
<textarea class="form-control"  onkeyup="textAreaAdjust(this)" style="overflow:hidden;" placeholder="Input Obyektif" id="obyektif"><?php echo $data5['OBYEKTIF']; ?></textarea>
										</div>
										</div>
										<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">VITAL SIGN</h3>
									</div>
									
									<div class="panel-body">
									<table class="table font12 table-striped table-hover " style="font-size:12px;">
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
									<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">PLANNING/TERAPI</h3>
									</div>
									
									<div class="panel-body">
<textarea class="form-control" rows="8" placeholder="Input Planning/Terapi" id="planning">
<?php echo $data5['PLANING']; ?>
</textarea>
										</div>										
									</div>
										</div>
										<div class="col-md-5">
											<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">DIAGNOSA</h3>
									</div>
									
									<div class="panel-body" style="height:240px;">
									
										<div class="input-group ">
											 <input type="text" onKeyUp="diagnosa(this.value);" name="kode_rekening" id="input_diagnosa" class="form-control"  placeholder="Masukkan Data Diagnosa"   id="kode" size="10" autocomplete="off" /> 
				  	<span class="input-group-btn" >
											<button class="btn green" type="button" data-toggle="modal"  id="tambahdiagnosa">Tambah</button>
											</span>
										
				  </div>
				   <div class="suggestionsBox1" id="suggestions2" style="display: none;">
				   <div class="suggestionList" id="suggestionsList2"> &nbsp; </div>
				    <button id="closediagnosa" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
				   	<div class="radio-list" style="margin-left:20px;" id="premiere">
																					
										</div>
									<table class="table table-striped table-bordered table-advance table-hover" width="100%" style="font-size:12px;">
									<tr>
									<thead>
									<tr>
									<th>DIAGNOSA</th><th style="width:50px;">ICD X</th><th >Opsi</th>
									</tr>
									</thead>
									<tbody id="data_diagnosa">
									</tbody>
									</table>
									
									</div>
									</div>
																		<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">PROCEDURE</h3>
									</div>
								<div class="panel-body" style="height:120px;">
										<div class="input-group ">
											 <input type="text" onKeyUp="suggest(this.value);"  id="input_prosedur" class="form-control"  placeholder="Masukkan Data Prosedur"   id="kode" size="15" autocomplete="off" /> 
				  	<span class="input-group-btn">
											<button class="btn green" type="button" data-toggle="modal"  id="tambahprocedure">Tambah</button>
											</span>
			</div>
				  <div class="form-group">
				   <div class="suggestionsBox" id="suggestions" style="display: none;">
				   <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
				    <button id="closeprocedure" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>	
</div>				   
					<table class="table table-striped table-bordered table-advance table-hover font12" id="font12"	style="font-size:12px;">
									<tr>
									<thead>
									<tr>
									<th>PROSEDURE</th><th style="width:50px;">ICD 9</th>
									</tr>
									</thead>
									<tbody id="data_procedure">
								</tbody>
									</table>
									</div>
</div>		
							<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">TINDAKAN</h3>
									</div>
								<div class="panel-body" style="height:170px;">
											<div class="radio-list" style="margin-left:20px;">
											<label class="radio-inline">											
										<input type="radio" name="optionsRadios" id="optionsRadios4" value="dokter" checked>Dokter </label>
											<label class="radio-inline">
										<input type="radio" name="optionsRadios" id="optionsRadios5" value="perawat">Perawat</label>											
										</div>
									<div  style="width:100%;">
											 <input type="text" onKeyUp="tindakan(this.value);" name="kode_rekening" id="cari_tindakan" class="form-control" autocomplete="off" placeholder="Masukkan Tindakan Dokter/Perawat"  id="kode" size="15"/> 
				  	                   
				                        </div>
				   <div class="suggestionsBox" id="suggestions1" style="display: none;">
				   <div class="suggestionList" id="suggestionsList1"> &nbsp; </div>
				   <button id="closetindakan" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>									
										<table class="table table-striped table-bordered table-advance table-hover" style="width:100%;font-size:12px;">
									<tr>
									<thead>
									<tr>
									<th>TINDAKAN </th><th>ID</th>
									</tr>
									</thead>
									<tbody id="data_tindakan">
								</tbody>
									</table>
									</div>
									</div>
									
						

	
</div>
<div class="col-md-4">
<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">RESEP</h3>
									</div>
									
									<div class="panel-body">
								<table class="table" style="margin-bottom:2px;">							
							<tr>
							
								<td colspan="3">
								<input type="text" class="form-control" placeholder="Cari Nama Obat" id="nama_obat" onKeyUp="obat(this.value);" style="height:20px;">
							</td>	</tr>
				   	<tr>
				<td colspan="2">	  <div class="suggestionsBox3" id="suggestions3" style="display: none;">
				   <div class="suggestionList3" id="suggestionsList3"> &nbsp; </div>
				   <button id="closeobat" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div></td>
					</tr>
								<tr>
						
								<td><input type="text" id="jumlah_obat" placeholder="Jumlah" class="form-control" style="width:100px;height:20px;" onkeydown="if (event.keyCode == 13) document.getElementById('add').click()" ></td>
								<td>Aturan Pakai :</td><td>
									 <input type="text" onClick="aturan1();" onKeyUp="aturan(this.value);" name="kode_rekening" id="text_aturan" class="form-control" autocomplete="off" value="1X1" placeholder="Masukkan Tindakan Dokter/Perawat"  id="kode" size="15"/> 
						
								</td>
								</tr>
								<tr>
								<td>
								</td>
								<td></td>
								<td>									
					<div class="suggestionsBox5" id="suggestions5" style="display: none;">
				   <div class="suggestionList" id="suggestionsList5"> &nbsp; </div>
				   <button id="closeaturan" class="btn red remove"  type="button">Close</button>
				   </div>	
								</td>
								</tr>
								<tr>
							<td ><input type="text" id="catatan" placeholder="Catatan"  class="form-control" style="height:20px;"  onkeydown="if (event.keyCode == 13) document.getElementById('add').click()"></td><td >
									<button class="btn green" type="button" data-toggle="modal"  id="add">Tambah</button></td>
								</tr>
							</table>

<?php
	$sql6="SELECT  RESEP FROM RS_ANTRI_RESEP WHERE RESEP_ID  = '$id' ";
$stmt6 = sqlsrv_query( $conn, $sql6 , $params);
$data6=sqlsrv_fetch_array($stmt6,SQLSRV_FETCH_ASSOC);
?>
								

		
		</div>

	</div>
	<div class="panel panel-info">
	
<textarea class="AppendedContainer form-control"   cols="63" rows="22" style="font-size:11px;" id="edit_resep"><?php echo trim($data6['RESEP']); ?></textarea>
		<script>
	function myTrim(x) {
    return x.replace(/^\s+/,'');
}
$('#add').click(function() {
			var i = 1;
var inpt = $('#catatan').val();
var text = $('#jumlah_obat').val();
var resep = $('textarea#edit_resep').html();
var nama_obat = $('#nama_obat').val();
var aturan_pakai=  $('#text_aturan').val();
	if ( $('#nama_obat').val() == '' ){
		alert('Nama Obat Harus Diisi');
}else {
	  $.post("modul/pg_daftarrawatjalan/crud.php?op=reresep", {
            resep:  resep,
        	jumlah: text,
			catatan:inpt,
			nama_obat : nama_obat,
			aturan_pakai: aturan_pakai
        }, function (data, status) {
			$("#edit_resep").val(""); 
			$('#catatan').val('');
			$('#jumlah_obat').val('');
          
					var str= myTrim(""+data+"");
	$("#edit_resep").val(str);
		$('#suggestions3').fadeOut();
		$("#nama_obat").focus(); 
		  $('#nama_obat').val('');
			
	     
        }  );
	
		} 
	}
);

$(document).on('click', '#remove' , function() {
	$('.AppendedContent' ).remove();

	return false;
});

		</script>
	</div>
	<div class="col-md-8">
	<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">Penunjang Medis</h3>
									</div>
									<div class="panel-body">
									<div class="clearfix">
													<div class="btn-group btn-group-solid">
														<button type="button" class="btn blue" id="input_lab"><i class="fa  fa-medkit"></i><br>  Tulis <br> Permintaan <br>Laboratorium</button>
														<button type="button" class="btn green" id="input_rad" ><i class="fa fa-recycle"></i><br> Tulis <br> Permintaan<br> Radiologi</button>
															<button type="button" class="btn  red" onclick="CetakSuratResume1('<?php echo $id; ?>','061400005065','RJ')" ><i class="fa fa-plus-circle"></i><br> Cetak <br>Resume <br>Medis</button>
													</div>
												</div>
									</div>
	</div>
	</div>
	<div class="col-md-4">
		<div class="clearfix">
		<button type="button" class="btn btn-lg blue" id="selesai"><i class="fa  fa-medkit"></i><br> SIMPAN</button>
		<BR>
		<button class="btn btn-lg red"  id="tutup_pemeriksaan" style="width:98px;display:none;">
							<i class="fa fa-folder-open-o"></i><BR> TUTUP
							</button>
	
		</div>
	</div>
</div>

										</div>
										</div>
								
								
								
									<div class="row">
									<div class="col-md-6">

									</div>
	
<div class="row">
	<div class="col-md-6">
	
	</div>
	<div class="col-md-6">
	
	</div>
	</div>
								
		
	</div>
	
	</div>
		
	</div>
		<!--
	<div class="row">
<div class="col-md-9">
	<div class="portlet-body" style="padding-left:15px;">
												<button class="icon-btn" data-toggle="modal" onclick="GetPemeriksaan(2)">
												<i class="fa fa-group"></i>
												<div>
													Entry Pemeriksaan
												</div>
											
												</button>
												<a href="javascript:;" class="icon-btn">
												<i class="fa fa-barcode"></i>
												<div>
													Lihat File Scan
												</div>
												
												</a>
											</div>	
	</div>
	</div>	-->
	
	<div id="static4" class="bootbox modal fade in" data-backdrop="static"  aria-hidden="true" >
<input type="hidden" id="medis_id2" value="<?php echo $id; ?>">
								<div class="modal-dialog modal-full" style="margin:0px auto;" >
									<div class="modal-content" >
										
										<div class="modal-body" style="height:590px;overflow-y:scroll">
										<div class="row">
										<div class="col-md-3">
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">CRANIUM</h3>
									</div>
									<div class="panel-body">
								<ul class="feeds">												  
						<?php
						    echo radiologi ("Maxilla","no","maxilla","cranium");
						    echo radiologi ("Cranium AP/Lateral","no","cranium_lat","cranium");
							echo radiologi ("Cranium AP/Lat/Towne's","no","cranium_ap","cranium");
							echo radiologi ("Os Nasale","no","os_nasale","cranium");
							echo radiologi ("Zygomatic Arc","yes","zygomatict","cranium");
							echo radiologi ("Mandibula (EISPLER)","yes","cranium_mandibula","cranium");
							echo radiologi ("Masthoid (SHULLER)","yes","masthoid","cranium");
							echo radiologi ("T.M. Joint","yes","tmjoint","cranium");
							echo radiologi("Sinus Paranasal","no","sinus_paranasal","cranium");		
		                   						
						?>
						<li class=""> <?php echo lain("ket_cranium","Keterangan Lain Cranium");	?></li>
						     </ul>
							
									</div>
									</div>
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">VERTEBRAE</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">	
										<?php
						    echo radiologi ("Cervical AP/Lateral","no","cervicalaplat","vertebrae");
						    echo radiologi ("Cervical AP/Lat/Oblique","no","cervicalaplatobli","vertebrae");
							echo radiologi ("Thoracal AP/Lateral","no","thoracalaplat","vertebrae");
							echo radiologi ("Thoracal AP/Lat/Oblique","no","thoracalaplatobli","vertebrae");
							echo radiologi ("Thoracorumbal AP/Lateral","no","thoracorumbal","vertebrae");
							echo radiologi ("Lumbal AP/Lateral","no","lumbalaplat","vertebrae");
							echo radiologi ("Lumbal AP/Lat/Oblique","no","lumbalaplatobli","vertebrae");
							echo radiologi ("Lombosacral AP/Lateral","no","lombosacral","vertebrae");
							echo radiologi ("Sacrum out let/Lateral","no","sacrumout","vertebrae");	
                            echo radiologi ("Coccygis in let/Lateral","no","coccygis","vertebrae");		
                           						
						?>
						<li class=""><?php  echo lain("ket_verterbrae","Keterangan Lain Vertebrae");	?></li>
						</ul>
									</div>
									</div>
									
										</div>
										<div class="col-md-3">
										<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">EXTREMITAS ATAS</h3>
									</div>
									<div class="panel-body">
										<ul class="feeds">	
										       <?php 
echo radiologi("Clavicula","yes","clavicula","extremitas_atas");	
echo radiologi("Scapula AP","yes","scapula","extremitas_atas");	
echo radiologi("Scapula AP/Y View","yes","scapula_ap","extremitas_atas");	
echo radiologi("Shoulder Joint AP","yes","shoulderjoint_ap","extremitas_atas");	
echo radiologi("Shoulder Joint AP Axial/Axillar View","no","shoulderjoint_apaxi","extremitas_atas");	
echo radiologi("Humerus AP/Lateral","yes","humerusap","extremitas_atas");	
echo radiologi("Arctic Cubiti AP/Lateral","yes","arcticcubiti","extremitas_atas");	
echo radiologi("Anterbrachi AP/Lateral","yes","anterbachi","extremitas_atas");
echo radiologi("Wrist Join AP/Lateral","yes","wristjoin","extremitas_atas");		
echo radiologi("Manus AP/Oblique","yes","manusap","extremitas_atas");
echo radiologi("Jari tangan (Digiti)","yes","jaritangan","extremitas_atas");	

?>
<li class=""><?php echo lain("ket_exatas","Keterangan Lain Ektremitas Atas");	?></li>
										</ul>
									</div>
									</div>
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">EXTREMITAS BAWAH</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">	
										    <?php 
echo radiologi("Pelvis AP","no","pelvis_ap","extremitas_bawah");	
echo radiologi("Collum femur AP (HIP JOINT)","yes","collum_femur","extremitas_bawah");	
echo radiologi("Fermur AP/Lateral","yes","fermur_ap","extremitas_bawah");	
echo radiologi("Genu AP/L","yes","genu_pa","extremitas_bawah");	
echo radiologi("Patella Axial Skyline","no","patella_axial","extremitas_bawah");	
echo radiologi("Cruris AP/Lateral","yes","cruris_ap","extremitas_bawah");	
echo radiologi("Ankle AP/Lateral","yes","ankle_ap","extremitas_bawah");	
echo radiologi("Pedis AP/Oblique","yes","pedis_ap","extremitas_bawah");
echo radiologi("Calcaneus Axial/Lateral","yes","calcaneus","extremitas_bawah");	
											?>	
										<li class=""><?php echo lain("ket_exbawah","Keterangan Lain Extremitas Bawah");	?></li>		
									</ul>
									</div>
									</div>
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">GIGI PERIAPICAL</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">
									<table>
									<thead>
									<tr><th style="width:50%; text-align:center;" colspan="8">R</th><th style="text-align:center;" colspan="8">L</th></tr>
									</thead>
									<tbody>
									<tr>
									<td>8</td><td> 7</td><td> 6</td><td>5</td><td>4</td><td> 3</td><td> 2</td><td style="border-right:#000 solid 2px;"> 1</td>
									<td>1 </td><td>2</td><td> 3</td><td> 4</td> <td>5</td><td>6</td><td> 7</td><td> 8</td>
									</tr>
									<tr style="border-bottom:#000 solid 2px;">
									<?php
									for($i=8;$i>=1;$i--){
										if($i==1){
											$sty="style='border-right:#000 solid 2px;'";
										}else{
											$sty="";
										}
									echo"<td $sty><input type='checkbox' name='1' value=$i></td>";
									}
										for($i=1;$i<=8;$i++){
									echo"<td><input type='checkbox' name='2' value=$i></td>";
									}
									?>
									</tr>
									<tr>
									<td>8</td><td> 7</td><td> 6</td><td>5</td><td>4</td><td> 3</td><td> 2</td><td style="border-right:#000 solid 2px;"> 1</td>
									<td>1 </td><td>2</td><td> 3</td><td> 4</td> <td>5</td><td>6</td><td> 7</td><td> 8</td>
									</tr>
									<tr >
									<?php
									for($i=8;$i>=1;$i--){
										if($i==1){
											$sty="style='border-right:#000 solid 2px;'";
										}else{
											$sty="";
										}
									echo"<td $sty><input type='checkbox' name='4' value=$i></td>";
									}
										for($i=1;$i<=8;$i++){
									echo"<td><input type='checkbox' name='3' value=$i></td>";
									}
									?>
									</tr>
									</tbody>
									</table>
									<li></li>
									<li> <?php echo radiologi("OPG/Dental Panoramic","no","opg_Dental","gigi_peripical");	?>	</li>
									</ul>
									</div>
									</div>
										</div>
										<div class="col-md-3">
								
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">BODY</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">	
	<?php 
echo radiologi("Thorax AP/PA","no","thorax_ap","body");	
echo radiologi("Thorax Paru Lat","yes","thorax_parulat","body");	
echo radiologi("Thorax Paru PA/Lat","yes","thorax_parupalat","body");	
echo radiologi("Thorax Costae AP","no","thoraxcostae","body");	
echo radiologi("Thorax RLD","no","thorax_rld","body");	
echo radiologi("Thorax PA Analisa Jantung","no","thorax_pa","body");	
echo radiologi("Abdomen 3 Posisi","no","abdomen3_posisi","body");	
echo radiologi("Abdomen 2 Posisi","no","abdomen2_posisi","body");
echo radiologi("Abdomen Polos Ap Supine","no","abdomen_polos","body");	
echo radiologi("Abdomen Polos Ap Erect","no","abdomen_polosap","body");	
echo radiologi("Abdomen Polos Ap LLD","no","abdomen_poloslld","body");	
echo radiologi("BNO","no","bno","body");			
echo radiologi("BNO (Dengan Persiapan)","no","bno_persiapan","body");	
echo radiologi("Bone Survei","no","bone_survey","body");
    ?>	
<li class=""><?php echo lain("ket_body","Keterangan Lain Body");	?></li>				
										</ul>
									</div>
									</div>
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">ULTRASONOGRAFI</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">	
										    <?php 
echo radiologi("USG Uper Abdomen","no","usg_uperabdomen","ultrasonografi");	
echo radiologi("USG Lower Abdomen","no","usg_lowerabdomen","ultrasonografi");	
echo radiologi("USG Testis","no","usg_testis","ultrasonografi");	
echo radiologi("USG Axilla","no","usg_axilla","ultrasonografi");	
echo radiologi("USG Thyroid","no","usg_thyroid","ultrasonografi");	
echo radiologi("USG Mammae","no","usg_mammae","ultrasonografi");		
echo radiologi("USG Kepala Bayi","no","usg_kepalabayi","ultrasonografi");	
echo radiologi("USG Doppler","no","usg_doppler","ultrasonografi");
echo radiologi("USG Prostat","no","usg_prostat","ultrasonografi");	
echo radiologi("USG Transvaginal","no","usg_transvaginal","ultrasonografi");	
echo radiologi("USG Gynaecologies","no","usg_ gynaecologies","ultrasonografi");
echo radiologi("USG Paru","no","usg_paru","ultrasonografi");
echo radiologi("Echocardiografi","no","echocardiografi","ultrasonografi");
?>	
<li class=""><?php echo lain("ket_ultrasonografi","Keterangan Ultrasonografi");	?></li>		
										</ul>
									</div>
									</div>
										
										</div>
								<div class="col-md-3">
								
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">CT SCAN</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">
									   <?php 
echo radiologi("CT Scan Mandibula","no","ctscan_mandibula","ct_scan");	
echo radiologi("CT Scan Kepala","no","ctscan_kepala","ct_scan");	
echo radiologi("CT Scan Kepala Kontras","no","ctscan_kepalakontras","ct_scan");	
echo radiologi("CT Scan Orbita","no","ctscan_orbita","ct_scan");	
echo radiologi("CT Scan SPN (Situs Paranasal)","no","ctscan_spn","ct_scan");	
echo radiologi("CT Scan Nasopharink","no","ctscan_nasopharink","ct_scan");		
echo radiologi("CT Scan Thorax","no","ctcan Thorax","ct_scan");	
echo radiologi("CT Scan Thorax Kontras","no","ctscan_thoraxkontras","ct_scan");
echo radiologi("CT Scan Abdomen","no","ctscan_abdomen","ct_scan");	
echo radiologi("CT Scan Abdomen Kontras","no","ctscan_abdomenkontras","ct_scan");	
echo radiologi("CT Scan Pelvis","no","ctscan_pelvis","ct_scan");
echo radiologi("CT Scan Vertebrae","input","ctscan_vertebrae","ct_scan");
echo radiologi("CT Scan Extremitas","input","ctscan_extremitas","ct_scan");
echo radiologi("Print 3 D","input","print3d","ct_scan");
?>
  <li class=""><?php echo lain("ket_ctscan","Keterangan Lain CT Scan");	?></li>		
                                    </ul>	
                                    </div>
</div>
<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">MIRI</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">
									<li>
									<?php echo lain("ket_miri","Keterangan Miri");	?>
									</textarea>
									</li>
									</ul>
									</div>
									</div>
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">PEMERIKSAAN CANGGIH</h3>
									</div>
									<div class="panel-body">
									<ul class="feeds">
									<li>
									<strong>a). KONTRAS SALURAN CERNA</strong>
									 <?php 
									 echo radiologi("Oesophagus","no","oesophagus","pemeriksaan_canggih");
									 echo radiologi("O.M.D","no","omd","pemeriksaan_canggih");
									 echo radiologi("Appendicografi","no","appendicografi","pemeriksaan_canggih");
									 echo radiologi("Colon In Loop","no","coloninloop","pemeriksaan_canggih");
									 echo radiologi("Rectografi","no","rectografi","pemeriksaan_canggih");
									 
									 ?>
									<li class=""><?php echo lain("ket_salurancerna","Keterangan Kontras Saluran Cerna");	?></li>	
									<strong>b). KONTRAS SALURAN KENCING</strong>
									 <?php 
									 echo radiologi("BNO-IVP","no","bnoivp","pemeriksaan_canggih");
									 echo radiologi("Cystografi","no","cystografi","pemeriksaan_canggih");
									 echo radiologi("Urethografi","no","urethografi","pemeriksaan_canggih");
									 echo radiologi("Uretrocistografi","no","uretrocistografi","pemeriksaan_canggih");
									 echo radiologi("RPG","no","rpg","pemeriksaan_canggih");
									 echo radiologi("APG","no","apg","pemeriksaan_canggih");
									 ?>
									 <li class="">
							<?php echo lain("ket_salurankencing","Keterangan Lain Saluran Kencing");	?>
									 </li>	
									 <strong>c). KONTRAS LAIN-LAIN</strong>
									 <?php 
									 echo radiologi("H.S.G","no","hsg","pemeriksaan_canggih");
									 echo radiologi("Arteriografi Femoralis","yes","arteriograf","pemeriksaan_canggih");
									 echo radiologi("Fistulografi","no","fistulograf","pemeriksaan_canggih");
									 echo radiologi("Lopografi","no","lopografi","pemeriksaan_canggih");
									 echo radiologi("Phlebografi/Venografi","input","phlebografi","pemeriksaan_canggih");
									 echo radiologi("APG","no","apg","pemeriksaan_canggih");
									 ?>
									  <li class="">
									 	<?php echo lain("ket_lain_lain","Keterangan Lain Lain");	?>
										</li>	
									</li>
									</ul>
									</div>
									</div>
</div>									
								
										</div>
													</div>
														<div class="modal-footer">
									
											<button type="button" class="btn green" id="simpan_radiologi"><i class="fa fa-save"></i> Simpan</button>
												<button type="button" class="btn red"><i class="fa fa-times-circle"></i> Tutup</button>
										</div>	
												
													</div>
													</div>
													</div>
													<div id="static5" class="bootbox modal fade in" data-backdrop="static"  aria-hidden="true" >

								<div class="modal-dialog" style="width:690px;">
									<div class="modal-content" >
										<div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal" onclick="Close(0)" aria-hidden="true"></button>
											<h4 class="modal-title"></h4>
										</div>
										<div class="modal-body" style="height:510px;">
										<div id="data_body">
										</div>
										</div>
										</div>
	</div>
</div>

	<div id="static3" class="bootbox modal fade in" data-backdrop="static"  aria-hidden="true" >
<input type="hidden" id="medis_id2" value="<?php echo $id; ?>">
								<div class="modal-dialog modal-full" style="margin:0px auto;">
									<div class="modal-content" >
										<div class="modal-header" style="padding: 5px;" >
											<button type="button" class="close" onclick="Close(0)" aria-hidden="true"></button>
											<h4 class="modal-title">Form Permintaan Laboratorium</h4>
										</div>
										<div class="modal-body" style="height:auto;">
										<div class="row">
										
									
										<div class="col-md-2">
										
										<?php 
										echo laboratorium("HEMATOLOGI"); 
										echo laboratorium("URINALISA"); 
									
										?>
										<!-- Page1 -->
									</div>
									<div class="col-md-2">
										<?php 
										echo laboratorium("LEMAK"); 
										echo laboratorium("GULA DARAH"); 
										echo laboratorium("HORMON"); 
										echo laboratorium("PENANDA TUMOR"); 
										echo laboratorium("MIKROBIOLOGI"); 
										?>
									<!-- Page2 -->
									</div>
									<div class="col-md-2">
								<?PHP	
								echo laboratorium("IMUNO-SEROLOGI"); 
								echo laboratorium("ELEKTROLIT"); 
								?>
									<!-- Page3 -->
									</div>
										<div class="col-md-2">
										<?PHP	
								echo laboratorium("FESES"); 
								echo laboratorium("FAAL GINJAL"); 
								echo laboratorium("FAAL HATI"); 
								echo laboratorium("PAKET");
	echo laboratorium("JANTUNG"); 								
								?>
									<!-- Page3 -->
									</div>
										<div class="col-md-3">
									<div class="panel panel-info">
									<div class="panel-heading">
									<h3 class="panel-title">PEMERIKSAAN LAIN YANG DI KEHENDAKI</h3>
									</div>
									<div class="panel-body">
									<textarea class="form-control" id="pemeriksaan_lain" rows="8"></textarea>
									</div>
									</div>
										
										</div>
										<div class="col-md-1">
											<button type="button" class="btn red" id="tutup_laboratorium"><i class="fa fa-times-circle"></i><div> Tutup </div></button>
										<button type="button" class="btn blue" id="simpan_laboratorium"><i class="fa fa-save"></i> <div>Simpan</div></button>
										</div>
										</div>
													</div>
													
													</div>
													</div>
													</div>
	

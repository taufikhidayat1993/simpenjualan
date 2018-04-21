<script type="text/javascript" src="jquery.js"></script>

  <style>

.table-hover>tbody>tr:hover {background: #00aacc;color:#fff;}
.table>tbody>tr.selected  {background: #00aacc;color:#fff;}
.dataTables_filter,.dataTables_length,.dataTables_info,.dataTables_paginate paging_simple_numbers{
	display:none;
}
#sample_5_paginate{
	display:none;
}
.table>tbody>tr>td{
	padding:3px;
}
#sample_8 tr td{
	
	padding :1px;
	font-size:11px;

}
.datepicker{z-index:1151;}
.form-horizontal .radio-inline {
	padding-top:0px;
}
 </style>

	<script type="text/javascript">
function getFormattedDate(date) {
  var year = date.getFullYear();

  var month = (1 + date.getMonth()).toString();
  month = month.length > 1 ? month : '0' + month;

  var day = date.getDate().toString();
  day = day.length > 1 ? day : '0' + day;
  
  return month + '/' + day + '/' + year;
}
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
 $(document).on('change', '#uploadrujukan', function(){
	 var no_sep = $('#json_no_sep').val();
	 var name = $('#uploadrujukan')[0].files[0].name;   
	 
  var rm = nama_file.split("-");
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
   exit();
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("upload_fileBPJS").files[0]);
  var f = document.getElementById("upload_fileBPJS").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
   exit();
  }
  else
  {
   form_data.append("file", document.getElementById("upload_fileBPJS").files[0]);
   form_data.append('nama', $('#file_BPJS').val());
   $.ajax({
    url:"upload_file_bpjs.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#cek_bpjs').html("<label class='text-success'>Sedang Mengupload Gambar...</label>");
    },
    success:function(data)
    {
		$("#cek_bpjs").load("tampil_folder.php?cari=BPJS&rm="+rm[0]);						
    }
   });
  }
 });
 $(document).on('change', '#upload_fileBPJS', function(){
	 var nama_file = $('#file_BPJS').val();
	 var name = $('#upload_fileBPJS')[0].files[0].name;   
	 
  var rm = nama_file.split("-");
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
   exit();
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("upload_fileBPJS").files[0]);
  var f = document.getElementById("upload_fileBPJS").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
   exit();
  }
  else
  {
   form_data.append("file", document.getElementById("upload_fileBPJS").files[0]);
   form_data.append('nama', $('#file_BPJS').val());
   $.ajax({
    url:"upload_file_bpjs.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#cek_bpjs').html("<label class='text-success'>Sedang Mengupload Gambar...</label>");
    },
    success:function(data)
    {
		$("#cek_bpjs").load("tampil_folder.php?cari=BPJS&rm="+rm[0]);						
    }
   });
  }
 });
  $(document).on('change', '#upload_fileKTP', function(){
  var nama_file = $('#file_KTP').val();
  var name = $('#upload_fileKTP')[0].files[0].name;   	 
  var rm = nama_file.split("-");
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
   exit();
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("upload_fileKTP").files[0]);
  var f = document.getElementById("upload_fileKTP").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
   exit();
  }
  else
  {
   form_data.append("file", document.getElementById("upload_fileKTP").files[0]);
   form_data.append('nama', $('#file_KTP').val());
   $.ajax({
    url:"upload_file_bpjs.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#cek_ktp').html("<label class='text-success'>Sedang Mengupload Gambar...</label>");
    },
    success:function(data)
    {
		$("#cek_ktp").load("tampil_folder.php?cari=KTP&rm="+rm[0]);						
    }
   });
  }
 });
  $(document).on('change', '#upload_fileKK', function(){
  var nama_file = $('#file_KK').val();
  var name = $('#upload_fileKK')[0].files[0].name;   	 
  var rm = nama_file.split("-");
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
   exit();
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("upload_fileKK").files[0]);
  var f = document.getElementById("upload_fileKK").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
   exit();
  }
  else
  {
   form_data.append("file", document.getElementById("upload_fileKK").files[0]);
   form_data.append('nama', $('#file_KK').val());
   $.ajax({
    url:"upload_file_bpjs.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#cek_kk').html("<label class='text-success'>Sedang Mengupload Gambar...</label>");
    },
    success:function(data)
    {
		$("#cek_kk").load("tampil_folder.php?cari=KK&rm="+rm[0]);						
    }
   });
  }
 });
$(document).on('change', '#upload_rujukan', function(){
  var no_sep =  $('#json_no_sep').val();
  var name   = $('#upload_rujukan')[0].files[0].name;   	
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(no_sep ==''){	  
	  alert("No SEP Masih Kosong");
	  exit();
  }else if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
   exit();
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("upload_rujukan").files[0]);
  var f = document.getElementById("upload_rujukan").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
   exit();
  }
  else
  {
   form_data.append("file", document.getElementById("upload_rujukan").files[0]);
   form_data.append('no_sep', $('#json_no_sep').val());
   form_data.append('surat',"Surat_Rujukan");
   $.ajax({
    url:"upload_file_pendukung.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#label_rujuk').html("Menunggu...");
    },
    success:function(data)
    {
	     $('#label_rujuk').html("Surat Rujukan");					
    }
   });
  }
 });
   $(document).on('change', '#upload_skdp', function(){
  var no_sep =  $('#json_no_sep').val();
  var name   = $('#upload_skdp')[0].files[0].name;   	
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(no_sep ==''){	  
	  alert("No SEP Masih Kosong");
	  exit();
  }else if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
   exit();
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("upload_skdp").files[0]);
  var f = document.getElementById("upload_skdp").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
   exit();
  }
  else
  {
   form_data.append("file", document.getElementById("upload_skdp").files[0]);
   form_data.append('no_sep', $('#json_no_sep').val());
   form_data.append('surat',"Surat_Kontrol_SKDP");
   $.ajax({
    url:"upload_file_pendukung.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#label_skdp').html("Menunggu...");
    },
    success:function(data)
    {
	     $('#label_skdp').html("Surat Kontrol/SKDP");					
    }
   });
  }
 });
    $(document).on('change', '#upload_hd', function(){
  var no_sep =  $('#json_no_sep').val();
  var name   = $('#upload_hd')[0].files[0].name;   	
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(no_sep ==''){	  
	  alert("No SEP Masih Kosong");
	  exit();
  }else if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
   exit();
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("upload_hd").files[0]);
  var f = document.getElementById("upload_hd").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Ukuran File Gambar Terlalu Besar Maksimal 2MB");
   exit();
  }
  else
  {
   form_data.append("file", document.getElementById("upload_hd").files[0]);
   form_data.append('no_sep', $('#json_no_sep').val());
   form_data.append('surat',"Surat_Perintah_HD");
   $.ajax({
    url:"upload_file_pendukung.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#label_hd').html("Menunggu...");
    },
    success:function(data)
    {
	     $('#label_hd').html("Surat Perintah HD");					
    }
   });
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
$("#resume").bind("click", function(event) {
			$('#form_resume').modal('show');
            	var tanggal=$("#form_tanggal").val();	
			$("#cari_tanggal").val(tanggal);
			$("#data_resume").load("modul/pg_daftarrawatjalan/crud.php?op=resume",{tanggal:""+tanggal+""});	
});
$("#caripoli").bind("click", function(event) {
		var tanggal=$("#cari_tanggal").val();	
	$("#data_resume").load("modul/pg_daftarrawatjalan/crud.php?op=resume",{tanggal:""+tanggal+""});	
});
$("#cetak_pasien").bind("click", function(event) {
		var poliklinik = $("#poliklinik").val();
		var dokter  = $("#id_dokter1").val();
		var tanggal =$("#form_tanggal").val();
		if(poliklinik=='' || dokter =='') {
			alert("Pilih Poliklinik Dan Dokter");
		}else {
			win=window.open('modul/pg_daftarrawatjalan/cetak_rajal.php?poliklinik='+poliklinik+'&dokter='+dokter+'&tanggal='+tanggal,'win','width=900, height=600, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	        win.print();
		}
});
$("#cetak_hasilsep").bind("click", function(event) {
		var no_sep = $("#json_no_sep").val();
		//var no_sep="0179R00802180003852";
		if(no_sep=='') {
			alert("No SEP Tidak Ada");
		}else {
			win=window.open('modul/pg_daftarrawatjalan/cetak_sep.php?no_sep='+no_sep,'win','width=900, height=600, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	        win.print();
		}
});
$("#cetak_label").bind("click", function(event) {
	    var pasien_id  = $("#get_pasien").val();
		var medis_id = $("#get_medis").val();
		if(pasien_id =='' ){
			alert("Pilih Salah Satu Pasien");
		}else{
			win=window.open('modul/pg_daftarrawatjalan/cetak_label.php?pasien_id='+pasien_id,'win','width=900, height=600, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	        win.print();
		}
	
});
$("#editrajal").bind("click", function(event) {
	 var dokter = $("#id_dokter").val();
	 var tanggal  = $('#tgl_periksa').val();
	  var tgl_lama  = $('#tgl_lama').val();
	 var poli = $('#id_poli').val();
	 var tgl_rujuk= $("#tgl_rujuk").val();
	 var no_rujukan= $("#no_rujukan").val();
	 var catatan = $("#catatan").val();
	 var assesment = $("#assesment").val();
	 var id=  $("#get_medis").val();	
	 var jam= $("#jam").val(user.jam);
	 var dokter_lama= $("#dokter_lama").val();
	 var poli_lama= $("#poli_lama").val();	 
	 var no_asuransi   = $("#no_asuransi").val();
	 var asuransi_lama = $("#asuransi_lama").val();
	 var no_ktp        = $("#no_ktp").val();
	 var ktp_lama      = $("#ktp_lama").val();
	 var pasien_id     = $("#pasien_id5").val();		
    $.post("modul/pg_daftarrawatjalan/crud.php?op=editrajal", {
			poli : poli,
			dokter : dokter,
			tgl_rujuk: tgl_rujuk,
			catatan:catatan,
			assesment : assesment,
			id: id,
			jam: jam,
			no_rujukan : no_rujukan,
			tanggal : tanggal,
			dokter_lama : dokter_lama,
			poli_lama : poli_lama,
			tgl_lama: tgl_lama,
			no_asuransi : no_asuransi,
			asuransi_lama : asuransi_lama,
			no_ktp: no_ktp,
			ktp_lama: ktp_lama,
			pasien_id: pasien_id
	}, function (data, status) {	
	if (dokter_lama != dokter || poli_lama != poli || tgl_lama != tanggal ){
	alert(data);
	}
	$("#data").load("modul/pg_daftarrawatjalan/crud.php?op=tampilpasien",{form_tanggal:"<?php echo $tgl_sekarang2;?>",tanggal:1});		
       $("#responsive").modal("hide");
        }  );
});
$("#caridata").bind("click", function(event) {
	 var cari = $("#cari").val();
	 var tanggal  = $('input[name=tanggal]:checked').val();
	 var input_cari = $('#form_cari').val();
	 var id_poli= $("#poliklinik").val();
	 var dokter = $("#id_dokter1").val();
	 var fromDate = new Date($("#form_tanggal").val());
     var form_tanggal = $("#form_tanggal").val();
	
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
$("#ubah_alergi").bind("click", function(event) {
	    $("#form_resume").modal("show");
});
$("#edit_pasien").bind("click", function(event) {
	$("#add_tgl_lahir").datepicker({
format:"yyyy/dd/mm"
});
	  var id= $("#get_pasien").val();
	  var rm= $("#get_rm").val();
	  var bpjs="BPJS";
	  var ktp="KTP";
	  var kk="KK";
    $.post("modul/pg_daftarrawatjalan/ubah_pasien.php", {
            id: id
        },
        function (data, status) {

			$("#ubahpasien").html(data).show();  
		
						$("#cek_bpjs").load("tampil_folder.php?cari="+bpjs+"&rm="+rm);	
						$("#cek_ktp").load("tampil_folder.php?cari="+ktp+"&rm="+rm);	
						$("#cek_kk").load("tampil_folder.php?cari="+kk+"&rm="+rm);	
					
			return false;
        }
    );
    $("#responsive2").modal("show");
});

$("#simpan_sep").bind("click", function(event) {
	var tgl_sep= moment(""+$("#tanggal_sep").val()+"").format('YYYY-DD-MM');
	 $("input[name*=peserta_cob]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            peserta_cob = 1;
        }else{
			  peserta_cob = 0;
		}
    });
		 $("input[name*=lakalantas]").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            lakalantas = 0;
        }else{
			 lakalantas = 1;
		}
    });
	var lokasilaka = $("#lokasilaka").val();
	var no_sep = $("#json_no_sep").val();
	if(no_sep ==''){
	 $.post("modul/pg_daftarrawatjalan/insert_sep.php", {
            no_rujukan: $("#json_no_rujukan").val(),
	        diag_awal: $("#json_kode_diagnosa").val(),
			no_kartu:  $("#json_bpjs").val(),
			jenis_pelayanan:1,
            tgl_rujukan : tgl_sep,
			no_rm: $("#json_rm").val(),
			kelas_rawat: $('input[name=kel_perawatan]:checked').val(),
			jenis_perawatan: $('input[name=jenis_perawatan]:checked').val(),
			faskes: $("#faskes").val(),
			asal_rujukan: $("#json_kode_asal_rujuk").val(),
			poli: $("#json_kode_poli_tujuan_rujukan").val(),
			kode_faskes: $("#kode_faskes").val(),
			tgl_sep: tgl_sep ,
            catatan : $("#json_catatan").val(),
			nama_diagnosa : $("#json_diagnosa_awal").val(),
			nama_asalrujuk : $("#json_asal_rujuk").val(),
			nama_pasien : $("#json_nama").val(),
			tgl_lahir : moment(""+$("#json_tgl_lahir").val()+"").format('YYYY-DD-MM'),
			kelamin : $('input[name=jenkel]:checked').val(),
			poli_rs:  $("#json_poli_tujuan_rs").val(),
            peserta : $("#json_peserta").val(),
            medis_id : 	$("#get_medis").val(),
            peserta_cob: peserta_cob,
            lokasilaka: lokasilaka,
            lakalantas:lakalantas		
        },
        function (data, status) {
	
			   var json = JSON.parse(data);
			   if(json.kode_pesan==201){
			alert(json.pesan);
			 $("#json_no_sep").val(json.pesan_sep);
			   }else{
			      $("#label_simpan").html("UPDATE SEP");
				 $("#json_no_sep").val(json.no_sep)
					
			   }
			  
		});
		
	}else{
		 $.post("modul/pg_daftarrawatjalan/update_sep.php", {
		    no_sep : $("#json_no_sep").val(),
            no_rujukan: $("#json_no_rujukan").val(),
	        diag_awal: $("#json_kode_diagnosa").val(),
			no_kartu:  $("#json_bpjs").val(),
			jenis_pelayanan:1,
             tgl_rujukan : moment(""+$("#tgl_rujukan").val()+"").format('YYYY-MM-DD'),
			no_rm: $("#json_rm").val(),
			kelas_rawat: $('input[name=kel_perawatan]:checked').val(),
			jenis_perawatan: $('input[name=jenis_perawatan]:checked').val(),
			faskes: $("#faskes").val(),
			asal_rujukan: $("#json_kode_asal_rujuk").val(),
			poli: $("#json_kode_poli_tujuan_rujukan").val(),
			kode_faskes: $("#kode_faskes").val(),
				tgl_sep: moment(""+$("#tanggal_sep").val()+"").format('YYYY-MM-DD'),
            catatan : $("#json_catatan").val(),
			nama_diagnosa : $("#json_diagnosa_awal").val(),
			nama_asalrujuk : $("#json_asal_rujuk").val(),
			nama_pasien : $("#json_nama").val(),
            tgl_lahir : moment(""+$("#json_tgl_lahir").val()+"").format('YYYY-MM-DD'),
			kelamin : $('input[name=jenkel]:checked').val(),
			poli_rs:  $("#json_poli_tujuan_rs").val(),
            peserta : $("#json_peserta").val(),
            medis_id : 	$("#get_medis").val(),
            peserta_cob: peserta_cob			
        },
        function (data, status) {
			   var json = JSON.parse(data);
			   if(json.kode_pesan==201){
			alert(json.pesan);
			   }else{
				
			      $("#label_simpan").html("UPDATE SEP");
				 $("#json_no_sep").val(json.no_sep)
					
			   }
		
		});
	}
});
$("#update_tanggal").bind("click", function(event) {
	
	var json_sep=$("#json_no_sep").val();
	$("#update_form_sep").modal("show");	
	$("#json_update_nosep").val(json_sep);
	$("#json_tgl_pulang").val(new Date().toISOString().substring(0, 10));	
});

$("#simpan_updatesep").bind("click", function(event) {
	
	var no_sep =$("#json_no_sep").val();
	var tgl_pulang = $("#json_tgl_pulang").val();
	$.post("modul/pg_daftarrawatjalan/update_tgl_sep.php", {		
		no_sep : no_sep,
		tgl_pulang : tgl_pulang		
	},function (data, status) {
				   var json = JSON.parse(data);
				   if(json.kode_pesan != 200){
					   alert(""+json.kode_pesan+" "+json.pesan+"");
					    $("#json_no_sep").val(json.no_sep);
					     exit();
				   }else{
					   $("#update_form_sep").modal("hide");	
				   $("#json_no_sep").val(json.no_sep);
				   }
		});
	
});
$('#lakalantas').click(function()
{
		 var x = document.getElementById('lokasilaka');

   if ($(this).is(':checked'))
    {
		 x.style.display = 'block';
       
    }
    //If checkbox is unchecked then disable or enable input
    else
    {

  	 x.style.display = 'none';
    }
});
$("#buat_sep").bind("click", function(event) {
	 $("#json_tgl_lahir").removeClass("datepicker").datepicker();
	var bpjs = $("#get_bpjs").val();
	var ktp = $("#get_ktp").val();
    var tanggal = $("#get_tanggal").val();
	var pasien_id = $("#get_pasien").val();
	var no_rm = $("#get_rm").val();
	if(ktp ==""){
		alert("Data Pasien Belum Lengkap");
		exit();
	}else{
      $.post("modul/pg_daftarrawatjalan/kirim_data.php", {
            bpjs: bpjs,
			ktp : ktp,
			tanggal : tanggal,
			pasien_id : pasien_id
        },
        function (data, status) {

   var json = JSON.parse(data);
   
     if(json.kode_pesan != 200){
		 alert(json.pesan);
		 exit();
	 }else{
		    $("#json_tmt").val(moment(""+json.TMT+"").format('DD/MM/YYYY'));	
		   $("#form_sep").modal("show");	
		       $("#json_no_sep").val("");
     $("#json_rm").val(""+no_rm+"");
   $("#kode_faskes").val(json.kode_ppk);
   $("#json_nik").val(json.nik);
   $("#json_bpjs").val(json.bpjs);
   $("#json_nama").val(json.nama);
   $("#json_peserta").val(json.jnpeserta);

   $("#json_kelas").val(json.hak_kelas);   
   $("#json_pisat").val(json.jnpeserta);   
   $("#json_ppk").val(json.ppk);   
   $("#json_tgl_lahir").val(moment(""+json.tgl_lahir+"").format('DD/MM/YYYY'));   
   $("#json_tgl_cetak_kartu").val(moment(""+json.tgl_cetak_kartu+"").format('DD/MM/YYYY'));   
	 $("#json_tat").val(moment(""+json.tat+"").format('DD/MM/YYYY'));   
   
   if(json.jk == 'L' || json.jk ==''){
	     $("#jenikel").html("<label class='radio-inline'><input type='radio' name='jenkel' id='optionsRadios4' value='L' checked> Laki-laki</label><label class='radio-inline'><input type='radio' name='jenkel' id='optionsRadios5' value='P'> Perempuan </label>");  

   }else{
	 $("#jenikel").html("<label class='radio-inline'><input type='radio' name='jenkel' id='optionsRadios4' value='L' > Laki-laki</label><label class='radio-inline'><input type='radio' name='jenkel' id='optionsRadios5' value='P' checked> Perempuan </label>");  
   }
	 }
	 
	    $.post("modul/pg_daftarrawatjalan/kirim_datarujukan.php", {
            no_kartu : $("#json_bpjs").val(),
			ktp : ktp,
			tanggal : tanggal
        },
        function (data, status) {
    $("#form_sep").modal("show");	
   var json1 = JSON.parse(data);
    if(json1.kode_pesan != 200){
	   alert(json1.pesan);
	    $("#json_no_sep").val("");
   $("#json_diagnosa_awal").val(json1.diagnosa);
   $("#json_kode_diagnosa").val(json1.kode_diag);    
   $("#json_poli_tujuan_rujukan").val(json1.nama_poli);     
   $("#json_kode_poli_tujuan_rujukan").val(json1.kode_poli);   
    $("#json_no_rujukan").val(json1.no_rujukan);    
   $("#tgl_rujukan").val(moment(""+json1.tgl_kunjungan+"").format('DD/MM/YYYY'));   
      $("#json_asal_rujuk").val(json1.asal_rujuk);   
   $("#json_kode_asal_rujuk").val(json1.kode_asal); 

   $("option:selected",$("#json_poli_tujuan_rs").val(json1.kode_poli)).text();
  
   $("option:selected",$("#faskes").val(json1.faskes)).text();
   }else
   {
   $("#json_diagnosa_awal").val(json1.diagnosa);
   $("#json_kode_diagnosa").val(json1.kode_diag);    
   $("#json_poli_tujuan_rujukan").val(json1.nama_poli);     
   $("#json_kode_poli_tujuan_rujukan").val(json1.kode_poli);   
    $("#json_no_rujukan").val(json1.no_rujukan);    
   $("#tgl_rujukan").val(moment(""+json1.tgl_kunjungan+"").format('DD/MM/YYYY'));   
      $("#json_asal_rujuk").val(json1.asal_rujuk);   
   $("#json_kode_asal_rujuk").val(json1.kode_asal); 

   $("option:selected",$("#json_poli_tujuan_rs").val(json1.kode_poli)).text();
    $("option:selected",$("#faskes").val(json1.faskes)).text();
     }
    if(json1.kode_pelayanan == 1 ){
	     $("#jenis_perawatan").html("<label class='radio-inline'><input type='radio' name='jen_perawatan' id='optionsRadios4' value='1' checked> Rawat Inap</label><label class='radio-inline'><input type='radio' name='jen_perawatan' id='optionsRadios5' value='2'> Rawat Jalan </label>");  
   }else if(json1.kode_pelayanan == 2){
	 $("#jenis_perawatan").html("<label class='radio-inline'><input type='radio' name='jen_perawatan' id='optionsRadios4' value='1' > Rawat Inap</label><label class='radio-inline'><input type='radio' name='jen_perawatan' id='optionsRadios5' value='2' checked>Rawat Jalan </label>");  
   }else{
	    $("#jenis_perawatan").html("<label class='radio-inline'><input type='radio' name='jen_perawatan' id='optionsRadios4' value='1' > Rawat Inap</label><label class='radio-inline'><input type='radio' name='jen_perawatan' id='optionsRadios5' value='2' checked>Rawat Jalan </label>");  
	   
   }
  if(json1.kode_kelas == 1 || json1.kode_kelas ==''){
	     $("#kelas_perawatan").html("<label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios4' value='1' checked>Kelas 1</label><label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios5' value='2'> Kelas 2 </label><label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios5' value='3'> Kelas 3 </label>");  
  }else if(json1.kode_kelas == 2){
	 $("#kelas_perawatan").html("<label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios4' value='1' >Kelas 1</label><label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios5' value='2' checked>Kelas 2 </label><label class='radio-inline'><input type='radio' name='kel_perawatann' id='optionsRadios5' value='3'> Kelas 3 </label>");  
  }else{
    $("#kelas_perawatan").html("<label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios4' value='1' >Kelas 1</label><label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios5' value='2' checked>Kelas 2 </label><label class='radio-inline'><input type='radio' name='kel_perawatan' id='optionsRadios5' value='3' checked> Kelas 3 </label>");  
   }
 
	return false;
        });
        });
	}
});
$("#hapus_data").bind("click", function(event) {
	    var id =$("#get_medis").val();
		if(id ==''){
			alert("Pilih Yang Akan Di Hapus");
		}else{
				 if(confirm ("Data Akan Dihapus ?")==true){
		  $.post("modul/pg_daftarrawatjalan/crud.php?op=hapusdata", {
            id: id
        },
        function (data, status) {

		});
				 }
		}
	
});

$("#ubah_data").bind("click", function(event) {
    var id =$("#get_medis").val();
    $.post("modul/pg_daftarrawatjalan/crud.php?op=editrawatjalan", {
            id: id
        },
        function (data, status) {
			
        var user = JSON.parse(data);
		 $("#nama_pasien").val(user.nama_pasien);
		  $("#alamat").val(user.alamat);
		   $("#no_rujukan").val(user.no_rujukan);
		   $("#id_dokter").val(user.dokter);
	
		   $("#dokter_lama").val(user.dokter);
		   $("#poli_lama").val(user.poli_id);
			$("#no_rm").val(user.no_rm);
			$("#no_rujukan").val(user.no_rujukan);
			$("#tgl_periksa").val(moment(""+user.periksa+"").format('DD/MM/YYYY'));
			$("#tgl_lama").val(user.periksa);
			$("#jam").val(user.time);
			$("#tgl_rujuk").val(moment(""+user.tgl_rujukan+"").format('DD/MM/YYYY'));
			$("#rujukan").val(user.rujukan);
			$("#catatan").val(user.note);
			$("#no_asuransi").val(user.no_asuransi);
			$("#asuransi_lama").val(user.no_asuransi);
			$("#no_ktp").val(user.no_ktp);
			$("#ktp_lama").val(user.no_ktp);
				$("#pasien_id5").val(user.pasien_id);
			

		$("option:selected",$("#id_poli").val(user.poli_id)).text();
        }
    );
    $("#responsive").modal("show");
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
$("#closediagnosa").bind("click", function(event) {
		$('#suggestions2').fadeOut();
});
});
function cetakkib(){
	var rm =  $("#get_rm").val();
	  win=window.open('modul/pg_pasien/kib.php?no_rm='+rm,'win','width=300, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); 
	
}
function Hapusgambar(kode,rm,file) {
	   $.post("hapus_sosial.php", {
            kode: ""+kode+"",
			rm : ""+rm+"",
			file : ""+file+""
        },
        function (data, status) {
			$("#cek_bpjs").load("tampil_folder.php?cari=BPJS&rm="+rm);	
			$("#cek_ktp").load("tampil_folder.php?cari=KTP&rm="+rm);	
			$("#cek_kk").load("tampil_folder.php?cari=KK&rm="+rm);	
		});	
}
function diagnosa(inputString){
	if(inputString.length == 0) {
		$('#suggestions2').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/diagnosa_sep.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions2').fadeIn();
				$('#suggestionsList2').html(data);
			}
		});
	}
}	
function fil(kode,nama) {
		$('#json_diagnosa_awal').val(""+nama+"");
			$('#json_kode_diagnosa').val(""+kode+"");
				$('#suggestions2').fadeOut();
}

function yesnoCheck() {
    if (document.getElementById('operasi1').checked) {
	  $("#out_tanggal").hide();
    } else {
		 $("#out_tanggal").show();
    }
}function GetMedisId(id,id_pasien,tanggal,bpjs,ktp,rujukan,no_rm) {
    $("#get_medis").val(""+id+"");
	$("#get_pasien").val(""+id_pasien+"");
	$("#tanggal_detail").html(""+tanggal+"");
    $("#get_bpjs").val(""+bpjs+"");
	$("#get_ktp").val(""+ktp+"");
	$("#get_rujukan").val(""+rujukan+"");
	$("#get_tanggal").val(""+tanggal+"");
	$("#get_rm").val(""+no_rm+"");
}
function Detaildokter(poli,tanggal) {
	$("#data_dokter").load("modul/pg_daftarrawatjalan/crud.php?op=datadokter",{poli:""+poli+"",tanggal:""+tanggal+""});	
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


									<div id="update_form_sep" class="modal fade"  aria-hidden="true">
								<div class="modal-dialog" style="width:500px;">
									<div class="modal-content" style="height:170px;">
										<div class="modal-header" style="padding:5px;">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">UPDATE TANGGAL PULANG</h4>
										</div>
										<div class="modal-body" >
										
												<div class="row">
											
													<form action="#" id="form_sample_1" class="form-horizontal">
													<div class="form-group">
		                                         <label class="control-label col-md-4" >Nomor SEP<span class="required"></label>
											     <div class="col-md-8" >											
											        <input type="text" class="form-control" id="json_update_nosep">
											     </div>
											</div>
											<div class="form-group">
		                                    <label class="control-label col-md-4" >Tgl. Pulang<span class="required"></label>
											<div class="col-md-8" >											
											<input type="date" class="form-control" id="json_tgl_pulang">
											</div>
											</div>
											
													</form>
											    </div>
											
										</div>
										<div class="modal-footer">
												<button type="button" class="btn blue" id="simpan_updatesep" > 
								                  <div> SIMPAN </div>
									            </button>
											</div>
										</div>
										</div>
</div>
<div id="responsive2" class="modal fade"  aria-hidden="true">
								<div class="modal-dialog" style="width:1200px;">
									<div class="modal-content" >
										<div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Pendaftaran Pasien Baru</h4>
										</div>
										<div class="modal-body" id="ubahpasien">
										</div>		
<div class="modal-footer">
<button type="button" data-dismiss="modal" class="btn default"><i class="fa fa-backward"></i><div>Kembali</div></button>
											<button type="button" class="btn green" id="fa fa-save"><i class="fa fa-print"></i><div>Simpan</DIV></button>
												<button type="button" class="btn green" id="buat_sep"><i class="fa fa-print"></i><div>Cetak SEP</DIV></button>
											<button type="button" class="btn blue" Onclick="cetakkib()" id="cetak_kib"><i class="fa fa-print"></i><div>CETAK KIB</div></button>
</div>										
									</div>
									</div>
									</div>
									<div id="form_sep" class="modal fade"  aria-hidden="true">
								<div class="modal-dialog" style="width:1200px;">
									<div class="modal-content" style="height:600px;">
										<div class="modal-header" style="padding:5px;">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">BUAT SEP</h4>
										</div>
										<div class="modal-body" >
											<div class="scroller" style="height:500px;" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
											
													<form action="#" id="form_sample_1" class="form-horizontal">
										<div class="col-md-8">
										<div class="col-md-6">
										<div class="form-group">
		                                    <label class="control-label col-md-4" >No. Kartu<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_bpjs">
											</div>
											</div>
											
										<div class="form-group">
		                                    <label class="control-label col-md-4" >NIK<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_nik">
											</div>
										</div>
										
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Nama<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_nama">
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Tanggal Lahir<span class="required"></label>
											<div class="col-md-5" >											
											<input type="text" class="form-control date-picker" id="json_tgl_lahir"  data-date-format="dd/mm/yyyy" >
											</div>
											<?php echo $format2; ?>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Kelamin<span class="required"></label>
											<div class="col-md-8" >											
											<div class="radio-list">
											<span id="jenikel">
											
											</span>
										</div>
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >PISAT<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_pisat">
											</div>
										</div>
										
										<div class="form-group">
		                                    <label class="control-label col-md-4" >PPK TK.I<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_ppk">
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Peserta<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_peserta">
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Kelas Rawat<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_kelas">
											</div>
										</div>
										
										<div class="form-group">
		                                    <label class="control-label col-md-4" >ASURANSI COB<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_cob">
											</div>
										</div>
										<div class="form-group">
		                                 <label class="control-label col-md-4" ></label>
											<div class="col-md-8" >											
											<input type="checkbox" class="form-control" id="peserta_cob" name="peserta_cob"> Peserta COB
											</div>
											   
										</div>
										</div>
											<div class="col-md-6">
											<div class="form-group">
		                                    <label class="control-label col-md-4" >STMT<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_stmt">
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Tgl. Cetak Kartu<span class="required"></label>
											<div class="col-md-5" >											
											<input type="text" class="form-control date-picker" id="json_tgl_cetak_kartu"  data-date-format="dd/mm/yyyy" >
											</div>
											<?php echo $format; ?>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >T.M.T<span class="required"></label>
											<div class="col-md-5" >											
											<input type="text" class="form-control date-picker" id="json_tmt"  data-date-format="dd/mm/yyyy" >
											</div>
									<?php echo $format2; ?>
										
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >T.A.T<span class="required"></label>
											<div class="col-md-5" >											
											<input type="text" class="form-control date-picker" id="json_tat"  data-date-format="dd/mm/yyyy" >
											</div>
									<?php echo $format2; ?>
										
										</div>
											</div>
											
												<div class="col-md-12">
												<div class="panel panel-info">			
<div class="panel-heading">												
								<h3 class="panel-title">Upload File Pendukung</h3>
								</div>
									<div class="panel-body">
									<div class="col-md-4">											
		                                    <label class="control-label col-md-6" id="label_rujuk" >Surat Rujukan<span class="required"></label>
											<div class="col-md-6" >	
<input type="file" id="upload_rujukan" name="upload_rujukan"  style="display:none;"  >											
								<button type="button" class="btn-small btn blue"  onclick="document.getElementById('upload_rujukan').click()"><i class="fa fa-search"></i> Cari File</button>	
										</div>
										</div>
										<div class="col-md-4">											
		                                    <label class="control-label col-md-6" id="label_skdp">Surat Kontrol/SKDP<span class="required"></label>
											<div class="col-md-6" >		
<input type="file" id="upload_skdp" name="upload_skdp" style="display:none;" >		<button type="button" class="btn-small btn blue"  onclick="document.getElementById('upload_skdp').click()"><i class="fa fa-search"></i> Cari File</button>												
												<!--<button type="button" class="btn-small btn blue" id="uploadsuratrujukan"><i class="fa fa-search"></i> Cari File</button>-->
											</div>
										</div>
										<div class="col-md-4">
											
		                                    <label class="control-label col-md-6" id="label_hd">Surat Perintah HD<span class="required"></label>
											<div class="col-md-6" >											
			<input type="file" id="upload_hd" name="upload_hd" style="display:none;" >		
<button type="button" class="btn-small btn blue"  onclick="document.getElementById('upload_hd').click()"><i class="fa fa-search"></i> Cari File</button>				<!--<button type="button" class="btn-small btn blue" id="uploadsuratrujukan"><i class="fa fa-search"></i> Cari File</button>-->
											</div>
										</div>
										
									</div>
										</div>
										</div>
											
											
											</div>
											<div class="col-md-4">
												<div class="note note-success">								
								<h4 class="block">Rujukan</h4>
												<div class="form-group">
		                                    <label class="control-label col-md-4" >Jenis Perawatan<span class="required"></label>
											<div class="col-md-8" >											
											<div class="radio-list" id="jenis_perawatan">
										
										</div>
											</div>
										</div>
											<div class="form-group">
		                                    <label class="control-label col-md-4" >Kelas Perawatan<span class="required"></label>
											<div class="col-md-8" >											
											<div class="radio-list" id="kelas_perawatan">
										
										</div>
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >No. RM<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_rm">
											</div>
										</div>
											<div class="form-group">
		                                 <div class="col-md-6" >
										 <input type="hidden" id="kode_faskes">
										 <select id="faskes" class="form-control">
										 <option value="1">No Rujukan Faskes I</option>
										 <option value="2">No Rujukan Faskes II</option>
										 </select>
										 </div>
											<div class="col-md-6" >											
											<input type="text" class="form-control" id="json_no_rujukan">
											</div>
										</div>
											<div class="form-group">
		                                    <label class="control-label col-md-4" >Asal Rujukan<span class="required"></label>
											<div class="col-md-3" >											
											<input type="text" class="form-control" id="json_kode_asal_rujuk">
											</div>
											<div class="col-md-5" >											
											<input type="text" class="form-control" id="json_asal_rujuk">
											</div>
										</div>
											<div class="form-group">
		                                    <label class="control-label col-md-4" >Tanggal Rujukan<span class="required"></label>
											<div class="col-md-5" >											
											<input type="text" class="form-control date-picker" id="tgl_rujukan">
											</div>
											<?php echo $format; ?>
										</div>
										</div>
										<div class="note note-success">		
											<h4 class="block">SEP</h4>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >No. SEP<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_no_sep" style="font-size:14px;font-weight:600;" readonly >
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Tanggal SEP<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control date-picker" id="tanggal_sep" value="<?php echo $tgl_sekarang1; ?>">
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Diagnosa Awal<span class="required"></label>
											<div class="col-md-2" >											
											<input type="text" class="form-control" id="json_kode_diagnosa">
											</div>
											<div class="col-md-6" >											
											<input type="text" onKeyUp="diagnosa(this.value);"  class="form-control" id="json_diagnosa_awal" autocomplete="off">
											<div class="suggestionsBox1" id="suggestions2" style="display: none;position: absolute;z-index: 9;font-size:11px;">
				   <div class="suggestionList" id="suggestionsList2"> &nbsp; </div>
				    <button id="closediagnosa" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
											</div>
										</div>
										
										
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Poli Tujuan Rujukan<span class="required"></label>
											<div class="col-md-2" >											
											<input type="text" class="form-control" id="json_kode_poli_tujuan_rujukan">
											</div>
											<div class="col-md-6" >											
											<input type="text" class="form-control" id="json_poli_tujuan_rujukan">
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Poli Tujuan RS<span class="required"></label>
											<div class="col-md-8" >											
											<select class="form-control" id="json_poli_tujuan_rs">
											<?php
											$sql="SELECT NAME,MAP_BPJS FROM RS_POLIKLINIK";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query($conn,$sql,$params,$options);
while($row=sqlsrv_fetch_array($stmt)){
	echo"<option value='$row[MAP_BPJS]'>".$row['NAME']."</option>";

}	
											?>
											</select>
											</div>
										</div>
										<div class="form-group">
		                                    <label class="control-label col-md-4" >Catatan<span class="required"></label>
											<div class="col-md-8" >											
											<input type="text" class="form-control" id="json_catatan">
											<input type="checkbox" id="lakalantas" name="lakalantas"> Kecelakaan Lalu Lintas
											<input type="text" style="display:none;" id="lokasilaka" placeholder="Lokasi Kecelakaan">
											</div>
											
										</div>
										</div>
										<div class="form-actions">
												<button type="button" class="btn blue" id="simpan_sep" >
								<i class="fa fa-save"></i><div id="label_simpan">SIMPAN SEP</div>
									</button>
											<button type="button" class="btn green" id="update_tanggal" >
								<i class="fa fa-edit"></i><div>UPDATE TANGGAL PULANG</div>
									</button>
										<button type="button" class="btn purple" id="cetak_hasilsep" >
								<i class="fa fa-print"></i><div>CETAK SEP</div>
									</button>
										</div>
											
									
									
											</div>
											</form>
											</div>
											</div>
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

								<div class="modal-dialog" style="width:700px;margin: 0px auto;" >
									<div class="modal-content" style="height:650px;">
										<div class="modal-header" style="padding:5px;">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Rawat Jalan</h4>
										</div>
									
										<div style="height:550px" class="modal-body" id="modal-body8" data-always-visible="1" data-rail-visible1="1">
												
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
<div id="form_resume" class="modal fade   "  aria-hidden="true">

								<div class="modal-dialog modal-full" >
									<div class="modal-content" style="height:580px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Form Resume Rawat Jalan</h4>
										</div>
										<div class="modal-body">
										<div class="scroller" style="height:530px" data-always-visible="1" data-rail-visible1="1">
														<div class="col-md-6" >
														<div class="row">
															<form action="#" id="form_sample_1" class="form-horizontal">
							
															<div class="form-body" >
													<div class="form-group">
										<div class="col-md-4">
									<div class="input-group">
											<input type="date" id="cari_tanggal"   class="form-control" placeholder="Masukkan Alergi Pasien" >
											<span class="input-group-btn">
											<button class="btn btn-success" id="caripoli" type="button">CARI POLI</button>
											</span>
											</div>
										</div>
										</div>
											
													</div>								
											</form>
											</div>
													<div class="row">
													  <table   class="table table-striped table-hover" id="sample_8">
      <thead>
	  <tr><th>NO</th><th>POLIKLINIK</th><th>BELUM INV</th><th>SUDAH INV</th><th>JML</th>
	  </thead>
	  <tbody id="data_resume">
	  </tbody>
	  </table>
													</div>
														</div>
																			<div class="col-md-6" >
																											  <table   class="table table-striped table-hover" >
      <thead>
	  <tr><th>NO</th><th>NAMA DOKTER</th><th>BELUM INV</th><th>SUDAH INV</th><th>JML</th>
	  </thead>
	  <tbody id="data_dokter">
	  </tbody>
	  </table>
														</div>
										</div>
										</div>
										</div>
										</div>
</div>												
<div id="responsive" class="modal fade"  aria-hidden="true">

								<div class="modal-dialog" style="width:950px;">
									<div class="modal-content" style="height:450px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Ubah Data Rawat Jalan</h4>
										</div>
										<div class="modal-body">
										<div class="scroller" style="height:430px" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
												<div id="tampil"></div>
												
													<form action="#" id="form_sample_1" class="form-horizontal">
										<div class="col-md-6">
										<div id="hasil"></div>
										<div class="form-group">
		<label class="control-label col-md-4" >Dokter<span class="required"></label>
											<div class="col-md-8" >
									<input type="hidden" id="medis_id" class="form-control">
									<input type="hidden" id="dokter_lama">
										<select name="options2" class="form-control" id="id_dokter" onchange="ambil_kota($(this).val())">
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
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	                  $poli_id=$data["POLI_ID"];
                    $dokterid=$data["DR_ID"];
                      $nama_dokter=$data["NAME"];
					  echo"<option value='$dokterid'>$nama_dokter</option>";
					  }
											?>
												
											</select>
									
											
										</div>
		</div>
										<div class="form-group">
		<label class="control-label col-md-4" >No. RM<span class="required"></label>
											<div class="col-md-8" >
									            <input type="hidden" class="form-control" id="pasien_id5">
												<input type="text" class="form-control" id="no_rm">

										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >Pasien<span class="required"></label>
											<div class="col-md-8" >
									
												<input type="text" class="form-control" id="nama_pasien">

										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >Alamat<span class="required"></label>
											<div class="col-md-8" >
									
												<textarea class="form-control" id="alamat"></textarea>
										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >Catatan<span class="required"></label>
											<div class="col-md-8" >
									
												<textarea class="form-control" id="catatan"></textarea>
										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >No. KTP<span class="required"></label>
											<div class="col-md-8" >
									<input type="hidden" class="form-control" id="ktp_lama">
												<input type="text" class="form-control" id="no_ktp">

										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >No. Asuransi<span class="required"></label>
											<div class="col-md-8" >
									<input type="hidden" class="form-control" id="asuransi_lama">
												<input type="text" class="form-control" id="no_asuransi">

										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >No. Rujukan<span class="required"></label>
											<div class="col-md-8" >
									
												<input type="text" class="form-control" id="no_rujukan">

										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >Tgl Rujukan<span class="required"></label>
											<div class="col-md-8" >
									
									
												<input type="text" class="form-control date-picker" name="datepicker" id="tgl_rujuk" >
												
										
										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >Rujukan<span class="required"></label>
											<div class="col-md-8" >
									
										<select name="options2" class="form-control" id="rujukan">
											<option value="">Pilih Rujukan</option>
											<?php
										$sql="SELECT
RUJUKAN_ID,
NAME
FROM
RS_RUJUKAN 
 ORDER BY
NAME ASC ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	               echo"<option value='$data[RUJUKAN_ID]'>$data[NAME]</option>";
					  }
											?>
												
											</select>
									
											
										</div>
		</div>
				
		</div>
		<div class="col-md-6">
		<div class="form-group">
										<label class="control-label col-md-4">Tanggal Rawat
										</label>
										<div class="col-md-8">
										<input type="hidden" id="tgl_lama">
										<div class="input-group date datetime-picker margin-bottom-5"  data-date-format="dd/mm/yyyy hh:ii">
															<input type="text" id="tgl_periksa" class="form-control form-filter input-sm date-picker"   name="product_history_date_from" placeholder="From">
														
														<input type="text" id="jam" class="form-control timepicker-24"   name="product_history_date_from" >
															
														</div>
										</div>
										</div>
										<div class="form-group">
		<label class="control-label col-md-4" >Assesment<span class="required"></label>
											<div class="col-md-8" >
									
												<textarea class="form-control" id="assesment" style="height:220px;"></textarea>
										</div>
		</div>
		<div class="form-group">
		<input type="hidden" id="poli_lama">
		<label class="control-label col-md-4" >Pilih Poli<span class="required"></label>
											<div class="col-md-8" >
									
										<select name="options2" class="form-control " id="id_poli">
											<option value="">Pilih Poli</option>
											<?php
										$sql="SELECT
POLI_ID,
NAME
FROM
RS_POLIKLINIK
 ORDER BY
NAME ASC ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	               echo"<option value='$data[POLI_ID]'>$data[NAME]</option>";
					  }
											?>
												
											</select>
									
											
										</div>
		</div>
		</div></form>
												</div>
												<div class="modal-footer">
												<input type="hidden" id="medis_id">
											<button type="button" data-dismiss="modal" class="btn default">Close</button>
											<button type="button" class="btn green" id="editrajal">Simpan</button>
										</div>	
												</div>
												</div></div>
												</div>
												</div>
	<div class="col-md-12">
					
						<div class="tab-content">
							<div id="tab_2_2" class="tab-pane active">
								<div class="row">
									<div class="col-md-9">
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
															<input id="form_tanggal" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="<?php echo $tgl_sekarang1; ?>"  data-date-format="dd/mm/yyyy" /><span id="tampil_tanggal"></span>
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
										<div class="col-md-3">
									<button class="btn purple" id="resume" >
								<i class="fa fa-files-o"></i><div>RESUME</div>
									</button>
									<button class="btn blue" id="cetak_label" >
								<i class="fa fa-files-o"></i><div>CETAK LABEL</div>
									</button>
									</div>
								</div>
							
							
						</div>
				
				</div>
			
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
						<div class="portlet-body" style="padding:7px;padding-left: 0px;">	

    <table   class="table table-striped table-hover" id="sample_5" style="font-size:12px;">
    <?php echo th(12); ?>


	<input type="hidden" id="get_medis">
	<input type="hidden" id="get_pasien">
	
	<input type="hidden" id="get_ktp">
	<input type="hidden" id="get_bpjs">
	<input type="hidden" id="get_rujukan">
	<input type="hidden" id="get_tanggal">
	<input type="hidden" id="get_rm">
	<!-- Mendapatkan ID Medis Untuk Diseleksi !-->
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
						
							<?php if($_SESSION['level']=='operator'){
								?>
							<div class="actions">
								<div class="btn-group">
								<button class="btn red" id="ubah_alergi" >
								<i class="fa fa-plus-circle"></i><div>ALERGI</div>
									</button>
							<button class="btn purple" id="ubah_data" >
								<i class="fa fa-edit"></i><div>UBAH DATA</div>
							</button>
							<button class="btn red" id="hapus_data" >
								<i class="fa fa-trash-o"></i><div>HAPUS DATA</div>
							</button>
							<button class="btn blue" id="cetak_sep" >
								<i class="fa fa-print"></i><div>CETAK SEP</div>
									</button>
								<button class="btn green" id="edit_pasien" >
								<i class="fa fa-user"></i><div>EDIT PASIEN</div>
									</button>
							
									<button class="btn yellow" id="cetak_pasien" >
								<i class="fa fa-print"></i><div>CETAK DAFTAR PASIEN</div>
									</button>
									<button class="btn blue" id="periksa" >
								<i class="fa fa-paper-plane-o"></i><div>PERIKSA</div>
									</button>
							
								</div>
								<?php
							}
							?>
							</div>
						</div>
						<div class="form-actions right" style="float:right;">
						<?php echo indikator(12); ?>
						</div>
	</div>
		



						</div>
					</div>
						
				</div>
			
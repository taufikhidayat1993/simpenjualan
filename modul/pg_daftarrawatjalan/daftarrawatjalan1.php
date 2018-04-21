 <script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
$(document).ready(function() {


	$("#data").load("page/pg_pencapaian/crud.php?op=tampilpasien");	
$("#poliklinik").change(function(){
	 var data = $("#cari").val();
	var id_poli= $("#poliklinik").val();
	if(cari==''){
		alert("hhhh");
	}else{
    $.post("modul/pg_daftarrawatjalan/crud.php?op=detailpoli", {
			poli : id_poli
        },
        function (data, status) {			
		$("#id_dokter").html(data).show();  
        }  );
	}
});
$("#caridata").bind("click", function(event) {
	 var cari = $("#cari").val();
	 var tanggal  = $('input[name=tanggal]:checked').val();
	 var input_cari = $('#form_cari').val();
	 var id_poli= $("#poliklinik").val();
	 var dokter = $("#id_dokter").val();
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
$('#periksa').on("click", function(event){
				if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
				var id = $('input:checked[name=cek]').val();
			$.post("modul/pg_daftarrawatjalan/crud.php?op=periksa", {
            id: id
        },
        function (data, status) {
       $("#modal-body8").html(data).show();
           }
         );
	   $('#data_periksa').modal('show');
			}else {
				var answer = confirm("Maaf Cek Salah Satu");
			}				
				});	
$("#add_alergi").bind("click", function(event) {
var pasien_id=$("#id_pasien_alergi").val();
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
function yesnoCheck() {
	
    if (document.getElementById('operasi1').checked) {
	  $("#out_tanggal").hide();
      	 
    } else {
		 $("#out_tanggal").show();
    }
}function GetUbah(id) {
    $("#medis_id").val(id);
    $.post("modul/pg_daftarrawatjalan/crud.php?op=editrawatjalan", {
            id: id
        },
        function (data, status) {
        var user = JSON.parse(data);
		 $("#nama_pasien").val(user.nama_pasien);
		  $("#alamat").val(user.alamat);
		   $("#no_rujukan").val(user.no_rujukan);
		   $("#id_dokter").val(user.dokter);
		    $("#no_rm").val(user.no_rm);
			$("#no_rujukan").val(user.no_rujukan);
			$("#tgl_periksa").val(user.periksa);
			$("#tgl_rujuk").val(user.tgl_rujukan);
			$("#rujukan").val(user.rujukan);
			$("#catatan").val(user.note);

		$("option:selected",$("#id_poli").val(user.poli_id)).text();
		   
		  
        }
    );
    $("#responsive").modal("show");
}function GetUbahPasien(id) {
    $("#pasien_id").val(id);
    $.post("modul/pg_daftarrawatjalan/ubah_pasien.php", {
            id: id
        },
        function (data, status) {
			$("#ubahpasien").html(data).show();  
			return false;
        }
    );
    $("#responsive2").modal("show");
}function GetAlergi(id) {
    $("#id_pasien_alergi").val(id);
	    $.post("modul/pg_pasien/crud.php?op=detail_alergi", {
            id_pasien: id
        },
        function (data, status) {
		$("#ket_alergi").val(data);
	}
    );
    $("#alergi").modal("show");
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

								<div class="modal-dialog" style="width:95%">
									<div class="modal-content" style="height:600px;">
										<div class="modal-header" style="padding:5px;">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Rawat Jalan</h4>
										</div>
										<div class="modal-body" style="height:530px">
										<div class="scroller" style="height:530px" data-always-visible="1" data-rail-visible1="1">
												<div class="row" id="modal-body8">
												
												</div>
												</div>
												</div>
												</div>
												</div>
												</div>
												
<div id="responsive" class="modal fade"  aria-hidden="true">

								<div class="modal-dialog" style="width:650px;">
									<div class="modal-content" style="height:570px;">
										<div class="modal-header" STYLE="padding:2px;">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Rawat Jalan</h4>
										</div>
										<div class="modal-body">
										<div class="scroller" style="height:430px" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
													<form action="#" id="form_sample_1" class="form-horizontal">
										<div class="col-md-6">
										<div id="hasil"></div>
										<div class="form-group">
		<label class="control-label col-md-4" >Dokter<span class="required"></label>
											<div class="col-md-8" >
									<input type="hidden" id="medis_id" class="form-control">
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
		<label class="control-label col-md-4" >No. Rujukan<span class="required"></label>
											<div class="col-md-8" >
									
												<input type="text" class="form-control" id="no_rujukan">

										</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4" >Tgl Rujukan<span class="required"></label>
											<div class="col-md-8" >
									
											<div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
												<input type="text" class="form-control" name="datepicker" id="tgl_rujuk" >
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
												</div>

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
										<div class="input-group date datetime-picker margin-bottom-5"  data-date-format="dd/mm/yyyy hh:ii">
															<input type="text" id="tgl_periksa" class="form-control form-filter input-sm"   name="product_history_date_from" placeholder="From">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
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
												</div>
												</div></div>
												</div>
												</div>
	<div class="col-md-12">
					
						<div class="tab-content">
							<div id="tab_2_2" class="tab-pane active">
								<div class="row">
									<div class="col-md-8">
										<div class="booking-search">
											<form action="#" role="form">
												<div class="row form-group">
														<div class="col-md-6">
													
														<div class="radio-list col-md-6">
														<label>
														<input type="radio" onclick="javascript:yesnoCheck();" id="operasi1" name="tanggal" value="0"> Semua Tanggal</label>
														<label>
														<input type="radio" onclick="javascript:yesnoCheck();" id="operasi2" name="tanggal" value="1" checked> Pilih Tanggal</label>
														</div>
													<div class="col-md-6" id="out_tanggal">
														<label class="control-label"></label>
														<div class="input-icon">
															<i class="fa fa-calendar"></i>
															<input id="form_tanggal" class="form-control date-picker" size="16" type="text" value="<?php echo $tgl_sekarang1; ?>"  data-date-format="dd/mm/yyyy" data-date-viewmode="years"/>
														</div>
													</div>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-6">
														<div class="input-icon col-md-6">
															<select id="cari" class="form-control">
															<option value="">Kategori Pilihan</option>
															<option value="1">No. RM   </option>
															<option value="2">ID Pasien</option>
															<option value="3">Nama Pasien</option>														
															<option value="4">Alamat</option>
															</select>
														</div>
														<div class="input-icon col-md-6">
															<i class="fa fa-user"></i>
															<input id="form_cari" class="form-control" size="16" type="text"  data-date="12-02-2012" />
														</div>
													</div>
													
												</div>
												<div class="row form-group">
													<div class="col-md-6">
														<label class="control-label col-md-4">Poliklinik :</label>
														<div class="input-icon col-md-8">
																								<select id="poliklinik" class="form-control select2me">
																								<option value="">--Pilih Poliklinik--</option>
									<?php
$sql="	SELECT 
POLI_ID,
NAME
FROM
RS_POLIKLINIK ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($data=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 
	                 echo"<option value='$data[POLI_ID]'>$data[NAME]</option>";
					  }
		
									?>
                                                                                                </select>
														</div>
													</div>
													<div class="col-md-6">
													<label class="control-label col-md-4">Dokter :</label>
														<div class="input-icon col-md-8">
																<select id="id_dokter" class="form-control select2me">
                                                                </select>
														</div>
													</div>
												</div>
												<button type="button" class="btn blue btn-block margin-top-20" id="caridata">CARI<i class="m-icon-swapright m-icon-white"></i></button>
											</form>
										</div>
									</div>
								</div>
							
							
						</div>
				
				</div>
			</div>
			<BR><BR>
				<div class="col-md-12" STYLE="margin-top:15px;">
			<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>DAFTAR PASIEN MEDIS
							</div>
								<div class="actions">
								<div class="btn-group">
									<button class="btn default" id="periksa" >
									Periksa
									</a>
								
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>
										 No.
									</th>
										<th>NO. ANTRI</th>
									<th>
										No. RM
									</th>
									<th>
										 NAMA PASIEN
									</th>
									<th>
										 ALAMAT
									</th>
									<th>
										TIPE
									</th>
									<th>
										TGL MASUK
									</th>
									<th>
										 POLIKLINIK
									</th>
									<th>
										 DOKTER
									</th>
									<th>
										 NO ANTRI
									</th>
									<th>
										 NO RUJUKAN
									</th>
								</tr>
								</thead>
								<tbody id="data">
								<?
								
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
										echo"<tr><td><input type='checkbox'  class='deleteRow' name='cek' value='".$data['MEDIS_ID']."'  /></td>
										<td></td><td class='$hasil'><span data-toggle='modal' onclick='GetUbahPasien(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;' >$data[NO_RM]</span></td>
										<td "; if ($data['ALERGI']!=''){
											echo "class='danger'"; 
										}echo"><span data-toggle='modal' onclick='GetAlergi(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;' >$data[NAME]</span></td><td><span data-toggle='modal' onclick='GetUbahPasien(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;' >$data[ADDRESS]</span></td><td>$data[NAMA_AS]</td><td>$data[DATE_MEDIS]</td><td>$data[POLI_NAME]</td>
										<td>$data[nama_dokter]</td><td>$data[ANTRIAN]</td><td>$data[NORUJUKAN]</td></tr>";
										$no++;
 }

?>
								
								</tbody>
								</table>
							</div>
						</div>
					</div>
						
				</div>
				</div>
				</div>
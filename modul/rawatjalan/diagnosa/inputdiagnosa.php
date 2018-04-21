<?php
include 'inc/fungsi_tanggal.php';
$MID=$_SESSION['MEDIS_ID'];
/*
$sql="SELECT
	P.MEDIS_ID,
	P.PASIEN_ID,
	Q.NO_RM,
	Q.NAME,
	LOWER (Q.ADDRESS) AS ADDRESS,
	asuransi_pasien = CASE Q.TIPE_PASIEN
WHEN 1 THEN
	'UMUM'
WHEN 3 THEN
	R.NAME
END,
 CONVERT (
	VARCHAR (11),
	P.DATETIME_MEDIS,
	106
) AS DATE_MEDIS,
 CONVERT (
	VARCHAR (8),
	P.DATETIME_MEDIS,
	108
) AS TIME_MEDIS,
 S.NAME AS POLI_NAME,
 P.ANTRIAN,
 P.RUJUKAN_DATA_ID,
 T.DR_ID,
 T.NAME AS nama_dokter,
 T.DR_ID,
 Q.GENDER,
 CONVERT(VARCHAR(10), GETDATE(), 105) AS TGL_INI,
 gender = CASE Q.GENDER
WHEN 1 THEN
	'L'
WHEN 2 THEN
	'P'
END
FROM
	rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE
	P.PASIEN_ID = Q.PASIEN_ID
AND P.STATUS_BAYAR = '0'
AND P.MEDIS_ID = '$MID'";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$r = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
*/
?>
<div class="col-lg-4" id='forminputdiagnosa'>
		<div class="panel panel-danger">
				<div id='label_input' class="panel-heading">
						<i class="fa fa-file-archive-o fa-fw"></i>INPUT DIAGNOSA
				</div>
				<div id='label_edit'class="panel-heading">
						<i class="fa fa-edit fa-fw"></i>EDIT DIAGNOSA
				</div>
				<!-- /.panel-heading -->
<div  class="well" >
<form id="form-data">
	<input type="text" class="form-control" id="iddiagnosa" name="iddiagnosa" disabled/>
	<input type="text" class="form-control" id="seq_no" name="seq_no"/>
	<div class="form-group">
	<label>Tanggal:</label>
	<input type="text" class="form-control" id="tgl" name="tgl" value='<?php echo"$r[TGL_INI]"; ?>'/>
	</div>

	<div class="form-group">
	<label>Anamnesa:</label>
	<textarea id="anamnesa" class="form-control" name="anamnesa" placeholder="" rows='10'>- Subyektif      :
	- Obyektif       :
	  * Vital Signs  :
	           TD       : _mmHg
	           N         : _x/menit
	           RR       : _x/menit
	           S         : _°C
	           Nyeri    : _ (0-10)
	- Assesment      :
	- Planing/ Terapi: </textarea>
	</div>
<div class="form-group">
<label>Dokter: <input class="form-control" value='<?php echo"$r[DR_ID]"; ?>' id="iddokter" size="8" type="text" placeholder="ID Dokter" disabled/>  </label>

<input id="dokter" type="text" value='<?php echo"$r[nama_dokter]"; ?>' class="form-control" placeholder="Ketik Nama Dokter"/>
<div id="tampil_caridokter">
</div>
</div>
<div class="form-group">
<label>Diagnosa: <input class="form-control" id="idpenyakit" type="text" placeholder="ICD10" size="3" disabled/></label>
<input id="diagnosa" type="text" class="form-control" placeholder="Ketik Nama Diagnosa / ICD10"/>
<div id="tampil_caridiagnosa">
</div>
</div>

<input id='btn_simpan' type="button" value="Simpan" onclick="simpanDiagnosa();" class="btn btn-success btn-small"/>
<input id='btn_tambah' type="button" value="Tambah" onclick="tambahDiagnosa();" class="btn btn-success btn-small"/>
<input type="reset" value="Reset" onclick="" class="btn btn-warning btn-small"/>
<input id='btn_batal' type="button" value="Batal" class="btn btn-success btn-small"/>
</form>
</div>

</div>
</div>
<script type="text/javascript">
$("#label_edit").hide();
$("#iddiagnosa").hide();
$("#btn_simpan").hide();
$("#btn_batal").hide();

$("#tgl").datepicker({
		 dateFormat:"dd-mm-yy",
		 changeYear : true,
		 changeMonth:true,
});


	 $("#dokter").keypress(function(){
	 var cari = $("#dokter").val();
	 $("#tampil_caridokter").show();
	 $("#iddokter").val('');

			$.ajax({
				type	: "POST",
				url		: "modul/rawatjalan/diagnosa/tampil_caridokter.php",
				data	: "cari="+cari,
				success	: function(data){
					$("#tampil_caridokter").load('modul/rawatjalan/diagnosa/tampil_caridokter.php?cari='+cari);
				}
			});
 		});

		$('#btn_batal').click(function(){
				history.go(0);
			});
		function masukanDokter(dokterid,nama_dokter){
				var IDDokter = dokterid;
				var namaDokter = nama_dokter;
				$("#iddokter").val(IDDokter);
				$("#dokter").val(namaDokter);
				$("#tampil_caridokter").hide();
			}

			$("#diagnosa").keypress(function(){
			 var cari = $("#diagnosa").val();
			 $("#tampil_caridiagnosa").show();
			 $("#idpenyakit").val('');

			$.ajax({
				type	: "POST",
				url		: "modul/rawatjalan/diagnosa/tampil_caridiagnosa.php",
				data	: "cari="+cari,
				success	: function(data){
				
				 //  $("#idtindakan").hide();
					$("#tampil_caridiagnosa").load('modul/rawatjalan/diagnosa/tampil_caridiagnosa.php?cari='+cari);
				}
			});
 		});

		function masukanDiagnosa(penyakitid,nama_diagnosa){
				var idpenyakit = penyakitid;
				var diagnosa = nama_diagnosa;
				$("#idpenyakit").val(idpenyakit);
				$("#diagnosa").val(diagnosa);
				$("#tampil_caridiagnosa").hide();
			}

			function tambahDiagnosa(){

			var IDdokter		= $("#iddokter").val();
			var dokter		= $("#dokter").val();
			var IDpenyakit		= $("#idpenyakit").val();
			var diagnosa		= $("#diagnosa").val();
			var anamnesa			= $("#anamnesa").val();
			var tgl			= $("#tgl").val();

	if(IDdokter.length==0){
				alert('Maaf, IDdokter tidak boleh kosong silahkan isi dokter.');
				$("#dokter").focus();
				return false();
			}

			if(diagnosa.length==0){
				alert('Maaf, Diagnosa tidak boleh kosong siahkan isi diagnosa.');
				$("#diagnosa").focus();
				return false();
			}
			if(tgl.length==0){
				alert('Maaf, tgl tidak boleh kosong');
				$("#tgl").focus();
				return false();
			}

			$.ajax({
				type	: "POST",
				url		: "../../modul/rawatjalan/diagnosa/simpan_diagnosa.php",
				data	: "IDdokter="+IDdokter+
						"&dokter="+dokter+
						"&IDpenyakit="+IDpenyakit+
						"&tgl="+tgl+
						"&diagnosa="+diagnosa+
						"&anamnesa="+anamnesa,
				success	: function(data){
					$("#tampil_data_diagnosa").load('modul/rawatjalan/diagnosa/tampildatadiagnosa.php');
					$("#tampil_data_riwayat").load('modul/rawatjalan/diagnosa/tampildatariwayatpenyakit.php');
					$("#idpenyakit").val('');
					$("#diagnosa").val('');
				}
			});
		}

		function simpanDiagnosa(){

			var IDdiagnosa		= $("#iddiagnosa").val();
			var seq_no				= $("#seq_no").val();
			var IDdokter			= $("#iddokter").val();
			var dokter				= $("#dokter").val();
			var IDpenyakit		= $("#idpenyakit").val();
			var diagnosa			= $("#diagnosa").val();
			var anamnesa			= $("#anamnesa").val();
			var tgl						= $("#tgl").val();
	if(IDdokter.length==0){
			alert('Maaf, IDdokter tidak boleh kosong silahkan isi dokter.');
			$("#dokter").focus();
			return false();
		}

		if(diagnosa.length==0){
			alert('Maaf, Diagnosa tidak boleh kosong siahkan isi diagnosa.');
			$("#diagnosa").focus();
			return false();
		}
		if(tgl.length==0){
			alert('Maaf, tgl tidak boleh kosong');
			$("#tgl").focus();
			return false();
		}

		$.ajax({
			type	: "POST",
			url		: "../../modul/rawatjalan/diagnosa/edit_diagnosa.php",
			data	: "IDdokter="+IDdokter+
					"&IDdiagnosa="+IDdiagnosa+
					"&seq_no="+seq_no+
					"&IDpenyakit="+IDpenyakit+
					"&tgl="+tgl+
					"&diagnosa="+diagnosa+
					"&dokter="+dokter+
					"&anamnesa="+anamnesa,
			success	: function(data){
				$("#tampil_data_diagnosa").load('../../modul/rawatjalan/diagnosa/tampildatadiagnosa.php');
				$("#tampil_data_riwayat").load('../../modul/rawatjalan/diagnosa/tampildatariwayatpenyakit.php');
				/*$("#idpenyakit").val('');
				$("#diagnosa").val('');*/
				history.go(0);
			}
		});
	}

	</script>

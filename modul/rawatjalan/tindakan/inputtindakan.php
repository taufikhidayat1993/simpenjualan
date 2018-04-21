<?php

include 'inc/fungsi_tanggal.php';
$MID=$_SESSION['MEDIS_ID'];
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

?>
<div  class="well" >
<form id="form-data">

  <div class="form-group">
    <table class="table">
      <tbody>
      <tr class="success">
          <td>
          <label class="radio-inline">
              <input onclick="javascript:tindakanCheck();" type="radio" name="rbtnTindakan" id="rbtnTindakanDokter" value="option1" checked>TINDAKAN DOKTER
          </label>
          <label class="radio-inline">
              <input onclick="javascript:tindakanCheck();" type="radio" name="rbtnTindakan" id="rbtnTindakanPerawat" value="option2" >TINDAKAN PERAWAT
          </label>
          </td>
      </tr>
      </table>
</div>
<div class="form-group" id="form-dokter">
<label>Dokter:<input class="form-control" value='<?php echo"$r[DR_ID]"; ?>' id="iddokter" size="8" type="text" placeholder="ID Dokter" disabled>
</label>
<input id="dokter" type="text" value='<?php echo"$r[nama_dokter]"; ?>' class="form-control" placeholder="Ketik Nama Dokter">
<div id="tampil_caridokter">
</div>
</div>
<div class="form-group" id="form-perawat">
<label>Perawat:
<input class="form-control" id="idperawat" type="text" placeholder="ID Perawat" disabled></label>
<input id="perawat" type="text" class="form-control" placeholder="Ketik Nama Perawat">
<div id="tampil_cariperawat">
</div>
</div>

<div class="form-group">
<label>Tindakan: </label>
<input id="tindakanDokter" name="tindakanDokter" type="text" class="form-control" placeholder="Ketik Nama Tindakan Dokter">
<input id="tindakanPerawat" name="tindakanPerawat" type="text" class="form-control" placeholder="Ketik Nama Tindakan Perawat">
<div id="tampil_caritindakan">
</div>
<input class="form-control" id="idtindakan" type="text" placeholder="ID Tindakan" disabled>
<input class="form-control" id="harga" type="text" name='harga' placeholder="Harga" disabled>
</div>
<div class="form-group">
<label>Catatan:</label>
<textarea id="anamnesa" class="form-control" id="note" name="note" placeholder="" rows='2'></textarea>
</div>
<div class="form-group">
<label>Tanggal:</label>
<input type="text" class="form-control" id="tgl" name="tgl" value='<?php echo"$r[TGL_INI]"; ?>'/>
</div>

<input type="button" value="Simpan" onclick="simpanData();" class="btn btn-success btn-small"/>
<input type="reset" value="Reset" onclick="" class="btn btn-warning btn-small"/>
</form>
</div>
<script type="text/javascript">


$("#form-perawat").hide();
$("#tindakanPerawat").hide();
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
				 url		: "../../modul/rawatjalan/tindakan/tampil_caridokter.php",
				 data	: "cari="+cari,
				 success	: function(data){
					 $("#tampil_caridokter").load('../../modul/rawatjalan/tindakan/tampil_caridokter.php?cari='+cari);
				 }
			 });
			 });

		 function masukanDokter(dokterid,nama_dokter){
 				var IDDokter = dokterid;
 				var namaDokter = nama_dokter;
 				$("#iddokter").val(IDDokter);
 				$("#dokter").val(namaDokter);
 				$("#tampil_caridokter").hide();
 			}

		$("#perawat").keypress(function(){
		var cari = $("#perawat").val();
		 $("#tampil_cariperawat").show();

				$.ajax({
					type	: "POST",
					url		: "../../modul/rawatjalan/tindakan/tampil_cariperawat.php",
					data	: "cari="+cari,
					success	: function(data){
						$("#tampil_cariperawat").load('../../modul/rawatjalan/tindakan/tampil_cariperawat.php?cari='+cari);
					}
				});
				});

				function masukanPerawat(perawatid,nama_perawat){
					 var IDPerawat = perawatid;
					 var namaPerawat = nama_perawat;
					 $("#idperawat").val(IDPerawat);
					 $("#perawat").val(namaPerawat);
					 $("#tampil_cariperawat").hide();
				 }

				 $("#tindakanDokter").keypress(function(){
					 var IDdokter=	$("#iddokter").val();
					 if(IDdokter.length==0){
					 alert('Maaf, Isikan dokter terlebih dahulu.');
					 $("#dokter").focus();
					 return false();
				 		}
					 $("#harga").val('');
					 $("#idtindakan").val('');
					var cari = $("#tindakanDokter").val();
					$("#tampil_caritindakan").show();

						 $.ajax({
							 type	: "POST",
							 url		: "../../modul/rawatjalan/tindakan/tampil_caritindakanDokter.php",
							 data	: "cari="+cari,
							 success	: function(data){
								 $("#tampil_caritindakan").load('../../modul/rawatjalan/tindakan/tampil_caritindakanDokter.php?cari='+cari);
							 }
						 });
					 });

					 $("#tindakanPerawat").keypress(function(){
						 var IDperawat=	$("#idperawat").val();
						if(IDperawat.length==0){
						alert('Maaf, Isikan perawat terlebih dahulu.');
						$("#perawat").focus();
						return false();
						 }
						 $("#harga").val('');
						 $("#idtindakan").val('');
						var cari = $("#tindakanPerawat").val();
						$("#tampil_caritindakan").show();

							 $.ajax({
								 type	: "POST",
								 url		: "../../modul/rawatjalan/tindakan/tampil_caritindakanPerawat.php",
								 data	: "cari="+cari,
								 success	: function(data){
									 $("#tampil_caritindakan").load('../../modul/rawatjalan/tindakan/tampil_caritindakanPerawat.php?cari='+cari);
								 }
							 });
						 });

					 function masukanTindakan(tindakanid,nama_tindakan){
							var IDtindakan = tindakanid;
							var namaTindakan = nama_tindakan;
							var IDdokter=	$("#iddokter").val();
							$.ajax({
								type	: "POST",
								url		: "../../modul/rawatjalan/tindakan/cari_harga.php",
								data	: "IDtindakan="+IDtindakan+
												"&IDdokter="+IDdokter,
								dataType : "json",
								success	: function(data){
									$("#idtindakan").val(IDtindakan);
									$("#tindakanDokter").val(namaTindakan);
									$("#tindakanPerawat").val(namaTindakan);
									$("#harga").val(data.harga);
									$("#tampil_caritindakan").hide();
								}
							});
						}

		function tindakanCheck(){
	  if (document.getElementById('rbtnTindakanDokter').checked) {
	  document.getElementById('form-dokter').style.display = 'block';
		document.getElementById('form-perawat').style.display = 'none';
		document.getElementById('tindakanPerawat').style.display = 'none';
		document.getElementById('tindakanDokter').style.display = 'block';
		// $("#iddokter").val('');
		// $("#dokter").val('');
		$("#harga").val('');
		$("#tindakanDokter").val('');
		$("#idtindakan").val('');
	  }
	  else {
		document.getElementById('form-dokter').style.display = 'none';
		document.getElementById('tindakanDokter').style.display = 'none';
		document.getElementById('form-perawat').style.display = 'block';
		document.getElementById('tindakanPerawat').style.display = 'block';
		// $("#iddokter").val('');
		// $("#dokter").val('');
		// $("#idperawat").val('');
		// $("#perawat").val('');
		$("#harga").val('');
		$("#tindakanPerawat").val('');
		$("#idtindakan").val('');
		}	}
	</script>

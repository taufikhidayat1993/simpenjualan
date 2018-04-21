<?php
/*
session_start();
include 'inc/inc.koneksi.php';
include 'auth.php';
*/
?><?php
$diagnosa_id=$_SESSION['MEDIS_ID'];
$sql="SELECT
P.DIAGNOSA_ID,
P.DIAGNOSA,
P.SEQ_NO,
P.PENYAKIT_ID,
P.NOTE,
Q.NAME AS DR_NAME,
P.DT_DIAGNOSA,
CONVERT(VARCHAR(11),P.DT_DIAGNOSA,106) AS DATE_DIAG
FROM
	rs.RS_DIAGNOSA P
LEFT JOIN rs.RS_DOKTER Q ON P.DR_ID = Q.DR_ID
WHERE
	P.DIAGNOSA_ID = '$diagnosa_id'
ORDER BY
	P.SEQ_NO DESC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt= sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
echo "no diagnosa id $diagnosa_id";
?>

<!-- /.col-lg-4 -->
<div class="col-lg-8" id='tampildiagnosa'>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> DIAGNOSA
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <!--/.tampildatadiagnosa-->
          <table width="100%" class="table table-striped table-bordered table-hover" >
              <thead>
                  <tr>
										<th>NO</th>
                    <th>TANGGAL</th>
                    <th>DIAGNOSA</th>
                    <th>ACTION</th>
                  </tr>
              </thead>
                <tbody>
              <?php
                $no=1;

                if ($row_count > 0){
                  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                    $DIAGNOSA_ID=$data['DIAGNOSA_ID'];
                    $DIAGNOSA=$data['DIAGNOSA'];
                    $SEQ_NO=$data['SEQ_NO'];
										$DATE_DIAG=$data['DATE_DIAG']
                ?>
								<tr class="gradeC">
									<div id="data">
									 <td><?php echo"$no , $data[SEQ_NO]"; ?></td>
									 <td><?php echo"$data[DATE_DIAG]"; ?></td>
									 <td>
										 <a  href='' >
											 <div class="media-body">
													<h5 class="media-heading">
													 <i class='fa fa-stethoscope'></i><strong><?php echo" $data[DIAGNOSA]";?> (<?php echo"$data[PENYAKIT_ID]";?>) </strong>
													 </h5>
													 <p class="small text-muted">
															 <i class="fa fa-edit"></i>	 <?php echo"$data[NOTE]";?>
													 </p>
													 <p class="small text-muted"> <i class="fa fa-user-md"></i>  <font color='black'><b><?php echo"$data[DR_NAME]";?></b></font></p>
												 </div>
										 </a>
										 </td>
									 <td>
                  	<button type="button" onclick="editDiagnosa('<?php echo"$DIAGNOSA_ID";?>','<?php echo"$SEQ_NO";?>','<?php echo"$DIAGNOSA";?>');" class="btn btn-primary btn-circle"><i class="fa fa-pencil"></i></a>
										<button type="button" onclick="hapusDiagnosa('<?php echo"$DIAGNOSA_ID";?>','<?php echo"$SEQ_NO";?>','<?php echo"$DIAGNOSA";?>');" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>
									</td>
									</div>
							 </tr>
              <?php
                $no++;
                  }
                }
              ?>
              </tbody>
          </table>
          <!-- /.table-responsive -->
              <!--/.tampildatadiagnosa-->
        </div>
        <!-- /.panel-body -->
    </div>

</div>
<!--
<div class="col-lg-8" id='formeditdiagnosa'>
    <div class="panel panel-danger">
			<div class="panel-heading">
					<i class="fa fa-edit fa-fw"></i> EDIT DIAGNOSA
			</div>
<div  class="well" >
<form id="form-data">
	<div class="form-group">
	<input type="text" class="form-control" id="iddiagnosa1" name="iddiagnosa1" disabled/>
	<input type="hidden" class="form-control" id="seq_no1" name="seq_no1"/>
	</div>
	<div class="form-group">
	<label>Tanggal:</label>
	<input type="text" class="form-control" id="tgl1" name="tgl1"/>
	</div>

	<div class="form-group">
	<label>Anamnesa:</label>
	<textarea class="form-control" id="anamnesa1" name="anamnesa1" placeholder="" rows='10'>
	</textarea>
	</div>

<div class="form-group">
<label>Dokter: <input class="form-control" id="iddokter1" name="iddokter1" size="8" type="text" placeholder="ID Dokter" disabled>  </label>

<input id="dokter1" name="dokter1" type="text" class="form-control" placeholder="Ketik Nama Dokter">
<div id="tampil_caridokter">
</div>
</div>
<div class="form-group">
<label>Diagnosa: <input class="form-control" name="idpenyakit1" id="idpenyakit1" type="text" placeholder="ICD10" size="3" disabled></label>
<input id="diagnosa1" name="diagnosa1" type="text" class="form-control" placeholder="Ketik Nama Diagnosa / Kode ICD10">
<div id="tampil_caridiagnosa">
</div>
</div>

<input type="button" value="Simpan" onclick="simpanDiagnosa();" class="btn btn-success btn-small"/>
<input type="reset" value="Reset" onclick="" class="btn btn-warning btn-small"/>
</form>
</div>
</div>

</div> -->
  <!-- /.col-lg-8 -->
	<script type="text/javascript">

	$("#formeditdiagnosa").hide();
	function hapusDiagnosa(IDdiagnosa,seq_no,diagnosa) {
		var IDdiagnosa = IDdiagnosa;
		var diagnosa = diagnosa;
		var seq_no = seq_no;
	  var pilih = confirm('Anda yakin akan menghapus diagnosa "'+diagnosa+'" ini?');
		  if (pilih==true) {
			$.ajax({
				type	: "POST",
				url		: "../../modul/rawatjalan/diagnosa/hapus_diagnosa.php",
				data	: "IDdiagnosa="+IDdiagnosa+
								"&seq_no="+seq_no,
				success	: function(data){
					$("#tampil_data_diagnosa").load('../../modul/rawatjalan/diagnosa/tampildatadiagnosa.php');
					$("#tampil_data_riwayat").load('../../modul/rawatjalan/diagnosa/tampildatariwayatpenyakit.php');
				}
			});
		}
	}

	function editDiagnosa(IDdiagnosa,seq_no,diagnosa){
		var IDdiagnosa = IDdiagnosa;
		var diagnosa = diagnosa;
		var seq_no = seq_no;
	var pilih = confirm('Apakah anda akan mengubah data diagnosa '+diagnosa+'?');
	if (pilih==true) {

	$.ajax({
		type	: "POST",
		url		: "../../modul/rawatjalan/diagnosa/cari_diagnosa.php",
		data	: "IDdiagnosa="+IDdiagnosa+
						"&seq_no="+seq_no,
		dataType : "json",
		success	: function(data){
			$("#label_edit").show();
			$("#label_input").hide();
			$("#iddiagnosa").show();
			$("#btn_simpan").show();
			$("#btn_tambah").hide();
			$("#btn_batal").show();
			$("#tampildiagnosa").hide();
			/*$("#forminputdiagnosa").hide();
			$("#formeditdiagnosa").show();*/
				$("#iddiagnosa").val(IDdiagnosa);
				$("#diagnosa").val(diagnosa);
				$("#seq_no").val(seq_no);
			$("#iddokter").val(data.IDdokter);
			$("#dokter").val(data.dokter);
			$("#idpenyakit").val(data.IDpenyakit);
			$("#anamnesa").val(data.anamnesa);
			$("#tgl").val(data.tgl);
			}
		});
		}
	}
</script>

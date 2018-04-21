<?
session_start();
include"../../inc/inc.koneksi.php";
include"../../inc/fungsi_indotgl.php";
include"../../inc/fungsi_radiologi.php";

?>
<script type="TEXT/JAVASCRIPT">
		$("#data_resume").load("modul/pg_daftarrawatjalan/crud.php?op=resume",{tanggal:'<?php echo $_POST['tanggal']; ?>'});	
	function DetailDokter(id) {
	
				alert("coba");
}
	</script>
<div class="scroller" style="height:530px" data-always-visible="1" data-rail-visible1="1">
														<div class="col-md-6" >
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
<?php


?>
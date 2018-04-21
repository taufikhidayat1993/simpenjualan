<script type="text/javascript">	
  $('.pane-hScroll1').scroll(function() {
  $('.pane-vScroll').width($('.pane-hScroll1').width() + $('.pane-hScroll1').scrollLeft());
  });
	</script>
			<style>
{
  box-sizing: border-box;
}


.pane {
  background: #eee;
}
.pane-hScroll1 {
  overflow: auto;

}
.pane-hScroll1 table th {
 background:#bfbfbf;
}
.pane-vScroll {
  overflow-y: auto;
  overflow-x: hidden;
  height: 200px;
  background: :#fff;
  color:#000;
}
.pane--table2 thead {
    display: table-row;
}

</style>

<?php
include"../../inc/inc.koneksi.php";

	error_reporting(0);
		if(isset($_POST['queryString'])) {
			if($_POST['opsi']=='dokter'){
				$cari='0';
			}else{
				$cari='1';
			}
			$queryString = $_POST['queryString'];
			 			
			  $sql="
		SELECT TOP 50
NAME,
TINDAKAN_ID
FROM
RS_TINDAKAN WHERE  (NAME LIKE '%$queryString%' OR TINDAKAN_ID LIKE '%$queryString%' )AND TINDAKAN_MODE='$cari'";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
		
					if(strlen($queryString) >=3) {
				if($stmt) {
				echo '
					<div class="pane pane--table1">
  <div class="pane-hScroll1">
				<table style="width:100%">
				<thead style="color:#000;">
				<tr><th  style="width:300px;" >Nama Tindakan</th><th>KODE</th></tr></thead></table><div class="pane-vScroll2"> <table   width="100%"><tbody>';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
									$no_rm=$data['TINDAKAN_ID'];
	         			echo '<tr  class="rows" onClick="input_tindakan(\''.addslashes(	$no_rm).'\');"><td  style="width:300px;">'.$data['NAME'].'</td><td>'.$data['TINDAKAN_ID'].'</td></tr>';
	         		}
				echo '</table></div></div>';
					
				} else {
					echo 'Data Tidak Di Temukan';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'Minimal 3 Karakter';
		}
		}
?>
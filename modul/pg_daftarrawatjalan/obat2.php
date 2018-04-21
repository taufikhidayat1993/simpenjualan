<script type="text/javascript">	
  $('.pane-hScroll2').scroll(function() {
  $('.pane-vScroll2').width($('.pane-hScroll2').width() + $('.pane-hScroll2').scrollLeft());
  });
	</script>


<?php
include"../../inc/inc.koneksi.php";

	error_reporting(0);
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];
			 			
			  $sql="
SELECT ITEM_CODE,QTY_STOCK,ITEM_NAME,QTY_STOCK FROM RS_MASTER_ITEM WHERE ITEM_NAME LIKE '%$queryString%' ORDER BY ITEM_NAME ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
			if(strlen($queryString) >=3) {
				
				if($stmt) {
				echo '
						<div class="pane pane--table1">
  <div class="pane-hScroll2">
				<table width="100%" class="obat">
					<thead style="color:#000;"><tr>
				<th style="width:300px;">NAMA OBAT</th><th style=width:10px;>STOK</th></tr></thead></table>
				<div class="pane-vScroll2"> <table  width="100%" class="table table-hover">';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
									$no_rm=$data['ITEM_CODE'];
	         			echo '<tbody><tr  class="rows" onClick="inputobatbhp(\''.addslashes($data['ITEM_CODE']).'\');">
						<td style="width:280px;" >'.$data['ITEM_NAME'].'</td><td >'.round($data['QTY_STOCK']).'</td></tr>';
	         		}
				echo '</tbody></table></div></div>';
					
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
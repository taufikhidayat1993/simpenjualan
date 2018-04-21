
<?php
include"../../inc/inc.koneksi.php";

	error_reporting(0);
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];
			 			
			  $sql="
	SELECT TOP 10 PENYAKIT_ID,NAME,NOTE FROM rs.RS_PENYAKIT
               WHERE NAME LIKE '%$queryString %' OR (NOTE LIKE '%$queryString%' OR PENYAKIT_ID LIKE '%$queryString%')
ORDER BY
PENYAKIT_ID ASC ";
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
				<table style="width:100%;font-size:12px;">
				<thead style="color:#000;"><tr><th style="width:70px;">ICD</th>
				<th style="width:230px;" >Nama Tindakan</th><th>Keterangan</th></tr></thead></table> <div class="pane-vScroll"> 
				<table width="100%;"style="font-size:12px;" id="table"><tbody>';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
									$no_rm=$data['PENYAKIT_ID'];
	         			echo '<tr style="cursor:pointer" class="rows" onClick="fil(\''.addslashes($no_rm).'\',\''.addslashes($data['NAME']).'\');">
						<td style="width:70px;">'.$data['PENYAKIT_ID'].'</td><td class=tanggal style="width:230px;">'.$data['NAME'].'</td><td>'.$data['NOTE'].'</td></tr>';
	         		}
				echo '
				<tr><td colspan=3>	<script type="text/javascript">	
  $(".pane-hScroll1").scroll(function() {
  $(".pane-vScroll").width($(".pane-hScroll1").width() + $(".pane-hScroll1").scrollLeft());
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
.pane-vScroll {
     overflow-y: auto;
    overflow-x: hidden;
    height: 200px;
    background: white;
    color: #524c4c;
}
.pane--table2 thead {
    display: table-row;
}
</style></td>
				</tbody></table></div></div></div>';
					
				} else {
					echo 'Data Tidak Di Temukan';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'Minimal w3 Karakter';
		}
		}
?>

<?php
include"../../inc/inc.koneksi.php";
	error_reporting(0);
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];		
$sql="select LAB_CODE,NAME FROM RS_LAB_ITEM WHERE NAME LIKE '%$queryString%' order BY NAME ASC";	
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
				<table style="100%" >
				<thead style="color:#000;"><tr><th style="width:70px;">DATA ID</th>			
				<th>NAMA</th>
				</tr></thead></table> <div class="pane-vScroll"> <table width="100%" id="table"><tbody>';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
									$lab_code=$data['LAB_CODE'];
	         			echo '<tr style="cursor:pointer" class="rows" onClick="fil(\''.addslashes($data['NAME']).'\');">
						<td style="width:70px;">'.$lab_code.'</td><td class=tanggal style="width:230px;">'.$data['NAME'].'</td>
						</tr>';
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
			echo 'Minimal 3 Karakter';
		}
		}
?>
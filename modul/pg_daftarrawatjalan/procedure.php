
<?php
include"../../inc/inc.koneksi.php";

	error_reporting(0);
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];
			 			
			  $sql="
		SELECT TOP 50
NAME,
ICD9
FROM
RS_PROSEDUR WHERE NAME LIKE '%$queryString%' OR ICD9 LIKE '%$queryString%'";
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
			<table  width="100%" class="tables">
			<thead style="color:#000;"><tr><th style="width:280px;">Prosedur</th><th>ICD9</th></tr></thead></table>
				<div class="pane-vScroll2">
				<table  width="100%" class="table" style="background-color:#fff;"><tbody>';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
									$no_rm=$data['ICD9'];
	         	echo '<tr style="cursor:pointer" class="rows"onClick="fill2(\''.addslashes($no_rm).'\');"><td class=tanggal style="width:280px;">'.$data['NAME'].'</td> <td>'.$data['ICD9'].'</td></tr>';
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
.tables thead tr th{
	background-color:#ddd;
	
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
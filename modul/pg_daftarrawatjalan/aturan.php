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
			
			$queryString = $_POST['queryString'];
			if($queryString != '') { 			
			  $sql="
		SELECT *
FROM
RS_ATURAN WHERE  aturan LIKE '%$queryString%' ";
			}else {
				  $sql="
		SELECT *
FROM
RS_ATURAN  ";
			}
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
		
			
echo'<div class="pane pane--table1">
  <div class="pane-hScroll1" style="width:100px;">
				<table width="100%">
			
				<tbody>';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
							   	    echo '<tr  class="rows" onClick="input_aturan(\''.addslashes($data['aturan']).'\');"><td  >'.$data['aturan'].'</td></tr>';
	         		}
				echo '</table></div></div>';
					
				} else {
					echo 'Data Tidak Di Temukan';
				}
			
		
		}
?>
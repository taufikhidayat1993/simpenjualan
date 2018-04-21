<?php
include"../../inc/inc.koneksi.php";

	error_reporting(0);
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];
			  $pisah = explode(',',$queryString );
			
			  $sql="
		SELECT TOP 50
rs.RS_PASIEN.PASIEN_ID,
rs.RS_PASIEN.NO_RM,
rs.RS_PASIEN.NAME,
rs.RS_PASIEN.ADDRESS,
rs.RS_PASIEN.NO_ASURANSI

FROM
rs.RS_PASIEN WHERE rs.RS_PASIEN.NAME LIKE '%$pisah[0]%'  and rs.RS_PASIEN.ADDRESS like '%$pisah[1]%' ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
			if(strlen($queryString) >=3) {
				
				if($stmt) {
				echo '<div class="select2-with-searchbox select2-drop-active"><ul class="select2-results">';
					if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
										$id_pasien=$data['PASIEN_ID'];
										$no_rm=$data['NO_RM'];
	         			echo '<li class="select2-results-dept-0 select2-result select2-result-selectable"onClick="fill(\''.addslashes($id_pasien).'\'); fill2(\''.addslashes($no_rm).'\');">'.$data['NAME'].'<br>'.$data['ADDRESS'].'</li>';
	         		}
				echo '</ul></div>';
					
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
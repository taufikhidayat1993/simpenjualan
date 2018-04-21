<?php
/*
$medis_id=$_SESSION['MEDIS_ID'];
$sql="SELECT
	CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	P.TINDAKAN_ID
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	P.OPERASI_ID
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			P.PERSALINAN_ID
		END
	)
END
END AS TINDAKAN,
 CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	Q.NAME
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	R.NAME
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			S.NAME
		END
	)
END
END AS TINDAKAN_NAME,
 P.SEQ_NO,
 P.HARGA,
 CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	'5'
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	'3'
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			'4'
		END
	)
END
END AS TINDAKAN_TYPE,
 CASE
WHEN DR.NAME IS NOT NULL THEN
	DR.NAME
ELSE
	PR.NAME
END AS PETUGAS_NAME,
 P.NOTE,
 CONVERT(VARCHAR(8),P.DATE_TIME,108) AS TIME_TINDAKAN,
 CONVERT(VARCHAR(11),P.DATE_TIME,106) AS DATE_TINDAKAN,
 P.DATE_TIME
FROM
	rs.RS_MEDIS_TINDAKAN P
LEFT JOIN rs.RS_TINDAKAN Q ON P.TINDAKAN_ID = Q.TINDAKAN_ID
LEFT JOIN rs.RS_OPERASI R ON P.OPERASI_ID = R.OPERASI_ID
LEFT JOIN rs.RS_PERSALINAN S ON P.PERSALINAN_ID = S.PERSALINAN_ID
LEFT JOIN rs.RS_DOKTER DR ON P.DR_ID = DR.DR_ID
LEFT JOIN rs.RS_PERAWAT PR ON P.PERAWAT_ID = PR.PERAWAT_ID
WHERE
	P.MEDIS_ID = '$medis_id'
ORDER BY
	P.SEQ_NO
      ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );

echo"$medis_id";
*/
?>

<div class="col-lg-7">
    <div class="panel panel-success">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-copy glyphicon-fw"></i> TINDAKAN
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <!--/.tampildatadiagnosa-->
            <table width="100%"  class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
              <thead>
                  <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>TINDAKAN</th>
                    <th>ACTION</th>
                  </tr>
              </thead>
                <tbody>
              <?php
                $no=1;

                if ($row_count > 0){
                  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                ?>
								<tr class="gradeC">
									 <td><?php echo"$no"; ?></td>
									 <td width=18%><i class="fa fa-calendar"></i> <?php echo"$data[DATE_TINDAKAN]"; ?>  <br><i class="fa fa-clock-o"></i> <?php echo"$data[TIME_TINDAKAN]"; ?>
									 <td>
										 <a  href='#' >
											 <div class="media-body">
													<h5 class="media-heading">
													 <i class='glyphicon glyphicon-copy'></i><strong><?php echo" $data[TINDAKAN_NAME]";?> (<?php echo"$data[TINDAKAN]";?>) </strong>
													 </h5>

													 <p class="small text-muted"> <i class="fa fa-money"></i>  <font color='black'><b><?php echo"$data[HARGA]";?></b></font></p>
													 <p class="small text-muted">
															 <i class="fa fa-edit"></i>	 <?php echo"$data[NOTE]";?>
													 </p>
													 <p class="small text-muted"> <i class="fa fa-user-md"></i>  <font color='black'><b><?php echo"$data[PETUGAS_NAME]";?></b></font></p>
												 </div>
										 </a>
										 </td>
									 <td><a  href='modul/rawatjalan/cek_pasien.php?PID=<?php//echo"$PASIEN_ID"; ?>' ><button type="button" class="btn btn-success btn-circle"><i class="fa fa-stethoscope"></i><i class="fa fa-list"></i></button></a></td>
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
  <!-- /.col-lg-8 -->

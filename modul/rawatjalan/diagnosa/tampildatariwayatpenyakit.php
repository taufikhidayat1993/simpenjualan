<?php
session_start();
include '../../../inc/inc.koneksi.php';
include '../../../auth.php';
?><?php
$pasien_id=$_SESSION['PASIEN_ID'];
$sql="SELECT
P.DIAGNOSA_ID,
 P.DIAGNOSA,
 P.SEQ_NO,
 P.PENYAKIT_ID,
 P.NOTE,
 Q.NAME AS DR_NAME,
 P.DT_DIAGNOSA,
 CONVERT (
	VARCHAR (11),
	P.DT_DIAGNOSA,
	106
) AS DATE_DIAG
FROM
	rs.RS_DIAGNOSA P
LEFT JOIN rs.RS_DOKTER Q ON P.DR_ID = Q.DR_ID
WHERE
	LEFT (
		P.DIAGNOSA_ID,
		LEN(P.DIAGNOSA_ID) - 12
	) = '$pasien_id'
ORDER BY
	P.DT_DIAGNOSA DESC,
	P.SEQ_NO DESC";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );

?>

<div class="col-lg-12">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> RIWAYAT PENYAKIT
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <!--/.tampildatadiagnosa-->
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                    $DIAGNOSA_ID=$data["DIAGNOSA_ID"];
                ?>
                  <tr class="gradeC">
                     <td><?php echo"$no"; ?></td>
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
                     <td><a  href='' ><button type="button" class="btn btn-success btn-circle"><i class="fa fa-stethoscope"></i><i class="fa fa-list"></i></button></a></td>
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

  <!-- DataTables CSS -->
  <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

  <!-- DataTables JavaScript -->
 <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
 <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
 <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

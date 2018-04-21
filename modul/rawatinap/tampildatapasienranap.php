<?php
/*
$sql="SELECT
P.OPNAME_ID,
P.PASIEN_ID,
Q.NO_RM,
Q.NAME,
LOWER(Q.ADDRESS) AS ADDRESS,
RS.FN_GET_ASURANSI_PASIEN (P.PASIEN_ID) AS ASURANSI_PASIEN,
CONVERT(VARCHAR(11),P.DATETIME_IN,106) AS DATE_IN,
CONVERT(VARCHAR(8),P.DATETIME_IN,108) AS TIME_IN,
R.NAME AS KAMAR_NAME,
R.KELAS_ID AS ID_KELAS,
p.note,
Q.GENDER,
JK = CASE Q.GENDER WHEN 1 THEN 'L' WHEN 2 THEN 'P' END,
S.NAME AS NAME_KELAS

FROM
rs.RS_PASIEN_OPNAME AS P
LEFT JOIN rs.RS_KAMAR AS R ON P.KAMAR_ID = R.KAMAR_ID
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
INNER JOIN rs.RS_KELAS AS S ON R.KELAS_ID = S.KELAS_ID
WHERE
P.PASIEN_ID = Q.PASIEN_ID AND
P.STATUS_BAYAR = '0'
ORDER BY
P.DATETIME_IN DESC
";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
*/
?>
 <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                      
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="?page=home">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                 <li>
                                    <a href="#">Rawat Inap</a>
                                    <i class="fa fa-circle"></i>
                                </li>
								<li>
                                    <a href="#">Daftar Pasien Rawat Inap</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                            </ul>
                           
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                      
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
						    <h1 class="page-title"> Rawat Jalan
                            <small>Daftar Pasien Rawat Jalan</small>
                        </h1>
                        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Pasien Rawat Inap
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <table width="100%"  class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                <thead>
                                    <tr>
                                      <th>NO</th>
                                      <th>IDENTITAS PASIEN</th>
                                      <th>BANGSAL</th>
                                      <th>ACTION</th>
                                    </tr>
                                </thead>
                                  <tbody>
                                <?php
                                	$no=1;

                                	if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                                        $sex=$data["GENDER"];
                                        $PASIEN_ID=($data["PASIEN_ID"]);
                                      //  $rujukan=$data["RUJUKAN_DATA_ID"];
                                  ?>
                                    <tr>
                                        <td><?php echo"$no"; ?></td>
                                        <td>
                                          <div class="media-body">
                                              <p class="small text-muted"></i>NO RM  <font color='black'><b><?php echo"$data[NO_RM]";?></b></font></p>
                                              <h5 class="media-heading">
                                              <?php if($sex=='1'){ echo"<i class='fa fa-male'></i>";}else{echo"<i class='fa fa-female'></i>";} ?><strong><?php echo" $data[NAME]"; ?> (<?php echo"$data[JK]"; ?>)</strong>
                                              </h5>
                                              <p class="small text-muted"><i class="fa fa-home"></i> <?php echo"$data[ADDRESS]"; ?></p>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="media-body">
                                              <p class="small text-muted"> <i class="fa fa-star"></i>  <font color='black'><b> <?php echo" $data[NAME_KELAS]"; ?></b></font></p>
                                              <h5 class="media-heading">
                                              <i class='fa fa-medkit'></i><strong><?php echo" $data[KAMAR_NAME]"; ?> </strong>
                                              </h5>
                                              <p class="small text-muted">
                                                  <i class="fa fa-calendar"></i> <?php echo"$data[DATE_IN]"; ?>
                                                  <i class="fa fa-clock-o"></i> <?php echo"$data[TIME_IN]"; ?>
                                              </p>
                                            </div>
                                        </td>
                                        <td class="center"><a  href='modul/rawatinap/cek_pasien.php?PID=<?php echo"$PASIEN_ID"; ?>' ><button type="button" class="btn btn-success btn-circle"><i class="fa fa-stethoscope"></i><i class="fa fa-list"></i></button></a></td>
                                      </tr>

                                <?php
                                	$no++;
                                    }
                                  }
                                ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

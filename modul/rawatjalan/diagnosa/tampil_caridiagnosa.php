<?php
include '../../../inc/inc.koneksi.php';
$cari	= $_GET['cari'];
$sql="SELECT TOP 10 PENYAKIT_ID,NAME,NOTE FROM rs.RS_PENYAKIT
               WHERE NAME LIKE '%$cari%' OR NOTE LIKE '%$cari%' OR PENYAKIT_ID LIKE '%$cari%'
ORDER BY
PENYAKIT_ID ASC";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
?>
<div class="panel panel-default">
        <div class="panel-body">
          <!--/.tampildatadiagnosa-->
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <tbody>
              <?php
              if ($row_count > 0){
                  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                    $penyakitid=$data["PENYAKIT_ID"];
                      $nama_diagnosa=$data["NAME"];
                      $note_diagnosa=$data["NOTE"];
                ?>
								<tr class="gradeC">
                  <td>
                    <a  href="javascript:masukanDiagnosa('<?php echo"$penyakitid"; ?>','<?php echo"$nama_diagnosa"; ?>')" >
                      <div class="media-body">
                          <p class="small text-muted"> <i class="fa fa-stethoscope"></i>  <font color='black'><b><?php echo"$data[PENYAKIT_ID]";?></b></font></p>
                        </div>
                    </a>
                  </td>
									 <td>
										 <a  href="javascript:masukanDiagnosa('<?php echo"$penyakitid"; ?>','<?php echo"$nama_diagnosa"; ?>')" >
											 <div class="media-body">
													 <p class="small text-muted">9  <font color='black'><b><?php echo"$data[NAME]";?></b></font></p>
												 </div>
										 </a>
										 </td>
                     <td>
                       <a  href="javascript:masukanDiagnosa('<?php echo"$penyakitid"; ?>','<?php echo"$nama_diagnosa"; ?>')" >
                         <div class="media-body">
  													 <p class="small text-muted"> <font color='black'><b><?php echo"$data[NOTE]";?></b></font></p>
  												 </div>
  										 </a>
  										 </td>
									  </tr>
              <?php
                  }
                }else{
                  ?>
                       <div class="alert alert-danger alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                               Maaf, Nama diagnosa yang anda inputkan tidak ada.
                          </div>
  										 </td>
  									  </tr>
                <?php
                }
              ?>
              </tbody>
          </table>
          <!-- /.table-responsive -->
              <!--/.tampildatadiagnosa-->
        </div>
        <!-- /.panel-body -->
</div>
      <script type="text/javascript">

        </script>

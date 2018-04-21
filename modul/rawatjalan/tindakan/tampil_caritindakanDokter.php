<?php
include '../../../inc/inc.koneksi.php';
$cari	= $_GET['cari'];
$sql="SELECT TOP 10
	P.TINDAKAN_ID,
	P.NAME,
	P.TINDAKAN_MODE
FROM
	rs.RS_TINDAKAN P
	 WHERE P.NAME LIKE '%$cari%' AND P.TINDAKAN_MODE='0'
ORDER BY
	P.NAME ASC";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
?>

<div class="panel-body">
  <!--/.tampildatadiagnosa-->
  <table width="100%" class="table table-striped table-bordered table-hover" >
      <tbody>
      <?php
        if ($row_count > 0){
          while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
            $tindakanid=$data["TINDAKAN_ID"];
              $nama_tindakan=$data["NAME"];
        ?>
        <tr class="gradeC">
           <td>
						   <div class="media-body" onclick="masukanTindakan('<?php echo"$tindakanid";?>','<?php echo"$nama_tindakan";?>');">
                   <p class="small text-muted"> <i class="glyphicon glyphicon-pushpin"></i>  <font color='black'><b><?php echo"$data[NAME]";?></b></font></p>
                 </div>

             </td>
            </tr>
      <?php
          }
        }else{
          ?>
               <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       Maaf, Nama tindakan yang anda inputkan tidak ada.
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

<!-- <script type="text/javascript">
</script> -->

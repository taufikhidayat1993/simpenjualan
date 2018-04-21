<?php
include '../../../inc/inc.koneksi.php';
$cari	= $_GET['cari'];
$sql="SELECT TOP 10
	PERAWAT_ID,
	NAME
FROM
	rs.RS_PERAWAT
WHERE
	NAME LIKE '%$cari%'
  ORDER BY
  	NAME ASC";
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
            $perawatid=$data["PERAWAT_ID"];
              $nama_perawat=$data["NAME"];
        ?>
        <tr class="gradeC">
           <td>
             <a  href="javascript:masukanPerawat('<?php echo"$perawatid"; ?>','<?php echo"$nama_perawat"; ?>')" >
               <div class="media-body">
                   <p class="small text-muted"> <i class="fa fa-user-md"></i>  <font color='black'><b><?php echo"$data[NAME]";?></b></font></p>
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
                       Maaf, Nama perawat yang anda inputkan tidak ada.
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

<script type="text/javascript">

</script>

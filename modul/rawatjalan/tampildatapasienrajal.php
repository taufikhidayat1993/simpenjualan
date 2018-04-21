<?php

if($mod =='tampildatapasienrajal' AND $_GET['act']==''){

$sql="SELECT top 10
P.MEDIS_ID,
P.PASIEN_ID,
Q.NO_RM,
Q.NAME,
LOWER(Q.ADDRESS) AS ADDRESS,
asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM' WHEN 3 THEN R.NAME END,
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,106) AS DATE_MEDIS,
CONVERT(VARCHAR(8),P.DATETIME_MEDIS,108) AS TIME_MEDIS,
S.NAME AS POLI_NAME,
P.ANTRIAN,
P.RUJUKAN_DATA_ID,
T.NAME AS nama_dokter,
T.DR_ID,
Q.GENDER,
gender=CASE Q.GENDER WHEN 1 THEN 'L' WHEN 2 THEN 'P' END

FROM
rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE
P.PASIEN_ID = Q.PASIEN_ID AND
P.STATUS_BAYAR = '0' AND CONVERT(VARCHAR(11),P.DATETIME_MEDIS,103) ='15/06/2017'

ORDER BY
P.DATETIME_MEDIS DESC";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );

?>
<script>
function edit_pasien(id) {
    $("#hidden_user_id").val(id);
    $.post("page/pg_gerai/crud.php?op=formtambahakun", {
            id: id
        },
        function (data, status) {
            // PARSE json data
           $(".modal-body2").html(data).show();
        }
    );
    $("#responsive").modal("show");
}
</script>
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
                                    <a href="#">Rawat Jalan</a>
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
						<div id="responsive" class="modal fade"  aria-hidden="true">
								<div class="modal-dialog" style="width:1200px;">
									<div class="modal-content" style="height:570px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Pendaftaran Pasien Baru</h4>
										</div>
										<div class="modal-body">
										<div class="scroller" style="height:430px" data-always-visible="1" data-rail-visible1="1">
												<div class="row">
												<form action="#" id="form_sample_1" class="form-horizontal">
										<div class="col-md-4">
										<div class="form-group">
		<label class="control-label col-md-4" >No. RM<span class="required"></label>
											<div class="col-md-8" >
										<div class="input-group">
											<span class="input-group-addon">
											<input type="checkbox" name="cek_rm" id="cek_rm" value="option1" checked>No.RM
											</span>
										<input type="text" >
											<span class="input-group-addon">
												<input type="checkbox" name="cek_drm" id="drm"  checked> DRM
												<input type="hidden" id="hasil_drm" value="1">
											</span>
											</div>
										</div>
		</div>
										<div class="form-group">
										<label class="control-label col-md-4">Nama <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tgl. Lahir<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
										
											<div class="input-group">
											<span class="input-group-addon">
											<input type="checkbox" id="cek_umur" name="cek_umur">
											</span>
											<div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
												<input type="text" class="form-control" name="datepicker" id="add_tgl_lahir" value="01/01/1970">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
												</div>
											</div>
										<span id="view_umur" style="padding-top:4px;">
											<input type="text" id="add_umur" onKeyUp="umur(this.value);"   class="form-control" placeholder="Umur" >
											</span>
										</div>
											
											
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tpt Lahir <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Telepon <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">HP <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">No. Identitas<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Jenis Kelamin<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<div class="radio-list">
												<label class="radio-inline">
												<input type="radio" name="jk" id="laki-laki" value="1" checked> Laki-laki </label>
												<label class="radio-inline">
												<input type="radio" name="jk" id="perempuan" value="2" > Perempuan </label>
												
											</div>
										</div>
										
									</div>
										<div class="form-group">
									<label class="control-label col-md-4" >Status<span class="required"></label>
											<div class="col-md-8">
									
											<div class="radio-list">
												<label >
												<input type="radio" name="jk" id="laki-laki" value="1" checked> Single </label>
													<label >
												<input type="radio" name="jk" id="laki-laki" value="1" checked> Menikah </label>
												<label >
												<input type="radio" name="jk" id="perempuan" value="2" >Menikah/Janda</label>
												
											</div>
										</div>
									</div>
									
									</div>
									<div class="col-md-4">
										
									<div class="form-group">
										<label class="control-label col-md-4">Alamat <span class="required">
										</span>
										</label>
										<div class="col-md-8">
											<textarea id="alamat" name="alamat" class="form-control" ></textarea></td><td colspan="2">
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Kode Pos<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Propinsi<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
										<option value="">--Pilih Propinsi--</option>
									<?php
$sql="	SELECT 
PROP_ID,
NAME
FROM
RS_PROPINSI ORDER BY NAME ASC ";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
 while($data=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
	 if($data['PROP_ID']=='PV14'){
		 $cek="selected";
	 }else{
		 $cek="";
	 }
	                 echo"<option value='$data[PROP_ID]' $cek>$data[NAME]</option>";
					  }
		
									?>
									
									</select>
										</div>
										</div>
											<div class="form-group">
										<label class="control-label col-md-4">Kabupaten<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
</select>
</div>
</div>	
<div class="form-group">
										<label class="control-label col-md-4">Kecamatan<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
</select>
</div>
</div>
<div class="form-group">
										<label class="control-label col-md-4">Kelurahan<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
</select>
</div>
</div>			
	<h5 class="form-section">Data Medis ::::::::</h5>
		
								<div class="form-group">
										<label class="control-label col-md-4">Berat<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										
										
									</div>
									<div class="form-group">
									<label class="control-label col-md-4">Tinggi<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Pasien" >
										</div>
										</div>
										<div class="form-group">
									<label class="control-label col-md-4">Gol. Darah<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<select class="form-control">
										
											<option value="">NONE</option>
											<option value="O">O</option>
											<option value="O">A</option>
											<option value="B">B</option>
											<option value="AB">AB</option>
											</select>
										</div>
										</div>
													
									</div>
									
									<div class="col-md-4">
								<div class="form-group">
										<label class="control-label col-md-4">Agama<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
</select>
</div>
</div>	
<div class="form-group">
										<label class="control-label col-md-4">RAS<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
</select>
</div>
</div>
<div class="form-group">
										<label class="control-label col-md-4">Pendidikan<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
</select>
</div>
</div>
<div class="form-group">
										<label class="control-label col-md-4">Pekerjaan<span class="required">
										 </span>
										</label>
										<div class="col-md-8">
									<select id="add_propinsi" class="form-control select2me">
</select>
</div>
</div>	

									<div class="form-group">
										<label class="control-label col-md-4">Warga Negara <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Warga Negara" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Nama Ayah<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Ayah" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Nama Ibu <span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Nama Ibu" >
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Suami/Istri<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										
											<input type="text" id="nama_pasien" id="nama_pasien"   class="form-control" placeholder="Suami/Istri" >
										</div>
										
									</div>	
									<div class="form-group">
										<label class="control-label col-md-4">Tipe<span class="required">
										</span>
										</label>
										<div class="col-md-8">
										<div class="radio-list">
												<label >
												<input type="radio" name="jk" id="laki-laki" value="1" checked>Umum</label>
												<label >
												<input type="radio" name="jk" id="perempuan" value="2" >Asuransi/Perusahaan</label>
												
											</div>
										</div>
										
									</div>
									</div>
									</form>
									</div>
									</div>
										</div>
										</div>
										</div>
										</div>
										
                <div class="col-lg-12">
                      <div class="portlet box red">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Daftar Pasien Rawat Jalan </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                            <table width="100%"  class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                <thead>
                                    <tr>
                                      <th>NO</th>
                                      <th>IDENTITAS PASIEN</th>
                                      <th>KLINIK</th>
                                      <th>ACTION</th>
                                    </tr>
                                </thead>
                                  <tbody>
                                <?php
                                	$no=1;

                                	if ($row_count > 0){
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                                        $sex=$data["GENDER"];
                                        $rujukan=$data["RUJUKAN_DATA_ID"];
                                        $PASIEN_ID=$data["PASIEN_ID"];
                                  ?>
                                    <tr>
                                        <td><?php echo"$no"; ?></td>
                                        <td>  <button data-toggle='modal' onclick='edit_pasien(<?php echo $PASIEN_ID; ?>)'  >
                                          <div class="media-body">
                                              <p class="small text-muted"></i>NO RM  <font color='black'><b><?php echo"$data[NO_RM]";?></b></font></p>
                                              <h5 class="media-heading">
                                              <?php if($sex=='1'){ echo"<i class='fa fa-male'></i>";}else{echo"<i class='fa fa-female'></i>";} ?><strong><?php echo" $data[NAME]"; ?> (<?php echo"$data[gender]"; ?>)</strong>
                                              </h5>
                                              <p class="small text-muted"><i class="fa fa-home"></i> <?php echo"$data[ADDRESS]"; ?></p>
                                          </div>
                                        </button>
                                        </td>
                                        <td>  <a  href='modul/rawatjalan/cek_pasien.php?PID=<?php echo"$PASIEN_ID"; ?>' >
                                          <div class="media-body">
                                              <p class="small text-muted"> <i class="fa fa-user-md"></i>  <font color='black'><b><?php echo"$data[nama_dokter]";?></b></font></p>
                                              <h5 class="media-heading">
                                              <i class='fa fa-medkit'></i><strong><?php echo" $data[POLI_NAME]"; ?> </strong>
                                              </h5>
                                              <p class="small text-muted">
                                                  <i class="fa fa-calendar"></i> <?php echo"$data[DATE_MEDIS]"; ?>
                                                  <i class="fa fa-clock-o"></i> <?php echo"$data[TIME_MEDIS]"; ?>
                                                  <i class="fa fa-users"></i> antrian <font color='black'><b><?php echo"$data[ANTRIAN]"; ?> </b></font>
                                              </p>
                                              <p><?php if($rujukan!=''){ echo"<i class='fa fa-ambulance'></i>";} ?><?php echo" $data[RUJUKAN_DATA_ID]"; ?></p>
                                          </div>
                                        </a>
                                        </td>
                                        <td class="center"><a  href='?module=tampildatapasienrajal&act=pasien&PID=<?php echo"$PASIEN_ID"; ?>' ><button type="button" class="btn btn-success btn-circle"><i class="fa fa-stethoscope"></i><i class="fa fa-list"></i></button></a></td>
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
</div>
<?php
}if($mod =='tampildatapasienrajal' AND $_GET['act']=='pasien'){
	
	include"modul/rawatjalan/cek_pasien.php";
}if($mod =='tampildatapasienrajal' AND $_GET['act']=='datapasien'){	
	  include "pasien/pasien.php";
}if($mod =='tampildatapasienrajal' AND $_GET['act']=='tindakan'){	
	  include "tindakan/tindakan.php";
}
if($mod =='tampildatapasienrajal' AND $_GET['act']=='diagnosa'){	
	  include "diagnosa/diagnosa.php";
}if($mod =='tampildatapasienrajal' AND $_GET['act']=='datapasien'){	
	  include "pasien/pasien.php";
}if($mod =='tampildatapasienrajal' AND $_GET['act']=='lab'){	
  include "lab/lab.php";
}if($mod =='tampildatapasienrajal' AND $_GET['act']=='rad'){	
  include "rad/rad.php";
}

?>
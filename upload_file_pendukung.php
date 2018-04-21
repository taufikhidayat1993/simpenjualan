<?php
include "inc/inc.koneksi.php";
include "inc/library.php";
$folderawal=date("Y.m.d");
$no_sep=$_POST['no_sep'];
$surat=$_POST['surat'];
$params = array();
$sqlrujukan="select param_value from rs_param where param_code = 'URLKLAIMWEB' or param_code ='SCPATHWEB'"; 
$queryrujukan = sqlsrv_query($conn,$sqlrujukan,$params);
$no=1;
while($datarujukan=sqlsrv_fetch_array($queryrujukan,SQLSRV_FETCH_ASSOC)){
$dir[$no]=$datarujukan['param_value'];
$no++;	
}
$folder = $dir[2]."/".$folderawal."/".$no_sep."/";
function createDirectory($path,$include_filename=false){
     $dir = explode('/',$path);  // Array direktori
     $total = (int) count($dir);  // Total array
     if($include_filename == true){
      unset($dir[($total - 1)]);  // Unset array terakhir (filename)
     }
     $cur_dir = '';
     foreach($dir as $key){   // Membuat direktori
      if(!is_dir($cur_dir.$key)){
       mkdir($cur_dir.$key,'777');
      }
      $cur_dir .= $key.'/';
     }
    }

	$path = $folder;
createDirectory($path,true);

echo $path;

if($_FILES["file"]["name"] != '')
{
		
 $test = explode('.', $_FILES["file"]["name"]);
 $ext  = end($test);
 $nama=$no_sep."-".$surat;
 $name = $nama.'.'.$ext;
 $location = $dir[2].'/'.$folderawal.'/'.$no_sep.'/'.$name;;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo ''.$location.'';
 echo '<p>Gambar Telah Terupload di folder images</p>';
}else{
	echo"gagal";
}

?>
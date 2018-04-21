<?php
include "inc/library.php";
if($_FILES["file"]["name"] != '')
{

$nama=$_POST['nama'];
 $rm   = explode('-',$nama); 
 $kiri= left($rm[0],2);
 $kanan= right($rm[0],2);
 $test = explode('.', $_FILES["file"]["name"]);
 $ext  = end($test);
 $name = $nama.'.'.$ext;
 $location = $folder.''.$kanan.'/'.$kiri.'/'.$rm[0].'/SOSIAL/'. $name;;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo ''.$location.'';
 echo '<p>Gambar Telah Terupload di folder images</p>';
}else{
	echo"gagal";
}
?>
<?php
include "../../inc/inc.koneksi.php";
include 'authrajal.php';
$modrajal = $_GET['modulerajal'];

if ($modrajal=='pasien'){
	  include "pasien/pasien.php";
}
elseif ($modrajal=='diagnosa'){
    include "diagnosa/diagnosa.php";
}
elseif ($modrajal=='tindakan'){
  include "tindakan/tindakan.php";
}
elseif ($modrajal=='lab'){
  include "lab/lab.php";
}
elseif ($modrajal=='rad'){
  include "rad/rad.php";
}
else{  include "pasien/pasien.php";
}
?>

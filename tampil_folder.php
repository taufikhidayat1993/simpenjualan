<?php
include "inc/library.php";
$cari=$_GET['cari'];
$rm=$_GET['rm'];
$kiri= left($rm,2);
$kanan= right($rm,2);
$folder = $folder."".$kanan."/".$kiri."/".$rm."/SOSIAL/"; //Sesuaikan Folder nya
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
	
	$path = '$folder';
createDirectory($path,true);

	

if(!($buka_folder = opendir($folder))) die ('Tidak Ada ');

$file_array = array(); 
while($baca_folder = readdir($buka_folder))
 {
  if(substr($baca_folder,0,1) != '.')
    {
     $file_array[] =  $baca_folder;
    }
 }
$nama="";
$no=1;
 while(list($index, $nama_file) = each($file_array))
  {
   $nama.="$nama_file";
   $gambar[$no]= "$nama_file";
   
$no++;
 }
$kalimat = $nama;

if(preg_match("/$cari/i", $kalimat)) {
	if($cari =='BPJS') {
		$index=1;
	}else if ($cari =='KK'){
			$index=2;
	}else{
		$index=3;
	}
  echo 'Ada <button type="button" class="btn btn-danger" onClick=Hapusgambar("BPJS","'.$rm.'","'.$gambar[$index].'")> Hapus </button>';
} else {
  echo 'Tidak Ada <input type="hidden" name="file_'.$cari.'" id="file_'.$cari.'" value="'.$rm.'-SOSIAL-'.$cari.'"><input type="file" name="upload_file'.$cari.'" id="upload_file'.$cari.'">';
}
closedir($buka_folder);
?>
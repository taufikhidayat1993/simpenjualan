<?php 
include "inc/library.php";
$fileku=$_POST['file'];
$rm=$_POST['rm'];
$kode=$_POST['kode'];
$kiri= left($rm,2);
$kanan= right($rm,2);
$file_hapus=$fileku;
$folder = $folder."".$kanan."/".$kiri."/".$rm."/SOSIAL/"; //Sesuaikan Folder nya
$file = $folder."".$file_hapus;

if (!unlink($file))
{
echo ("Error deleting $file");
}
else
{
echo ("Deleted $img");
}
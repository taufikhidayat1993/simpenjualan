<?php
function buangspasi($teks){
$teks= trim($teks);
while( strpos($teks, ' ') ){
$hasil= str_replace(' ', "", $teks);
}
return $teks;
}



$tulisan = " Mencoba menghilangkan Spasi ";

echo $tulisan;

?>
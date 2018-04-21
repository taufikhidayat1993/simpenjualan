<?php
$string="
llkkkkl klk CEK RADIOLOGI {
	CRANIUM
	 HEMABULA
}";




$labir="CEK RADIOLOGI {
	CRANIUM
	 HEMABULA
	 taufik
	 gula gula
}";

$find2="CEK RADIOLOGI {";
$find="}";
$yangcek="CEK RADIOLOGI ";
$find_length=  strlen($find);
$find_length2=  strlen($find2);

$offset=strpos($string,$yangcek);
$offset2=strpos($string,$yangcek);

if(strpos($string, $yangcek)!== false){
$no=1;
while ($string_position = strpos($string, $find, $offset)) {

    $offset=$string_position+$find_length;
		
	$hasil[$no]=$string_position;
	$no++;
}
$no=1;
while ($string_position2 = strpos($string, $find2, $offset2)) {
    $offset2=$string_position2+$find_length2;
	$hasile[$no]=$string_position2;
	echo $offset2;
	$no++;
}
$range=$hasil[1]-$hasile[1];
echo substr_replace($string,"".$labir."",  $hasile[1], $range+1); 
}else{
echo $labir; 
}

?>
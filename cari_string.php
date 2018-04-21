<?php

$find="}";
$find2="{";
$yangcek="CEK LABORATORIUM";
$find_length=  strlen($find);
$find_length2=  strlen($find2);
$string="
CEK LABORATORIUM {	
	ADADSDAD
	ADADAD
	ADADAD
}
CEK RADIOLOGI {
	DADADAD\ADADADAD
	DADADAD\ADADADADD
	DSDDDD
	DDSDD
	DSDSD	
}";

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
	$no++;
}
$range=$hasil[1]-$hasile[1];
echo substr_replace( $string, "kjkjk kkkkj kjkj ",  $hasile[1]+1, $range-1 ); 
}

 
?> 
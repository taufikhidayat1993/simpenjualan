<?php
error_reporting(0);
$row= "CEK RADIOLOGI { \n";
$data=$_POST['data'];
$splittedstring=explode("|",$data);
if($data !=''){
$row.="CRANIUM :";
$no=0;
foreach ($splittedstring as $key) {
	if($key=='Zygomatic Arc' OR  $key=='Mandibula (EISPLER)' OR $key=='Masthoid (SHULLER)' OR $key=='T.M. Joint'){
		if($key!=''){
		$row.="\n  -".$key;
		}
if($splittedstring[$no+1]=='L' AND $splittedstring[$no+2]=='R'){
		$row.=" (L & R)";
	}else if($splittedstring[$no+1]=='L' AND $splittedstring[$no+2]!='R'){
		$row.=" (L)";
	}else if($splittedstring[$no+1]=='R' ){		
			$row.="(R)";
	}
}		
else{
	if($key=='R' OR $key=='L'){
		$row.=" ";
	}else{
	if($key!=''){
		$row.="\n  -".$key;
		}
}
}$no++;	
}
if($_POST['ket_cranium']!=''){
		echo $_POST['ket_cranium'];
	}
}
$data2=$_POST['vertebrae'];
$vertebrae=explode("|",$data2);
if($data2!=''){
	$row.="\nVERTEBRAE :";
}
foreach ($vertebrae as $key1) {
			if($key1!=''){
		$row.="\n  -".$key1;
		}
}

$data3=$_POST['extremitas_atas'];
$extremitas_atas=explode("|",$data3);
if($data3 !=''){
$row.="\nEXTREMITAS ATAS :";
$no=0;
foreach ($extremitas_atas as $key2) {
	if($key2=='Clavicula' OR  $key2=='Scapula AP' OR $key2=='Scapula AP/Y View' OR $key2=='Shoulder Joint AP' OR $key2=='Humerus AP/Lateral' 
	OR $key2=='Arctic Cubiti AP/Lateral' OR $key2=='Anterbrachi AP/Lateral' OR $key2=='Wrist Join AP/Lateral' OR $key2 =='Manus AP/Oblique' OR $key2 =='Jari tangan (Digiti)'){
		if($key2!=''){
		$row.="\n  -".$key2;
		}
if($extremitas_atas[$no+1]=='L' AND $extremitas_atas[$no+2]=='R'){
		$row.=" (L & R)";
	}else if($extremitas_atas[$no+1]=='L' AND $extremitas_atas[$no+2]!='R'){
		$row.=" (L)";
	}else if($extremitas_atas[$no+1]=='R' ){		
			$row.=" (R)";
	}
	}
		
else{
	if($key2=='R' OR $key2=='L'){
		$row.=" ";
	}else{
		if($key2!=''){
		$row.="\n -".$key2;
		}
	}
	}
	$no++;
}
if($_POST['ket_vertebrae']!=''){
		echo $_POST['ket_vertebrae'];
	}
}
$data4=$_POST['extremitas_bawah'];
$extremitas_bawah=explode("|",$data4);
if($data4 !=''){
$row.="\nEXTREMITAS BAWAH :";
$no=0;
foreach ($extremitas_bawah as $key3) {
	if($key3=='Collum femur AP (HIP JOINT)' OR  $key3=='Fermur AP/Lateral' OR $key3=='Genu AP/Lateral' OR $key3=='Cruris AP/Lateral' OR $key3=='Ankle AP/Lateral' 
	OR $key3=='Pedis AP/Oblique' OR $key3=='Calcaneus Axial/Lateral' OR $key3=='Patella Axial Skyline'){
			if($key3!=''){
		$row.="\n -".$key3;
			}	
      if($extremitas_bawah[$no+1]=='L' AND $extremitas_bawah[$no+2]=='R'){
		$row.=" (L & R)";
	  }else if($extremitas_bawah[$no+1]=='L' AND $extremitas_bawah[$no+2] !='R'){
		$row.=" (L)";
	}else if($extremitas_bawah[$no+1]=='R' ){		
			$row.=" (R)";
	}
	}
		
else{
	if($key3=='R' OR $key3=='L'){
		$row.=" ";
	}else{
		if($key3!=''){
		$row.="\n -".$key3;
		}
	}
	}
	$no++;
}
if($_POST['ket_exbawah']!=''){
		echo $_POST['ket_exbawah'];
	}
}
$data5=$_POST['body'];
$body=explode("|",$data5);
if($data5 !=''){
	$row.="BODY";
$no=0;
foreach ($body as $key4) {
	if($key4=='Thorax Paru Lat' OR  $key4=='Thorax Paru PA/Lat' ){
		$row.="\n -".$key4;
if($body[$no+1]=='L' AND $body[$no+2]=='R'){
		$row.=" (L & R)";
	}else if($body[$no+1]=='L' AND $body[$no+2]!='R'){
		$row.=" (L)";
	}else if($body[$no+1]=='R' ){		
			$row.=" (R)";
	}
	}		
else{
	if($key4=='R' OR $key4=='L'){
		$row.=" ";
	}else{
		if($key4!=''){
		$row.="\n -".$key4;
		}
	}
	}
	$no++;
}
if($_POST['ket_body']!=''){
		echo $_POST['ket_body'];
	}
}
$data6=$_POST['ultrasonografi'];
$ultrasonografi=explode("|",$data6);
if($data6!=''){
	$row.="\nULTRASONOGRAFI :";
}
foreach ($ultrasonografi as $key5) {
	if($key5!=''){
		$row.="\n -".$key5;	
	}
}

if($gigi1!='' OR  $gigi2!='' OR $gigi3!='' OR $gigi4!='' OR $_POST['gigi_peripical']!='' ){
	$row.="\n GIGI PERIAPICAL";
$gigi1=explode("|",$_POST['gigi1']);
$gigi2=explode("|",$_POST['gigi2']);
$gigi3=explode("|",$_POST['gigi3']);
$gigi4=explode("|",$_POST['gigi4']);
foreach ($gigi1 as $gi1) {
	if($gi1!=''){
	$row.="\n -1.".$gi1;
	}
}
foreach ($gigi2 as $gi2) {
	if($gi2!=''){
	$row.="\n -2.".$gi2;
	}
}
foreach ($gigi3 as $gi3) {
	if($gi3!=''){
	$row.="\n -3.".$gi3;
	}
}
foreach ($gigi4 as $gi4) {
	if($gi4!=''){
	$row.="\n -4.".$gi4;
	}
}
if($_POST['gigi_peripical']!=''){
		$row.="\n".$_POST['gigi_peripical'];
	}
}

	
$data7=$_POST['ct_scan'];
$ct_scan=explode("|",$data7);
if($data7!=''){
	$row.="\nCT SCAN :";

foreach ($ct_scan as $key6) {
	if($key6=='CT Scan Vertebrae'){
		$row.="\n -".$key6."".$_POST['text_ctscan_vertebrae'];	
	}else if($key6=='CT Scan Extremitas'){
		$row.="\n -".$key6."".$_POST['text_ctscan_extremitas'];	
	}else if($key6=='Print 3 D'){
		$row.="\n -".$key6."".$_POST['text_print3d'];
	}else{
		if($key6!=''){
		$row.="\n -".$key6;	
		}
	}
}
if($_POST['ket_ctscan']!=''){
		echo $_POST['ket_ctscan'];
	}
}
$data8=$_POST['pemeriksaan_canggih'];
$pemeriksaan=explode("|",$data8);
if($data8 !=''){
	$row.="\nPEMERIKSAAN CANGGIH :";

$no=0;
foreach ($pemeriksaan as $key8) {
	if($key8=='Arteriografi Femoralis'){
		$row.="\n -".$key8;
if($pemeriksaan[$no+1]=='L' AND $pemeriksaan[$no+2]=='R'){
		$row.=" (L & R)";
	}else if($pemeriksaan[$no+1]=='L' AND $pemeriksaan[$no+2]!='R'){
		$row.=" (L)";
	}else if($pemeriksaan[$no+1]=='R' ){		
			$row.=" (R)";
	}
	
}		
else{
	if($key8=='R' OR $key8=='L'){
		$row.=" ";
	}else{
		if($key8!=''){
		$row.="\n -".$key8;
		}
		if($key8=='Phlebografi/Venografi'){
			$row.=" ".$_POST['text_phlebografi'];
		}
	}
	}
	$no++;

}
if($_POST['ket_lain_lain'] !='')
{
	echo $_POST['ket_lain_lain'];
}
}

$row.="\n} ";
	 
$find2="CEK RADIOLOGI {";
$find="}";
$yangcek="CEK RADIOLOGI ";
$find_length=  strlen($find);
$find_length2=  strlen($find2);
$string= $_POST['planning'];

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
$out="\n".$row."\n";
echo substr_replace($string,"".$out."",  $hasile[1], $range+1); 
}else{
echo ltrim($string)."\n".ltrim($row);
}
?>
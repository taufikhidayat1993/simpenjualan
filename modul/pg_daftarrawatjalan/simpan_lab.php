<?php
error_reporting(0);
include"../../inc/inc.koneksi.php";
include"../../inc/fungsi_laboratorium.php";
    $hematologi= explode("|",$_POST['hematologi']);
	$urinalisa= explode("|",$_POST['urinalisa']);
	$jantung = explode("|",$_POST['jantung']);	
	$paket =  explode("|",$_POST['paket']);		
	$faal_hati= explode("|",$_POST['faal_hati']);
	$faal_ginjal= explode("|",$_POST['faal_ginjal']);		
	$feses= explode("|",$_POST['feses']);
	$imuno_serologi= explode("|",$_POST['imuno_serologi']);
	$elektrolit = explode("|",$_POST['elektrolit']);
	$gula_darah= explode("|",$_POST['gula_darah']);
    $lemak= explode("|",$_POST['lemak']);
	$mikrobiologi= explode("|",$_POST['mikrobiologi']);
	$penanda_tumor= explode("|",$_POST['penanda_tumor']);
	$lemak= explode("|",$_POST['lemak']);
	$pasien_id=$_POST['pasien_id'];
	$medis_id=$_POST['medis_id'];
	$pemeriksaan_lain=$_POST['pemeriksaan_lain'];
	
	$labor ="CEK LABORATORIUM{ \n ";
				
					$params = array();

$sqldelete="delete from rs_procedure_pasien where trx_id = '".$medis_id."' and icd9 in('90.59','91.39','90.44','90.99','17.35')";
	sqlsrv_query($conn, $sqldelete , $params);		
	 if($_POST['hematologi'] !=''){
		 		 $labor.="HEMATOLOGI :";
				 foreach ($hematologi as $key1) {
					
				 $hasil= explode(",",$key1);
				 $masuk="".$medis_id.",".$hasil[0]."";
			
				 if($hasil[1] !=''){
	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n -".$hasil[1];
				 }else{
					 	$labor.="\n";
				 }					
				 }
				 
	 }
	  if($_POST['urinalisa'] !=''){
		 		 $labor.="URINALISA :";
				 foreach ($urinalisa as $key2) {					
			$hasil= explode(",",$key2);
				 if($hasil[1] !=''){					 	
				simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
	 }
	 
	  if($_POST['jantung'] !=''){
		 		 $labor.="JANTUNG :";
				 foreach ($jantung as $key3) {					
				 $hasil= explode(",",$key3);
				 if($hasil[1] !=''){					 	 	
			simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
	 }
	  if($_POST['paket'] !=''){
		 		 $labor.="PAKET :";
				 foreach ($paket as $key4) {					
				 $hasil= explode(",",$key4);
				 if($hasil[1] !=''){
					 	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
	 }
if($_POST['faal_hati'] !=''){
		 		 $labor.="FAAL HATI :";
				 foreach ($faal_hati as $key5) {					
				 $hasil= explode(",",$key5);
				 if($hasil[1] !=''){
						simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}
if($_POST['faal_ginjal'] !=''){
		 		 $labor.="FAAL GINJAL :";
				 foreach ($faal_hati as $key6) {					
				 $hasil= explode(",",$key6);
				 if($hasil[1] !=''){
					 	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}
if($_POST['feses'] !=''){
		 		 $labor.="FESES :";
				 foreach ($feses as $key7) {					
				 $hasil= explode(",",$key7);
				 if($hasil[1] !=''){
					 	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}
if($_POST['imuno_serologi'] !=''){
		 		 $labor.="IMUNO-SEROLOGI :";
				 foreach ($imuno_serologi as $key8) {					
				 $hasil= explode(",",$key8);
				 if($hasil[1] !=''){
					 	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}
if($_POST['hormon'] !=''){
		 		 $labor.="HORMON :";
				 foreach ($hormon as $key9) {					
				 $hasil= explode(",",$key9);
				 if($hasil[1] !=''){
					 	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}
if($_POST['gula_darah'] !=''){
		 		 $labor.="GULA DARAH :";
				 foreach ($gula_darah as $key10) {					
				 $hasil= explode(",",$key10);
				 if($hasil[1] !=''){
					 	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}
if($_POST['lemak'] !=''){
		 		 $labor.="LEMAK :";
				 foreach ($lemak as $key11) {					
				 $hasil= explode(",",$key11);
				 if($hasil[1] !=''){
					 	simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}
if($_POST['mikrobiologi'] !=''){
		 		 $labor.="MIKROBIOLOGI :";
				 foreach ($mikrobiologi as $key12) {					
				 $hasil= explode(",",$key12);
				 if($hasil[1] !=''){
						simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					 $labor.="\n";
				 }					 
		}
}

if($_POST['penanda_tumor'] !=''){
		 		 $labor.="PENANDA TUMOR :";
				 foreach ($penanda_tumor as $key13) {					
				 $hasil= explode(",",$key13);
				 if($hasil[1] !=''){
						simpan_laboratorium($medis_id,$hasil[0]);
					 	$labor.="\n  -".$hasil[1];
				 }else{
					    $labor.="\n";
				 }					 
		}
}
if($pemeriksaan_lain !=''){
	 $labor.= "\n PEMERIKSAAN LAIN :\n ".$pemeriksaan_lain."\n";
}
$labor.="}";
	 
	 echo $labor;

?>
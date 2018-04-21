<?php
function umur($tgl_lahir){
    $tgl=explode("/",$tgl_lahir);
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari=$cek_jmlhr1-$tgl['0'];
    $ssbln=12-$tgl['1']-1;
    $hari=0;
    $bulan=0;
    $tahun=0;
//hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+date('d')-$cek_jmlhr2;
    }else{
        $hari=$sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
        $bulan=($ssbln+date('m')+$bulan)-12;
        $tahun=date('Y')-$tgl['2'];
    }else{
        $bulan=($ssbln+date('m')+$bulan);
        $tahun=(date('Y')-$tgl['2'])-1;
    }
	if($bulan > 6) {
		$tahun=$tahun+1;
	}else{
			$tahun=$tahun;
	}
if($tahun==0){
      $selisih=$bulan." Bulan ".$hari." Hari";
}else if($tahun==0 AND $bulan==0){
	  $selisih=$hari." Hari";
}else{
	$selisih=$tahun." Tahun ".$bulan." Bulan ".$hari." Hari";
}
    return $selisih;
}
function umur_tahun($tgl_lahir){
    $tgl=explode("/",$tgl_lahir);
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari=$cek_jmlhr1-$tgl['0'];
    $ssbln=12-$tgl['1']-1;
    $hari=0;
    $bulan=0;
    $tahun=0;
//hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+date('d')-$cek_jmlhr2;
    }else{
        $hari=$sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
        $bulan=($ssbln+date('m')+$bulan)-12;
        $tahun=date('Y')-$tgl['2'];
    }else{
        $bulan=($ssbln+date('m')+$bulan);
        $tahun=(date('Y')-$tgl['2'])-1;
    }
	if($bulan > 6) {
		$tahun=$tahun+1;
	}else{
			$tahun=$tahun;
	}
if($tahun==0){
      $selisih=$bulan." Bulan ".$hari." Hari";
}else if($tahun==0 AND $bulan==0){
	  $selisih=$hari." Hari";
}else{
	$selisih=$tahun;
}
    return $selisih;
}

function umur2($tgl_lahir){
    $tgl=explode("/",$tgl_lahir);
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari=$cek_jmlhr1-$tgl['0'];
    $ssbln=12-$tgl['1']-1;
    $hari=0;
    $bulan=0;
    $tahun=0;
//hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+date('d')-$cek_jmlhr2;
    }else{
        $hari=$sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
        $bulan=($ssbln+date('m')+$bulan)-12;
        $tahun=date('Y')-$tgl['2'];
    }else{
        $bulan=($ssbln+date('m')+$bulan);
        $tahun=(date('Y')-$tgl['2'])-1;
    }
if($tahun==0){
      $selisih=$bulan." Bulan ".$hari." Hari";
}else if($tahun==0 AND $bulan==0){
	  $selisih=$hari." Hari";
}else{
	$selisih=$tahun." Tahun ";
}
    return $selisih;
}
function share2($tgl_masuk,$bln){
$tgl=explode("-",$tgl_masuk);
$timestart = strtotime($tgl[0]."-".$tgl[1]);
$timeEnd = strtotime($bln);
$numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timestart))*12;
$numBulan += date("m",$timeEnd)-date("m",$timestart);
if($tgl[2]==1){
$jumlah=$numBulan;
}else{
	$jumlah=$numBulan-1;
}
if($jumlah < 3){
	$share=30;
}else if($jumlah >= 3 AND $jumlah <= 15){
	$share =30;
}else if($jumlah > 15 AND $jumlah <= 27){
	$share=31;
}else if($jumlah > 27 AND $jumlah <= 39){
	$share=32;
}else if($jumlah > 39 AND $jumlah <= 51){
	$share=33;
}else if($jumlah > 52 AND $jumlah <= 64){
	$share=34;
}else{
	$share=35;
}
	 return $share;
}

function share($tgl_masuk){
$tgl=explode("-",$tgl_masuk);
$timestart = strtotime($tgl[0]."-".$tgl[1]);
$timeEnd = strtotime(date("Y-m"));
$numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timestart))*12;
$numBulan += date("m",$timeEnd)-date("m",$timestart);
if($tgl[2]==1){
$jumlah=$numBulan;
}else{
	$jumlah=$numBulan-1;
}
if($jumlah < 3){
	$share=30;
}else if($jumlah >= 3 AND $jumlah <= 15){
	$share =30;
}else if($jumlah > 15 AND $jumlah <= 27){
	$share=31;
}else if($jumlah > 27 AND $jumlah <= 39){
	$share=32;
}else if($jumlah > 39 AND $jumlah <= 51){
	$share=33;
}else if($jumlah > 52 AND $jumlah <= 64){
	$share=34;
}else{
	$share=35;
}
	 return $share;
}

?>
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/inc.library.php";
$pasien_id=$_POST['pasien_id'];
$kartu=$_POST['bpjs'];
$ktp=$_POST['ktp'];
$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$sql2="select PARAM_VALUE  FROM  RS_PARAM WHERE PARAM_CODE='KDFASKES' OR PARAM_CODE='VCLAIMURL' OR PARAM_CODE='VCLAIMSECRETKEY' OR PARAM_CODE='VCLAIMCONSID' ";
$stmt2 = sqlsrv_query($conn, $sql2 , $params, $options);
$vclaim = array();
$no=1;
while($dataku=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
	$vclaim[$no]=$dataku['PARAM_VALUE'];
	$no++;
}


$data    =  $vclaim[2]; //Ganti dengan consumerID dari BPJS
$secretKey = $vclaim[3]; //Ganti dengan consumerSecret dari BPJS
$link= $vclaim[4]; 

if($kartu !='') {
$url     = $link."Peserta/nokartu/"; //Lihat katalog, jangan sertakan port
$nik     = "$kartu/"; 
}else{
	$url     = $link."Peserta/nik/"; //Lihat katalog, jangan sertakan port
$nik     = "$ktp/"; 
}
$tgl_sep = "tglSEP/".date('Y-m-d'); 
date_default_timezone_set('UTC');
$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
$encodedSignature = base64_encode($signature);
$urlencodedSignature = urlencode($encodedSignature);
$opts = array(
 'http'=>array(
 'method'=>"GET",
 'header'=> "X-timestamp: ".$tStamp."\r\n".
 "X-signature: ".$encodedSignature."\r\n".
 "X-cons-id: ".$data."\r\n".
 "Content-Type: application/json; charset=utf-8"

 )
);
$context = stream_context_create($opts);
$result = file_get_contents($url.$nik.$tgl_sep, false, $context);

//echo "<br>Respon:";
if ($result === false) 
{ 
 echo "Tidak dapat menyambung ke server"; 
} else { 
 
    $resultarr = json_decode($result, true);
	$data= $resultarr['response']['peserta'];
 $params['kode_pesan']= $resultarr['metaData']['code'];
	 $params['pesan']= $resultarr['metaData']['message'];
$params['kode_ppk']=$vclaim[1]; 
$params['nik']=$data['nik'];
$params['hak_kelas']=$data['hakKelas']['keterangan'];
$params['status']=$data['statusPeserta']['keterangan'];
$params['nama']=$data['nama'];
$params['bpjs']=$data['noKartu'];
$params['jk']=$data['sex'];
$params['jnpeserta']=$data['jenisPeserta']['keterangan'];
$params['TMT']=$data['tglTMT'];
$params['rm']=$data['mr']['noMR'];
$params['kode_kelas']=$data['hakKelas']['kode'];
$params['tgl_lahir']=$data['tglLahir'];
$params['tgl_cetak_kartu']=$data['tglCetakKartu'];
$params['tgl_tat']=$data['tglTAT'];
$params['sktm']=$data['informasi']['noSKTM'];
$params['asuransi_cob']=$data['cob']['nmAsuransi'];
$params['ppk']=$data['provUmum']['nmProvider'];
$params['tat']=$data['tglTAT'];
 echo json_encode($params);
 
}

?>
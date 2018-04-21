<?php
function parsing($field){
	echo $resultarr['response']['peserta'][''.$field.''];
}
$data    = "22161"; //Ganti dengan consumerID dari BPJS
$secretKey = "9uMAFF0D37"; //Ganti dengan consumerSecret dari BPJS
$url       = "http://dvlp.bpjs-kesehatan.go.id:8081/VClaim-rest/Peserta/nik/"; //Lihat katalog, jangan sertakan port
$nik = "3404104101610002/"; 
$tgl_sep = "tglSEP/2018-03-07"; 
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
 echo $result; 
    $resultarr = json_decode($result, true);
	$data= $resultarr['response']['peserta'];


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
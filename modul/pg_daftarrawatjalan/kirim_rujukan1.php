<?php
$kartu="0000097452595";
$data      = "22161"; //Ganti dengan consumerID dari BPJS
$secretKey = "9uMAFF0D37"; //Ganti dengan consumerSecret dari BPJS
$url="http://dvlp.bpjs-kesehatan.go.id:8081/VClaim-rest/Rujukan/Peserta/";
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
$result = file_get_contents($url.$kartu, false, $context);

//echo "<br>Respon:";
if ($result === false) 
{ 
 echo "Tidak dapat menyambung ke server"; 
} else { 
 
    $resultarr = json_decode($result, true);

		 $params['kode_pesan']= $resultarr['metaData']['code'];
	 $params['pesan']= $resultarr['metaData']['message'];

	 $params['kode_pesan']= $resultarr['metaData']['code'];
	 $params['pesan']= $resultarr['metaData']['message'];
$data= $resultarr['response']['rujukan'];
$params['no_rujukan']=$data['noKunjungan'];
$params['diagnosa']=$data['diagnosa']['nama'];
$params['kode_diag']=$data['diagnosa']['kode'];
$params['kode_poli']=$data['poliRujukan']['kode'];
$params['nama_poli']=$data['poliRujukan']['nama'];
$params['tgl_kunjungan']=$data['tglKunjungan'];
$params['asal_rujuk']=$data['provPerujuk']['nama'];
$params['kode_asal']=$data['provPerujuk']['kode'];
$params['pelayanan']=$data['pelayanan']['nama'];
$params['kode_pelayanan']=$data['pelayanan']['kode'];
$params['hak_kelas']=$data['hakKelas']['keterangan'];
$params['kode_kelas']=$data['hakKelas']['kode'];


	
	 echo json_encode($params);
}


?>
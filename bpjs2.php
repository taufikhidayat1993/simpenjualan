<?php
$data = "20045"; //Ganti dengan consumerID dari BPJS
$secretKey = "2tX78C8ADD"; //Ganti dengan consumerSecret dari BPJS
$url = "http://192.168.1.169:8080/WsLokalRest/Rujukan/Peserta/";  //Lihat katalog
$nik = "0001270676979";  //ganti dengan NIK (nomor KTP)

date_default_timezone_set('UTC');
$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
$encodedSignature = base64_encode($signature);
$urlencodedSignature = urlencode($encodedSignature);
/*
echo "X-cons-id: " .$data ."<br>";
echo "X-timestamp:" .$tStamp ."<br>";
echo "X-signature: " .$encodedSignature."<br>";
*/
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

$result = file_get_contents($url.$nik, false, $context);
echo $result;


?>
<?php

	function tglku($tanggal) {
        $pisah = explode('-',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('/',$urutan);
        return $satukan;
    }
$data    = "20045"; //Ganti dengan consumerID dari BPJS
$secretKey = "2tX78C8ADD"; //Ganti dengan consumerSecret dari BPJS
$url       = "http://192.168.1.169:8080/WsLokalRest/Rujukan/Peserta/"; //Lihat katalog, jangan sertakan port
$nik = $_POST['ktp']."/"; 
$tanggal=$_POST['tanggal']; 
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
$result = file_get_contents($url.$nik.$tanggal, false, $context);

//echo "<br>Respon:";
if ($result === false) 
{ 
 echo "Tidak dapat menyambung ke server"; 
} else { 


    
 
    $resultarr = json_decode($result, true);
    $no_kunjungan= $resultarr['response']['item']['noKunjungan'];
	$no_induk= $resultarr['response']['item']['peserta']['nik'];
	$tgl_kunjungan= $resultarr['response']['item']['tglKunjungan'];
	if($no_kunjungan!=''){
  echo  '{"noKunjungan": "'.$no_kunjungan.'", "nik": "'.$no_induk.'","tgl_kunjungan":"'.tglku($tgl_kunjungan).'"}';
	}else{
		echo '{"noKunjungan":""}';
	}
    
 
}

?>

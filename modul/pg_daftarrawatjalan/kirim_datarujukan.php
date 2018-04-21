<?php
include"../../inc/inc.koneksi.php";
include"../../inc/inc.library.php";
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
$kartu  =$_POST['no_kartu'];
$data      = $vclaim[2]; //Ganti dengan consumerID dari BPJS
$secretKey = $vclaim[3];  //Ganti dengan consumerSecret dari BPJS
$kode_faskes = $vclaim[1];
function CekRujukan($url,$kartu,$data,$secretKey,$kode_faskes){
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
	if($resultarr['metaData']['code']!=200) {
		CekRujukanRumahsakit("http://dvlp.bpjs-kesehatan.go.id:8081/VClaim-rest/Rujukan/RS/Peserta/",$kartu,$data,$secretKey,$kode_faskes);
	}else{
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
$params['faskes']=1;
 echo json_encode($params);
	}
	
}
}

function  CekRujukanRumahsakit($url,$kartu,$data,$secretKey,$kode_faskes){
	
$tanggal_sekarang=date('Y-m-d');
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
	 $data= $resultarr['response']['rujukan'];

	if ($resultarr['metaData']['code']!=200){
		$params['no_rujukan']="001";
		$params['kode_asal']="".$kode_faskes."";
		$params['asal_rujuk']="RSIY PDHI";
		$params['tgl_kunjungan']=$tanggal_sekarang;
		$params['faskes']=2;
	}else{
			$params['no_rujukan']=$data['noKunjungan'];
			$params['kode_asal']=$data['provPerujuk']['kode'];
			$params['asal_rujuk']=$data['provPerujuk']['nama'];
			$params['tgl_kunjungan']=$data['tglKunjungan'];
				$params['faskes']=1;
	}

$params['asal_rujukan']="2";
$params['diagnosa']=$data['diagnosa']['nama'];
$params['kode_diag']=$data['diagnosa']['kode'];
$params['kode_poli']=$data['poliRujukan']['kode'];
$params['nama_poli']=$data['poliRujukan']['nama'];



$params['pelayanan']=$data['pelayanan']['nama'];
$params['kode_pelayanan']=$data['pelayanan']['kode'];
$params['hak_kelas']=$data['hakKelas']['keterangan'];
$params['kode_kelas']=$data['hakKelas']['kode'];

 
	}
echo json_encode($params);
}
echo CekRujukan("http://dvlp.bpjs-kesehatan.go.id:8081/VClaim-rest/Rujukan/Peserta/",$kartu,$data,$secretKey,$kode_faskes);
	



?>
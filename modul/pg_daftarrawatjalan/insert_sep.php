<?php
include"../../inc/inc.koneksi2.php";
session_start();
            $no_rujukan = $_POST['no_rujukan'];
			$diag_awal = $_POST['diag_awal'];
			$no_kartu = $_POST['no_kartu'];
			$jenis_pelayanan = $_POST['jenis_pelayanan'];
            $tgl_rujukan = $_POST['tgl_rujukan'];
			$no_rm = $_POST['no_rm'];
			$kelas_rawat = $_POST['kelas_rawat'];
			$jenis_perawatan = $_POST['jenis_perawatan'];
			$faskes = $_POST['faskes'];
			$asal_rujukan = $_POST['asal_rujukan'];
			$poli = $_POST['poli'];
			$kode_faskes = $_POST['kode_faskes'];
			$tgl_sep = $_POST['tgl_sep'];
            $catatan =  $_POST['catatan'];
				$pesertacob = $_POST['peserta_cob'];
				
			$time = date("H:i:s");
			$nama_pasien = $_POST['nama_pasien'];
			$tgl_lahir =$_POST['tgl_lahir'];
			$kelamin = $_POST['kelamin'];
			$nama_diagnosa = $_POST['nama_diagnosa'];
			$nama_asalrujuk  = $_POST['nama_asalrujuk'];
			$peserta = $_POST['peserta'];
			$poli_rs = $_POST['poli_rs'];
			$lakalantas=$_POST['lakalantas'];
			$lokasilaka=$_POST['lokasilaka'];
			$medis_id = $_POST['medis_id'];
			
		
			if($jenis_perawatan == 1 ){
				$rawat="Rawat Inap";
			    $RW="RI";
				$table="RS_PASIEN_OPNAME";
				$trx_id="OPNAME_ID";
			}else{
				$rawat="Rawat Jalan";
				$RW="RJ";
				$table="RS_PASIEN_MEDIS";
				$trx_id="MEDIS_ID";
			}
			
			$params1 = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$sql2="select PARAM_VALUE  FROM  RS_PARAM WHERE PARAM_CODE='KDFASKES' OR PARAM_CODE='VCLAIMURL' OR PARAM_CODE='VCLAIMSECRETKEY' OR PARAM_CODE='VCLAIMCONSID' ";
$stmt2 = sqlsrv_query($conn, $sql2 , $params1, $options);
$vclaim = array();
$no=1;
while($dataku=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
	$vclaim[$no]=$dataku['PARAM_VALUE'];
	$no++;
}
	$dataid    = $vclaim[2]; 
    $secretKey = $vclaim[3]; 
    $localIP   = $vclaim[4];
    $url       = $vclaim[4]."SEP/insert";
    $port      = 8081; 

    date_default_timezone_set('UTC');
    $tStamp              = strval(time() - strtotime('1970-01-01 00:00:00'));
    $signature           = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
    $encodedSignature    = base64_encode($signature);
    $urlencodedSignature = urlencode($encodedSignature);


    function post_request($url, $port, $dataid, $tStamp, $encodedSignature, $data, $referer = '')
    {

        //-Convert the data array into URL Parameters like a=b&foo=bar etc.
        //$data = http_build_query($data);

        // parse the given URL
        $url = parse_url($url);

        if ($url['scheme'] != 'http') {
            die('Error: Only HTTP request are supported !');
        }

        // extract host and path:
        $host = $url['host'];
        $path = $url['path'];

        // open a socket connection on port 80 - timeout: 50 sec
        $fp = fsockopen($host, $port, $errno, $errstr, 50);

        if ($fp) {

            // send the request headers:
            fputs($fp, "POST $path HTTP/1.1\r\n");
            fputs($fp, "Host: $host\r\n");

            if ($referer != '')
                fputs($fp, "Referer: $referer\r\n");

            fputs($fp, "x-cons-id: " . $dataid . "\r\n");
            fputs($fp, "x-timestamp: " . $tStamp . "\r\n");
            fputs($fp, "x-signature: " . $encodedSignature . "\r\n");
            fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: " . strlen($data) . "\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $data);

            $result = '';
            while (!feof($fp)) {
                // receive the results of the request, 128 char
                $result .= fgets($fp, 128);
            }
        } else {
            return array(
                'status' => 'err',
                'error' => "$errstr ($errno)"
            );
        }

        // close the socket connection:
        fclose($fp);

        // split the result header from the content
        $result = explode("\r\n\r\n", $result, 2);
        $header  = isset($result[0]) ? $result[0] : '';
        $content = isset($result[1]) ? $result[1] : '';

        // return as structured array:
        return array(
            'status' => 'ok',
            'header' => $header,
            'content' => $content
        );

    }
    $databpjs = '                                            
        {
           "request": {
              "t_sep": {
                 "noKartu": "'.$no_kartu.'",
                 "tglSep": "'.$tgl_sep.'",
                 "ppkPelayanan": "'.$kode_faskes.'",
                 "jnsPelayanan": "'.$jenis_pelayanan.'",
                 "klsRawat": "'.$kelas_rawat.'",
                 "noMR": "'.$no_rm.'",
                 "rujukan": {
                    "asalRujukan": "'.$faskes.'",
                    "tglRujukan": "'.$tgl_rujukan.'",
                    "noRujukan": "'.$no_rujukan.'",
                    "ppkRujukan": "'.$asal_rujukan.'"
                 },
                 "catatan": "'.$catatan.'",
                 "diagAwal": "'.$diag_awal.'",
                 "poli": {
                    "tujuan": "'.$poli.'",
                    "eksekutif": "0"
                 },
                 "cob": {
                    "cob": "'.$pesertacob.'"
                 },
                 "jaminan": {
                    "lakaLantas": "'.$lakalantas.'",
                    "penjamin": "1",
                    "lokasiLaka": "'.$lokasilaka.'"
                 },
                 "noTelp": "08988999",
                 "user": "'.$_SESSION['nama'].'"
              }
           }
        }         ';

/*
    $databpjs = '{
                "request":
                 {
                "t_sep":
                    {
                        "noKartu":"0001035707387",
                        "tglSep":"2018-02-24",
                        "noRujukan":"120217010218Y000572",
                        "catatan":"test"
                    }
                 }
            }';
*/
    $data = array(
        'Data' => $databpjs
    );

    $result = post_request($url, $port, $dataid, $tStamp, $encodedSignature, $databpjs, $referer = '');
    if ($result['status'] == 'ok') {

        //mengubah "re d sponse" menjadi "response"
        $resultstr = str_replace("response", "response", trim(preg_replace('/\s\s+/', ' ', $result['content'])));

        // print the result of the whole request:
       $resule = json_decode($resultstr, true);
	   
	
	$data= $resule['response']['sep'];
	 $params['kode_pesan']= $resule['metaData']['code'];
	 $params['pesan']= $resule['metaData']['message'];


	  
	  
		  $sql="INSERT INTO RS_SEP (
	NO_SEP,
	TRX_ID,
	TGL_SEP,
	NO_KARTU,
	NAMA,
	TGL_LAHIR,
	JK,
	POLI,
	ASAL_FASKES,
	DIAGNOSA,
	CATATAN,
	PESERTA,
	COB,
	JENIS_RAWAT,
	KELAS_RAWAT,
	CETAKAN,
	RAWAT,
	NO_RM
)
VALUES
	(
		'".$data['noSep']."',
		'".$medis_id."',
		'".$tgl_sep." ".$time."',
		'".$no_kartu."',
		'".$nama_pasien."',
		'".$tgl_lahir."',
		'".$kelamin."',
		'".$poli_rs."',
		'".$nama_asalrujuk."',
		'".$nama_diagnosa."',
		'".$catatan."',
		'".$peserta."',
		'".$pesertacob."',
		'".$rawat."',
		'".$kelas_rawat."',0,'".$RW."','".$no_rm."')";
	  
	  //$update="update ".$table." set NORUJUKAN = '".$no_rujukan."' WHERE ".$trx_id." = '".$medis_id."'";

	  if ($resule['metaData']['code'] == 200){
		  
		 sqlsrv_query($conn,$sql);
		 	// sqlsrv_query($update,$sql);
	  }else{
		$resulan= $resule['metaData']['message'];
  $kalimat="3.2";

		  if(preg_match("/".$kalimat."/i", $resulan)) {
$datas= explode(" ",$resulan);
   $params['pesan_sep']=$datas[18];
		  }
	  }

	   $params['no_sep']=$data['noSep'];
	   
 echo json_encode($params);
  
    } else {
        echo 'A error occured: ' . $result['error'];
    } ?>  
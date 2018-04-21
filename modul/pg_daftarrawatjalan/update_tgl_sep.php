<?php
            $no_sep= $_POST['no_sep'];
			$tgl_pulang = $_POST['tgl_pulang'];
	
    
	$dataid    = "22161"; 
    $secretKey = "9uMAFF0D37"; 
    $localIP   = "dvlp.bpjs-kesehatan.go.id";
    $url       = "http://".$localIP."/VClaim-rest/Sep/updtglplg";
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
            fputs($fp, "PUT $path HTTP/1.1\r\n");
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
            "request": 
                {    
                "t_sep":
                    {
                        "noSep":"'.$no_sep.'",
                        "tglPulang":"'.$tgl_pulang.'",
                        "user":"RSIY PDHI"
                    }
                }
        }        ';

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
	   
	
	
	 $params['kode_pesan']= $resule['metaData']['code'];
	 $params['pesan']= $resule['metaData']['message'];

      $params['no_sep']=$resule['response'];
 echo json_encode($params);
  
    } else {
        echo 'A error occured: ' . $result['error'];
    } ?>  
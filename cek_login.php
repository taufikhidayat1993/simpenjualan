<?php

include "inc/inc.koneksi.php";
include "inc/library.php";
$username	= $_POST['username'];
$password	= strtoupper(md5($_POST['password']));
$sql=("
SELECT user_id, group_id,dr_id, user_name,default_poli, md5
FROM
rs.RS_USER WHERE user_id='$username' AND md5='$password' AND LOCK_STATUS=0
");

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query($conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows($stmt1);
	if ($row_count > 0){
		session_start();
		  include "timeout.php";
							$sql1=("UPDATE RS_USER SET LOGIN_STATUS='1',
							LAST_LOGIN='$tgl_sekarang2 $jam_sekarang'
							WHERE USER_ID='$username'");
$stmt=sqlsrv_query($conn,$sql1);
$params = array();
sqlsrv_query($conn,$sql,$params);

	  	$r = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
		
		$_SESSION['username']     = $r['user_id'];
		$_SESSION['password']     = $r['md5'];
		$_SESSION['nama']     	= $r['user_name'];
		$_SESSION['level']     	= $r['group_id'];
		$_SESSION['dokter'] = $r['dr_id'];
		$_SESSION['polid'] = $r['default_poli'];
		
		  $_SESSION[login] = 1;
  timer();

	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();
        echo $row_count.",".$r['group_id'];
	}else{
	
		    if(isset($_SESSION['auth']))
            {
                //jika user gagal masuk selama 3 kali atau lebih
                if($_SESSION['auth']>3 || $_SESSION['auth']==3){
                        //set nilai session "auth" ke 4
                        $_SESSION['auth']=4;
                        //jalankan function blokir_user
						$sql=("
UPDATE RS_USER
                  SET LOCK_STATUS='1'
                   WHERE USER_ID='$_POST[username]'
");
$stmt=sqlsrv_query($conn,$sql);
$params = array();
sqlsrv_query($conn,$sql,$params);

                     echo   $_SESSION['auth'];
                }
                //jika tidak
                else{
                        //session "auth" ditambah 1
                        $_SESSION['auth']=$_SESSION['auth']+1;
                        //jalankan function login()
                  echo  $_SESSION['auth'];
                }
            }
            //jika tidak ada session "auth"
            else{
                    //daftarkan session "auth", dan beri nilai 1
                    $_SESSION['auth']=1;
                    //jalankan function login()
					  echo $row_count;
                
            }
			

	}

?>

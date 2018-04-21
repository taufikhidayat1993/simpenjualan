<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";

$op=$_GET['op'];
$opsi = $_POST['opsi'];
if($op == 'dokter'){
if($opsi == 0){
echo "<option value=''>Pilih Dokter</option>";
$sql="SELECT
rs.RS_DOKTER.DR_ID,
rs.RS_DOKTER.NAME,
rs.RS_DOKTER.POLI_ID
FROM
rs.RS_DOKTER where AKTIF=1
 ORDER BY
rs.RS_DOKTER.NAME ASC ";
$stmt=sqlsrv_query($conn,$sql);
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	                  $poli_id=$data["POLI_ID"];
                    $dokterid=$data["DR_ID"];
                      $nama_dokter=$data["NAME"];
					  echo"<option value='$dokterid'>$nama_dokter</option>";
					  }
											
}else{
	echo "<option value=''>Pilih Perawat</option>";	
$sql="SELECT
PERAWAT_ID,
NAME
FROM
RS_PERAWAT";
$stmt=sqlsrv_query($conn,$sql);
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	                  $poli_id=$data["POLI_ID"];
                    $dokterid=$data["DR_ID"];
                      $nama_dokter=$data["NAME"];
					  echo"<option value='".$data['PERAWAT_ID']."'>".$data['NAME']."</option>";
					  }
}
}if($op == 'tindakan'){
	$opsidata=$_POST['opsidata'];
	if($opsi == 0 and $opsidata == 0 ){
	$sql="SELECT
TINDAKAN_ID AS ID,
NAME,
HARGA
FROM
RS_TINDAKAN WHERE TINDAKAN_MODE=0  ORDER BY NAME ASC";
	}else if(($opsi == 0 OR $opsi == 1) and $opsidata==1){
		$sql="SELECT
OPERASI_ID AS ID,
NAME,
HARGA
FROM
RS_OPERASI ORDER BY NAME ASC";		
	}else if(($opsi == 0 OR $opsi == 1) and $opsidata==2){
		$sql="SELECT
PERSALINAN_ID AS ID,
NAME,
HARGA
FROM
RS_PERSALINAN ORDER BY NAME ASC";
	}else{
			$sql="SELECT
TINDAKAN_ID,
NAME,
HARGA
FROM
RS_TINDAKAN WHERE TINDAKAN_MODE=1 ORDER BY NAME ASC";
	}
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	                  $tindakan_id=$data["ID"];
                      $name=$data["NAME"];
					  $harga=$data['HARGA'];
					  echo"<option value='".$tindakan_id."|".$harga."'>".$name."</option>";
					  }
	
}
?>
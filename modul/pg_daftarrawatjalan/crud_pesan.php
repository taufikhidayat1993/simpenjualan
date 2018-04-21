
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$op=$_GET['op'];
if($op=='hapuspesan'){
	$id=$_POST['id'];
	$sql="delete from rs_pesan_kontrol where id = $id";
	$stmt1 = sqlsrv_query( $conn, $sql , $params);
}if($op=='simpan_skdp'){
	$jam=$_POST['jam'];
	$tanggal=$_POST['tanggal']." ".$jam;
	$time=tgl_time($tanggal);
	$diagnosa=$_POST['diagnosa'];
	$terapi=$_POST['terapi'];
	$tgl_rujuk=ubahformatTgl($_POST['tgl_rujuk']);
	$anjuran=$_POST['anjuran'];
	$poli=$_POST['poli'];
	$medis_id=$_POST['medis_id'];
	$dokter=$_POST['dokter'];
    $pisah = explode('|',$_POST['poli']);
	$ket=$_POST['ket'];
	$sq="SELECT * FROM rs_pesan_kontrol WHERE OPNAME_ID='".$medis_id."' AND CONVERT(VARCHAR(11),TGL,103)='".$_POST['tanggal']."' and KLINIK ='".$pisah[1]."' and DOKTER='".$dokter."'";
	$data=sqlsrv_query($conn,$sq,$params,$options);
	$row=sqlsrv_num_rows($data);
	if($row == 0){
	 $sql = "INSERT INTO rs_pesan_kontrol (
	opname_id,
	tgl,
	klinik,
	dokter,
	send,
	uji_kepuasan,
	keterangan,
	TGL_PULANG,
	DIAGNOSA,
	TERAPI,
	ANJURAN,
	POLI_ID,
	DR_ID,
	MEDIS_ID,
	KET
)
VALUES
	(   '$medis_id',
		'$time',
		'$pisah[1]',
		'$dokter',
		'no',
		'no',
		'',
		'$tgl_rujuk',
		'$diagnosa',
		'$terapi',
		'$anjuran',
		'$pisah[1]',
		'$dokter',
		'$medis_id',
		'$ket'
	)";
sqlsrv_query($conn,$sql,$params,$options);
	}else{
		echo 1;
	}

}
?>
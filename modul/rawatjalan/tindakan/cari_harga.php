<?php
session_start();
include '../../../inc/inc.koneksi.php';
include "../../../inc/fungsi_tanggal.php";

$IDtindakan='B20142';
$IDdokter='MD0916746';
$IDmedis=('111200007729201702171712');
// $IDtindakan=$_POST['IDtindakan'];
// $IDdokter=$_POST['IDdokter'];
// $IDmedis= $_SESSION['MEDIS_ID'];
//--------cari ID poli dan ID spesialis
if($IDdokter==''){
$sql1="SELECT
	P.POLI_ID,
	Q.SPESIAL_ID
FROM
	rs.RS_PASIEN_MEDIS P
LEFT JOIN rs.RS_DR_SPESIALISASI Q ON P.DR_ID=Q.DR_ID
WHERE
	P.MEDIS_ID = '$IDmedis'";
$params1 = array();
$options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql1 , $params1, $options1 );
$row_count1 = sqlsrv_num_rows( $stmt1 );

if ($row_count1>0){
while ($data1=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){


	$data['IDpoli']= $data1['POLI_ID'];
	$data['IDspesialis']= $data1['SPESIAL_ID'];


		//echo json_encode($data);
	}}
}else{
	$sql2="SELECT
		P.POLI_ID,
		Q.SPESIAL_ID
	FROM
		rs.RS_PASIEN_MEDIS P
	LEFT JOIN rs.RS_DR_SPESIALISASI Q ON Q.DR_ID='$IDdokter'
	WHERE
		P.MEDIS_ID = '$IDmedis'";
	$params2 = array();
	$options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt2 = sqlsrv_query( $conn, $sql2 , $params2, $options2 );
	$row_count2 = sqlsrv_num_rows( $stmt2 );

	if ($row_count2>0){
	while ($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){


		$data['IDpoli']= $data2['POLI_ID'];
		$data['IDspesialis']= $data2['SPESIAL_ID'];


			//echo json_encode($data);
		}}
}


// if($data['IDpoli'] != NULL){
//   $IDpoli['IDpoli']=$data['IDpoli'];
// 	echo json_encode($IDpoli);
// }
// if($data['IDspesialis'] != NULL){
// 	  $IDspesialis['IDspesialis']=$data['IDspesialis'];
// 	echo json_encode($IDspesialis);
// }
//-----------------cari harga----
if($data['IDpoli'] =='PO00'){
	if($data['IDspesialis'] == NULL){
		$sql="SELECT P.TARIF_POLI1_DRU as harga FROM rs.RS_TINDAKAN P WHERE P.TINDAKAN_ID='$IDtindakan'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$row_count = sqlsrv_num_rows( $stmt );
		$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

		$data['harga']=$data['harga'];
			echo json_encode($data);
	}else{
		$sql="SELECT P.TARIF_POLI1_DRS as harga FROM rs.RS_TINDAKAN P WHERE P.TINDAKAN_ID='$IDtindakan'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$row_count = sqlsrv_num_rows( $stmt );
		$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

		$data['harga']= $data['harga'];
			echo json_encode($data);

	}

}elseif($data['IDpoli'] == 'PO01'){
	if($data['IDspesialis'] == NULL){
		$sql="SELECT P.TARIF_POLI2_DRU as harga FROM rs.RS_TINDAKAN P WHERE P.TINDAKAN_ID='$IDtindakan'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$row_count = sqlsrv_num_rows( $stmt );
		$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

		$data['harga']= $data['harga'];
			echo json_encode($data);

	}else{
		$sql="SELECT P.TARIF_POLI2_DRS as harga FROM rs.RS_TINDAKAN P WHERE P.TINDAKAN_ID='$IDtindakan'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$row_count = sqlsrv_num_rows( $stmt );
		$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

		$data['harga']= $data['harga'];
			echo json_encode($data);
	}
}else{
		$sql="SELECT P.TARIF_POLI2_DRS as harga FROM rs.RS_TINDAKAN P WHERE P.TINDAKAN_ID='$IDtindakan'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$row_count = sqlsrv_num_rows( $stmt );
		$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

		$data['harga']= $data['harga'];
			echo json_encode($data);

}

 ?>

<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$op=$_GET['op'];
if($op=='poli'){
$poli_id=$_POST['poli_id'];
$sql="select POLI_ID,NAME from RS_POLIKLINIK ";
$query = sqlsrv_query($conn,$sql,$params,$options);
  while($data=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
    $sql1="select POLI_ID,NAME from RS_POLIKLINIK where POLI_ID ='$poli_id'";
    $query1 = sqlsrv_query($conn,$sql1,$params,$options);
    $dataku=sqlsrv_fetch_array($query1,SQLSRV_FETCH_ASSOC);
	if($dataku['POLI_ID']== $data['POLI_ID']){
	echo"<option value='".$data['POLI_ID']."|".$data['NAME']."' selected>".$data['NAME']."</option>";
	}else{
	echo"<option value='".$data['POLI_ID']."|".$data['NAME']."' >".$data['NAME']."</option>";
	}
  }	
}if($op=='dokter'){
	$dokter_id=$_POST['dokter_id'];
	$pisah=explode("|",$_POST['poli_id']);
$sql="select DR_ID,NAME from RS_DOKTER ";
if($pisah[0]!=''){
	$sql.="where POLI_ID= '".$pisah[0]."'";
}

$query = sqlsrv_query($conn,$sql,$params,$options);
  while($data=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
    $sql1="select DR_ID,NAME from RS_DOKTER where DR_ID ='$dokter_id'";
    $query1 = sqlsrv_query($conn,$sql1,$params,$options);
    $dataku=sqlsrv_fetch_array($query1,SQLSRV_FETCH_ASSOC);
	if($dataku['DR_ID'] == $data['DR_ID']){
	echo"<option value='".$data['NAME']."' selected>".$data['NAME']."</option>";
	}else{
	echo"<option value='".$data['NAME']."' >".$data['NAME']."</option>";
	}
  }	
	
}
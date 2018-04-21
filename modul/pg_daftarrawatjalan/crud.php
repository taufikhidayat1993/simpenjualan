
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
include"../../inc/label.php";


session_start();
include"../../inc/fungsi_indotgl.php";
$op=$_GET['op'];

if($op=='detailpoli'){
	$tanggal=$_POST['tangga'];
	$poli=$_POST['poli'];
	if($tanggal==''){
$sql="SELECT DISTINCT
	T.NAME AS nama,
	P.DR_ID AS kode 
FROM
	rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE P.POLI_ID='$poli' AND
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,103) ='$tgl_sekarang1' 
AND P.STATUS_BAYAR = 0";
	}else{
		$sql="
		SELECT DISTINCT
	T.NAME AS nama,
	P.DR_ID AS kode 
FROM
	rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE P.POLI_ID='$poli' AND
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,103) ='$tanggal' 
AND P.STATUS_BAYAR = 0";
	}
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query($conn, $sql , $params, $options);
ECHO"<option value=''>SEMUA DOKTER</option>";
                                    while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){									
											echo"<option value='$data[kode]' selected>$data[nama]</option>";	
									}
}


else if($op=='reresep'){
	$resep=$_POST['resep'];
	$catatan=$_POST['catatan'];
	$jumlah=$_POST['jumlah'];
	$aturan_pakai=$_POST['aturan_pakai'];
	$nama_obat=$_POST['nama_obat'];
		$data_resep=trim($resep);
	if($resep==''){
	$data_resep="R/".$nama_obat.", Jumlah : $jumlah \n                $aturan_pakai,$catatan \n--------------------------------------------\n";
	}else{
	$data_resep=$data_resep."\nR/ ".$nama_obat.", Jumlah : $jumlah \n                $aturan_pakai,$catatan \n--------------------------------------------\n";
	}
	echo ltrim($data_resep);

	
}else if($op=='editrajal'){
	$tanggal=$_POST['tanggal'];
	$jam=$_POST['jam'];
	$poli_lama="$_POST[poli_lama]";
	$dokter_lama="$_POST[dokter_lama]";
	$tgl_rujukan=$_POST['tgl_rujuk'];
	$dokter="$_POST[dokter]";
	$poli="$_POST[poli]";
	$tgl="$_POST[tanggal]";
	$tgl_lama="$_POST[tgl_lama]";
	$no_ktp ="$_POST[no_ktp]";
	$ktp_lama="$_POST[ktp_lama]";
	$no_asuransi="$_POST[no_asuransi]";
	$asuransi_lama="$_POST[ktp_lama]";
	$pasien_id=$_POST['pasien_id'];
if($dokter_lama != $dokter OR $poli_lama != $poli OR $tgl != $tgl_lama ) {
	$sql="UPDATE RS_PASIEN_MEDIS 
	SET DR_ID='$_POST[dokter]',               
    DATETIME_MEDIS='".$tanggal." ".$jam."',
    NOTE='$_POST[catatan]',
	DIAGNOSA='$_POST[assesment]',
    NORUJUKAN='$_POST[no_rujukan]',
	POLI_ID='$_POST[poli]'
    ,MODIBY='$_SESSION[nama]'
	,MODIDATE='$time',
	TGLRUJUKAN = '$tgl_rujukan',
	ANTRIAN=RS.FN_GET_ANTRIAN_AKHIR('".$_POST['poli']."','".$_POST['dokter']."','".$tanggal." ".$jam."')
	WHERE MEDIS_ID='$_POST[id]'";
	}else{
	$sql="UPDATE RS_PASIEN_MEDIS 
	SET DR_ID='$_POST[dokter]',               
    DATETIME_MEDIS='$dt_medis',
    NOTE='$_POST[catatan]',
	DIAGNOSA='$_POST[assesment]',
    NORUJUKAN='$_POST[no_rujukan]',
	POLI_ID='$_POST[poli]'
    ,MODIBY='$_SESSION[nama]'
	,MODIDATE='$time',
	TGLRUJUKAN = '',
	WHERE MEDIS_ID='$_POST[id]'";
	}
	$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
sqlsrv_query( $conn, $sql , $params, $options );

if($no_asuransi != $asuransi_lama ) {
	$update1="UPDATE RS.RS_PASIEN SET ASURANSI_POLIS = '".$no_asuransi."' where PASIEN_ID = '".$pasien_id."'";
	sqlsrv_query( $conn, $update1 , $params, $options );
}
if($no_ktp != $ktp_lama ) {
	$update2="UPDATE RS.RS_PASIEN SET EMAIL = '".$no_ktp."' where PASIEN_ID = '".$pasien_id."'";
		sqlsrv_query( $conn, $update2 , $params, $options );
}


	$sql2="SELECT
rs.RS_PASIEN_MEDIS.DR_ID,
rs.RS_POLIKLINIK.NAME AS POLI_NAME,
rs.RS_DOKTER.DR_ID,
rs.RS_DOKTER.NAME AS DR_NAME,
rs.RS_PASIEN_MEDIS.ANTRIAN,
rs.RS_PASIEN.NAME,
rs.RS_PASIEN_MEDIS.PASIEN_ID,
rs.RS_PASIEN.PASIEN_ID,
rs.RS_PASIEN.NAME AS PASIEN_NAME

FROM
rs.RS_PASIEN_MEDIS
INNER JOIN rs.RS_POLIKLINIK ON rs.RS_PASIEN_MEDIS.POLI_ID = rs.RS_POLIKLINIK.POLI_ID
INNER JOIN rs.RS_DOKTER ON rs.RS_DOKTER.DR_ID = rs.RS_PASIEN_MEDIS.DR_ID
INNER JOIN rs.RS_PASIEN ON rs.RS_PASIEN.PASIEN_ID = rs.RS_PASIEN_MEDIS.PASIEN_ID
 WHERE rs.RS_PASIEN_MEDIS.MEDIS_ID='$_POST[id]'";
	$query=sqlsrv_query($conn,$sql2,$params,$options);
	$data=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	
	echo "Pasien Denganh Nama ".$data['PASIEN_NAME']." Mendapat Nomor Antrian ".$data['ANTRIAN'];
}
else if($op=='get_poli'){
$tanggal=$_POST['tanggal'];
if($tanggal==''){
	$sql="	SELECT DISTINCT
	S.NAME AS nama,
	S.POLI_ID AS kode 

FROM
	rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID

WHERE
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,103) ='$tgl_sekarang1' 
AND P.STATUS_BAYAR = 0";
}else{
	$sql="	SELECT DISTINCT
	S.NAME AS nama,
	S.POLI_ID AS kode 

FROM
	rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID

WHERE
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,103) ='$tanggal' 
AND P.STATUS_BAYAR = 0";
}
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
ECHO"  <option value=''>--PILIH POLI--</option>";
 while($data=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){	 
	                 echo"					
					 <option value='$data[kode]'>$data[nama]</option>";
					  }
}
else if($op=='tampilpasien'){	
error_reporting(0);
$form_tanggal=ymd($_POST['form_tanggal']);	
if($_POST['tanggal']!=''){
$tanggal=$_POST['tanggal'];
}	else{
	$tanggal=$_POST['tanggal'];
}	
$poli=$_POST['poli'];	
$dokter=$_POST['dokter'];
$cari=$_POST['cari'];
$input_cari=$_POST['input_cari'];
$sql="SELECT 
P.MEDIS_ID,
P.PASIEN_ID,
Q.NO_RM,
Q.NAME,
Q.ALERGI,
Q.EMAIL,
Q.ASURANSI_POLIS,
LOWER(Q.ADDRESS) AS ADDRESS,
asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM' WHEN 3 THEN R.NAME END,
CONVERT(VARCHAR(10),P.DATETIME_MEDIS,120) AS DATE_MEDIS,
CONVERT(VARCHAR(8),P.DATETIME_MEDIS,108) AS TIME_MEDIS,
CONVERT(VARCHAR(10),Q.TGL_DAFTAR,120) AS TGL_DAFTAR,
S.NAME AS POLI_NAME,
P.ANTRIAN,
P.RUJUKAN_DATA_ID,
P.RUJUKAN_ID,
P.NORUJUKAN,
T.NAME AS nama_dokter,
T.DR_ID,
Q.GENDER,
R.NAME AS NAMA_AS,
gender=CASE Q.GENDER WHEN 1 THEN 'L' WHEN 2 THEN 'P' END
FROM
rs.RS_PASIEN_MEDIS AS P
LEFT JOIN rs.RS_PASIEN AS Q ON P.PASIEN_ID = Q.PASIEN_ID
LEFT JOIN rs.RS_ASURANSI AS R ON Q.ASURANSI_ID = R.ASURANSI_ID
LEFT JOIN rs.RS_POLIKLINIK AS S ON P.POLI_ID = S.POLI_ID
LEFT JOIN rs.RS_DOKTER AS T ON P.DR_ID = T.DR_ID
WHERE
P.PASIEN_ID = Q.PASIEN_ID AND
P.STATUS_BAYAR = '0' ";
if($tanggal==1){
 $sql.="AND CONVERT(VARCHAR(11),P.DATETIME_MEDIS,120) ='$form_tanggal'";
}
if($cari==1){
	 $sql.="AND Q.NO_RM LIKE '%$input_cari%'";
}else if($cari==2){
	 $sql.="AND P.PASIEN_ID LIKE '%$input_cari%'";
}else if($cari==3){
	 $sql.="AND Q.NAME LIKE '%$input_cari%'";
}else if($cari==3){
	 $sql.="AND Q.ADDRESS LIKE '%$input_cari%'";
}
if($dokter!=''){
	$sql.="AND P.DR_ID ='$dokter'";
}
if($poli!=''){
	$sql.="AND P.POLI_ID ='$poli'";
}

$sql.="ORDER  By P.ANTRIAN DESC";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );
$no=1;

 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                                        $sex=$data["GENDER"];
                                        $rujukan=$data["RUJUKAN_DATA_ID"];
                                        $PASIEN_ID=$data["PASIEN_ID"];
										
			$sql1="SELECT 	rs.FN_CHECK_DATA_PASIEN_KOSONG('$data[PASIEN_ID]') AS DATA";
$params1 = array();
$options1 = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );			
$stmt1 = sqlsrv_query( $conn, $sql1, $params1, $options1 );	
$dataku=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
if($dataku['DATA']!=''){
	$hasil="active";
}else{
	$hasil="";
}	
if($data['NAMA_AS']==''){
$nama_as="UMUM";
}else{
$nama_as=$data['NAMA_AS'];
}	
if($data['RUJUKAN_ID']=='RJ06'){
	$col1 ='yellow';
}else if($data['RUJUKAN_ID']=='RJ07') {
	$col2 ='#FF8000';
}else if($data['RUJUKAN_ID']=='RJ08') {
	$col1 ='#FF80FF';
}else{
	$col1 ='white';
	
}
if($tgl_sekarang2 == "$data[TGL_DAFTAR]"){
	$border='style="border-left:20px solid #00FF00; "';
}else{
	$border='';
}
	
	if ($data['ALERGI']!=''){
			$alergi='red'; 
			$font='color:white';
			}else{
				$alergi=''; 
			$font='';
			}
										echo"<tr style='cursor:pointer;' onclick='GetMedisId(\"".$data['MEDIS_ID']."\",\"".$data['PASIEN_ID']."\",\"".$data['DATE_MEDIS']."\",\"".$data['ASURANSI_POLIS']."\",\"".$data['EMAIL']."\",\"".$data['NORUJUKAN']."\",\"".$data['NO_RM']."\",\"".$data['DR_ID']."\",\"".$data['NAME']."\")'>								
										<td class='$hasil' $border>
										<span data-toggle='modal' onclick='GetUbahPasien(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;'  >$data[NO_RM]</span></td>
										<td style='cursor:pointer;background-color:$alergi;$font;width:100px;' ";  echo"><span data-toggle='modal' onclick='GetAlergi(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;' >$data[NAME]</span></td>
										<td style='width:150px;' >$data[ADDRESS]</td>
										<td >".$nama_as."</td>
										<td ><span data-toggle='modal' onclick='GetUbah(\"".$data['MEDIS_ID']."\")' style='cursor:pointer;	' >$data[DATE_MEDIS]</span></td>
										<td>$data[POLI_NAME]</td>
										<td>$data[nama_dokter]</td><td style='padding-left:14px;'>$data[ANTRIAN]</td>
										<td style='background-color:$col1;'>$data[NORUJUKAN]</td></tr>";
										$no++;
 }

 echo'<tr><td colspan="10">
 <script type="TEXT/JAVASCRIPT">

	var trs = document.querySelectorAll("tr");
for (var i = 0; i < trs.length; i++) {
    trs[i].addEventListener("click", function() 
    {   if(this.className.indexOf("selected") == 0)

            this.className = "";
				
        else 
		$("tr").removeClass("selected");
            this.className = "selected";
			
		
    });
}
</script></td></tr>';

}else if($op=='editrawatjalan'){
	$id=$_POST['id'];
	$sql ="SELECT CONVERT(VARCHAR(10),A.DATETIME_MEDIS,120) AS DATE_MEDIS,
CONVERT(VARCHAR(5),A.DATETIME_MEDIS,108) AS TIME_MEDIS, CONVERT(VARCHAR(10),A.TGLRUJUKAN,120) AS TGL_RUJUKAN,
A.RUJUKAN_ID,A.NOTE,
B.NAME,
B.PASIEN_ID AS ID_PASIEN,
B.NO_RM,B.ADDRESS,
B.ASURANSI_POLIS,
B.EMAIL,
A.POLI_ID,A.DR_ID,A.NORUJUKAN FROM RS_PASIEN_MEDIS A JOIN RS_PASIEN B ON A.PASIEN_ID=B.PASIEN_ID WHERE A.MEDIS_ID='$id'";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  $params['nama_pasien'] = $data['NAME'];
	   $params['alamat'] = $data['ADDRESS'];
	     $params['no_rm'] = $data['NO_RM'];
		  $params['no_rujukan'] = $data['NORUJUKAN'];
	     $params['poli_id'] = $data['POLI_ID'];
		  $params['periksa'] = $data['DATE_MEDIS'];
	
		  $params['rujukan'] = $data['RUJUKAN_ID'];
	if($data['TGL_RUJUKAN']!='') {
		  $params['tgl_rujukan'] = $data['TGL_RUJUKAN'];
	}else{
		  $params['tgl_rujukan'] = $tgl_sekarang2;
	}
		 
		  $params['note'] = $data['NOTE'];
		  $params['dokter'] = $data['DR_ID'];
		  $params['time'] = $data['TIME_MEDIS'];
		  $params['no_asuransi'] = $data['ASURANSI_POLIS'];
		  $params['no_ktp'] = $data['EMAIL'];
		  $params['pasien_id'] = $data['ID_PASIEN'];
}
 echo json_encode($params);

}
else if($op=='prosedure'){
		error_reporting(0);
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$prosedure_id=$_POST['medis_id'];	
if($_POST['medis_id']!=''){
$sql="SELECT
NAMA
FROM
	RS_PROCEDURE_PASIEN
WHERE TRX_ID='".$prosedure_id."'";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params,$options);
$no=1;
$count=sqlsrv_num_rows($stmt);
if($count > 0){
	echo"<ol style='padding-left:15px;'>";
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data['NAMA']."kkkkkfhfh</li>";
	  $no++;
  }
  echo"</ol>";
}else{
	echo "Tidak Ada Prosedur";
}
}else{
	echo "Tidak Ada Prosedur";
}
}else if($op=='pemeriksaan'){
	$prosedure_id=$_POST['medis_id'];
$sql="SELECT
	B.NAME,
	A.PEMERIKSAAN
FROM
	rs.RS_PERIKSA AS A
LEFT JOIN rs.RS_DOKTER AS B ON A.DR_ID = B.DR_ID
WHERE
	A.trx_id = '".$prosedure_id."'";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params);
$no=1;
$data5=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);	 
 echo "-Subyektif    : ".$data5['PEMERIKSAAN']."  \n-Obyektif1     : ".$data5['OBYEKTIF']." Obyektif \n * Vital Signs   :\n       TD   :  ".$data5['TENSI']." mmHg \n        N    : ".$data5['NADI']."  x/menit  \n       RR   : ".$data5['RESP']." x/menit  \n        S    :  &degC \n    Nyeri  :  nyeri \n       BB   :  ".$data5['BB']." KG \n       TB   :  ".$data5['TB']."  CM \n- Assesment :  ass \n- Planing/Terapi : ".nl2br($data5['PLANING']);
}else if($op=='diagnosa'){
	$diagnosa_id=$_POST['medis_id'];
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$sql="SELECT
P.DIAGNOSA_ID,
P.DIAGNOSA,
P.SEQ_NO,
P.PENYAKIT_ID,
P.NOTE,
P.PS,
Q.NAME AS DR_NAME,
P.DT_DIAGNOSA,
CONVERT(VARCHAR(11),P.DT_DIAGNOSA,106) AS DATE_DIAG
FROM
	rs.RS_DIAGNOSA P
LEFT JOIN rs.RS_DOKTER Q ON P.DR_ID = Q.DR_ID
WHERE
	P.DIAGNOSA_ID = '$diagnosa_id'
ORDER BY
	P.PS DESC ";
	echo"<ol style='padding-left:15px;'>";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params,	$options);

$no=1;
$jml=sqlsrv_num_rows($stmt);
if($jml>0){

 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "<li style='padding-left:0px;'>".$data['DIAGNOSA']."(".$data['PENYAKIT_ID'].")/".label_diagnosa($data['PS'])."</li> ";
	  $no++;
  }

  echo"</ol>";

}else{
	echo"Tidak ada diagnosa atau dokter tidak mengentry";
}
}
else if($op=='tindakan'){
	if($_GET['rawat']=='RJ'){
		$tabel="RS_MEDIS_TINDAKAN";
		$idnya="MEDIS_ID";
	}else{
		$tabel="RS_OPNAME_TINDAKAN";
		$idnya="OPNAME_ID";
	}
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$medis_id=$_GET['medis_id'];
	
$sql="SELECT
	CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	Q.NAME 
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	R.NAME 
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			S.NAME
		END
	) 
END 
END AS TINDAKAN_NAME,
 CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	P.TINDAKAN_ID 
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	P.OPERASI_ID
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			P.PERSALINAN_ID
		END
	) 
END 
END AS TINDAKAN,
CASE WHEN DR.NAME IS NOT NULL THEN DR.NAME ELSE PR.NAME END AS PETUGAS_NAME, P.NOTE, 
 CONVERT(VARCHAR(8),P.DATE_TIME,108) AS TIME_TINDAKAN,
 CONVERT(VARCHAR(11),P.DATE_TIME,106) AS DATE_TINDAKAN,
 P.DATE_TIME
FROM
$tabel as P	
LEFT JOIN RS_TINDAKAN Q ON P.TINDAKAN_ID = Q.TINDAKAN_ID 
LEFT JOIN RS_OPERASI R ON P.OPERASI_ID = R.OPERASI_ID 
LEFT JOIN RS_PERSALINAN S ON P.PERSALINAN_ID = S.PERSALINAN_ID
LEFT JOIN RS_DOKTER DR ON P.DR_ID=DR.DR_ID 
LEFT JOIN RS_PERAWAT PR ON P.PERAWAT_ID=PR.PERAWAT_ID 
WHERE P.$idnya='$medis_id'
ORDER BY P.DATE_TIME desc";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params,$options);
$count=sqlsrv_num_rows($stmt);
$no=1;
if($count > 0){
 echo"<ol style='padding-left:15px;'>";
  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data['TINDAKAN_NAME']."<br> Petugas:".$data['PETUGAS_NAME']."<br> Ket :$data[NOTE] <br> Waktu : $data[DATE_TINDAKAN]  $data[TIME_TINDAKAN]</li>";
    }
  echo"</ol>";
}else{
	echo"Tidak Ada Tindakan Untuk Pasien";
}
}else if($op=='datapemeriksaan'){
	$pasien=$_POST['pasien'];
	if($_POST['set']==1){
		$and="AND A.DR_ID='$_POST[dokter]'";
		$and1="AND B.DPJP='$_POST[dokter]'";
		$and3="AND B.DR_IN='$_POST[dokter]'";
		
	}else{
		$and="";
		$and1="";
		$and3="";
	}
		$sql1="								
					SELECT A.MEDIS_ID AS TRXID,
					CONVERT(VARCHAR(11),A.DATETIME_MEDIS,121) AS DATETIME,
					'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$data[PASIEN_ID]' AND A.STATUS_BAYAR = 1 
Union 
SELECT B.OPNAME_ID AS TRXID, 
CONVERT(VARCHAR(11),B.DATETIME_IN,121) AS DATETIME,
 'RI' AS RAWAT, B.DPJP AS DR,C1.NAME AS NMDOKTER,D1.NAME AS TEMPAT 
From rs.RS_PASIEN_OPNAME AS B LEFT JOIN RS.RS_DOKTER AS C1 ON B.DPJP = C1.DR_ID LEFT JOIN RS.RS_KAMAR AS D1 ON B.KAMAR_ID = D1.KAMAR_ID 
Where B.PASIEN_ID = '$data[PASIEN_ID]' 
union 
SELECT A.MEDIS_ID AS TRXID, 
CONVERT(VARCHAR(11),A.DATETIME_MEDIS,121) AS DATETIME,
'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$data[PASIEN_ID]' AND A.STATUS_BAYAR = 0 AND A.STATUS_ANTRI <> 0  
Order By DATETIME Desc ";
	$sql1="SELECT A.MEDIS_ID AS TRXID,
	CONVERT(VARCHAR(11),A.DATETIME_MEDIS,121) AS DATETIME,
	'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$pasien' AND A.STATUS_BAYAR = 1 $and
Union 
SELECT B.OPNAME_ID AS TRXID,CONVERT(VARCHAR(11),B.DATETIME_IN,121) AS DATETIME,'RI' AS RAWAT, B.DPJP AS DR,C1.NAME AS NMDOKTER,D1.NAME AS TEMPAT 
From rs.RS_PASIEN_OPNAME AS B LEFT JOIN RS.RS_DOKTER AS C1 ON B.DPJP = C1.DR_ID LEFT JOIN RS.RS_KAMAR AS D1 ON B.KAMAR_ID = D1.KAMAR_ID 
Where B.PASIEN_ID = '$pasien' $and3
union 
SELECT A.MEDIS_ID AS TRXID,CONVERT(VARCHAR(11),A.DATETIME_MEDIS,121) AS DATETIME,'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$pasien' AND A.STATUS_BAYAR = 0 AND A.STATUS_ANTRI <> 0  $and
Order By DATETIME Desc ";
$params1 = array();
$stmt1 = sqlsrv_query( $conn, $sql1 , $params1);
						while($datas=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
						if($_POST['dokter']==$datas['DR']){
							$color="yellow";
						}else{
							$color="white";
						}
						if($datas['RAWAT']=='RI'){
							$color1="green";
						}else{
							$color1="white";
						}
						if($datas['TEMPAT']=='UGD'){
							$color2="red";
						}else{
							$color2="white";
						}
	echo"<tr>
	<td  style='background-color:$color1;WIDTH:90px;'>
	<span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\",\"".$datas['RAWAT']."\",\"".tgl_indo($datas['DATETIME'])."\")' style='cursor:pointer;' >
	".tglku($datas['DATETIME'])."</span></td>
	<td class='rj' style='background-color:$color2;WIDTH:50px;'><span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\",\"".$datas['RAWAT']."\",\"".tgl_indo($datas['DATETIME'])."\")' style='cursor:pointer;' >".$datas['RAWAT']."</span></td>
	<td  style='background-color:$color;'><span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\",\"".$datas['RAWAT']."\",\"".tgl_indo($datas['DATETIME'])."\")' style='cursor:pointer;' >".$datas['TEMPAT']."<br>".$datas['NMDOKTER']."</span>
	</td>
	</tr>";	
}	
}else if($op=='cek'){
	$id=$_POST['id'];
	$sql="SELECT B. NAME AS DOKTER,
A.DR_ID AS DOKTER,D.PASIEN_ID,C.NAME AS POLI,A.ANTRIAN,A.STATUS_ANTRI,D.NAME AS NAMA_PASIEN,D.NO_RM,
 CONVERT(VARCHAR(11),D.TGL_LAHIR,103) AS TGL_LAHIR,
  CONVERT(VARCHAR(11),D.TGL_LAHIR,120) AS TGL_LAHIR2,
  E.NAME AS ASURANSI,D.ASURANSI_POLIS
 FROM RS_PASIEN_MEDIS A JOIN RS_DOKTER B ON A.DR_ID=B.DR_ID JOIN RS_POLIKLINIK C ON A.POLI_ID=C.POLI_ID JOIN RS_PASIEN D ON A.PASIEN_ID=D.PASIEN_ID LEFT JOIN RS_ASURANSI E ON D.ASURANSI_ID=E.ASURANSI_ID WHERE A.MEDIS_ID='$id'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
echo $data['STATUS_ANTRI'];
}else if($op=='cekdiagnosa'){
	$id=$_POST['medis_id'];
$sql="SELECT SEQ_NO FROM RS_DIAGNOSA WHERE DIAGNOSA_ID='$id'";
$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query($conn,$sql,$params,$options);
$data=sqlsrv_num_rows($stmt);
echo $data;
}
//Tampilkan Data Resep
else if($op=='resep'){
	error_reporting(0);
	
			$id=$_POST['medis_id'];
	$rawat=$_POST['rawat'];
	if($rawat=="RJ"){
		$tabel="MEDIS_ID";
	}else{
		$tabel="OPNAME_ID";
	}
	 $sql = "SELECT resep FROM RS_ANTRI_RESEP WHERE resep_id = '$id' ";
	 $sql2="SELECT    S.ITEM_NAME, R.JUMLAH,R.Note FROM    rs.RS_RESEP AS Q LEFT JOIN rs.RS_RESEP_DETAIL AS R ON Q.RESEP_ID = R.RESEP_ID LEFT JOIN rs.RS_MASTER_ITEM AS S ON R.ITEM_CODE = S.ITEM_CODE WHERE Q.$tabel ='$id'";
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();
$stmt = sqlsrv_query($conn,$sql,$params);
$stmt2 = sqlsrv_query($conn,$sql2,$params,$options);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$count=sqlsrv_num_rows($stmt2);
if($data['resep']!=''){
		echo trim($data['resep']);
}else {	
if($count>0){	
		while($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
		echo ltrim("R/ ".$data2['ITEM_NAME'].",     Jumlah : ".$data2['JUMLAH']."\n                ".$data2['Note']." \n-------------------------------------------- \n");
		}
}else{
	echo"Tidak Ada Resep";
}
}
}
else if($op=='laboratorium'){
error_reporting(0);

			$id=$_GET['medis_id'];

$rawat=$_GET['rawat'];

	if($rawat=="RJ"){
		$get="MEDIS_ID";
		$tabel="RS_MEDIS_DETAIL";
		
	}else{
		$get="OPNAME_ID";
		$tabel="RS_OPNAME_DETAIL";
	}

	 $sql="SELECT
	P.LAB_CODE,
	P.NAME,
	Q.NOTE,
	Q.SEQ_NO,
 CONVERT(VARCHAR(11),Q.MODIDATE,103) AS WAKTU,
	DR.NAME AS DOKTER_NAME,
	PR.NAME AS PERAWAT_NAME
FROM
	RS_LAB_ITEM P,
	$tabel Q
LEFT JOIN RS_DOKTER DR ON Q.DR_ID = DR.DR_ID
LEFT JOIN RS_PERAWAT PR ON Q.PERAWAT_ID = PR.PERAWAT_ID
WHERE
	P.LAB_CODE = Q.DETAIL_CODE
AND Q.$get = '$id'
AND Q.DETAIL_TYPE = 1
ORDER BY
	Q.MODIDATE DESC";
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();

$stmt = sqlsrv_query($conn,$sql,$params,$options);

$count=sqlsrv_num_rows($stmt);
if($count > 0){
	echo"<ol style='padding-left:15px;'>";
	while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		echo "<li style='padding-bottom:5px;'>".$data['NAME']."(".$data['LAB_CODE'].")<br> Hasil: <br>".$data['NOTE']."<br> <br> Dokter :".$data['DOKTER_NAME']."<br> Laboran :".$data['PERAWAT_NAME']."<br> Waktu :".$data['WAKTU']."</li>";
		}
		echo "</ol>";
		}else {	
	echo"Tidak Ada pemeriksaan Laboratorium";
}
}

else if($op=='resume'){
		$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();
	$tanggal=$_POST['tanggal'];
$sql="SELECT DISTINCT
	B.NAME AS NMKLINIK,
	A.POLI_ID,
	(
		SELECT
			COUNT (MEDIS_ID)
		FROM
			RS_PASIEN_MEDIS 
		WHERE
			CONVERT (
				VARCHAR (10),
				DATETIME_MEDIS,
				120
			) ='$tanggal'
		AND  STATUS_BAYAR = 0
		AND POLI_ID = A.POLI_ID
	) AS BLM,
	(
		SELECT
			COUNT (MEDIS_ID)
		FROM
			RS_PASIEN_MEDIS 
		WHERE
			CONVERT (
				VARCHAR (10),
				DATETIME_MEDIS,
				120
			) = '$tanggal'
		AND STATUS_BAYAR = 1
		AND POLI_ID = A.POLI_ID
	) AS SDH,
	COUNT (A.MEDIS_ID) AS JUMLAH
FROM
	rs.RS_PASIEN_MEDIS AS A 
LEFT JOIN rs.RS_POLIKLINIK AS B ON A.POLI_ID = B.POLI_ID
WHERE
	CONVERT (
		VARCHAR (10),
		A.DATETIME_MEDIS,
		120
	) = '$tanggal'
GROUP BY
	B.NAME,
	A.POLI_ID
ORDER BY
	B.NAME ";
$stmt = sqlsrv_query($conn,$sql,$params,$options );
$no=1;

 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 echo "<tr onClick='Detaildokter(\"".$data['POLI_ID']."\",\"".$tanggal."\")'><td>$no</td><td>$data[NMKLINIK]</td><td>".$data['BLM']."</td><td>".$data['SDH']."</td><td>$data[JUMLAH]</td></tr>";
	 $no++;
 }

 
}else if($op=='datadokter'){
		$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();
	$poli=$_POST['poli'];
	$tanggal=$_POST['tanggal'];
$sql="SELECT DISTINCT
	B.NAME AS NMDOKTER,
	A.DR_ID,
	(
		SELECT
			COUNT (medis_id)
		FROM
			RS_PASIEN_MEDIS 
		WHERE
			CONVERT (
				VARCHAR (10),
				DATETIME_MEDIS,
				120
			) ='$tanggal'
		AND STATUS_BAYAR = 0
		AND DR_ID = A.DR_ID
	) AS BLM,
	(
		SELECT
			COUNT (medis_id)
		FROM
			RS_PASIEN_MEDIS 
		WHERE
			CONVERT (
				VARCHAR (10),
				DATETIME_MEDIS,
				120
			) = '$tanggal'
		AND  STATUS_BAYAR = 1
		AND DR_ID = A.DR_ID
	) AS SDH,
	COUNT (A.medis_id) AS jumlah
FROM
	rs.RS_PASIEN_MEDIS AS A 
LEFT JOIN rs.RS_DOKTER AS B ON A.DR_ID = B.DR_ID
WHERE
	CONVERT (
		VARCHAR (10),
		A.DATETIME_MEDIS,
		120
	) = '$tanggal'
AND A.POLI_ID = '".$poli. "'
GROUP BY
	B.NAME,
	A.Dr_id
ORDER BY
	B.Name";
$stmt = sqlsrv_query($conn,$sql,$params,$options );
$no=1;
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 echo "<tr ><td>$no</td><td>$data[NMDOKTER]</td><td>".$data['BLM']."</td><td>".$data['SDH']."</td><td>$data[jumlah]</td></tr>";
	 $no++;
 }
}else if($op=='hapusdata'){
	$id=$_POST['id'];
		$params = array();
	
	$hapus1="DELETE FROM RS_MEDIS_DETAIL WHERE MEDIS_ID='$id'";
	$hapus2="DELETE FROM RS_MEDIS_TINDAKAN WHERE MEDIS_ID='$id'";
	$hapus3="DELETE FROM RS_PASIEN_MEDIS WHERE MEDIS_ID='$id'";
	$hapus4="DELETE FROM RS_TRX_PASIEN WHERE TRX_ID='$id'";
	$hapus5="DELETE FROM RS_PERIKSA WHERE TRX_ID='$id'";
	$hapus6="DELETE FROM RS_ANTRI_LAB WHERE ID_TRX ='$id'";
	$hapus7="DELETE FROM RS_ANTRI_LAB WHERE ID_TRX ='$id'";
	$hapus8="DELETE FROM RS_ANTRI_RESEP WHERE RESEP_ID ='$id'";
	
	sqlsrv_query($conn,$hapus1,$params);
	sqlsrv_query($conn,$hapus2,$params);
	sqlsrv_query($conn,$hapus3,$params);
	sqlsrv_query($conn,$hapus4,$params);
	sqlsrv_query($conn,$hapus5,$params);
	sqlsrv_query($conn,$hapus6,$params);
	sqlsrv_query($conn,$hapus7,$params);
	sqlsrv_query($conn,$hapus8,$params);

}
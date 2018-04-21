
<?php
include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";

session_start();
include"../../inc/fungsi_indotgl.php";
$op=$_GET['op'];
if($op=='detailpoli'){
	$tanggal=$_POST['tangga'];
	$poli=$_POST['poli'];
	if($tanggal==''){
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
}else if($op=='editrajal'){
	$dt_medis=tgl_time($_POST['tanggal']);
	$sql="UPDATE RS_PASIEN_MEDIS 
	SET DR_ID='$_POST[dokter]',               
    DATETIME_MEDIS='$dt_medis',
    NOTE='$_POST[catatan]',
	DIAGNOSA='$_POST[assesment]',
    NORUJUKAN='$_POST[no_rujukan]',
	POLI_ID='$_POST[poli]'
    ,MODIBY='$_SESSION[nama]'
	,MODIDATE='$time'
	WHERE MEDIS_ID='$_POST[id]'";
	$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
sqlsrv_query( $conn, $sql , $params, $options );
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
if($_GET['form_tanggal']!=''){
	$form_tanggal=$_GET['form_tanggal'];
}else{
$form_tanggal=$_POST['form_tanggal'];	
}
if($_GET['tanggal']!=''){
$tanggal=$_GET['tanggal'];
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
LOWER(Q.ADDRESS) AS ADDRESS,
asuransi_pasien=CASE Q.TIPE_PASIEN WHEN 1  THEN 'UMUM' WHEN 3 THEN R.NAME END,
CONVERT(VARCHAR(11),P.DATETIME_MEDIS,106) AS DATE_MEDIS,
CONVERT(VARCHAR(8),P.DATETIME_MEDIS,108) AS TIME_MEDIS,
S.NAME AS POLI_NAME,
P.ANTRIAN,
P.RUJUKAN_DATA_ID,
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
 $sql.="AND CONVERT(VARCHAR(11),P.DATETIME_MEDIS,103) ='$form_tanggal'";
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
										echo"<tr style='cursor:pointer;' onclick='GetMedisId(\"".$data['MEDIS_ID']."\",\"".$data['PASIEN_ID']."\")'><td style='width:50px;'>
										$no</td><td class='$hasil' style='width:80px;'>
										<span data-toggle='modal' onclick='GetUbahPasien(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;'  >$data[NO_RM]</span></td><td ";  if ($data['ALERGI']!=''){
											echo "class='danger'"; 
										}echo"><span data-toggle='modal' onclick='GetAlergi(\"".$data['PASIEN_ID']."\")' style='cursor:pointer;' >$data[NAME]</span></td><td>$data[ADDRESS]</td><td>$data[NAMA_AS]</td>
										<td style='width:110px;'><span data-toggle='modal' onclick='GetUbah(\"".$data['MEDIS_ID']."\")' style='cursor:pointer;	' >$data[DATE_MEDIS]</span></td><td>$data[POLI_NAME]</td>
										<td>$data[nama_dokter]</td><td >$data[ANTRIAN]</td><td>$data[NORUJUKAN]</td></tr>";
										$no++;
 }
 echo'<tr><td colspan="10"><script type="TEXT/JAVASCRIPT">

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
	$sql ="SELECT CONVERT(VARCHAR(11),A.DATETIME_MEDIS,103) AS DATE_MEDIS,
CONVERT(VARCHAR(5),A.DATETIME_MEDIS,108) AS TIME_MEDIS, CONVERT(VARCHAR(11),A.TGLRUJUKAN,103) AS TGL_RUJUKAN,
A.RUJUKAN_ID,A.NOTE,
B.NAME,B.NO_RM,B.ADDRESS,A.POLI_ID,A.DR_ID,A.NORUJUKAN FROM RS_PASIEN_MEDIS A JOIN RS_PASIEN B ON A.PASIEN_ID=B.PASIEN_ID WHERE A.MEDIS_ID='$id'";
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
		  $params['periksa'] = $data['DATE_MEDIS']." ".$data['TIME_MEDIS'];
		  $params['rujukan'] = $data['RUJUKAN_ID'];
		  $params['tgl_rujukan'] = $data['TGL_RUJUKAN'];
		  $params['note'] = $data['NOTE'];
		    $params['dokter'] = $data['DR_ID'];
}
 echo json_encode($params);

}else if($op=='prosedure'){
	$prosedure_id=$_POST['medis_id'];
$sql="SELECT
NAMA
FROM
	RS_PROCEDURE_PASIEN

WHERE TRX_ID='$prosedure_id'";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params);
$no=1;
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "$no.".$data['NAMA']."\n ";
	  $no++;
  }
	
}else if($op=='pemeriksaan'){
	$prosedure_id=$_POST['medis_id'];
$sql="SELECT
*
FROM
	RS_PERIKSA
WHERE TRX_ID='$prosedure_id'";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params);
$no=1;
$data5=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);	 
 echo "-Subyektif    : ".$data5['SUBYEKTIF']."  \n-Obyektif     : ".$data5['OBYEKTIF']." Obyektif \n * Vital Signs   :\n       TD   :  ".$data5['TENSI']." mmHg \n        N    : ".$data5['NADI']."  x/menit  \n       RR   : ".$data5['RESP']." x/menit  \n        S    :  &degC \n    Nyeri  :  nyeri \n       BB   :  ".$data5['BB']." KG \n       TB   :  ".$data5['TB']."  CM \n- Assesment :  ass \n- Planing/Terapi : ".$data5['PLANING'];
}else if($op=='diagnosa'){
	$diagnosa_id=$_POST['medis_id'];
$sql="SELECT
P.DIAGNOSA_ID,
P.DIAGNOSA,
P.SEQ_NO,
P.PENYAKIT_ID,
P.NOTE,
Q.NAME AS DR_NAME,
P.DT_DIAGNOSA,
CONVERT(VARCHAR(11),P.DT_DIAGNOSA,106) AS DATE_DIAG
FROM
	rs.RS_DIAGNOSA P
LEFT JOIN rs.RS_DOKTER Q ON P.DR_ID = Q.DR_ID
WHERE
	P.DIAGNOSA_ID = '$diagnosa_id'
ORDER BY
	P.SEQ_NO DESC ";
$params = array();
$stmt= sqlsrv_query( $conn, $sql , $params);
$no=1;
 while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data['DIAGNOSA']."</li> ";
	  $no++;
  }
}else if($op=='tindakan'){
$medis_id=$_POST['medis_id'];
$sql="SELECT
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
 P.SEQ_NO,
 P.HARGA,
 CASE
WHEN P.TINDAKAN_ID IS NOT NULL THEN
	'5'
ELSE
	CASE
WHEN P.OPERASI_ID IS NOT NULL THEN
	'3'
ELSE
	(
		CASE
		WHEN P.PERSALINAN_ID IS NOT NULL THEN
			'4'
		END
	)
END
END AS TINDAKAN_TYPE,
 CASE
WHEN DR.NAME IS NOT NULL THEN
	DR.NAME
ELSE
	PR.NAME
END AS PETUGAS_NAME,
 P.NOTE,
 CONVERT(VARCHAR(8),P.DATE_TIME,108) AS TIME_TINDAKAN,
 CONVERT(VARCHAR(11),P.DATE_TIME,106) AS DATE_TINDAKAN,
 P.DATE_TIME
FROM
	rs.RS_MEDIS_TINDAKAN P
LEFT JOIN rs.RS_TINDAKAN Q ON P.TINDAKAN_ID = Q.TINDAKAN_ID
LEFT JOIN rs.RS_OPERASI R ON P.OPERASI_ID = R.OPERASI_ID
LEFT JOIN rs.RS_PERSALINAN S ON P.PERSALINAN_ID = S.PERSALINAN_ID
LEFT JOIN rs.RS_DOKTER DR ON P.DR_ID = DR.DR_ID
LEFT JOIN rs.RS_PERAWAT PR ON P.PERAWAT_ID = PR.PERAWAT_ID
WHERE
	P.MEDIS_ID = '$medis_id'
ORDER BY
	P.SEQ_NO
      ";
$stmt=sqlsrv_query($conn,$sql);
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$no=1;
 echo"<ol>";
  while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
	 
	  echo "<li>".$data['TINDAKAN_NAME']."<br> Petugas:".$data['PETUGAS_NAME']."<br> Ket :$data[NOTE] <br> Waktu : $data[DATE_TINDAKAN]  $data[TIME_TINDAKAN]</li>";
  
  }
  echo"</ol>";
}else if($op=='datapemeriksaan'){
	$pasien=$_POST['pasien'];
	if($_POST['set']==1){
		$and="AND A.DR_ID='$_POST[dokter]'";
		$and1="AND B.DPJP='$_POST[dokter]'";
		$and3="AND B.DR_ID='$_POST[dokter]'";
		
	}else{
		$and="";
		$and1="";
		$and3="";
	}
	$sql1="SELECT A.MEDIS_ID AS TRXID,A.DATETIME_MEDIS AS DATETIME, 'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$pasien' AND A.STATUS_BAYAR = 1 $and
Union 
SELECT B.OPNAME_ID AS TRXID, B.DATETIME_IN AS DATETIME, 'RI' AS RAWAT, B.DPJP AS DR,C1.NAME AS NMDOKTER,D1.NAME AS TEMPAT 
From rs.RS_PASIEN_OPNAME AS B LEFT JOIN RS.RS_DOKTER AS C1 ON B.DPJP = C1.DR_ID LEFT JOIN RS.RS_KAMAR AS D1 ON B.KAMAR_ID = D1.KAMAR_ID 
Where B.PASIEN_ID = '$pasien' $and3
union 
SELECT A.MEDIS_ID AS TRXID, A.DATETIME_MEDIS AS DATETIME,'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$pasien' AND A.STATUS_BAYAR = 0 AND A.STATUS_ANTRI <> 0  $and
Order By DATETIME Desc ";
$params1 = array();
$stmt1 = sqlsrv_query( $conn, $sql1 , $params1);
echo $sql1;

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
	echo"<tr><td class='tanggal' style='background-color:$color1;'>	<span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\")' style='cursor:pointer;' >".date_format($datas['DATETIME'], 'd/m/Y')."</span></td><td class='rj' style='background-color:$color2;'>".$datas['RAWAT']."</td><td class='poli' style='background-color:$color;'>".$datas['TEMPAT']."<br>".$datas['NMDOKTER']."
	</td></tr>";
	*
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
}
//Tampilkan Data Resep
else if($op=='resep'){
	error_reporting(0);
	if($_GET['id']==''){
			$id=$_POST['medis_id'];
	}else{
			$id=$_GET['medis_id'];
}

	$rawat=$_POST['rawat'];
	if($rawat=="RJ"){
		$tabel="MEDIS_ID";
	}else{
		$tabel="OPNAME_ID";
	}
	 $sql = "SELECT resep FROM RS_ANTRI_RESEP WHERE resep_id = '$id' ";
	 $sql2="SELECT    S.ITEM_NAME, R.JUMLAH FROM    rs.RS_RESEP AS Q LEFT JOIN rs.RS_RESEP_DETAIL AS R ON Q.RESEP_ID = R.RESEP_ID LEFT JOIN rs.RS_MASTER_ITEM AS S ON R.ITEM_CODE = S.ITEM_CODE WHERE Q.$tabel ='$id'";
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params = array();
$stmt = sqlsrv_query($conn,$sql,$params);
$stmt2 = sqlsrv_query($conn,$sql2,$params,$options);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$count=sqlsrv_num_rows($stmt2);

if($data['resep']!=''){
	echo $data['resep'];
}else {	
if($count>0){
		while($data2=sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_ASSOC)){
		echo $data2['ITEM_NAME']."\n      Jumlah : ".$data2['JUMLAH']."\n";
		}
}else{
	echo"Tidak Ada Resep";
}

}

}
else if($op=='periksa'){
	$id=$_GET['id'];
    $benar=$_GET['aksi'];
$sql="SELECT B. NAME AS DOKTER,
A.DR_ID AS DOKTER,A.STATUS_ANTRI,D.PASIEN_ID,C.NAME AS POLI,A.ANTRIAN,D.NAME AS NAMA_PASIEN,D.NO_RM,
 CONVERT(VARCHAR(11),D.TGL_LAHIR,103) AS TGL_LAHIR,
  CONVERT(VARCHAR(11),D.TGL_LAHIR,120) AS TGL_LAHIR2,
  E.NAME AS ASURANSI,D.ASURANSI_POLIS
 FROM RS_PASIEN_MEDIS A JOIN RS_DOKTER B ON A.DR_ID=B.DR_ID JOIN RS_POLIKLINIK C ON A.POLI_ID=C.POLI_ID JOIN RS_PASIEN D ON A.PASIEN_ID=D.PASIEN_ID LEFT JOIN RS_ASURANSI E ON D.ASURANSI_ID=E.ASURANSI_ID WHERE A.MEDIS_ID='$id'";
$params = array();
$stmt = sqlsrv_query( $conn, $sql , $params);
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
$dataku=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
	$sql3="update RS_PASIEN_MEDIS set STATUS_ANTRI='1' WHERE MEDIS_ID='$id' ";
	if($benar==1){
$stmt = sqlsrv_query( $conn, $sql3 , $params);
	}
	?>
	

	<script>
	$("#resep").load("modul/pg_daftarrawatjalan/crud.php?op=resep&id=<?php echo $_POST['id']; ?>");	
	function GetMedis(medis_id,rawat){
		  $("#medis_filter").val(medis_id);
		$.post("modul/pg_daftarrawatjalan/crud.php?op=pemeriksaan", {medis_id: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#pemeriksaan").val(data);
			}
		});
		$.post("modul/pg_daftarrawatjalan/crud.php?op=tindakan", {medis_id: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#tindakan").html(data);
			}
		});
			$.post("modul/pg_daftarrawatjalan/crud.php?op=diagnosa", {medis_id: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#diagnosa").html(data);
			}
		});
		$.post("modul/pg_daftarrawatjalan/crud.php?op=prosedure", {medis_id: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#procedure").html(data);
			}
		});
			$.post("modul/pg_daftarrawatjalan/crud.php?op=resep", {medis_id: ""+medis_id+"",rawat : ""+rawat+"" }, function(data, status){
			if(data, status) {
				$("#resep").html(data);
			}
		});
			$.post("modul/pg_pendaftaran/crud.php?op=hitungusia", {usia: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#laboratorium").html("laboratorium");
			}
		});
	
		
			$.post("modul/pg_pendaftaran/crud.php?op=hitungusia", {usia: ""+medis_id+""}, function(data, status){
			if(data, status) {
				$("#radiologi").val("radiologi");
			}
		});
}
function GetPemeriksaan(id) {
    $("#id_pasien_alergi").val(id);
	    $.post("modul/pg_pasien/crud.php?op=detail_alergi", {
            id_pasien: id
        },
        function (data, status) {
		$("#ket_alergi").val(data);
	}
    );
    $("#entri_pemeriksaan").modal("show");
}
function Close(id) {
 
    $("#entri_pemeriksaan").modal("hide");
}function suggest(inputString){
	$('#suggestions1').fadeOut();
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/procedure.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			}
		});
	}
}
$("#closetindakan").bind("click", function(event) {
		$('#suggestions1').fadeOut();
});
$("#closeprocedure").bind("click", function(event) {
		$('#suggestions').fadeOut();
});
$("#closediagnosa").bind("click", function(event) {
		$('#suggestions2').fadeOut();
});
$("#closeobat").bind("click", function(event) {
		$('#suggestions3').fadeOut();
});
// Tombol Selesai
$("#selesai").bind("click", function(event) {
	var medis_id=$("#medis_filter").val();
	var data_diagnosa=$("#diagnosa").html();
	var medis=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=selesai",{ 
	 medis_id:$("#medis_id").val(),
bb:$("#edit_bb").val(),
tb:$("#edit_tb").val(),
nyeri:$("#edit_nyeri").val(),
nadi :$("#edit_nadi").val(),
resp:$("#edit_resp").val(),
suhu:$("#edit_suhu").val(),
tensi:$("#edit_tensi").val(),
subyektif:$("#edit_subyektif").val(),
obyektif:$("#obyektif").val(),
planning: $("#planning").val(),
dokter_id: dokter_id,
pasien_id: $("#pasien_id").val(),
poli: $("#nama_poli").val(),
resep: $("#edit_resep").val()

	 } ,
        function (data, status) {	
		
		$('#static2').modal('show');	
        }  );	
});
$("#tambahprocedure").bind("click", function(event) {
	var medis=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	var prosedur=$("#input_prosedur").val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpanpros",{ 
	 medis_id:$("#medis_id").val(),
     prosedur:$("#input_prosedur").val()
	 },function (data, status) {	
	 $('#suggestions').fadeOut();
       $("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis+"");
        }  );	
});
$("#tambahdiagnosa").bind("click", function(event){
	var medis=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	if(medis==''){
		alert("Data Pasien Medis Tidak Ditemukan");
	}else{
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpandiagnosa",{ 
	 medis_id:$("#medis_id").val(),
     diagnosa:$("#input_diagnosa").val(),
	 dokter : $("#dokter_id").val(),
	 pasien_id : $("#pasien_id").val()
	 },function (data, status) {	
	 $('#suggestions2').fadeOut();
       $("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa&id="+medis+"");
        }  );	
	}
});
function tindakan(inputString){
	var opsi  = $('input[name=optionsRadios]:checked').val();
	$('#suggestions').fadeOut();
	if(inputString.length == 0) {
		$('#suggestions1').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/tindakan.php", {queryString: ""+inputString+"",opsi:opsi}, function(data){
			if(data.length >3) {
				$('#suggestions1').fadeIn();
				$('#suggestionsList1').html(data);
				
			}
		});
	}
}
function diagnosa(inputString){
	if(inputString.length == 0) {
		$('#suggestions2').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/diagnosa.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions2').fadeIn();
				$('#suggestionsList2').html(data);
			}
		});
	}
}
function obat(inputString){
	if(inputString.length == 0) {
		$('#suggestions3').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("modul/pg_daftarrawatjalan/obat.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >3) {
				$('#suggestions3').fadeIn();
				$('#suggestionsList3').html(data);
			}
		});
	}
	}
function fil(thisValue) {
	var medis_id=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpan_diagnosa", {          
			kode_diagnosa : ""+thisValue+"",
			medis_id : medis_id,
			dokter_id: dokter_id,
			pasien_id : $("#pasien_id").val()
        },
        function (data, status) {
if(data > 0){
	alert("Data Sudah Diinputkan");
	$('#suggestions2').fadeOut();
	exit();
}else{			
				$('#suggestions2').fadeOut();
		$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa&id="+medis_id+"");
}
        }  );
	
}function salindiagnosa() {
	var medis_id=$("#medis_filter").val();
	var data_diagnosa=$("#diagnosa").length;
	var medis=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	if(diagnosa < 5){
	alert("Tidak Ada Data Diagnosa");
	exit();
	}else{	
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=salin_diagnosa", {          
			medis_id : medis_id,
			medis_id2 : medis,
			dokter_id: dokter_id,
            pasien_id: $("#pasien_id").val()
        },
        function (data, status) {	
			alert("Data Berhasil Di Salin");
			$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa&id="+medis+"");
			exit();
        }  );
	}
	
}
function salinprocedure() {
	var medis_id=$("#medis_filter").val();
	var data_diagnosa=document.getElementById("procedure").innerHTML;
	var medis=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	if(data_diagnosa === ""){
	alert("Tidak Ada Data Prosedur");
	exit();
	}else{	
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=salin_procedure", {          
			medis_id : medis_id,
			medis_id2 : medis,
			dokter_id: dokter_id
        },
        function (data, status) {	
			alert("Data Berhasil Di Salin");
			$("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis+"");
			exit();
        }  );
	}
	
}
function option(opsi) {
		var medis_id=$("#medis_id").val();
		
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=opsi", {      
			medis_id : medis_id,
			opsi: opsi
        },
        function (data, status) {	
				$("#data_periksa").modal("hide");
        });
	
	}
function salinresep() {
		var medis=$("#medis_id").val();
		var medis_id=$("#medis_filter").val();
	    var resep = $("#resep").val();
		var dokter_id=$("#dokter_id").val();
		var nama_poli=$("#nama_poli").val();
		var pasien_id=$("#pasien_id").val();
	if(resep==''){
	alert("Tidak Ada Data Resep");
	exit();
	}else{		 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=salin_resep", {          
			medis_id : medis_id,
			medis_id2 : medis,
			dokter_id: dokter_id,
			poli:nama_poli,
			pasien_id:pasien_id
        },
        function (data, status) {	
		
	$(".AppendedContainer").val("chelo");
        }  );
	
	}
	
}

function fill2(thisValue) {
	var medis_id=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpan_procedure", {          
			kode_diagnosa : ""+thisValue+"",
			medis_id : medis_id
        },
        function (data, status) {	
		if(data > 0){
	alert("Data Sudah Diinputkan");
}else{
	
			$('#suggestions').fadeOut();
		$("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis_id+"");
}
        }  );
	
}function input_tindakan(thisValue) {
	var medis_id=$("#medis_id").val();
	var dokter_id=$("#dokter_id").val();
	var mode  = $('input[name=optionsRadios]:checked').val();
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=simpan_tindakan", {          
			kode_diagnosa : ""+thisValue+"",
			medis_id : medis_id,
			dokter: dokter_id,
			mode: mode
        },
        function (data, status) {
		if(data > 0){
	alert("Data Sudah Diinputkan");
		$('#suggestions1').fadeOut();
		exit();
}else{		
alert("Data Sudah Diinputkan"+data);
		$('#suggestions1').fadeOut();
		$("#data_tindakan").haml( "modul/pg_daftarrawatjalan/view.php?op=tindakan&id="+medis_id+"");
}
        }  );
}
function filobat(thisValue) {
$('#nama_obat').val(thisValue);
			$('#suggestions3').fadeOut();
			$('#jumlah_obat').focus();
	
	
}
function hapus_diagnosa(thisValue,seq) {
 if(confirm ("Hapus Data Diagnosa ?")==true){
	 $.post("modul/pg_daftarrawatjalan/view.php?op=hapusdiagnosa", {          
			kode_diagnosa : ""+thisValue+"",
			seq : seq
        },
        function (data, status) {	
		$("#data_diagnosa").load( "modul/pg_daftarrawatjalan/view.php?op=diagnosa&id="+thisValue+"");
        }  );
 }
	
}

function hapus_tindakan(thisValue,seq) {
 if(confirm ("Hapus Data Tindakan ?")==true){
	 $.post("modul/pg_daftarrawatjalan/view.php?op=hapustindakan", {          
			kode_diagnosa : ""+thisValue+"",
			seq : seq
        },
        function (data, status) {	
		$("#data_tindakan").load( "modul/pg_daftarrawatjalan/view.php?op=tindakan&id="+thisValue+"");
        }  );
 }
	
}
function hapus_procedure(medis,thisValue) {
 if(confirm ("Hapus Data Prosedur ?")==true){
	 $.post("modul/pg_daftarrawatjalan/aksi_simpan.php?op=hapusprocedure", {          
			kode_diagnosa : ""+thisValue+""
        },
        function (data, status) {	
		$("#data_procedure").load( "modul/pg_daftarrawatjalan/view.php?op=procedure&id="+medis+"");
        }  );
 }
	
}
$('#cek_dokter').click(function()
{
var pasien =$("#pasien_id").val();
var dokter =$("#id_dokter").val();
   if ($(this).is(':checked'))
    {
		var set=1;
          $.post("modul/pg_daftarrawatjalan/crud.php?op=datapemeriksaan", {
            set: set,
			pasien:pasien,
			dokter:dokter
        }, function (data, status) {
			$("#dataperiksa").html(data).show(); 
	     
        }  );
       
    }
    //If checkbox is unchecked then disable or enable input
    else
    {

     var set=0;
          $.post("modul/pg_daftarrawatjalan/crud.php?op=datapemeriksaan", {
            set: set,
			pasien:pasien,
		    dokter:dokter
        }, function (data, status) {
		$("#dataperiksa").html(data).show(); 
	     
        }  ); 
    }
});
/*
function yesnoCheck() {
	
    if (document.getElementById('asuransi').checked) {
		var data=1;
         $("#no_asuransi").removeAttr("disabled");
  $.post("modul/pg_pendaftaran/crud.php?op=asuransi", {
            data: data
        }, function (data, status) {
			$("#view_asuransi").html(data).show(); 
	     
        }  );		 
    } else {
		var data=0;
		 $.post("modul/pg_pendaftaran/crud.php?op=asuransi", {
            data: data
        }, function (data, status) {
			$("#view_asuransi").html(data).show(); 
	     
        }  );
		 $("#no_asuransi").attr("disabled","disabled");
    }
}
*/
	</script>
	<div class="row">
	<div class="col-md-3">
<div class="col-xs-12">
						<div class="well">
							<address>
							<strong>Rawat Jalan</strong><br/>
							Dokter : <?php echo $data['DOKTER']; ?><br/>
							<input type="hidden" value="<?php echo $data['POLI']; ?>" id="nama_poli">
							<span ><?php echo $data['POLI']; ?></span><br/>
						ANTRIAN:<?php echo $data['ANTRIAN']; ?></address>
							<address>
							<strong><?php echo $data['NAMA_PASIEN']."<br>". $data['NO_RM']; ?><br>
							</strong><br/>
							Tgl Lahir : <?php echo tgl_indo($data['TGL_LAHIR2']); ?><br>
							Umur      : <?php echo umur($data['TGL_LAHIR']); ?><BR>
							Asuransi  : <?php echo $data['ASURANSI']; ?><br>
							No Asuransi :<?php echo $data['ASURANSI_POLIS']; ?><br>
						
							</address>
						</div>
					</div>
					<style type="text/css">
					.ui-dialog{
						background-color:#fff;
					}
					textarea#pemeriksaan {
    width:100%;
    display:block;
    max-width:100%;
    line-height:1.5;
    padding:15px 15px 30px;
    border-radius:3px;
    border:1px solid #F7E98D;
    font:12px Tahoma, cursive;
    transition:box-shadow 0.5s ease;
    box-shadow:0 4px 6px rgba(0,0,0,0.1);
    font-smoothing:subpixel-antialiased;
    background:linear-gradient(#F9EFAF, #F7E98D);
    background:-o-linear-gradient(#F9EFAF, #F7E98D);
    background:-ms-linear-gradient(#F9EFAF, #F7E98D);
    background:-moz-linear-gradient(#F9EFAF, #F7E98D);
    background:-webkit-linear-gradient(#F9EFAF, #F7E98D);
}textarea#resep {
    width:100%;
    display:block;
    max-width:100%;
    line-height:1.5;
    border-radius:3px;
    border:1px solid #F7E98D;
    font:13px Tahoma, cursive;
    transition:box-shadow 0.5s ease;
    box-shadow:0 4px 6px rgba(0,0,0,0.1);
    font-smoothing:subpixel-antialiased;
    background:linear-gradient(#F9EFAF, #F7E98D);
    background:-o-linear-gradient(#F9EFAF, #F7E98D);
    background:-ms-linear-gradient(#F9EFAF, #F7E98D);
    background:-moz-linear-gradient(#F9EFAF, #F7E98D);
    background:-webkit-linear-gradient(#F9EFAF, #F7E98D);
}
.wrap{
	width: 500px;
	text-align: justify;
	 overflow-y:scroll;
	 padding-right:5px;
	 height:700px;
}


/*css3 design scrollbar*/
::-webkit-scrollbar {
    width: 10px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.3);     
    background: #666;    
}
 
::-webkit-scrollbar-thumb {
    background: #232323;
}

</style>

<style>
#result {
	position: absolute;
	height:20px;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:12px;
}
.suggestionsBox {
	position: absolute;
	left: 13px;
	top:0px;
	margin: 26px 0px 0px 0px;
	width: 445px;
	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
}.suggestionsBox1 {
	position: absolute;
	left: 13px;
	top:0px;
	margin: 26px 0px 0px 0px;
	width: 440px;
	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
}
.suggestionsBox3 {
	position: absolute;
	left: 13px;
	top:0px;
	margin: 26px 0px 0px 0px;
	width:440px;
	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
	z-index:999;
}

.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul.auto {
	font-family:Arial, Helvetica, sans-serif;
	font-size:10px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
.pane {
  background: #eee;
}
.pane-hScroll5 {
  overflow: auto;
  width:280px;

}
.pane-vScroll2 {
  overflow-y: auto;
  overflow-x: hidden;
  height: 350px;
  color:#000;
}
table.scroll {width:280px;border:1px #a9c6c9 solid;font:12px verdana,arial,sans-serif;color:#333333;}
table.scroll thead {display:table;width:100%;}
table.scroll tbody {display:block;height:300px;overflow:auto;float:left;width:100%;}
table.scroll tbody tr {display:table;width:100%;}
table.scroll  td.tanggal {width:80px;padding:3px;}
table.scroll  th.tanggal {width:80px;padding:3px;}
table.scroll  td.poli {width:140px;padding:3px;}
table.scroll  th.poli {width:135px;padding:3px;}
table.scroll  td.rj {width:35px;padding:3px;}
table.scroll  th.rj {width:30px;padding:3px;}
table.scroll th {background-color:#000099;color:#ffffff;}
</style>
					<div class="col-xs-12">
					<div class="pane pane--table1">
  <div class="pane-hScroll5">
					<table >
					<thead>
					<tr><th colspan="3">Dokter Terkait</th><th>
						<input type="hidden" id="pasien_id" name="id_dokter" value="<?php echo $data['PASIEN_ID']; ?>">
					<input type="hidden" id="id_dokter" name="id_dokter" value="<?php echo $data['DOKTER']; ?>">
											<input type="checkbox" id="cek_dokter" name="cek_dokter">
											</th></tr>
					<tr><th class="tanggal">Tanggal</th><th class='rj'>RWT</th><th class="poli">Poli/Dokter</th>
					<?php
					$sql1="SELECT A.MEDIS_ID AS TRXID,A.DATETIME_MEDIS AS DATETIME, 'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$data[PASIEN_ID]' AND A.STATUS_BAYAR = 1 
Union 
SELECT B.OPNAME_ID AS TRXID, B.DATETIME_IN AS DATETIME, 'RI' AS RAWAT, B.DPJP AS DR,C1.NAME AS NMDOKTER,D1.NAME AS TEMPAT 
From rs.RS_PASIEN_OPNAME AS B LEFT JOIN RS.RS_DOKTER AS C1 ON B.DPJP = C1.DR_ID LEFT JOIN RS.RS_KAMAR AS D1 ON B.KAMAR_ID = D1.KAMAR_ID 
Where B.PASIEN_ID = '$data[PASIEN_ID]' 
union 
SELECT A.MEDIS_ID AS TRXID, A.DATETIME_MEDIS AS DATETIME,'RJ' AS RAWAT,A.DR_ID AS DR,C.NAME as NMDOKTER , D.NAME AS TEMPAT 
From rs.RS_PASIEN_MEDIS AS A LEFT JOIN RS.RS_DOKTER AS C ON A.DR_ID = C.DR_ID LEFT JOIN RS.RS_POLIKLINIK AS D ON A.POLI_ID = D.POLI_ID 
Where A.PASIEN_ID = '$data[PASIEN_ID]' AND A.STATUS_BAYAR = 0 AND A.STATUS_ANTRI <> 0  
Order By DATETIME Desc ";
$params1 = array();
$stmt1 = sqlsrv_query( $conn, $sql1 , $params1);
			?>
					</thead>
					</table>
						<div class="pane-vScroll2">
					<table>
				
					<tbody id="dataperiksa">
					<?php
					while($datas=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC)){
						if($data['DOKTER']==$datas['DR']){
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
	echo"<tr><td class='tanggal' style='background-color:$color1;'>	<span data-toggle='modal' onclick='GetMedis(\"".$datas['TRXID']."\",\"".$datas['RAWAT']."\")' style='cursor:pointer;' >".date_format($datas['DATETIME'], 'd/m/Y')."</span></td><td class='rj' style='background-color:$color2;'>".$datas['RAWAT']."</td><td class='poli' style='background-color:$color;'>".$datas['TEMPAT']."<br>".$datas['NMDOKTER']."
	</td></tr>";
}
		
					?>
					</tbody>
					</table>
					</div>
	</div>
	</div>
		</div>
					</div>
	
<input type="hidden" id="medis_id" value="<?php echo $id; ?>">
																<input type="hidden" id="dokter_id" value="<?php echo $data['DOKTER']; ?>">
																<input type="hidden" id="medis_filter" >
	<div class="col-md-6 wrap"  style="height:700px" >
	<?php
	
			$sql5="SELECT  * FROM RS_PERIKSA WHERE TRX_ID  = '$id' ";
$stmt5 = sqlsrv_query( $conn, $sql5 , $params);
$data5=sqlsrv_fetch_array($stmt5,SQLSRV_FETCH_ASSOC);
?>
						<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase"> PEMERIKSAAN</span>
								<span class="caption-helper"></span>
							</div>
							
						</div>
						
						<div class="portlet-body">						
<textarea id="pemeriksaan" cols="15" rows="12" style=" resize: horizontal;" readonly><?php echo "-Subyektif    : ".$data5['SUBYEKTIF']."  \n-Obyektif     : ".$data5['OBYEKTIF']." Obyektif \n * Vital Signs   :\n       TD   :  ".$data5['TENSI']." mmHg \n        N    : ".$data5['NADI']."  x/menit  \n       RR   : ".$data5['RESP']." x/menit  \n        S    :  &deg C \n    Nyeri  :  nyeri \n       BB   :  ".$data5['BB']." KG \n       TB   :  ".$data5['TB']."  CM \n- Assesment :  ass \n- Planing/Terapi : ".$data5['PLANING'];
					?></textarea>
						
						</div>
					</div>
					
									<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">TINDAKAN</span>
								<span class="caption-helper"></span>
							</div>
							<!--
							<div class="actions" style="padding :6px 0 1px 0;">
								<div class="btn-group">
									<button class="btn green" id="salintindakan" >
									Gunakan Tindakan
									</a>
								
								</div>
							</div>
							-->
						</div>
						<div class="portlet-body">
							<div  data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
							<span id="tindakan" style="overflow:hidden; width:auto;height:auto;">
<?php 	
$sql_tindakan="select NOTE,TINDAKAN_ID,seq_no FROM  RS_MEDIS_TINDAKAN WHERE MEDIS_ID='$id'";								
$stmt = sqlsrv_query( $conn, $sql_tindakan ,array(),array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$hit  = sqlsrv_num_rows($stmt);
if($hit > 0){
	echo"<ol>";
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
								echo"<li>".$data['NOTE']."</li>";
}
echo"</ol>";
}
								?>							
							</span>
							</div>
						</div>
					</div>
									<div class="portlet portlet-sortable light bg-inverse">
									
									<?php
									$sql_status="select STATUS_ANTRI FROM  RS_PASIEN_MEDIS WHERE MEDIS_ID='$id'";	
							$stmt = sqlsrv_query( $conn, $sql_status ,array());
							$data_s=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)
									?>
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">DIAGNOSA (ICDX)</span>
								<span class="caption-helper"></span>
							</div>
							<?php if($data_s['STATUS_ANTRI']!='2'){
								?>
							<div class="actions" style="padding :6px 0 1px 0;">
								<div class="btn-group">
									<button class="btn green"  onClick="salindiagnosa();">
									Gunakan Diagnosa 
									</a>
								
								</div>
							</div>
							<?
							}
							?>
						</div>
						<?php
							$diag="select ps,diagnosa, penyakit_id, seq_no from rs_diagnosa where diagnosa_id = '$id' order by PS desc, seq_no";
$diagn = sqlsrv_query($conn,$diag,array());

?>
						<div class="portlet-body">
							<div  data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
							<div id="diagnosa" style="overflow:hidden; width:auto;height:auto;"><?php 
								echo"<ol>";
 while($data_diag=sqlsrv_fetch_array($diagn,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data_diag['diagnosa']."</li> ";
  }echo"</ol>";
						
  ?>
</div>	
							</div>
						</div>
					</div>
					
			<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">PROCEDURE (ICD9CM)</span>
								<span class="caption-helper"></span>
							</div>	<?php if($data_s['STATUS_ANTRI']!='2'){
								?>
							<div class="actions" style="padding :6px 0 1px 0;">
								<div class="btn-group">
									<button class="btn green"  onClick="salinprocedure();"id="" >
									Gunakan Procedure
									</button>
								
								</div>
							</div>
							<?
							}
							?>
						</div>
						<?php
$pros="SELECT a.NAMa, A.ICD9,A.ID FROM rs.RS_PROCEDURE_PASIEN AS A where A.TRX_ID = '$id' order by A.ID";
$prose = sqlsrv_query($conn,$pros,array());
						?>
						<div class="portlet-body">
							<div  data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
							<span  style="overflow:hidden; width:auto;height:auto;">
								<ol id="procedure" ><?php
 while($data_pros=sqlsrv_fetch_array($prose,SQLSRV_FETCH_ASSOC)){
	  echo "<li>".$data_pros['NAMa']."</li> ";
  }
  ?></ol></span>
							</div>
						</div>
					</div>
			<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">LABORATORIUM</span>
								<span class="caption-helper"></span>
							</div>
							
						</div>
						<!--
						<div class="actions" style="padding :6px 0 1px 0;">
								<div class="btn-group">
									<button class="btn green" id="salinprocedure" >
									Gunakan Laboratorium
								
								</div>
							</div>
							-->
						<div class="portlet-body">
							<div  data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
							<span id="laboratorium" style="overflow:hidden; width:auto;height:auto;">
							
							</span>
							</div>
						</div>
					</div>
	
		<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">RESEP</span>
								<span class="caption-helper"></span>
							</div>
							<?php if($data_s['STATUS_ANTRI']!='2'){
								?>
							<div class="actions" style="padding :6px 0 1px 0;">
								<div class="btn-group">
									<button class="btn green" onClick="salinresep();">
									Gunakan Resep
								</button>
								</div>
							</div>
							<?
							}
							?>
						</div>
						
						<div class="portlet-body">
					
							<div  data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
							<textarea id="resep" cols="70" rows="8" readonly></textarea>
							</div>
						</div>
					</div>
									<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase">RADIOLOGI</span>
								<span class="caption-helper"></span>
							</div>
							
						</div>
						<div class="portlet-body">
							<div  data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
							<span id="radiologi" style="overflow:hidden; width:auto;height:auto;">
							
							</span>
							</div>
						</div>
					</div>
	</div>
<?php if($data_s['STATUS_ANTRI']!=2){
		
	?>
	<div class="col-md-3 wrap">
	
							<div class="form-group">
										<label class="control-label col-md-12" style="text-align:left;">Subyektif
										</label>
										<div class="col-md-12">
<textarea class="form-control" style="height:70px;" placeholder="Input Pemeriksaan" id="edit_subyektif"><?php echo $data5['SUBYEKTIF']; ?></textarea>
										
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-md-12" style="text-align:left;">Obyektif
										</label>
										<div class="col-md-12">
<textarea class="form-control" style="height:70px;" placeholder="Input Pemeriksaan" id="obyektif"><?php echo $data5['OBYEKTIF']; ?></textarea>
										</div>
										
									</div>
									<div style="height:20px;"></div>
									<div class="form-group">
										<div class="col-md-12">
									<table class="table table-striped table-hover">
									<tr><th colspan="6"> Vital Sign</th></tr>
									<tr>
									<td>Tensi</td><td>	<input type="text"  id="edit_tensi" class="small" value="<?php echo $data5['TENSI']; ?>" ></td><td>mmHg</td>
									<td>BB</td><td ><input type="text" value="<?php echo $data5['BB']; ?>"  id="edit_bb" class="small" style="width:80px;" ></td><td width="30%">KG</td>
									</tr>
									<tr>
									<td>Suhu</td><td><input type="text" class="small" id="edit_suhu" value="<?php echo $data5['SUHU']; ?>"  ></td><td>C</td><td> TB</td><td><input type="text"  id="edit_tb" class="small" style="width:80px;" value="<?php echo $data5['TB']; ?>" ></td><td>CM</td>
									</tr>
									<tr>
									<td>Nadi</td><td><input type="text" class="small" id="edit_nadi" value="<?php echo $data5['NADI']; ?>" ></td><td>X/Menit</td><td>Nyeri</td><td><input type="text" class="small"  id="edit_nyeri" style="width:80px;" value="<?php echo $data5['NYERI']; ?>" ></td><td>1-10	</td>
									</tr>
									<tr>
									<td>Resp</td><td><input type="text" class="small"  id="edit_resp" value="<?php echo $data5['RESP']; ?>" ></td><td>X/Menit</td><td colspan="3"></td>
									</tr>
									</table>
									</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-12" style="text-align:left;">Planing/Terapi
										</label>
										<div class="col-md-12">
<textarea class="form-control" style="height:70px;" placeholder="Input Pemeriksaan" id="planning"></textarea>
										</div>
										
									</div>
								
<div class="form-group">
										<label class="control-label col-md-5">DIAGNOSA
										</label>
										<div class="col-md-12">
									
										<div class="input-group input-large">
											 <input type="text" onKeyUp="diagnosa(this.value);" name="kode_rekening" id="input_diagnosa" class="form-control"  placeholder="Masukkan Data Diagnosa"   id="kode" size="15" autocomplete="off" /> 
				  	<span class="input-group-btn" >
											<button class="btn green" type="button" data-toggle="modal"  id="tambahdiagnosa">Tambah</button>
											</span>
											<input type="hidden"  id="pasien_id">
				  </div>
				   <div class="suggestionsBox1" id="suggestions2" style="display: none;">
				   <div class="suggestionList" id="suggestionsList2"> &nbsp; </div>
				    <button id="closediagnosa" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
										</div>
								
										<table class="table table-striped table-bordered table-advance table-hover" style="margin-left:16px; width:400px;">
									<tr>
									<thead>
									<tr>
									<th>DIAGNOSA</th><th style="width:50px;">ICD 9</th>
									</tr>
									</thead>
									<tbody id="data_diagnosa">
								<?php 
$diagn = sqlsrv_query($conn,$diag,array());
while($data=sqlsrv_fetch_array($diagn,SQLSRV_FETCH_ASSOC)){
								echo"<tr style='cursor:pointer'  onClick=hapus_diagnosa(\"".addslashes($id)."\",".$data['seq_no'].");><td>$data[diagnosa]</td><td>$data[penyakit_id]</td></tr>";
}
								?>
									</tbody>
									</table>
									
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-5">PROCEDURE 
										</label>
										<div class="col-md-12">
									
										<div class="input-group input-large">
											 <input type="text" onKeyUp="suggest(this.value);" name="kode_rekening" id="input_prosedur" class="form-control"  placeholder="Masukkan Data Prosedur"   id="kode" size="15" autocomplete="off" /> 
				  	<span class="input-group-btn">
											<button class="btn green" type="button" data-toggle="modal"  id="tambahprocedure">Tambah</button>
											</span>
											<input type="hidden"  id="pasien_id">
				  </div>
				   <div class="suggestionsBox" id="suggestions" style="display: none;">
				   <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
				    <button id="closeprocedure" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
									
										
										</div>
															
					<table class="table table-striped table-bordered table-advance table-hover" style="margin-left:16px;  width:400px;">
									<tr>
									<thead>
									<tr>
									<th>PROSEDURE</th><th style="width:50px;">ICD 9</th>
									</tr>
									</thead>
									<tbody id="data_procedure">
								<?php 
$prose = sqlsrv_query($conn,$pros,array());						
while($data_pros=sqlsrv_fetch_array($prose,SQLSRV_FETCH_ASSOC)){
								echo"<tr style='cursor:pointer'  onClick=hapus_procedure(\"".addslashes($id)."\",".$data_pros['ID'].");><td>$data_pros[NAMa]</td><td>$data_pros[ICD9]</td></tr>";
}
								?>
									</tbody>
									</table>
									</div>
			
									<div class="form-group">
										<label class="control-label col-md-5">TINDAKAN
										</label>
										<div class="col-md-12">
											<div class="radio-list" style="margin-left:20px;">
											<label class="radio-inline">
											
										<input type="radio" name="optionsRadios" id="optionsRadios4" value="dokter" checked>Dokter </label>
											<label class="radio-inline">
										<input type="radio" name="optionsRadios" id="optionsRadios5" value="perawat">Perawat</label>
											
										</div>
										</div>
										<div class="col-md-12">
									
										<div class="input-group input-large">
											 <input type="text" onKeyUp="tindakan(this.value);" name="kode_rekening" id="cari_tindakan" class="form-control" autocomplete="off" placeholder="Masukkan Tindakan Dokter/Perawat"  id="kode" size="15"/> 
				  	                    <span class="input-group-btn">
										<!--
											<button class="btn green" type="button" data-toggle="modal"  id="tambahtindakan">Tambah</button>-->
											</span>
											<input type="hidden"  id="pasien_id">
				                        </div>
				   <div class="suggestionsBox" id="suggestions1" style="display: none;">
				   <div class="suggestionList" id="suggestionsList1"> &nbsp; </div>
				   <button id="closetindakan" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div>
										</div>
										
										<table class="table table-striped table-bordered table-advance table-hover" style="margin-left:16px; width:400px;">
									<tr>
									<thead>
									<tr>
									<th>TINDAKAN </th><th>ID</th>
									</tr>
									</thead>
									<tbody id="data_tindakan">
								<?php 	
$stmt = sqlsrv_query( $conn, $sql_tindakan ,array());
while($data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
								echo"<tr style='cursor:pointer' onClick=hapus_tindakan(\"".addslashes($id)."\",".$data['seq_no'].");><td>".$data['NOTE']."</td><td>".$data['TINDAKAN_ID']."</td></tr>";
}
								?>
									</tbody>
									</table>
									</div>
									<div class="form-group">
									<div class="col-md-12">
								<table class="table">
							
								<tr><th colspan="4">Tulis Resep</th></tr>
								<tr>
								<th>Nama Obat Dan Dosis</th>
								<td colspan="3"><input type="text" class="form-control" id="nama_obat" onKeyUp="obat(this.value);">
							</td>	</tr>
				   	<tr>
					<td></td><td colspan="3">	  <div class="suggestionsBox3" id="suggestions3" style="display: none;margin-top:60px;">
				   <div class="suggestionList3" id="suggestionsList3"> &nbsp; </div>
				   <button id="closeobat" class="btn red remove" style="float:right;" type="button">Close</button>
				   </div></td>
					</tr>
								<tr>
								<th>Jumlah</th>
								<td><input type="text" id="jumlah_obat" class="form-control" ></td>	<th>Aturan Pakai</th><td><input type="text" id="aturan_pakai" class="form-control" ></td>
								</tr>
								<tr>
								<th>Catatan</th><td colspan="2"><input type="text" id="catatan" class="form-control" ></td><td >
									<button class="btn green" type="button" data-toggle="modal"  id="add">Tambah</button></td>
								</tr>
<tr><td colspan="3">
<?php
	$sql6="SELECT  RESEP FROM RS_ANTRI_RESEP WHERE RESEP_ID  = '$id' ";
$stmt6 = sqlsrv_query( $conn, $sql6 , $params);
$data6=sqlsrv_fetch_array($stmt6,SQLSRV_FETCH_ASSOC);
?>
<textarea class="AppendedContainer" cols="50" rows="15" id="edit_resep"><?php echo $data6['RESEP']; ?></textarea>
		<script>
		var i = 1;
var inpt = $('#catatan').val();
var text = $('#jumlah_obat').val();
var resep = $('#edit_resep').val();

$('#add').click(function() {

	if ( $('#nama_obat').val() == '' ){
		alert('The field is empty');
	}
	else {
		if (i > 5 ) {
			alert('You just can input 5 Contents');
		}
		else {
if(resep!=''){
	$('.AppendedContainer').append('\n R/' + $('#nama_obat').val() +':   '+$('#jumlah_obat').val()+    '  \n     ' + $('#aturan_pakai').val() +''+$('#catatan').val()+'\n__________________________\n');
}else{
	$('.AppendedContainer').append('R/' + $('#nama_obat').val() +':   '+$('#jumlah_obat').val()+    '  \n     ' + $('#aturan_pakai').val() +''+$('#catatan').val()+'\n__________________________\n');
}
			$('#catatan').val('');
			$('#jumlah_obat').val('');
                $('#nama_obat').val('');
				    $('#aturan_pakai').val('');
			i++;
			return false;
		} 
	}
});

$(document).on('click', '#remove' , function() {
	$('.AppendedContent' ).remove();

	return false;
});
		</script>
									</div>

</td>
</tr>
	</table>	

	</div>
	<div class="modal-footer">
	<button type="button" class="btn red" id="selesai">
												<i class="fa fa-paper-plane-o"></i>
												<div>
													SELESAI
												</div></button>
										</div>	
																			<?
}
?>
	</div>
		<!--
	<div class="row">
<div class="col-md-9">

	<div class="portlet-body" style="padding-left:15px;">
												<button class="icon-btn" data-toggle="modal" onclick="GetPemeriksaan(2)">
												<i class="fa fa-group"></i>
												<div>
													Entry Pemeriksaan
												</div>
											
												</button>
												<a href="javascript:;" class="icon-btn">
												<i class="fa fa-barcode"></i>
												<div>
													Lihat File Scan
												</div>
												
												</a>
												
											
												
											</div>
										
	
	</div>

	</div>	-->

	<div id="static2" class="bootbox modal fade in" data-backdrop="static"  aria-hidden="true" style="margin-top:90px;">

								<div class="modal-dialog" style="width:650px;">
									<div class="modal-content" style="height:150px;">
										<div class="modal-header" >
											<button type="button" class="close" onclick="Close(0)" aria-hidden="true"></button>
											<h4 class="modal-title"></h4>
										</div>
										<div class="modal-body">
										1. Tekan Yes Untuk Menandai Pasien Yang Sudah Di periksa. <br>
										2. Tekan No Untuk Menandai Pasien Yang Belum Selesai Diperiksa(Data Masih Bisa Diedit).<br>
										3. Tekan Cancel Untuk Tidak Jadi Keluar.
														<div class="modal-footer">
											<button type="button"  class="btn red" onclick="option(2)">Yes</button>
											<button type="button" class="btn yellow" id="add_alergi" onclick="option(3)">No</button>
											<button type="button" data-dismiss="modal" class="btn green" id="add_alergi">Cancel</button>
										</div>	
													</div>
													</div>
													</div>
													</div>
	<?
}

?>
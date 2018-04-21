<?php
include"../../inc/inc.koneksi.php";
include"../../inc/library.php";
include"../../inc/fungsi_indotgl.php";
$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$pasien_id=$_GET['pasien_id'];
$sql="SELECT
NAME,
NO_RM,
CONVERT(VARCHAR(15),TGL_LAHIR,	106) AS TGL_LAHIR
FROM
RS_PASIEN where PASIEN_ID='".$pasien_id."'
";
?>
<style>
body{
	
	font-size :11px;
}
table {
		
	font-size :14px;
}
table tr td {
	padding-left :40px;
	padding-bottom :30px;
	font-weight:600;
	font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
}
</style>
<?php
echo"<body>";
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
echo "<table>";
for($k=1;$k<=7;$k++){
echo"<tr>";
for($i=1;$i<=4;$i++){
echo "<td><span>".$data['NO_RM']." </span><span style='float:right;'>".$data['TGL_LAHIR']."</span><BR>".$data['NAME']."</td>";
}
echo"</tr>";
}
echo"</table>";
echo"</body>";
?>
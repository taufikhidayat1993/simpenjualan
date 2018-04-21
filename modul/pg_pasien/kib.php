  <?php
  include"../../inc/inc.koneksi.php";
include"../../inc/umur.php";
include"../../inc/library.php";
include"../../inc/cek_rm.php";
include"../../inc/fungsi_indotgl.php";
  ?>
  <script type="text/javascript" src="js/connectcode-javascript-code39ascii.js"></script>
  <body OnLoad="window.print()" >
<div style="width:8.4cm;height:5.2cm;font-family:calibri;"  >

<div style="margin-top:2.65cm;">
<div style="width:8.2cm;height:42px;">
<div id="barcodecontainer" style="width:1.8in;float:right">
<div id="barcode" ><?php echo $_GET['no_rm']; ?></div>
</div>
</div>
<?php
$sql="SELECT 
NO_RM,
NAME,
ADDRESS,
 CONVERT(VARCHAR(11),TGL_LAHIR,120) AS TGL_LAHIR
FROM
RS_PASIEN WHERE NO_RM='$_GET[no_rm]'";
$params = array();
$options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
$data=sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_ASSOC);
?>
<div style="padding-left:5px; font-size:12pt">
<strong><?php echo $data['NAME'];?></strong>
</div>

<div style="padding-left:5px; font-size:8pt">
<strong>
<?php echo $data['ADDRESS']; ?><br>
TTL: <?php echo tgl_indo2($data['TGL_LAHIR']); ?>
</strong>
</div>
</div>
</div>
</body>
<script type="text/javascript">
/* <![CDATA[ */
  function get_object(id) {
   var object = null;
   if (document.layers) {
    object = document.layers[id];
   } else if (document.all) {
    object = document.all[id];
   } else if (document.getElementById) {
    object = document.getElementById(id);
   }
   return object;
  }
get_object("barcode").innerHTML=DrawHTMLBarcode_Code39ASCII(get_object("barcode").innerHTML,1,"yes","in",0,3,1,3,"bottom","center","","black","white");
/* ]]> */
</script>
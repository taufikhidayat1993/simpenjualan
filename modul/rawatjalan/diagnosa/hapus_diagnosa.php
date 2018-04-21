<?php
include "../../../inc/inc.koneksi.php";

$IDdiagnosa= $_POST['IDdiagnosa'];
$seq_no= $_POST['seq_no'];

//--- query delete diagnosa pasien di RS_DIAGNOSA
$deletediagnosa = "DELETE
FROM
	rs.RS_DIAGNOSA
WHERE
	DIAGNOSA_ID = '$IDdiagnosa'
AND SEQ_NO = '$seq_no'
";
sqlsrv_query($conn,$deletediagnosa);

//--- query delete diagnosa pasien di RS_MEDICAL_RECORD


$deletemedicalrecord = "DELETE
FROM
	rs.RS_MEDICAL_RECORD
WHERE
	DIAGNOSA_ID = '$IDdiagnosa'
AND SEQ_NO = '$seq_no'
";
sqlsrv_query($conn,$deletemedicalrecord);

?>

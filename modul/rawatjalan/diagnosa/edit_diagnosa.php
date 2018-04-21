<?php
session_start();
include '../../../inc/inc.koneksi.php';
include "../../../inc/fungsi_tanggal.php";
//include '../../../auth.php';

$IDdiagnosa		=$_POST['IDdiagnosa'];
$seq_no				=$_POST['seq_no'];
$dokter				=$_POST['dokter'];
$IDpenyakit		=$_POST['IDpenyakit'];
$diagnosa			=$_POST['diagnosa'];
$anamnesa			=$_POST['anamnesa'];
$tgl					=jin_date_sql($_POST['tgl']);
$IDpasien 		=substr($IDdiagnosa,0,12);
$IDuser				=$_SESSION['username'];
$IDdokter			=$_POST['IDdokter'];


// --------edit data diagnosa ke RS_DIAGNOSA
$editdiagnosa = "UPDATE rs.RS_DIAGNOSA SET
DIAGNOSA='$diagnosa',
DR_ID='$IDdokter',
DT_DIAGNOSA='$tgl',
PENYAKIT_ID='$IDpenyakit',
NOTE='$anamnesa',
MODIBY='$IDuser',
MODIDATE=GETDATE()
WHERE
DIAGNOSA_ID='$IDdiagnosa' AND SEQ_NO='$seq_no'";

sqlsrv_query($conn,$editdiagnosa);

/* --------EDIT data diagnosa ke RS_MEDICAL_RECORD */
$editmedicalrecord = "UPDATE rs.RS_MEDICAL_RECORD SET
DATA_MEDIS='$diagnosa',
NOTE='$anamnesa',
DT_RECORD='$tgl',
DR_ID='$IDdokter',
MODIBY='$IDuser',
MODIDATE=GETDATE()
WHERE
DIAGNOSA_ID='$IDdiagnosa' AND SEQ_NO='$seq_no' AND PASIEN_ID='$IDpasien'";

sqlsrv_query($conn,$editmedicalrecord);
?>

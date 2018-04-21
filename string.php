<?PHP

$data = "31200801211455000100093408000002";
$hasilan=strlen($data);
$kodeBagian = substr($data, $hasilan-2, $hasilan);
$satu = substr($data, 0, $hasilan-2);
$bulan = substr($data, 6, 2);
$tanggal = substr($data, 8, 2);
$jam = substr($data, 10, 2);
$menit = substr($data, 12, 2);
$keterangan = substr($data, 14, 4);
$kodeKary = substr($data, 18, 10);
$kodePresensi = substr($data, 28, 4);

echo $satu."-".$kodeBagian;

$kalimat1="Saya sedang makan";
$kalimat2="Sayasedangmakan";
$hasil1=strlen($kalimat1);
$hasil2=strlen($kalimat2);
echo "Jumlah karakter 1: $hasil1";
echo "Jumlah karakter 2: $kalimat2";
echo"<br>";
?>
<?php
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$folder="../share245/imgrekammedis/Rekam Medis/";
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Ymd");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$jam_sekarang1 = date("H:i");
$kodetanggal  = date("dmY");
$jam = date("H:i");
$numeric_date=date("G"); 
$tgl_sekarang1 = date("d/m/Y");
$tgl_sekarang2 = date("Y-m-d");
$time = date("Y-m-d H:i:s");
$bln = date("m-Y");
$med= date("Ymd");
$jam1= date("Hi");
$format = "		<div class='col-md-2' >	<span class='helper'>(mm/dd/yyyy) </span></div>";
$format2 = "		<div class='col-md-3' >	<span class='helper'>(mm/dd/yyyy) </span></div>";
$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");					
	function ubahformatTgl($tanggal) {
        $pisah = explode('/',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$urutan);
        return $satukan;
    }
function hari($tanggal){
		$day = date('D', strtotime($tanggal));
    $dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
                    );

echo $dayList[$day];
	}
			  function ubahformatTgl1($tanggal) {
        $pisah = explode('/',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$urutan);
        return $satukan;
    }
	
			  function ymd($tanggal) {
        $pisah = explode('/',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$urutan);
        return $satukan;
    }
	function tgl_time($tanggal) {
        $pisah = explode(' ',$tanggal);
		 $pisah1 = explode('/',$pisah[0]);
        $urutan = array($pisah1[2],$pisah1[1],$pisah1[0]);
        $satukan = implode('-',$urutan);
        return $satukan." ".$pisah[1];
    }
		function tgl_time2($tanggal) {
        $pisah = explode(' ',$tanggal);
		 $pisah1 = explode('-',$pisah[0]);
        $urutan = array($pisah1[2],$pisah1[1],$pisah1[0]);
        $satukan = implode('-',$urutan);
        return $satukan." ".$pisah[1];
    }
		  function tanggalku($tanggal) {
        $pisah = explode('/',$tanggal);
       	$urutan = array($pisah[2],$pisah[0],$pisah[1],);
        $satukan = implode('-',$urutan);
		  }
		function tglku($tanggal) {
        $pisah = explode('-',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('/',$urutan);
        return $satukan;
    }
	
		function tglku2($tanggal) {
        $pisah = explode('-',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('/',$urutan);
        return $satukan;
    }
	function jumlah_hari($bulan=0, $tahun=0) {
	$bulan = $bulan > 0 ? $bulan : date("m");
	$tahun = $tahun > 0 ? $tahun : date("Y");
	switch($bulan) {
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
			return 31;
			break;
		case 4:
		case 6:
		case 9:
		case 11:
			return 30;
			break;
		case 2:
			return $tahun % 4 == 0 ? 29 : 28;
			break;
	}
}
function left($str, $length) {
     return substr($str, 0, $length);
}
 
function right($str, $length) {
     return substr($str, -$length);
}

function create($str, $length) {
	    $left = substr($str, 0, $length);
		$right = substr($str, -$length);
		 return $right."/".$left;
}

function indikator($str) {
	
	$data ='<table colspan="4" style="font-size:11px;">
						<tr>
						<td width="15" style="background-color:green;"></td>	<td>Pasin Baru</td>	<td width="15"  style="background-color:#FF8000;" #FF8000></td>	<td>Pasien Kontrol 2</td>
						</tr>
						<tr>
						<td  style="background-color:#36C2BB;"></td>	<td>Data Tidak Lengkap</td>	<td style="background-color:#FF80FF;"></td>	<td>SKDP</td>
						</tr>
						<tr>
						<td style="background-color:red;"></td>	<td>Pasien Alergi</td>	<td style="background-color:#00FFFF;"></td>	<td>SEP Sudah Di Cetak</td>
						</tr>
						<tr>
						<td style="background-color:yellow;"></td>	<td>Pasien Kontrol 1</td>	<td style="background-color:#0E62ED;"></td>	<td>Berkas RM Siap</td>
						</tr>
						</table>';
						
						return $data;
}
function th($th) {
	$data ='  <thead>

      
									<th >
										No. RM
									</th>
									<th  >
										 NAMA PASIEN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</th>
									<th >
										 ALAMAT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</th>
									</th>
									<th  >
										TIPE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</th>
									<th   >
										TGL MASUK
									</th>
									<th>
										 POLIKLINIK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</th>
									<th   >
										 DOKTER &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</th>
									<th>
										 NO ANTRI
									</th>
									<th>
										 NO RUJUKAN
									</th>
								
   </thead>';
   return $data;
}
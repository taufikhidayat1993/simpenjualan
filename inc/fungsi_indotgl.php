<?php
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}
	function tgl_indo2($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulana(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}
	function bt($tgl){
		    $pisah = explode('-',$tgl);
          	$bulan = getBulan($pisah[1]);
			$tahun = $pisah[0];
			return $bulan.' '.$tahun;		 
	}
	function bt1($tgl){
		    $pisah = explode('-',$tgl);
          	$bulan = getBulan($pisah[0]);
			$tahun = $pisah[1];
			return $bulan.' '.$tahun;		 
	}
	function buta($tgl){
		    $pisah = explode('-',$tgl);
          	$bulan = getBulan($pisah[0]);
			$tahun = $pisah[1];
			return $bulan.' '.$tahun;		 
	}
	function tglhari($tgl){
		 $pisah = explode(' ',$tgl);
	$tanggal=tgl_indo($pisah[0]);
    $satukan = implode('-',$urutan);
	$day = date('D', strtotime($pisah[0]));
    $dayList = array(
	'Sun' => 'Minggu',
	'Mon' => 'Senin',
	'Tue' => 'Selasa',
	'Wed' => 'Rabu',
	'Thu' => 'Kamis',
	'Fri' => 'Jumat',
	'Sat' => 'Sabtu'
);
echo $dayList[$day].",".$tanggal."Jam :".$pisah[1] ;
	}
	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
				function getBulana($bln){
				switch ($bln){
					case 1: 
						return "JANUARI";
						break;
					case 2:
						return "FEBRUARI";
						break;
					case 3:
						return "MARET";
						break;
					case 4:
						return "APRIL";
						break;
					case 5:
						return "MEI";
						break;
					case 6:
						return "JUNI";
						break;
					case 7:
						return "JULI";
						break;
					case 8:
						return "AGUSTUS";
						break;
					case 9:
						return "SEPTEMBER";
						break;
					case 10:
						return "OKTOBER";
						break;
					case 11:
						return "NOVEMBER";
						break;
					case 12:
						return "DESEMBER";
						break;
				}
			} 
			
?>

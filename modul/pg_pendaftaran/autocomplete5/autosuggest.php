<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "test";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
$conn = mysqli_connect($server, $username, $password, $database) or die("Connection failed: " . mysqli_connect_error());
	
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];
			  $pisah = explode(',',$queryString );
			if(strlen($queryString) >3) {

				$query = mysql_query("SELECT nama_rekening,kode_rekening FROM tabel_master WHERE kode_rekening LIKE '%$pisah[0]%' and nama_rekening like '%$pisah[1]%'");
				
				if($query) {
				echo '<ul>';
					while ($result = mysql_fetch_array($query)) {
	         			echo '<li onClick="fill(\''.addslashes($result[nama_rekening]).'\'); fill2(\''.addslashes($result[kode_rekening]).'\');">'.$result[kode_rekening].'&nbsp;&nbsp;'.$result[nama_rekening].'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	
?>
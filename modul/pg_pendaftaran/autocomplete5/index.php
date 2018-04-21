<script type="text/javascript" src="jquery.js"></script>
<script>
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >2) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			}
		});
	}
}

function fill(thisValue) {
	$('#nama').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fill2(thisValue) {
	$('#kode').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

</script>

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
	left: 0px;
	top:0px;
	margin: 26px 0px 0px 0px;
	width: 200px;
	padding:0px;
	background-color:#999999;
	border-top: 3px solid #999999;
	color: #fff;
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
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
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
</style>



<html>
<head><title>Suggest AutoComplete -- Ri32.Wordpress.Com</title></head>
<body onLoad="document.postform.elements['keterangan_transaksi'].focus();">
<div class="post">
	<h2>&raquo;Jurnal Umum</h2>
	<div class="entry">
		<p>

		<form action="index.php" method="post" name="postform">
		  <table width="503" border="0">
			</tr>
			<tr>
			  <td>Keterangan</td>
			  <td colspan="2"><input type="text" value="<?php echo $_POST['keterangan_transaksi'];?>" name="keterangan_transaksi" size="45"/></td>
			</tr>
			<tr>
			  <td>Jumlah (Rp)</td>
			  <td colspan="2"><input type="text" name="jumlah_dk" size="15"/></td>
			</tr>
			<tr>
			  <td>Nomor Rekening</td>
			  <td width="90">
			  <div id="suggest">
				   <input type="text" onKeyUp="suggest(this.value);" name="kode_rekening"  onBlur="fill2();" id="kode" size="15"/> 
				   <div class="suggestionsBox" id="suggestions" style="display: none;">
				   <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
				   </div>
			  </div>
			  </td>
			  <td width="234" align="left"><input type="text" disabled="disabled" name="nama_rekening" onBlur="fill();" id="nama"  size="30"/></td>
			</tr>
			<tr>
			  <td>Posisi</td>
			  <td colspan="2"><select name="posisi">
				<option value="debet">Debet</option>
				<option value="kredit">Kredit</option>
			  </select></td>
			</tr>
			<tr>
			  <td><input type="submit" onClick="return confirm('Apakah Anda yakin?')" value="Simpan" name="simpan"></td>
			  <td colspan="2">&nbsp;</td>
			</tr>
		  </table>
		</form>
		<br />
		
		
		<?php
		//untuk menyimpan transaksi
		if(isset($_POST['simpan'])){

			echo $keterangan_transaksi=ucwords($_POST['keterangan_transaksi']);
			echo "<br>";
			echo $jumlah=$_POST['jumlah_dk'];
			echo "<br>";
			echo $kode_rekening=$_POST['kode_rekening'];
			echo "<br>";
			echo $posisi=ucwords($_POST['posisi']);
		
		}else{
			unset($_POST['simpan']);
		}
		?>

		</p>
	</div>
</div>
</body>
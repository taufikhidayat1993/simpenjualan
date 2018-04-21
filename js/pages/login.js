$(document).ready(function() {
	
	$("#tombollogin").click(function() {
	
		var aksilogin = $("#frmlogin").attr('action');
		var datalogin = {
			username: $("#username").val(),
			password: $("#password").val()
		};
		
		$.ajax({
			type: "POST",
			url: aksilogin,
			data: datalogin,
			success: function(aksi)
			{
				if(aksi == '1')
					$("#frmlogin").slideUp('slow', function() {
						$("#hasil").html("<p class='berhasil' align='center'>Anda Berhasil Login<br><i class='ace-icon fa fa-spinner fa-spin orange bigger-125'></i><meta http-equiv='refresh' content='2; url=media.php?module=home'></p>");
					});
				else
					$("#frmlogin").slideUp('slow', function() {
						$("#hasil").html("<p class='gagal' align='center'>Username atau Password salah...!!! <br> <a onClick=buka(); style='cursor:pointer;'>Ulangi Lagi<a></p>");	
					});
				document.frmlogin.username.value = "";
				document.frmlogin.password.value = "";
			}
		});
		return false;
	});
	function buka()
{
	$('#frmlogin').slideDown();
}



});
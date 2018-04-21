  
  <script src="js/jquery.js"></script>
	<script>
		$(document).ready(function() {
		$("#tambah").bind("click", function(event) {
			var url = "page/pg_jabatan/crud.php?op=tambah";
			var update_nama_jabatan = $("#nama_jabatan").val();
			var id = $("#hidden_user_id").val();
			var opsi = $("#opsi").val();
			if(update_nama_jabatan==''){				
		    alert("Nama jabatan Harus Diisi");
			$("#nama_jabatan").focus();                     
			} else {
					$.post(url,
					{
						id: id, 
						update_nama_jabatan: update_nama_jabatan,
						opsi: opsi
						} ,	function (data, status) { 
						
							$("#nama_jabatan").val("");
							$("#nama_jabatan").focus();
						            
      dataTable.draw()
		
			});
			}
	
		});
		});
	</script>
	
	<!-- Core js functions -->
	
  <link rel="stylesheet" type="text/css" href="css/StyleCalender.css"> 



 <form class="form-horizontal" action="#">

                                        <div class="control-group">
                                            <label class="control-label" for="normal">Nama Jabatan</label>
                                            <div class="controls controls-row">
                                                <input class="span12" type="text" id="nama_jabatan">
                                            </div>
                                        </div>

                                      
										  <div class="form-actions">
                                            <button type="button" class="btn btn-primary" id="tambah">Tambah</button>
                                    
                                        </div>
                                      
										</form>
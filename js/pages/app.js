$(document).ready(function() {
	$("#jenis").change(function(){
    var id = $("#jenis").val();	
    $.ajax({
        url:"page/pg_ajukankasbon/crud.php",
        data:"op=detailbank&id="+id,
                            cache:false,
                            success:function(msg){
							$("#jenis_bank").val("aku");
                            }
                        });
	
	 
});
	
	
});
<?php
function lain($id,$place) {
	
	echo"<textarea class='form-control'  id='$id' placeholder='$place'></textarea>";
	
}
	function radiologi($nama,$right,$id,$name) {	
		echo"<li>
								<div class='col1'>					
								     <input type='checkbox' id='$id'   value='".$nama."' name='".$name."'/> ".$nama."
								</div>";
								if($right=="yes"){
								echo "<div class='col2'>
								<div  style='float:right;'>
								<div class='col1'>	
								 <input type='checkbox' id='".$id."L'  value='L' name='".$name."'/> L /
								  <input type='checkbox' id='".$id."R' value='R' name='".$name."'/> R 
								</div>
								
								  </div>
								</div>";
								}else if($right=="input"){
									echo "<div class='col2'>
								<div  style='float:right;'>
								<input type='text' id='text_".$id."' placeholder='...................................'>
								
								  </div>
								</div>";
								}
								echo"
							</li>";	  
			  
	}
	function javascript($id){		
	echo '$("'.$id.'L,'.$id.'R").bind("click", function() {
        if($(this).is(":checked")) {
	      $("'.$id.'").attr("checked",true);
		}
  });
$("'.$id.'").bind("click", function() {
		 if($(this).is(":checked")) {
		}else{
		   $("'.$id.'L,'.$id.'R").attr("checked",false);			
		}
});	 '; 
	}
?>
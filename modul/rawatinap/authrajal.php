<?php
	//Strat Session
//	session_start();

	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['username']) || ($_SESSION['password'])==''){
		header('location:access_denied.php');
		exit();
	}
?>

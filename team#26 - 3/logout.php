<?php
header("location:/healthCare");
	session_start();
	session_unset();
	session_destroy();
	
?>
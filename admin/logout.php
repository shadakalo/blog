<?php
	 session_start();
	 session_destroy();
	 unset($_SESSION['login']);
	 unset($_SESSION['userid']);
	 unset($_SESSION['role']);
	 unset($_SESSION['username']);
	 echo "<script>window.location='index.php';</script>"; 
?>
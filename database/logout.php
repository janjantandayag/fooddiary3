<?php
	session_start();
	session_unset($_SESSION['loggedIn'],$_SESSION['userId'],$_SESSION['name']); 
	session_destroy(); 	
   	$_SESSION['detail'] = [];
	echo "<script>
		alert('Logged out successfully!');
		window.location = '../index.php';
	  </script>";
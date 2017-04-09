<?php
	session_start();
	$id = $_GET['id'];	
	unset($_SESSION['detail']['entry'][$id]);
	$newArray = array_values($_SESSION['detail']['entry']);
	$_SESSION['detail']['entry'] = $newArray;
	echo "<script>window.location.href='../entry-list.php';</script>";
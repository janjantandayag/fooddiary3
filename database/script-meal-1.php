<?php
	session_start();
	$_SESSION['detail']['posX'] = $_GET['posX'];
	$_SESSION['detail']['posY'] = $_GET['posY'];
	$_SESSION['detail']['deg'] = $_GET['deg'];
	$_SESSION['detail']['emotionId'] = $_GET['emotionId'];
	$_SESSION['detail']['date'] = $_SESSION['date'];
	$_SESSION['detail']['dateAdded'] = date("Y-m-d H:i:s");
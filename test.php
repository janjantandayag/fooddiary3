<?php
	session_start();
	$time = "1:02 PM";
	echo date("H:i",strtotime($time)); 

		// $time = date("H:i:00", strtotime('11:20 PM'));
		// $date = $_SESSION['detail']['date'].' '.$time;
		// var_dump($date);
	// var_dump($_SESSION['detail']['dateAdded']);
	// var_dump($_SESSION['detail']['date']);
	// var_dump(date("Y-m-d H:i:s"));
	// var_dump($_SESSION['detail']['entry']);
	// var_dump($_SESSION['detail']);



	// $img45 = $_FILES["deg45"]["tmp_name"];
	// $img90 = $_FILES["deg90"]["tmp_name"];

	// $_SESSION['item']['name'] = $_POST['foodName'];
	// $_SESSION['item']['serving'] = $_POST['servingSize'];
	// $_SESSION['item']['description'] = $_POST['description'];
	// $_SESSION['item']['deg45'] =  file_get_contents($img45);
	// $_SESSION['item']['deg90'] =  file_get_contents($img90);

	// array_push($_SESSION['detail']['entry'], $_SESSION['item']);



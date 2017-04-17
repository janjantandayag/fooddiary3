<?php
	session_start();
	include('connection.php');

	$userId = $_SESSION['userId'];
	$emotionId = $_SESSION['detail']['emotionId'];
	$mealId = $_SESSION['detail']['mealType'];
	$posX = $_SESSION['detail']['posX'];
	$posY = $_SESSION['detail']['posY'];	
	$deg = $_SESSION['detail']['deg'];
	$dateAdded = date("Y-m-d H:i:s");
	$insertIntoEntry = mysqli_query($conn, "INSERT INTO entries(user_id,emotion_id,meal_id,date_added,entry_angle,xCoor,yCoor) VALUE($userId,$emotionId,$mealId,'$dateAdded','$deg',$posX,$posY)");

	$entryId=mysqli_insert_id($conn);		
	$dateEaten = $_SESSION['detail']['date'];
	for($i=0;$i<count($_POST['srcs']);$i++){
		  $photo = str_replace('data:image/jpeg;base64,','',$_POST['srcs'][$i]);
		  $name = mysqli_real_escape_string($conn,strtolower($_POST['names'][$i]));
		  $serving = mysqli_real_escape_string($conn,strtolower($_POST['sizes'][$i]));
		  $description = mysqli_real_escape_string($conn,strtolower($_POST['descriptions'][$i]));
		  $time = date("H:i",strtotime($_POST['times'][$i]));
		  $dateTimeEaten = $dateEaten.' '.$time;
		  $insertItem = mysqli_query($conn, "INSERT INTO item(entry_id,food_name,food_description,serving_size,photo,date_eaten) VALUE($entryId,'$name','$description','$serving','$photo','$dateTimeEaten')");
	}

  var_dump(count($src));







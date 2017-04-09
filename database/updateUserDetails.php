<?php
	session_start();
	include('connection.php');
	$id = $_SESSION['userId'];
	$first_name = mysqli_real_escape_string($conn,strtolower($_GET['firstName']));
	$last_name  = mysqli_real_escape_string($conn,strtolower($_GET['lastName']));
	$gender = strtolower($_GET['gender']);
	$birthday = $_GET['birthday'];	
	$_SESSION['name'] = $first_name;
	$query = mysqli_query($conn, "UPDATE users SET first_name = '$first_name', last_name = '$last_name' , gender='$gender',date_of_birth='$birthday' WHERE users.user_id = $id");
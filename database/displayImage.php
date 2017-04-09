<?php
	include ('connection.php');
	$id = $_GET['itemId'];
	$queryImage = mysqli_query($conn, "SELECT * from item WHERE item_id=$id");
	while($result = mysqli_fetch_assoc($queryImage)){
		header('Content-Type: image/jpeg');
		echo $result['photo'];	
	}
?>
<?php
	session_start();
	$_SESSION['test'] = $_FILES['photo']['tmp_name'];

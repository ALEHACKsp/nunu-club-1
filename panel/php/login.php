<?php
	session_start();

	//connect to database
	$C = mysqli_connect("localhost", "root", "root", "youtube");

	//search database
	$stmt = $C->prepare("SELECT * FROM users WHERE username=? AND password=PASSWORD(?) LIMIT 1");
	$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
	$stmt->execute();
	$stmt->store_result();

	if($stmt->num_rows === 1) {
		$_SESSION['verified'] = true;
		echo "true";
	}
	else {
		echo "false";
	}

	$stmt->close();
	$C->close();
?>
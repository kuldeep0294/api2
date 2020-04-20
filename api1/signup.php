<?php

// Include confi.php
include_once('confi.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data
	$name = isset($_POST['name']);
	$email = isset($_POST['email']) ;
	$password = isset($_POST['pwd']);
	$status = isset($_POST['status']);

	// Insert data into data base
	$sql = "INSERT INTO `users` (`name`, `email`, `password`, `status`) VALUES ('$name', '$email', '$password', '$status')";
	 //echo $sql;  exit;
	$qur = mysqli_query($conn,$sql);
	if($qur){
		$json = array("status" => 1, "msg" => "Done User added!");
	}else{
		$json = array("status" => 0, "msg" => "Error adding user!");
	}
}else{
	$json = array("status" => 0, "msg" => "Request method not accepted");
}

@mysqli_close($conn);

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json); 
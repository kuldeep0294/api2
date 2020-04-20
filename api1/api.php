<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tuts_rest";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);
$request_method=$_SERVER['REQUEST_METHOD']; 
if ($request_method == 'POST') {
	$sql = "INSERT INTO `users` (`name`,`email`,`phone`,`subject`,`message`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['subject']."','".$_POST['message']."')";
	$result = mysqli_query($conn,$sql);	
	if ($result == true) {
		$response=array("message" => "successfully inserted");
	}
	else{
		$response=array("message" => "failed insertion");
	}
}
elseif ($request_method == 'GET') {
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$where = "WHERE `id`=".$id;
	}
	else{
		$id = 0;
		$where = "";
	}
	$sql="SELECT * FROM `users`".$where;
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
		while ( $data=mysqli_fetch_assoc($result)) { 
			$response[] = array("name" => $data['name'],"email" => $data['email'],"phone" => $data['phone'],"subject" => $data['subject'],"message" => $data['message']);	
		}
	}
	else{
		$response=array("message" => "no data to display");
	}
}
elseif ($request_method == 'DELETE') {
	if ($_GET['id']) {
		$sql="DELETE FROM `users` WHERE `id` = '".$_GET['id']."'";
		$result=mysqli_query($conn,$sql);
		if ($result == true) {
			$response=array("message" => "successfully deleted");
		}
		else{
			$response=array("message" => "failed to delete");
		}
	}
}
elseif ($request_method == 'POST') {

	$sql = "UPDATE `users` SET `name`='".$_POST['name']."',`email` = '".$_POST['email']."',`phone` = '".$_POST['phone']."',`subject` = '".$_POST['subject']."',`message` = '".$_POST['message']."' WHERE `id` ='".$_GET['id']."' ";
	$result = mysqli_query($conn,$sql);	
	if ($result == true) {
		$response=array("message" => "successfully updated");
	}
	else{
		$response=array("message" => "failed to update");
	}
}
else{
	echo "Request method not accepted";
}
echo json_encode($response);
?>
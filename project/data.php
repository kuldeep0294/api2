<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$token="123456789";
//var_dump($_POST); exit;
$data = array("secret_key" => "1234", "site" => "mysite.com",'name' =>$_POST['name'],'email' =>$_POST['email'],'phone' =>$_POST['phone'],'subject' =>$_POST['subject'],'message' =>$_POST['message']);
$data_string = json_encode($data);
$request_type="read";
$url = 'http://localhost/api/'.$request_type.'.php?name='.$request_type;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer ' . $token,
	'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

  //$json_result = json_decode($result, true);
?>
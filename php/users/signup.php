<?php
include_once("./user.php");
$data = file_get_contents("php://input");
$userData = json_decode($data);
$newUser= new user($userData->userName,$userData->password,$userData->userEmail,$userData->userPhone
	,$userData->birthDate);
$userId=$newUser -> addUser();
if($userId!=false)
{
	session_start();
	$_SESSION['userId']=$userId;
	echo "success";
	exit();
}
else
{
	if (isset($_SESSION['userId'])) {
		unset($_SESSION['userId']);
	}
	
	echo "failure";
	exit();
}




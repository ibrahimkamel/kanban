<?php

include_once("./user.php");

$data = file_get_contents("php://input");

$loginData = json_decode($data);

$email = $loginData->userEmail;
$password = $loginData->password;
$userId=user::loginUser($email,$password);
if($userId!=false)
{
	session_start();
	$_SESSION['userId']=$userId;
	//header('HTTP/1.1 200 OK', true, 200);
	echo "success";
}
else
{
	if (isset($_SESSION['userId']))
	 {
		unset($_SESSION['userId']);
	}
	
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	echo "failure";
}

//var_dump($varLogin);

// creating user session with user id 

// session_start();

// $_session ["userId"]=$varLogin;

// print_r($_session ["userId"]);

//
<?php 
include_once("./user.php");
session_start();
if(!isset($_SESSION["userId"])){
	echo "failure";
	exit();
}

$data = file_get_contents("php://input");
$userData = json_decode($data);
$editUser= new user($userData->userName,$userData->password,$userData->userEmail,$userData->userPhone,$userData->birthDate);
if($editUser->updateUser($_SESSION["userId"]))
{
	echo "success";
}
else
{
	echo "failure";
}


?>
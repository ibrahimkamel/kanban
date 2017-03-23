<?php
include_once("./user.php");
session_start();
if(!isset($_SESSION["userId"])){
	echo "failure";
	exit();
}
//echo $_SESSION["userId"];
$userData = user::selectUser($_SESSION["userId"]);
//echo $userData;
$userJson = json_encode($userData);
echo $userJson ;
   

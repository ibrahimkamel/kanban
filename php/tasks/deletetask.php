<?php
include_once('./Task.php');
session_start();
if(!isset($_SESSION["userId"])){
	echo "failure";
	exit();
}
$data_string = file_get_contents("php://input");
$data_object=json_decode($data_string);
echo $data_object;
$task1=new Task($_SESSION["userId"]);
$task1->deleteTask($data_object);
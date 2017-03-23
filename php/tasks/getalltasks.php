<?php
include_once('./Task.php');
session_start();
if(!isset($_SESSION["userId"])){
	echo "failure";
	exit();
}

//echo $_SESSION['userId'];
$task3=new Task($_SESSION["userId"]);
$rows=$task3->getAllTasks();

$jsonrows=json_encode($rows);
echo $jsonrows;
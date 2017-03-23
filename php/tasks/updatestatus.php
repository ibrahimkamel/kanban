<?php

	include_once('./Task.php');

session_start();
if(!isset($_SESSION["userId"])){
	echo "failure";
	exit();
}
$data_string = file_get_contents("php://input");
$data_object = json_decode($data_string);


 $task2=new Task($_SESSION['userId']);
 $task2->updateStatus($data_object->status,$data_object->taskId);

//$task1->updateStatus("inprogress",10);

 
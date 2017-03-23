<?php
	include_once('./Task.php');		
	$data_string = file_get_contents("php://input");
	$data_object = json_decode($data_string);
	session_start();
	if(!isset($_SESSION["userId"])){
		echo "failure";
		exit();
	}

 	$task2 = new Task($_SESSION["userId"]);
 	// print_r($data_object);
 	$task2->editTask($data_object->taskID,$data_object->taskName,$data_object->taskDescription,$data_object->taskDue,$data_object->taskStatus,$data_object->taskPriority);


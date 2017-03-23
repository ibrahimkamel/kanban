<?php
include_once('./Task.php');
session_start();
if(!isset($_SESSION["userId"])){
	echo "failure";
	exit();
}

$data_string = file_get_contents("php://input");
$data_object=json_decode($data_string);
$task1=new Task($_SESSION["userId"],$data_object->name,$data_object->Desc,$data_object->dueDate,$data_object->status,$data_object->priority);
$task1->addTask();
echo "done";
// $task1=new Task(1,"task1","yalla bena nel3ab","2017-12-30","todo","1");
// $task1->addTask();
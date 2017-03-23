<?php
/**
* 

*/
include_once("../functions.php");
class Task
{
	private $taskName,$taskDescription,$taskDueDate,$taskStatus,$taskId,$taskPriority,$userId, $res;
	// eb2o shelo el userid 3lshan  
	function __construct($userId,$taskName="",$taskDescription="",$taskDueDate="",$taskStatus="",$taskPriority="")
	{
		$this->taskName=$taskName;
		$this->taskDescription=$taskDescription;
		$this->taskDueDate=$taskDueDate;
		$this->taskStatus=$taskStatus;
		$this->taskPriority=$taskPriority;
		$this->userId=$userId;	
	}
	public function getAllTasks()
	{
		if(!isset($this->userId)){
			echo "must pass userId";
			return;
		}
		$sql="select * from task where taskOwnerID={$this->userId} order by taskPriority desc , taskDue";
		//echo $sql;
		$link=connectToDatabase();
		if (!$link)
		{
    			die("Connection failed: " . mysqli_connect_error());
		}
		if ($query=mysqli_query($link, $sql))
		{
			$rows = array();
			while ( $row=mysqli_fetch_assoc($query)) {
				$rows[]=$row;
			}
			return $rows;
    		// print_r(mysqli_fetch_assoc($query));
    		// echo "el mafrod fe while looop";
		}
		else
		{
   			 echo "Error: " . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
	public function validate()
	{
		$error=[];
		$statusArray=['todo', 'inprogress', 'testing', 'done'];
		$priorityArray=['1', '2', '3'];
		if(!isset($this->taskName)||trim($this->taskName)=="")
		{
			$error["taskName"]="can`t be empty";
		}
		else
		{
			if(strlen($this->taskName)>45)
			{
					$error["taskName"]="exceed maximum lenght";
			}
		
		}
		if(!isset($this->taskDescription)||trim($this->taskDescription)=="")
		{
			$error["taskDescription"]="can`t be empty";
		}
		else
		{
			if(!strlen($this->taskDescription)>200)
			{
					$error["taskDescription"]="exceed maximum lenght";
			}
		
		}
		if(!isset($this->taskDueDate)||trim($this->taskDueDate)=="")
		{
			$error["taskDueDate"]="can`t be empty";
		}
		else
		{
			if(!validateDate($this->taskDueDate))
			{
					$error["taskDueDate"]="invalid date format";
			}
		
		}
		if(!isset($this->taskStatus)||trim($this->taskStatus)=="")
		{
			$error["taskStatus"]="can`t be empty";
		}
		else
		{
			if(!in_array($this->taskStatus,$statusArray))
			{
					$error["taskStatus"]="invalid value";
			}
		
		}
		if(!isset($this->taskPriority)||trim($this->taskPriority)=="")
		{
			$error["taskPriority"]="can`t be empty";
		}
		else
		{
			if(!in_array($this->taskPriority,$priorityArray))
			{
					$error["taskPriority"]="invalid value";
			}
		
		}
		if(!isset($this->userId)||trim($this->userId)=="")
		{
			$error["userId"]="unknown user id ";
		}
		if(!empty($error))
		{
			return $error;
		}
		else
		{
			return true;
		}

		//$error["taskName"]=isset($this->taskName)?:"can`t be null";
		//$error["taskDescription"]=isset($this->taskDescription)?:"can`t be null";
		//$error["taskDueDate"]=isset($this->taskDueDate)1?"can`t be null";
		//$error["taskStatus"]=isset($this->taskStatus)?:"can`t be null";
		//$error["taskPriority"]=isset($this->taskPriority)?:"can`t be null";
		//$error["userId"]=isset($this->userId)?:"can`t be null";
		
		
		//$error["taskName"]=strlen($this->taskName)<=45?:"exceed maximum lenght";
		//$error["taskDescription"]=strlen($this->taskDescription)<=200?:"exceed maximum lenght";
		
		//todo check if it is a date
		//$error["taskDueDate"]=strlen($this->taskDueDate)?:"invalid date format";
		
		//$error["taskStatus"]=in_array($this->taskStatus,$statusArray)?:"invalid value";
		//$error["taskPriority"]=in_array($this->taskPriority,$priorityArray)?:"invalid value";
		//$error["userId"]=strlen($this->userId)?:"exceed maximum lenght";
		
	}
	public function  addTask()
	{
		if(is_array($this->validate()))
		{
			print_r($this->validate());
			return ;
		}

		$sql="insert into task (taskName,taskDescription,taskPriority,taskStatus,taskDue,taskOwnerID)
		values ('{$this->taskName}','{$this->taskDescription}','{$this->taskPriority}','{$this->taskStatus}','{$this->taskDueDate}',{$this->userId})";
		//echo $sql;
		$link=connectToDatabase();
		if (!$link)
		{
    			die("Connection failed: " . mysqli_connect_error());
		}
		if (mysqli_query($link, $sql))
		{
    		echo "New record created successfully";
		}
		else
		{
   			 echo "Error: " . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
	public function deleteTask($taskId)
	{
		$this->taskId=$taskId;
		$sql="delete from task where taskOwnerID = {$this->userId} and taskID = {$this->taskId} ;";
		//echo $sql;
		$link=connectToDatabase();
		if (!$link)
		{
    			die("Connection failed: " . mysqli_connect_error());
		}
		if (mysqli_query($link,$sql))
		{
			echo "{$this->taskName} deleted successfully";
		}
		else
		{
   			 echo "Error: " . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
	public function  editTask($taskId,$taskName,$taskDescription,$taskDueDate,$taskStatus,$taskPriority){

		$this->taskName = $taskName;
		$this->taskDescription = $taskDescription;
		$this->taskDueDate = $taskDueDate;
		$this->taskStatus = $taskStatus;
		$this->taskPriority = $taskPriority;
		//$this->userId=$userId;
		$this->taskId = $taskId;
		if(is_array($this->validate()))
		{
			print_r($this->validate());
			return ;
		}
		$link = connectToDatabase ();
		$sql= "update task set taskName='$this->taskName ' ,taskDescription='$this->taskDescription' 	,taskDue='$this->taskDueDate'
				,taskPriority='$this->taskPriority',taskStatus='$this->taskStatus'
				 where taskOwnerID=$this->userId and taskId=$this->taskId";
		$link=connectToDatabase();
		if (!$link) {
    		die("Connection failed: " . mysqli_connect_error());
		}

		if (mysqli_query($link,$sql)) {
			$res = array("status" => true, "msg" => "{$this->taskName} edited successfully");
		} else {
			$res = array("status" => false, "msg" => "mysqli_error($link");
		}
		echo json_encode($res);
		mysqli_close($link);
	}
	public function updateStatus($taskStatus,$taskId)
	{
		$this->taskStatus=$taskStatus;
		$this->taskId=$taskId;
		$sql="update task set taskStatus='{$this->taskStatus}' where taskOwnerID = {$this->userId} and taskID = {$this->taskId}";
		echo $sql;
		$link=connectToDatabase();
		if (!$link)
		{
    			die("Connection failed: " . mysqli_connect_error());
		}
		if (mysqli_query($link,$sql))
		{
			echo "{$this->taskName} status updated successfully";
		}
		else
		{
   			 echo "Error: " . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
	
}



// $task1=new Task(1,"task1","yalla bena nel3ab","2017-12-30","todo","1");
// $task1->addTask();

// $task3=new Task(1);
// $task3->deleteTask(23);


// $task3=new Task(1);
// print_r(json_encode($task3->getAllTasks()));


//$task1->updateStatus("inprogress",10);

 
 // $task2=new Task(1);
 // $task2->editTask(23,"das","deuscr","2017-12-30","done","2");


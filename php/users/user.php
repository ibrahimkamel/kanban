<?php
include_once("../functions.php");

 class user {
     
  	private $userID;
  	private $userName; 
  	private $password;
  	private $userEmail; 
  	private $userPhone; 
  	private $birthDate;

    //connect data base in constructor

	public function __construct($userName,$password,$userEmail,$userPhone,$birthDate){

		$errors = $this->validate($userName, $password,
	 		$userEmail, $userPhone, $birthDate);

		 
  		if (!isset($errors['userName'])){
			$this->userName = $userName;
		}

  		if (!isset($errors['password'])){
			$this->password = $password;
		}


  		if (!isset($errors['userEmail'])){
			$this->userEmail = $userEmail;
		}

  		if (!isset($errors['userPhone'])){
			$this->userPhone =$userPhone;
		}
			 
  		if (!isset($errors['birthDate'])){
			$this->birthDate = $birthDate;
		}
		// echo "<pre>";
		// print_r($errors);
		// echo "</pre>";

		// print_r($userData);
	}
	public static function loginUser($userEmail,$password){
		//echo "invalid user name or password";
		//$this->userEmail=$userEmail;
		//$this->password=$password;
		$link = connectToDatabase();

		$selectUser = "SELECT userID FROM user WHERE userEmail = '$userEmail' AND password = 
		'$password'";

		$res = mysqli_query($link, $selectUser);
		//$student = [];
		while($rec = mysqli_fetch_assoc($res)){
			if(sizeof($rec) > 0){
				// echo "logged in ";	 
				$userId= $rec['userID'];
				return $userId;
			}

		}
		//echo "invalid user name or password";
		return false;
}

public static function selectUser($id){
		//echo "invalid user name or password";
		//$this->userEmail=$userEmail;
		//$this->password=$password;
		$link = connectToDatabase();

		$selectUser = "SELECT * FROM user WHERE userID= '$id'";

		$res = mysqli_query($link, $selectUser);
		$rec = mysqli_fetch_assoc($res);
		
		return $rec;
}

	private function validate($userName, $password, $userEmail, $userPhone, $birthDate){
		
		$errors = [];
		if(!isset($userName)&&trim($userName)!="")
		{
			$errors['userName']='username is Empty';
		}
		if(!isset($password)&&trim($password)!="")
		{
			$errors['userName']='password is Empty';
		}
		if(!isset($userEmail)&&trim($userEmail)!="")
		{
			$errors['userName']='Email is empty';
		}

		
		if(!isset($errors['userName'])){
			if(strlen($userName)>45){
				$errors['userName']= "maximum length is 45 char"; 
			}
			elseif(!preg_match("/^[a-zA-Z_ ]*$/",$userName)) {
				$errors['userName']= "user name should only contain charchters, underscores or spaces";
			}
		}
				
		if(!isset($errors['userEmail'])){
			if(strlen($userEmail)>45){
				$errors['userEmail'] = "maximum length is 45 char";
			}
			elseif(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
				$errors['userEmail'] = "invalied Email";
			}
		}
		
		if(!isset($errors['password'])){
			if(strlen($password)>25){
				$errors['password'] = "maximum length is 25 char";
			}
		}
		
		if(!preg_match("/^[0-9]{11,11}$/", $userPhone)) {
		 	$errors['userPhone'] = "phone Number should contain 11 digits";
		}
		
		if(!validateDate($birthDate)){
			$errors['birthDate'] = "Data Format should be YYYY-MM-dd";
		}
		// foreach ($errors as $key => $value) {
		// 	if($value===false){
		// 		unset($value);
		// 	}
		// }
		//print_r($errors);
		return $errors;
	}

 	public function addUser () { // hy5odha mna l form 
		if(isset($this->userName) &&isset($this->userEmail) && isset($this->password)){
			$link = connectToDatabase();
			$addUser ="insert into user set userName='".$this->userName."',userEmail='".$this->userEmail."',userPhone='".$this->userPhone.
		             "',birthDate='".$this->birthDate."', password='".$this->password."';";
		     
			$addUserRes = mysqli_query($link, $addUser);

		    if($addUserRes){
		    	//echo user::loginUser($this->userEmail,$this->password);
			 	return user::loginUser($this->userEmail,$this->password);
			}else{
			 	//echo mysqli_error($link);
			 	return false;
			}

		}
		else
		{
			return false;
		}
	}
	 
	public function updateUser($userID) 
	{
		if(isset($this->userName) &&isset($this->userEmail) && isset($this->password))
		{
			$link = connectToDatabase ();
			 
			$updateUser = "UPDATE user SET userName = '$this->userName', password = '$this->password', userEmail = '$this->userEmail', userPhone = '$this->userPhone', birthDate = '$this->birthDate' WHERE userID = '$userID'";
			$res = mysqli_query($link, $updateUser);
		 
			 if($res){
			 	return true;
			}else{
			 	echo mysqli_error($link);
			 	return false;
			} 
		}
		else
			{
				// echo "msh haynfa3 updateeeeeeeeeee";
				return false;
			}
	}
}

//$user1=new user();

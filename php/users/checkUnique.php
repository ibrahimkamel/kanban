<?php
include_once("../functions.php");

function checkEmailIsUnique ($email){
	$link = connectToDatabase();

	$selectEmail = "select userEmail from user where  userEmail ='".$email."';";
	$query = mysqli_query($link, $selectEmail);

	while($rec = mysqli_fetch_assoc($query)){
		if (count ($rec) > 0){ 
			//echo "no";
			return false;
		}
	}
	return true;
}

function checkPhoneIsUnique ($phone){
	$link = connectToDatabase();

	$selectPhone = "select userPhone from user where userPhone ='".$phone."';";
	$query = mysqli_query($link, $selectPhone);

	while($rec = mysqli_fetch_assoc($query)){ 
		if (count ($rec) > 0){ 
			return false ;
		} 
	}
	return true;
}



echo checkEmailIsUnique("rtammam@gmail.coma")?"ahmed":"mohamed";
echo checkPhoneIsUnique("155523")?"ahmed":"mohamed";

<?php 
session_start();

if (isset($_SESSION['userId'])){

	 	unset($_SESSION['userId']);
		//session_destroy();
		echo "Log out successfully";
	}
else{
	echo "Log out failed";
}

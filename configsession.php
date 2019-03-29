<?php
    require __DIR__.'/config.php';
    require __DIR__.'/class_firebase_Auth.php';
    $AuthFirebase = new AuthFirebase();
	//session_start();
	
	if(!(isset($_SESSION["user"]) && !empty($_SESSION["user"])))
	{
		$_SESSION['error']="Invalid Access";
		header("Location: index.php");
	}
	else
	{
		$userdata=$AuthFirebase->getUserData($_SESSION["user"]['uid']);
		$userdata=(array)$userdata;
		
		//print_r((array)$userdata);die;
		if(!(isset($userdata["uid"]) && !empty($userdata["uid"])) || $userdata["disabled"]==1)
		{
			unset($_SESSION["user"]);
			$_SESSION['error']="Invalid User Details";
			header("Location: index.php");
		}
		
	}
	
?>
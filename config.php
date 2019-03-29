<?php
    require __DIR__.'/vendor/autoload.php';
    require __DIR__.'/class_firebase.php';
    use Kreait\Firebase\Factory;

	use Kreait\Firebase\ServiceAccount;
    $SBFirebase = new SBFirebase();
	session_start();
	$error="";
	$success="";
	if(isset($_SESSION["error"]) && !empty($_SESSION["error"]))
	{
		$error=$_SESSION["error"];
		unset($_SESSION["error"]);
	}
	else if(isset($_SESSION["success"]) && !empty($_SESSION["success"]))
	{
		$success=$_SESSION["success"];
		unset($_SESSION["success"]);
	}
	
?>
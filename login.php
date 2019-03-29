<?php
    require __DIR__.'/config.php';
    require __DIR__.'/class_firebase_Auth.php';

 
	$AuthFirebase = new AuthFirebase();
	if(isset($_POST['name']) && $_POST['password'])
	{
		$email=$_POST['name'];
		$password=$_POST['password'];
		$userlist=$AuthFirebase->ValidateUser($email,$password);
		if(is_object($userlist))
		{
			$userlist=(array)$userlist;
			if($userlist['disabled']!=1)
			{
				$_SESSION['success']="User logged in successfully";
				
				$_SESSION['user']['uid']=$userlist['uid'];
				$_SESSION['user']['email']=$userlist['email'];
				header("Location: register_user.php");
			}
			else
			{
				$_SESSION['error']="This user is disabled";
				header("Location: index.php");
				
			}
			
			
		}
		else
		{
			$_SESSION['error']="Invalid Username or Password";
			header("Location: index.php");
		}
	}
	else
	{
		header("Location: index.php");
	}
	//print_r($userlist);
?>
   
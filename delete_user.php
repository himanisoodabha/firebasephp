<?php
    require __DIR__.'/configsession.php';


    if (isset($_GET['userId'])) {
      
       $result=$AuthFirebase->removeUser($_GET['userId']);
	   
	   
	   if($result=="true")
	   {
		   $_SESSION['success']="User removed Successfully";
	   }
	   else
	   {
		   $_SESSION['error']="No User Found!!";
	   }
	  header("Location: register_user.php"); 
	  exit;
    }
	else
		header("Location: register_user.php"); 

?>

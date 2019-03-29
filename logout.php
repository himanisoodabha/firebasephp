<?php
    require __DIR__.'/configsession.php';
	
	unset($_SESSION['user']);
    $_SESSION['success']="User logged out Successfully";

   header("Location: index.php"); 

?>
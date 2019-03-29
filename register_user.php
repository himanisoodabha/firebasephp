<?php
    require __DIR__.'/configsession.php';


    if (isset($_POST['submit'])) {
       $name = $_POST['name'];
       $email = $_POST['email'];
       $password = $_POST['password'];
       $phone = $_POST['phone'];
       $userId=$AuthFirebase->addUser($email,$phone,$password,$name);
	   if(is_object($userId))
	   {
		   $_SESSION['success']="User Added Successfully";
	   }
	   else
	   {
		   $_SESSION['error']=$userId;
	   }
	  header("Location: register_user.php"); 
	  exit;
    }
	else
	{
		$userlist=$AuthFirebase->listUsers();
?>

    <!DOCTYPE html>
    <html>
    <head>
       <title>Firebase Demo</title>
    </head>
    <body>
       <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
       <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
       <!-- Include the above in your HEAD tag -->
       <div class="container">
           <div class="row">
               <div class="col-md-6 col-md-offset-3">
			   <?php if(!empty($error)){ ?>
					<div class="alert alert-danger">
					  <?= $error; ?>
					</div>
					<?php }else if(!empty($success)){ ?> 
					<div class="alert alert-success">
					  <?= $success; ?>
					</div>
					<?php } ?>
                   <div class="well well-sm">
                       <form class="form-horizontal" action="register_user.php" method="post">
                           <fieldset>
                               <legend class="text-center">Register User <div class="pull-right"><a href="logout.php" ><img src="img/logout.png" style="height:24px" /></a></div></legend>
                               <!-- Name input-->
							   
                               <div class="form-group">
                                   <label class="col-md-3 control-label" for="name">Name</label>
                                   <div class="col-md-9">
                                       <input id="name" name="name" type="text" placeholder="Your name" required class="form-control">
                                   </div>
                               </div>
                               <!-- Email input-->
                               <div class="form-group">
                                   <label class="col-md-3 control-label" for="email"> E-mail</label>
                                   <div class="col-md-9">
                                       <input id="email" name="email" type="text" placeholder="E-mail" pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" required class="form-control" title="Please Enter a valid Email Id" >
                                   </div>
                               </div>
							   <!-- Phone input-->
                               <div class="form-group">
                                   <label class="col-md-3 control-label" for="phone">Phone Number</label>
                                   <div class="col-md-9">
                                       <input id="phone" name="phone" type="text" placeholder="Phone Number" class="form-control" pattern="[+ 0-9]{14}" required>
                                   </div>
                               </div>
							   <!-- Password input-->
                               <div class="form-group">
                                   <label class="col-md-3 control-label" for="password">Password</label>
                                   <div class="col-md-9">
                                       <input id="password" name="password" type="password" placeholder="Password" class="form-control" pattern=".{6,}" required >
                                   </div>
                               </div>
							   <!-- Password input-->
                               <div class="form-group">
                                   <label class="col-md-3 control-label" for="password">Confirm Password</label>
                                   <div class="col-md-9">
                                       <input id="confpassword" name="confpassword" type="password" placeholder="Confirm Password" class="form-control" pattern=".{6,}" required >
                                   </div>
                               </div>
                               <!-- Form actions -->
                               <div class="form-group">
                                   <div class="col-md-12 text-right">
                                       <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                                   </div>
                               </div>
                           </fieldset>
                       </form>
                   </div>
               </div>
           </div>
		   <div class="row">
				<div class="col-md-8 col-md-offset-2">
				<div class="table-responsive">
				   <table  class="table">
				   <thead>
				   <tr>
				   <th>Name</th>
				   <tH>Phone</th>
				   <tH>Email</th>
				   <tH>Status</th>
				   <tH>Action</th>
				   </tr>
				   </thead>
				   <?php
				   if(count($userlist)>1)
				   {
				      foreach($userlist as $user)
					  {
						  if($user['uid']!=$_SESSION["user"]['uid'])
						  {
				   ?>
						<tr>
							<td><?= isset($user["displayName"])?$user["displayName"]:""; ?></td>
							<td><?= isset($user['phoneNumber'])?$user['phoneNumber']:""; ?></td>
							<td><?= isset($user['email'])?$user['email']:""; ?></td>
							<td><?= isset($user['disabled']) && !empty($user['disabled'])?"Inactive":"Active"; ?></td>
							<td><a href="delete_user.php?userId=<?= $user['uid']; ?>" ><img src="img/delete.png" style="height:24px" /></a></td>
					    </tr>
				   <?php
						  }
					  }
				   }
				   ?>
				   </table>
				</div>
		   </div>
		   </div>
       </div>
	   
	   <script>
		var password = document.getElementById("password")
		  , confirm_password = document.getElementById("confpassword");

		function validatePassword(){
		  if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords Don't Match");
		  } else {
			confirm_password.setCustomValidity('');
		  }
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	   </script>
    </body>
    </html>
	
	<?php
	}
	
	?>
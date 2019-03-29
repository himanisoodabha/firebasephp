<?php
    require __DIR__.'/config.php';

	
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
                       <form class="form-horizontal" action="login.php" method="post">
                           <fieldset>
                               <legend class="text-center">Login</legend>
                               <!-- Name input-->
                               <div class="form-group">
                                   <label class="col-md-3 control-label" for="name">Email Id</label>
                                   <div class="col-md-9">
                                       <input id="name" name="name" type="text" placeholder="Email Id"   pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*"" required class="form-control" title="Please Enter a valid Email Id ">
                                   </div>
                               </div>
                               <!-- Email input-->
                               <div class="form-group">
                                   <label class="col-md-3 control-label" for="email">Password</label>
                                   <div class="col-md-9">
                                       <input id="password" name="password" type="password" pattern=".{6,}" required  placeholder="Password" class="form-control">
                                   </div>
                               </div>
							   
                               <!-- Form actions -->
                               <div class="form-group">
                                   <div class="col-md-12 text-right">
                                       <button type="submit" name="submit" class="btn btn-primary btn-lg">Login</button>
                                   </div>
                               </div>
                           </fieldset>
                       </form>
                   </div>
				  
				   
               </div>
           </div>
		   <!--<div class="row">
				<div class="col-md-8 col-md-offset-2">
				   <table width="100%">
				   <thead>
				   <tr>
				   <th>Name</th>
				   <tH>Phone</th>
				   <tH>Email</th>
				   <tH>Message</th>
				   </tr>
				   </thead>
				   <?php
				      /*foreach($userlist as $user)
					  {
						  //print_r($user["name"]);
				   ?>
						<tr>
							<td><?= isset($user["name"])?$user["name"]:""; ?></td>
							<td><?= isset($user['phone'])?$user['phone']:""; ?></td>
							<td><?= isset($user['email'])?$user['email']:""; ?></td>
							<td><?= isset($user['message'])?$user['message']:""; ?></td>
					    </tr>
				   <?php
					  }*/
				   ?>
				   </table>
				</div>
		   </div>-->
       </div>
    </body>
    </html>
	
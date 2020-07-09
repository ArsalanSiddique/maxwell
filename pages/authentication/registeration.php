<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../../css/bootstrap.css" />
	<link rel="stylesheet" href="../../css/password.css">		
	<link rel="stylesheet" href="../../css/style.css" />
</head>
<body>
	<div class="wrapper">
		<div class="container">
			<?php
			
				if(isset($_REQUEST["msg"])) {
					if($_REQUEST["msg"] == "incorrect_pwd") {
						echo '<div class="alert alert-danger alert-dismissible col-lg-4 pull-right fade in" style="margin-top:15px;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Warning!</strong> Password not matched.
						</div>';
					}
					else if($_REQUEST["msg"] == "uName_exist") {
						echo '<div class="alert alert-danger alert-dismissible col-lg-4 pull-right fade in" style="margin-top:15px;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Warning!</strong> User name exist, try another.
						</div>';
					}
					else if($_REQUEST["msg"] == "mail_exist") {
						echo '<div class="alert alert-danger alert-dismissible col-lg-4 pull-right fade in" style="margin-top:15px;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Warning!</strong> Account already exist.
						</div>';
					}else {
						
					}
				}
			
			?>
			<div class="row">
				<div class="col-lg-4 sign_up">
					<form method="post" action="../../php/authentication/register.php" class="form-group">
						<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						  <input type="text" class="form-control input" name="name" placeholder="Your Name" required="required"/>
						</div><br />
						
						<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						  <input type="mail" class="form-control input" name="email" placeholder="Email" required="required" />
						</div><br />
						<!-- <div class="dropdown">
						  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Role
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
						    <li value="admin"><a href="#">Admin</a></li>
						    <li value="manager"><a href="#">Manager</a></li>
						    <li value="teacher"><a href="#">Teacher</a></li>
						    <li value="student"><a href="#">Student</a></li>
						  </ul>
						</div> -->
						<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						  <input type="password" class="form-control input" id="default" name="pass" placeholder="Password" required="required" />
						</div><br />
						
						<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						  <input type="password" class="form-control input" name="repass" placeholder="Confirm Password" required="required" />
						</div><br />
						
						<div class="input-group" style="margin-top:10px;">
							<input type="checkbox" name="remember" id="" class="form-control pull-left" style="margin-left:26px;width:25px;margin-top:-1px;" required="required" /><span style="margin-left:10px;">I accept the terms of use & policy</span><br/>
						</div>
						<input type="submit" name="register" id="" class="btn btn-lg btn-primary" style="" value="Sign Up" />		
					</form>
					<p class="text-center" style="margin-top:20px;">Already have an account? &nbsp <a href="login.php" id="" class="" style="text-decoration:underline;">Login here</a></p>
				</div>
			</div>
		</div>	
	</div>
	
	<script src="../../js/jquery.js"></script> 
	<script type="text/javascript" src="../../js/password.js"></script>
	<script>
	
			//password text-box 
        jQuery(document).ready(function($) {
          // Default behavior
          $('#default').password();

        });
		
	</script>
</body>
</html>
<?php

	if(isset($_COOKIE["remember"])){
		$email=$_COOKIE["remember"];
	} else {
		$email = "";
	}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../../css/bootstrap.css" />
	<link rel="stylesheet" href="../../css/style.css" />
</head>
<body>
	<div class="wrapper">
		<div class="container">
		<?php
			
				if(isset($_REQUEST["msg"])) {
					if($_REQUEST["msg"] == "success") {
						echo '<div class="alert alert-success alert-dismissible col-lg-5 pull-right fade in" style="margin-top:15px;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Success!</strong> Account created.
						</div>';
					
					}
					else if($_REQUEST["msg"] == "invalid") {
						echo '<div class="alert alert-danger alert-dismissible col-lg-5 pull-right fade in" style="margin-top:15px;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Warning!</strong> User name or Password invalid.
						</div>';
					
					}else {
						// do nothing
					}
				}
			
			?>

			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
						<img src="../../images/logo_sms_v2.png" alt="SMS" class="sms_logo"/>
					
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="login">
						<form method="post" action="../../php/authentication/login.php" class="form-group" autocomplete="off">
							<div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							  <input type="text" class="form-control input" name="email" value="<?php echo $email;?>" required="required" placeholder="User Email" autocomplete="on">
							</div><br />
							<div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
							  <input type="password" class="form-control input" name="pass" required="required" placeholder="Password" autocomplete="off">
							</div><br />
							<input type="checkbox" name="remember" class="form-control pull-left" style="margin-left:8%;width:25px;" autocomplete="on" />
							<span style="margin-left:10px;line-height:35px;">Remember me</span>
							<a href="" id="" class="pull-right">Forgot Password?</a><br /><br />
							<input type="submit" name="login" id="" class="btn btn-lg btn-primary" value="Login" />		
						</form>
					</div>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>
<?php

if (isset($_REQUEST["msg"])) {
	if ($_REQUEST["msg"] == 'false') {
		echo $alert_obj->danger();
	} elseif ($_REQUEST["msg"] == "true") {
		echo $alert_obj->success("Added Record.");
	} elseif ($_REQUEST["msg"] == "pwd_err") {
		echo $alert_obj->warning("Password not matched.");
	} else if ($_REQUEST["msg"] == "up_true") {
		echo $alert_obj->success("Updated record.");
	} else if ($_REQUEST["msg"] == "up_false") {
		echo $alert_obj->danger();
	} else if ($_REQUEST["msg"] == "current_pwd_err") {
		echo $alert_obj->warning("Current password not matched. Try again");
	} else {
		// do nothing.
	}
}

// ------------------------------------------------------------------

require_once("php/administrator.php");
$id = $_SESSION["user_id"];
$record = $admin_obj->getRecordById("users", $id);


?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Profile</a></li>
	</ul>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<p><b>Profile Setting</b></p>
			</div>
			<div class="panel-body">
				<form action="php/administrator/profile.php" method="POST" class="form-group" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">User Name</label>
						<input type="text" name="name" disabled id="" value="<?php echo $record["user_name"]; ?>" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" name="email" disabled id="" value="<?php echo $record["email"]; ?>" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label for="">Phone</label>
						<input type="number" name="phone" id="" value="<?php echo $record["phone"]; ?>" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label>Upload Image</label>
						<div class="input-group">
							<span class="input-group-btn">
								<span class="btn btn-default btn-file">
									Browse… <input type="file" name="file" id="imgInp">
								</span>
							</span>
							<input type="text" class="form-control" readonly>
						</div>
						<img id='img-upload' />
						<img src="<?php echo $record["photo"] ?>" class="img-thumbnail" alt="profile" style="width: 150px;" />
					</div>
					<input type="submit" class="btn btn-primary btn-md pull-right" name="update_user" value="Update" style="margin-top:20px;" />
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<p><b>Change Password</b></p>
			</div>
			<div class="panel-body">
				<form action="php/administrator/profile.php" method="post" class="form-group">
					<div class="form-group">
						<label for="">Current Password</label>
						<input type="password" name="current_pwd" id="" value="" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label for="">New Password</label>
						<input type="password" name="new_pwd" id="" value="" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label for="">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="" value="" class="form-control" required="required">
					</div>
					<input class="btn btn-primary btn-md pull-right" type="submit" name="change_pwd" value="Change Password" />
				</form>
			</div>
		</div>
	</div>
</div>
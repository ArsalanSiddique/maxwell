<?php
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 'false') {
        echo $alert_obj->danger();
    } elseif ($_REQUEST["msg"] == "true") {
        echo $alert_obj->success("Added Record.");
    } else if ($_REQUEST["msg"] == "up_true") {
        echo $alert_obj->success("Updated record.");
    } else if ($_REQUEST["msg"] == "up_false") {
        echo $alert_obj->danger();
    } else {
        // do nothing.
    }
}
require_once("php/administrator.php");
$session_data = $admin_obj->fetchAllRecord("session");
$record = $admin_obj->getRecordById("school_info", "1");

if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["aId"])) {
			$admin_id = $_REQUEST["aId"];
			$result = $admin_obj->deleteRecord("users", $admin_id);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=del_false");</script>';
			}
		} else if (isset($_REQUEST["cId"])) {
			$campus_id = $_REQUEST["cId"];
			$result = $admin_obj->deleteRecord("campus", $campus_id);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=del_false");</script>';
			}
		} else if (isset($_REQUEST["sId"])) {
			$session_id = $_REQUEST["sId"];
			$result = $admin_obj->deleteRecord("session", $session_id);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=del_false");</script>';
			}
		}
	} else if ($_REQUEST["status"] == "active") {
		if (isset($_REQUEST["seId"])) {
			$session_id = $_REQUEST["seId"];
			$result = $admin_obj->activateSession($session_id);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=up_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=administrator/general_setting&msg=up_false");</script>';
			}
		}
	}
}

?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">General Setting</a></li>
	</ul>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">


			<div class="panel panel-default">
				<div class="panel-heading">
					School Details
				</div>
				<div class="panel-body">
					<form action="php/administrator/general_settings.php" method="POST">
						<div class="form-group">
							<label for="name">School Name: <span class="red_required">*</span></label>
							<input type="text" name="name" class="form-control" value="<?php echo $record["name"] ?>" id="name" placeholder="School Name" required="required" />
						</div>
						<div class="form-group">
							<label for="email">School Email:</label>
							<input type="email" name="email" class="form-control" value="<?php echo $record["email"] ?>" id="email" placeholder="@email.com" />
						</div>
						<div class="form-group">
							<label for="phone">School Phone: <span class="red_required">*</span></label>
							<input type="number" name="phone" class="form-control" value="<?php echo $record["phone"] ?>" id="phone" required="required" />
						</div>
						<div class="form-group">
							<label for="address">School Address: <span class="red_required">*</span></label>
							<textarea name="address" id="address" class="form-control" cols="30" rows="5" required="required"> <?php echo $record["address"] ?> </textarea>
						</div>
						<input type="submit" value="Save Record" name="school_details" class="btn btn-primary btn-md pull-right" />
					</form>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading"> &nbsp Admin Details</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#list" data-toggle="tab">admin List</a></li>
						<li><a href="#add_admin" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add Admin</a></li>
					</ul>
					<div class="tab-content">
						<div id="list" class="tab-pane fade in active" style="padding: 5px;">
							<div class="table-responsive">
								<table class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Campus</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$table1 = "users";
										$table2 = "campus";
										$behave1 = "campus";
										$behave2 = "id";
										$column = ["users.id as user_id", "campus.id as campus_id", "users.user_name", "campus.name", "users.created_at"];
										$where = "user_type = 'admin' AND users.deleted_at IS NULL";
										$admin_data = $main_lib_obj->leftJoin($table1, $table2, $column, $behave1, $behave2, $where);

										$id = 1;
										if (!empty($admin_data)) {
											foreach ($admin_data as $rows2) {
										?>
												<tr>
													<td><?php echo $id ?></td>
													<td><?php echo $rows2["user_name"] ?></td>
													<td><?php echo $rows2["name"] ?></td>
													<td><?php echo $rows2["created_at"] ?></td>
													<td>
														&nbsp;
														<a href="index.php?page=administrator/settings/edit_admin&aId=<?php echo $rows2["user_id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
														<a href="index.php?page=administrator/general_setting&status=delete&aId=<?php echo $rows2["user_id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
													</td>
												</tr>
										<?php

												$id = ++$id;
											}
										} else {
											echo "<tr><td colspan='5' style='text-align:center;'><h5>No Record Found.</h5></td></tr>";
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div id="add_admin" class="tab-pane fade" style="padding: 5px;">
							<form action="php/administrator/general_settings.php" method="post" class="form-group">
								<div class="form-group">
									<label for="">Admin Name</label>
									<input type="text" name="name" id="" value="" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="text" name="email" id="" value="" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label for="">Password</label>
									<input type="password" name="password" id="" value="" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label for="">Confirm password</label>
									<input type="password" name="confirm_password" id="" value="" class="form-control" required="required">
								</div>
								<div class="Running Session">
									<label for="">Select Campus</label>
									<select name="campus" id="" class="form-control" required="required" />
									<option value="">Select Campus</option>
									<?php

									$campus_data = $admin_obj->fetchAllRecord("campus");
									foreach ($campus_data as $rows3) {
										echo '<option value="' . $rows3["id"] . '">' . $rows3["name"] . '</option>';
									};

									?>
									</select>
								</div>
								<input type="submit" class="btn btn-primary pull-right" name="admin_add" style="margin-top: 20px;" value="Add" />

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">Upload Logo</div>
				<div class="panel-body">
					<form action="php/administrator/general_settings.php" method="POST" class="form-group" enctype="multipart/form-data">
						<div class="form-group">
							<label>Upload Image: </label>
							<div class="input-group">
								<span class="input-group-btn">
									<span class="btn btn-default btn-file">
										Browse… <input type="file" name="file" id="imgInp">
									</span>
								</span>
								<input type="text" class="form-control" readonly>
							</div>
							<img id='img-upload' />
							<img src="<?php echo $record["logo"] ?>" class="img-thumbnail" style="width:150px;" alt="logo">
						</div>
						<input type="submit" name="logo" value="Upload" class="btn btn-primary btn-md pull-right" />
					</form>
				</div>
			</div>
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					Upload Principle Signature
				</div>
				<div class="panel-body">
					<form action="php/administrator/general_settings.php" method="POST" class="form-group" enctype="multipart/form-data">
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
							<img src="<?php echo $record["principle_signature"] ?>" class="img-thumbnail" style="width:150px;" alt="signature">
						</div>
						<input type="submit" name="signature" value="Upload" class="btn btn-primary btn-md pull-right">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading"> &nbsp Campus Details</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#camp_list" data-toggle="tab">Campus List</a></li>
						<li><a href="#add_campus" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add Campus</a></li>
					</ul>
					<div class="tab-content">
						<div id="camp_list" class="tab-pane fade in active" style="padding: 5px;">
							<div class="table-responsive">
								<table class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Campus Name</th>
											<th>Address</th>
											<th>Phone</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!empty($campus_data)) {
											$id = 1;
											foreach ($campus_data as $rows4) {
										?>
												<tr>
													<td><?php echo $id ?></td>
													<td><?php echo $rows4["name"] ?></td>
													<td><?php echo $rows4["address"] ?></td>
													<td><?php echo $rows4["phone"] ?></td>
													<td>
														&nbsp;
														<a href="index.php?page=administrator/settings/edit_campus&cId=<?php echo $rows4["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
														<a href="index.php?page=administrator/general_setting&status=delete&cId=<?php echo $rows4["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
													</td>
												</tr>
										<?php $id = ++$id;
											}
										} else {
											echo "<tr><td colspan='5' style='text-align:center;'><h5>No Record Found.</h5></td></tr>";
										} ?>
									</tbody>
								</table>
							</div>
						</div>
						<div id="add_campus" class="tab-pane fade" style="padding: 5px;">
							<form name="add_campus" action="php/administrator/general_settings.php" method="POST" class="form-group">
								<div class="form-group">
									<label for="">Campus Name</label>
									<input type="Text" class="form-control" name="name" placeholder="name" requied="requied" />
								</div>
								<div class="form-group">
									<label for="">Campus Address</label>
									<input type="Text" class="form-control" name="address" placeholder="address" />
								</div>
								<div class="form-group">
									<label for="">Campus Phone No.</label>
									<input type="Text" class="form-control" name="phone" placeholder="03xx - xxxxxxx" />
								</div>

								<input type="submit" name="campus_add" class="btn btn-primary pull-right" value="Save" />

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading"> &nbsp Session Details</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#session_list" data-toggle="tab">Session List</a></li>
						<li><a href="#add_session" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add Session</a></li>
					</ul>
					<div class="tab-content">
						<div id="session_list" class="tab-pane fade in active" style="padding: 5px;">
							<div class="table-responsive">
								<table class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Start Month</th>
											<th>End Month</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$id = 1;
										if (!empty($session_data)) {
											foreach ($session_data as $rows4) {
										?>
												<tr>
													<td><?php echo $id ?></td>
													<td><?php echo $rows4["session_start"] ?></td>
													<td><?php echo $rows4["session_end"] ?></td>
													<td><?php if ($rows4["status"] == "active") {
															echo '<span class="label label-success">Active</span>';
														} else { ?>
															<a href='index.php?page=administrator/general_setting&status=active&seId=<?php echo $rows4["id"] ?>'><button class='btn btn-sm btn-secondary'>Active</button></a>
														<?php  } ?></td>
													<td>
														&nbsp;
														<a href="index.php?page=administrator/settings/edit_session&sId=<?php echo $rows4["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
														<a href="index.php?page=administrator/general_setting&status=delete&sId=<?php echo $rows4["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
													</td>
												</tr>
										<?php $id = ++$id;
											}
										} else {
											echo "<tr><td colspan='5' style='text-align:center;'><h5>No Record Found.</h5></td></tr>";
										} ?>
									</tbody>
								</table>
							</div>
						</div>
						<div id="add_session" class="tab-pane fade" style="padding: 5px;">
							<form name="add_session" action="php/administrator/general_settings.php" method="POST" class="form-group">
								<div class="form-group">
									<label for="start_month">Start Month</label>
									<input type="Month" class="form-control" id="start_month" name="start_month" requied="requied" />
								</div>
								<div class="form-group">
									<label for="end_month">End Month</label>
									<input type="Month" class="form-control" id="end_month" name="end_month" requied="requied" />
								</div>

								<input type="submit" name="session_add" class="btn btn-primary pull-right" value="Save" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5"></div>
	</div>



</div>
<?php

if (isset($_REQUEST["msg"])) {
	if ($_REQUEST["msg"] == "added_session") {
		echo $result = $alert_obj->success("Session Created.");
	} else if ($_REQUEST["msg"] == "added_campus") {
		echo $result = $alert_obj->success("Campus Added.");
	} else {
		// do nothing
	}
}

?>
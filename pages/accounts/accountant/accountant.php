<?php

if (isset($_REQUEST["msg"])) {
  if ($_REQUEST["msg"] == 'false') {
    echo $alert_obj->danger();
  } elseif ($_REQUEST["msg"] == "cnic_err") {
    echo $alert_obj->warning("CNIC alread exists.");
  } else if ($_REQUEST["msg"] == "up_false") {
    echo $alert_obj->danger();
  } else if ($_REQUEST["msg"] == "mail_err") {
    echo $alert_obj->warning("Email already exist");
  } else if ($_REQUEST["msg"] == "name_err") {
    echo $alert_obj->warning("Name already exist");
  } else {
    // do nothing.
  }
}

require_once("php/account.php");
$accountant = $account_obj->fetchAccountant();
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["aId"])) {
			$result = $academics_obj->deleteRecord("users", $_REQUEST["aId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=accounts/accountant/accountant&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=accounts/accountant/accountant&msg=del_false");</script>';
			}
		}
	}
}
?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Accountant</a></li>
	</ul>
</div>

<!-- Add Accountant Button -->
<div class="container-fluid">
	<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_accountant">
		<i class="fa fa-plus"></i> &nbsp Add New Accountant
	</button>
</div>

<!-- #add_accountant_modal -->

<div id="add_accountant" class="modal fade col-md-6" style="margin-top: 20px; margin-left: 25%; display: block; padding-right: 10px; role=" dialog">
	<div class="dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4><i class="fa fa-plus"></i>&nbsp Add Accountant</h4>
			</div>
			<div class="modal-body">
				<form action="php/accounts/accountant.php" method="post" class="form-group">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" name="name" id="" class="form-control" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" name="email" id="" class="form-control" placeholder="@gmail.com">
					</div>
					<div class="form-group">
						<label for="">Phone</label>
						<input type="text" name="phone" id="" class="form-control" placeholder="xxxx-xxxxxxx">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="Password" name="password" id="" class="form-control" placeholder="********">
					</div>

					<div class="form-group">
						<label>Upload Profile</label>
						<div class="input-group">
							<span class="input-group-btn">
								<span class="btn btn-default btn-file">
									Browse… <input type="file" name="file" id="imgInp">
								</span>
							</span>
							<input type="text" class="form-control" readonly>
						</div>
						<img id='img-upload' />
					</div>
					<div style="display: flex; justify-content:center;">
						<input type="submit" name="add_accountant" class="btn btn-primary btn-md" style="margin-left: 20px;" value="Add Accountant">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
			</div>
		</div>
	</div>
</div>


<!-- Expnese table -->
<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Photo</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$serial = 1;
			foreach ($accountant as $record) {
			?>
				<tr>
					<td><?php echo $serial++; ?></td>
					<td><img src="<?php echo $record["photo"]; ?>" alt="profile" width="50"></td>
					<td><?php echo $record["user_name"]; ?></td>
					<td><?php echo $record["email"]; ?></td>
					<td><?php echo $record["phone"]; ?></td>
					<td>
						<a href="index.php?page=accounts/accountant/view_accountant&aId=<?php echo $record["id"] ?>" target="self"><i class="fa fa-eye btn-view"></i></a> &nbsp;
						<a href="index.php?page=accounts/accountant/edit_accountant&aId=<?php echo $record["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
						<a href="index.php?page=accounts/accountant/accountant&status=delete&aId=<?php echo $record["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
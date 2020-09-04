<?php
if (isset($_REQUEST["msg"])) {

	if ($_REQUEST["msg"] == 'true') {
		echo $alert_obj->success("added Record.");
	} else if ($_REQUEST["msg"] == 'false') {
		echo $alert_obj->danger();
	} elseif ($_REQUEST["msg"] == "up_true") {
		echo $alert_obj->success("updated record.");
	} else if ($_REQUEST["msg"] == "up_false") {
		echo $alert_obj->danger();
	} else {
		// do nothing.
	}
} else if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["cId"])) {
			$result = $academics_obj->deleteRecord("class", $_REQUEST["cId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/class/manage_class&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/class/manage_class&msg=del_false");</script>';
			}
		}
	}
}



$teachers = $academics_obj->getAllTeachers($_SESSION["campus_id"]);
$departments = $academics_obj->fetchAllRecord("department");

?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Manage Class</a></li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Class Details</div>
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Class List</a></li>
			<li><a href="#add_class" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add CLass</a></li>
		</ul>

		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Department Name</th>
								<th>Class Name</th>
								<th>Numeric Name</th>
								<th>Teacher</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$cID = 0;
							$classList = $academics_obj->showAllClass();
							foreach ($classList as $rows) {
							?>

								<tr>
									<td><?php echo ++$cId ?></td>
									<td><?php echo $academics_obj->getColName("department", "name",  $rows["depart_id"]) ?></td>
									<td><?php echo $rows["name"] ?></td>
									<td><?php echo $rows["numeric_name"] ?></td>
									<td><?php echo $academics_obj->getColName("teachers", "name",  $rows["class_teacher"]) ?></td>
									<td>
										<a href="index.php?page=academics/class/edit_class&cId=<?php echo $rows["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
										<a href="index.php?page=academics/class/manage_class&status=delete&cId=<?php echo $rows["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>&nbsp;
										<a href="index.php?page=reports/class_summary&cId=<?php echo $rows["id"] ?>" target="_self"><i class="fa fa-line-chart btn-view"></i></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div id="add_class" class="tab-pane fade">
				<form action="php/academics/class.php" method="post" class="form-group thumbnail col-md-6" style="margin:10px;padding:20px;">
					<div class="form-group">
						<label for="class_name">Name: <span class="red_required">*</span></label>
						<input type="text" name="name" id="" class="form-control" placeholder="one" />
					</div>
					<div class="form-group">
						<label for="class_name">Numeric Name: <span class="red_required">*</span></label>
						<input type="text" name="n_name" id="" class="form-control" placeholder="i" />
					</div>
					<div class="form-group">
						<label for="department">Select Department:</label>
						<select name="department" class="form-control" id="department">
							<option value="">Select Teacher</option>
							<?php foreach ($departments as $department) { ?>
								<option value="<?php echo $department["id"] ?>"><?php echo $department["name"] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="teacher">Class Teacher:</label>
						<select name="teacher" class="form-control" id="teacher">
							<option value="">Select Teacher</option>
							<?php foreach ($teachers as $teacher) { ?>
								<option value="<?php echo $teacher["id"] ?>"><?php echo $teacher["name"] ?></option>
							<?php } ?>
						</select>
					</div>
					<input type="submit" name="addClass" value="submit" class="btn btn-success" />
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row"></div>
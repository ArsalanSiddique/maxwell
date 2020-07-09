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
require_once("php/hr.php");
$teachers = $hrObj->getAllTeachers($_SESSION["campus_id"]);
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["tId"])) {
			$result = $academics_obj->deleteRecord("teachers", $_REQUEST["tId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=hr/teacher&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=hr/teacher&msg=del_false");</script>';
			}
		}
	}
}

?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Manage Teacher</a></li>
	</ul>
</div>

<div class="container-fluid">
	<a href="index.php?page=hr/add_teacher"><button type="button" class="btn btn-primary pull-right"> <i class="fa fa-plus"> &nbsp; </i>Add New Teacher</button></a>
</div>
<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Photo</th>
				<th>Gender</th>
				<th>Phone</th>
				<th>Regsiter At</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$count = 1;
			foreach ($teachers as $teacher) {
			?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><img src="<?php echo $teacher["photo"] ?>" alt="profile" width=50></td>
					<td><?php echo $teacher["name"] ?></td>
					<td><?php echo $teacher["gender"] ?></td>
					<td><?php echo $teacher["cnic"] ?></td>
					<td><?php echo $teacher["created_at"] ?></td>
					<td>
						<a href="index.php?page=hr/view_teacher&tId=<?php echo $teacher["id"] ?>" target="self"><i class="fa fa-eye btn-view"></i></a> &nbsp;
						<a href="index.php?page=hr/edit_teacher&tId=<?php echo $teacher["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
						<a href="index.php?page=hr/teacher&status=delete&tId=<?php echo $teacher["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
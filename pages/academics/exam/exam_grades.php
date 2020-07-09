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
	} else if ($_REQUEST["msg"] == "name_err") {
		echo $alert_obj->warning("Name already exist");
	} else if ($_REQUEST["msg"] == "gp_err") {
		echo $alert_obj->warning("Grade point error.");
	} else {
		// do nothing.
	}
}
require_once("php/academics.php");
$grades = $academics_obj->showAllGrades();
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["gId"])) {
			$result = $academics_obj->deleteRecord("exam_grades", $_REQUEST["gId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/exam/exam_grades&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/exam/exam_grades&msg=del_false");</script>';
			}
		}
	}
}

?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Exam Grades</a></li>
	</ul>
</div>

<!--Exam Grade Tabs-->
<ul class="nav nav-tabs">
	<li class="active"><a href="#home" data-toggle="tab">Grade List</a></li>
	<li><a href="#add_grade" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add Grade</a></li>
</ul>
<div class="tab-content">
	<div id="home" class="tab-pane fade in active">
		<div class="table-responsive thumbnail" style="margin-top: 10px;padding:10px;padding-bottom: 50px;">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td>#</td>
						<td>Grade Name</td>
						<td>Grade Point</td>
						<td>Mark From</td>
						<td>Mark Upto</td>
						<td>Remarks</td>
						<td>Options</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($grades as $grade) {
					?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $grade["name"] ?></td>
							<td><?php echo $grade["point"] ?></td>
							<td><?php echo $grade["marks_from"] ?></td>
							<td><?php echo $grade["marks_upto"] ?></td>
							<td><?php echo $grade["remarks"] ?></td>
							<td>
								<a href="index.php?page=academics/exam/edit_grade&gId=<?php echo $grade["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
								<a href="index.php?page=academics/exam/exam_grades&status=delete&gId=<?php echo $grade["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="tab-pane fade" id="add_grade">
		<div class="row">
			<form action="php/academics/exam.php" method="post" class="form-group thumbnail col-md-6" style="margin:10px;padding:20px;">
				<small> <b>NOTE: &nbsp;</b> Field marks with <span class="red_required" style="font-size: 16px;"> * </span> are required.</small>
				<hr>
				<div class="form-group">
					<label for="class_name">Name: <span class="red_required">*</span> </label>
					<input type="text" name="name" id="" required="required" class="form-control" />
				</div>
				<div class="form-group">
					<label for="grade_point">Grade Point: <span class="red_required">*</span> </label>
					<input type="text" name="point" id="" class="form-control" required="" />
				</div>
				<div class="form-group">
					<label for="mark_from">Mark From: <span class="red_required">*</span> </label>
					<input type="text" name="from" id="" class="form-control" />
				</div>
				<div class="form-group">
					<label for="mark_upto">Mark Upto: <span class="red_required">*</span> </label>
					<input type="text" name="upto" id="" class="form-control" />
				</div>
				<div class="form-group">
					<label for="coment">Remarks:</label>
					<input type="text" name="comment" id="" class="form-control" />
				</div>
				<input type="submit" value="submit" name="addGrade" class="btn btn-primary" />
			</form>
		</div>
	</div>
</div>
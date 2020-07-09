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
	} else {
		// do nothing.
	}
}
require_once("php/academics.php");
$exams = $academics_obj->fetchAllExams();
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["eId"])) {
			$result = $academics_obj->deleteRecord("exams", $_REQUEST["eId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/exam/exam_list&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/exam/exam_list&msg=del_false");</script>';
			}
		}
	}
}
?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Exam List</a></li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		Exam Details
	</div>
	<div class="panel-body">
		<!--Tabs-->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Exam List</a></li>
			<li><a href="#add_subject" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add Exam</a></li>
		</ul>
		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<div class="table-responsive thumbnail" style="margin-top: 10px;padding:10px;padding-bottom: 50px;">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<td>S.no</td>
								<td>Exam Name</td>
								<td>Max Marks</td>
								<td>Date</td>
								<td>Comment</td>
								<td>Options</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							foreach ($exams as $exam) {
							?>

								<tr>
									<td><?php echo $count++; ?></td>
									<td><?php echo $exam["name"]; ?></td>
									<td><?php echo $exam["marks"]; ?></td>
									<td><?php echo $exam["date"]; ?></td>
									<td><?php echo $exam["comments"]; ?></td>
									<td>
										<a href="index.php?page=academics/exam/edit_exam&eId=<?php echo $exam["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
										<a href="index.php?page=academics/exam/exam_list&status=delete&eId=<?php echo $exam["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
									</td>
								</tr>

							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="add_subject">
				<div class="row">
					<form action="php/academics/exam.php" method="post" class="form-group thumbnail col-md-6" style="margin:10px;padding:20px;">
						<div class="form-group">
							<label for="class_name">Name:</label>
							<input type="text" name="name" id="" required="required" placeholder="Enter Exam Name" class="form-control" />
						</div>
						<div class="form-group">
							<label for="marks">Marks:</label>
							<input type="text" name="maxMarks" id="" required="required" placeholder="Enter Max. Marks" class="form-control" />
						</div>
						<div class="form-group">
							<label for="date">Date: </label>
							<input type="date" name="date" id="" required="required" class="form-control" /></div>
						<div class="form-group">
							<label for="comments">Comments:</label>
							<input type="text" name="comments" id="" placeholder="Enter Comments" class="form-control" />
						</div>
						<input type="submit" name="add_exam" value="submit" class="btn btn-primary" />
					</form>
				</div>
			</div>
		</div>

	</div>
</div>
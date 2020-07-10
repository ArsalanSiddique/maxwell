<?php

require_once("php/academics.php");
$classes = $academics_obj->showAllClass();

if (isset($_POST["info"])) {
	extract($_POST);
	$students = $academics_obj->showAllStudents($status, $class, $section);
	$section = $academics_obj->getSection($section);
} else if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["sId"])) {
			$result = $academics_obj->deleteStudent($_REQUEST["sId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/students/student_information&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/students/student_information&msg=del_false");</script>';
			}
		}
	}
}

?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Students Information</li>
	</ol>
</div>

<div class="thumbnail" style="padding:20px;">
	<div class="row">
		<form action="" class="form-inline" method="post">
			<div class="form-group col-md-3">
				<label for="status">Select Status:</label><br>
				<select name="status" class="form-control" id="status" style="width:100%;" onchange="showRecords()">
					<option value="active">Active</option>
					<option value="in-active">In Active</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="class_id">Select Class:</label><br>
				<select name="class" class="form-control" id="class_id" required="required" style="width:100%;" onchange="myfun(this.value); showRecords()">
					<option value="">Select</option>
					<?php
					foreach ($classes as $class) {
					?>
						<option value="<?php echo $class["id"] ?>"><?php echo $class["name"] ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="section">Select Section:</label><br>
				<select name="section" class="form-control" id="section" required="required" style="width:100%;" onchange="showRecords()">
					<option value="">Select Class First</option>
				</select>
			</div>
		</form>
		<br />
		<div class="form-group pull-right" style="margin-right:15px;">
			<a href="index.php?page=academics/students/admit_student"><button type="submit" id="" class="btn btn-primary">
					<span class="fa fa-plus"></span>&nbsp Add Student
				</button></a>
		</div>
	</div>
</div>

<div class="table-responsive thumbnail" style="margin-top:50px;padding:20px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Reg. No</th>
				<th>Class</th>
				<th>Section</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Gender</th>
				<th>Phone</th>
				<th>Address</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody id="record">

		</tbody>
	</table>
</div>


<script type="text/javascript">
	function myfun(datavalue) {
		$.ajax({
			url: 'php/academics/get_data.php',
			type: 'POST',
			data: {
				datapost: datavalue
			},
			success: function(result, status) {
				$('#section').html(result);
			}
		});
	}

	function showRecords() {
		var class_id = document.getElementById("class_id").value;
		var section = document.getElementById("section").value;
		var status = document.getElementById("status").value;
		if (class_id != "" && status != "") {
			$.ajax({
				url: 'php/academics/student_record.php',
				type: 'POST',
				data: {
					class_id: class_id,
					section: section,
					stat: status,	
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}
</script>
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
}
require_once("php/academics.php");
$exams = $academics_obj->fetchAllRecord("exams");
$classes = $academics_obj->fetchAllRecord("class");
$sections = $academics_obj->fetchAllRecord("section");
$all_subjects = $academics_obj->fetchAllRecord("subjects");

if (isset($_POST["marks"])) {
	extract($_POST);
	$record = $academics_obj->manageMarks($class_id, $section, $subjects, $exam_id);
} else if (isset($_REQUEST["eId"], $_REQUEST["cId"], $_REQUEST["secId"], $_REQUEST["sId"])) {
	$exam_id = $_REQUEST["eId"];
	$class_id = $_REQUEST["cId"];
	$subjects = $_REQUEST["sId"];
	$section = $_REQUEST["secId"];
	$record = $academics_obj->manageMarks($class_id, $section, $subjects, $exam_id);
}
?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Manage Marks</a></li>
	</ul>
</div>

<div class="thumbnail">
	<form action="" method="post" class="form-inline" style="padding:10px;">
		<div class="form-group col-md-2">
			<label for="exam">Exam</label><br>
			<select name="exam_id" class="form-control" id="exam_id" required="required" style="width:100%;" onchange="showRecord()">
				<option value="">Select Exam</option>
				<?php
				foreach ($exams as $exam) {
				?>
					<option value="<?php echo $exam["id"] ?>" <?php if ($exam_id == $exam["id"]) {
																	echo "selected";
																} ?>><?php echo $exam["name"] ?></option>
				<?php
				}
				?>
			</select>
		</div>
		<div class="form-group col-md-2">
			<label for="class">Class</label><br>
			<select name="class_id" class="form-control" id="class_id" required="required" style="width:100%;" onchange="showRecord(); myfun(this.value); fetchSubject(this.value);">
				<option value="">Select Class</option>
				<?php
				foreach ($classes as $class) {
				?>
					<option value="<?php echo $class["id"] ?>" <?php if ($class_id == $class["id"]) {
																	echo "selected";
																} ?>><?php echo $class["name"] ?></option>
				<?php
				}
				?>
			</select>
		</div>
		<div class="form-group col-md-3" style="padding-left:10px;">
			<label for="section">Section</label>
			<select name="section" class="form-control" id="section" style="width:100%;" onchange="showRecord()">
				<option value="">Select Class First</option>
			</select>
		</div>
		<div class="form-group col-md-3" style="padding-left:10px;">
			<label for="subjects">Subjects</label>
			<select name="subjects" class="form-control" id="subjects" style="width:100%;" onchange="showRecord()">
				<option value="">Select Class First</option>
			</select>
		</div>
		<div class="form-group col-md-2" style="padding-left:10px">
			<input type="submit" name="marks" class="btn btn-primary" style="margin-top:23px;" value="Manage Marks" />
		</div>
		<div class="row"></div>
	</form>
</div>

<!-- Manage Marks Table -->

<div id="record"></div>


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

	function fetchSubject(datavalue) {
		$.ajax({
			url: 'php/academics/get_data.php',
			type: 'POST',
			data: {
				class_id: datavalue
			},
			success: function(result, status) {
				$('#subjects').html(result);
			}
		});
	}

	function showRecord() {
		var exam_id = document.getElementById("exam_id").value;
		var class_id = document.getElementById("class_id").value;
		var section = document.getElementById("section").value;
		var subjects = document.getElementById("subjects").value;

		if (class_id != "" && exam_id != "" && subjects != "") {
			$.ajax({
				url: 'php/academics/ajax/manage_marks.php',
				type: 'POST',
				data: {
					class_id: class_id,
					section: section,
					exam_id: exam_id,
					subjects: subjects,
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}
</script>
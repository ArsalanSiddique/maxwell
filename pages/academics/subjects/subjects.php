<?php
if (isset($_REQUEST["msg"])) {
  if ($_REQUEST["msg"] == 'false') {
    echo $alert_obj->danger();
  } elseif ($_REQUEST["msg"] == "cnic_err") {
    echo $alert_obj->warning("CNIC alread exists.");
  } else if ($_REQUEST["msg"] == "up_false") {
    echo $alert_obj->danger();
  } else {
    // do nothing.
  }
}

require_once("php/academics.php");
$classes = $academics_obj->showAllClass();
$teachers = $academics_obj->getAllTeachers($_SESSION["campus_id"]);
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["subId"])) {
			$result = $academics_obj->deleteSubject($_REQUEST["subId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/subjects/subjects&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/subjects/subjects&msg=del_false");</script>';
			}
		}
	}
}

?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Manage Subjects</a></li>
	</ul>
</div>

<div class="thumbnail" style="padding:24px;">
	<div class="row">
		<form action="" class="form-inline" method="post">
			<div class="form-group col-md-3">
				<label for="current_session">Class</label><br>
				<select name="class_id" class="form-control" id="class_id" required="required" style="width:100%;" onchange="myfun(this.value); showRecord()">
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
			<div class="form-group col-md-3" style="padding-left:10px;">
				<label for="current_session">Section</label>
				<select name="section" class="form-control" id="section" required="required" style="width:100%;" onchange="showRecord()">
					<option value="">Select</option>
				</select>
			</div>

			<div class="form-group pull-right">
				<br />
				<a href="index.php?page=academics/subjects/add_subjects" class="btn btn-primary">Add Subjects</a>
			</div>

		</form>
	</div>
</div>

<div class="table-responsive thumbnail" style="margin-top: 10px;padding:10px;padding-bottom: 50px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td>#</td>
				<td>Code</td>
				<td>Class</td>
				<td>Subjects</td>
				<td>Teacher</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody id="record"></tbody>
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

	function showRecord() {
		var class_id = document.getElementById("class_id").value;
		var section = document.getElementById("section").value;

		if (class_id != "") {
			$.ajax({
				url: 'php/academics/ajax/subject.php',
				type: 'POST',
				data: {
					class_id: class_id,
					section: section,
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}
</script>
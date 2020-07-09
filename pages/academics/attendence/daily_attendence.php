<?php

require_once("php/academics.php");
$classes = $academics_obj->showAllClass();

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

?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Manage Daily Attendence</a></li>
	</ul>
</div>

<!--Manage Daily Attendence-->
<div class="thumbnail" style="padding: 24px;">
	<div class="row">
		<form action="" method="post" class="form-inline">
			<div class="form-group col-md-3">
				<label for="current_session">Class</label><br>
				<select name="class" class="form-control" id="class_id" required="required" style="width:100%;" onchange="myfun(this.value); showRecord()">
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
			<div class="form-group col-md-3" style="padding-left:10px;">
				<label for="attendence_date">Date</label><br />
				<input type="date" name="date" id="date" required="required" class="form-control" onchange="showRecord()" />
			</div>
		</form>
	</div>
</div>

<!--attendance Table -->
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


	function showRecord() {
		var class_id = document.getElementById("class_id").value;
		var section = document.getElementById("section").value;
		var date = document.getElementById("date").value;

		if (class_id != "" && section != "" && date != "") {
			$.ajax({
				url: 'php/academics/ajax/daily_attendance.php',
				type: 'POST',
				data: {
					class_id: class_id,
					section: section,
					date: date,
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}
</script>
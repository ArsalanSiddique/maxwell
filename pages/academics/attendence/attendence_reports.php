<?php

require_once("php/academics.php");
$classes = $academics_obj->showAllClass();

?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Attendence Report</a></li>
	</ul>
</div>

<!-- Manage Attendence Reports -->
<div class="thumbnail" style="padding:24px;">
	<div class="row">
		<form action="" method="post">
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
				<label for="section">Section</label>
				<select name="section" class="form-control" id="section" style="width:100%;" required="required" onchange="showRecord()">
					<option value="">Select Section</option>
				</select>
			</div>
			<div class="form-group col-md-3" style="padding-left:10px;">
				<label for="month">Select Month</label>
				<input type="text" name="month" id="month" class="form-control input-md from" placeholder="Select Month" onchange="showRecord()">
			</div>
		</form>
	</div>
</div>

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
		var month = document.getElementById("month").value;

		if (class_id != "" && section != "" && month != "") {
			$.ajax({
				url: 'php/academics/ajax/attendance_report.php',
				type: 'POST',
				data: {
					class_id: class_id,
					section: section,
					month: month,
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}
</script>
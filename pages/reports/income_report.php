<?php
require_once("php/reports.php");
$sessions = $report_obj->fetchALlRecord("session");
$departments = $report_obj->fetchALlRecord("department");
$campuses = $report_obj->fetchALlRecord("campus");

?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Reports</li>
	</ol>
</div>

<div class="thumbnail" style="padding:20px;">
	<div class="row">
		<form action="" class="form-inline" method="post">
			<div class="form-group col-md-3">
				<label for="session_id">Select Session:</label><br>
				<select name="session" class="form-control" id="session_id" required="required" style="width:100%;" onchange="showRecords()">
					<?php
					foreach ($sessions as $data) {
					?>
						<option value="<?php echo $data["id"] ?>" <?php if ($_SESSION["session_id"] == $data["id"]) {
																		echo "selected";
																	} ?>><?php echo $data["session_start"] . " - " . $data["session_end"] ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="section">Select Campus:</label><br>
				<select name="session" class="form-control" id="campus_id" required="required" style="width:100%;" onchange="showRecords()">
					<?php
					foreach ($campuses as $camp) {
					?>
						<option value="<?php echo $camp["id"] ?>" <?php if ($_SESSION["campus_id"] == $camp["id"]) {
																		echo "selected";
																	} ?>><?php echo $camp["name"] ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="section">Select Department:</label><br>
				<select name="depart_id" class="form-control" id="depart_id" required="required" style="width:100%;" onchange="showRecords()">
					<option value="">Select</option>
					<?php
					foreach ($departments as $depart) {
					?>
						<option value="<?php echo $depart["id"] ?>"><?php echo $depart["name"] ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="month">Select Month </label>
				<input type="month" name="month" id="month" class="form-control" required="required" onchange="showRecords()">
			</div>
		</form>
	</div>
</div>



<div class="table-responsive thumbnail" style="margin-top:50px;padding:20px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Depart</th>
				<th>Class</th>
				<th>Section</th>
				<th>Students</th>
				<th>Total Fees</th>
				<th>Other Fees</th>
				<th>Paid Fees</th>
				<th>Due Fess</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody id="record"></tbody>
	</table>
</div>


<script type="text/javascript">
	function showRecords() {
		var session_id = document.getElementById("session_id").value;
		var campus_id = document.getElementById("campus_id").value;
		var depart_id = document.getElementById("depart_id").value;
		var month = document.getElementById("month").value;
		if (month != "" && depart_id != '') {
			$.ajax({
				url: 'php/reports/income.php',
				type: 'POST',
				data: {
					campus_id: campus_id,
					depart_id: depart_id,
					session_id: session_id,
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
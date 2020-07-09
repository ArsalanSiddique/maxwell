<?php

require_once("php/academics.php");
$classes = $academics_obj->showAllClass();

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
		if (class_id != "") {
			$.ajax({
				url: 'php/academics/ajax/exam_student_record.php',
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
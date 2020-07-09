<?php
require_once("php/academics.php");
$exams = $academics_obj->fetchAllRecord("exams");
$classes = $academics_obj->fetchAllRecord("class");

?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Tabulation Sheet</a></li>
	</ul>
</div>

<div class="thumbnail" style="padding:20px;">
	<form action="" method="POST" class="form-inline">
		<div class="row">
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
				<select name="class_id" class="form-control" id="class_id" required="required" style="width:100%;" onchange="myfun(this.value); showRecord()">
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
				<select name="section_id" class="form-control" id="section" style="width:100%;" onchange="showRecord()">
					<option value="">Select Class First</option>
				</select>
			</div>
		</div>
	</form>
</div>
<br />

<!-- Details About Exam -->

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
		var exam_id = document.getElementById("exam_id").value;
		var class_id = document.getElementById("class_id").value;
		var section = document.getElementById("section").value;

		if (class_id != "" && exam_id != "") {
			$.ajax({
				url: 'php/academics/ajax/tabulation_sheet.php',
				type: 'POST',
				data: {
					class_id: class_id,
					section: section,
					exam_id: exam_id,
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}
</script>
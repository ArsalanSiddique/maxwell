<?php
if (isset($_REQUEST["msg"])) {
	if ($_REQUEST["msg"] == 'true') {
		echo $alert_obj->success("added Record.");
	} else if ($_REQUEST["msg"] == 'false') {
		echo $alert_obj->danger();
	} else {
		// do nothing.
	}
}
require_once("php/academics.php");
$sessions = $academics_obj->fetchAllRecord("session");
$classes = $academics_obj->fetchAllRecord("class");
?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Student Promotion</a></li>
	</ul>
</div>

<!--Promotion Note-->
<div class="primary" style="padding:5px;margin:10px;background-color:#e7f3fe;border-left:6px solid #b6d6e4;border-radius:3px;">
	<h4>Student Promotion Notes:</h4>
	<p style="color: #0c3c50;">Promoting student from the present class to the next class will create an enrollment of that student to the next session. Make sure to select correct class options from the select menu before promoting. If you don't want to promote a student to the next class, please select that option. That will not promote the student to the next class but it will create an enrollment to the next session but in the same class.</p>
</div>

<!--promotion form-->
<div class="thumbnail">
	<div class="row" style="padding: 18px;">
		<form action="" class="form-inline" method="post">
			<div class="form-group col-md-3">
				<label for="current_session">Cureent Session:</label><br>
				<select name="current_session" class="form-control" id="current_session" required="required" style="width:100%;" onchange="showRecord()">
					<?php
					foreach ($sessions as $session) {
					?>
						<option value="<?php echo $session["id"] ?>" <?php if ($session["status"] == "active") {
																			echo "selected";
																		} ?>><?php echo $session["session_start"] . ' TO ' . $session["session_end"] ?></option>;
					<?php
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3" style="padding-left:10px">
				<label for="new_session">Promote To Session:</label><br>
				<select name="new_session" class="form-control" id="new_session" required="required" style="width:100%;" onchange="showRecord()">
					<?php
					foreach ($sessions as $session) {
						if ($session["status"] != "active")
							echo '<option value="' . $session["id"] . '">' . $session["session_start"] . ' TO ' . $session["session_end"] . '</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3" style="padding-left:10px;">
				<label for="from_class">Promotion From Class</label>
				<select name="from_class" class="form-control" id="from_class" required="required" style="width:100%;" onchange="from_class_val(this); showRecord()">
					<?php
					foreach ($classes as $class) {
						echo '<option value="' . $class["id"] . '">' . $class["name"] . '</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-3" style="padding-left:10px">
				<label for="to_class">Promotion To Class:</label>
				<select name="to_class" class="form-control" id="to_class" required="required" style="width:100%;" onchange="to_class_val(this); showRecord()">
					<?php
					foreach ($classes as $class) {
						echo '<option value="' . $class["id"] . '">' . $class["name"] . '</option>';
					}
					?>
				</select>
			</div>
		</form>
	</div>
</div>



<!--Promotion Table-->
<hr />
<div style="display: flex; justify-content: left;">
	<div class="col-md-4 well" style="margin-left:33%">
		<p><span style="font-size:20px;font-family:tahoma;">Students Promotion</span></p>
		<p style="font-family:tahoma;">Promotion From Class: <span id="f_class"></span> </p>
		<p style="font-family:tahoma;">Promotion To Class: <span id="t_class"></span></p>
	</div>
</div>

<!--Promotion Table-->
<div class="thumbnail" style="padding: 12px">
	<form action="php/academics/exam.php" method="POST">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>Reg No.</th>
					<th>Profile</th>
					<th>Name</th>
					<th>Father Name</th>
					<th>Info</th>
					<th>Promote</th>
				</tr>
			</thead>
			<tbody id="record">
			</tbody>
		</table>
		<!-- promote selected button -->
		<div style="display: flex; justify-content: center;">
			<button type="submit" name="promote" class="btn btn-success"><i class="fa fa-check"> Promote Selected Students</i></button>
		</div>
	</form>
</div>





<script type="text/javascript">
	function showRecord() {
		var current_session = document.getElementById("current_session").value;
		var new_session = document.getElementById("new_session").value;
		var from_class = document.getElementById("from_class").value;
		var to_class = document.getElementById("to_class").value;

		if (current_session != "" && new_session != "" && from_class != "" && to_class != "") {
			$.ajax({
				url: 'php/academics/student_record.php',
				type: 'POST',
				data: {
					current_session: current_session,
					new_session: new_session,
					from_class: from_class,
					to_class: to_class,
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}

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

	function from_class_val(datavalue) {
		var name = datavalue.options[datavalue.selectedIndex].text;
		document.getElementById("f_class").innerHTML = name;
	}

	function to_class_val(datavalue) {
		var name = datavalue.options[datavalue.selectedIndex].text;
		document.getElementById("t_class").innerHTML = name;
	}

	function promotion(student_id, class_id) {
		$.ajax({
			url: 'php/academics/ajax/std_promotion.php',
			type: 'POST',
			data: {
				student_id: student_id,
				class_id: class_id,
			},
			success: function(result, status) {
				document.getElementById(student_id).classList.remove('btn-primary');
				document.getElementById(student_id).classList.add('btn-success');
				document.getElementById(student_id).innerHTML = "Promoted";

			}
		});
	}
</script>
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
$classes = $academics_obj->showAllClass();

if (isset($_POST["info"])) {
	extract($_POST);
	$subjects = $academics_obj->showALlSubject($class_id, $section);
}

if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["tId"])) {
			$result = $academics_obj->deleteRecord("class_routine", $_REQUEST["tId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/time_table/timetable&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/time_table/timetable&msg=del_false");</script>';
			}
		}
	}
}

?>

<!--breadcrumb-->
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Time Table</a></li>
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
			<div class="form-group pull-right">
				<br>
				<a href="index.php?page=academics/time_table/add_routine&c=<?php echo $class_id . "&s=" . $section ?>" class="btn btn-primary">Add Class Routine</a>
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
				$('#section2').html(result);
			}
		});
	}

	function showRecord() {
		var class_id = document.getElementById("class_id").value;

		if (class_id != "") {
			$.ajax({
				url: 'php/academics/ajax/timetable.php',
				type: 'POST',
				data: {
					class_id: class_id,
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		} else {

		}
	}
</script>
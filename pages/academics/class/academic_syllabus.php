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
	} else if ($_REQUEST["msg"] == "file_err") {
		echo $alert_obj->warning("Please change file format");
	} else {
		// do nothing.
	}
}
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["sId"])) {
			$result = $academics_obj->deleteRecord("syllabus", $_REQUEST["sId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/class/academic_syllabus&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/class/academic_syllabus&msg=del_false");</script>';
			}
		}
	}
}

?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Accademic Syllabus</a></li>
	</ul>
</div>
<div class="row">
	<button type="button" class="btn btn-primary pull-right" style="margin-right:18px;" data-toggle="modal" data-target="#myModal">Add Syllabus</button>
</div>
<div class="panel panel-default" style="margin-top:24px;">
	<div class="panel-heading">Accademic Syllabus</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3" style="padding-right:0px !important;">
				<ul class="nav nav-pill nav-stacked">
					<?php
					$serialNo = 1;
					$classNav = $academics_obj->showAllClass();
					$section_id = [];
					foreach ($classNav as $rows) {
					?>
						<li style="clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%)"><a data-toggle="tab" href="#_<?php echo $serialNo; ?>"><?php echo $rows["name"] ?></a></li>
					<?php
						array_push($section_id, $rows["id"]);
						$serialNo = ++$serialNo;
					}	// foreach closed here

					?>
				</ul>
			</div>
			<div class="col-lg-9" style="padding-left:0px !important;">
				<div class="tab-content">
					<?php
					$serialNo = 1;
					$classes = $academics_obj->showAllClass();
					foreach ($classes as $rows2) {
						if ($serialNo == 1) {
					?>

							<div class="tab-pane fade in active" id="_<?php echo $serialNo; ?>">
								<div class="table-responsive thumbnail" style="padding: 10px;padding-bottom: 50px;">
									<table id="" class="table table-stripped table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Title</th>
												<th>Description</th>
												<th>Subject</th>
												<th>Date</th>
												<th>File</th>
												<th>Option</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$cId = 0;
											$syllabusList = $academics_obj->getAllSyllabus($rows2["id"], $_SESSION["session_id"]);
											if ($syllabusList != false) {
												foreach ($syllabusList as $rows) {
											?>
													<tr>
														<td><?php echo ++$cId ?></td>
														<td><?php echo $rows["title"] ?></td>
														<td><?php echo $rows["details"] ?></td>
														<td><?php echo $academics_obj->getColName("subjects", "name", $rows["subject_id"])  ?></td>
														<td><?php echo $rows["created_at"] ?></td>
														<td><?php if (empty($rows["file"])) {
																echo "N/A";
															} else {
																echo $rows["file"];
															}   ?></td>
														<td>
															<a href="index.php?page=academics/class/edit_syllabus&sId=<?php echo $rows["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
															<a href="index.php?page=academics/class/academic_syllabus&status=delete&sId=<?php echo $rows["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
														</td>
													</tr>
											<?php
												}
											} else {
												echo "<tr><td colspan='7'><h5 style='text-align:center;'>No Record Found</h5></td></tr>";
											}
											?>
										</tbody>
									</table>
								</div>
							</div>

						<?php
						} else {
						?>
							<div class="tab-pane fade" id="_<?php echo $serialNo; ?>">
								<div class="table-responsive thumbnail" style="padding: 10px;padding-bottom: 50px;">
									<table id="" class="table table-stripped table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Title</th>
												<th>Description</th>
												<th>Subject</th>
												<th>Date</th>
												<th>File</th>
												<th>Option</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$cId = 0;
											$syllabusList = $academics_obj->getAllSyllabus($rows2["id"], $_SESSION["session_id"]);

											if ($syllabusList != false) {


												foreach ($syllabusList as $rows) {
											?>
													<tr>
														<td><?php echo ++$cId ?></td>
														<td><?php echo $rows["title"] ?></td>
														<td><?php echo $rows["details"] ?></td>
														<td><?php echo $academics_obj->getColName("subjects", "name", $rows["subject_id"])  ?></td>
														<td><?php echo $rows["created_at"] ?></td>
														<td>
															<?php if (empty($rows["file"])) {
																echo "N/A";
															} else {
															?>
																<a href="<?php echo $rows["file"] ?>">View File</a>
															<?php
															}   ?>

														</td>
														<td>
															<a href="index.php?page=academics/class/edit_syllabus&sId=<?php echo $rows["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
															<a href="index.php?page=academics/class/academic_syllabus&status=delete&sId=<?php echo $rows["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
														</td>
													</tr>
											<?php
												}
											} else {
												echo "<tr><td colspan='7'><h5 style='text-align:center;'>No Record Found</h5></td></tr>";
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
					<?php
						}
						$serialNo = ++$serialNo;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Syllabus</h4>
			</div>
			<div class="modal-body">
				<form action="php/academics/class.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" name="title" id="title" class="form-control" placeholder="Title">
					</div>
					<div class="form-group">
						<label for="details">Details</label>
						<textarea name="details" class="form-control" id="details" cols="10" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="class">Select CLass</label>
						<select name="class_id" class="form-control" id="class" onchange="myfun(this.value)" required="required">
							<option value="">Select Class</option>
							<?php
							$classOptions = $academics_obj->showAllClass();
							foreach ($classOptions as $rows) {
							?>
								<option value="<?php echo $rows["id"] ?>"><?php echo $rows["name"] ?></option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="subject">Select Subject</label>
						<select name="subject_id" class="form-control" id="subject">
							<option value="">Select Class First</option>
						</select>
					</div>
					<div class="form-group">
						<label for="file">Upload File</label>
						<input type="file" id="file" name="file" class="form-control" />
						<small class="text-danger">Supported File Type: pdf, jpg and png</small>
					</div>
					<input type="submit" name="syllabus" class="btn btn-primary btn-md pull-right" value="Submit">
				</form>
			</div>

		</div>
	</div>
	<script type="text/javascript">
		function myfun(datavalue) {
			$.ajax({
				url: 'php/academics/get_data.php',
				type: 'POST',
				data: {
					class_id: datavalue
				},
				success: function(result, status) {
					$('#subject').html(result);
				}
			});
		}
	</script>
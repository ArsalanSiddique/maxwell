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
} else if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["sId"])) {
			$result = $academics_obj->deleteRecord("section", $_REQUEST["sId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=academics/class/manage_section&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=academics/class/manage_section&msg=del_false");</script>';
			}
		}
	}
}
?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Manage Section</a></li>
	</ul>
</div>

<div class="btn-group pull-right">
	<button type="button" id="" data-toggle="modal" data-target="#add_section" target="#mymodal" class="btn btn-primary">
		<span class="fa fa-plus"></span> &nbsp&nbsp Add Section
	</button>
</div>
<div class="modal fade col-md-6" role="dialog" id="add_section" style="margin-top:20px;margin-left: 25%;">
	<div class="modal-content">
		<div class="modal-header">
			School Name
			<button type="button" data-dismiss="modal" class="close">&times;</button>
		</div>
		<div class="modal-body">
			<h4><i class="fa fa-plus"></i>&nbsp Add Section</h4>
			<hr>
			<form method="post" action="php/academics/section.php" enctype="" class="form-group">
				<div class="form-group">
					<label>Section Name: <span class="red_required">*</span></label>
					<input type="text" name="name" id="" class="form-control" placeholder="Enter Section Name" required>
				</div>

				<div class="form-group">
					<label>Nick Name:</label>
					<input type="text" name="nick_name" id="" class="form-control" placeholder="Enter Nick Name" />
				</div>
				<div class="form-group">
					<label> Select Class: <span class="red_required">*</span> </label>
					<select name="class" id="" class="form-control" required>
						<option value="">Select CLass</option>
						<?php
						$classOptions = $academics_obj->showAllClass();
						foreach ($classOptions as $rows) {
						?>
							<option value="<?php echo $rows["id"] ?>"><?php echo $rows["name"] ?></option>
						<?php
						}	// options foreach closed
						?>
					</select>
				</div>
				<input type="submit" name="addSection" class="btn btn-success btn-default" style="margin-top:10px;" value="Submit" />
			</form>
		</div>
	</div>
</div>
<div class="panel panel-default" style="margin-top:50px;">
	<div class="panel-heading">Section Details</div>
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
					$sectionTable = $academics_obj->showAllClass();
					foreach ($sectionTable as $rows2) {
						if ($serialNo == 1) {
					?>

							<div class="tab-pane fade in active" id="_<?php echo $serialNo; ?>">
								<div class="table-responsive thumbnail" style="padding: 10px;padding-bottom: 50px;">
									<table class="table table-stripped table-bordered">
										<thead>
											<tr>
												<td>#</td>
												<td>Section Name</td>
												<td>Nick Name</td>
												<td>Action</td>
											</tr>
										</thead>
										<tbody>
											<?php
											$sId = 0;
											$sectionList = $academics_obj->showSection($section_id[$serialNo - 1]);
											if (!empty($sectionList)) {
												foreach ($sectionList as $rows) {
											?>
													<tr>
														<td><?php echo ++$sId ?></td>
														<td><?php echo $rows["name"] ?></td>
														<td><?php echo $rows["nick_name"] ?></td>
														<td>
															<a href="index.php?page=academics/class/edit_section&sId=<?php echo $rows["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
															<a href="index.php?page=academics/class/manage_section&status=delete&sId=<?php echo $rows["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
														</td>
													</tr>
											<?php
												}
											} else {
												echo '<tr><td colspan="4"><h5 style="text-align:center;">No Record Found</h5></td></tr>';
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
									<table class="table table-stripped table-bordered">
										<thead>
											<tr>
												<td>#Serial</td>
												<td>Section Name</td>
												<td>Nick Name</td>
												<td>Action</td>
											</tr>
										</thead>
										<tbody>
											<?php
											$sId = 0;
											$sectionList = $academics_obj->showSection($section_id[$serialNo - 1]);
											if (!empty($sectionList)) {
												foreach ($sectionList as $rows) {

											?>
													<tr>
														<td><?php echo ++$sId ?></td>
														<td><?php echo $rows["name"] ?></td>
														<td><?php echo $rows["nick_name"] ?></td>
														<td>
															<a href="index.php?page=academics/class/edit_section&sId=<?php echo $rows["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
															<a href="index.php?page=academics/class/manage_section&status=delete&sId=<?php echo $rows["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
														</td>
													</tr>
											<?php
												}
											} else {
												echo '<tr><td colspan="4"><h5 style="text-align:center;">No Record Found</h5></td></tr>';
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

<div class="row"></div>
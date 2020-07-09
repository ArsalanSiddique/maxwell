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
}
$notices = $academics_obj->showNotice();
$archived = $academics_obj->archiveNotices();

if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		$id = $_REQUEST["nId"];
		$result = $academics_obj->deleteRecord("notices", $id);
		if ($result == true) {
			echo '<script> window.location.replace("index.php?page=academics/noticeboard/noticeboard&msg=deltrue"); </script>';
		} else {
			echo '<script> window.location.replace("index.php?page=academics/noticeboard/noticeboard&msg=delfalse"); </script>';
		}
	}
}


?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Notice Board</a></li>
	</ul>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a href="#list" data-toggle="tab">NoticeBoard Lists</a></li>
	<li><a href="#add_list" data-toggle="tab">Add Noticeboard</a></li>
</ul>

<div class="tab-content" style="padding-top: 20px;">
	<div id="list" class="tab-pane fade in active">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#running" data-toggle="tab">Running Session</a></li>
			<li><a href="#archived" data-toggle="tab">Archived</a></li>
		</ul>
		<div class="tab-content" style="padding-top: 10px;">
			<div id="running" class="tab-pane fade in active">
				<div class="thumbnail" style="padding:20px;">
					<table id="example" class="table table-bordered table-stripped">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Notice</th>
								<th>Date</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							foreach ($notices as $notice) {
							?>
								<tr>
									<td><?php echo $count++; ?></td>
									<td><?php echo $notice["title"] ?></td>
									<td><?php echo $notice["details"] ?></td>
									<td><?php echo $notice["date"] ?></td>
									<td>
										<a href="index.php?page=academics/noticeboard/edit_notice&nId=<?php echo $notice["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
										<a href="index.php?page=academics/noticeboard/noticeboard&status=delete&nId=<?php echo $notice["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a> &nbsp;
										<a href="pages/academics/noticeboard/print_notice.php?nId=<?php echo $notice["id"] ?>" target="_BLANK"><i class="fa fa-print btn-print"></i></a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div id="archived" class="tab-pane fade">
				<div class="thumbnail" style="padding:20px;">
					<table id="example" class="table table-bordered table-stripped">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Notice</th>
								<th>Date</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$count = 1;
							foreach ($archived as $notice) {
							?>
								<tr>
									<td><?php echo $count++; ?></td>
									<td><?php echo $notice["title"] ?></td>
									<td><?php echo $notice["details"] ?></td>
									<td><?php echo $notice["date"] ?></td>
									<td>
										<a href="index.php?page=academics/noticeboard/edit_notice&nId=<?php echo $notice["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
										<a href="index.php?page=academics/noticeboard/noticeboard&status=delete&nId=<?php echo $notice["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="add_list" class="tab-pane fade">
		<div class="row">
			<div class="col-md-6">
				<div class="panel-default panel">
					<div class="panel-heading">
						Add Noticeboard
					</div>
					<div class="panel-body">

						<form action="php/academics/notice.php" class="form-group" method="post">
							<div class="form-group">
								<label for="title">title <span class="red_required">*</span></label>
								<input type="text" name="title" class="form-control" id="" required="required" />
							</div>
							<div class="form-group">
								<label for="notice">Notice <span class="red_required">*</span></label>
								<textarea name="details" class="form-control" id="" cols="30" rows="6"></textarea>
							</div>
							<div class="form-group">
								<label for="date">Date <span class="red_required">*</span></label>
								<input type="date" name="date" class="form-control" id="" required="required" />
							</div>
							<input type="submit" value="Add Notice" name="addNotice" class="btn btn-primary" />
						</form>

					</div>
				</div>
			</div>
		</div>



	</div>
</div>
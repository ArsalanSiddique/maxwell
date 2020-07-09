<?php
$students = $academics_obj->showAllStudents("active", $class, $section);
?>
<div class="row">
	<center>
		<div class="col-md-4 well" style="margin-left:33%">
			<p><span style="font-size:20px;font-family:tahoma;color:black;">Attendence For Class <?php echo $academics_obj->getClassById($class); ?></span></p>
			<p style="font-family:tahoma;color:black;">Section: <?php echo $academics_obj->getSectionById($section); ?></p>
			<p style="font-family:tahoma;color:black;"><?php echo $date; ?></p>
		</div>
	</center>
</div>

<!--Attendence Button-->
<div class="row" style="margin-left: 12px">
	<button type="button" class="btn btn-default"><i class="fa fa-times"> &nbsp </i>Mark As Holiday</button>
</div>

<!--Attendence Table-->
<div class="thumbnail table-responsive" style="margin:10px;">
	<div class="container" style="width:98%;padding:10px;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Reg No#</th>
					<th>Photo</th>
					<th>Name</th>
					<th>Attendence</th>
				</tr>
			</thead>
			<tbody>
				<form action="index.php" method="POST">
					<div class="row">
						<?php
						foreach ($students as $student) {
						?>
							<tr>

								<td><?php echo $student["reg_no"] ?></td>
								<td><img src="<?php echo $student["photo"] ?>" alt="" width="50"></td>
								<td><?php echo $student["name"] ?></td>
								<td>
									<div class="inline">
										<input type="radio" name="attendance_<?php echo $student["student_id"] ?>[]" id="">
										<label for="">Present</label>
										&nbsp;
										<input type="radio" name="attendance_<?php echo $student["student_id"] ?>[]" id="">
										<label for="">Late</label>
										&nbsp;
										<input type="radio" name="attendance_<?php echo $student["student_id"] ?>[]" id="">
										<label for="">Absent</label>
										&nbsp;
										<input type="radio" name="attendance_<?php echo $student["student_id"] ?>[]" id="">
										<label for="">Half Day</label>
										&nbsp;
									</div>
								</td>
							</tr>
						<?php } ?>
					</div>
					<div class="row" style="margin-bottom: 16px">
						<input type="submit" name="save_attendance" class="btn btn-primary pull-right" value="Save Attendance">
					</div>
				</form>
			</tbody>
		</table>
	</div>
</div>
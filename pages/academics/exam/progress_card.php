<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Progress_card</a></li>
	</ul>
</div>

<?php
require_once("php/academics.php");
$student_id = $_REQUEST["sId"];
$student = $academics_obj->getRecordById("students", $student_id);
$subjects = $academics_obj->showALlSubject($student["class_id"]);
$exams = $academics_obj->fetchAllRecord("exams");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Progress Card
		<div class="pull-right">
			<button class="btn btn-sm btn-primary" style="padding:4px;">Print</button>
		</div>
	</div>
	<div class="panel-body">
		<div class="row" style="padding: 0.5% 3%">

			<h3><?php echo $academics_obj->getColName("school_info", "name", "1"); ?> <span style="padding-left: 2%;font-size: 18px;"> <?php echo $campus_name ?> </span></h3>


			<div class="col-md-12" style="border-top: 2px solid grey;"></div>
			<div class="col-md-12" style="padding-top: 12px 0px 12px 0px; border-bottom:2px solid grey;">
				<div class="col-md-5 col-sm-5 col-xs-12">
					<h4>Student Name: <span style="text-transform: Uppercase; font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["name"] ?></span></h4>
					<h4>Class: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $academics_obj->getColName("class", "name", $student["class_id"]) ?></span></h4>
					<h4>Regist# <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["reg_no"] ?></span></h4>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-12">
					<h4>Father Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["father_name"] ?></span></h4>
					<h4>Section Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $academics_obj->getColName("section", "nick_name", $student["section_id"]) . " - " . $academics_obj->getColName("section", "name", $student["section_id"]) ?></span></h4>

					<input type="text" name="exam_name" id="exam" class="form-control" id="" placeholder="Name Of Exam">

				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<img src="<?php echo $student["photo"] ?>" class="img-thumbnail pull-right" style="margin:1%;" width="120px" alt="profile">
				</div>
			</div>
		</div>
		<div class="row" style="padding: 1% 5% 0% 5%;">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="vertical-align: middle; width: 124px;">Subject Name</th>
						<?php $marks =  0;
						foreach ($exams as $exam) {
							$marks += $exam["marks"] ?>
							<th style="vertical-align: middle;"><?php echo $exam["name"] ?></th>
						<?php } ?>
						<th style="vertical-align: middle; width: 100px;">Obtained Marks</th>
						<th style="vertical-align: middle; width: 100px;">Max Marks</th>
						<th style="vertical-align: middle;">Percentage</th>
						<th style="vertical-align: middle;">Grade</th>
						<th style="vertical-align: middle;">Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$max_marks = 0;
					$obtained_marks = 0;
					$max_marks = 0;
					$count = 0;
					foreach ($subjects as $subject) {
						$count++;
					?>
						<tr>
							<td><?php echo $subject["name"] ?></td>
							<?php
							$std_marks =  0;
							$total_marks_max = 0;
							foreach ($exams as $exam) { ?>
								<td>
									<?php echo $marks = $academics_obj->fetchExamMarks($exam["id"], $student["class_id"], null, $subject["id"], $student["id"]);
									echo " / ";
									echo $marks_max = $academics_obj->fetchExamMaxMarks($exam["id"], $student["class_id"], null, $subject["id"], $student["id"]);
									$total_marks_max += $marks_max;
									?>
								</td>
							<?php $std_marks += $marks;
							} ?>
							<td><?php $obtained_marks += $std_marks;
								echo $std_marks ?></td>
							<td><?php echo $total_marks_max; $total_marks_max2 += $total_marks_max ?></td>
							<td><?php $percentage = (($std_marks / $total_marks_max) * 100);
								if (is_nan($percentage)) {
									echo "NILL";
								} else {
									$avg_percent += $percentage;
									echo $percentage . " %";
								} ?></td>
							<td><?php $data =  $academics_obj->gradeCalc($percentage); echo $data[0] ?></td>
							<td><?php echo $data[1] ?></td>
						</tr>
					<?php } ?>
				<tfoot>
					<tr>
						<td colspan="4"></td>
						<td><b>Total Marks</b></td>
						<td><?php echo $total_marks_max2 ?></td>
						<td colspan="2"><b>Marks Obtained</b></td>
						<td><?php echo $obtained_marks ?></td>
					</tr>
					<tr>
						<td colspan="4"></td>
						<td><b>Percentage</b></td>
						<td><?php echo number_format(($avg_percent / $count), 2) . " %";  ?></td>
						<td colspan="2"><b>Grade</b></td>
						<td></td>
					</tr>
					<tr>
						<td style="height: 84px; vertical-align: middle;"><b>STAMP & SIGNATURE</b></td>
						<td colspan="4"></td>
						<td style="vertical-align: middle;"><b>PARENTS SIGNATURE</b></td>
						<td colspan="3"></td>
					</tr>
				</tfoot>
				</tbody>
			</table>
		</div>
	</div>

</div>
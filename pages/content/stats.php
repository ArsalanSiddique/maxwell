<?php
require_once("php/academics.php");
require_once("php/account.php");
$students =  $academics_obj->fetchAllRecord("students");
$count_students = mysqli_num_rows($students);

$users =  $academics_obj->fetchAllRecord("users");
$count_users = mysqli_num_rows($users);

$teachers =  $academics_obj->fetchAllRecord("teachers");
$count_teachers = mysqli_num_rows($teachers);
$staff = $count_teachers + $count_users;

$parents =  $academics_obj->fetchAllRecord("parents");
$count_parents = mysqli_num_rows($parents);

$due_fee = $account_obj->fetchDueFees();
$total_due_fee = 0;
foreach ($due_fee as $data) {
	$total_due_fee += ($data["total_amount"] - $data["paid_amount"] + $data["fine"]) - $data["discount"];
}


?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);margin-bottom:0px;">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> &nbsp Dashboard</a></li>
	</ul>
</div>

<div class="row" style="margin-top: 2%;">
	<div class="col-md-3 col-sm-6 col-xs-6 box4" style="background-color:rgb(255, 138, 102);">
		<div class="icon">
			<i class="fa fa-users" style="font-size:7em;opacity:0.1;"></i>
		</div>
		<p class="box4-txt">Parents:</p>
		<p class="pull-right timer count-title count-number counterCss" data-to="<?php echo $count_parents ?>" data-speed="1500"></p>
	</div>
	<div class="col-md-3 box4" style="background-color:rgb(76, 182, 172);">
		<div class="icon">
			<i class="fa fa-pencil-square-o" style="font-size:7em;opacity:0.1;"></i>
		</div>
		<p class="box4-txt">Due Fees:</p>
		<p class="pull-right timer count-title count-number counterCss" data-to="<?php echo $total_due_fee; ?>" data-speed="1500"></p>
	</div>
	<div class="col-md-3 box4" style="background-color:rgb(240, 98, 146);">
		<div class="icon">
			<i class="fa fa-suitcase" style="font-size:7em;opacity:0.1;"></i>
		</div>
		<p class="box4-txt">Present Staff:</p>
		<p class="pull-right timer count-title count-number counterCss" data-to="<?php echo $staff ?>" data-speed="1500"></p>
	</div>
	<div class="col-md-3 box4" style="background-color:rgb(150, 177, 206);">
		<div class="icon">
			<i class="fa fa-users" style="font-size:7em;opacity:0.1;"></i>
		</div>
		<p class="box4-txt">Total Students:</p>
		<p class="pull-right timer count-title count-number counterCss" data-to="<?php echo $count_students ?>" data-speed="1500"></p>
	</div>
</div>


<div class="row" style="padding: 30px 15px;">



	<!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		// Load the Visualization API and the corechart package.
		google.charts.load('current', {
			'packages': ['corechart']
		});

		// Set a callback to run when the Google Visualization API is loaded.
		google.charts.setOnLoadCallback(drawChart);

		// Callback that creates and populates a data table,
		// instantiates the pie chart, passes in the data and
		// draws it.
		function drawChart() {

			// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Title');
			data.addColumn('number', 'Amount');
			data.addRows([
				// ['Mushrooms', 3],
				// ['Onions', 1],
				// ['Olives', 1],
				// ['Zucchini', 1],
				// ['Pepperoni', 2]
				<?php
				$result = $account_obj->fetchExpenseGraph();
				foreach ($result as $record) {
					$title = $record["title"];
					$amount = $record["amount"];
					echo "['$title', $amount],";
				}
				?>
			]);

			// Set chart options
			var options = {
				'width': 450,
				'height': 400
			};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
	</script>


	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['bar']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Month', 'Total', 'Paid', 'Due Fees'],
				<?php

				for ($i = 1; $i <= 12; $i++) {
					$day = sprintf("%02d", $i);
					$month = date("Y") . "-" . $day;
					$data = $account_obj->fetchMonthlyPayment($month, $_SESSION["session_id"]);
					$month_name = date("F", mktime(0, 0, 0, $i, 20));
					$no_due = 105;
					echo "['$month_name', $data[0], $data[1], $data[2]],";
				}

				?>
				// ['2014', 1000, 400, 200],
				// ['2015', 1170, 460, 250],
				// ['2016', 660, 1120, 300],
				// ['2017', 1030, 540, 350]
			]);

			var options = {
				chart: {
					title: 'Monthly Report',
					subtitle: 'Total Fees, Total Paid & No. of Dues: <?php echo $academics_obj->getColName("session", "session_start", $_SESSION["session_id"]) . " - " . $academics_obj->getColName("session", "session_start", $_SESSION["session_id"]) ?>',
				},
				bars: 'vertical',
				vAxis: {
					format: 'short'
				},
				height: 400,
				colors: ['#1b9e77', '#d95f02', '#7570b3']
			};

			var chart = new google.charts.Bar(document.getElementById('chart_div2'));

			chart.draw(data, google.charts.Bar.convertOptions(options));

			var btns = document.getElementById('btn-group');

			btns.onclick = function(e) {

				if (e.target.tagName === 'BUTTON') {
					options.vAxis.format = e.target.id === 'none' ? '' : e.target.id;
					chart.draw(data, google.charts.Bar.convertOptions(options));
				}
			}
		}
	</script>

	<script>
		google.charts.load('current', {
			packages: ['corechart', 'line']
		});
		google.charts.setOnLoadCallback(drawLineColors);

		function drawLineColors() {
			var data = new google.visualization.DataTable();
			data.addColumn('number', 'X');
			data.addColumn('number', 'Present');
			data.addColumn('number', 'Absent');

			data.addRows([
				[0, 0, 0],
				// [1, 100, 5],
				// [2, 98, 07],
				// [3, 95, 10],
				// [4, 101, 4],
				// [5, 95, 10],
				// [6, 90, 15],
				// [6, 0, 0],
				// [7, 0, 0],
				// [8, 0, 0],
				// [9, 0, 0]
				<?php
				$month_number = date("m");
				$year = date("Y");
				$start_date = "$year-$month_number-01";
				$last_date = date("t", strtotime($start_date));

				for ($i = 1; $i <= $last_date; $i++) {

					$day = sprintf("%02d", $i);
					$date = "$year-$month_number-$day";
					$result = $academics_obj->fetchAttendanceGraph($date);

					$attendance = $result[0];
					$absent = $result[1];

					if (!is_int($attendance)) {
						$attendance = 0;
					} else if (!is_int($absent)) {
						$absent = 0;
					}
					if ($result[1] > 0) {
						echo "[$i, $attendance, $result[1]],";
					} else {
						$absent = 0;
						echo "[$i, $attendance, $absent],";
					}
				}

				?>

			]);

			var options = {
				hAxis: {
					title: 'Days'
				},
				vAxis: {
					title: 'Students'
				},
				colors: ['#a52714', '#097138']
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
			chart.draw(data, options);
		}
	</script>


	<div class="panel panel-default">
		<div class="panel-heading">
			Monthly Fee Summary
		</div>
		<div class="panel-body">
			<div id="chart_div2"></div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Monthly Attendance Summary
		</div>
		<div class="panel-body">
			<div id="chart_div3"></div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Monthly Expense Summary
				</div>
				<div class="panel-body">
					<div id="chart_div"></div>
				</div>
			</div>
		</div>
	</div>

</div>



<!-- 
<div class="row" style="padding:30px 15px;">
	<div class="panel panel-default">
		<div class="panel-heading">
			<img src="images/3x3-grid.png" alt="" /> &nbsp Quick Links
		</div>
		<div class="panel-body">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:cornflowerblue;">
				<a href="index.php?page=academics/students/student_information">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">Students</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:darkturquoise;">
				<a href="index.php?page=sms/student_attendence">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">SMS-A</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:rosybrown;">
				<a href="index.php?page=sms/student_marks">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">SMS Marks</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:steelblue;">
				<a href="index.php?page=academics/students/student_information">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">Timetable</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:goldenrod;">
				<a href="index.php?page=academics/attendence/daily_attendence">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">Attendance</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:tomato;">
				<a href="index.php?page=academics/noticeboard">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">Noticeboard</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:violet;">
				<a href="index.php?page=accounts/fee_payment">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">Fee Paym.</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:darkgrey;">
				<a href="index.php?page=hr/teacher">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">Teacher</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:lightsteelblue;">
				<a href="index.php?page=academics/exam/exam_list">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">Exam</p>
				</a>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 shortlink_box" style="background-color:deepskyblue;">
				<a href="index.php?page=sms/sms_to_student">
					<i class="fa fa-user" style="font-size: 24px;"></i>
					<p style="color:white;font-size:14px;font-weight:bold;">STS</p>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-calendar"></i> &nbsp Event Schedule</div>
			<div class="panel-body">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading"> &nbsp Noticeboard</div>
			<div class="panel-body">
				<div class="row noticeboard">
					<h5 class="notice_date">06 Dec, 2019</h5>
					<h4 class="notice_heading">Notice Name<span class="notice_time">2 hours</span></h4>
					<p class="notice_content">lorem ipsum dolar ismit lorem ipsum dolar ismit lorem ipsum dolar ismit </p>
					<hr />
				</div>
				<div class="row noticeboard">
					<h5 class="notice_date">06 Dec, 2019</h5>
					<h4 class="notice_heading">Notice Name<span class="notice_time">2 hours</span></h4>
					<p class="notice_content">lorem ipsum dolar ismit lorem ipsum dolar ismit lorem ipsum dolar ismit </p>
					<hr />
				</div>
				<div class="row noticeboard">
					<h5 class="notice_date">06 Dec, 2019</h5>
					<h4 class="notice_heading">Notice Name<span class="notice_time">2 hours</span></h4>
					<p class="notice_content">lorem ipsum dolar ismit lorem ipsum dolar ismit lorem ipsum dolar ismit </p>
					<hr />
				</div>
				<div class="row noticeboard">
					<h5 class="notice_date">06 Dec, 2019</h5>
					<h4 class="notice_heading">Notice Name<span class="notice_time">2 hours</span></h4>
					<p class="notice_content">lorem ipsum dolar ismit lorem ipsum dolar ismit lorem ipsum dolar ismit </p>
					<hr />
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row" style="padding: 10px 15px;">
	<div class="panel panel-default">
		<div class="panel-heading"> &nbsp Expense Table</div>
		<div class="panel-body">

			<div class="table-responsive thumbnail">
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID No</th>
							<th>Expense Type</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Name</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($_POST["info"])) {
							extract($_POST);

							$object->stdnt_info($status, $class, $section);
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row" style="padding: 10px 15px;">
	<div class="panel panel-default">
		<div class="panel-heading"> &nbsp Fee Collection & Expenses</div>
		<div class="panel-body">
			<canvas id="myChart"></canvas>
		</div>
	</div>
</div> -->
<body data-spy="scroll" data-target=".list-unstyled" data-offset="50">
	<div class="wrapper">
		<!-- Sidebar Holder -->

		<nav id="sidebar">
			<div class="sidebar-header">
				<a href="index.php" style="color: white;">
					<img style="width:120px;margin-left:60px;" src="images/logo_sms_v2.png" />
				</a>
				<!-- <strong>SMS</strong> -->
			</div>

			<ul class="list-unstyled components sticky">
				<li class="">
					<a href="index.php"><i class="fa fa-dashboard"></i>Dashboard</a>
				</li>
				<li class="">
					<a href="index.php?page=content/stats"><i class="fa fa-bar-chart"></i>Live Graph</a>
				</li>
				<li><a href="#students" data-toggle="collapse" aria-expanded="false"><i class="fa fa-users"></i> Students</a>
					<ul class="collapse tree list-unstyled" id="students">
						<li><a href="index.php?page=academics/students/admit_student"><i class="fa fa-circle-o"></i> Admit Student</a></li>
						<li><a href="index.php?page=academics/students/student_information"><i class="fa fa-circle-o"></i> Student Information</a></li>
						<li><a href="index.php?page=academics/students/student_promotion"><i class="fa fa-circle-o"></i> Student Promotion</a></li>
					</ul>
				</li>
				<li><a href="#parent" data-toggle="collapse" aria-expanded="false"><i class="fa fa-child"></i> Parents</a>
					<ul class="collapse tree list-unstyled" id="parent">
						<li><a href="index.php?page=academics/registeration/parents"><i class="fa fa-circle-o"></i> Register Parents</a></li>
						<li><a href="index.php?page=academics/registeration/parents_info"><i class="fa fa-circle-o"></i> Parents Information</a></li>
					</ul>
				</li>
				<li><a href="#class" data-toggle="collapse" aria-expanded="false"><i class="fa fa-sitemap"></i> Class</a>
					<ul class="collapse tree list-unstyled" id="class">
						<li><a href="index.php?page=academics/class/manage_class"><i class="fa fa-circle-o"></i> Manage Class</a></li>
						<li><a href="index.php?page=academics/class/manage_section"><i class="fa fa-circle-o"></i> Manage Section</a></li>
						<li><a href="index.php?page=academics/class/academic_syllabus"><i class="fa fa-circle-o"></i> Academic Syllabus</a></li>
					</ul>
				</li>
				<li><a href="index.php?page=academics/subjects/subjects"><i class="fa fa-book"></i> Subjects</a></li>
				<li><a href="index.php?page=academics/time_table/timetable"><i class="fa fa-calendar"></i> TimeTable</a></li>
				<li><a href="#attendence" data-toggle="collapse" aria-expanded="false"><i class="fa fa-line-chart"></i> Attendence</a>
					<ul class="collapse tree list-unstyled" id="attendence">
						<li><a href="index.php?page=academics/attendence/daily_attendence"><i class="fa fa-circle-o"></i> Daily Attendance </a></li>
						<li><a href="index.php?page=academics/attendence/attendence_reports"><i class="fa fa-circle-o" id="close"></i> Attendance report </a></li>
					</ul>
				</li>
				<li><a href="#exam" data-toggle="collapse" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> Exam</a>
					<ul class="collapse tree list-unstyled" id="exam">
						<li><a href="index.php?page=academics/exam/exam_list"><i class="fa fa-circle-o"></i> Exam List </a></li>
						<li><a href="index.php?page=academics/exam/exam_grades"><i class="fa fa-circle-o"></i> Exam Grades</a></li>
						<li><a href="index.php?page=academics/exam/manage_marks"><i class="fa fa-circle-o"></i> Manage Marks</a></li>
						<li><a href="index.php?page=academics/exam/tabulation_sheet"><i class="fa fa-circle-o"></i> Tabulation Sheet</a></li>
						<li><a href="index.php?page=academics/exam/students"><i class="fa fa-circle-o"></i> Progress Card </a></li>
					</ul>
				</li>
				<li><a href="index.php?page=academics/noticeboard/noticeboard"><i class="fa fa-sticky-note"></i> Noticeboard</a></li>
				<!-- <li><a href="index.php?page=academics/transport"><i class="fa fa-bus"></i> Transport</a></li> -->

				<li><a href="#hr" data-toggle="collapse" aria-expanded="false"><i class="fa fa-rocket"></i> HR</a>
					<ul class="collapse list-unstyled" id="hr">
						<li><a href="index.php?page=hr/teacher"><i class="fa fa-users"></i> Teacher</a></li>
						<li><a href="index.php?page=hr/add_teacher"><i class="fa fa-user-plus"></i> Add Teacher</a></li>
					</ul>
				</li>
				<li><a href="#expense" data-toggle="collapse" aria-expanded="false"><i class="fa fa-money"></i> Expense</a>
					<ul class="collapse list-unstyled" id="expense">
						<li><a href="index.php?page=accounts/expense/category"><i class="fa fa-circle-o"></i> Expense Category</a></li>
						<li><a href="index.php?page=accounts/expense/expense"><i class="fa fa-circle-o"></i> Expense</a></li>
					</ul>
				</li>
				<li><a href="#acounts" data-toggle="collapse" aria-expanded="false"><i class="fa fa-suitcase"></i> Accounts</a>
					<ul class="collapse list-unstyled" id="acounts">
						<li><a href="index.php?page=accounts/accountant/accountant"><i class="fa fa-circle-o"></i> Accountant</a></li>
						<!-- <li><a href="index.php?page=accounts/payment_category"><i class="fa fa-circle-o"></i> Payment Category</a></li> -->
						<li><a href="index.php?page=accounts/payment/create_student_payments"><i class="fa fa-circle-o"></i> Create Student Payments</a></li>
						<li><a href="index.php?page=accounts/payment/fee_payment"><i class="fa fa-circle-o"></i> Fee Payment</a></li>
						<li><a href="index.php?page=accounts/payment/payment_setting"><i class="fa fa-circle-o"></i> Fee Setting</a></li>
					</ul>
				</li>
				<li><a href="#sms" data-toggle="collapse" aria-expanded="false"><i class="fa fa-envelope"></i> SMS</a>
					<ul class="collapse list-unstyled" id="sms">
						<li><a href="index.php?page=sms/student_attendence"><i class="fa fa-circle-o"></i> Student Atttendence</a></li>
						<li><a href="index.php?page=sms/student_marks"><i class="fa fa-circle-o"></i> Student Marks</a></li>
						<li><a href="index.php?page=sms/fee_due"><i class="fa fa-circle-o"></i> Fee Due</a></li>
						<li><a href="index.php?page=sms/annoucement_events"><i class="fa fa-circle-o"></i> Annoucement/Events</a></li>
						<li><a href="index.php?page=sms/sms_to_student"><i class="fa fa-circle-o"></i> SMS To Students</a></li>
						<li><a href="index.php?page=sms/sms_to_teacher"><i class="fa fa-circle-o"></i> SMS To Teacher</a></li>
						<li><a href="index.php?page=sms/sms_to_parents"><i class="fa fa-circle-o"></i> SMS To Parents</a></li>
					</ul>
				</li>
				<li><a href="#settings" data-toggle="collapse" aria-expanded="false"><i class="fa fa-cogs"></i> Settings</a>
					<ul class="collapse list-unstyled" id="settings">
						<li><a href="index.php?page=administrator/general_setting"><i class="fa fa-circle-o"></i> General Settings</a></li>
						<li><a href="index.php?page="><i class="fa fa-circle-o"></i> SMS Settings</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<!-- Page Content Holder -->
		<div class="col-lg-12">
			<div class="row">
				<nav class="navbar navbar-default">
					<div class="container-fluid">

						<div class="navbar-header">
							<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
								<span><i onclick="myFunction(this)" class="fa fa-bars"></i></span>
							</button>
						</div>

						<div class="logout pull-right">
							<p>
								<a href="index.php?signout=signout"><button class="btn btn-danger" type="button">
										<i class="fa fa-power-off" style="font-size: 28px;"></i>
									</button></a>
							</p>
						</div>

						<div class="dropdown pull-right" style="margin-right: 5px;">
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
								<img src="images/admin.png" class="img-rounded" alt="admin" width="30px">
								Hi, <?php require_once("php/academics.php");
									echo $academics_obj->getColName("users", "user_name", $_SESSION["user_id"]) ?>
								<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="index.php?page=administrator/profile">Profile</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
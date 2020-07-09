	
	<body data-spy="scroll" data-target=".list-unstyled" data-offset="50">
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar" style="min-height:100vh;">
                <a href="index.php"><div class="sidebar-header">
                    <img style="width:120px;margin-left:60px;" src="images/logo_sms_new_2.png" />
                    <!-- <strong>N/L</strong> -->
                </div></a>

		        <ul class="list-unstyled components">
		          <li class="">
		            <a href="index.php"><i class="fa fa-dashboard"></i>Dashboard</a>
		          </li>
		          <li>
		            <a href="#academics" data-toggle="collapse" aria-expanded="false"><i class="fa fa-graduation-cap"></i>Academics</a>
		            <ul class="collapse list-unstyled" id="academics">
		              <li><a href="#students" data-toggle="collapse" aria-expanded="false"><i class="fa fa-users"></i> Students</a>
		              	<ul class="collapse tree list-unstyled" id="students">
		              		<li><a href="index.php?page=academics/students/student_information"><i class="fa fa-circle-o"></i> Student Information</a></li>
		              	</ul>
		              </li>
		              <li><a href="#class" data-toggle="collapse" aria-expanded="false"><i class="fa fa-sitemap"></i> Class</a>
						<ul class="collapse tree list-unstyled" id="class">
		              		<li><a href="index.php?page=academics/class/academic_syllabus"><i class="fa fa-circle-o"></i> Academic Syllabus</a></li>
		              	</ul>
		              </li>
					  <li><a href="index.php?page=academics/subjects/subjects"><i class="fa fa-book"></i> Subjects</a></li>
					  <li><a href="index.php?page=academics/time_table/timetable"><i class="fa fa-calendar"></i> TimeTable</a></li>
		              <li><a href="#attendence" data-toggle="collapse" aria-expanded="false"><i class="fa fa-line-chart"></i> Attendence</a>
						<ul class="collapse tree list-unstyled" id="attendence">
		              		<li><a href="index.php?page=academics/attendence/attendence_reports"><i class="fa fa-circle-o" id="close"></i> Attendance report </a></li>
		              	</ul>
		              </li>
		              <li><a href="#exam" data-toggle="collapse" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> Exam</a>
						<ul class="collapse tree list-unstyled" id="exam">
		              		<li><a href="index.php?page=academics/exam/exam_list"><i class="fa fa-circle-o"></i> Exam List </a></li>
			                <li><a href="index.php?page=academics/exam/exam_grades"><i class="fa fa-circle-o"></i> Exam Grades</a></li>
			                <li><a href="index.php?page=academics/exam/progress_card"><i class="fa fa-circle-o"></i> Progress Card </a></li>
		              	</ul>
		              </li>
		              <li><a href="index.php?page=academics/noticeboard"><i class="fa fa-circle-o"></i> Noticeboard</a></li>
		              <li><a href="index.php?page=academics/transport"><i class="fa fa-bus"></i> Transport</a></li>
		            </ul>
		          </li>
		          <li><a href="#hr" data-toggle="collapse" aria-expanded="false"><i class="fa fa-rocket"></i> HR</a>
		            <ul class="collapse list-unstyled" id="hr">
		              <li><a href="index.php?page=hr/teacher"><i class="fa fa-users"></i> Teacher</a></li>
		            </ul>
		          </li>
		          <li><a href="#acounts" data-toggle="collapse" aria-expanded="false"><i class="fa fa-suitcase"></i> Accounts</a>
		            <ul class="collapse list-unstyled" id="acounts">
		              <li><a href="index.php?page=accounts/accountant"><i class="fa fa-circle-o"></i> Accountant</a></li>
		              <li><a href="index.php?page=accounts/fee_payment"><i class="fa fa-circle-o"></i> Fee Payment</a></li>
		              <li><a href="index.php?page=accounts/expense"><i class="fa fa-circle-o"></i> Expense</a></li>
		              <li><a href="index.php?page=accounts/reports"><i class="fa fa-circle-o"></i> Reports</a></li>
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
		                                
		                                <span><i onclick="myFunction(this)" class="fa fa-arrow-left"></i></span>
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
								    	<img src="images/admin.png" class="img-rounded"  alt="admin" width="30px">
								    	Hi, Admin
								    <span class="caret"></span></button>
								    <ul class="dropdown-menu">
								      <li><a href="index.php?page=administrator/profile">Profile</a></li>
								      <li><a href="index.php?page=administrator/general_setting">Setting</a></li>
								    </ul>
								</div>
		                    </div>
		                </nav>
				</div>	

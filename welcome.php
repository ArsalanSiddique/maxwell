<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>School Software</title>

    <!-- JQuery Calender-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Image Uploader -->
    <link rel="stylesheet" href="css/bootstrap-imageupload.min.css">
    <!-- Bootstrap Datatables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style4.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- m/y picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">

</head>

<body data-spy="scroll" data-target=".list-unstyled" data-offset="50">
    <div class="wrapper">
        <!-- Sidebar Holder -->


        <!-- Page Content Holder -->
        <div class="col-lg-12">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <a href="index.php" style="color: white;">
                            <img style="width: 84px;margin-left: 48px;" src="images/logo_sms_new_2.png" />
                        </a>

                        <div class="logout pull-right" style="margin-top: 24px;">
                            <p>
                                <a href="index.php?signout=signout"><button class="btn btn-danger" type="button">
                                        <i class="fa fa-power-off" style="font-size: 28px;"></i>
                                    </button></a>
                            </p>
                        </div>

                        <div class="dropdown pull-right" style="margin: 24px 5px;">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                <img src="images/admin.png" class="img-rounded" alt="admin" width="30px">
                                Hi, Admin
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?page=administrator/profile">Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);margin-bottom:0px;">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> &nbsp Dashboard</a></li>
                </ul>
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal">
                    <div class="img">
                        <img src="images/menu_icon/1-01.png" alt="icon">
                    </div>
                    <p>Pre Registration</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal_new">
                    <div class="img">
                        <img src="images/menu_icon/4-01.png" alt="icon">
                    </div>
                    <p>Admission</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal2">
                    <div class="img">
                        <img src="images/menu_icon/3-01.png" alt="icon">
                    </div>
                    <p>Fee Management</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal3">
                    <div class="img">
                        <img src="images/menu_icon/7-01.png" alt="icon">
                    </div>
                    <p>Attendance Manage</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal7">
                    <div class="img">
                        <img src="images/menu_icon/5-01.png" alt="icon">
                    </div>
                    <p>Campus Controll</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal4">
                    <div class="img">
                        <img src="images/menu_icon/8-01.png" alt="icon">
                    </div>
                    <p>Reports</p>
                </div>
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal9">
                    <div class="img">
                        <img src="images/menu_icon/25-01.png" alt="icon">
                    </div>
                    <p>SMS</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal10">
                    <div class="img">
                        <img src="images/menu_icon/23-01.png" alt="icon">
                    </div>
                    <p>Academics</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal11">
                    <div class="img">
                        <img src="images/menu_icon/24-01.png" alt="icon">
                    </div>
                    <p>Class</p>
                </div>
                <a href="index.php?page=academics/subjects/subjects">
                    <div class="col-md-2 box5">
                        <div class="img">
                            <img src="images/menu_icon/24-01.png" alt="icon">
                        </div>
                        <p>Subjects</p>
                    </div>
                </a>
                <a href="index.php?page=content/stats">
                    <div class="col-md-2 box5">
                        <div class="img">
                            <img src="images/menu_icon/14-01.png" alt="icon">
                        </div>
                        <p>Live Dashboard</p>
                    </div>
                </a>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal8">
                    <div class="img">
                        <img src="images/menu_icon/16-01.png" alt="icon">
                    </div>
                    <p>Accounts</p>
                </div>
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal6">
                    <div class="img">
                        <img src="images/menu_icon/15-01.png" alt="icon">
                    </div>
                    <p>HR Management</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal12">
                    <div class="img">
                        <img src="images/menu_icon/17-01.png" alt="icon">
                    </div>
                    <p>Student</p>
                </div>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal5">
                    <div class="img">
                        <img src="images/menu_icon/13-01.png" alt="icon">
                    </div>
                    <p>Examinatoin & Results</p>
                </div>
                <a href="index.php?page=academics/transport">
                    <div class="col-md-2 box5">
                        <div class="img">
                            <img src="images/menu_icon/21-01.png" alt="icon">
                        </div>
                        <p>Transport</p>
                    </div>
                </a>
                <a href="index.php?page=academics/noticeboard/noticeboard">
                    <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal5">
                        <div class="img">
                            <img src="images/menu_icon/21-01.png" alt="icon">
                        </div>
                        <p>Noticeboard</p>
                    </div>
                </a>
                <div class="col-md-2 box5" data-toggle="modal" data-target="#myModal13">
                    <div class="img">
                        <img src="images/menu_icon/15-01.png" alt="icon">
                    </div>
                    <p>Expense</p>
                </div>
            </div>
            <div class="row" style="margin-top:2%;">
                <a href="index.php?page=administrator/general_setting">
                    <div class="col-md-2 box5">
                        <div class="img">
                            <img src="images/menu_icon/22-01.png" alt="icon">
                        </div>
                        <p>Settings</p>
                    </div>
                </a>
                <a href="">
                    <div class="col-md-2 box5">
                        <div class="img">
                            <img src="images/menu_icon/2-01.png" alt="icon">
                        </div>
                        <p>SMS API Integration</p>
                    </div>
                </a>
                <a href="">
                    <div class="col-md-2 box5">
                        <div class="img">
                            <img src="images/menu_icon/2-01.png" alt="icon">
                        </div>
                        <p>Generate Class Fees</p>
                    </div>
                </a>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Registration</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=academics/students/admit_student&status=in-active">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/menu_icon/1-01-inner.png" alt="icon">
                                        </div>
                                        <p>Admit Student</p>
                                    </div>
                                </a>
                                <a href="index.php?page=academics/registeration/parents">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/menu_icon/1-03-inner.png" alt="icon">
                                        </div>
                                        <p>Register Parents</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal_new" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Registration</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=academics/students/admit_student">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/menu_icon/1-01-inner.png" alt="icon">
                                        </div>
                                        <p>Admit Student</p>
                                    </div>
                                </a>
                                <a href="index.php?page=academics/registeration/parents">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/menu_icon/1-03-inner.png" alt="icon">
                                        </div>
                                        <p>Register Parents</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal4" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Exam Report</p>
                                </div>
                                <div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Attendance Report</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal3" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=academics/attendence/daily_attendence">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Daily Attendance</p>
                                    </div>
                                </a>
                                <a href="">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Staff Attendance</p>
                                    </div>
                                </a>
                                <a href="index.php?page=academics/attendence/attendence_reports">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Attendance Report</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal2" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=accounts/payment/create_student_payments">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Student Payment</p>
                                    </div>
                                </a>
                                <a href="index.php?page=accounts/payment/fee_payment">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Fee Payment</p>
                                    </div>
                                </a>

                                <a href="index.php?page=accounts/payment/payment_setting">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Fee Setting</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal5" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=academics/exam/exam_list">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Exam List</p>
                                    </div>
                                </a>
                                <a href="index.php?page=academics/exam/exam_grades">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Exam Grades</p>
                                    </div>
                                </a>
                                <a href="index.php?page=academics/exam/manage_marks">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Manage Marks</p>
                                    </div>
                                </a>
                                <a href="index.php?page=academics/exam/tabulation_sheet">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Tabulation Sheet</p>
                                    </div>
                                </a>
                                <a href="index.php?page=academics/exam/tabulation_sheet">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Progress Card</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal6" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=hr/teacher">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Teacher List</p>
                                    </div>
                                </a>
                                <a href="index.php?page=hr/add_teacher">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Add Teacher</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal7" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=administrator/general_setting"><div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Campus List</p>
                                </div></a>
                                <a href="index.php?page=administrator/general_setting"><div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Add Campus</p>
                                </div></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal8" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <a href="index.php?page=accounts/accountant/accountant"><div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Accountant</p>
                                </div></a>
                                <a href="index.php?page=accounts/payment/create_student_payments"><div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Payment Category</p>
                                </div></a>
                                <a href="index.php?page=accounts/payment/fee_payment"><div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Create Payment</p>
                                </div></a>
                                <a href="index.php?page=accounts/payment/payment_setting"><div class="inner-box">
                                    <div class="img">
                                        <img src="images/admin.png" alt="icon">
                                    </div>
                                    <p>Fee Payment</p>
                                </div></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal9" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="vertical-menu">
                                <div class="row">
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>SMS Attendance</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>SMS To Students</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>SMS To Staff</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>SMS To Parents</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Annoucement</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Student Marks</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Fee Due</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="img">
                                            <img src="images/admin.png" alt="icon">
                                        </div>
                                        <p>Fee Payment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal10" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Academics</h4>
                        </div>
                        <div class="modal-body">
                            <div class="vertical-menu">
                                <div class="row">
                                    <a href="index.php?page=academics/subjects/subjects">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Subjects</p>
                                        </div>
                                    </a>
                                    <a href="index.php?page=academics/time_table/timetable">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Time Table</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal11" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="vertical-menu">
                                <div class="row">
                                    <a href="index.php?page=academics/class/manage_class">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Manage Class</p>
                                        </div>
                                    </a>
                                    <a href="index.php?page=academics/class/manage_section">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Manage Section</p>
                                        </div>
                                    </a>
                                    <a href="index.php?page=academics/class/academic_syllabus">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Academic Syllabus</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal12" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Student</h4>
                        </div>
                        <div class="modal-body">
                            <div class="vertical-menu">
                                <div class="row">
                                    <a href="index.php?page=academics/students/student_information">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Student Information</p>
                                        </div>
                                    </a>
                                    <a href="index.php?page=academics/students/student_promotion">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Student Promotion</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="myModal13" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Expense</h4>
                        </div>
                        <div class="modal-body">
                            <div class="vertical-menu">
                                <div class="row">
                                    <a href="index.php?page=accounts/expense/expense">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Expense List</p>
                                        </div>
                                    </a>
                                    <a href="index.php?page=accounts/expense/category">
                                        <div class="inner-box">
                                            <div class="img">
                                                <img src="images/admin.png" alt="icon">
                                            </div>
                                            <p>Expense Category</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <hr />
            <p align="center">
                © 2019 <a href="#" style="color:blue;">School Management Software</a> Designed and Developed By <a href="#" style="color:blue;">Arsalan Ahmed Siddique<a> Powered By <a href="https://buraqtech.net" style="color:blue;">BuraqTech<a>
            </p>

        </div> <!-- Page Content Holder -->
    </div> <!-- main wrapperdiv after body opening tag -->
    <!-- input:file -->
    <script src="https://code.jquery.com/jquery-1.9.1.min.js" integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <!-- jQuery CDN -->
    <script src="js/jquery.js"></script>
    <!-- webcam js  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <!-- Chart/graph Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- DataTable Js -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- JQuery Calender Js -->
    <!-- not their <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap Image Uploader -->
    <script src="js/bootstrap-imageupload.js"></script>

    <script type="text/javascript" src="js/style.js"></script>
    <script type="text/javascript" src="js/bootstrap-confirmation.min.js"></script>
    <!-- m/y picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


</body>

</html>
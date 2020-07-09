<?php

require_once("php/academics.php");
$student = $academics_obj->getStudent($_REQUEST["sId"]);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/students/students_information">Student List</a></li>
        <li class="active"><a href="#">View Student</a></li>
    </ul>
</div>

<div class="row sm-section">
    <h3>Student Details</h3>
    <hr>
    <div class="col-md-8">
        <h4 class="profile-data">Full Name: <span> <span><?php echo $student["name"] ?></span></h4>
        <h4 class="profile-data">Father Name: <span> <span><?php echo $student["father_name"] ?></span></h4>
        <h4 class="profile-data">Email: <span> <span><?php echo $student["email"] ?></span></h4>
        <h4 class="profile-data">Phone: <span> <span><?php echo $student["phone"] ?></span></h4>
        <h4 class="profile-data">Gender: <span> <span><?php echo $student["gender"] ?></span></h4>
        <h4 class="profile-data">Date Of Birth: <span> <span><?php echo $student["dob"] ?></span></h4>
        <h4 class="profile-data">Address: <span> <span><?php echo $student["address"] ?></span></h4>
        <h4 class="profile-data">City: <span> <span><?php echo $student["city"] ?></span></h4>
        <h4 class="profile-data">Country: <span> <span><?php echo $student["country"] ?></span></h4>
        <h4 class="profile-data">Register At: <span> <span><?php echo $student["created_at"] ?></span></h4>
    </div>
    <div class="col-md-4">
        <div class="profile pull-right">
            <img src="<?php echo $student["photo"] ?>" alt="">
        </div>
    </div>
</div>
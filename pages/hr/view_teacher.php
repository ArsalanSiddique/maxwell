<?php
require_once("php/hr.php");
$teacher = $hrObj->getTeacher($_SESSION["campus_id"], $_REQUEST["tId"]);
?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=hr/teacher">Teacher List</a></li>
        <li class="active"><a href="#">View Teacher</a></li>
    </ul>
</div>

<div class="row sm-section">
    <h3>Teacher Details</h3>
    <hr>
    <div class="col-md-8">
        <h4 class="profile-data">Full Name: <span> <span><?php echo $teacher["name"] ?></span></h4>
        <h4 class="profile-data">Father Name: <span> <span><?php echo $teacher["father_name"] ?></span></h4>
        <h4 class="profile-data">Email: <span> <span><?php echo $teacher["email"] ?></span></h4>
        <h4 class="profile-data">Cnic: <span> <span><?php echo $teacher["cnic"] ?></span></h4>
        <h4 class="profile-data">Phone: <span> <span><?php echo $teacher["phone"] ?></span></h4>
        <h4 class="profile-data">Gender: <span> <span><?php echo $teacher["gender"] ?></span></h4>
        <h4 class="profile-data">Date Of Birth: <span> <span><?php echo $teacher["dob"] ?></span></h4>
        <h4 class="profile-data">Address: <span> <span><?php echo $teacher["address"] ?></span></h4>
        <h4 class="profile-data">Register At: <span> <span><?php echo $teacher["created_at"] ?></span></h4>
    </div>
    <div class="col-md-4">
        <div class="profile pull-right">
            <img src="<?php echo $teacher["photo"] ?>" alt="">
        </div>
    </div>
</div>
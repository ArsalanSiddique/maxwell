<?php

require_once("php/academics.php");
$parent = $academics_obj->getRecordById("parents", $_REQUEST["pId"]);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/registeration/parents_info">Parents List</a></li>
        <li class="active"><a href="#">View Parents</a></li>
    </ul>
</div>

<div class="row sm-section">
        <h3>Parents Details</h3>
        <hr>
        <div class="col-md-8">
            <h4 class="profile-data">Full Name: <span> <span><?php echo $parent["name"] ?></span></h4>
            <h4 class="profile-data">Email: <span> <span><?php echo $parent["email"] ?></span></h4>
            <h4 class="profile-data">Phone: <span> <span><?php echo $parent["phone"] ?></span></h4>
            <h4 class="profile-data">CNIC: <span> <span><?php echo $parent["cnic"] ?></span></h4>
            <h4 class="profile-data">Gender: <span> <span><?php echo $parent["gender"] ?></span></h4>
            <h4 class="profile-data">Date Of Birth: <span> <span><?php echo $parent["dob"] ?></span></h4>
            <h4 class="profile-data">Address: <span> <span><?php echo $parent["address"] ?></span></h4>
            <h4 class="profile-data">City: <span> <span><?php echo $parent["city"] ?></span></h4>
            <h4 class="profile-data">Country: <span> <span><?php echo $parent["country"] ?></span></h4>
            <h4 class="profile-data">Register At: <span> <span><?php echo $parent["created_at"] ?></span></h4>
        </div>
        <div class="col-md-4">
            <div class="profile pull-right">
                <img src="<?php echo $parent["photo"] ?>" alt="">
            </div>
        </div>
</div>
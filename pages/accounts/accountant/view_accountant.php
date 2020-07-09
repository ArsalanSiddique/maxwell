<?php

require_once("php/account.php");
$record = $account_obj->getRecordById("users", $_REQUEST["aId"]);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=accounts/accountant/accountant">Accountant List</a></li>
        <li class="active"><a href="#">View Accountant</a></li>
    </ul>
</div>

<div class="row sm-section">
    <h3>Accountant Details</h3>
    <hr>
    <div class="col-md-8">
        <h4 class="profile-data">User Name: <span> <span><?php echo $record["user_name"] ?></span></h4>
        <h4 class="profile-data">Email: <span> <span><?php echo $record["email"] ?></span></h4>
        <h4 class="profile-data">Phone: <span> <span><?php echo $record["phone"] ?></span></h4>
        <h4 class="profile-data">Register At: <span> <span><?php echo $record["created_at"] ?></span></h4>
    </div>
    <div class="col-md-4">
        <div class="profile pull-right">
            <img src="<?php echo $record["photo"] ?>" alt="profile">
        </div>
    </div>
</div>
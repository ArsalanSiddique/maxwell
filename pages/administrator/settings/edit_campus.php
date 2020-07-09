<?php

require_once("php/academics.php");
$record =  $academics_obj->getRecordById("campus", $_REQUEST["cId"]);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=administrator/general_setting"> Settings</a></li>
        <li class="active"><a href="#">Edit Campus</a></li>
    </ul>
</div>
<div class="col-md-7">
    <form action="php/administrator/general_settings.php" role="form" method="post" class="form-group thumbnail" enctype="multipart/form-data">
        <div class="row" style="margin:0px;padding:10px;">

            <fieldset>
                <legend>Campus Details</legend>
                <div class="form-group">
                    <label for="name">Name</label><span class="red_required">*</span>
                    <input type="text" name="name" id="name" value="<?php echo $record["name"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                    <input type="hidden" name="camp_id" id="camp_id" value="<?php echo $record["id"] ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address</label><span class="red_required">*</span>
                    <input type="text" name="address" id="address" value="<?php echo $record["address"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label><span class="red_required">*</span>
                    <input type="text" name="phone" id="phone" value="<?php echo $record["phone"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                </div>
            </fieldset>
            <input style="margin-right: 4px;" type="submit" value="Update" name="camp_update" class="btn btn-primary pull-right" />
        </div>
    </form>
</div>
<div class="row"></div>
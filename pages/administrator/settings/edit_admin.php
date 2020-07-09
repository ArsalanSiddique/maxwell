<?php

require_once("php/administrator.php");
$record =  $admin_obj->getAdmin($_REQUEST["aId"]);
$campuses =  $admin_obj->fetchAllRecord("campus");

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
                <legend>Admin Details</legend>
                <div class="form-group">
                    <label for="name">Admin Name</label> <span class="red_required">*</span>
                    <input type="text" name="name" id="name" value="<?php echo $record["user_name"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                    <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $record["user_id"] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label> <span class="red_required">*</span>
                    <input type="text" name="email" id="email" value="<?php echo $record["email"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label> <span class="red_required">*</span>
                    <input type="text" name="phone" id="phone" value="<?php echo $record["phone"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                </div>
                <div class="form-group">
                    <label for="campus">Campus</label> <span class="red_required">*</span>
                    <select name="campus" class="form-control" id="campus">
                        <?php foreach ($campuses as $campus) { ?>
                            <option value="<?php echo $campus["id"] ?>" <?php if($campus["id"] == $record["campus_id"]) { echo "selected"; } ?>><?php echo $campus["name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </fieldset>
            <input style="margin-right: 4px;" type="submit" value="Update" name="admin_update" class="btn btn-primary pull-right" />
        </div>
    </form>
</div>
<div class="row"></div>
<?php

require_once("php/academics.php");
$record =  $academics_obj->getRecordById("session", $_REQUEST["sId"]);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=administrator/general_setting"> Settings</a></li>
        <li class="active"><a href="#">Edit Session</a></li>
    </ul>
</div>
<div class="col-md-7">
    <form action="php/administrator/general_settings.php" role="form" method="post" class="form-group thumbnail" enctype="multipart/form-data">
        <div class="row" style="margin:0px;padding:10px;">

            <fieldset>
                <legend>Session Details</legend>
                <div class="form-group">
                    <label for="session_start">Session Start</label><span class="red_required">*</span>
                    <input type="month" name="session_start" id="session_start" value="<?php echo $record["session_start"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                    <input type="hidden" name="session_id" id="session_id" value="<?php echo $record["id"] ?>">
                </div>
                <div class="form-group">
                    <label for="session_end">Session End</label><span class="red_required">*</span>
                    <input type="month" name="session_end" id="session_end" value="<?php echo $record["session_end"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                </div>
            </fieldset>
            <input style="margin-right: 4px;" type="submit" value="Update" name="session_update" class="btn btn-primary pull-right" />
        </div>
    </form>
</div>
<div class="row"></div>
<?php

if (isset($_REQUEST["sId"])) {
    require_once("php/academics.php");
    $table = "section";
    $id = $_REQUEST["sId"];
    $record =  $academics_obj->getRecordById($table, $id);
    $classes =  $academics_obj->fetchAllRecord("class");
}
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/class/manage_section"> Manage Section</a></li>
        <li class="active"><a href="#">Edit Section</a></li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Section Details</div>
                <div class="panel-body">
                    <form action="php/academics/class.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name <span class="red_required">*</span></label>
                            <input type="text" name="name" id="name" value="<?php echo $record["name"] ?>" class="form-control" placeholder="class name">
                            <input type="hidden" name="section_id" value="<?php echo $record["id"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="n_name">Nick Name </label>
                            <input type="text" name="n_name" id="n_name" value="<?php echo $record["nick_name"] ?>" class="form-control" placeholder="iii">
                        </div>
                        <div class="form-group">
                            <label for="class">Select Class <span class="red_required">*</span></label>
                            <select name="class" class="form-control" id="class" required="required">
                                <option value="">Select Class</option>
                                <?php

                                foreach ($classes as $rows) {
                                ?>
                                    <option value="<?php echo $rows["id"] ?>" <?php if ($record["class_id"] == $rows["id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $rows["name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" name="up_section" class="btn btn-primary btn-md pull-right" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
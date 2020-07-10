<?php

if (isset($_REQUEST["cId"])) {
    require_once("php/academics.php");
    $table = "class";
    $id = $_REQUEST["cId"];
    $record =  $academics_obj->getRecordById($table, $id);
    $teachers = $academics_obj->fetchAllRecord("teachers");
    $departments = $academics_obj->fetchAllRecord("department");
}
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/class/manage_class"> Manage Class</a></li>
        <li class="active"><a href="#">Edit CLass</a></li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Class Details</div>
                <div class="panel-body">
                    <form action="php/academics/class.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name <span class="red_required">*</span></label>
                            <input type="text" name="name" id="name" value="<?php echo $record["name"] ?>" class="form-control" placeholder="class name">
                            <input type="hidden" name="class_id" value="<?php echo $record["id"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="n_name">Numeric Name <span class="red_required">*</span></label>
                            <input type="text" name="n_name" id="n_name" value="<?php echo $record["numeric_name"] ?>" class="form-control" placeholder="iii">
                        </div>
                        <div class="form-group">
                            <label for="department">Select Department <span class="red_required">*</span></label>
                            <select name="department" class="form-control" id="department" required="required">
                                <option value="">Select department</option>
                                <?php

                                foreach ($departments as $rows) {
                                ?>
                                    <option value="<?php echo $rows["id"] ?>" <?php if ($record["depart_id"] == $rows["id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $rows["name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="teacher">Select Teacher <span class="red_required">*</span></label>
                            <select name="teacher" class="form-control" id="teacher" required="required">
                                <option value="">Select Teacher</option>
                                <?php

                                foreach ($teachers as $rows) {
                                ?>
                                    <option value="<?php echo $rows["id"] ?>" <?php if ($record["class_teacher"] === $rows["id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $rows["name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" name="up_class" class="btn btn-primary btn-md pull-right" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
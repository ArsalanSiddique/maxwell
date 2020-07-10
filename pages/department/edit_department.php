<?php

if (isset($_REQUEST["dId"])) {
    require_once("php/academics.php");
    $table = "department";
    $id = $_REQUEST["dId"];
    $record =  $academics_obj->getRecordById($table, $id);   
}
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=department/departments"> Manage Department</a></li>
        <li class="active"><a href="#">Edit Department</a></li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Department Details</div>
                <div class="panel-body">
                    <form action="php/department/depart.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name <span class="red_required">*</span></label>
                            <input type="text" name="name" id="name" value="<?php echo $record["name"] ?>" class="form-control" placeholder="class name">
                            <input type="hidden" name="depart_id" value="<?php echo $record["id"] ?>">
                        </div>
                        <input type="submit" name="up_department" class="btn btn-primary btn-md pull-right" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
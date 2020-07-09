<?php
if (isset($_REQUEST["msg"])) {

    if ($_REQUEST["msg"] == 'true') {
        echo $alert_obj->success("added Record.");
    } else if ($_REQUEST["msg"] == 'false') {
        echo $alert_obj->danger();
    } elseif ($_REQUEST["msg"] == "up_true") {
        echo $alert_obj->success("updated record.");
    } else if ($_REQUEST["msg"] == "up_false") {
        echo $alert_obj->danger();
    } else {
        // do nothing.
    }
} else if (isset($_REQUEST["status"])) {
    if ($_REQUEST["status"] == "delete") {
        if (isset($_REQUEST["dId"])) {
            $result = $academics_obj->deleteRecord("department", $_REQUEST["dId"]);
            if ($result == true) {
                echo '<script>window.location.replace("index.php?page=department/departments&msg=del_true");</script>';
            } else {
                echo '<script>window.location.replace("index.php?page=department/departments&msg=del_false");</script>';
            }
        }
    }
}
?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="#">Manage Department</a></li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Department Details</div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Department List</a></li>
            <li><a href="#add_class" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add Department</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campus Name</th>
                                <th>Department Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dID = 0;
                            $departList = $academics_obj->fetchAllRecord("department");
                            foreach ($departList as $rows) {
                            ?>
                                <tr>
                                    <td><?php echo ++$dId ?></td>
                                    <td><?php echo $academics_obj->getColName("campus", "name", $rows["campus_id"]) ?></td>
                                    <td><?php echo $rows["name"] ?></td>
                                    <td>
                                        <a href="index.php?page=department/edit_department&cId=<?php echo $rows["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
                                        <a href="index.php?page=department/departments&status=delete&dId=<?php echo $rows["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="add_class" class="tab-pane fade">
                <form action="php/department/depart.php" method="post" class="form-group thumbnail col-md-6" style="margin:10px;padding:20px;">
                    <div class="form-group">
                        <label for="depart_name">Name: <span class="red_required">*</span></label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Department Name" />
                    </div>
                    <input type="submit" name="addDepartment" value="submit" class="btn btn-success" />
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row"></div>
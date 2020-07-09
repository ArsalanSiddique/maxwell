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
	} else if ($_REQUEST["msg"] == "name_err") {
		echo $alert_obj->warning("Name already exist");
	} else {
		// do nothing.
	}
}
require_once("php/academics.php");
$parents = $academics_obj->fetchAllRecord("parents");
if (isset($_REQUEST["status"])) {
    if ($_REQUEST["status"] == "delete") {
        if (isset($_REQUEST["pId"])) {
            $result = $academics_obj->deleteParent($_REQUEST["pId"]);
            if ($result == true) {
                echo '<script>window.location.replace("index.php?page=academics/registeration/parents_info&msg=del_true");</script>';
            } else {
                echo '<script>window.location.replace("index.php?page=academics/registeration/parents_info&msg=del_false");</script>';
            }
        }
    }
}
?>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Parents Information</li>
    </ol>
</div>


<div class="pull-right" style="margin-right:15px;">
    <a href="index.php?page=academics/registeration/parents"><button type="submit" id="" class="btn btn-primary">
            <span class="fa fa-plus"></span>&nbsp Add Parents
        </button></a>
</div>


<div class="table-responsive thumbnail" style="margin-top:50px;padding:20px;">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>CNIC</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Register At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            foreach ($parents as $parent) {
            ?>

                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $parent["name"] ?></td>
                    <td><?php echo $parent["email"] ?></td>
                    <td><?php echo $parent["phone"] ?></td>
                    <td><?php echo $parent["cnic"] ?></td>
                    <td><?php echo $parent["gender"] ?></td>
                    <td><?php echo $parent["address"] ?></td>
                    <td><?php echo $parent["created_at"] ?></td>
                    <td>
                        <a href="index.php?page=academics/registeration/view_parents&pId=<?php echo $parent["id"] ?>" target="self"><i class="fa fa-eye btn-view"></i></a> &nbsp;
                        <a href="index.php?page=academics/registeration/edit_parents&pId=<?php echo $parent["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
                        <a href="index.php?page=academics/registeration/parents_info&status=delete&pId=<?php echo $parent["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>
</div>
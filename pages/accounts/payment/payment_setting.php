<?php
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 'false') {
        echo $alert_obj->danger();
    } elseif ($_REQUEST["msg"] == "true") {
        echo $alert_obj->success("Added Record.");
    } else if ($_REQUEST["msg"] == "up_true") {
        echo $alert_obj->success("Updated record.");
    } else if ($_REQUEST["msg"] == "up_false") {
        echo $alert_obj->danger();
    } else {
        // do nothing.
    }
} else if (isset($_REQUEST["status"])) {
    if ($_REQUEST["status"] == "delete") {
        if (isset($_REQUEST["cId"])) {
            require_once("php/account.php");
            $result = $account_obj->deleteRecord("fee_category", $_REQUEST["cId"]);
            if ($result == true) {
                echo '<script>window.location.replace("index.php?page=accounts/payment/payment_setting&msg=del_true");</script>';
            } else {
                echo '<script>window.location.replace("index.php?page=accounts/payment/payment_setting&msg=del_false");</script>';
            }
        }
    }
}
require_once("php/account.php");
$classes = $account_obj->fetchAllRecord("class");
$sessions = $account_obj->fetchAllRecord("session");
$campuses = $account_obj->fetchAllRecord("campus");
$categories = $account_obj->fetchAllRecord("fee_category");
$payment = $account_obj->fetchAllRecord("payment_settings");
$categories = $account_obj->fetchAllRecord("fee_category");
$departments = $account_obj->fetchAllRecord("department");
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="#"></a>Payment Setting</li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Other Fee Settings
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="" class="form-inline" method="post">
                <div class="form-group col-md-3">
                    <label for="section">Select Department:</label><br>
                    <select name="session" class="form-control" id="depart_id" required="required" style="width:100%;" onchange="showRecords()">
                        <?php
                        foreach ($departments as $depart) {
                        ?>
                            <option value="<?php echo $cadepartmp["id"] ?>"><?php echo $depart["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="section">Select Class:</label><br>
                    <select name="depart_id" class="form-control" id="depart_id" required="required" style="width:100%;" onchange="showRecords()">
                        <option value="">Select</option>
                        <?php
                        foreach ($classes as $class) {
                        ?>
                            <option value="<?php echo $class["id"] ?>"><?php echo $class["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="section">Select Category:</label><br>
                    <select name="cat_id" class="form-control" id="cat_id" required="required" style="width:100%;" onchange="showRecords()">
                        <option value="">Select</option>
                        <?php
                        foreach ($categories as $cat) {
                        ?>
                            <option value="<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-9 m-auto">
        <div class="panel panel-default">
            <div class="panel-heading"> &nbsp Fee Category</div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#cat_list" data-toggle="tab">Categroy List</a></li>
                    <li><a href="#add_cat" data-toggle="tab"><i class="fa fa-plus"></i> &nbsp Add Category</a></li>
                </ul>
                <div class="tab-content">
                    <div id="cat_list" class="tab-pane fade in active" style="padding: 5px;">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($categories)) {
                                        $id = 1;
                                        foreach ($categories as $rows4) {
                                    ?>
                                            <tr>
                                                <td><?php echo $id ?></td>
                                                <td><?php echo $rows4["name"] ?></td>
                                                <td><?php echo $rows4["details"] ?></td>
                                                <td>
                                                    &nbsp;
                                                    <a href="index.php?page=accounts/payment/edit_cat&cId=<?php echo $rows4["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
                                                    <a href="index.php?page=accounts/payment/payment_setting&status=delete&cId=<?php echo $rows4["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
                                                </td>
                                            </tr>
                                    <?php $id = ++$id;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' style='text-align:center;'><h5>No Record Found.</h5></td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="add_cat" class="tab-pane fade" style="padding: 5px;">
                        <form name="add_campus" action="php/accounts/settings.php" method="POST" class="form-group" style="margin-top: 12px;">
                            <div class="form-group">
                                <label for="">Category Name</label>
                                <input type="Text" class="form-control" name="name" placeholder="name" requied="requied" />
                            </div>
                            <div class="form-group">
                                <label for="">Category Details</label>
                                <input type="Text" class="form-control" name="details" placeholder="Payment Category Details" />
                            </div>
                            <input type="submit" name="add_category" class="btn btn-primary pull-right" value="Add Category" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Monthly Fee Settings
    </div>
    <div class="panel-body">
        <form action="php/accounts/settings.php" method="POST">

            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class Name</th>
                        <th>Fee Amount</th>
                        <th>Fine Per Day</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1;
                    if (empty($payment)) {
                        foreach ($classes as $record) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $record["name"] ?></td>
                                <td> <input type="number" name="fees[]" class="form-control" value="" id="" required="required" /> </td>
                                <td> <input type="number" name="fine[]" class="form-control" value="" id="" required="required" /> </td>
                            </tr>
                        <?php }
                    } else {
                        foreach ($payment as $record) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $account_obj->getColName("class", "name", $record["class_id"]); ?></td>
                                <td> <input type="number" name="fees[]" class="form-control" value="<?php echo $record["fee_amount"] ?>" id="" required="required" /> </td>
                                <td> <input type="number" name="fine[]" class="form-control" value="<?php echo $record["fine"] ?>" id="" required="required" /> </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <div style="display: flex; justify-content: center;">
                <input type="submit" <?php if (!empty($payment)) {
                                            echo 'name="update_setting" value="Update Settings" ';
                                        } else {
                                            echo 'name="save_setting" value="Save Settings" ';
                                        } ?> class="btn btn-primary btn-md" />
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
	function showRecords() {
		var cat_id = document.getElementById("category_id").value;
		var class_id = document.getElementById("class_id").value;
		var depart_id = document.getElementById("depart_id").value;
		if (class_id != "" && depart_id != '' && cat_id != '') {
			$.ajax({
				url: 'php/reports/income.php',
				type: 'POST',
				data: {
					class_id: class_id,
					depart_id: depart_id,
					cat_id: cat_id
				},
				success: function(result, status) {
					$('#record').html(result);
				}
			});
		}
	}
</script>
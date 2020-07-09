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
}
require_once("php/account.php");
$classes = $account_obj->fetchAllRecord("class");
$payment = $account_obj->fetchAllRecord("payment_settings");
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="#"></a>Payment Setting</li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Fee Settings
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
                        foreach ($classes as $record) {?>
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
                <input type="submit" <?php  if (!empty($payment)) {echo 'name="update_setting" value="Update Settings" ';}else { echo 'name="save_setting" value="Save Settings" '; } ?> class="btn btn-primary btn-md" />
            </div>
        </form>
    </div>
</div>
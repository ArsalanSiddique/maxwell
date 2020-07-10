<?php

if (isset($_REQUEST["cId"])) {
    require_once("php/account.php");
    $table = "fee_category";
    $id = $_REQUEST["cId"];
    $record =  $academics_obj->getRecordById($table, $id);   
}
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=accounts/payment/fee_setting.php"> Fee Settings</a></li>
        <li class="active"><a href="#">Edit Category</a></li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Category Details</div>
                <div class="panel-body">
                    <form action="php/accounts/settings.php" method="POST">
                        <div class="form-group">
                            <label for="name">Name: <span class="red_required">*</span></label>
                            <input type="text" name="name" id="name" value="<?php echo $record["name"] ?>" class="form-control" placeholder="Cateogry name">
                            <input type="hidden" name="cat_id" value="<?php echo $record["id"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Details: <span class="red_required">*</span></label>
                            <input type="text" name="details" id="details" value="<?php echo $record["details"] ?>" class="form-control" placeholder="Fee Category Details">
                        </div>
                        <input type="submit" name="up_cat" class="btn btn-primary btn-md pull-right" value="Update Category">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
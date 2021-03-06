<?php

require_once("php/account.php");
$record =  $account_obj->getRecordById("expense_category", $_REQUEST["cId"]);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=accounts/expense/category"> Category List</a></li>
        <li class="active"><a href="#">Edit Category</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-6">


        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Category
            </div>
            <div class="panel-default" style="padding: 18px;">
                <form action="php/accounts/expense.php" role="form" method="post">

                    <div class="form-group">
                        <label for="name">Category Name <span class="red_required">*</span></label>
                        <input type="text" name="name" id="name" value="<?php echo $record["name"] ?>" class="form-control" required="required" placeholder="Category Name">
                        <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $record["id"] ?>">
                    </div>

                    <div class="row">
                        <div style="display: flex; justify-content:center;">
                            <input type="submit" value="Update" name="update_category" class="btn btn-md btn-primary" />
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
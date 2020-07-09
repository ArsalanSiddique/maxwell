<?php

require_once("php/account.php");
$record =  $account_obj->getRecordById("expense", $_REQUEST["eId"]);
$categories =  $account_obj->fetchAllRecord("expense_category");

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=accounts/expense/expense"> Expense List</a></li>
        <li class="active"><a href="#">Edit Expense</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Expense
            </div>
            <div class="panel-default" style="padding: 18px;">
                <form action="php/accounts/expense.php" role="form" method="post">

                    <div class="form-group">
                        <label for="name">Title <span class="red_required">*</span></label>
                        <input type="text" name="name" id="name" value="<?php echo $record["title"] ?>" class="form-control" required="required" placeholder="Category Name">
                        <input type="hidden" name="exp_id" id="exp_id" value="<?php echo $record["id"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Category Id <span class="red_required">*</span></label>
                        <select class="form-control" name="category_id" id="category">
                            <?php
                            foreach ($categories as $record2) {
                            ?>
                                 <option value="<?php echo $record2["id"] ?>" <?php if($record["category_id"] == $record2["id"]) { echo "selected"; } ?> ><?php echo $record2["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date <span class="red_required">*</span></label>
                        <input type="date" name="date" id="date" value="<?php echo $record["date"] ?>" class="form-control" required="required" placeholder="Category Name">
                    </div>

                    <div class="row">
                        <div style="display: flex; justify-content:center;">
                            <input type="submit" value="Update" name="update_expense" class="btn btn-md btn-primary" />
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
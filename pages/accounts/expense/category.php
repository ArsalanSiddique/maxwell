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
$expenses = $account_obj->fetchAllRecord("expense_category");
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["cId"])) {
			$result = $academics_obj->deleteRecord("expense_category", $_REQUEST["cId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=accounts/expense/category&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=accounts/expense/category&msg=del_false");</script>';
			}
		}
	}
}
?>
<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Expense Category</a></li>
	</ul>
</div>

<!-- Add Expense Button -->
<div class="container-fluid">
	<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#expense">
		<i class="fa fa-plus"></i> &nbsp Add New Expense Category
	</button>
</div>

<!-- Modal -->
<div class="modal fade" id="expense" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp Add Expense Category</h4>
			</div>
			<div class="modal-body">
				<form action="php/accounts/expense.php" method="post">
					<div class="form-group">
						<label for="name">Category Name: </label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Name">
					</div>
					<input type="submit" name="add_categroy" class="btn btn-primary" value="Add Category">
				</form>
			</div>
		</div>

	</div>
</div>

<!-- Expense category table -->
<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Date</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$count = 1;
			foreach ($expenses as $record) {
			?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $record["name"] ?></td>
					<td><?php echo $record["created_at"] ?></td>
					<td>
						<a href="index.php?page=accounts/expense/edit_category&cId=<?php echo $record["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
						<a href="index.php?page=accounts/expense/category&status=delete&cId=<?php echo $record["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
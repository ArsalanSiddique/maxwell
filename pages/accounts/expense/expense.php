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
$categories = $account_obj->fetchAllRecord("expense_category");
$expenses = $account_obj->fetchAllRecord("expense");
if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["eId"])) {
			$result = $academics_obj->deleteRecord("expense", $_REQUEST["eId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=accounts/expense/expense&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=accounts/expense/expense&msg=del_false");</script>';
			}
		}
	}
}

?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Expense</a></li>
	</ul>
</div>

<!-- Add Expense Button -->
<div class="container-fluid">
	<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#new_expense">
		<i class="fa fa-plus"></i> &nbsp Add New Expense
	</button>
</div>

<!-- Add Expense Modal -->
<div id="new_expense" class="modal fade col-md-6" style="margin-top: 20px; margin-left: 25%; display: block; padding-right: 10px;" role="dialog">
	<div class="dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4><i class="fa fa-plus"></i>&nbsp Add Expense</h4>
			</div>
			<div class="modal-body" style="padding:18px;">
				<form action="php/accounts/expense.php" method="post">
					<div class="form-group">
						<label for="">Title</label>
						<input type="text" name="title" id="" class="form-control" placeholder="Enter Title">
					</div>
					<div class="form-group">
						<label for="category">Expense Category</label>
						<select name="category_id" id="category" class="form-control">
							<option value="">Select Category</option>
							<?php foreach ($categories as $category) {
							?>
								<option value="<?php echo $category["id"] ?>"><?php echo $category["name"] ?></option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="number">Amount</label>
						<input type="number" name="amount" id="number" class="form-control" placeholder="Enter Amount in digits">
					</div>
					<div class="form-group">
						<label for="">Date</label>
						<input type="date" name="date" id="" class="form-control">
					</div>
					<input type="submit" name="add_expense" class="btn btn-md btn-primary" value="Submit">
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Expnese table -->
<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Category</th>
				<th>Amount</th>
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
					<td><?php echo $record["title"] ?></td>
					<td><?php echo $account_obj->getColName("expense_category", "name", $record["category_id"]) ?></td>
					<td><?php echo $record["amount"] ?></td>
					<td><?php echo date("d-M-Y", strtotime($record["date"])) ?></td>
					<td>
						<a href="index.php?page=accounts/expense/edit_expense&eId=<?php echo $record["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
						<a href="index.php?page=accounts/expense/expense&status=delete&eId=<?php echo $record["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
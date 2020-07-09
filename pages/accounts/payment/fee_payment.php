<?php

if (isset($_REQUEST["status"])) {
	if ($_REQUEST["status"] == "delete") {
		if (isset($_REQUEST["pId"])) {
			$result = $academics_obj->deleteRecord("payment", $_REQUEST["pId"]);
			if ($result == true) {
				echo '<script>window.location.replace("index.php?page=accounts/payment/fee_payment&msg=del_true");</script>';
			} else {
				echo '<script>window.location.replace("index.php?page=accounts/payment/fee_payment&msg=del_false");</script>';
			}
		}
	}
}

require_once("php/account.php");
$classes = $account_obj->fetchAllRecord("class");

?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Fee Payment</a></li>
	</ul>
</div>
<div class="thumbnail" style="padding:24px;">
	<div class="row">
		<form action="" class="form-inline" method="post">
			<div class="form-group col-md-3">
				<label for="class">Select Class:</label><br>
				<select name="class_id" class="form-control" id="myclass" required="required" style="width:100%;" onchange="showRecord()">
					<option value="">Select Class</option>
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
				<label for="month">Select Month:</label><br>
				<input type="month" name="month" class="form-control" id="month" style="width: 100%;" onchange="showRecord()">
			</div>
		</form>
		<br />
		<div class="form-group pull-right">
			<a href="index.php?page=accounts/payment/create_student_payments">
				<button type="submit" id="" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp Add Invoice</button>
			</a>
		</div>
	</div>
</div>

<div class="table-responsive thumbnail" style="margin-top:50px;padding:20px;">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Reg No#</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Month</th>
				<th>Amount</th>
				<th>Paid</th>
				<th>Status</th>
				<th>Method</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody id="payment_record">
		</tbody>
	</table>
</div>

<script type="text/javascript">
	function showRecord() {
		var class_id = document.getElementById("myclass").value;
		var month = document.getElementById("month").value;
		if (class_id != "" && month != "") {
			$.ajax({
				url: 'php/accounts/paymet_record.php',
				type: 'POST',
				data: {
					class_id: class_id,
					month: month,
				},
				success: function(result, status) {
					$('#payment_record').html(result);
				}
			});
		} else {

		}
	}
</script>
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
$record = $account_obj->getRecordById("payment", $_REQUEST["pId"]);
$classes = $account_obj->fetchAllRecord("class");
$students = $account_obj->showStudentByClass("active", $record["class_id"]);
?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=accounts/fee_payment"> Student Payments</a></li>
		<li class="active"><a href="#"></a>Update Payment</li>
	</ul>
</div>


<!-- Create Invoice Tab -->
<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#home">Update Invoice</a></li>
</ul>

<div class="container-fluid">
	<div class="tab-content">
		<br />
		<div id="home" class="tab-pane fade in active">
			<!--create payment form -->
			<form action="php/accounts/payment.php" method="POST" class="form-group">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Invoice Informatoin
							</div>
							<div class="panel-body">
								<small class="text-info">Field mark wirh <span class="red_required">*</span> are required.</small>
								<br>
								<br>
								<div class="form-group">
									<label for="class">Select Class <span class="red_required">*</span></label>
									<select name="class" class="form-control" id="class" required="required" onchange="myfun(this.value)">
										<option value="">Select</option>
										<?php
										foreach ($classes as $class) {
										?>
											<option value="<?php echo $class["id"] ?>" <?php if($class["id"] == $record["class_id"]) { echo "selected"; } ?> ><?php echo $class["name"] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="student">Select Student <span class="red_required">*</span></label>
									<select name="student" id="student" class="form-control action" required="required">
                                        <option value="">Select Class First</option>
										<?php
										foreach ($students as $std) {
										?>
											<option value="<?php echo $std["id"] ?>" <?php if($std["id"] == $record["student_id"]) { echo "selected"; } ?> ><?php echo $std["name"] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="title">Title <span class="red_required">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $record["title"] ?>" placeholder="Enter title" required="required">
                                    <input type="hidden" name="inv_id" id="inv_id" value="<?php echo $record["id"] ?>">
								</div>
								<div class="form-group">
									<label for="details">Description</label>
									<input type="text" name="details" id="details" class="form-control" value="<?php echo $record["details"] ?>" placeholder="Description">
								</div>
								<div class="form-group">
									<label for="month">Select Month</label>
									<input type="month" name="month" id="month" value="<?php echo $record["month"] ?>" class="form-control" required="required">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Payment Information
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label for="total">Total <span class="red_required">*</span></label>
									<input type="number" name="total_amount" id="total" value="<?php echo $record["total_amount"] ?>" class="form-control" placeholder="00" required="required">
								</div>
								<div class="form-group">
									<label for="payment">Payment <span class="red_required">*</span></label>
									<input type="number" name="paid_amount" id="payment" class="form-control" value="<?php echo $record["paid_amount"] ?>" placeholder="00" required="required">
								</div>
								<div class="form-group">
									<label for="dsicount">Discount </label>
									<input type="number" name="discount" id="discount" class="form-control" value="<?php echo $record["dsicount"] ?>" placeholder="00">
								</div>
								<div class="form-group">
									<label for="status">Select Status</label>
									<select name="status" id="status" class="form-control" required="required">
										<option value="paid" <?php if("paid" == $record["status"]) { echo "selected"; } ?>>Paid</option>
										<option value="unpaid" <?php if("unpaid" == $record["status"]) { echo "selected"; } ?>>Unpaid</option>
									</select>
								</div>
								<div class="form-group">
									<label for="method">Select Method </label>
									<select name="method" id="method" class="form-control" required="required">
										<option value="cash" <?php if("cash" == $record["method"]) { echo "selected"; } ?>>Cash</option>
										<option value="cheque" <?php if("cheque" == $record["method"]) { echo "selected"; } ?>>Cheque</option>
										<option value="card" <?php if("card" == $record["method"]) { echo "selected"; } ?>>Card</option>
									</select>
								</div>
							</div>
						</div>
						<input type="submit" class="btn btn-success btn-md" value="Update Invoice" name="update_payment" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function myfun(datavalue) {
		$.ajax({
			url: 'php/accounts/get_data.php',
			type: 'POST',
			data: {
				datapost: datavalue
			},
			success: function(result, status) {
				$('#student').html(result);
			}
		});
	}
</script>
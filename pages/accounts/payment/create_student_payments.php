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
	} else if ($_REQUEST["msg"] == "m_true") {
		echo $alert_obj->success("Added record.");
	} else if ($_REQUEST["msg"] == "m_false") {
		echo $alert_obj->danger();
	} else {
		// do nothing.
	}
}
require_once("php/account.php");
$classes = $account_obj->fetchAllRecord("class");
$departments = $account_obj->fetchAllRecord("department");
$categories = $account_obj->fetchAllRecord("fee_category");
$campuses = $account_obj->fetchAllRecord("campus");
?>

<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Create Student Payments</a></li>
	</ul>
</div>


<!-- Create Invoice Tab -->
<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#home">Create Single Invoice</a></li>
	<li><a data-toggle="tab" href="#menu2">Create Mass Invoice</a></li>
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
									<label for="depart_id">Select Department <span class="red_required">*</span></label>
									<select name="depart_id" class="form-control" id="depart_id" required="required" onchange="showClass(this.value)">
										<option value="">Select</option>
										<?php
										foreach ($departments as $depart) {
										?>
											<option value="<?php echo $depart["id"] ?>"><?php echo $depart["name"] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="class">Select Class <span class="red_required">*</span></label>
									<select name="class" class="form-control myclass" required="required" onchange="myfun(this.value)">
										<option value="">Select Depart First</option>
									</select>
								</div>
								<div class="form-group">
									<label for="student">Select Student <span class="red_required">*</span></label>
									<select name="student" id="student" class="form-control action" required="required">
										<option value="">Select Class First</option>
									</select>
								</div>
								<div class="form-group">
									<label for="category">Select Category <span class="red_required">*</span></label>
									<select name="cat_id" class="form-control" id="category" required="required">
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
								<div class="form-group">
									<label for="month">Select Month</label>
									<input type="month" name="month" id="month" class="form-control" required="required">
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
									<input type="number" name="total_amount" id="total" class="form-control" placeholder="00" required="required">
								</div>
								<div class="form-group">
									<label for="payment">Payment <span class="red_required">*</span></label>
									<input type="number" name="paid_amount" id="payment" class="form-control" placeholder="00" required="required">
								</div>
								<div class="form-group">
									<label for="discount">Discount</label>
									<input type="number" name="discount" id="discount" class="form-control" placeholder="00">
								</div>
								<div class="form-group">
									<label for="discount">Fine</label>
									<input type="number" name="fine" id="fine" class="form-control" placeholder="00">
								</div>
								<div class="form-group">
									<label for="status">Select Status</label>
									<select name="status" id="status" class="form-control" required="required">
										<option value="paid">Paid</option>
										<option value="unpaid">Unpaid</option>
									</select>
								</div>
								<div class="form-group">
									<label for="method">Select Method </label>
									<select name="method" id="method" class="form-control" required="required">
										<option value="cash">Cash</option>
										<option value="cheque">Cheque</option>
										<option value="card">Card</option>
									</select>
								</div>
							</div>
						</div>
						<input type="submit" class="btn btn-success btn-md" value="Add Invoice" name="fee_payment" />
					</div>
				</div>
			</form>
		</div>
		<div id="menu2" class="tab-pane fade">
			<div class="row">
				<div class="col-md-7" style="margin-left:20px;">
					<div class="panel panel-default">
						<div class="panel-heading">
							Mass Invoice Informatoin
						</div>
						<div class="panel-body">
							<small class="text-info">Field mark wirh <span class="red_required">*</span> are required.</small>
							<br>
							<br>
							<form action="php/accounts/payment.php" method="POST" class="form-group">
								<div class="form-group">
									<label for="depart_id">Select Department <span class="red_required">*</span></label>
									<select name="depart_id" class="form-control" id="depart_id" required="required" onchange="showClass(this.value)">
										<option value="">Select</option>
										<?php
										foreach ($departments as $depart) {
										?>
											<option value="<?php echo $depart["id"] ?>"><?php echo $depart["name"] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="class">Select Class <span class="red_required">*</span></label>
									<select name="class" class="form-control myclass" required="required" onchange="myfun(this.value)">
										<option value="">Select Depart First</option>
									</select>
								</div>
								<div class="form-group">
									<label for="category">Select Category <span class="red_required">*</span></label>
									<select name="cat_id" class="form-control" id="category" required="required">
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
								<div class="form-group">
									<label for="month">Select Month <span class="red_required">*</span></label>
									<input type="month" name="month" id="month" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label for="total">Total <span class="red_required">*</span></label>
									<input type="number" name="total_amount" id="total" class="form-control" placeholder="00" required="required">
								</div>
								<div class="form-group">
									<label for="paid">Payment <span class="red_required">*</span></label>
									<input type="number" name="paid_amount" id="paid" class="form-control" placeholder="00" required="required">
								</div>
								<div class="form-group">
									<label for="status">Status <span class="red_required">*</span></label>
									<select name="status" id="status" class="form-control" required="required">
										<option value="Unpaid">Unpaid</option>
										<option value="Paid">Paid</option>
									</select>
								</div>
								<div class="form-group">
									<label for="method">Method </label>
									<select name="method" id="method" class="form-control" required="required">
										<option value="null">Select Method</option>
										<option value="cash" selected>Cash</option>
										<option value="cheque">Cheque</option>
										<option value="card">Card</option>
									</select>
								</div>
								<div style="display: flex; justify-content: center;">
									<input type="submit" class="btn btn-md btn-primary" name="mass_payment" value="Submit" />
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
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

	function showClass(depart) {
		$.ajax({
			url: 'php/accounts/get_data.php',
			type: 'POST',
			data: {
				depart: depart
			},
			success: function(result, status) {
				$('.myclass').html(result);
			}
		});
	}
</script>
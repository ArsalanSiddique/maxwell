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
session_start();
$payment_id = $_REQUEST["pId"];
$campus_name = $account_obj->getColName("campus", "name", $_SESSION["campus_id"]);
$student_id = $account_obj->getColName("payment", "student_id", $payment_id);
$student = $account_obj->getRecordById("students", $student_id);
$fine = $account_obj->fetchFine($student_id, $student["class_id"]);




$records = $account_obj->showPaymentHistory($student_id);
foreach ($records as $record) {
    $newDate = date("F-Y", strtotime($record["created_at"]));
    $due_date = "15-" . $newDate;

    $issue_date = date("d-F-Y", strtotime($record["created_at"]));

    $month_number = date("n", strtotime($record["created_at"]));
    $year = date("Y", strtotime($record["created_at"]));
    $d = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
    $validate = $d . "-" . $newDate;


    $reciept_no = $record["recipt"];
}
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=accounts/payment/fee_payment">Students Payment</a></li>
        <li class="active"><a href="#">View Payment</a></li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Complete Fee Summary
        <div class="pull-right">
            <a href="pages/accounts/payment/print_payment.php?sId=<?php echo $student_id ?>&status=summary" class="btn btn-primary btn-sm" style="padding: 4px;"> Print Summary </a>
        </div>
    </div>
    <div class="panel-body">

        <div class="row" style="padding: 0.5% 3%">

            <h3><?php echo $account_obj->getColName("school_info", "name", "1"); ?> <span style="padding-left: 2%;font-size: 18px;"> <?php echo $campus_name ?> </span></h3>


            <div class="col-md-12" style="border-top: 2px solid grey;"></div>
            <div class="col-md-12" style="padding-top: 12px 0px 12px 0px; border-bottom:2px solid grey;">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h4>Student Name: <span style="text-transform: Uppercase; font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["name"] ?></span></h4>
                    <h4>Father Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["father_name"] ?></span></h4>
                    <h4>Class: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $account_obj->getColName("class", "name", $student["class_id"]) ?></span></h4>
                    <h4>Section Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $account_obj->getColName("section", "nick_name", $student["section_id"]) . " - " . $account_obj->getColName("section", "name", $student["section_id"]) ?></span></h4>
                    <h4>Regist. No: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; RN-<?php echo $student["reg_no"] ?></span></h4>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h4>Issue Date: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $issue_date ?></span></h4>
                    <h4>Due Date: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $due_date ?></span></h4>
                    <h4>Validate: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $validate ?></span></h4>
                    <h4>Reciept. No: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; RP-<?php echo $reciept_no ?></span></h4>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 1% 5% 0% 5%;">
            <h4> Fee Summary </h4>
            <form action="php/accounts/payment.php" method="POST">
                <input type="hidden" name="student_id" value="<?php echo $student_id ?>" />
                <input type="hidden" name="inv_id" value="<?php echo $_REQUEST["pId"] ?>" />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Month Name</th>
                            <th>Tution Fee</th>
                            <th>Paid Amount</th>
                            <th>Discount</th>
                            <th>Fine</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $total_amount = 0;
                        $total_paid_amount = 0;
                        $total_discount = 0;
                        foreach ($records as $record) {
                            if ($record["paid_amount"] < $record["total_amount"]) {
                                $month_number = date("n", strtotime($record["month"]));
                                if ($month_number != date("n")) {
                                    $year = date("Y", strtotime($record["month"]));
                                    $d = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
                                    $d = $d - 15;
                                    $fine = 5 * $d;
                                }
                        ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $record["title"] ?></td>
                                    <td><?php echo $newDate = date("F-Y", strtotime($record["month"]));; ?> </td>
                                    <td><?php $total_amount += $record["total_amount"];
                                        echo $record["total_amount"] ?></td>
                                    <td><input type="number" name="paid_amount[]" class="form-control" value="<?php echo $record["paid_amount"] ?>" id="paid_amount" onchange="calc()"><?php $total_paid_amount += $record["paid_amount"]; ?></td>
                                    <td><input type="number" name="discount[]" class="form-control" value="<?php echo $record["discount"] ?>" id="discount" onchange="calc()"><?php $total_discount += $record["discount"]; ?></td>
                                    <td><input type="number" readonly name="fine[]" class="form-control" value="<?php echo $fine = $account_obj->fetchFineByMonth($student["class_id"], $record["month"]);
                                                                                                                $total_fine += $fine; ?>" id="fine" onchange="calc()"></td>
                                    <td><?php echo "15-" . $newDate ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2"><b> Total Tution Fee: </b> </td>
                            <td><input type="number" class="form-control" disabled value="<?php echo $total_amount ?>" id="" require="required"></td>
                            <td><b>Total Discount:</b></td>
                            <td><input type="number" class="form-control" disabled name="discount" value="<?php echo $total_discount ?>" id="total_discount" require="required"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2"><b>Total Fine:</b></td>
                            <td><input type="number" class="form-control" disabled name="total_fine" value="<?php echo $total_fine ?>" id="total_fine" require="required"><input type="hidden" class="form-control" name="inv_id" value="<?php echo $_REQUEST["pId"] ?>"></td>
                            <td><b>Total Amount:</b></td>
                            <?php $payable_amount = ($total_amount - $total_discount + $total_fine) - $total_paid_amount ?>
                            <td><input type="number" class="form-control" disabled name="paid_amount" value="<?php echo $payable_amount ?>" id="payable_amount" require="required"></td>
                        </tr>
                    </tbody>
                </table>
                <div style="display: flex; justify-content: center;">
                    <input type="submit" value="Save Voucher" name="save_voucher" class="btn btn-md btn-success">
                    &nbsp;
                    <a href="pages/accounts/payment/print_voucher.php?sId=<?php echo $student_id ?>&status=current" class="btn btn-primary btn-md"> Print Voucher </a>
                    &nbsp;
                    <a href="pages/accounts/payment/print_payment.php?sId=<?php echo $student_id ?>&status=summary" class="btn btn-primary btn-md"> Print Summary </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function calc(num_rows) {
        var paid = document.querySelectorAll("#paid_amount");
        var fine = document.querySelectorAll("#fine");
        var discount = document.querySelectorAll("#discount");
        var length_paid = paid.length;

        var total_paid_amount = 0;
        var total_fine = 0;
        var total_discount = 0;

        for (i = 0; i < length_paid; i++) {
            total_paid_amount += parseInt(document.querySelectorAll("#paid_amount")[i].value);
            total_fine += parseInt(document.querySelectorAll("#fine")[i].value);
            total_discount += parseInt(document.querySelectorAll("#discount")[i].value);
        }

        var payable_amount = total_paid_amount + total_fine - total_discount;
        document.getElementById("payable_amount").value = payable_amount;
        document.getElementById("total_discount").value = total_discount;

    }
</script>
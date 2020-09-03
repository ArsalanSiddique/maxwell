<?php
require_once("../../../php/account.php");
session_start();
$student_id = $_REQUEST["sId"];
$campus_name = $account_obj->getColName("campus", "name", $_SESSION["campus_id"]);
$student = $account_obj->getRecordById("students", $student_id);
$fine = $account_obj->fetchFine($student_id, $student["class_id"]);




$records = $account_obj->showPaymentHistory($student_id);

foreach ($records as $record) {


    $newDate = date("M-y", strtotime($record["created_at"]));
    $due_date = "15-" . $newDate;

    $issue_date = date("d-M-y", strtotime($record["created_at"]));

    $month_number = date("n", strtotime($record["created_at"]));
    $year = date("y", strtotime($record["created_at"]));
    $d = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
    $validate = $d . "-" . $newDate;


    $reciept_no = $record["recipt"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>School Software</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../html/school_m_s/css/style4.css">
    <link rel="stylesheet" href="../html/school_m_s/css/font-awesome.css">

    <style>
        @media print {
            @page {
                size: landscape
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row" style="padding: 0.5% 3%">

                <div class="col-xs-6" style="border-right: 1px dotted black;">
                    <p style="text-align:right; margin-right: 18px;">
                        <?php date_default_timezone_set('Asia/Karachi');
                        echo $date = date('m/d/Y h:i:s a', time()); ?>
                    </p>
                    <h3><?php echo $account_obj->getColName("school_info", "name", "1"); ?> <span style="padding-left: 2%;font-size: 18px;"> <?php echo $campus_name ?> </span></h3>
                    <div style="border-top:2px solid grey; border-bottom:2px solid grey;">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4>Student Name: <span style="text-transform: Uppercase; font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["name"] ?></span></h4>
                                <h4>Father Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["father_name"] ?></span></h4>
                                <h4>Class: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $account_obj->getColName("class", "name", $student["class_id"]) ?></span></h4>
                                <h4>Section Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $account_obj->getColName("section", "nick_name", $student["section_id"]) . " - " . $account_obj->getColName("section", "name", $student["section_id"]) ?></span></h4>
                                <h4>Regist. No: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; RN-<?php echo $student["reg_no"] ?></span></h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4>Issue Date: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $issue_date ?></span></h4>
                                <h4>Due Date: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $due_date ?></span></h4>
                                <h4>Validate: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $validate ?></span></h4>
                                <h4>Reciept. No: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; RP-<?php echo $reciept_no ?></span></h4>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" style="margin-top: 12px;">
                        <tbody>
                            <tr style="background-color: grey; color: white;">
                                <td><b>Title</b></td>
                                <td><b>Fees</b></td>
                            </tr>
                            <?php
                            $total_payable_amount = 0;
                            foreach ($records as $data) {
                            ?>
                                <tr>
                                    <td><b><?php $cat_record = $account_obj->getRecordById("fee_category", $data["category_id"]);
                                            echo $cat_record["name"]  ?> </b></td>
                                    <td><b><?php $total_amount = $data["total_amount"];
                                            $total_payable_amount += $total_amount;
                                            echo number_format($total_amount, 2); ?></b></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td><b>Paid Amount</b></td>
                                <td><b><?php $paid_amount = $record["paid_amount"];
                                        echo number_format($paid_amount, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Fine</b></td>
                                <td><b><?php $fine = $account_obj->fetchFineByMonth($student["class_id"], $record["month"]);
                                        echo number_format($fine, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Discount</b></td>
                                <td><b><?php $discount += $record["discount"];
                                        echo number_format($discount, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td><b><?php $payable_amount = ($total_payable_amount+$fine)-($paid_amount+$discount);
                                        echo number_format($payable_amount, 2); ?></b></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="height: 64px;text-decoration:underline;vertical-align:middle;"><b>School Stamp:</b></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <p style="text-align: center;"> Powered By <a href="buraqtech.net">Buraqtech</a></p>
                </div>
                <div class="col-xs-6">
                    <p style="text-align:right; margin-right: 18px;">
                        <?php date_default_timezone_set('Asia/Karachi');
                        echo $date = date('m/d/Y h:i:s a', time()); ?>
                    </p>
                    <h3><?php echo $account_obj->getColName("school_info", "name", "1"); ?> <span style="padding-left: 2%;font-size: 18px;"> <?php echo $campus_name ?> </span></h3>
                    <div style="border-top:2px solid grey; border-bottom:2px solid grey;">

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4>Student Name: <span style="text-transform: Uppercase; font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["name"] ?></span></h4>
                                <h4>Father Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $student["father_name"] ?></span></h4>
                                <h4>Class: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $account_obj->getColName("class", "name", $student["class_id"]) ?></span></h4>
                                <h4>Section Name: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $account_obj->getColName("section", "nick_name", $student["section_id"]) . " - " . $account_obj->getColName("section", "name", $student["section_id"]) ?></span></h4>
                                <h4>Regist. No: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; RN-<?php echo $student["reg_no"] ?></span></h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4>Issue Date: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $issue_date ?></span></h4>
                                <h4>Due Date: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $due_date ?></span></h4>
                                <h4>Validate: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; <?php echo $validate ?></span></h4>
                                <h4>Reciept. No: <span style="font-family: 'Tahoma' ,'Segoe UI', Geneva, Verdana, sans-serif;"> &nbsp; RP-<?php echo $reciept_no ?></span></h4>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" style="margin-top: 12px;">
                        <tbody>
                            <tr style="background-color: grey; color: white;">
                                <td><b>Title</b></td>
                                <td><b>Fees</b></td>
                            </tr>
                            <?php
                            $total_payable_amount = 0;
                            foreach ($records as $data) {
                            ?>
                                <tr>
                                    <td><b><?php $cat_record = $account_obj->getRecordById("fee_category", $data["category_id"]);
                                            echo $cat_record["name"]  ?> </b></td>
                                    <td><b><?php $total_amount = $data["total_amount"];
                                            $total_payable_amount += $total_amount;
                                            echo number_format($total_amount, 2); ?></b></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td><b>Paid Amount</b></td>
                                <td><b><?php $paid_amount = $record["paid_amount"];
                                        echo number_format($paid_amount, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Fine</b></td>
                                <td><b><?php $fine = $account_obj->fetchFineByMonth($student["class_id"], $record["month"]);
                                        echo number_format($fine, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Discount</b></td>
                                <td><b><?php $discount += $record["discount"];
                                        echo  number_format($discount, 2); ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td><b><?php echo  number_format(($total_payable_amount + $fine) - ($paid_amount+$discount), 2) ?></b></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="height: 64px;text-decoration:underline;vertical-align:middle;"><b>School Stamp:</b></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <p style="text-align: center;"> Powered By <a href="buraqtech.net">Buraqtech</a></p>
                </div>
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
</body>

</html>
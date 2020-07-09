<?php
require_once("../../../php/account.php");
session_start();
$student_id = $_REQUEST["sId"];
$campus_name = $account_obj->getColName("campus", "name", $_SESSION["campus_id"]);
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
</head>

<body onload="window.print();">

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row" style="padding: 0.5% 3%">
                <p style="text-align:right; margin-right: 18px;">
                    <?php date_default_timezone_set('Asia/Karachi');
                    echo $date = date('m/d/Y h:i:s a', time()); ?>
                </p>
                <h3><?php echo $account_obj->getColName("school_info", "name", "1"); ?> <span style="padding-left: 2%;font-size: 18px;"> <?php echo $campus_name ?> </span></h3>
                <div class="col-xs-12" style="border-top:2px solid grey; border-bottom:2px solid grey;">
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
            <div class="row" style="padding: 0% 5% 0% 5%;">
                <h4> Fee Summary </h4>
                <form action="php/accounts/payment.php" method="POST">
                    <input type="hidden" name="student_id" value="<?php echo $student_id ?>" />
                    <input type="hidden" name="inv_id" value="<?php echo $_REQUEST["pId"] ?>" />
                    <table class="table table-bordered">
                        <thead style="background-color: grey; color: white;">
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
                                        <td><?php echo $record["paid_amount"];
                                            $total_paid_amount += $record["paid_amount"]; ?></td>
                                        <td><?php echo $record["discount"];
                                            $total_discount += $record["discount"]; ?></td>
                                        <td><?php echo $fine = $account_obj->fetchFineByMonth($student["class_id"], $record["month"]);
                                            $total_fine += $fine; ?></td>
                                        <td><?php echo "15-" . $newDate ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="4"></td>
                                <td><b> Total Tution Fee: </b> </td>
                                <td><b><?php echo $total_amount ?> </b> </td>
                                <td><b>Total Discount:</b></td>
                                <td><b><?php echo $total_discount ?> </b> </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td><b>Total Fine:</b></td>
                                <td><b><?php echo $total_fine ?> </b> </td>
                                <td><b>Payable Amount:</b></td>
                                <?php $payable_amount = ($total_amount - $total_discount + $total_fine) - $total_paid_amount ?>
                                <td><b><?php echo $payable_amount ?> </b> </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="height: 64px; vertical-align:middle;text-decoration:underline;"><b>Stamp:</b></td>
                                <td colspan="3"></td>
                                <td colspan="1" style=" vertical-align:middle;text-decoration:underline;"><b>Parents Sign:</b></td>
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="text-align: center;"> Powered By <a href="buraqtech.net">Buraqtech</a></p>
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
</body>

</html>
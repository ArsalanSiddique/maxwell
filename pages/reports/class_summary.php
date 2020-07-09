<?php
require_once("php/reports.php");
$students = $report_obj->showStudentBySection("active", $_REQUEST["cId"], $_REQUEST["sId"]);
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=reports/income_report"></i> Reports</a></li>
        <li class="active"> Class Summary</li>
    </ol>
</div>


<div class="row">
    <div style="display:flex;justify-content:center;">
        <div class="col-md-4 well">
            <p><span style="font-size:20px;font-family:tahoma;color:black;">Summary Report For Class <?php echo $report_obj->getColName("class", "name", $_REQUEST["cId"]); ?></span></p>
            <p><span style="font-size:20px;font-family:tahoma;color:black;"> Report For Session: <?php echo $report_obj->getColName("session", "session_start", $_SESSION["session_id"]) . " - " . $report_obj->getColName("session", "session_end", $_SESSION["session_id"]); ?></span></p>
            <p style="font-family:tahoma;color:black;text-transform:capitalize"> <b> Section: </b>&nbsp;&nbsp;<?php echo $report_obj->getColName("section", "name", $_REQUEST["sId"]) . " - " . $report_obj->getColName("section", "nick_name", $_REQUEST["sId"]); ?></p>
            <p style="font-family:tahoma;color:black;text-transform:capitalize"> <b> Monthly Fees: </b>&nbsp;&nbsp;<?php echo $monthly_fees = $report_obj->monthlyFees($_REQUEST["cId"]); ?></p>
            <p style="font-family:tahoma;color:black;text-transform:capitalize"> <b> Total Fees: </b>&nbsp;&nbsp;<?php echo ($monthly_fees*12) ?></p>
        </div>
    </div>
</div>




<div class="table-responsive thumbnail" style="margin-top:30px;padding:20px;">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Students</th>
                <th>Parents</th>
                <?php for ($i = 1; $i <= 12; $i++) {
                    $monthNum  = $i;
                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('F');
                    echo "<th> $monthName </th>";
                } ?>
                <th>Total Paid Fees</th>
                <th>Total Due Fess</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($students as $data) {
            ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $data["name"] ?></td>
                    <td><?php echo $data["father_name"] ?></td>
                    <?php $total_fees = 0;
                    for ($i = 1; $i <= 12; $i++) {

                        $monthNum  = str_pad($i, 2, "0", STR_PAD_LEFT);
                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');
                        $student_id = $data["id"];
                        $session_id = $_SESSION["session_id"];
                        $month = "2020-$monthNum";
                        $fees = $report_obj->fetchMonthlyPaymentOfStudent($student_id, $session_id, $month);
                        $total_fees += $fees;
                        echo "<td> $fees </td>";
                    } ?>
                    <td><?php echo $total_fees ?></td>
                    <td><?php echo ($monthly_fees*12)-$total_fees ?></td>
                    <td>
                        <a href="index.php?page=reports/student_summary&sId=<?php echo $row["student_id"] ?>&cId=<?php echo $row["class_id"] ?>"><i class="fa fa-eye btn-view"></i></a> &nbsp;
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
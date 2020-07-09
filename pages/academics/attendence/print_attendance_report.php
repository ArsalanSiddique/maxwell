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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    @media print {
        @page {
            size: landscape;
        }
    }
</style>

<body onload="window.print()" style="padding: 24px;">
    <?php

    $class = $_REQUEST["cId"];
    $section = $_REQUEST["sId"];
    $month = $_REQUEST["mth"];




    require_once("../../../php/academics.php");

    $students = $academics_obj->showAllStudents("active", $class, $section);
    ?>
    <!-- Details About Table -->
    <div class="row" style="margin-top:4px;display:flex;justify-content:center;">
        <div class="col-md-5 well">
            <p><span style="font-size:20px;font-family:tahoma;">Monthly Attendence Report</span></p>
            <p style="font-family:tahoma;">Class: <?php echo $academics_obj->getColName("class", "name", $class) ?></p>
            <p style="font-family:tahoma;">Month: <?php echo $month ?></p>
        </div>
    </div>

    <!-- Table Attendence Report -->

    <div class="row" style="padding: 1px;">
        <div style="display: flex; justify-content: left; margin-left: 24px;">
            <div>
                <H5>P => Present</H5>
                <H5>A => Absent</H5>
                <H5>L => Late</H5>
            </div>
            &nbsp;&nbsp;
            &nbsp;&nbsp;
            <div style="float: left;">
                <H5>LV => Leave</H5>
                <H5>H => Holiday</H5>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th>Students | Date</th>
                    <?php //echo $month,$section,$class;
                    $date = explode("/", $month);
                    $d = cal_days_in_month(CAL_GREGORIAN, $date[0], $date[1]);
                    for ($i = 1; $i <= $d; $i++) {
                        echo "<th>" . $i . "</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $month = $date[0];
                $year = $date[1];
                foreach ($students as $std) { ?>
                    <tr>
                        <td><?php echo $std["name"] ?></td>
                        <?php for ($i = 1; $i <= $d; $i++) {
                            $date = "$year-$month-$i";
                            $result = $academics_obj->getAttendanceStatus($class, $section, $std["id"], $date);
                            if ($result == "present") {
                                echo '<td><b>P</b></td>';
                            } else if ($result == "late") {
                                echo '<td><b>L</b></td>';
                            } else if ($result == "absent") {
                                echo '<td><b>A</b></td>';
                            } else if ($result == "holiday") {
                                echo '<td><b>H</b></td>';
                            } else if ($result == "half_day") {
                                echo '<td><b>LV</b></td>';
                            } else {
                                echo '<td></td>';
                            }
                        } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</body>

</html>
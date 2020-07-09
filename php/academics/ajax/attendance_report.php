<?php

if (isset($_POST["class_id"])) {
    if (isset($_POST["section"])) {
        if (isset($_POST["month"])) {
            extract($_POST);
            $class = $class_id;
            require_once("../../academics.php");

            $students = $academics_obj->showAllStudents("active", $class, $section);
?>
            <!-- Details About Table -->
            <div class="row" style="margin-top:80px;display:flex;justify-content:center;">
                <div class="col-md-4 well">
                    <p><span style="font-size:20px;font-family:tahoma;">Attendence Sheet</span></p>
                    <p style="font-family:tahoma;">Class: <?php echo $academics_obj->getColName("class", "name", $class) ?></p>
                    <p style="font-family:tahoma;">Month: <?php echo $month ?></p>
                </div>
            </div>

            <!-- Table Attendence Report -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Attendance Monthly Report
                    <div class="pull-right">
                        <a href="pages/academics/attendence/print_attendance_report.php?mth=<?php echo $month ?>&cId=<?php echo $class ?>&sId=<?php echo $section ?>" target="_BLANK" class="btn btn-primary btn-sm" style="padding: 4px;"> Print Report </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div style="display: flex; justify-content: left; margin-left: 24px;">
                            <H5><i class="fa fa-circle" style="color: green;"></i> => Present</H5>
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            <H5><i class="fa fa-circle" style="color: orange;"></i> => Late</H5>
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            <H5><i class="fa fa-circle" style="color: red;"></i> => Absent</H5>
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            <H5><i class="fa fa-circle" style="color: blue;"></i> => Holiday</H5>
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            <H5><i class="fa fa-circle" style="color: pink;"></i> => Half Day</H5>
                        </div>
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Roll.No</th>
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
                                $count = 1;
                                $month = $date[0];
                                $year = $date[1];
                                foreach ($students as $std) { ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $std["name"] ?></td>
                                        <?php for ($i = 1; $i <= $d; $i++) {
                                            $date = "$year-$month-$i";
                                            $result = $academics_obj->getAttendanceStatus($class, $section, $std["id"], $date);
                                            if ($result == "present") {
                                                echo '<td><i class="fa fa-circle" style="color:green;"></i></td>';
                                            } else if ($result == "late") {
                                                echo '<td><i class="fa fa-circle" style="color:orange;"></i></td>';
                                            } else if ($result == "absent") {
                                                echo '<td><i class="fa fa-circle" style="color:red;"></i></td>';
                                            } else if ($result == "holiday") {
                                                echo '<td><i class="fa fa-circle" style="color:blue;"></i></td>';
                                            } else if ($result == "half_day") {
                                                echo '<td><i class="fa fa-circle" style="color:pink;"></i></td>';
                                            } else {
                                                echo '<td></td>';
                                            }
                                        } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>

<?php
        }
    }
}

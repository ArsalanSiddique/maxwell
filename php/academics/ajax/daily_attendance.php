<?php
if (isset($_POST["section"])) {
    if (isset($_POST["class_id"])) {
        if (isset($_POST["date"])) {

            require_once("../../academics.php");
            $section = $_POST["section"];
            $date = $_POST["date"];
            $class = $_POST["class_id"];

            $students = $academics_obj->fetchAttendanceTable("active", $class, $section, $date);

?>
            <div class="row">
                <center>
                    <div class="col-md-4 well" style="margin-left:33%">
                        <p><span style="font-size:20px;font-family:tahoma;color:black;">Attendence For Class <?php echo $academics_obj->getClassById($class); ?></span></p>
                        <p style="font-family:tahoma;color:black;">Section: <?php echo $academics_obj->getSectionById($section); ?></p>
                        <p style="font-family:tahoma;color:black;"><?php echo $date; ?></p>
                    </div>
                </center>
            </div>

            <!--Attendence Table-->
            <div class="thumbnail">
                <div class="row" style="padding: 20px">
                    <form action="php/academics/attendance.php" method="POST">
                        <input type="hidden" name="class_id" value="<?php echo $class ?>">
                        <input type="hidden" name="section_id" value="<?php echo $section ?>">
                        <input type="hidden" name="date" value="<?php echo $date ?>">

                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Reg No#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Attendence</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="row">
                                    <?php
                                    foreach ($students as $student) {
                                        if ($student["status"] == "active") {
                                            $flag = 1;
                                        } else {
                                            $flag = 0;
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $student["reg_no"] ?></td>
                                            <td><img src="<?php echo $student["photo"] ?>" alt="" width="50"></td>
                                            <td><?php echo $student["name"] ?></td>
                                            <td>
                                                <div class="inline">
                                                    <input type="radio" value="present" name='attendance[<?php echo $student["id"] ?>]' id="present_<?php echo $student["id"] ?>" required="required" <?php if ($student["status"] == "present") {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        } ?>>
                                                    <label for="present_<?php echo $student["id"] ?>">Present</label>
                                                    &nbsp;
                                                    <input type="radio" value="late" name='attendance[<?php echo $student["id"] ?>]' id="late_<?php echo $student["id"] ?>" required="required" <?php if ($student["status"] == "late") {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?>>
                                                    <label for="late_<?php echo $student["id"] ?>">Late</label>
                                                    &nbsp;
                                                    <input type="radio" value="absent" name='attendance[<?php echo $student["id"] ?>]' id="absent_<?php echo $student["id"] ?>" required="required" <?php if ($student["status"] == "absent") {
                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                    } ?>>
                                                    <label for="absent_<?php echo $student["id"] ?>">Absent</label>
                                                    &nbsp;
                                                    <input type="radio" value="half_day" name='attendance[<?php echo $student["id"] ?>]' id="half_day_<?php echo $student["id"] ?>" required="required" <?php if ($student["status"] == "half_day") {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        } ?>>
                                                    <label for="half_day_<?php echo $student["id"] ?>">Half Day</label>
                                                    &nbsp;
                                                    <?php if ($student["status"] == "holiday") { ?>
                                                        <input type="radio" value="holiday" name='attendance[<?php echo $student["id"] ?>]' id="holiday_<?php echo $student["stueid"] ?>" required="required" <?php if ($student["status"] == "holiday") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                } ?>>
                                                        <label for="holiday_<?php echo $student["id"] ?>">Holiday</label>
                                                        &nbsp;
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </div>
                            </tbody>
                        </table>
                        <center>
                            <?php if ($flag == 0) { ?>
                                <input type="submit" name="update_attendance" class="btn btn-primary" value="Save Attendance">
                                <a href="php/academics/attendance.php?status=upholiday&c=<?php echo $class . "&s=" . $section . '&d=' . $date; ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"> &nbsp </i>Mark As Holiday</button></a>
                            <?php } else { ?>
                                <input type="submit" name="save_attendance" class="btn btn-primary" value="Save Attendance">
                                <a href="php/academics/attendance.php?status=holiday&c=<?php echo $class . "&s=" . $section . '&d=' . $date; ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"> &nbsp </i>Mark As Holiday</button></a>
                            <?php } ?>

                        </center>
                    </form>
                </div>
            </div>
<?php
        }
    }
}
?>
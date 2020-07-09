<?php

if (isset($_REQUEST["msg"])) {
	if ($_REQUEST["msg"] == "t_err") {
		echo $alert_obj->warning("Routine may exist, check manualy");
	} else {
		// do nothing.
	}
}


require_once("php/academics.php");
$classes = $academics_obj->fetchAllRecord("class");
$data = $academics_obj->getRecordById("class_routine", $_REQUEST['tId']);
$sections = $academics_obj->showSectionByClass($data["class_id"]);

$start_time_hour = date("H", strtotime($data["start_time"]));
$end_time_hour = date("H", strtotime($data["end_time"]));

$start_time_format = date("a", strtotime($data["start_time"]));
$end_time_format = date("a", strtotime($data["end_time"]));


$start_time_min = date("i", strtotime($data["start_time"]));
$end_time_min = date("i", strtotime($data["end_time"]));



$subjects = $academics_obj->showALlSubject($data["class_id"], $data["section_id"]);
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/time_table/timetable">Time Table</a></li>
        <li class="active"><a href="#">Add Routine</a></li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Add Dialy Routine
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="" style="padding:18px;">
                <form action="php/academics/subject.php" method="post">
                    <div class="form-group">
                        <label for="current_session">Class</label><br>
                        <input type="hidden" name="routine_id" value="<?php echo $data["id"] ?>" id="">
                        <select name="class_id" class="form-control" id="class" required="required" onchange="myfun(this.value); fetchSubject(this.value)" required="required">
                            <?php
                            foreach ($classes as $class) {
                            ?>
                                <option value="<?php echo $class["id"] ?>" <?php if ($class["id"] == $data["class_id"]) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $class["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="current_session">Section</label>
                        <select name="section_id" class="form-control" id="section" required="required">
                            <option value="">Select</option>
                            <?php
                            foreach ($sections as $record) {
                            ?>
                                <option value="<?php echo $record["id"] ?>" <?php if ($record["id"] == $data["section_id"]) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $record["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <select name="subject_id" id="subject" class="form-control" required="required">
                            <?php
                            foreach ($subjects as $subject) {
                            ?>
                                <option value="<?php echo $subject["id"] ?>" <?php if ($subject["id"] == $data["subject_id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $subject["name"] ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_position">Day:</label>
                        <select name="day" id="" class="form-control" required="required">
                            <option value="Sunday" <?php if ($data["day"] == "Sunday") {
                                                        echo "selected";
                                                    } ?>>Sunday</option>
                            <option value="Monday" <?php if ($data["day"] == "Monday") {
                                                        echo "selected";
                                                    } ?>>Monday</option>
                            <option value="Tuesday" <?php if ($data["day"] == "Tuesday") {
                                                        echo "selected";
                                                    } ?>>Tuesday</option>
                            <option value="Wednesday" <?php if ($data["day"] == "Wednesday") {
                                                            echo "selected";
                                                        } ?>>Wednesday</option>
                            <option value="Thursday" <?php if ($data["day"] == "Thursday") {
                                                            echo "selected";
                                                        } ?>>Thursday</option>
                            <option value="Friday" <?php if ($data["day"] == "Friday") {
                                                        echo "selected";
                                                    } ?>>Friday</option>
                            <option value="Saturday" <?php if ($data["day"] == "Saturday") {
                                                            echo "selected";
                                                        } ?>>Saturday</option>
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        <label for="start_time">Start Time:</label>
                        <select name="s_hour" id="" class="form-control" required="required">
                            <?php for ($i = 0; $i <= 12; $i++) {
                                if ($i == $start_time_hour) {
                                    echo "<option value='$i' selected >$i</option>";
                                } else {
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="s_minute" id="" class="form-control" required="required">
                            <?php for ($i = 0; $i < 60; $i += 5) {
                                if ($i == $start_time_min) {
                                    echo "<option value='$i' selected >$i</option>";
                                } else {
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="s_format" id="" class="form-control" required="required">
                            <option value="am" <?php if ($start_time_format == "am") {
                                                    echo "selected";
                                                } ?>>am</option>
                            <option value="pm" <?php if ($start_time_format == "pm") {
                                                    echo "selected";
                                                } ?>>pm</option>
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        <label for="start_time">End Time:</label>
                        <select name="e_hour" id="" class="form-control" required="required">
                            <?php for ($i = 00; $i <= 12; $i++) {
                                if ($i == $end_time_hour) {
                                    echo "<option value='$i' selected >$i</option>";
                                } else {
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="e_minute" id="" class="form-control" required="required">
                            <?php for ($i = 0; $i < 60; $i += 5) {
                                if ($i == $end_time_min) {
                                    echo "<option value='$i' selected >$i</option>";
                                } else {
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="e_format" id="" class="form-control" required="required">
                            <option value="am" <?php if ($end_time_format == "am") {
                                                    echo "selected";
                                                } ?>>am</option>
                            <option value="pm" <?php if ($end_time_format == "pm") {
                                                    echo "selected";
                                                } ?>>pm</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" name="update_routine" value="Update TimeTable" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row"></div>
<script type="text/javascript">
    function myfun(datavalue) {
        $.ajax({
            url: 'php/academics/get_data.php',
            type: 'POST',
            data: {
                datapost: datavalue
            },
            success: function(result2, status) {
                $('#section').html(result2);
            }
        });
    }

    function fetchSubject(datavalue) {
        $.ajax({
            url: 'php/academics/get_data.php',
            type: 'POST',
            data: {
                class_id: datavalue
            },
            success: function(result, status) {
                $('#subject').html(result);
            }
        });
    }
</script>
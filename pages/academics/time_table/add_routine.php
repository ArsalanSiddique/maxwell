<?php
if (isset($_REQUEST["msg"])) {
	if ($_REQUEST["msg"] == "t_err") {
		echo $alert_obj->warning("Routine may exist, check carefully");
	} else {
		// do nothing.
	}
}
require_once("php/academics.php");
$classes = $academics_obj->showAllClass();

if (isset($_REQUEST["c"]) && isset($_REQUEST["s"])) {
    extract($_REQUEST);
    $class = $c;
    $section = $s;
    $subjects = $academics_obj->showALlSubject($class, $section);
}
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/time_table/timetable.php">Time Table</a></li>
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
                        <select name="class_id" class="form-control" id="class" required="required" onchange="myfun(this.value); fetchSubject(this.value)" required="required">
                            <option value="">Select</option>
                            <?php
                            foreach ($classes as $class) {
                            ?>
                                <option value="<?php echo $class["id"] ?>" <?php if ($class["id"] == $class) {
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
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <select name="subject_id" id="subject" class="form-control" required="required">
                            <option value="">Select Subject</option>
                            <?php
                            foreach ($subjects as $subject) {
                            ?>
                                <option value="<?php echo $subject["id"] ?>"><?php echo $subject["name"] ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_position">Day:</label>
                        <select name="day" id="" class="form-control" required="required">
                            <option value="">Select Day</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        <label for="start_time">Start Time:</label>
                        <select name="s_hour" id="" class="form-control" required="required">
                            <?php for ($i = 00; $i <= 12; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                        <select name="s_minute" id="" class="form-control" required="required">
                            <?php for ($i = 0; $i < 60; $i += 5) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                        <select name="s_format" id="" class="form-control" required="required">
                            <option value="am">am</option>
                            <option value="pm">pm</option>
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        <label for="start_time">End Time:</label>
                        <select name="e_hour" id="" class="form-control" required="required">
                            <?php for ($i = 00; $i <= 12; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                        <select name="e_minute" id="" class="form-control" required="required">
                            <?php for ($i = 0; $i < 60; $i += 5) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                        <select name="e_format" id="" class="form-control" required="required">
                            <option value="am">am</option>
                            <option value="pm">pm</option>
                        </select>
                    </div>
                    <input type="submit" name="timetable" value="Save" class="btn btn-primary" />
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
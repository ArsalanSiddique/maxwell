<?php
require_once("php/academics.php");
$subject = $academics_obj->getSubjectById($_REQUEST["subId"]);
$sections = $academics_obj->getSection($subject["class_id"]);
$classes = $academics_obj->showAllClass();
$teachers = $academics_obj->getAllTeachers($_SESSION["campus_id"]);
?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/subjects/subjects"> Subject List</a></li>
        <li class="active"><a href="#"> Add Subject</a></li>
    </ul>
</div>




<div class="row">
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                Subject Details
            </div>
            <div class="panel-body">
                <form action="php/academics/subject.php" method="post" class="form-group">
                    <div class="form-group">
                        <label for="current_session">Class</label><br>
                        <select name="class_id" class="form-control" id="class" required="required" style="width:100%;" onchange="myfun(this.value)">
                            <option value="">Select</option>
                            <?php
                            foreach ($classes as $class) {
                            ?>
                                <option value="<?php echo $class["id"]; ?>" <?php if ($subject["class_id"] == $class["id"]) {
                                                                                echo "selected";
                                                                            }  ?>><?php echo $class["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="current_session">Section</label>
                        <select name="section" class="form-control" id="section" required="required" style="width:100%;">
                            <option value="">Select</option>
                            <?php
                            foreach ($sections as $section) {
                            ?>
                                <option value="<?php echo $section["id"]; ?>" <?php if ($subject["section_id"] == $section["id"]) {
                                                                                    echo "selected";
                                                                                }  ?>><?php echo $section["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Subject Code: </label>
                        <input type="text" name="code" value="<?php echo $subject["code"]; ?>" class="form-control" id="code" placeholder="subject code">
                        <input type="hidden" name="sub_id" value="<?php echo $subject["id"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name: <span class="red_required">*</span></label>
                        <input type="text" name="name" value="<?php echo $subject["name"]; ?>" class="form-control" placeholder="subject name" id="">
                    </div>
                    <div class="form-group">
                        <label for="sub_teacher">Teacher: <span class="red_required">*</span></label>
                        <select name="teacher" id="" class="form-control">
                            <option value="">Select Teacher</option>
                            <?php
                            foreach ($teachers as $teacher) {
                            ?>
                                <option value="<?php echo $teacher["id"]; ?>" <?php if ($subject["teacher_id"] == $teacher["id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $teacher["name"] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <input type="submit" name="update_subject" value="Update" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function myfun(datavalue) {
        $.ajax({
            url: 'php/academics/get_data.php',
            type: 'POST',
            data: {
                datapost: datavalue
            },
            success: function(result, status) {
                $('#section').html(result);
            }
        });
    }
</script>
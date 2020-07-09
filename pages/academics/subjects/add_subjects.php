<?php
require_once("php/academics.php");
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
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Subject Details
            </div>
            <div class="panel-body">
                <form action="php/academics/subject.php" method="post" class="form-group">
                    <div class="form-group">
                        <label for="current_session">Class <span class="red_required">*</span> </label><br>
                        <select name="class_id" class="form-control" id="class" required="required" style="width:100%;" onchange="myfun(this.value)">
                            <option value="">Select</option>
                            <?php
                            foreach ($classes as $class) {
                            ?>
                                <option value="<?php echo $class["id"] ?>"><?php echo $class["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="current_session">Section</label>
                        <select name="section" class="form-control" id="section" style="width:100%;">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Subject Code: <span class="red_required">*</span></label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="subject code">
                    </div>
                    <div class="form-group">
                        <label for="name">Name: <span class="red_required">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="subject name" id="">
                    </div>
                    <div class="form-group">
                        <label for="sub_teacher">Teacher: <span class="red_required">*</span></label>
                        <select name="teacher" id="" class="form-control">
                            <option value="">Select Teacher</option>
                            <?php
                            foreach ($teachers as $teacher) {
                            ?>
                                <option value="<?php echo $teacher["id"] ?>"><?php echo $teacher["name"] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <input type="submit" name="add_subject" value="submit" class="btn btn-primary" />
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
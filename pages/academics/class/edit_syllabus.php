<?php

if (isset($_REQUEST["sId"])) {
    $table = "syllabus";
    $id = $_REQUEST["sId"];
    $result =  $academics_obj->getRecordById($table, $id);
}
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/class/academic_syllabus"> Accademic Syllabus</a></li>
        <li class="active"><a href="#">Edit Syllabus</a></li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Details</div>
                <div class="panel-body">
                    <form action="php/academics/class.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" value="<?php echo $result["title"] ?>" class="form-control" placeholder="Title">
                            <input type="hidden" name="syllabus_id" value="<?php echo $result["id"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea name="details" class="form-control" id="details" cols="10" rows="3"> <?php echo $result["details"] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="class">Select CLass</label>
                            <select name="class_id" class="form-control" id="class" onchange="myfun(this.value)" required="required">
                                <option value="">Select Class</option>
                                <?php
                                $classOptions = $academics_obj->showAllClass();
                                foreach ($classOptions as $rows) {
                                ?>
                                    <option value="<?php echo $rows["id"] ?>" <?php if ($result["class_id"] == $rows["id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $rows["name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Select Subject</label>
                            <select name="subject_id" class="form-control" id="subject">
                                <option value="">Select Class First</option>
                                <?php
                                $subjects = $academics_obj->showALlSubject($result["class_id"]);
                                foreach ($subjects as $rows) {
                                ?>
                                    <option value="<?php echo $rows["id"] ?>" <?php if ($result["subject_id"] == $rows["id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $rows["name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Upload File</label>
                            <input type="file" id="file" name="file" class="form-control" />
                        </div>
                        <input type="submit" name="up_syllabus" class="btn btn-primary btn-md pull-right" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
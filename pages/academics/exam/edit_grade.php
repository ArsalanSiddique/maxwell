<?php

if (isset($_REQUEST["gId"])) {
    $grade_id = $_REQUEST["gId"];
    $grade = $academics_obj->getRecordById("exam_grades", $grade_id);
}

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/exam/exam_grades">Grade List</a></li>
        <li class="active"><a href="#">Update Grade</a></li>
    </ul>
</div>
<div class="thumbnail">
    <div class="row">
        <form action="php/academics/exam.php" method="post" class="form-group thumbnail col-md-6" style="margin:10px;padding:20px;">
            <div class="form-group">
                <label for="class_name">Name:</label>
                <input type="text" name="name" value="<?php echo $grade["name"] ?>" id="" required="required" class="form-control" />
                <input type="hidden" name="grade_id" value="<?php echo $grade["id"] ?>" />
            </div>
            <div class="form-group">
                <label for="grade_point">Grade Point:</label>
                <input type="text" name="point" value="<?php echo $grade["point"] ?>" id="" class="form-control" required="" />
            </div>
            <div class="form-group">
                <label for="mark_from">Mark From:</label>
                <input type="text" name="from" value="<?php echo $grade["marks_from"] ?>" id="" class="form-control" />
            </div>
            <div class="form-group">
                <label for="mark_upto">Mark Upto:</label>
                <input type="text" name="upto" value="<?php echo $grade["marks_upto"] ?>" id="" class="form-control" />
            </div>
            <div class="form-group">
                <label for="coment">Remarks:</label>
                <input type="text" name="comment" value="<?php echo $grade["remarks"] ?>" id="" class="form-control" />
            </div>
            <input type="submit" value="Update" name="edit_Grade" class="btn btn-primary" />
        </form>
    </div>
</div>
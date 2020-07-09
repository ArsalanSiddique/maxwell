<?php

    if(isset($_REQUEST["eId"])) {
        $exam_id = $_REQUEST["eId"];
        $exam = $academics_obj->getExamById($exam_id);
    }

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academcis/exam/exam_list">Exam List</a></li>
        <li class="active"><a href="#">Update Exam</a></li>
    </ul>
</div>
<div class="thumbnail">
    <div class="row">
        <form action="php/academics/exam.php" method="post" class="form-group thumbnail col-md-6" style="margin:10px;padding:20px;">
            <div class="form-group">
                <label for="class_name">Name:</label>
                <input type="text" name="name" id="" value="<?php echo $exam["name"] ?>" required="required" placeholder="Enter Exam Name" class="form-control" />
                <input type="hidden" name="exam_id" value="<?php echo $exam["id"] ?>"/>
            </div>
            <div class="form-group">
                <label for="marks">Marks:</label>
                <input type="text" name="maxMarks" id="" value="<?php echo $exam["marks"] ?>" required="required" placeholder="Enter Max. Marks" class="form-control" />
            </div>
            <div class="form-group">
                <label for="date">Date: </label>
                <input type="date" name="date" id="" value="<?php echo $exam["date"] ?>" required="required" class="form-control" />
            </div>
            <div class="form-group">
                <label for="comments">Comments:</label>
                <input type="text" name="comments" id="" value="<?php echo $exam["comments"] ?>" placeholder="Enter Comments" class="form-control" />
            </div>
            <input type="submit" name="edit_exam" value="Update" class="btn btn-primary" />
        </form>
    </div>
</div>
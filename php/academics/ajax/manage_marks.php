<?php
extract($_POST);
require_once("../../academics.php");
if (empty($section)) {
    $record = $academics_obj->manageMarks($class_id, null, $subjects, $exam_id);
    foreach($record as $data) {
        $max_marks = $data["max_marks"];
    }
} else {
    $record = $academics_obj->manageMarks($class_id, $section, $subjects, $exam_id);    
}

?>
<div class="thumbnail" style="padding: 12px;">
    <div class="container-fluid">
        <form action="php/academics/exam.php" method="post">
            <input type="hidden" name="class_id" value="<?php echo $class_id ?>">
            <input type="hidden" name="section_id" value="<?php echo $section ?>">
            <input type="hidden" name="exam_id" value="<?php echo $exam_id ?>">
            <input type="hidden" name="subject_id" value="<?php echo $subjects ?>">

            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Regist#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Father Name</th>
                        <th style="width: 20%;"><?php echo $academics_obj->getSubjectName($subjects) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <div class="form-group">
                        <label for="max">Max. Marks:</label>
                        <input type="text" name="max_marks" id="max" value="<?php echo $max_marks ?>" class="form-control" placeholder="Enter Max Marks">
                    </div>
                    <?php $count = 0;
                    foreach ($record as $data) { ?>
                        <tr>
                            <td><?php echo ++$count; ?></td>
                            <td><?php echo $data["reg_no"] ?></td>
                            <td><?php echo $data["name"] ?></td>
                            <td><?php if (empty($data["class"])) {
                                    echo $academics_obj->getClassByID($class_id);
                                    $flag = 1;
                                } else {
                                    echo $data["class"];
                                    $flag = 0;
                                } ?></td>
                            <td><?php echo $academics_obj->getColName("section", "name", $data["section_id"]) ?></td>
                            <td><?php echo $data["father_name"] ?></td>
                            <td width=50>
                                <input type="number" name="marks[]" id="" value="<?php echo $data["marks"] ?>" class="form-control">
                                <input type="hidden" name="student_id[]" value="<?php echo $data["student_id"] ?>">
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <center>
                <input type="submit" class="btn btn-primary" <?php if ($flag == 1) {
                                                                    echo 'name="update_marks"';
                                                                } else {
                                                                    echo 'name="manage_marks"';
                                                                } ?> value="Save Changes">
            </center>
        </form>
    </div>
</div>
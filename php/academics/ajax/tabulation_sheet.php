<?php
require_once("../../academics.php");
extract($_POST);
$section_id = $section;
$subjects = $academics_obj->showALlSubject($class_id);

if (empty($section_id)) {
    $section_id = null;
    $students = $academics_obj->showStudentByClass("active", $class_id);
} else {
    $students = $academics_obj->showAllStudents("active", $class_id, $section_id);
}


?>

<div class="row" style="margin-top:10px;">
    <div style="display:flex; justify-content:center;">
        <div class="col-md-4 well">
            <p><span style="font-size:20px;font-family:tahoma;">Marks For <?php echo $academics_obj->getColName("exams", "name", $exam_id) ?></span></p>
            <p style="font-family:tahoma;">Class <?php echo $academics_obj->getColName("class", "name", $class_id) ?> </p>
            <p style="font-family:tahoma;">Section: <?php echo $academics_obj->getColName("section", "name", $section_id) ?> </p>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Tabulation Sheet
        <div class="pull-right">
            <a href="pages/academics/exam/print_tabulation_sheet.php?sId<?php echo $section_id ?>=&cId=<?php echo $class_id ?>&eId=<?php echo $exam_id ?>" target="_BLANK" class="btn btn-primary btn-sm" style="padding: 4px;"> Print Sheet </a>
        </div>
    </div>
    <div class="panel-body">
        <!-- Tabulation Sheet -->
        <table id="example" class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Roll</th>
                    <th>Students &nbsp <i class="fa fa-long-arrow-down" aria-hidden="true"></i> &nbsp & Subjects &nbsp <i class="fa fa-long-arrow-right" aria-hidden="true"></i></th>
                    <?php foreach ($subjects as $sub) { ?>
                        <th><?php echo $sub["name"] ?></th>
                    <?php } ?>
                    <th>Obtained</th>
                    <th>Total</th>
                    <th> Percent. </th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1;
                foreach ($students as $record) { ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $record["name"] ?></td>
                        <?php $obtained_marks = 0;
                        foreach ($subjects as $sub) { ?>
                            <td><?php echo $marks = $academics_obj->fetchExamMarks($exam_id, $class_id, $section_id, $sub["id"], $record["id"]);
                                $obtained_marks += $marks;
                                $max_marks = $academics_obj->fetchExamMaxMarks($exam_id, $class_id, $section_id, $sub["id"], $record["id"]);
                                $total_max_marks += $max_marks; ?></td>
                        <?php } ?>
                        <td><?php echo $obtained_marks; ?></td>
                        <td><?php echo $total_max_marks ?></td>
                        <td><?php $percentage = (($obtained_marks / $total_max_marks) * 100);
                            echo number_format($percentage, 2) . " %"; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div style="display:flex; justify-content:center;">
            <a href="pages/academics/exam/print_tabulation_sheet.php?sId<?php echo $section_id ?>=&cId=<?php echo $class_id ?>&eId=<?php echo $exam_id ?>" target="_BLANK" class="btn btn-primary btn-md"> Print Tabulation Sheet </a>
        </div>
    </div>
</div>
<?php
extract($_POST);
require_once("../../academics.php");
$class_id = 1;
if (empty($section)) {
    $students = $academics_obj->showStudentByClass("active", $class_id);
} else {
    $students = $academics_obj->showAllStudents("active", $class_id, $section);
}

if ($students != false) {
    $count = 1;
    foreach ($students as $student) {
?>
        <tr>
            <td><?php echo $student["reg_no"] ?></td>
            <td><?php echo $class = $academics_obj->getClassById($student["class_id"]); ?></td>
            <td><?php echo $section = $academics_obj->getSectionById($student["section_id"]); ?></td>
            <td><?php echo $student["name"] ?></td>
            <td><?php echo $student["father_name"] ?></td>
            <td><?php echo $student["gender"] ?></td>
            <td><?php echo $student["phone"] ?></td>
            <td><?php echo $student["address"] ?></td>
            <td>
                <a href="index.php?page=academics/exam/progress_card&sId=<?php echo $student["id"] ?>" target="_blank"><i class="fa fa-eye btn-view"></i></a>
            </td>
        </tr>
<?php
    }
}

?>
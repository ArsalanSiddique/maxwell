<?php
extract($_POST);
require_once("../../academics.php");
if(empty($section)) {
    $result = $academics_obj->showALlSubject($class_id);
}else {
    $result = $academics_obj->showSubjectBySection($class_id, $section);
}

$count = 1;
foreach ($result as $row) {
?>
    <tr>
        <td><?php echo $count++; ?></td>
        <td><?php echo $row["code"] ?></td>
        <td><?php echo $academics_obj->getClassById($row["class_id"]) ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $academics_obj->getTeacherById($row["teacher_id"]) ?></td>
        <td>
            <a href="index.php?page=academics/subjects/edit_subjects&subId=<?php echo $row["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
            <a href="index.php?page=academics/subjects/subjects&status=delete&subId=<?php echo $row["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
        </td>
    </tr>
<?php } ?>
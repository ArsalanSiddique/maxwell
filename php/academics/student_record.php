<?php
if (isset($_POST["stat"])) {
    extract($_POST);
    require_once("../academics.php");
    if(empty($section)) {
        $students = $academics_obj->showStudentByClass($stat, $class_id);
    }else {
        $students = $academics_obj->showAllStudents($stat, $class_id, $section);
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
                    <a href="index.php?page=academics/students/view_student&sId=<?php echo $student["id"] ?>" target="self"><i class="fa fa-eye btn-view"></i></a> &nbsp;
                    <a href="index.php?page=academics/students/edit_student&sId=<?php echo $student["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
                    <a href="index.php?page=academics/students/student_information&status=delete&sId=<?php echo $student["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
                </td>
            </tr>
        <?php
        }
    }
} else if (isset($_POST["from_class"])) {
    extract($_POST);
    require_once("../academics.php");
    $students = $academics_obj->showStudentByClass("active", $from_class);
    $count = 1;
    $i = 1;
    foreach ($students as $std) {
        ?>

        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $std["reg_no"] ?></td>
            <td> <img src=" <?php echo $std["photo"] ?>" alt="profile" class="img-thumbnail" style="width: 75px;"></td>
            <td><?php echo $std["name"] ?></td>
            <td><?php echo $std["father_name"] ?></td>
            <td style="width: 25%"><a href="index.php?page=academics/students/student_performance&cId=<?php echo $std["class_id"] ?>&sId=<?php echo $std["id"] ?>" target="_blank"><button class="btn btn-secondary"> <i class="fa fa-eye"></i> &nbsp;
                        Show Academic Performance</button></a></td>
            <td>
                <button type="button" onclick="promotion(<?php echo $std['id'] ?>, <?php echo $to_class ?>)" id="<?php echo $std['id'] ?>" class="btn btn-primary btn-sm">Promote</button>
            </td>
        </tr>

<?php
    }
}
?>
<?php
extract($_POST);
require_once("../reports.php");
if (!empty($depart_id) && !empty($month)) {
    $result = $report_obj->fetchCustomReport($campus_id, $depart_id);

    $count = 1;
    foreach ($result as $row) {
?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo  $report_obj->getColName("department", "name", $row["depart_id"]) ?></td>
            <td><?php echo $row["class_name"] ?></td>
            <td><?php echo $row["section_name"] ?></td>
            <td> <?php $students = $report_obj->showStudentBySection("active", $row["class_id"], $row["section_id"]); echo mysqli_num_rows($students); ?> </td>
            <td> <?php $fees = $report_obj->CountFees($row["class_id"], $row["section_id"], $month); print($fees[0]) ?> </td>
            <td> <?php print($fees[1]) ?> </td>
            <td> <?php print($fees[2]) ?> </td>
            <td>
                <a href="index.php?page=reports/class_summary&cId=<?php echo $row["class_id"] ?>&sId=<?php echo $row["section_id"] ?>" target="_blank"><i class="fa fa-eye btn-view"></i></a> &nbsp;
            </td>
        </tr>
<?php }
} ?>
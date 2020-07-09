<?php
$exams = $academics_obj->fetchAllRecord("exams");
$subjects = $academics_obj->showALlSubject($_REQUEST["cId"]);
?>

<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/student/student_promotion"> Student Promotion</a></li>
        <li class="active"><a href="#">Student Performance</a></li>
    </ul>
</div>

<div class="container-fluid">
    <h2><?php echo $academics_obj->getColName("students", "name", $_REQUEST["sId"]) ?></h2>

    <br>
    <div class="row" style="margin:0 auto;">
        <div class="col-md-9">
            <div class="panel-group">

                <?php
                foreach ($exams as $exam) {
                ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $exam["name"] ?></div>
                        <div class="panel-body">
                            <?php
                            $record = $academics_obj->fetchPerformance($_REQUEST["sId"], $exam["id"]);
                            if ($record != false) {
                            ?>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Reg No.</th>
                                            <th>Subjects</th>
                                            <th>Obtained Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($record as $data) {
                                        ?>
                                            <tr>
                                                <td><img src="<?php echo $data["photo"] ?>" width="50" alt=""></td>
                                                <td><?php echo $data["reg_no"] ?></td>
                                                <td><?php echo $academics_obj->getColName("subjects", "name", $data["subject_id"]) ?></td>
                                                <td><?php $marks += $data["marks"];
                                                    echo $data["marks"] ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>

                                        <tr>
                                            <th colspan="3" style="text-align: right">Total Obtained Marks</th>
                                            <th><?php echo $marks ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right">Total Percentage</th>
                                            <th><?php echo $percentage = (($marks / $exam["marks"]) * 100) . " %" ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right">Total Marks</th>
                                            <th><?php echo $exam["marks"] ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <hr>
                            <?php } else {
                                echo "<h4>Record Not Found</h4>";
                            } ?>
                        </div>
                    </div>
                    <br>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
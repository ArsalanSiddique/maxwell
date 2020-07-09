<?php
require_once("../../academics.php");
extract($_POST);
$sections = $academics_obj->getSection($class_id);
foreach ($sections as $data) { ?>

    <!-- Section time_table Class Ten -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title" style="font-size: 16px;text-align: center;">
                Class <?php echo $academics_obj->getClassById($class_id) ?>&nbsp; : &nbsp;
                Section - <?php echo $data["name"] ?>
                <a href="pages/academics/time_table/print_timetable.php?cId=<?php echo $class_id ?>&sId=<?php echo $data["id"] ?>" class="btn btn-primary btn-xs pull-right" style="color:#fff;" target="_blank"><i class="entypo-print"></i> Print </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" cellspacing="0" width="100">
                    <tbody>
                        <?php
                        $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                        for ($k = 0; $k <= 6; $k++) {
                        ?>
                            <tr>
                                <td width="100"><?php echo $days["$k"]; ?></td>
                                <td>
                                    <?php
                                    $routines = $academics_obj->getClasRoutine($class_id, $data["id"], $days["$k"]);
                                    $hour = [];
                                    foreach ($routines as $row) {

                                        array_push($hour, $row["start_time"]);
                                    }
                                    $count = count($hour);
                                    for ($i = 0; $i < $count; $i++) {
                                        $low = $i;
                                        for ($j = $i + 1; $j < $count; $j++) {
                                            if ($hour[$j] < $hour[$low]) {
                                                $low = $j;
                                            }
                                        }

                                        if ($hour[$i] > $hour[$low]) {
                                            $tmp = $hour[$i];
                                            $hour[$i] = $hour[$low];
                                            $hour[$low] = $tmp;
                                        }
                                    }
                                    for ($i = 0; $i < $count; $i++) {
                                        $row = $academics_obj->fetchRoutine($class_id, $data["id"], $days["$k"], $hour[$i]);
                                        $s_time = $row["start_time"];
                                        $e_time = $row["end_time"];
                                    ?>
                                        <div class="dropdown pull-left" style="margin: 2px;">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <?php echo $academics_obj->getColName("subjects", "name", $row["subject_id"])  . " ( $s_time - $e_time )" ?> &nbsp;
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="index.php?page=academics/time_table/edit_routine&tId=<?php echo $row["id"] ?>"><i class="fa fa-pencil fa-edit"></i> &nbsp; Edit</a></li>
                                                <li>
                                                    <a href="index.php?page=academics/time_table/timetable&status=delete&tId=<?php echo $row["id"] ?>">

                                                        <i class="fa fa-trash btn-trash"></i> &nbsp; Delete

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>School Software</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../html/school_m_s/css/style4.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body onload="window.print();" style="padding: 12px;">
    <p style="text-align:right; margin-right: 18px;">
        <?php date_default_timezone_set('Asia/Karachi');
        echo $date = date('m/d/Y h:i:s a', time()); ?>
    </p>
    
    <?php
    require_once("../../../php/academics.php");
    $class_id = $_REQUEST["cId"];
    $section_id = $_REQUEST["sId"];
    $section_name = $academics_obj->getColName("section", "name", $section_id); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title" style="font-size: 16px;text-align: center;">
                Class <?php echo $academics_obj->getClassById($class_id) ?>&nbsp; : &nbsp;
                Section - <?php echo $section_name ?>
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
                                    $routines = $academics_obj->getClasRoutine($class_id, $section_id, $days["$k"]);
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
                                        $row = $academics_obj->fetchRoutine($class_id, $section_id, $days["$k"], $hour[$i]);
                                        $s_time = $row["start_time"];
                                        $e_time = $row["end_time"];
                                    ?>
                                        <div class="dropdown pull-left" style="margin: 2px;">
                                            <div class="badge badge-default" style="padding: 6px; border: 1px solid grey;">
                                                <?php echo $academics_obj->getColName("subjects", "name", $row["subject_id"])  . " ( $s_time - $e_time )" ?> &nbsp;
                                            </div>
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
    <div class="row" style="border: 1px dotted grey;"></div>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title" style="font-size: 16px;text-align: center;">
                Class <?php echo $academics_obj->getClassById($class_id) ?>&nbsp; : &nbsp;
                Section - <?php echo $section_name ?>
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
                                    $routines = $academics_obj->getClasRoutine($class_id, $section_id, $days["$k"]);
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
                                        $row = $academics_obj->fetchRoutine($class_id, $section_id, $days["$k"], $hour[$i]);
                                        $s_time = $row["start_time"];
                                        $e_time = $row["end_time"];
                                    ?>
                                        <div class="dropdown pull-left" style="margin: 2px;">
                                            <div class="badge badge-default" style="padding: 6px; border: 1px solid grey;">
                                                <?php echo $academics_obj->getColName("subjects", "name", $row["subject_id"])  . " ( $s_time - $e_time )" ?> &nbsp;
                                            </div>
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

</body>

</html>
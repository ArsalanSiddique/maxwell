<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="../html/school_m_s/css/font-awesome.css">
    <style>
        @media print {
            @page {
                size: landscape
            }
        }
    </style>
</head>

<body onload="window.print()" style="padding: 12px;">

    <?php
    require_once("../../../php/academics.php");
    $section_id = $_REQUEST["sId"];
    $class_id = $_REQUEST["cId"];
    $exam_id = $_REQUEST["eId"];

    if (empty($section_id)) {
        $section_id = null;
    }

    $subjects = $academics_obj->showALlSubject($class_id);

    if (empty($section_id)) {
        $section_id = null;
        $students = $academics_obj->showStudentByClass("active", $class_id);
    } else {
        $students = $academics_obj->showAllStudents("active", $class_id, $section_id);
    }


    ?>
    <p style="text-align:right; margin-right: 18px;">
        <?php date_default_timezone_set('Asia/Karachi');
        echo $date = date('m/d/Y h:i:s a', time()); ?>
    </p>
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
                                    $obtained_marks += $marks; ?></td>
                            <?php } ?>
                            <td><?php echo $obtained_marks; ?></td>
                            <td><?php echo $total_marks = $academics_obj->getColName("exams", "marks", $exam_id); ?></td>
                            <td><?php $percentage = (($obtained_marks / $total_marks) * 100);
                                echo number_format($percentage, 2) . " %"; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>
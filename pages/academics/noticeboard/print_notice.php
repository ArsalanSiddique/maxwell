<?php

require_once("../../../php/academics.php");
$record = $academics_obj->getRecordById("notices", $_REQUEST["nId"]);
$data = $academics_obj->getRecordById("school_info", "1");
?>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body onload="window.print()" style="padding: 24px;">
    <p style="text-align:right; margin-right: 18px;">
        <?php date_default_timezone_set('Asia/Karachi');
        echo $date = date('m/d/Y h:i:s a', time()); ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading"><b>NOTICE</b></div>
        <div class="panel-default">
            <div class="row">
                <div class="col-xs-2">
                    <img src="<?php echo "../../../" . $data["logo"] ?>" class="img-thumbnail" width="120" style="margin: 12px 48px;" alt="School Logo">
                </div>
                <div class="col-xs-9 pull-right" style="padding-top: 24px;">
                    <h4><?php echo $data["name"] ?></h4>
                    <h4><?php echo $data["phone"] ?></h4>
                    <h4><?php echo $data["address"] ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11" style="padding-left: 24px;">
                    <h2><?php echo strtoupper($record["title"]) ?></h2>
                    <p><?php echo $record["details"] ?></p>
                </div>
            </div>

            <hr>
            <h3 style="margin-left: 12px;"><b>STAMP:</b></h3>

        </div>
    </div>

</body>

</html>
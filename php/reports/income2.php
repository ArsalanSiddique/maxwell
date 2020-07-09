<?php
extract($_POST);
require_once("../reports.php");
$result = $report_obj->fetchReportByCampus('1');
$count = 1;
$total = mysqli_num_rows($result);

$data .= '{ "data":'."<br /> [";
foreach($result as $row) {
    
    if($count < $total) {
        $data .= json_encode($row).", <br />";
    }else {
        $data .= json_encode($row)." <br />";
    }
    $count++;
    
}

$data .= ' ] }';
echo $data;

// $file = 'file.txt';
// $data = 'this is your string to write';
// file_put_contents($file, $data);

// readfile('file.txt');

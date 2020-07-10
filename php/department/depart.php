<?php

session_start();
require('../academics.php');

if (isset($_POST["addDepartment"])) {
    extract($_POST);
    $data = [null, $_SESSION["campus_id"], $name, null, null, null];
    $result = $academics_obj->addRecord("department", $data);
    if ($result = true) {
        header("Location:../../index.php?page=department/departments&msg=true");
    } else {
        header("Location:../../index.php?page=department/departments&msg=false");
    }
} else if (isset($_POST["up_department"])) {
    extract($_POST);
    $table = "department";
    $data = ["name" => $name];

    $result = $academics_obj->updateRecord($table, $data, $depart_id);
    if ($result = true) {
        header("Location:../../index.php?page=department/departments&msg=up_true");
    } else {
        header("Location:../../index.php?page=department/departments&msg=up_false");
    }
}else {
    header("Location:../../index.php");   
}
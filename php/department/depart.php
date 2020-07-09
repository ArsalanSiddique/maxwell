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
}else {
    header("Location:../../index.php");   
}
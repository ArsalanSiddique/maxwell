<?php

require_once("../../academics.php");
extract($_POST);

$data = ["class_id" => $class_id, "section_id" => ""];
$cols = "class_id = '$class_id' , section_id = NULL , updated_at = NULL";
$id = "id = $student_id";
$result = $academics_obj->promote_std("students", $cols, $id);
if ($result == false) {
    header("Location: ../../index.php?page=academics/students/student_promotion&msg=false");
}
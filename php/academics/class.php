<?php

session_start();
require('../academics.php');

if (isset($_POST["addClass"])) {
    extract($_POST);
    $data = [null, $_SESSION["campus_id"], $name, $n_name, $teacher, null, null, null];
    header("Location:../../index.php?page=academics/class/manage_class&msg=true");
    $result = $academics_obj->addRecord("class", $data);
    if ($result = true) {
    } else {
        header("Location:../../index.php?page=academics/class/manage_class&msg=false");
    }
} else if (isset($_POST["syllabus"])) {
    extract($_POST);
    session_start();

    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];

    $filesize = $_FILES['file']['size'];
    $target_path = '/home/buraqtech/school.buraqtech.net/files/syllabus/' . basename($_FILES["file"]["name"]);
    $file_store = "files/syllabus/" . $file_name;
    echo $imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
        header("Location: ../../index.php?page=academics/class/academic_syllabus&msg=file_err");
    } else {


        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            $file = $file_store;
        } else {
            $file = "";
        }

        $session_id = $_SESSION["session_id"];
        $campus_id = $_SESSION["campus_id"];
        $table = "syllabus";
        $data = [null, $session_id, $class_id, $subject_id, $title, $details, $file, null, null, null];

        $result = $academics_obj->addRecord($table, $data);
        if ($result = true) {
            header("Location:../../index.php?page=academics/class/academic_syllabus&msg=true");
        } else {
            header("Location:../../index.php?page=academics/class/academic_syllabus&msg=false");
        }
    }
} else if (isset($_POST["up_syllabus"])) {
    extract($_POST);
    $table = "syllabus";
    $data = ["class_id" => $class_id, "subject_id" => $subject_id, "title" => $title, "details" => $details];

    $result = $academics_obj->updateRecord($table, $data, $syllabus_id);
    if ($result = true) {
        header("Location:../../index.php?page=academics/class/academic_syllabus&msg=up_true");
    } else {
        header("Location:../../index.php?page=academics/class/academic_syllabus&msg=up_false");
    }
} else if (isset($_POST["up_class"])) {
    extract($_POST);
    $table = "class";
    $data = ["name" => $name, "numeric_name" => $n_name, "class_teacher" => $teacher];

    $result = $academics_obj->updateRecord($table, $data, $class_id);
    if ($result = true) {
        header("Location:../../index.php?page=academics/class/manage_class&msg=up_true");
    } else {
        header("Location:../../index.php?page=academics/class/manage_class&msg=up_false");
    }
} else if (isset($_POST["up_section"])) {
    extract($_POST);
    $table = "section";
    $data = ["name" => $name, "nick_name" => $n_name, "class_id" => $class];

    $result = $academics_obj->updateRecord($table, $data, $section_id);
    if ($result = true) {
        header("Location:../../index.php?page=academics/class/manage_section&msg=up_true");
    } else {
        header("Location:../../index.php?page=academics/class/manage_section&msg=up_false");
    }
} else {
    header("Location: index.php");
}

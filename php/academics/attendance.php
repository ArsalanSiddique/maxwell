<?php

if (isset($_POST["save_attendance"])) {
    require_once("../academics.php");
    extract($_POST);
    session_start();
    $campus_id = $_SESSION["campus_id"];
    $students = $academics_obj->showAllStudents("active", $class_id, $section_id);

    foreach ($students as $std) {
        $status = $attendance[$std["id"]];
        $data = [null, $campus_id, $class_id, $section_id, $std["id"], $status, $date, null, null, null];
        $result = $academics_obj->addRecord("attendance", $data);
        if ($result == false) {
            header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=false");
        } else {
            header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=true");
        }
    }
} else if (isset($_REQUEST["status"])) {
    if ($_REQUEST["status"] == "holiday") {
        $class_id = $_REQUEST["c"];
        $section_id = $_REQUEST["s"];
        $date = $_REQUEST["d"];
        require_once("../academics.php");
        extract($_POST);
        session_start();
        $campus_id = $_SESSION["campus_id"];
        $students = $academics_obj->showAllStudents("active", $class_id, $section_id);

        foreach ($students as $std) {
            $status = "holiday";
            $data = [null, $campus_id, $class_id, $section_id, $std["id"], $status, $date, null, null, null];
            $result = $academics_obj->addRecord("attendance", $data);
            if ($result == false) {
                header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=false");
            } else {
                header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=true");
            }
        }
    } else if ($_REQUEST["status"] == "upholiday") {
        $class_id = $_REQUEST["c"];
        $section_id = $_REQUEST["s"];
        $date = $_REQUEST["d"];
        require_once("../academics.php");
        extract($_POST);
        session_start();
        $students = $academics_obj->showAllStudents("active", $class_id, $section_id);

        foreach ($students as $std) {
            $data = ["status" => "holiday"];
            $where = "student_id = " . $std["id"] . " AND date = '$date'";
            $result = $academics_obj->updateAttendance($data, $where);
            if ($result == false) {
                header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=up_false");
            }
        }
        if ($result == true) {
            header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=up_true");
        }
    } else {
        header("Location: index.php");
    }
} else if (isset($_POST["update_attendance"])) {
    require_once("../academics.php");
    extract($_POST);
    $students = $academics_obj->showAllStudents("active", $class_id, $section_id);

    foreach ($students as $std) {
        $status = $attendance[$std["id"]];
        $data = ["status" => $status];
        $where = "student_id = " . $std["id"] . " AND date = '$date'";
        $result = $academics_obj->updateAttendance($data, $where);
        if ($result == true) {
            header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=up_true");
        } else {
            header("Location: ../../index.php?page=academics/attendence/daily_attendence&msg=up_false");
        }
    }
}

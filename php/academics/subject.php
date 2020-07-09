<?php

if (isset($_POST["timetable"])) {

    session_start();
    require('../academics.php');
    extract($_POST);

    $session_id = $_SESSION["session_id"];
    $campus_id = $_SESSION["campus_id"];

    if ($s_format == "pm") {
        $s_hour += 12;
    } else if ($e_format == "pm") {
        $e_hour += 12;
    }

    $result = $academics_obj->checkRoutine($s_hour, $s_minute, $day);
    $result = false;
    if ($result == false) {
        $start_time = date("G:i:s", mktime($s_hour, $s_minute, 0, 0, 0, 0));
        $end_time = date("G:i:s", mktime($e_hour, $e_minute, 0, 0, 0, 0));
        $data = [null, $campus_id, $session_id, $class_id, $section_id, $subject_id, $day, $start_time, $end_time, null, null, null];
        $table = "class_routine";
        $result = $academics_obj->addRecord($table, $data);
    } else {
        header("Location: ../../index.php?page=academics/time_table/add_routine&msg=t_err");
    }

    if ($result == true) {
        header("Location: ../../index.php?page=academics/time_table/timetable&msg=true");
    } else {
        header("Location: ../../index.php?page=academics/time_table/timetable&msg=false");
    }
} else if (isset($_POST["update_routine"])) {

    session_start();
    require('../academics.php');
    extract($_POST);

    $session_id = $_SESSION["session_id"];
    $campus_id = $_SESSION["campus_id"];

    if ($s_format == "pm") {
        $s_hour += 12;
    } else if ($e_format == "pm") {
        $e_hour += 12;
    }

    $result = $academics_obj->checkRoutine($s_hour, $s_minute, $day);
    if ($result == false) {
        $start_time = date("G:i:s", mktime($s_hour, $s_minute, 0, 0, 0, 0));
        $end_time = date("G:i:s", mktime($e_hour, $e_minute, 0, 0, 0, 0));
        $data = ["class_id" => $class_id, "section_id" => $section_id, "subject_id" => $subject_id, "day" => $day, "start_time" => $start_time, "end_time" =>  $end_time];
        $table = "class_routine";
        $result = $academics_obj->updateRecord($table, $data, $routine_id);
    } else {
        header("Location: ../../index.php?page=academics/time_table/edit_routine&tId=$routine_id&msg=t_err");
    }

    if ($result == true) {
        header("Location: ../../index.php?page=academics/time_table/timetable&tId=$routine_id&msg=up_true");
    } else {
        header("Location: ../../index.php?page=academics/time_table/timetable&tId=$routine_id&msg=up_false");
    }
} else  if (isset($_POST["add_subject"])) {
    require('../academics.php');
    session_start();
    extract($_POST);
    $data = [null, $_SESSION["campus_id"], $class_id, $section, $teacher, $code, $name, null, null, null];
    $result = $academics_obj->addSubjects($data);

    if ($result === true) {
        header("Location: ../../index.php?page=academics/subjects/subjects&msg=true");
    } else {
        header("Location: ../../index.php?page=academics/subjects/subjects&msg=false");
    }
} else if (isset($_POST["update_subject"])) {
    require('../academics.php');
    session_start();
    extract($_POST);

    $data = ["class_id" => $class_id, "section_id" => $section, "teacher_id" => $teacher, "code" => $code, "name" => $name];
    $result = $academics_obj->updateSubjects($data, $sub_id);
    if ($result === true) {
        header("Location: ../../index.php?page=academics/subjects/subjects&msg=up_true");
    } else {
        header("Location: ../../index.php?page=academics/subjects/subjects&msg=up_false");
    }
}

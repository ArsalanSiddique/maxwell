<?php
session_start();
require_once("../academics.php");
if (isset($_POST["add_exam"])) {
    extract($_POST);
    $campus_id = $_SESSION["campus_id"];
    $data = [null, $campus_id, $name, $date, $maxMarks, $comments, null, null, null];
    $check = $academics_obj->checkExamName($data[2]);
    if ($check == true) {
        $result = $academics_obj->addExam($data);
        if ($result == true) {
            header("Location: ../../index.php?page=academics/exam/exam_list&msg=true");
        } else {
            header("Location: ../../index.php?page=academics/exam/exam_list&msg=false");
        }
    } else {
        header("Location: ../../index.php?page=academics/exam/exam_list&msg=name_err");
    }
} else if (isset($_POST["edit_exam"])) {
    extract($_POST);
    $campus_id = $_SESSION["campus_id"];
    $data = ["name" => $name, "date" =>  $date, "marks" => $maxMarks, "comments" => $comments];
    $check = $academics_obj->checkExam($name, $exam_id);
    if ($check == true) {
        $result = $academics_obj->updateRecord("exams", $data, $exam_id);
        if ($result == true) {
            header("Location: ../../index.php?page=academics/exam/exam_list&msg=up_true");
        } else {
            header("Location: ../../index.php?page=academics/exam/exam_list&msg=up_false");
        }
    } else {
        header("Location: ../../index.php?page=academics/exam/exam_list&msg=name_err");
    }
} else if (isset($_POST["addGrade"])) {
    extract($_POST);
    $data = [null, $name, $point, $from, $upto, $comment, null, null, null];
    $check = $academics_obj->checkGrade($data[1]);
    $check2 = $academics_obj->checkPoint($data[2]);
    if ($check == true) {
        if ($check2 == true) {
            $result = $academics_obj->addGrade($data);
            if ($result == true) {
                header("Location: ../../index.php?page=academics/exam/exam_grades&msg=true");
            } else {
                header("Location: ../../index.php?page=academics/exam/exam_grades&msg=false");
            }
        } else {
            header("Location: ../../index.php?page=academics/exam/exam_grades&msg=gp_err");
        }
    } else {
        header("Location: ../../index.php?page=academics/exam/exam_grades&msg=name_err");
    }
} else if ($_POST["edit_Grade"]) {
    extract($_POST);
    $data = ["name" => $name, "point" => $point, "marks_from" => $from, "marks_upto" => $upto, "remarks" => $comment];
    $check = $academics_obj->checkGrade($data[1]);
    $check2 = $academics_obj->checkPoint($data[2]);
    if ($check == true) {
        if ($check2 == true) {
            $result = $academics_obj->updateRecord("exam_grades", $data, $grade_id);
            if ($result == true) {
                header("Location: ../../index.php?page=academics/exam/exam_grades&msg=up_true");
            } else {
                header("Location: ../../index.php?page=academics/exam/exam_grades&msg=up_false");
            }
        } else {
            header("Location: ../../index.php?page=academics/exam/exam_grades&msg=gp_err");
        }
    } else {
        header("Location: ../../index.php?page=academics/exam/exam_grades&msg=name_err");
    }
} else if (isset($_POST["manage_marks"])) {
    extract($_POST);
    session_start();
    $campus_id = $_SESSION["campus_id"];
    $count = $academics_obj->totalNumberOfStudents($class_id, $section_id);
    for ($i = 0; $i < $count; $i++) {
        $student_marks = $marks[$i];
        $std_id = $student_id[$i];
        $data = [null, $campus_id, $class_id, $section_id, $subject_id, $std_id, $exam_id, $student_marks, $max_marks, null, null, null];
        $result = $academics_obj->addRecord("marks", $data);
    }
    if ($result == true) {
        header("Location: ../../index.php?page=academics/exam/manage_marks&msg=true");
    } else {
        header("Location: ../../index.php?page=academics/exam/manage_marks&msg=false");
    }
} else if (isset($_POST["update_marks"])) {
    extract($_POST);
    session_start();
    $campus_id = $_SESSION["campus_id"];
    $count = $academics_obj->totalNumberOfStudents($class_id, $section_id);

    for ($i = 0; $i < $count; $i++) {        
        $student_marks = $marks[$i];
        $std_id = $student_id[$i];
        $data = ["marks" => $student_marks, "max_marks" => $max_marks];
        $result = $academics_obj->updateMarks($data, $std_id, $exam_id, $subject_id);
    }
    if ($result == true) {
        header("Location: ../../index.php?page=academics/exam/manage_marks&eId=$exam_id&cId=$class_id&secId=$section_id&sId=$subject_id&msg=up_true");
    } else {
        header("Location: ../../index.php?page=academics/exam/manage_marks&eId=$exam_id&cId=$class_id&secId=$section_id&sId=$subject_id&msg=up_false");
    }
} else if (isset($_POST["promote"])) {
    extract($_POST);
    $students = $academics_obj->fetchAllRecord("students");
    foreach ($students as $std) {
        $id = $std['id'];
        $pro_id = $promotion["$id"];
        if (isset($_POST["$pro_id"])) {
            
            $data = ["class_id" => $promotion["$id"]];
            $result = $academics_obj->updateRecord("students", $data, $id);
            if ($result == false) {
                header("Location: ../../index.php?page=academics/students/student_promotion&msg=false");
            }
        }
    }
    if ($result == true) {
        header("Location: ../../index.php?page=academics/students/student_promotion&msg=true");
    }
} else {
    header("Location: index.php");
}

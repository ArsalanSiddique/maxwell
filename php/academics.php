<?php

// academics.php
// Description:
//     in this class all methods are related to academics dropdown/section.

require_once('crud.php');
class academics extends crud
{

    function addStudents($data)
    {
        $table = 'students';
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function addSubjects($data)
    {
        $table = "subjects";
        $result = $this->insert($table, $data, null);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function addClass($name, $n_name, $teacher)
    {
        $table = 'class';

        if ($teacher == NULL)
            $teacher = " ";
        $campus_id = $_SESSION["campus_id"];
        $data = [NULL, $campus_id, $name, $n_name, $teacher];
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function addExam($data)
    {
        $table = "exams";
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function addRecord($table, $data)
    {
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function addGrade($data)
    {
        $table = "exam_grades";
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function checkGrade($grade)
    {
        $table = "exam_grades";
        $where = "name = '$grade' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function checkPoint($gp)
    {
        $table = "exam_grades";
        $where = "point = '$gp' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function checkExam($exam, $exam_id)
    {
        $table = "exams";
        $where = "name = '$exam' AND id <> $exam_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function checkExamName($exam)
    {
        $table = "exams";
        $where = "name = '$exam' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function fetchAllExams()
    {
        $table = "exams";
        $where = "deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return true;
        }
    }

    function addSection($name, $nick_name, $campusId, $class)
    {
        $table = 'section';
        if ($nick_name == null)
            $nick_name = " ";

        $data = [NULL, $class, $campusId, $name, $nick_name];
        $result = $this->insert($table, $data, NULL);
        return $result;
    }

    function addParents($data)
    {
        $table = "parents";
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function getParent($parent_id)
    {
        $table = "parents";
        $where = " id = '$parent_id' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function getStudent($student_id)
    {
        $table = "students";
        $where = " id = '$student_id' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function getAllTeachers($campus_id)
    {
        $table = "teachers";
        $where = "campus_id = $campus_id AND deleted_at IS NULL";
        $order = "id DESC";
        $result = $this->select($table, $where, null, $order, null, null);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function getAllSyllabus($class_id, $session_id)
    {
        $table = "syllabus";
        $where = "session_id = $session_id AND class_id = $class_id AND deleted_at IS NULL";
        $order = "id DESC";
        $result = $this->select($table, $where, null, $order, null, null);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function getClasRoutine($class_id, $section_id, $day)
    {
        session_start();
        $campus_id = $_SESSION["campus_id"];
        $session_id = $_SESSION["session_id"];
        $table = "class_routine";
        $where = "campus_id = $campus_id AND session_id = $session_id AND class_id = $class_id AND section_id = $section_id AND day = '$day' AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function getSection($class_id)
    {
        session_start();
        $table = "section";
        $campus_id = $_SESSION["campus_id"];
        $where = " `class_id` = $class_id AND `campus_id` = $campus_id";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }



    function getClass($campus_id)
    {
        session_start();
        $table = "class";
        $where = "`campus_id` = $campus_id";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function getClassById($class_id)
    {
        $table = "class";
        $where = "`id` = $class_id";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["name"];
        } else {
            return false;
        }
    }

    function getColName($table, $column, $id)
    {
        $where = "`id` = $id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["$column"];
        } else {
            return false;
        }
    }

    function getAttendanceStatus($class, $section, $student_id, $date)
    {
        session_start();
        $campus_id = $_SESSION["campus_id"];
        $table = "attendance";
        $where = "`campus_id` = $campus_id AND `date` = '$date' AND `student_id` = $student_id AND `section_id` = $section AND `class_id` = $class AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["status"];
        } else {
            return false;
        }
    }

    function fetchRoutine($class, $section, $day, $start_time)
    {
        $table = "class_routine";
        $where = "class_id =$class AND section_id = $section AND day = '$day' AND start_time = '$start_time' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function getRecordById($table, $id)
    {
        $where = "`id` = $id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function updateRecord($table, $data, $id)
    {
        $where = "`id` = $id AND deleted_At IS NULL";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function updateMarks($data, $std_id, $exam_id, $subject_id)
    {
        $table = "marks";
        $where = "`student_id` = $std_id AND `exam_id` = $exam_id AND `subject_id` = $subject_id AND deleted_At IS NULL";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function getExamById($id)
    {
        $table = "exams";
        $where = "`id` = $id";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function getSectionById($id)
    {
        $table = "section";
        $where = "`id` = $id";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["name"];
        } else {
            return false;
        }
    }

    function getTeacherById($id)
    {
        $table = "teachers";
        $where = "`id` = $id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["name"];
        } else {
            return false;
        }
    }

    function getSubjectById($id)
    {
        $table = "subjects";
        $where = "`id` = $id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function getSubjectName($id)
    {
        $table = "subjects";
        $where = "`id` = $id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["name"];
        } else {
            return false;
        }
    }

    function editParent($data, $parent_id)
    {
        $table = "parents";
        $where = " id = '$parent_id'";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function updateSubjects($data, $subject_id)
    {
        $table = "subjects";
        $where = " id = '$subject_id' AND deleted_at IS NULL";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }


    function editStudent($data, $student_id)
    {
        $table = "students";
        $where = " id = '$student_id'";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function deleteParent($parent_id)
    {
        $table = "parents";
        $where = " id = '$parent_id'";
        $cols = "deleted_at = now()";
        $result = $this->update_time($table, $cols, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function deleteRecord($table, $id)
    {
        $where = " id = '$id'";
        $cols = "deleted_at = now()";
        $result = $this->update_time($table, $cols, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function deleteSubject($subject_id)
    {
        $table = "subjects";
        $where = " id = '$subject_id' AND deleted_at IS NULL";
        $cols = "deleted_at = now()";
        $result = $this->update_time($table, $cols, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function deleteStudent($student_id)
    {
        $table = "students";
        $where = " id = '$student_id' AND deleted_at IS NULL";
        $cols = "deleted_at = now()";
        $result = $this->update_time($table, $cols, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function showAllClass()
    {
        $table = 'class';
        $campus_id = $_SESSION["campus_id"];
        $where = "campus_id = '$campus_id' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showAllSection()
    {
        $table = 'section';
        $campus_id = $_SESSION["campus_id"];
        $where = "campus_id = $campus_id";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showAllCampus()
    {
        $table = 'campus';
        $order = "id desc";
        $result = $this->select($table, NULL, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function fetchAllRecord($table)
    {
        $where = "deleted_at IS NULL";
        $order = "id DESC";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showNotice()
    {
        $table = "notices";
        $date = date("Y-m-d");
        $where = "date > '$date' AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function archiveNotices()
    {
        $table = "notices";
        $date = date("Y-m-d");
        $where = "date < '$date' AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showAllGrades()
    {
        $table = 'exam_grades';
        $where = " deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }



    function showAllParents()
    {
        $table = 'parents';
        $campus_id = $_SESSION["campus_id"];
        $where = "campus_id = $campus_id AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function fetchAttendanceTable($status, $class_id, $section_id, $date)
    {
        session_start();
        $campus_id = $_SESSION["campus_id"];
        $table1 = "students";
        $table2 = "attendance";
        $behave1 = "id";
        $behave2 = "student_id";
        $where = "students.campus_id = $campus_id AND students.class_id = $class_id ";
        if ($section_id == null) {
            $where .= " AND students.section_id IS NULL ";
        } else {
            $where .= " AND students.section_id = $section_id ";
        }
        $where .= " AND students.status = '$status' AND attendance.date = '$date' AND students.deleted_at IS NULL";
        $column = ["students.photo", "students.id", "students.class_id", "students.section_id", "students.reg_no", "students.name", "attendance.status", "attendance.date"];
        $result = $this->leftJoin($table1, $table2, $column, $behave1, $behave2, $where);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            $result = $this->showAllStudents($status, $class_id, $section_id);
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return false;
            }
        }
    }

    function fetchPerformance($student_id, $exam_id)
    {
        $table1 = "students";
        $table2 = "marks";
        $behave1 = "id";
        $behave2 = "student_id";
        $where = "students.id = $student_id AND marks.exam_id = $exam_id AND students.deleted_at IS NULL AND marks.deleted_at IS NULL";
        $result = $this->leftJoin($table1, $table2, null, $behave1, $behave2, $where);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showAllStudents($status, $class, $section_id)
    {
        session_start();
        $table = 'students';
        $campus_id = $_SESSION["campus_id"];
        $where = "`campus_id` = $campus_id AND `class_id` = $class AND status = '$status'";
        if ($section_id === null) {
            $where .= " AND section_id IS NULL ";
        } else {
            $where .= " AND section_id = $section_id ";
        }
        $where .= " AND deleted_at IS NULL";
        $order = "id DESC";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showStudentByClass($status, $class)
    {
        session_start();
        $table = 'students';
        $campus_id = $_SESSION["campus_id"];
        $where = "`campus_id` = $campus_id AND `class_id` = $class AND status = '$status'";
        $where .= " AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function testMarks($class_id, $section_id, $subject_id, $exam_id)
    {
        $table = 'marks';
        session_start();
        $campus_id = $_SESSION["campus_id"];
        $where = "`campus_id` = $campus_id AND `class_id` = $class_id AND `exam_id` = $exam_id";
        if ($section_id == null) {
            $where .= "";
        } else {
            $where .= " AND section_id = $section_id ";
        }

        $where .= " AND `subject_id` = $subject_id AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function manageMarks($class, $section, $subjects, $exams)
    {
        $test = $this->testMarks($class, $section, $subjects, $exams);
        session_start();
        $campus_id = $_SESSION["campus_id"];
        if ($test == true) {
            $table1 = "class";
            $table2 = "students";
            $behave1 = "id";
            $behave2 = "class_id";
            $column = ["reg_no", "students.section_id", "students.name", "students.father_name", "students.id as student_id", "class.name AS class"];

            $where = "students.campus_id = $campus_id AND students.class_id = $class ";
            if ($section == null) {
                $where .= "";
            } else {
                $where .= " AND students.section_id = $section ";
            }
            $where .= " AND class.deleted_at IS NULL AND students.deleted_at IS NULL";
            $result = $this->leftJoin($table1, $table2, $column, $behave1, $behave2, $where);
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return false;
            }
        } else {
            $table1 = "marks";
            $table2 = "students";
            $behave1 = "student_id";
            $behave2 = "id";
            $column = ["reg_no", "students.section_id", "students.name", "students.father_name", "students.id as student_id", "marks", "marks.max_marks"];
            $where = "students.campus_id = $campus_id AND students.class_id = $class ";
            if ($section == null) {
                $where .= "";
            } else {
                $where .= " AND students.section_id = $section ";
            }
            $where .= " AND marks.subject_id = $subjects AND marks.exam_id = $exams AND  students.deleted_at IS NULL AND marks.deleted_at IS NULL";
            $result = $this->leftJoin($table1, $table2, $column, $behave1, $behave2, $where);
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return false;
            }
        }
    }

    function totalNumberOfStudents($class, $section)
    {
        session_start();
        $table = 'students';
        $campus_id = $_SESSION["campus_id"];
        if (empty($section)) {
            $where = "`campus_id` = $campus_id AND `class_id` = $class AND deleted_at IS NULL";
        } else {
            $where = "`campus_id` = $campus_id AND `class_id` = $class AND `section_id` = $section AND deleted_at IS NULL";
        }
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_num_rows($result);
        } else {
            return 0;
        }
    }

    function showALlSubject($class)
    {
        $table = "subjects";
        $where = "class_id = $class AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showSubjectBySection($class, $section)
    {
        $table = "subjects";
        $where = "class_id = $class AND section_id = $section AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showSectionByClass($class)
    {
        $table = "section";
        $where = "class_id = $class AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }


    function showSubjectByClass($class)
    {
        $table = "subjects";
        $where = "class_id = $class AND section_id IS NULL AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showSection($section_id)
    {
        $table = 'section';
        $where = " class_id = $section_id AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        return $result;
    }

    function updateSection($name, $nick_name, $class, $section_id)
    {
        $table = 'section';
        $campusId = " ";
        if ($nick_name == null)
            $nick_name = " ";

        $data = array("name" => $name, "nick_name" => $nick_name, "class_id" => $class);
        $where = 'id = ' . $section_id;
        $result = $this->update($table, $data, $where);
        return $result;
    }

    function updateAttendance($data, $where)
    {
        $table = "attendance";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function checkEmail($table, $email)
    {
        $where = " email = $email AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function checkCnic($table, $cnic)
    {
        $where = " cnic = '$cnic' AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function checkRegist($table, $regist)
    {
        $where = " reg_no = $regist AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }


    function fetchExamMarks($exam_id, $class_id, $section_id, $subject_id, $student_id)
    {
        session_start();
        $campus_id = $_SESSION["campus_id"];
        $table = "marks";
        $where = "campus_id = $campus_id AND exam_id = $exam_id AND class_id = $class_id AND student_id = $student_id AND subject_id = $subject_id";
        if ($section_id === null) {
            $where .= " ";
        } else {
            $where .= " AND section_id = $section_id ";
        }
        $where .= " AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["marks"];
        } else {
            return "0";
        }
    }

    function fetchExamMaxMarks($exam_id, $class_id, $section_id, $subject_id, $student_id)
    {
        session_start();
        $campus_id = $_SESSION["campus_id"];
        $table = "marks";
        $where = "campus_id = $campus_id AND exam_id = $exam_id AND class_id = $class_id AND student_id = $student_id AND subject_id = $subject_id";
        if ($section_id === null) {
            $where .= "";
        } else {
            $where .= " AND section_id = $section_id ";
        }
        $where .= " AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["max_marks"];
        } else {
            return 0;
        }
    }


    function gradeCalc($percentage)
    {
        $table = "exam_grades";
        $where = "marks_upto >= $percentage AND marks_from <= $percentage AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $data =  [$row["name"], $row["remarks"]];
            return $data;
        } else {
            $data =  ["NILL", "NILL"];
            return $data;
        }
    }

    function checkRoutine($s_hour, $s_minute, $day)
    {
        $table = "class_routine";
        $where = "start_hour = $s_hour AND start_minute = $s_minute AND day = '$day' AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function fetchAttendanceGraph($date)
    {
        $table = "attendance";
        $where = " date = '$date' AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        $total_attendance = 0;
        $total_absent = 0;
        $mydata = [];
        if (mysqli_num_rows($result) > 0) {
            foreach ($result as $data) {
                if ($data["status"] == "present") {
                    $total_attendance++;
                } else {
                    $total_absent++;
                }
            }
            $where2 = "deleted_at IS NULL";
            $result2 = $this->select("students", $where2, null, null, null, null);
            $total_student = mysqli_num_rows($result2);
            
            $total_absent = $total_student - $total_attendance;
            $mydata = [$total_attendance, $total_absent];

            return $mydata;
        } else {
            return false;
        }
    }
}
$academics_obj = new academics();

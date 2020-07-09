<?php
require_once('crud.php');

class hr extends crud
{

    function addTeacher($data)
    {
        $table = "teachers";
        $result = $this->insert($table, $data, null);
        if ($result == true) {
            return true;
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

    function getTeacher($campus_id, $teacher_id)
    {
        $table = "teachers";
        $where = "campus_id = $campus_id AND id = $teacher_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function updateTeacher($data, $id) {
        $table = "teachers";
        $where = "id = $id AND deleted_at IS NULL";
        $result = $this->update($table, $data, $where);
        if($result == true) {
            return true;
        }else {
            return false;
        }
    }
}
$hrObj = new hr();

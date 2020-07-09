<?php

require_once('crud.php');
class administrator extends crud
{

    function addRecord($table, $data)
    {
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
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

    function fetchAllRecord($table)
    {
        $where = "deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function getAdmin($user_id) {
        $table1 = "users";
        $table2 = "campus";
        $behave1 = "campus";
        $behave2 = "id";
        $column = ["users.id as user_id", "users.user_name", "users.email", "users.phone", "campus.name", "campus.id as campus_id"];
        $where = "users.id = $user_id AND users.deleted_at IS NULL AND campus.deleted_at IS NULL";
        $result = $this->leftJoin($table1, $table2, $column, $behave1, $behave2, $where);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        }else {
            return false;
        }
    }
    
    function activateSession($session_id) {

        $table = "session";
        $where = "status = 'active'";
        $data = ["status" => "not active"];
        $result = $this->update($table, $data, $where);
        if($result == true) {
            $data = ["status" => "active"];
            $result = $this->updateRecord($table, $data, $session_id);
            if($result == true) {
                return true;
            }else {
                return false;
            }
        }else {
            return false;
        }

    }

    function encrypt_pass($pass, $salt) {
		$salt = $salt;
		$new_pass = md5($pass);
		$new_pass = sha1($new_pass);
		$new_pass = str_rot13($new_pass);
		$new_pass .= 7;
		$new_pass .= $salt;
			
		return $new_pass;
	}
}
$admin_obj = new administrator();

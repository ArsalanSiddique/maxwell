<?php

require_once('crud.php');

class user extends crud {
    public function select_user($user_type, $id) {
        $table = "users";
		$where = "user_type = '".$user_type."' AND id = ".$id;
		$result = $this->select($table, $where, NULL, NULL, NULL, NULL);
		return $result;
    }

    public function update_user($user_type, $id) {
        $table = "users";
		$where = "user_type = '".$user_type."' AND id = ".$id;
		$result = $this->select($table, $where, NULL, NULL, NULL, NULL);
		return $result;
    }

}


$user_obj = new user();



?>
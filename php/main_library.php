<?php
	/**
	 * description: In this file all code are realted to admin setting page.
	 */
	
	include_once('crud.php');
	class main_lib extends crud
	{
		
		public function add_session($data) {
			$table = "session";
			$result = $this->insert($table, $data);
			if($result == true) {
				return true;
			}else {
				return false;
			}
		}

		public function add_campus($data) {
			$table = "campus";
			if($this->insert($table, $data)) {
				$url="../../index.php?page=administrator/general_setting&msg=added_campus";
				header("Location:".$url);
			}else {
				echo 'found error in insertion of campus.';
			}	
		}

		public function add_admin($data) {
			$table = "users";
			if($this->insert($table, $data)) {
				$url="../../index.php?page=administrator/general_setting&msg=added_admin";
				header("Location:".$url);
			}else {
				echo 'found error in insertion of admin.';
			}	
		}


		public function select_users($type) {
			$table = "users";
			$where = "user_type = '".$type."'";
			$result = $this->select($table, $where, NULL, NULL, NULL, NULL);
			return $result;
		}

		public function select_session() {
			$table = "session";
			$result = $this->select($table, NULL, NULL, NULL, NULL, NULL);
			return $result;
		}

		//campus related work

		public function select_campus() {
			$table = "campus";
			$result = $this->select($table, NULL, NULL, NULL, NULL, NULL);
			return $result;
		}

		public function camp_name($id) {
			$where = "id = '".$id."'";;
			$table = "campus";
			$result = $this->select($table, $where, NULL, NULL, NULL, NULL);
			return $result;
		}


		// joining two tables (left, right, innner etc)

		public function leftJoin($table1, $table2, $column, $behave1, $behave2, $where) {
			if($column != NULL) {
				$column = implode(', ',$column);			
				$query = 'select '.$column.' from '.$table1.' LEFT JOIN '.$table2.' ON ';	
			}
			else
				$query = 'select * from '.$table1.' LEFT JOIN '.$table2.' ON ';
			$behave1 = $table1.'.'.$behave1; //users.id
			$behave2 = $table2.'.'.$behave2; //users.id
			$query .= $behave1.' = '.$behave2;
			if($where != NULL)
				$query .= ' WHERE '.$where;

	 		$result = $this->DbCon->query($query);
			return $result;
		}

	}

	$main_lib_obj = new main_lib();

?>
<?php
	
	//join.php

	require_once('crud.php');

	class group extends crud {
		
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


	$join_lib_Obj = new group();
?>
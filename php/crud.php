<?php

/*
	 * Description: Create, Read, Update, Delete
	 *
	 * 
	*/

require_once("config.php");
class crud extends config
{

	public function select($table, $where = NULL, $col = NULL, $order = NULL, $groupBy, $colName)
	{

		$query = 'SELECT * FROM ' . $table;
		if ($col != NULL) {
			for ($i = 0; $i < count($col); $i++)
				$col[$i] = '"' . $col[$i] . '"';
			$col = implode(',', $col);
			$query = 'SELECT ' . $col . ' FROM ' . $table;
		}
		if ($where != NULL)
			$query .= ' WHERE ' . $where;
		if ($order != NULL)
			$query .= ' ORDER BY ' . $order;
		if ($groupBy != NULL)
			$query .= ' GROUP BY ' . $colName;

		// echo $query;
		$result = $this->DbCon->query($query);

		$data =  mysqli_num_rows($result);

		if ($data > 0) {
			return $result;
		} else {
			return FALSE;
		}
	}

	public function insert($table, $value, $col = NULL)
	{
		$query = 'INSERT INTO ' . $table;
		if ($col != NULL) {
		} else {

			for ($i = 0; $i < count($value); $i++) {
				if ($value[$i] == NULL) {
					$value[$i] = "NULL";
				} else {
					$value[$i] = '"' . $value[$i] . '"';
				}
			}
			$value = implode(',', $value);
			$query .= ' VALUES (' . $value . ')';

			echo $query;
			$result = $this->DbCon->query($query);
			return $result;
		}
	}

	public function update($table, $rows, $where)
	{

		$update = 'UPDATE ' . $table . ' SET ';
		$keys = array_keys($rows);
		for ($i = 0; $i < count($rows); $i++) {
			if (is_string($rows[$keys[$i]])) {
				$update .= $keys[$i] . '="' . $rows[$keys[$i]] . '"';
			} else {
				$update .= $keys[$i] . '=' . $rows[$keys[$i]];
			}
			// Parse to add commas
			if ($i != count($rows) - 1) {
				$update .= ',';
			}
		}
		$update .= ', `updated_at` = NULL  WHERE ' . $where;

		// echo $update;
		$result = $this->DbCon->query($update);
		return $result;
	}

	public function dElete_row($table, $where)
	{
		$query = 'delete from ' . $table;
		if ($where != NULL) {
			$query .= ' where ' . $where;
		}
		$result = $this->DbCon->query($query);
		return $result;
	}

	public function update_time($table, $cols, $where)
	{
		$updateTime = 'UPDATE ' . $table . ' SET ';
		$updateTime = $updateTime . $cols;
		$updateTime = $updateTime . ' WHERE ' . $where;
		// echo $updateTime;
		$result = $this->DbCon->query($updateTime);
		return $result;
	}

	public function promote_std($table, $cols, $where)
	{
		$updateTime = 'UPDATE ' . $table . ' SET ';
		$updateTime = $updateTime . $cols;
		$updateTime = $updateTime . ' WHERE ' . $where;
		// echo $updateTime;
		$result = $this->DbCon->query($updateTime);
		return $result;
	}

	public function leftJoin($table1, $table2, $column, $behave1, $behave2, $where)
	{
		if ($column != NULL) {
			$column = implode(', ', $column);
			$query = 'select ' . $column . ' from ' . $table1 . ' LEFT JOIN ' . $table2 . ' ON ';
		} else
			$query = 'select * from ' . $table1 . ' LEFT JOIN ' . $table2 . ' ON ';
		$behave1 = $table1 . '.' . $behave1; //users.id
		$behave2 = $table2 . '.' . $behave2; //users.id
		$query .= $behave1 . ' = ' . $behave2;
		if ($where != NULL)
			$query .= ' WHERE ' . $where;

		// echo $query;
		$result = $this->DbCon->query($query);
		return $result;
	}
}
$mainObj = new crud();

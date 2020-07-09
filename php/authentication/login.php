<?php
	session_start();
	include("../crud.php");
	extract($_POST);
	
	if(isset($_POST["login"])) {

		$salt = "97aB";
		$table = "users";
		$new_pass = encrypt_pass($pass, $salt);
		$where1 = "`user_name` = '$email' AND `password` = '$new_pass' AND deleted_at IS NULL";
		$where2 = "`email` = '$email' AND `password` = '$new_pass' AND deleted_at IS NULL";
		$result1 = $mainObj->select($table, $where1, NULL, NULL, NULL, NULL);
		$result2 = $mainObj->select($table, $where2, NULL, NULL, NULL, NULL);
		


		if($result1 == TRUE) {
			$table = "session";
			$where = "status = 'active' AND deleted_at IS NULL";
			$session_result = $mainObj->select($table, $where, NULL, NULL, NULL, NULL);
			$row = mysqli_fetch_array($session_result);
			$_SESSION["session_id"] = $row["id"];
			foreach ($result1 as $rows) {
				$_SESSION["user_email"] = $rows["email"];
				$_SESSION["campus_id"] = $rows["campus"];
				$_SESSION["user_id"] = $rows["id"];
				$_SESSION["user_type"] = $rows["user_type"];
			}
			$url = "../../index.php";
			header("Location:".$url);
			
		}else if($result2 == TRUE) {
			$table = "session";
			$where = "status = 'active' AND deleted_at IS NULL";
			$session_result = $mainObj->select($table, $where, NULL, NULL, NULL, NULL);
			$row = mysqli_fetch_array($session_result);
			$_SESSION["session_id"] = $row["id"];
			foreach ($result2 as $rows2) {
				$_SESSION["user_email"] = $rows2["email"];
				$_SESSION["campus_id"] = $rows2["campus"];
				$_SESSION["user_id"] = $rows2["id"];
				$_SESSION["user_type"] = $rows2["user_type"];
			}
			$url = "../../index.php";
			header("Location:".$url);

		}else {
			$url = "../../pages/authentication/login.php?msg=invalid";
			header("Location:".$url);
		}


	}else {
		// do nothing
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

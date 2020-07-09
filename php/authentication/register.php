<?php

	include("../crud.php");
	extract($_POST);
	
	if(isset($_POST["register"])) {

		if($pass == $repass) {
			
			$table = 'users';

			$check_name = $mainObj->select($table, '`user_name` = "'.$name.'"', NULL, NULL, NULL, NULL);

			if($check_name == TRUE) {
				$url = "../../pages/authentication/registeration.php?msg=uName_exist";
				header("Location:".$url);
				
			}else if($mainObj->select($table, '`email` = "'.$email.'"', NULL, NULL, NULL, NULL)){
				$url = "../../pages/authentication/registeration.php?msg=mail_exist";
				header("Location:".$url);				
			}else {
					$salt = '97aB';
					$new_pass = encrypt_pass($pass, $salt);

					$data = array('', $name, $email, $new_pass, 'admin', '');

					if($mainObj->insert($table, $data)) {
						$url="../../pages/authentication/login.php?msg=success";
						header("Location:".$url);
					}else {
						echo 'found error in creation of user';
					}

				}

		}else {
			header("Location:../../pages/authentication/registeration.php?msg=incorrect_pwd");
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

?>

<?php

include_once('../main_library.php');
include_once('../administrator.php');
if (isset($_POST["campus_add"])) {

	extract($_POST);
	$data = ['', $name, $address, $phone, $admin];
	$main_lib_obj->add_campus($data);
} else if (isset($_POST["admin_add"])) {

	extract($_POST);

	if ($password == $confirm_password) {
		$user_type = "admin";
		$data = ['', $name, $email, $password, $user_type, $campus, NULL];
		$main_lib_obj->add_admin($data);
	} else {
		echo 'password not matched';
	}
} else if (isset($_POST["session_add"])) {
	extract($_POST);
	if ($start_month != $end_month) {
		$data = ['', $start_month, $end_month, "not active", null, null, null];
		$result = $main_lib_obj->add_session($data);

		if ($result == true) {
			header("Location: ../../index.php?page=administrator/general_setting&msg=true");
		} else {
			header("Location: ../../index.php?page=administrator/general_setting&msg=false");
		}
	}
} else if (isset($_POST["camp_update"])) {
	extract($_POST);
	$data = ["name" => $name, "address" => $address, "phone" => $phone];
	$result = $admin_obj->updateRecord("campus", $data, $camp_id);
	if ($result == true) {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_true");
	} else {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_false");
	}
} else if (isset($_POST["session_update"])) {
	extract($_POST);
	$data = ["session_start" => $session_start, "session_end" => $session_end];
	$result = $admin_obj->updateRecord("session", $data, $session_id);
	if ($result == true) {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_true");
	} else {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_false");
	}
} else if (isset($_POST["admin_update"])) {
	extract($_POST);
	$data = ["user_name" => $name, "email" => $email, "phone" => $phone, "campus" => $campus];
	$result = $admin_obj->updateRecord("users", $data, $admin_id);
	if ($result == true) {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_true");
	} else {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_false");
	}
} else if (isset($_POST["school_details"])) {
	extract($_POST);
	$data = ["name" => $name, "email" => $email, "phone" => $phone, "address" => $address];
	$result = $admin_obj->updateRecord("school_info", $data, "1");
	if ($result == true) {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_true");
	} else {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_false");
	}
} else if (isset($_POST["logo"])) {
	$file_name = $_FILES['file']['name'];
	$file_tem_loc = $_FILES['file']['tmp_name'];
	$filetype = $_FILES['file']['type'];
	$filesize = $_FILES['file']['size'];
	$target_path = '/home/buraqtech/school.buraqtech.net/images/' . basename($_FILES["file"]["name"]);
	$file_store = "images/" . $file_name;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
		$file = $file_store;
	} else {
		$file = "";
	}
	$data = ["logo" => $file];
	$result = $admin_obj->updateRecord("school_info", $data, "1");
	if ($result == true) {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_true");
	} else {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_false");
	}
} else if (isset($_POST["signature"])) {
	$file_name = $_FILES['file']['name'];
	$file_tem_loc = $_FILES['file']['tmp_name'];
	$filetype = $_FILES['file']['type'];
	$filesize = $_FILES['file']['size'];
	$target_path = '/home/buraqtech/school.buraqtech.net/images/' . basename($_FILES["file"]["name"]);
	$file_store = "images/" . $file_name;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
		$file = $file_store;
	} else {
		$file = "";
	}
	$data = ["principle_signature" => $file];
	$result = $admin_obj->updateRecord("school_info", $data, "1");
	if ($result == true) {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_true");
	} else {
		header("Location: ../../index.php?page=administrator/general_setting&msg=up_false");
	}
}else {
	header("Location: index.php");
}

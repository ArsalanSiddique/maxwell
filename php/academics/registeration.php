<?php

session_start();

if (isset($_POST["reg_parents"])) {
    require_once("../academics.php");
    extract($_POST);

    $email2 = $academics_obj->checkEmail("parents", $email);
    $cnic2 = $academics_obj->checkCnic("parents", $cnic);

    if ($email2 == false) {
        if ($cnic2 == false) {
            $file_name = $_FILES['file']['name'];
            $file_tem_loc = $_FILES['file']['tmp_name'];
            $filetype = $_FILES['file']['type'];
            $filesize = $_FILES['file']['size'];
            $target_path = '/home/buraqtech/school.buraqtech.net/images/parents/' . basename($_FILES["file"]["name"]);
            $file_store = "images/parents/" . $file_name;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                $file = $file_store;
            } else {
                $file = "images/parents/dummy.png";
            }
            $data = [null, $_SESSION["campus_id"], $name, $email, $phone, $cnic, $gender, $dob, $religion, $address, $city, $country, $file, null, null, null];

            $result = $academics_obj->addParents($data);
            if ($result == true) {
                header("Location: ../../index.php?page=academics/registeration/parents_info&msg=true");
            } else {
                header("Location: ../../index.php?page=academics/registeration/parents&msg=false");
            }
        } else {
            header("Location: ../../index.php?page=academics/registeration/parents&msg=cnic_err");
        }
    } else {
        header("Location: ../../index.php?page=academics/registeration/parents&msg=mail_err");
    }
} else if ($_POST["edit_parent"]) {
    require_once("../academics.php");
    extract($_POST);
    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];
    $target_path = '/home/buraqtech/school.buraqtech.net/images/parents/' . basename($_FILES["file"]["name"]);
    $file_store = "images/parents/" . $file_name;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $file = $file_store;
    } else {
        $file = "images/parents/dummy.png";
    }
    $data = ["name" => $name, "email" => $email, "phone" => $phone, "cnic" => $cnic, "gender" => $gender,  "religion" => $religion, "address" => $address, "city" => $city, "country" => $country, "photo" => $file];

    $result = $academics_obj->editParent($data, $parent_id);

    if ($result == true) {
        header("Location: ../../index.php?page=academics/registeration/parents_info&pId=$parent_id&msg=up_true");
    } else {
        header("Location: ../../index.php?page=academics/registeration/edit_parents&pId=$parent_id&msg=up_false");
    }
} else if ($_REQUEST["status"]) {
    if ($_REQUEST["status"] == "delete") {
        require_once("../academics.php");
        $id = $_REQUEST["pId"];
        $result = $academics_obj->deleteRecord("parents", $id);
        if ($result == true) {
            header("Location: ../../index.php?page=academics/registeration/parents_info&pId=$id&msg=true");
        } else {
            header("Location: ../../index.php?page=academics/registeration/parents_info&pId=$parent_id&msg=false");
        }
    }
}

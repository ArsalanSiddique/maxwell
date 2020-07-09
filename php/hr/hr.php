<?php
if (isset($_POST["add_teacher"])) {
    session_start();
    require_once('../hr.php');
    require_once('../crud.php');

    extract($_POST);
    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];
    $target_path = '/var/www/html/school_m_s/images/parents/' . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $file = $file_store;
    } else if (isset($_POST["image"])) {
        $img = $_POST['image'];
        $folderPath = "/home/buraqtech/school.buraqtech.net/images/students/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $fileName;
        $file = $folderPath . $fileName;
        if (file_put_contents($file, $image_base64)) {
            $file = "images/students/". $fileName;
        }else {
            $file = "images/students/dummy.png";    
        }
        
    } else {
        $file = "images/profile/dummy.png";
    }

    $data = [null, $_SESSION["campus_id"], $name, $cnic, $f_name, $dob, $gender, $address, $phone, $email, $password, $file, null, null, null];
    $result = $hrObj->addTeacher($data);
    if ($result == true) {
        header("Location: ../../index.php?page=hr/teacher&msg=true");
    } else {
        header("Location: ../../index.php?page=hr/add_teacher&msg=false");
    }
} else {
    session_start();
    require_once('../hr.php');

    extract($_POST);
    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];
    $target_path = '/var/www/html/school_m_s/images/parents/' . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $file = $file_store;
    } else {
        $file = "images/profile/dummy.png";
    }

    $data = ["name" => $name, "cnic" =>  $cnic, "father_name" =>  $f_name, "dob" =>  $dob, "gender" =>  $gender, "address" =>  $address, "phone" =>  $phone, "email" =>  $email, "photo" =>  $file];
    $result = $hrObj->updateTeacher($data, $teacher_id);
    if ($result == true) {
        header("Location: ../../index.php?page=hr/teacher&tid=$teacher_id&msg=up_true");
    } else {
        header("Location: ../../index.php?page=hr/add_teacher&tid=$teacher_id&msg=up_false");
    }
}

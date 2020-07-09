<?php
require('../academics.php');
if (isset($_POST["submit_std"])) {
    session_start();
    extract($_POST);

        $file_name= $_FILES['file']['name'];
        $file_tem_loc =$_FILES['file']['tmp_name'];
        $filetype= $_FILES['file']['type'];
        $filesize= $_FILES['file']['size'];
        $target_path = '/home/buraqtech/school.buraqtech.net/images/students/'. basename( $_FILES["file"]["name"]);
        $file_store = "images/students/" . $file_name;
        
        
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
        $file = "images/students/dummy.png";
    }

    $data = [null, $_SESSION["campus_id"], $class, $section, $regist_no, $status, $name, $email, $father, $birth, $religion, $phone, $gender, $file, $address, $city, $country, null, null, null];
    $result = $academics_obj->addStudents($data);
    if ($result == true) {
        header("Location: ../../index.php?page=academics/students/admit_student&msg=true");
    } else {
        header("Location: ../../index.php?page=academics/students/admit_student&msg=false");
    }
} else if (isset($_POST["std_edit"])) {
    session_start();
    extract($_POST);

    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];
    $target_path = '/var/www/html/school_m_s/images/students/' . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $file = $file_store;
    } else {
        $file = "images/students/dummy.png";
    }

    $data = ["campus_id" => $campus, "class_id" => $class, "section_id" => $section, "parent_id" => $parent, "reg_no" => $regist_no, "status" => "active", "name" => $name, "email" => $email, "father_name" => $father, "dob" => $birth, "religion" => $religion, "phone" => $phone, "gender" => $gender, "photo" => $file, "address" => $address, "city" => $city, "country" => $country];
    $result = $academics_obj->editStudent($data, $std_id);
    if ($result == true) {
        header("Location: ../../index.php?page=academics/students/student_information&msg=true");
    } else {
        
        header("Location: ../../index.php?page=academics/students/edit_student&sId=$std_id&msg=false");
    }
}else {
    header("Location: index.php");
}

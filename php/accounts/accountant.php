<?php
if (isset($_POST["add_accountant"])) {
    session_start();
    require_once("../account.php");

    extract($_POST);

    $userName = $account_obj->checkUsername($name);
    if ($userName == false) {
        $userEmail = $account_obj->checkEmail($email);
        if ($userEmail == false) {
            $file_name = $_FILES['file']['name'];
            $file_tem_loc = $_FILES['file']['tmp_name'];
            $filetype = $_FILES['file']['type'];
            $filesize = $_FILES['file']['size'];
            $target_path = '/var/www/html/school_m_s/images/students/' . basename($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                $file = $file_store;
            } else {
                $file = "images/accountant/admin.png";
            }
            $name = strtolower($name);
            $email = strtolower($email);
            $salt = "97aB";
            $current_encypt_pass = $account_obj->c($password, $salt);
            $data = [null, $name, $email, $phone, $password, $file, "accountant", $_SESSION["campus_id"], null, null, null];

            $table = "users";
            $result = $account_obj->addRecord($table, $data);
            if ($result == true) {
                header("Location: ../../index.php?page=accounts/accountant/accountant&msg=true");
            } else {
                header("Location: ../../index.php?page=accounts/accountant/accountant&msg=false");
            }
        } else {
            header("Location: ../../index.php?page=accounts/accountant/accountant&msg=mail_err");
        }
    } else {
        header("Location: ../../index.php?page=accounts/accountant/accountant&msg=name_err");
    }
} else if (isset($_POST["edit_accountant"])) {
    require_once("../account.php");
    extract($_POST);

    $table = "users";

    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];
    $target_path = '/home/buraqtech/school.buraqtech.net/images/accountant/' . basename($_FILES["file"]["name"]);
    $file_store = "images/accountant/" . $file_name;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $file = $file_store;
    } else {
        $file = "images/accountant/dummy.png";
    }
    $photo = $account_obj->checkColName("photo", $file, $user_id);

    if ($photo == true) {
        
        $data = ["phone" => $phone];
        $result = $account_obj->updateRecord($table, $data, $user_id);
        if ($result == true) {
            header("Location: ../../index.php?page=accounts/accountant/accountant&msg=up_true");
        } else {
            header("Location: ../../index.php?page=accounts/accountant/accountant&msg=up_false");
        }        
    } else {

        $data = ["phone" => $phone, "photo" => $file];
        $result = $account_obj->updateRecord($table, $data, $user_id);
        if ($result == true) {
            header("Location: ../../index.php?page=accounts/accountant/accountant&msg=up_true");
        } else {
            header("Location: ../../index.php?page=accounts/accountant/accountant&msg=up_false");
        }
    }
}else if(isset($_POST["change_pwd"])) {
    require_once("../account.php");
    extract($_POST);
    
    $salt = "97aB";
    $table = "users";
    echo $current_encypt_pass = $account_obj->encrypt_pass($current_pwd, $salt);
    
    $where = "id = $id AND password = '$current_encypt_pass'";
    $result2 = $account_obj->select($table, $where, NULL, NULL, NULL, NULL);
    
    foreach($result2 as $rows2) {
        $pwd = $rows2["password"];
    }

    if($current_encypt_pass == $pwd) {
        if($new_pwd == $confirm_pwd) {
            
            $new_pass2 = $account_obj->encrypt_pass($new_pwd, $salt);
            $data = array("password" => $new_pass2);
            $table = "users";
            $where = $id;
            $result = $account_obj->updateRecord($table, $data, $where);
            if($result = true) {
                header("Location:../../index.php?page=accounts/accountant/edit_accountant&aId=$id&msg=up_true");
            }else {
                header("Location:../../index.php?page=accounts/accountant/edit_accountant&aId=$id&msg=up_false");
            }
        }else {
            header("Location:../../index.php?page=accounts/accountant/edit_accountant&aId=$id&msg=pwd_err");
        }
    }else {
        header("Location:../../index.php?page=accounts/accountant/edit_accountant&aId=$id&msg=current_pwd_err");
    }
} else {
    header("Location: index.php");
}

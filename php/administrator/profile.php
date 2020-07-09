<?php 
    session_start();
    include_once('../administrator.php');
	if(isset($_POST["update_user"])) {
        extract($_POST);
        
        $file_name= $_FILES['file']['name'];
        $file_tem_loc =$_FILES['file']['tmp_name'];
        $filetype= $_FILES['file']['type'];
        $filesize= $_FILES['file']['size'];
        $target_path = '/home/buraqtech/school.buraqtech.net/images/profile/'. basename( $_FILES["file"]["name"]);
        $file_store = "images/profile/" . $file_name;
        
        
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $file = $file_store;
    } else {
        $file = "images/profile/dummy.png";
    }

        $data = ["photo" => $file, "phone" => $phone];
        $table = "users";
        $id = $_SESSION["user_id"];
        $where = $id;

        $result = $admin_obj->updateRecord($table, $data, $where);
        if($result = true) {
            header("Location:../../index.php?page=administrator/profile&msg=up_true");
        }else {
            header("Location:../../index.php?page=administrator/profile&msg=up_false");
        }

    }
    else if(isset($_POST["change_pwd"])) {
        extract($_POST);
        
        $salt = "97aB";
        $table = "users";
        
        $current_encypt_pass = $admin_obj->encrypt_pass($current_pwd, $salt);
        
        $id = $_SESSION["user_id"];
        $where = "id = $id AND password = '$current_encypt_pass'";
        $result2 = $admin_obj->select($table, $where, NULL, NULL, NULL, NULL);
        
        foreach($result2 as $rows2) {
            $pwd = $rows2["password"];
        }

        if($current_encypt_pass == $pwd) {
            if($new_pwd == $confirm_pwd) {
                
                $new_pass2 = $admin_obj->encrypt_pass($new_pwd, $salt);
                $data = array("password" => $new_pass2);
                $table = "users";
                $where = $id;
                $result = $admin_obj->updateRecord($table, $data, $where);
                if($result = true) {
                    header("Location:../../index.php?page=administrator/profile&msg=up_true");
                }else {
                    header("Location:../../index.php?page=administrator/profile&msg=up_false");
                }
            }else {
                header("Location:../../index.php?page=administrator/profile&msg=pwd_err");
            }
        }else {
            header("Location:../../index.php?page=administrator/profile&msg=current_pwd_err");
        }
    }else {
        header("Location:index.php");
    }


?>
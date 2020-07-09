<?php

    require('../account.php');
    if(isset($_POST["datapost"])) {
        extract($_POST);
        $class_id = $_POST["datapost"];
        $status = "active";
        $result = $account_obj->showStudentByClass($status, $class_id);
        if($result == true) {
            foreach($result as $row) {
                ?><option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option><?php
            }
        }
    }else if(isset($_POST["campus"])) {
        extract($_POST);
        $campus_id = $_POST["campus"];
        $result = $academics_obj->getClass($campus_id);
        if($result == true) {
            foreach($result as $row) {
                ?><option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option><?php
            }
        }
    }else {
        header("Location: index.php");
    }

?>
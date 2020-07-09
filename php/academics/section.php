<?php

    // FileName: section.php
    // Description:
    //     Get all data, verify and perdorm requiredaction 
    
    session_start();
    require('../academics.php');

    if(isset($_POST["addSection"])) {
        extract($_POST);
        $result = $academics_obj->addSection($name, $nick_name, $_SESSION["campus_id"], $class);
        if($result = true) {
            header("Location:../../index.php?page=academics/class/manage_section&msg=true");
        }else {
            header("Location:../../index.php?page=academics/class/manage_section&msg=false");
        }
    }else if(isset($_POST["updateSection"])) {
        extract($_POST);
        $result = $academics_obj->updateSection($name, $nick_name, $class, $section_id);
        if($result = true) {
            header("Location:../../index.php?page=academics/class/manage_section&msg=up_true");
        }else {
            header("Location:../../index.php?page=academics/class/manage_section&msg=up_false");
        }
    }

    if(isset($_REQUEST["status"])) {
        if($_REQUEST["status"] == 'delete') {
            extract($_GET);
            $where = 'id = '.$id;
            $result = $academics_obj->dElete_row('section', $where);
            if($result = true) {
                header("Location:../../index.php?page=academics/class/manage_section&msg=up_true");
            }else {
                header("Location:../../index.php?page=academics/class/manage_section&msg=up_false");
            }
        }else {
            // Do nothing
        }
    }else {
        // Do nothing
    }

?>
<?php

    if(isset($_POST["addNotice"])) {
        require_once("../academics.php");
        extract($_POST);
        $data = [null, $title, $details, $date, null, null, null];
        $result = $academics_obj->addRecord("notices", $data);
        if($result == true) {
            header("Location: ../../index.php?page=academics/noticeboard/noticeboard&msg=true");
        }else {
            header("Location: ../../index.php?page=academics/noticeboard/noticeboard&msg=false");
        }
    }else if(isset($_POST["updateNotice"])) {
        require_once("../academics.php");
        extract($_POST);
        $data = ["title" => $title, "details" => $details, "date" => $date];
        $where = $noticeId;
        $result = $academics_obj->updateRecord("notices", $data, $where);
        if($result == true) {
            header("Location: ../../index.php?page=academics/noticeboard/noticeboard&msg=up_true");
        }else {
            header("Location: ../../index.php?page=academics/noticeboard/noticeboard&msg=up_false");
        }
    }else {
        header("Location: index.php");
    }

?>
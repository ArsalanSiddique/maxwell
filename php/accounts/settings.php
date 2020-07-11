<?php

if (isset($_POST["save_other_setting"])) {
    extract($_POST);
    require_once("../account.php");
    session_start();
    $data = [null, $_SESSION["session_id"], $_SESSION["campus_id"], $depart_id, $class_id, $cat_id, $fees, $fine, null, null, null];
    $result = $account_obj->addRecord("payment_settings", $data);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=true");
    } else {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=false");
    }
}
if (isset($_POST["update_other_setting"])) {
    extract($_POST);
    require_once("../account.php");
    session_start();
    $data = ["fee_amount" => $fees, "fine" => $fine];
    $result = $account_obj->updateRecord("payment_settings", $data, $id);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=up_true");
    } else {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=up_false");
    }
} else if (isset($_POST["save_setting"])) {
    extract($_POST);
    require_once("../account.php");

    $classes = $account_obj->fetchAllRecord("class");
    $i = 0;
    foreach ($classes as $class) {
        $data = [null, $class["id"], $fees[$i], $fine[$i], null, null, null];
        $result = $account_obj->addRecord("payment_settings", $data);

        $i++;

        if ($result == false) {
            header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=false");
        }
    }
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=true");
    }
} else if (isset($_POST["update_monthly_fee"])) {
    session_start();
    extract($_POST);
    require_once("../account.php");



    $count = count($fees);
    for ($i = 0; $i < $count; $i++) {

        $check_record = $account_obj->checkRecord($depart_id[$i], $class_id[$i]);
        if ($check_record == true) {
            $data = ["fee_amount" => $fees[$i], "fine" => $fine[$i]];
            $result = $account_obj->updatePayment("payment_settings", $data, $class_id[$i], $depart_id[$i]);
            if ($result == false) {
                header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=up_false");
            }
        } else {
            $data = [null, $_SESSION["session_id"], $_SESSION["campus_id"], $depart_id[$i] ,$class_id[$i], "1", $fees[$i], $fine[$i], null, null, null];
            $result = $account_obj->addRecord("payment_settings", $data);
            if ($result == false) {
                header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=up_false");
            }
        }
    }
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=up_true");
    }
} else if (isset($_POST["add_category"])) {
    extract($_POST);
    require_once("../account.php");
    $data = [null, $name, $details, null, null, null];
    $result = $account_obj->addRecord("fee_category", $data);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=true");
    } else {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=false");
    }
} else if (isset($_POST["up_cat"])) {
    require_once("../account.php");
    extract($_POST);
    $table = "fee_category";
    $data = ["name" => $name, "details" => $details];

    $result = $account_obj->updateRecord($table, $data, $cat_id);
    if ($result = true) {
        header("Location:../../index.php?page=accounts/payment/payment_setting&msg=up_true");
    } else {
        header("Location:../../index.php?page=accounts/payment/payment_setting&msg=up_false");
    }
} else {
    header("Location: index.php");
}

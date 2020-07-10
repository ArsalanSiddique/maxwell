<?php

if (isset($_POST["save_setting"])) {
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
} else if (isset($_POST["update_setting"])) {
    extract($_POST);
    require_once("../account.php");

    $payments = $account_obj->fetchAllRecord("payment_settings");
    $i = 0;
    foreach ($payments as $record) {
        $data = ["fee_amount" => $fees[$i], "fine" => $fine[$i]];
        $result = $account_obj->updateRecord("payment_settings", $data, $record["id"]);

        $i++;

        if ($result == false) {
            header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=up_false");
        }
    }
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=up_true");
    }
}else if(isset($_POST["add_category"])) {
    extract($_POST);
    require_once("../account.php");
    $data = [null, $name, $details, null, null, null];
    $result = $account_obj->addRecord("fee_category", $data);
    if($result == true) {
        header("Location: ../../index.php?page=accounts/payment/payment_setting&msg=true");
    }else {
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

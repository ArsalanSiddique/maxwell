<?php

if (isset($_POST["add_category"])) {
    require_once("../account.php");
    session_start();
    extract($_POST);
    $table = "expense_category";
    $campus_id = $_SESSION["campus_id"];
    $data = [null, $campus_id, $name, null, null, null];
    $result = $account_obj->addRecord($table, $data);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/expense/category&msg=true");
    } else {
        header("Location: ../../index.php?page=accounts/expense/category&msg=false");
    }
} else if (isset($_POST["update_category"])) {
    require_once("../account.php");
    extract($_POST);
    $table = "expense_category";
    $data = ["name" => $name];
    $result = $account_obj->updateRecord($table, $data, $cat_id);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/expense/category&msg=up_true");
    } else {
        header("Location: ../../index.php?page=accounts/expense/category&msg=up_false");
    }
} else if (isset($_POST["add_expense"])) {
    require_once("../account.php");
    session_start();
    extract($_POST);
    $table = "expense";
    $campus_id = $_SESSION["campus_id"];
    $data = [null, $campus_id, $category_id, $title, $amount, $date, null, null, null];
    $result = $account_obj->addRecord($table, $data);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/expense/expense&msg=true");
    } else {
        header("Location: ../../index.php?page=accounts/expense/expense&msg=false");
    }
} else if (isset($_POST["update_expense"])) {
    require_once("../account.php");
    extract($_POST);
    $table = "expense";
    $data = ["title" => $name, "category_id" => $category_id, "date" => $date];
    $result = $account_obj->updateRecord($table, $data, $exp_id);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/expense/expense&msg=up_true");
    } else {
        header("Location: ../../index.php?page=accounts/expense/expense&msg=up_false");
    }
} else {
    header("Location: index.php");
}

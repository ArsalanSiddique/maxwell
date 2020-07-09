<?php


if (isset($_POST["fee_payment"])) {
    require_once("../account.php");
    session_start();
    extract($_POST);
    $table = "payment";
    $data = [null, $_SESSION["session_id"], $_SESSION["campus_id"], $class, $student, $title, $details, $total_amount, $paid_amount, $discount, "", $status, $method, $month, null, null, null];
    $result = $account_obj->addRecord($table, $data);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/create_student_payments&msg=true");
    } else {
        header("Location: ../../index.php?page=accounts/payment/create_student_payments&msg=false");
    }
} else if (isset($_POST["mass_payment"])) {
    require_once("../account.php");
    session_start();
    extract($_POST);

    $students = $account_obj->showStudentByClass("active", $class);
    foreach ($students as $student) {
        $filter = $account_obj->checkPayment($class, $student["id"], $month);

        if ($filter != true) {
            
            $table = "payment";
            $data = [null, $_SESSION["session_id"], $_SESSION["campus_id"], $class, $student["id"], $title, $details, $total_amount, $paid_amount, '00', '00', $status, $method, $month, null, null, null];
            echo $result = $account_obj->addRecord($table, $data);
            if ($result == false) {
                header("Location: ../../index.php?page=accounts/payment/create_student_payments&msg=m_false");
            }
        }else {
            // do not generate payment for this student.
        }
    }
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/create_student_payments&msg=m_true");
    }
} else if (isset($_POST["update_payment"])) {
    require_once("../account.php");
    session_start();
    extract($_POST);

    $data = ["class_id" => $class, "student_id" => $student, "title" => $title, "details" => $details, "month" => $month, "total_amount" => $total_amount, "paid_amount" => $paid_amount, "discount" => $discount, "status" => $status, "method" => $method];
    $result = $account_obj->updateRecord("payment", $data, $inv_id);
    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/edit_payment&pId=$inv_id&msg=up_true");
    } else {
        header("Location: ../../index.php?page=accounts/payment/edit_payment&pId=$inv_id&msg=up_false");
    }
} else if (isset($_POST["save_voucher"])) {
    require_once("../account.php");
    extract($_POST);

    $records = $account_obj->showPaymentHistory($student_id);
    $i = 0;
    foreach ($records as $record) {
        $table  = "payment";
        $data = ["paid_amount" => $paid_amount[$i], "fine" => $fine[$i], "discount" => $discount[$i], "status" => "paid", "method" => "cash"];
        $result = $account_obj->updateRecord($table, $data, $record["id"]);
        $i++;
        if ($result == false) {
            header("Location: ../../index.php?page=accounts/payment/view_payment&pId=$inv_id&msg=up_false");
        }
    }

    if ($result == true) {
        header("Location: ../../index.php?page=accounts/payment/view_payment&pId=$inv_id&msg=up_true");
    } else {
        header("Location: ../../index.php?page=accounts/payment/view_payment&pId=$inv_id&msg=up_false");
    }
} else {
    header("Location: index.php");
}

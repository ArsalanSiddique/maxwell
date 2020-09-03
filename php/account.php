<?php

require_once('crud.php');
class accounts extends crud
{

    public function showFee($depart_id, $class_id)
    {
        $table = "payment_settings";
        $where = "depart_id = $depart_id AND class_id = $class_id AND deleted_at IS NULL AND category_id = 1 AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_array($result);
            return [$result["fee_amount"], $result["fine"]];
        } else {
            return false;
        }
    }

    function checkRecord($depart_id, $class_id)
    {
        $table = "payment_settings";
        $where = "depart_id = $depart_id AND class_id = $class_id AND category_id = 1 AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function addRecord($table, $data)
    {
        $result = $this->insert($table, $data, NULL);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function getColName($table, $column, $id)
    {
        $where = "`id` = $id AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["$column"];
        } else {
            return false;
        }
    }

    function paymentSetting($depart_id, $class_id, $cat_id)
    {
        $table = "payment_settings";
        $where = "depart_id = $depart_id AND class_id = $class_id AND category_id = $cat_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if ($result == true) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function getRecordById($table, $id)
    {
        $where = "`id` = $id AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }

    function updateRecord($table, $data, $id)
    {
        $where = "`id` = $id AND deleted_At IS NULL";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function updatePayment($table, $data, $class_id, $depart_id)
    {
        $where = "`class_id` = $class_id AND `depart_id` = $depart_id AND `category_id` = '1' AND deleted_At IS NULL";
        $result = $this->update($table, $data, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }


    function deleteRecord($table, $id)
    {
        $where = " id = '$id'";
        $cols = "deleted_at = now()";

        $result = $this->update_time($table, $cols, $where);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }

    function showClass($depart_id)
    {
        $table = "class";
        $where = "depart_id = $depart_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function fetchAllRecord($table)
    {
        $where = "deleted_at IS NULL";
        $order = "id DESC";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function fetchAccountant()
    {
        $table = "users";
        $where = "user_type = 'accountant' AND deleted_at IS NULL";
        $order = "id DESC";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function checkUsername($name)
    {
        $table = "users";
        $where = "user_name = '$name' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function checkPayment($depart_id, $class_id, $student_id, $month, $cat_id)
    {
        $table = "payment";
        $where = "department_id = $depart_id AND class_id = '$class_id' AND student_id = '$student_id' AND category_id = $cat_id  AND month = '$month' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function showStudentByClass($status, $class)
    {
        session_start();
        $table = 'students';
        $campus_id = $_SESSION["campus_id"];
        $where = "`campus_id` = $campus_id AND `class_id` = $class AND status = '$status'";
        $where .= " AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function checkColName($colname, $value, $user_id)
    {
        $table = "users";
        $where = "$colname = '$value' AND id = $user_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function checkEmail($email)
    {
        $table = "users";
        $where = "email = '$email' AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function showPayment($depart_id, $class, $month)
    {
        $table1 = "payment";
        $table2 = "students";
        $behave1 = "student_id";
        $behave2 = "id";
        $column = ["students.reg_no", "students.name", "students.father_name as father", "payment.paid_amount", "payment.total_amount", "payment.status", "payment.method", "payment.id", "payment.month", "payment.category_id"];
        $where = "payment.class_id = $class AND payment.month = '$month' AND payment.depart_id = $depart_id AND payment.deleted_at IS NULL";
        $result =  $this->leftJoin($table1, $table2, $column, $behave1, $behave2, $where);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function showPaymentHistory($student_id)
    {
        $table1 = "payment";
        $table2 = "students";
        $behave1 = "student_id";
        $behave2 = "id";
        $column = ["students.reg_no", "students.name", "students.father_name as father", "payment.paid_amount", "payment.total_amount",  "payment.discount", "payment.status", "payment.method", "payment.id", "payment.month", "payment.created_at", "payment.category_id", "payment.fine", "payment.id as recipt"];
        $where = "payment.student_id = $student_id AND payment.deleted_at IS NULL";
        $result =  $this->leftJoin($table1, $table2, $column, $behave1, $behave2, $where);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function fetchFine($student_id, $class_id)
    {
        $table = "payment_settings";
        $where = "`class_id` = $class_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        $total_fine = 0;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $fine = $row["fine"];

            $payment_history = $this->showPaymentHistory($student_id);
            foreach ($payment_history as $record) {
                if ($record["paid_amount"] < $record["total_amount"]) {
                    $month_number = date("n", strtotime($record["month"]));
                    if ($month_number != date("n")) {
                        $year = date("Y", strtotime($record["month"]));
                        $d = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
                        $d = $d - 15;
                        $total_fine += $fine * $d;
                    } else {
                        $days = date("d");
                        $days = $days - 15;
                        if ($days > 0) {
                            $total_fine += $fine * $days;
                        }
                    }
                }
            }
            return $total_fine;
        } else {
            return $total_fine;
        }
    }

    function fetchFineByMonth($class_id, $month)
    {
        $table = "payment_settings";
        $where = "`class_id` = $class_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, NULL, NULL, NULL, NULL);
        $total_fine = 0;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $fine = $row["fine"];

            $month_number = date("n", strtotime($month));
            if ($month_number != date("n")) {
                $year = date("Y", strtotime($month));
                $d = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
                $d = $d - 15;
                $total_fine += $fine * $d;
            } else {
                $days = date("d");
                $days = $days - 15;
                if ($days > 0) {
                    $total_fine += $fine * $days;
                }
            }

            return $total_fine;
        } else {
            return $total_fine;
        }
    }

    function fetchDueFees()
    {
        $table = "payment";
        $where = "status = 'Unpaid' AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    function encrypt_pass($pass, $salt)
    {
        $salt = $salt;
        $new_pass = md5($pass);
        $new_pass = sha1($new_pass);
        $new_pass = str_rot13($new_pass);
        $new_pass .= 7;
        $new_pass .= $salt;

        return $new_pass;
    }


    function monthlyPaymentSetting()
    {
        $table1 = "department";
        $table2 = "class";
        $where = "class.deleted_at IS NULL AND department.deleted_at IS NULL AND class.name IS NOT NULL";
        $behave1 = "id";
        $behave2 = "depart_id";
        $col = ["department.id as depart_id", "class.id as class_id", "department.name as depart_name", "class.name as class_name"];
        $result = $this->leftJoin($table1, $table2, $col, $behave1, $behave2, $where);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function fetchMonthlyPayment($month, $session_id)
    {
        $table = "payment";
        $where = "month = '$month' AND session_id = $session_id AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        $total_amount = 0;
        $total_paid = 0;
        $data = array();
        $count = 0;
        if (mysqli_num_rows($result) > 0) {
            foreach ($result as $rows) {
                $total_amount += $rows["total_amount"];
                $total_paid += $rows["paid_amount"];
                if ($rows["paid_amount"] == "0") {
                    $count++;
                }
            }
            array_push($data, $total_amount);
            array_push($data, $total_paid);
            array_push($data, $count);
            return $data;
        } else {
            array_push($data, $total_amount);
            array_push($data, $total_paid);
            array_push($data, $count);
            return $data;
        }
    }


    function fetchExpenseGraph()
    {
        $month_number = date("m");
        $year = date("Y");
        $start_date = "$year-$month_number-01";
        $last_date = date("Y-m-t", strtotime($start_date));

        $table = "expense";
        $where = "(date between '$start_date' AND '$last_date')";
        $result = $this->select($table, $where, null, null, null, null);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
$account_obj = new accounts();

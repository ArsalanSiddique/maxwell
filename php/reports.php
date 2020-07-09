<?php

require_once('crud.php');
class reports extends crud
{


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

    function showStudentBySection($status, $class_id, $section_id)
    {
        session_start();
        $table = 'students';
        $campus_id = $_SESSION["campus_id"];
        if($section_id != "") {
            $where = "`campus_id` = $campus_id AND `class_id` = $class_id AND status = '$status' AND section_id = '$section_id'";
        }else {
            $where = "`campus_id` = $campus_id AND `class_id` = $class_id AND status = '$status'";
        }
        
        $where .= " AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

   	    function CountFees($class_id, $section_id, $month)
    {

        $monthlyFees = 0;
        $totalPaidFees = 0;
        $totalMontlhyFees = 0;
        $totalDueFees = 0;
        
        $monthlyFees = $this->monthlyFees($class_id);
        
        $order = "id DESC";
        $where = "class_id = $class_id AND section_id = $section_id AND deleted_at IS NULL";
        $result = $this->select("students", "$where", NULL, $order, NULL, NULL);
        if (mysqli_num_rows($result) > 0) {
            $totalStudents = mysqli_num_rows($result);
            $totalMontlhyFees = $monthlyFees * $totalStudents;
            
            foreach($result as $data) {
                $table = "payment";
                $student_id = $data["id"];
                $where = "class_id = $class_id AND month = '$month' AND student_id = '$student_id' AND status = 'paid' AND deleted_at IS NULL";
                $order = "id DESC";
                $result2 = $this->select($table, $where, NULL, $order, NULL, NULL);
                if (mysqli_num_rows($result2) > 0) {
                    $row = mysqli_fetch_array($result2);
                    $totalPaidFees += $row["paid_amount"];
                }
            }
            $totalDueFees = $totalMontlhyFees - $totalPaidFees;
            
            $data = [$totalMontlhyFees, $totalPaidFees, $totalDueFees];
            return $data;
            
        }else {
            $data = [0, 0, 0];
            return $data;
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

    function showPayment($class, $month)
    {
        $table1 = "payment";
        $table2 = "students";
        $behave1 = "student_id";
        $behave2 = "id";
        $column = ["students.reg_no", "students.name", "students.father_name as father", "payment.paid_amount", "payment.total_amount", "payment.status", "payment.method", "payment.id", "payment.month"];
        $where = "payment.class_id = $class AND payment.month = '$month' AND payment.deleted_at IS NULL";
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
        $column = ["students.reg_no", "students.name", "students.father_name as father", "payment.paid_amount", "payment.total_amount",  "payment.discount", "payment.status", "payment.method", "payment.id", "payment.month", "payment.created_at", "payment.fine", "payment.title", "payment.id as recipt"];
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
        $where = "created_at <> updated_at AND total_amount > paid_amount AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return 0;
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


    function fetchReportByCampus($campus_id)
    {
        $table1 = "class";
        $table2 = "section";
        $behave1 = "id";
        $behave2 = "class_id";
        $col = ["class.id as class_id", "section.id as section_id", "class.name as class_name", "section.name as section_name"];
        $where = "class.campus_id = $campus_id  AND class.deleted_at IS NULL AND section.deleted_at IS NULL";
        $result = $this->leftJoin($table1, $table2, $col, $behave1, $behave2, $where);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function fetchMonthlyPaymentOfStudent($student_id, $session_id, $month) {

        $table = "payment";
        $where = "student_id = '$student_id' AND session_id = '$session_id' AND month = '$month' AND deleted_at IS NULL";
        $order = "id desc";
        $result = $this->select($table, $where, null, $order, null, null);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["paid_amount"];
        } else {
            return 00;
        }
    }

    function monthlyFees($class_id) {
        $table = "payment_settings";
        $where = " class_id = '$class_id' AND deleted_at IS NULL";
        $result = $this->select($table, $where, null, null, null, null);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            return $row["fee_amount"];
        } else {
            return 00;
        }
    }
}
$report_obj = new reports();

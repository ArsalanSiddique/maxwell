<?php

// FileName: class.php
// Description:
//     Get all data, verify and perdorm requiredaction 

require('../academics.php');
if (isset($_POST["datapost"])) {
    extract($_POST);
    $class_id = $_POST["datapost"];
    $result = $academics_obj->getSection($class_id);
    if ($result == true) {
        echo '<option value="">Select section</option>';
        foreach ($result as $row) {
?>
            <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
        <?php
        }
    }
} else if (isset($_POST["campus"])) {
    extract($_POST);
    $campus_id = $_POST["campus"];
    $result = $academics_obj->getClass($campus_id);
    if ($result == true) {
        foreach ($result as $row) {
        ?>
            <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
        <?php
        }
    }
} else if (isset($_POST["class_id"])) {
    extract($_POST);
    $class = $_POST["class_id"];
    $result = $academics_obj->showALlSubject($class);
    if ($result == true) {
        echo '<option value="">Select Subject</option>';
        foreach ($result as $row) {
        ?>
            <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
<?php
        }
    }
} else if (isset($_POST["regist"])) {
    extract($_POST);
    $result = $academics_obj->checkRegist("students", $regist);
    if ($result == true) {
        echo "<small class='text-danger' style='font-size:14px;'><b>Warning:</b> &nbsp; Registeration number exist in database.</small>";
    }else {
        echo "<small class='text-success' style='font-size:14px;'><b>Success</small>";
    }
} else {
    header("Location: index.php");
}

?>
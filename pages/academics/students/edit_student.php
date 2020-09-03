<?php

require_once("php/academics.php");
$student =  $academics_obj->getStudent($_REQUEST["sId"]);
$classes = $academics_obj->showAllClass();
$campus = $academics_obj->showAllCampus();
$sections = $academics_obj->showSectionByClass($student["class_id"]);
$parent = $academics_obj->fetchAllRecord("parents");

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/students/student_information"> Student List</a></li>
        <li class="active"><a href="#">Edit Student</a></li>
    </ul>
</div>
<form action="php/academics/add_students.php" role="form" method="post" class="form-group thumbnail" enctype="multipart/form-data">
    <div class="row" style="margin:0px;padding:10px;">
        <div class="col-md-7">
            <fieldset>
                <legend>STUDENT INFORMATOIN</legend>
                <div class="form-group">
                    <label for="fname">Full Name</label><span class="red_required">*</span>
                    <input type="text" name="name" id="" class="form-control" value="<?php echo $student["name"] ?>" placeholder="Full Name" required="required" />
                    <input type="hidden" name="std_id" value="<?php echo $_REQUEST["sId"] ?>" />
                </div>
                <div class="form-group">
                    <label for="father_name">Father Name</label><span class="red_required">*</span>
                    <input type="text" name="father" id="" class="form-control" value="<?php echo $student["father_name"] ?>" placeholder="Father's Name" required="required" />
                </div>
                <div class="form-group">
                    <label for="age">Phone</label><span class="red_required">*</span>
                    <input type="text" name="phone" id="" class="form-control" value="<?php echo $student["phone"] ?>" placeholder="+92 xxx xxxxxxx">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="" class="form-control" value="<?php echo $student["email"] ?>" placeholder="Your Email">
                </div>
                <div class="form-group">
                    <label for="birth">Date Of Birth</label>
                    <input type="date" name="birth" id="" value="<?php echo $student["dob"] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="age">Religion</label>
                    <input type="text" name="religion" value="<?php echo $student["religion"] ?>" id="" class="form-control" placeholder="Religion">
                </div>
                <div class="form-group">
                    <label for="age">Gender</label><span class="red_required">*</span><br />
                    <input type="radio" name="gender" id="" value="Male" <?php if ($student["gender"] == "Male") {
                                                                                echo "checked";
                                                                            } ?> /> Male &nbsp;&nbsp;
                    <input type="radio" name="gender" id="" value="Female" <?php if ($student["gender"] == "Female") {
                                                                                echo "checked";
                                                                            } ?> /> Female </div>
                <div class="form-group">
                    <label for="age">Status</label>
                    <select class="form-control" name="status">
                        <option class="active" <?php if ($student["status"] == "active") {
                                                    echo "checked";
                                                } ?>>Active</option>
                        <option class="in-active" <?php if ($student["status"] == "in-active") {
                                                        echo "checked";
                                                    } ?>>In Active</option>
                    </select>
                </div>
            </fieldset>
            <fieldset>
                <legend>ADDRESS INFORMATION</legend>
                <div class="form-group">
                    <label for="address">Address</label><span class="red_required">*</span>
                    <input type="text" name="address" id="" value="<?php echo $student["address"] ?>" class="form-control" placeholder="Enter Your Address" required="required">
                </div>
                <div class="form-group">
                    <label for="address">Country</label>
                    <input type="text" name="country" id="" value="<?php echo $student["country"] ?>" class="form-control" placeholder="Enter Your Address">
                </div>
                <div class="form-group">
                    <label for="address">City</label>
                    <input type="text" name="city" id="" value="<?php echo $student["city"] ?>" class="form-control" placeholder="Enter Your Address">
                </div>
            </fieldset>
        </div>
        <div class="col-md-5 pull-right regist">
            <fieldset>
                <legend>REGISTEATION INFORMATION</legend>
                <div class="form-group">
                    <label for="regist_No">Registration No.</label><span class="red_required">*</span>
                    <input type="text" name="regist_no" id="" value="<?php echo $student["reg_no"] ?>" class="form-control" placeholder="Enter Registration Number" required="required">
                </div>
                <div class="form-group">
                    <label for="parents">Parents </label>
                    <select name="parent_id" id="parents" class="form-control" onchange="changeClass(this.value)">
                        <option value="">Select Parents</option>
                        <?php foreach ($parent as $data) { ?>
                            <option value="<?php echo $data["id"] ?>" <?php if ($student["parent_id"] == $data["id"]) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $data["name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Campus</label><span class="red_required">*</span>
                    <select name="campus_id" id="" class="form-control" onchange="changeClass(this.value)">
                        <option value="">Select Campus</option>
                        <?php foreach ($campus as $camp) { ?>
                            <option value="<?php echo $camp["id"] ?>" <?php if ($student["campus_id"] == $camp["id"]) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $camp["name"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="class">Class</label><span class="red_required">*</span>
                    <select name="class" class="form-control" id="class" onchange="myfun(this.value)">
                        <option value="">Select Class</option>
                        <?php
                        foreach ($classes as $class) {
                        ?>
                            <option value="<?php echo $class["id"] ?>" <?php if ($student["class_id"] == $class["id"]) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $class["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select name="section" class="form-control" id="section">
                        <option value="">Select Section</option>
                        <?php
                        foreach ($sections as $section) {
                        ?>
                            <option value="<?php echo $section["id"] ?>" <?php if ($student["section_id"] == $section["id"]) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $section["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </fieldset>
            <br>
            <fieldset>
                <legend>PROFILE PHOTO</legend>
                <div class="form-group">
                    <label>Upload Image</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id='img-upload' />
                    <img src="<?php echo $student["photo"] ?>" width="175" alt="profile">
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div style="display: flex; justify-content:center;">
            <input type="submit" value="Update" name="std_edit" class="btn btn-md btn-primary" />
        </div>
    </div>

</form>

<script type="text/javascript">
    function myfun(datavalue) {
        $.ajax({
            url: 'php/academics/get_data.php',
            type: 'POST',
            data: {
                datapost: datavalue
            },
            success: function(result, status) {
                $('#section').html(result);
            }
        });
    }

    function changeClass(datavalue) {
        $.ajax({
            url: 'php/academics/get_data.php',
            type: 'POST',
            data: {
                campus: datavalue
            },
            success: function(result, status) {
                $('#class').html(result);
            }
        });
    }
</script>
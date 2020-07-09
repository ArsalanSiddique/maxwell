  <?php

  require_once("php/academics.php");
  if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 'true') {
      echo $alert_obj->success("added Record.");
    } else if ($_REQUEST["msg"] == 'false') {
      echo $alert_obj->danger();
    } elseif ($_REQUEST["msg"] == "up_true") {
      echo $alert_obj->success("updated record.");
    } else if ($_REQUEST["msg"] == "up_false") {
      echo $alert_obj->danger();
    } else {
      // do nothing.
    }
  }
  $classes = $academics_obj->showAllClass();
  $section = $academics_obj->showAllSection();
  $campus = $academics_obj->showAllCampus();
  $parent = $academics_obj->fetchAllRecord("parents");
  ?>
  <div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#">Admit Student</a></li>
    </ul>
  </div>
  <form action="php/academics/add_students.php" role="form" method="post" class="form-group thumbnail" enctype="multipart/form-data">
    <div class="row" style="margin:0px;padding:10px;">
      <div class="col-md-7">
        <fieldset>
          <legend>STUDENT INFORMATOIN</legend>
          <div class="form-group">
            <label for="fname">Full Name</label><span class="red_required">*</span>
            <input type="text" name="name" id="" class="form-control" placeholder="Full Name" required="required" />
            <?php
            if (isset($_REQUEST["status"])) {
            ?>
              <input type="text" name="name" value="<?php echo $_REQUEST["status"]; ?>" />
            <?php
            } else {
            ?>
              <input type="text" name="name" value="in-active" />
            <?php
            }
            ?>

          </div>
          <div class="form-group">
            <label for="father_name">Father Name</label><span class="red_required">*</span>
            <input type="text" name="father" id="" class="form-control" placeholder="Father's Name" required="required" />
          </div>
          <div class="form-group">
            <label for="age">Phone</label><span class="red_required">*</span>
            <input type="text" name="phone" id="" class="form-control" placeholder="+92 xxx xxxxxxx">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="" class="form-control" placeholder="Your Email">
          </div>
          <div class="form-group">
            <label for="birth">Date Of Birth</label>
            <input type="date" name="birth" id="" class="form-control">
          </div>
          <div class="form-group">
            <label for="age">Religion</label>
            <input type="text" name="religion" value="Islam" id="" class="form-control" placeholder="Religion">
          </div>
          <div class="form-group">
            <label for="age">Gender</label><span class="red_required">*</span><br />
            <input type="radio" name="gender" id="male" value="Male" />
            <label for="male">Male</label>
            &nbsp;&nbsp;
            <input type="radio" name="gender" id="female" value="Female" />
            <label for="female">Female</label>
          </div>

        </fieldset>
        <fieldset>
          <legend>ADDRESS INFORMATION</legend>
          <div class="form-group">
            <label for="address">Address</label><span class="red_required">*</span>
            <input type="text" name="address" id="" class="form-control" placeholder="Enter Your Address" required="required">
          </div>
          <div class="form-group">
            <label for="address">Country</label>
            <input type="text" name="country" id="" value="Pakistan" class="form-control" placeholder="Enter Your Address">
          </div>
          <div class="form-group">
            <label for="address">City</label>
            <input type="text" name="city" id="" value="Karachi" class="form-control" placeholder="Enter Your Address">
          </div>
        </fieldset>
      </div>
      <div class="col-md-5 pull-right regist">
        <fieldset>
          <legend>REGISTEATION INFORMATION</legend>
          <div class="form-group">
            <label for="regist_No">Registration No. <span class="red_required">*</span></label>
            <input type="text" name="regist_no" id="" class="form-control" placeholder="Enter Registration Number" required="required" onkeyup="check_regist(this.value)">
            <small id="regist"></small>
          </div>
          <div class="form-group">
            <label for="parents">Parents </label>
            <select name="parent_id" id="parents" class="form-control" onchange="changeClass(this.value)">
              <option value="">Select Parents</option>
              <?php foreach ($parent as $data) { ?>
                <option value="<?php echo $data["id"] ?>"><?php echo $data["name"] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="section">Campus</label><span class="red_required">*</span>
            <select name="campus" id="" class="form-control" onchange="changeClass(this.value)">
              <option value="">Select Campus</option>
              <?php foreach ($campus as $camp) { ?>
                <option value="<?php echo $camp["id"] ?>" <?php if ($_SESSION["campus_id"] == $camp["id"]) {
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
                <option value="<?php echo $class["id"] ?>"><?php echo $class["name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="section">Section</label>
            <select name="section" class="form-control" id="section">
              <option value="">Select Section</option>
            </select>
          </div>
        </fieldset>
        <fieldset>
          <legend>PHOTO</legend>
          <div class="form-group">
            <label>Upload Image</label>
            <div class="input-group">
              <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                  Browse… <input type="file" name="file" id="imgInp">
                </span>
              </span>
              <input type="text" class="form-control" readonly>
            </div>
            <img id='img-upload' />
          </div>
          <div class="form-group">
            <div class="row">
              <br />
              <input type=button value="Take Snapshot" class="btn btn-primary" onClick="take_snapshot()">
              <input type="hidden" name="image" class="image-tag">

              <div id="results">Your captured image will appear here...</div>
              <div id="my_camera"></div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
    <div style="display: flex; justify-content: center;">
        <input type="submit" value="SUBMIT" name="submit_std" class="btn btn-md btn-primary" />
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

    function check_regist(datavalue) {
      $.ajax({
        url: 'php/academics/get_data.php',
        type: 'POST',
        data: {
          regist: datavalue
        },
        success: function(result, status) {
          $('#regist').html(result);
        }
      });
    }
  </script>
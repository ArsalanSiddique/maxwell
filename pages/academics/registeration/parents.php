<?php
if (isset($_REQUEST["msg"])) {
  if ($_REQUEST["msg"] == 'false') {
    echo $alert_obj->danger();
  } elseif ($_REQUEST["msg"] == "cnic_err") {
    echo $alert_obj->warning("CNIC alread exists.");
  } else if ($_REQUEST["msg"] == "up_false") {
    echo $alert_obj->danger();
  } else if ($_REQUEST["msg"] == "mail_err") {
    echo $alert_obj->warning("Email already exist");
  } else {
    // do nothing.
  }
}
?>

<div class="row">
  <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="index.php?page=academics/registeration/parents_info">Parents List</a></li>
    <li class="active"><a href="#">Register Parents</a></li>
  </ul>
</div>
<form action="php/academics/registeration.php" role="form" method="post" class="form-group thumbnail" enctype="multipart/form-data">
  <div class="row" style="margin:0px;padding:10px;">
    <div class="col-md-7">
      <fieldset>
        <legend>PARENTS INFORMATOIN</legend>
        <div class="form-group">
          <label for="fname">Full Name</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="name" id="" class="form-control" placeholder="Full Name" required="required" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="email" id="" class="form-control" placeholder="Your Email" required="required">
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="phone" id="phone" class="form-control" placeholder="+92 xxx xxxxxxx" required="required">
        </div>
        <div class="form-group">
          <label for="cnic">CNIC</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="cnic" id="cnic" class="form-control" placeholder="xxxxx-xxxxxxx-x" required="required" />
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>&nbsp;<br />
          <input type="radio" name="gender" id="gender" value="Male" class="" /> Male &nbsp;&nbsp;
          <input type="radio" name="gender" id="" value="Female" class="" /> Female
        </div>
        <div class="form-group">
          <label for="birth">Date Of Birth</label>
          <input type="date" name="dob" id="" class="form-control">
        </div>
        <div class="form-group">
          <label for="age">Religion</label>
          <input type="text" name="religion" value="Islam" id="" class="form-control" placeholder="Religion">
        </div>
      </fieldset>
    </div>
    <div class="col-md-5 pull-right regist">
      <fieldset>
        <legend>ADDRESS INFORMATION</legend>
        <div class="form-group">
          <label for="address">Address</label>&nbsp;<span class="red_required">*</span>
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
      <br>
      <fieldset>
        <legend>PROFILE PHOTO</legend>
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
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div style="display:flex;justify-content: center;">
      <input type="submit" value="SUBMIT" name="reg_parents" class="btn btn-md btn-primary" />
    </div>
  </div>

</form>
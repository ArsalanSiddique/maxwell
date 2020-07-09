<?php
if (isset($_REQUEST["msg"])) {
  if ($_REQUEST["msg"] == "up_false") {
    echo $alert_obj->danger();
  }   // do nothing.
}
require_once("php/academics.php");
$parent = $academics_obj->getParent($_REQUEST["pId"]);
if (empty($parent)) {
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
          <input type="text" name="name" id="fname" value="<?php echo $parent["name"] ?>" class="form-control" placeholder="Full Name" required="required" />
          <input type="hidden" name="parent_id" value="<?php echo $_REQUEST["pId"] ?>" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="email" id="email" value="<?php echo $parent["email"] ?>" class="form-control" placeholder="Your Email" required="required">
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="phone" id="phone" value="<?php echo $parent["phone"] ?>" class="form-control" placeholder="+92 xxx xxxxxxx" required="required">
        </div>
        <div class="form-group">
          <label for="cnic">CNIC</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="cnic" id="cnic" value="<?php echo $parent["cnic"] ?>" class="form-control" placeholder="xxxxx-xxxxxxx-x" required="required" />
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>&nbsp;<br />
          <input type="radio" name="gender" id="gender" value="Male" class="" <?php if ($parent["gender"] == "Male") {
                                                                                echo "checked";
                                                                              } ?> /> Male &nbsp;&nbsp;
          <input type="radio" name="gender" id="" value="Female" class="" <?php if ($parent["gender"] == "Female") {
                                                                            echo "checked";
                                                                          } ?> /> Female
        </div>
        <?php $dateok = date_format(date_create($parent["dob"]), 'Y-m-d'); ?>
        <div class="form-group">
          <label for="birth">Date Of Birth</label>
          <input type="date" name="dob" id="" value="<?php echo $dateok; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="age">Religion</label>
          <input type="text" name="religion" value="<?php echo $parent["religion"] ?>" id="" class="form-control" placeholder="Religion">
        </div>
      </fieldset>
    </div>
    <div class="col-md-5 pull-right regist">
      <fieldset>
        <legend>ADDRESS INFORMATION</legend>
        <div class="form-group">
          <label for="address">Address</label>&nbsp;<span class="red_required">*</span>
          <input type="text" name="address" id="address" value="<?php echo $parent["address"] ?>" class="form-control" placeholder="Enter Your Address" required="required">
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" name="country" id="country" value="<?php echo $parent["country"] ?>" class="form-control" placeholder="Enter Your Address">
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" name="city" id="city" value="<?php echo $parent["city"] ?>" class="form-control" placeholder="Enter Your Address">
        </div>
      </fieldset>
      <fieldset>
        <legend>PHOTO</legend>
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
        </div>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div style="display: flex; justify-content:center;">
      <input type="submit" value="Update" name="edit_parent" class="btn btn-md btn-primary" />
    </div>
  </div>

</form>
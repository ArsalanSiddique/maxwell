<?php
require_once("php/hr.php");
$teacher = $hrObj->getTeacher($_SESSION["campus_id"], $_REQUEST["tId"]);
?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="#">Add Teacher</a></li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-plus"></i> &nbsp Add Teacher
                </div>
                <div class="panel-body">
                    <form action="php/hr/hr.php" method="POST" class="form-group thumbnail" style="padding:20px" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Name <span class="red_required">*</span></label>
                            <input type="text" name="name" id="" class="form-control" value="<?php echo $teacher["name"] ?>"  placeholder="Name" required="required">
                            <input type="hidden" name="teacher_id" id="" class="form-control" value="<?php echo $teacher["id"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Cnic <span class="red_required">*</span></label>
                            <input type="number" name="cnic" id="" class="form-control"value="<?php echo $teacher["cnic"] ?>" placeholder="42401xxxxxxxxx" required="required">
                        </div>
                        <div class="form-group">
                            <label for="">Father Name</label>
                            <input type="text" name="f_name" id="" class="form-control" value="<?php echo $teacher["father_name"] ?>" placeholder="Father Name">
                        </div>
                        <div class="form-group">
                            <label for="">Birth</label>
                            <input type="date" name="dob" id="" value="<?php echo $teacher["dob"] ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="">Gender <span class="red_required">*</span></label>
                            <select name="gender" id="" class="form-control" required="required">
                                <option value="">Select Gender</option>
                                <option value="male" <?php if($teacher["gender"] == "male") { echo "Selected"; } ?> >Male</option>
                                <option value="female" <?php if($teacher["gender"] == "female") { echo "Selected"; } ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="<?php echo $teacher["address"] ?>" id="" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="">Phone <span class="red_required">*</span></label>
                            <input type="number" name="phone" id="" class="form-control" value="<?php echo $teacher["phone"] ?>" placeholder="03xxXXXXXXXX" required="required">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="<?php echo $teacher["email"] ?>" id="" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="">Photo</label>
                            <div class="imageupload panel panel-default">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title pull-left">Upload Image</h3>
                                    <div class="btn-group pull-right">
                                        <button type="button" name="image-file" class="btn btn-default active">File</button>
                                        <button type="button" name="image-file" class="btn btn-default">URL</button>
                                    </div>
                                </div>
                                <div class="file-tab panel-body">
                                    <label class="btn btn-default btn-file">
                                        <span>Browse</span>
                                        <!-- The file is stored here. -->
                                        <input type="file" name="image-file">
                                    </label>
                                    <button type="button" class="btn btn-default">Remove</button>
                                </div>
                                <div class="url-tab panel-body">
                                    <div class="input-group">
                                        <input type="text" class="form-control hasclear" placeholder="Image URL">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default">Submit</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-default">Remove</button>
                                    <!-- The URL is stored here. -->
                                    <input type="hidden" name="image-url">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <input type="submit" name="edit_teacher" class="btn btn-primary pull-right" style="margin-right:20px;" value="Update Teacher">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 'false') {
        echo $alert_obj->danger();
    } elseif ($_REQUEST["msg"] == "true") {
        echo $alert_obj->success("Added Record.");
    } elseif ($_REQUEST["msg"] == "pwd_err") {
        echo $alert_obj->warning("Password not matched.");
    } else if ($_REQUEST["msg"] == "up_true") {
        echo $alert_obj->success("Updated record.");
    } else if ($_REQUEST["msg"] == "up_false") {
        echo $alert_obj->danger();
    } else if ($_REQUEST["msg"] == "current_pwd_err") {
        echo $alert_obj->warning("Current password not matched. Try again");
    } else {
        // do nothing.
    }
}
require_once("php/account.php");
$record =  $account_obj->getRecordById("users", $_REQUEST["aId"]);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=accounts/accountant/accountant"> Accountant List</a></li>
        <li class="active"><a href="#">Edit Accountant</a></li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Edit Accountant
    </div>
    <div class="panel-default">
        <form action="php/accounts/accountant.php" role="form" method="post" class="form-group" enctype="multipart/form-data">
            <div class="row" style="margin:0px;padding:10px;">
                <div class="col-md-7">
                    <fieldset>
                        <legend>Accountant INFORMATOIN</legend>
                        <div class="form-group">
                            <label for="u_name">User Name</label><span class="red_required">*</span>
                            <input type="text" name="name" id="u_name" disabled class="form-control" value="<?php echo $record["user_name"] ?>" placeholder="User Name" required="required" />
                            <input type="hidden" name="user_id" value="<?php echo $record["id"] ?>" />
                            <small class="text-info">Username can not be changed</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" disabled class="form-control" value="<?php echo $record["email"] ?>" placeholder="Your Email">
                            <small class="text-info">Email can not be changed</small>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label><span class="red_required">*</span>
                            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $record["phone"] ?>" placeholder="+92 xxx xxxxxxx">
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-5 pull-right regist">
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
                            <img src="<?php echo $record["photo"] ?>" width="175" alt="profile">
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div style="display: flex; justify-content:center;">
                    <input type="submit" value="Update" name="edit_accountant" class="btn btn-md btn-primary" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p><b>Change Password</b></p>
            </div>
            <div class="panel-body">
                <form action="php/accounts/accountant.php" method="post" class="form-group">
                    <div class="form-group">
                        <label for="">Current Password</label>
                        <input type="password" name="current_pwd" id="" value="" class="form-control" required="required">
                        <input type="hidden" name="id" id="" value="<?php echo $_REQUEST["aId"] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" name="new_pwd" id="" value="" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirm_pwd" id="" value="" class="form-control" required="required">
                    </div>
                    <input class="btn btn-primary btn-md pull-right" type="submit" name="change_pwd" value="Change Password" />
                </form>
            </div>
        </div>
    </div>
</div>
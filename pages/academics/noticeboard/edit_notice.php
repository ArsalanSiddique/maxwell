<?php

    $table = "notices";
    $id = $_REQUEST["nId"];
    $notice = $academics_obj->getRecordById($table, $id);

?>
<div class="row">
    <ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=academics/noticeboard/noticeboard"> Notice List</a></li>
        <li class="active"><a href="#">Edit Notice</a></li>
    </ul>
</div>
<form action="php/academics/notice.php" role="form" method="post" class="form-group">
    <div class="row" style="margin:0px;padding:10px;">
    <div class="col-md-6 thumbnail" style="margin:0px;padding:10px;">
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" name="title" value="<?php echo $notice["title"] ?>" class="form-control" id="" required="required" />
            <input type="hidden" name="noticeId" value="<?php echo $notice["id"] ?>"/>
        </div>
        <div class="form-group">
            <label for="notice">Notice</label>
            <textarea name="details" class="form-control" id="" cols="30" rows="6"> <?php echo $notice["details"] ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" value="<?php echo $notice["date"] ?>" class="form-control" id="" required="required" />
        </div>
        <input type="submit" value="Update Notice" name="updateNotice" class="btn btn-primary" />
    </div>
    </div>
</form>
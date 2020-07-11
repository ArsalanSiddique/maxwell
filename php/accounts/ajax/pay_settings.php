<?php



if (isset($_POST["cat_id"])) {
    require_once("../../account.php");
    extract($_POST);
    $record = $account_obj->paymentSetting($depart_id, $class_id, $cat_id);
    if (empty($record)) {
?>
        <tr>
            <input type="hidden" name="depart_id" class="form-control" value="<?php echo $depart_id ?>" id="" />
            <input type="hidden" name="class_id" class="form-control" value="<?php echo $class_id ?>" id="" />
            <input type="hidden" name="cat_id" class="form-control" value="<?php echo $cat_id ?>" id="" />
            <td> <input type="number" name="fees" class="form-control" value="" id="" required="required" /> </td>
            <td> <input type="number" name="fine" class="form-control" value="" id="" required="required" /> </td>
            <td> <button class="btn btn-success" name="save_other_setting">Save Record</button> </td>
        </tr>
    <?php
    } else {
    ?>

        <tr>
            <input type="hidden" name="depart_id" class="form-control" value="<?php echo $depart_id ?>" id="" />
            <input type="hidden" name="class_id" class="form-control" value="<?php echo $class_id ?>" id="" />
            <input type="hidden" name="cat_id" class="form-control" value="<?php echo $cat_id ?>" id="" />
            <input type="hidden" name="id" class="form-control" value="<?php echo $record["id"] ?>" id="" />
            <td> <input type="number" name="fees" class="form-control" value="<?php echo $record["fee_amount"] ?>" id="" required="required" /> </td>
            <td> <input type="number" name="fine" class="form-control" value="<?php echo $record["fine"] ?>" id="" required="required" /> </td>
            <td>
                <button class="btn btn-primary" name="update_other_setting">Update Record</button>
                <a href="index.php?page=accounts/payment/payment_setting&status=delete&pId=<?php echo $record["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
            </td>
        </tr>

<?php
    }
}

?>
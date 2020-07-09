<?php
require_once("../account.php");
extract($_POST);
$payment = $account_obj->showPayment($class_id, $month);
$count = 1;
foreach ($payment as $record) {
?>
    <tr>
        <td><?php echo $count++; ?></td>
        <td><?php echo $record["reg_no"] ?></td>
        <td><?php echo $record["name"] ?></td>
        <td><?php echo $record["father"] ?></td>
        <td><?php echo $record["month"] ?></td>
        <td><?php echo $record["total_amount"] ?></td>
        <td><?php echo $record["paid_amount"] ?></td>
        <td><?php echo $record["status"] ?></td>
        <td><?php if ($record["method"] == "null") {
                echo "N/A";
            } else {
                echo $record["method"];
            } ?></td>
        <td>
            <a href="index.php?page=accounts/payment/view_payment&pId=<?php echo $record["id"] ?>" target="self"><i class="fa fa-eye btn-view"></i></a> &nbsp;
            <a href="index.php?page=accounts/payment/edit_payment&pId=<?php echo $record["id"] ?>"><i class="fa fa-pencil btn-edit"></i></a> &nbsp;
            <a href="index.php?page=accounts/payment/fee_payment&status=delete&pId=<?php echo $record["id"] ?>" target="_self" data-toggle="confirmation" data-placement="left"><i class="fa fa-trash btn-trash"></i></a>
        </td>
    </tr>
<?php
}
?>
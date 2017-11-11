<?php
header("Content-Type:application/json");

@$phone = $_REQUEST['phone'];
$output = [];

if(empty($phone))
{
    echo '[]';
    return;
}

require('init.php');;

$sql = "SELECT kf_order.oid,kf_order.user_name,kf_order.addr,kf_order.order_time,kf_dish.img_sm,kf_dish.did FROM kf_order,kf_dish WHERE kf_order.phone='$phone' AND kf_order.did=kf_dish.did";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);
if(empty($row))
{
    echo '[]';
}
else
{
    $output[] = $row;
    $callback = isset( $_GET[ 'callback' ] ) ? $_GET[ 'callback' ] : 'callback';
	echo $callback . '(' . json_encode( $output ) . ')';
    //echo json_encode($output);
}
?>
<?php
header("Content-Type:application/json");

@$user_name = $_REQUEST['user_name'];
@$phone = $_REQUEST['phone'];
@$addr = $_REQUEST['addr'];
@$did = $_REQUEST['did'];
@$sex = $_REQUEST['sex'];
$order_time = time()*1000;
if(empty($user_name) || empty($phone) || empty($addr) || empty($did) || empty($sex))
{
    echo '[]';
    return;
}


require('init.php');;

$sql = "INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$addr','$did')";
$result = mysqli_query($conn,$sql);

$output = [];
$arr = [];
if($result)
{
    $arr['msg'] = 'succ';
    $arr['oid'] = mysqli_insert_id($conn);
}
else
{
    $arr['msg'] = 'error';
}

$output[] = $arr;

$callback = isset( $_GET[ 'callback' ] ) ? $_GET[ 'callback' ] : 'callback';
echo $callback . '(' . json_encode( $output ) . ')';
//echo json_encode($output);
?>
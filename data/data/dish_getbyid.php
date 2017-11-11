<?php
header("Content-Type:application/json");

@$id = $_REQUEST['id'];
$output = [];

if(empty($id))
{
    echo '[]';
    return;
}


require('init.php');;

$sql = "SELECT did,name,detail,material,img_lg,price FROM kf_dish WHERE did=$id";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);
if(empty($row))
{
    echo '[]';
}
else
{
    $output[] = $row;
    //echo json_encode($output);
    $callback = isset( $_GET[ 'callback' ] ) ? $_GET[ 'callback' ] : 'callback';
	echo $callback . '(' . json_encode( $output ) . ')';
}
?>
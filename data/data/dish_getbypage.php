<?php
header("Content-Type:application/json");
// header("Access-Control-Allow-Origin:*") ;

@$start = $_REQUEST['start'];
$count = 5;
$output = [];

if(empty($start))
{
    $start = 0;
}

require('init.php');;

$sql = "SELECT did,name,price,material,img_sm FROM kf_dish LIMIT $start,$count";
$result = mysqli_query($conn,$sql);

while(true)
{
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        break;
    }
    $output[] = $row;
}

$callback = isset( $_GET[ 'callback' ] ) ? $_GET[ 'callback' ] : 'callback';
echo $callback . '(' . json_encode( $output ) . ')';
//echo json_encode($output);

?>
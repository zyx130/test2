<?php
header("Content-Type:application/json");

@$kw = $_REQUEST['kw'];
$output = [];

if(empty($kw))
{
    echo '[]';
    return;
}

require('init.php');;

$sql = "SELECT did,name,material,img_sm,price FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%'";
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
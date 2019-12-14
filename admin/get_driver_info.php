<?php 
require_once('../includes/Dbconnect.php');
//$cmd = $_POST['cmd'];
$cmd = "edit_driver";
if($cmd == "edit_driver"){
    $tbl_id = $_REQUEST['tbl_id'];
    $out_put = array();
    $query = "SELECT * FROM drivers WHERE id='$tbl_id'";
    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}

?>
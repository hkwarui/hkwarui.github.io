<?php 
require_once('../includes/Dbconnect.php');
//$cmd = $_POST['cmd'];
$cmd = "edit_buses";
if($cmd == "edit_buses"){
    $tbl_id = $_REQUEST['tbl_id'];
    $out_put = array();
    $query = "SELECT * FROM buses WHERE id='$tbl_id'";
    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}

?>
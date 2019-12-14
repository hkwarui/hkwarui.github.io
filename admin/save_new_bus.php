<?php 
require_once('../includes/Dbconnect.php');
$form_name = $_POST['form_name'];

//Post
if($form_name == 'add_bus'){
    $bus_reg = mysqli_real_escape_string($DBcon, $_POST['bus_reg']);
    $route_id = mysqli_real_escape_string($DBcon, $_POST['route']);
    $driver_id = mysqli_real_escape_string($DBcon, $_POST['driver']);
    $bus_time = mysqli_real_escape_string($DBcon, $_POST['bus_time']);
        
    $query = "INSERT INTO buses (bus_reg, route_id, driver_id,bus_time) VALUES ('$bus_reg','$route_id', '$driver_id', '$bus_time')";
    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

//Patch
if($form_name == "edit_bus"){
    $edit_id =mysqli_real_escape_string($DBcon, $_POST['edit_id']);
    $bus_reg = mysqli_real_escape_string($DBcon, $_POST['bus_reg']);
    $route_id = mysqli_real_escape_string($DBcon, $_POST['route']);
    $driver_id = mysqli_real_escape_string($DBcon, $_POST['driver']);
    $bus_time = mysqli_real_escape_string($DBcon, $_POST['bus_time']);
  
    $query = "UPDATE buses SET bus_reg = '$bus_reg', route_id ='$route_id', driver_id ='$driver_id',bus_time= '$bus_time'  WHERE id ='$edit_id'";
    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

//Delete
if($form_name == "del_user"){
    $chk_val = 0;
    $tbl_id = mysqli_real_escape_string($DBcon, $_POST['tbl_id']);

    if( $chk_val == 0){
        $query = "DELETE FROM buses  WHERE id ='$tbl_id'";
        $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
        if($result)
            echo "1";
        else
            echo "0";
    }
    else{
        echo "404-del";
    }

  }

?>
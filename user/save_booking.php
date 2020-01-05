<?php 
require_once('../includes/Dbconnect.php');
 session_start();
 $eid = $_SESSION['username'];

$form_name = $_POST['form_name'];

if($form_name == 'add_user'){

    $route = mysqli_real_escape_string($DBcon, $_POST['route']);
    $date1 = mysqli_real_escape_string($DBcon, $_POST['datepicker']);
    $date = date("Y-m-d", strtotime($date1));
    $bus_time = mysqli_real_escape_string($DBcon, $_POST['bus_time']);
    $time = date('h:i', strtotime($bus_time));
    $payment = mysqli_real_escape_string($DBcon, $_POST['charges']);
    $bus_reg = mysqli_real_escape_string($DBcon, $_POST['bus_reg']);
    $customer = $eid;

    $query1 = "SELECT driver_id FROM buses WHERE id = $bus_reg";
    $result1 = mysqli_query($DBcon,$query1) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_assoc($result1);
    $driver =  $row['driver_id'];

    $query = "INSERT INTO users_bookings (bus_reg,bus_route, book_date, bus_time, driver_id, payments,customer) VALUES ('$bus_reg','$route', '$date', '$time','$driver','$payment','$customer')";

    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

if($form_name == "edit_user"){
    $date1 = mysqli_real_escape_string($DBcon, $_POST['datepicker']);
    $date = date("Y-m-d", strtotime($date1));
    //echo $date;
    $route = mysqli_real_escape_string($DBcon, $_POST['route']);
    $bus_time = mysqli_real_escape_string($DBcon, $_POST['bus_time']);
    $time = date("H:i", strtotime($bus_time));
    $edit_id = mysqli_real_escape_string($DBcon, $_POST['edit_id']);
    $payment = mysqli_real_escape_string($DBcon, $_POST['charges']);
    $query = "UPDATE users_bookings SET bus_route = '$route', book_date ='$date', bus_time ='$time',payments=$payment WHERE id ='$edit_id'";
    $result = mysqli_query($DBcon, $query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}


if($form_name == "del_user"){
    $chk_val = 0;
    $tbl_id = mysqli_real_escape_string($DBcon, $_POST['tbl_id']);

    if( $chk_val == 0){
        $query = "DELETE FROM users_bookings  WHERE id ='$tbl_id'";
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

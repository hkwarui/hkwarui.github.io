<?php 
require_once('../includes/Dbconnect.php');
$form_name = $_POST['form_name'];

//Post
if($form_name == 'add_bus'){
    $fname = mysqli_real_escape_string($DBcon, $_POST['fname']);
    $lname = mysqli_real_escape_string($DBcon, $_POST['lname']);
    $email = mysqli_real_escape_string($DBcon, $_POST['email']);
    $contact = mysqli_real_escape_string($DBcon, $_POST['contact']);

    $query1 = "SELECT id FROM  drivers ORDER BY id DESC LIMIT 1 ";
    $result1 = mysqli_query($DBcon,$query1) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_array($result1);
    $id =$row['id'] + 1;
    $driver_id = "dr2".$id;
    
    $query = "INSERT INTO drivers (fname,lname,driver_id,driver_email,driver_contact) VALUES ('$fname','$lname', '$driver_id', '$email','$contact')";
    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

//Patch
if($form_name == "edit_bus"){
    $edit_id =mysqli_real_escape_string($DBcon, $_POST['edit_id']);
    $fname = mysqli_real_escape_string($DBcon, $_POST['fname']);
    $lname = mysqli_real_escape_string($DBcon, $_POST['lname']);
    $email = mysqli_real_escape_string($DBcon, $_POST['email']);
    $contact = mysqli_real_escape_string($DBcon, $_POST['contact']);
     
    $query = "UPDATE drivers SET fname = '$fname', lname ='$lname', driver_email='$email' ,driver_contact= '$contact'  WHERE id ='$edit_id'";
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
        $query = "DELETE FROM drivers  WHERE id ='$tbl_id'";
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
<?php 
require_once('../includes/Dbconnect.php');
$form_name = $_POST['form_name'];

//Post
if($form_name == 'add_customer'){
    $fname = mysqli_real_escape_string($DBcon, $_POST['fname']);
    $lname = mysqli_real_escape_string($DBcon, $_POST['lname']);
    $email = mysqli_real_escape_string($DBcon, $_POST['email']);
    $contact = mysqli_real_escape_string($DBcon, $_POST['contact']);
    $user_image = '1578056148_no-image.png';
    //$time = time();
    $user_since = date('Y-m-d');

    $query1 = "SELECT id FROM  users_details ORDER BY id DESC LIMIT 1 ";
    $result1 = mysqli_query($DBcon,$query1) or die(mysqli_error($DBcon));
    $row = mysqli_fetch_array($result1);
    $id =$row['id'] + 1;
    $user_code = "pg".$id;
    
    $query = "INSERT INTO users_details (user_fname,user_lname,user_image, user_code,user_email,user_contact,user_since) VALUES ('$fname','$lname','$user_image', '$user_code', '$email','$contact','$user_since')";
    $result = mysqli_query($DBcon,$query) or die(mysqli_error($DBcon));
    if($result)
        echo "1";
    else
        echo "0";
}

//Patch
if($form_name == "edit_customer"){
    $edit_id =mysqli_real_escape_string($DBcon, $_POST['edit_id']);
    $fname = mysqli_real_escape_string($DBcon, $_POST['fname']);
    $lname = mysqli_real_escape_string($DBcon, $_POST['lname']);
    $email = mysqli_real_escape_string($DBcon, $_POST['email']);
    $contact = mysqli_real_escape_string($DBcon, $_POST['contact']);
     
    $query = "UPDATE users_details SET user_fname = '$fname', user_lname ='$lname', user_email='$email',user_contact= '$contact'  WHERE id ='$edit_id'";
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
        $query = "DELETE FROM users_details  WHERE id ='$tbl_id'";
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
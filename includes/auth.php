<?php
 session_start();
 $eid = $_SESSION['username'];
 $user_status  = $_SESSION['status'];
 $user_category = $_SESSION['categorySession'];
if(( $user_status == 0 ) || (!isset($_SESSION["username"])) ) {
  header('location:./../index.php' );
  exit;
}

?>

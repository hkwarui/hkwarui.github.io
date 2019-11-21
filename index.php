<?php
require_once 'includes/Dbconnect.php';
if (isset($_POST['btn-login'])) {

 $username =  trim($_POST['username']);
 $password =  trim($_POST['password']);
 $username = strip_tags($_POST['username']);
 $password = strip_tags($_POST['password']);
 $username = $DBcon->real_escape_string($username);
 $password = $DBcon->real_escape_string($password);
 $pass = sha1($password);

 $query = $DBcon->query("SELECT login_username, login_status, login_category,login_password FROM login_table WHERE login_username ='$username' AND login_password = '$pass' ");
 $row=$query->fetch_array();
 $count = $query->num_rows; // if username/password are correct returns must be 1 row

 if ($count==1) {
    if($row['login_status'] == 1)
      {
        if($row['login_category'] == 0)
          {
             $_SESSION['username'] = $row['login_username'];
             $_SESSION['categorySession'] = $row['login_category'];
             $_SESSION['status'] = $row['login_status'];

             header("Location: staff/home.php");
             exit;
          }
       if($row['login_category'] == 1)
          {
            $_SESSION['username'] = $row['login_username'];
            $_SESSION['categorySession'] = $row['login_category'];
            $_SESSION['status'] = $row['login_status'];
            header("Location: admin/home.php");
            exit;
          }
      }
    if($row['login_status'] == 0)
      {
        $msg = "<div class='alert alert-danger'>
        <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Account is Deactivated!.Contact Admin </div>";
      }
 }
 else {
      $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !</div>";
 }
 $DBcon->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="login-box">
<div class="login-logo">
  <a href=""><img src="./dist/img/hospital.png" alt="Smiley face" height="82" width="82">
  <b style="color: red">LMS</b></a>
</div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Please Sign In</p>
    <form  method="post" id="login-form" class="form-signin">
   <?php
         if(isset($msg)){
         echo $msg; }
         ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Employee Id" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

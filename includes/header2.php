 <?php
     include("Dbconnect.php");
     include("auth.php");

      $user_type = $_SESSION['categorySession'];
      if($user_type != 1)
        {
            header('Location:./../index');
            exit;
        }
        $eid = $_SESSION['username'];
        $query = $DBcon->query("SELECT * FROM users_details WHERE user_code ='$eid'");
        $row=$query->fetch_array();
        $userPicture = !empty($row['user_image'])?$row['user_image']:'no-image.png';
        $user_image_url = '../uploads/'.$userPicture;
 ?>
 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Bus Booking</title>
     <!-- Tell the browser to be responsive to screen width -->
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

     <link rel="stylesheet" type="text/css" href="../dist/css/modal_input/app_style.css">
     <!-- Bootstrap time Picker -->
     <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
     <!-- daterange picker -->
     <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
     <!-- DataTables -->
     <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

     <link rel="shortcut icon" href="../dist/img/bus1.png" type="image/x-icon">
     <!-- bootstrap datepicker -->
     <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
     <!-- Ionicons -->
     <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
     <!-- Theme style -->
     <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
     <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
     <!-- Bootstrap 3.3.7 -->
     <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

     <!-- Google Font -->
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 </head>

 <body class="hold-transition skin-blue sidebar-mini">
     <div class="wrapper">
         <header class="main-header">
             <a href="home.php" class="logo">
                 <span class="logo-mini"><b><img src="../dist/img/bus1.png" alt="Smiley face" height="42"
                             width="42"></b></span>
                 <span class="logo-lg"><img src="../dist/img/bus1.png" alt="Smiley face" height="42" width="42">
                     BBS</b></span>
             </a>
             <nav class="navbar navbar-static-top">
                 <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </a>

                 <div class="navbar-custom-menu">
                     <ul class="nav navbar-nav">
                         <li class="dropdown user user-menu">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                 <img src="<?php echo $user_image_url; ?>" class="user-image" alt="User Image">
                                 <span
                                     class="hidden-xs"><?php echo $row['user_fname']."  ".$row['user_lname']; ?></span>
                             </a>
                             <ul class="dropdown-menu">
                                 <li class="user-header">
                                     <img src="<?php echo $user_image_url; ?>" class="img-circle" alt="User Image">
                                     <p>
                                         <?php echo $row['user_fname']."  ".$row['user_lname']; ?> -
                                         <?php echo $row['user_role'];?>
                                         <small> <?php echo $row['user_since']; ?></small>
                                     </p>
                                 </li>
                                 <li class="user-footer">
                                     <div class="pull-left">
                                         <a href="profile" class="btn btn-default btn-flat">Profile</a>
                                     </div>
                                     <div class="pull-right">
                                         <a href="./../logout.php?logout" class="btn btn-default btn-flat">Sign out</a>
                                     </div>
                                 </li>
                             </ul>
                         </li>
                     </ul>
                 </div>
             </nav>
         </header>
         <aside class="main-sidebar">
             <section class="sidebar">
                 <div class="user-panel">
                     <div class="pull-left image">
                         <img src="<?php echo $user_image_url; ?>" class="img-circle" alt="User Image">
                     </div>
                     <div class="pull-left info">
                         <p><?php echo $row['user_fname']."  ".$row['user_lname']; ?></p>
                         <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                     </div>
                 </div>
                 <ul class="sidebar-menu" data-widget="tree">
                     <li class="header active">MAIN NAVIGATION</li>
                     <li>
                         <a href="home">
                             <i class="fa fa-th"></i> <span>Dashboard</span>
                             <span class="pull-right-container"> </span>
                         </a>
                     </li>

                     <li>
                         <a href="buses">
                             <i class="fa fa-file-o"></i> <span>Buses</span>
                             <span class="pull-right-container"> </span>
                         </a>
                     </li>
                     <li>
                         <a href="bookings">
                             <i class="fa fa-file-o"></i> <span>Bookings</span>
                             <span class="pull-right-container"> </span>
                         </a>
                     </li>
                     <li>
                         <a href="customers">
                             <i class="fa fa-users"></i> <span>customers</span>
                             <span class="pull-right-container"> </span>
                         </a>
                     </li>
                     <li>
                         <a href="drivers">
                             <i class="fa fa-users"></i> <span>Drivers</span>
                             <span class="pull-right-container"> </span>
                         </a>
                     </li>
             </section>
         </aside>

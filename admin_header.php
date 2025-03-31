<?php session_start(); ?>
<html>
<head>
<?php
require_once ('connection.php');
if(isset($_SESSION['username']))
     {
      $username=$_SESSION['username'];
    
     } 
   else{
     echo "<script>
      alert('please login ');
      window.location.href='../index.php';
      
      </script>";
      die();
   }

?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="">
<title></title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- Menu CSS -->
<link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
<!-- animation CSS -->


<!--- jquery-1.11.0 include -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<link href="css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/black.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="fix-sidebar">
<!-- Preloader -->

  <!-- Top Navigation -->
  <nav class="navbar navbar-default navbar-static-top m-b-0; " style="margin-bottom:1px !important "  >
    <div class="navbar-header"  style="background:#273c4d;"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
      <i class="top-left-part" style="background-color:#f2f2f2;" ><a class="logo"  href="#"><b><img src="img/360track_logo.png" style="margin-left:50px; margin-top:10px"  alt="" /></b></a></i>
      <ul class="nav navbar-top-links navbar-left hidden-xs">
        <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"></a></li>
      
      </ul>
       <div  style="float:right !important; padding-right:10px; padding-top:10px;">
       
               <a href="logout.php" type="submit" style="float:right !important;background-color:#f2f2f2;" class="btn btn-block  waves-effect">Log Out</a>
         </div>
        
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
  </nav>

  <!-- End Top Navigation -->
  <!-- Left navbar-header style="background-color:#595959"  -->
 
<div id="myNav" class="overlay">
 
  <div class="overlay-content">
  

  <div class="navbar-default sidebar" role="navigation"  style="background-color:#273c4d;">
     <div class="sidebar-nav navbar-collapse slimscrollsidebar">
       <ul class="nav" id="side-menu" >
        <li class="sidebar-search hidden-sm hidden-md hidden-lg">
          <!-- input-group -->
          <div class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button> </span> 
      </div>
          <!-- /input-group -->
        </li>
        <li class="user-pro"> <a href="#" class="waves-effect"><img src="img/user/default.png" alt="user-img"  class="img-circle"> <span style="color: #ffffff;"> User : <?php echo $username; ?> </span></a>
        </li>
 
      <li class="user-pro"><a href="#" class="waves-effect"> <i class="fa fa-user" style="color:#ffd650;"> </i> <span class="hide-menu"> Administration <span class="fa arrow" style="color:#ffd650;"></span> </span></a>
      <ul class="nav nav-second-level">
          <li><a href="location.php">Locations</a></li>
          
      </ul>
    
       </li>
  
    
    </ul>
    </div>
  </div>
 </div>
 </div>
  <!-- Left navbar-header end -->
   
   <!-- id wrapper--->
   </body>
   </html>
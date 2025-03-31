<?php 
include 'header.php'; 
if (!isset($_SESSION['username'])) {
    echo "<script>window.location.href='../index.php';</script>";
}

$id = $_REQUEST['id'];

$query = "SELECT * FROM `helpcenter` WHERE `id` = '$id';";
$result = mysqli_query($link, $query);

while ($row3 = mysqli_fetch_assoc($result)) {
    $lat = $row3['lat'];
    $lang = $row3['lang'];
    $number = $row3['number'];
}
?>

<!DOCTYPE html>
<html lang="en">
<body class="fix-sidebar">

<div id="wrapper">
  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">Edit Help-Center Location</h4>
        </div>
      </div>
      
      <!-- /row -->
      <div class="row">
        <div class="col-md-12">
          <div class="white-box">
            <div class="row">
              <!-- Tab panes -->
              <div class="col-md-12">
                <form class="form-material form-horizontal" action="help_edit_back.php" method="POST" enctype="multipart/form-data" onsubmit="validateform()">
                  <div class="form-group">
                    <div class="col-md-2">
                      <label for="event_title">Latitude<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-3">
                      <input type="number" value="<?php echo $lat; ?>" class="form-control" placeholder="<?php echo $lat; ?>" id="pass" name="lat" step="0.0000001" required><br>
                    </div>      
                  </div>

                  <input type="hidden" value="<?php echo $id; ?>" name="id">

                  <div class="form-group">
                    <div class="col-md-2">
                      <label for="event_title">Longitude<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-3">
                      <input type="number" value="<?php echo $lang; ?>" class="form-control" placeholder="<?php echo $lang; ?>" id="pass" name="lang" step="0.0000001" required><br>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-2">
                      <label for="event_title">Number<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-3">
                      <input type="number" value="<?php echo $number; ?>" class="form-control" id="r_number" name="number" minlength="9" maxlength="10" placeholder="<?php echo $number; ?>" required><br>
                    </div>
                  </div>

                  <input type="hidden" name="count" value="0">
                  <div class="form-group">
                    <div class="col-md-offset-2 col-md-3">
                      <button type="submit" id="submit" name="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!-- Sweet-Alert  -->
<script src="plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>

<style>
    /* Modern Dashboard Styles */
    .bg-title {
        background: linear-gradient(135deg, #273c4d 0%, #1a2b38 100%);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .page-title {
        color: white;
        font-size: 24px;
        font-weight: 500;
        margin: 0;
    }

    .white-box {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }

    /* Form Enhancements */
    .form-control {
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        padding: 10px 15px;
        height: auto;
        box-shadow: none;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #273c4d;
        box-shadow: 0 0 10px rgba(39, 60, 77, 0.1);
    }

    .form-group label {
        font-weight: 500;
        color: #333;
    }

    .text-danger {
        color: #f44336;
    }

    .btn-success {
        background: #273c4d;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-success:hover {
        background: #1a2b38;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>

</body>
</html>
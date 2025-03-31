<?php 
include 'admin_header.php'; 
if ((isset($_SESSION['username'])) )
	{

	}
	else{
		echo"<script>window.location.href='../index.php';</script>";
		
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
          <h4 class="page-title">Predictions</h4>
        </div>
        </div>
	  
      <!-- /row -->
	   

   <div class="row">
        <div class="col-md-12">
          <div class="white-box">
		      <div class="row">
		  <!-- Nav tabs -->
           
    <!-- Tab panes -->

   <div class="col-md-12">
   <form class="form-material form-horizontal" action="predictions.php" method="POST" enctype="multipart/form-data" onsubmit="validateform()" >
				

<?php


$bin_id = $_REQUEST['bin_id'];

// Query the database for the time occurrences for the selected bin
$sql = "SELECT `time` FROM `sms` WHERE `bin_id` = $bin_id ORDER BY `time` ASC";
$result = $link->query($sql);

// Check if the bin_id exists and has entries
if ($result->num_rows === 0) {
    
    echo "<h2><strong>Prediction cannot be made because there is no data for bin ID: $bin_id.</strong></h2>";
    exit();
}

$timestamps = [];
while ($row = $result->fetch_assoc()) {
    $timestamps[] = (int)$row['time'];
}

// Ensure we have enough data points
if (count($timestamps) < 2) {

    echo "<h2><strong>Not enough data to make a prediction for bin ID: $bin_id</strong></h2>";
    exit();
}

// Simple linear regression function
function linear_regression($x, $y) {
    $n = count($x);
    $mean_x = array_sum($x) / $n;
    $mean_y = array_sum($y) / $n;

    $numerator = 0;
    $denominator = 0;
    for ($i = 0; $i < $n; $numerator += ($x[$i] - $mean_x) * ($y[$i] - $mean_y), $denominator += pow($x[$i] - $mean_x, 2), $i++);

    $slope = $numerator / $denominator;
    $intercept = $mean_y - ($slope * $mean_x);

    return [$slope, $intercept];
}

// Prepare X (independent variable, time intervals) and Y (dependent variable, timestamps)
$x = range(1, count($timestamps));  // X is simply 1, 2, 3, ... based on the number of occurrences
$y = $timestamps;  // Y is the actual timestamps

// Perform linear regression
list($slope, $intercept) = linear_regression($x, $y);

// Predict the next occurrence
$next_x = count($x) + 1;  // Next time step
$predicted_timestamp = $slope * $next_x + $intercept;

// Convert predicted timestamp to a human-readable date
$predicted_date = date('Y-m-d H:i:s', (int)$predicted_timestamp);

echo "<h2><strong>Predicted next full date for bin $bin_id: $predicted_date</strong></h2>";



?>
			
	  <div class="form-group">
            

    
					
	    <div class="form-group" style="margin-left:400px">
	             

			<button type="submit" id="submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10">Back</button>
  
      </div>
	   
	    </form>

              </div>
             </div>
            </div>
          </div>
        </div>
      <!-- /.row -->
   
   

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
<script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="js1/dataTables.buttons.min.js"></script>
<script src="js1/buttons.flash.min.js"></script>
<script src="js1/jszip.min.js"></script>
<script src="js1/pdfmake.min.js"></script>
<script src="js1/vfs_fonts.js"></script>
<script src="js1/buttons.html5.min.js"></script>
<script src="js1/buttons.print.min.js"></script>
<script src="js/jasny-bootstrap.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- end - This is for export functionality only -->

<script>
	
	// Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
      });
      
    jQuery('#date-range').datepicker({
        toggleActive: true
      });
    jQuery('#datepicker-inline').datepicker({
        
        todayHighlight: true
      });

// Daterange picker

$('.input-daterange-datepicker').daterangepicker({
          buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
        });
            $('.input-daterange-timepicker').daterangepicker({
                timePicker: true,
                format: 'MM/DD/YYYY h:mm A',
                timePickerIncrement: 30,
                timePicker12Hour: true,
                timePickerSeconds: false,
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
            });
            $('.input-limit-datepicker').daterangepicker({
                format: 'MM/DD/YYYY',
                minDate: '06/01/2015',
                maxDate: '06/30/2015',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse',
                dateLimit: {
                    days: 6
                }
            });
</script>
  
<!--Style Switcher -->
<script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

</body>
</html>
<?php 
include 'header.php'; 
if (!isset($_SESSION['username'])) {
    echo "<script>window.location.href='../index.php';</script>";
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
      
      <div class="row">
        <div class="col-md-12">
          <div class="white-box">
            <div class="row">

              <div class="col-md-12">
                <form class="form-material form-horizontal" action="predictions.php" method="POST" enctype="multipart/form-data" onsubmit="validateform()">
                  
                  <!-- Site ID Dropdown -->
                  <div class="form-group">
                    <div class="col-md-2">
                      <label for="site_id">Site ID<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" name="site_id" required>
                        <option value="">Select Site ID</option>
                        <?php
                        // Fetching site IDs from the database
                        $site_sql = "SELECT `id` FROM `site`"; // Assuming you have a sites table
                        $site_result = $link->query($site_sql);
                        while ($site_row = $site_result->fetch_assoc()) {
                            echo "<option value='" . $site_row['id'] . "'>" . $site_row['id'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <!-- Alert Type Dropdown -->
                  <div class="form-group">
                    <div class="col-md-2">
                      <label for="alert_type">Alert Type<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" name="alert_type" required>
                        <option value="">Select Alert Type</option>
                        <option value="1">Flood</option>
                        <option value="2">Earthquake</option>
                        <option value="3">Fire</option>
                        <option value="4">Gas Leak</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-3">
                      <button type="submit" id="submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </div>
                  </div>
                </form>
              </div>

              <?php
              if (isset($_POST['submit'])) {
                  $site_id = $_POST['site_id'];
                  $alert_type = $_POST['alert_type'];

                  // Fetch the alert name
                  $alert_names = [
                      1 => 'Flood',
                      2 => 'Earthquake',
                      3 => 'Fire',
                      4 => 'Gas Leak'
                  ];

                  $alert_name = isset($alert_names[$alert_type]) ? $alert_names[$alert_type] : 'Unknown Alert';

                  // Query the database for time occurrences based on site_id and alert_type
                  $sql = "SELECT `time` FROM `sms` WHERE `site_id` = ? AND `alert_type` = ? ORDER BY `time` ASC";
                  $stmt = $link->prepare($sql);
                  $stmt->bind_param("ii", $site_id, $alert_type);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  // Check if the alert type exists and has entries
                  if ($result->num_rows === 0) {
                      echo "<h2><strong>Prediction cannot be made because there is no data for site ID: $site_id and alert type: $alert_name.</strong></h2>";
                      exit();
                  }

                  $timestamps = [];
                  while ($row = $result->fetch_assoc()) {
                      $timestamps[] = (int)$row['time'];
                  }

                  // Ensure we have enough data points
                  if (count($timestamps) < 2) {
                      echo "<h2><strong>Not enough data to make a prediction for site ID: $site_id and alert type: $alert_name</strong></h2>";
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

                  // Get the current timestamp
                  $current_timestamp = time();

                  // Check if the predicted timestamp is in the future
                  if ($predicted_timestamp > $current_timestamp) {
                      // Convert predicted timestamp to a human-readable date
                      $predicted_date = date('Y-m-d H:i:s', (int)$predicted_timestamp);

                      // Display the prediction
                      echo "<h2><strong>Predicted next occurrence date for site ID $site_id and alert type $alert_name: $predicted_date</strong></h2>";
                  } else {
                      echo "<h2><strong>No valid future predictions available for site ID $site_id and alert type $alert_name.</strong></h2>";
                  }
              }
              ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<script src="js/waves.js"></script>
<script src="js/custom.min.js"></script>

<!-- Add the enhanced dropdown animations -->
<script src="js/dropdown-animations.js"></script>

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

    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23273c4d' d='M6 8.825c-.2 0-.4-.1-.5-.2l-3.5-3.5c-.3-.3-.3-.8 0-1.1.3-.3.8-.3 1.1 0l2.9 2.9 2.9-2.9c.3-.3.8-.3 1.1 0 .3.3.3.8 0 1.1l-3.5 3.5c-.1.1-.3.2-.5.2z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 30px;
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

    /* Prediction Result Styling */
    h2 {
        color: #273c4d;
        font-size: 20px;
        margin-top: 30px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 5px solid #273c4d;
    }
    
    /* Enhanced Dropdown Styling */
    .dropdown-menu {
        position: absolute;
        z-index: 1000;
        min-width: 180px;
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        background: white;
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
</style>
</body>
</html>

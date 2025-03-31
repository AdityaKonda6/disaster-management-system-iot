<?php include 'header.php'; ?>
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

    /* Table Enhancements */
    .table-responsive {
        border-radius: 10px;
        overflow: hidden !important;
    }

    #myTable {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    #myTable thead th {
        background: #273c4d;
        color: white;
        padding: 15px;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        border: none;
    }

    #myTable tbody tr {
        transition: all 0.3s ease;
    }

    #myTable tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }

    /* Alert Type Styles */
    .alert-type {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 500;
        display: inline-block;
    }

    .alert-flood {
        background: #e3f2fd;
        color: #1976d2;
    }

    .alert-earthquake {
        background: #fff3e0;
        color: #e65100;
    }

    .alert-fire {
        background: #ffebee;
        color: #c62828;
    }

    .alert-gas {
        background: #f9fbe7;
        color: #827717;
    }

    /* Action Button Styling */
    .action-btn {
        display: inline-block;
        background: #273c4d;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
        color: white;
        font-weight: 500;
        margin-right: 5px;
        text-decoration: none;
    }

    .action-btn:hover {
        background: #1a2b38;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: white;
        text-decoration: none;
    }
    
    .btn-map {
        background: #3498db;
    }
    
    .btn-map:hover {
        background: #2980b9;
    }
</style>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <h4 class="page-title">
                    <i class="fas fa-bell me-2"></i> All Alerts
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Alert Type</th>
                                    <th>SMS Sent</th>
                                    <th>Site ID</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM `sms`";
                            $result = mysqli_query($link,$query);

                            while($row3 = mysqli_fetch_assoc($result)) {
                                $alertClass = '';
                                
                                if($row3['alert_type']=="1") {
                                    $alert = "Flood";
                                    $alertClass = 'alert-flood';
                                }
                                if($row3['alert_type']=="2") {
                                    $alert = "Earthquake";
                                    $alertClass = 'alert-earthquake';
                                }
                                if($row3['alert_type']=="3") {
                                    $alert = "Fire";
                                    $alertClass = 'alert-fire';
                                }
                                if($row3['alert_type']=="4") {
                                    $alert = "Gas leak";
                                    $alertClass = 'alert-gas';
                                }
                                
                                $date = date("Y-m-d H:i:s", $row3['time']);
                            ?>
                                <tr>
                                    <td><span class="alert-type <?php echo $alertClass; ?>"><?php echo $alert; ?></span></td>
                                    <td><?php echo $row3['number']; ?></td>
                                    <td><?php echo $row3['site_id']; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <!-- Replace dropdown with individual button -->
                                    <td>
                                        <a href="map.php?id=<?php echo $row3['site_id'];?>" class="action-btn btn-map">
                                            <i class="fas fa-map-marker-alt"></i> View Map
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
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
<script src="js/waves.js"></script>
<script src="js/custom.min.js"></script>
<script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>

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
        margin-bottom: 5px;
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
    
    .btn-edit {
        background: #2ecc71;
    }
    
    .btn-map:hover {
        background: #2980b9;
    }
    
    .btn-edit:hover {
        background: #27ae60;
    }
</style>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <h4 class="page-title">
                    <i class="fa-solid fa-location-dot me-2"></i> All Location List
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
                                    <th>ID</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM `site`";
                                $result = mysqli_query($link,$query);

                                while($row3 = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row3['id']}</td>";
                                    echo "<td>{$row3['lat']}</td>";
                                    echo "<td>{$row3['lang']}</td>";
                                    ?>
                                    <!-- Replace dropdown with individual buttons -->
                                    <td>
                                        <a href="map.php?id=<?php echo $row3['id'];?>" class="action-btn btn-map">
                                            <i class="fas fa-map-marker-alt"></i> View Map
                                        </a>
                                        <a href="edit.php?id=<?php echo $row3['id'];?>" class="action-btn btn-edit">
                                            <i class="fas fa-edit"></i> Edit Location
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
<script src="js/jquery.slimscroll.js"></script>
<script src="js/waves.js"></script>
<script src="js/custom.min.js"></script>
<script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
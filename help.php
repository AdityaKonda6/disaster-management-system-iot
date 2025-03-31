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

    /* Button Styling */
    .btn {
        background: #273c4d;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
        color: white;
        font-weight: 500;
        margin-right: 5px;
    }

    .btn:hover {
        background: #1a2b38;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    /* Action buttons */
    .action-btn {
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
    }
    
    .btn-view {
        background: #3498db;
    }
    
    .btn-edit {
        background: #2ecc71;
    }
    
    .btn-view:hover {
        background: #2980b9;
    }
    
    .btn-edit:hover {
        background: #27ae60;
    }
</style>

<?php
$username = $_SESSION['username'];

$query = "SELECT * FROM `user` WHERE username = '$username'";
$result = mysqli_query($link,$query);

while( $row3 = mysqli_fetch_assoc( $result ) ) {
    $user_id = $row3['id'];
}

require_once('connection.php');
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <h4 class="page-title">All Help-Center list</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <div class="table-responsive" style="overflow-x: hidden;">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Lattitude</th>
                                    <th>Longitude</th>
                                    <th>Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
        

<?php
       $query = "SELECT * FROM `helpcenter`";
       $result = mysqli_query($link,$query);

                  while( $row3 = mysqli_fetch_assoc( $result ) )
                      {

                  
                      
                        echo"<tr><td>{$row3['id']}</td>";
                        echo"<td>{$row3['lat']}</td>";
                        echo"<td>{$row3['lang']}</td>";
                        echo"<td>{$row3['number']}</td>";
                                                 
                      ?>  
      
          
         <td>
            <!-- Replace dropdown with individual buttons -->
            <a href="help_map.php?id=<?php echo $row3['id'];?>" class="btn btn-view action-btn">
                <i class="fas fa-map-marker-alt"></i> View Map
            </a>
            <a href="help_edit.php?id=<?php echo $row3['id'];?>" class="btn btn-edit action-btn">
                <i class="fas fa-edit"></i> Edit Location
            </a>
         </td></tr>
                
              <?php
           }
          ?>

              
              </tbody>
            </table>
      <br>
      <br>
      <br>
      <br>
            </div>
          </div>
        </div>
        
      
      </div>
                </div>
                
                <div class="clearfix"></div>
        
              </div>
             
              
             
            </div>
          </div>
        
        </div>
      <!-- /.row -->
   
   
    </div>
    <!-- /.container-fluid -->
    
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
<script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="js1/dataTables.buttons.min.js"></script>
<script src="js1/buttons.flash.min.js"></script>
<script src="js1/jszip.min.js"></script>
<script src="js1/pdfmake.min.js"></script>
<script src="js1/vfs_fonts.js"></script>
<script src="js1/buttons.html5.min.js"></script>
<script src="js1/buttons.print.min.js"></script>

<!-- Date Picker Plugin JavaScript -->
<script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="../plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="../plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- end - This is for export functionality only -->

<script>
    $(document).ready(function(){
      $('#myTable').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "columnDefs": [
          { "visible": false, "targets": 2 }
          ],
          "order": [[ 2, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

                last = group;
              }
            } );
          }
        } );

    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
        table.order( [ 2, 'desc' ] ).draw();
      }
      else {
        table.order( [ 2, 'asc' ] ).draw();
      }
    });
  });
    });
    $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
  
  
// Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose1').datepicker({
        autoclose: true,
        todayHighlight: true
      });
      
    jQuery('#date-range').datepicker({
        toggleActive: true
      });
    jQuery('#datepicker-inline').datepicker({
        
        todayHighlight: true
      });
    
  // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose2').datepicker({
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


 <script>
  
  function ask(c_id)
  { 


    var id=student_id;

    if(confirm("Please Confirm to Delete Customer"))
    {
      window.location.href='delete_student.php?student_id='+id;
      return true;
    }
  
  }
   
  </script>


<!--Style Switcher -->
<script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

</body>
</html>
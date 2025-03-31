<?php


  include "connection.php";
  
  $id = $_REQUEST['id'];

            


               $sql="DELETE FROM `police` WHERE id = '$id'; ";
            
              if(mysqli_query($link, $sql))
                {

                  echo"<script> alert('Data deleted') </script>";
                  echo '<script>window.location.href = "admin_dashboard.php";</script>';

                }
           
          else{
              echo "ERROR: Could not able to execute $sql. ";
          }
          

  
  
   mysqli_close($link);
?>
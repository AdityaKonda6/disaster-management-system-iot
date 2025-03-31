<?php


  include "connection.php";
  
  $id = $_REQUEST['id'];

            


               $sql="DELETE FROM `sms` WHERE id = '$id'; ";
            
              if(mysqli_query($link, $sql))
                {

                  echo"<script> alert('Data deleted') </script>";
                  echo '<script>window.location.href = "user_dashboard.php";</script>';

                }
           
          else{
              echo "ERROR: Could not able to execute $sql. ";
          }
          

  
  
   mysqli_close($link);
?>
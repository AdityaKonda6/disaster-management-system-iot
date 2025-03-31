<?php

include "connection.php";

$lat=$_REQUEST['lat'];
$lang=$_REQUEST['lang'];
$d_number=$_REQUEST['d_number'];

          
            
        $sql="INSERT INTO `vehicle`(`lat`, `lang`, `number`)  VALUES ('$lat','$lang','$d_number')";

            
        if(mysqli_query($link, $sql))
          {

                  echo"<script> alert('vehicle added') </script>";
                  echo '<script>window.location.href = "user_dashboard.php";</script>';
           
          } else{
              echo "ERROR: Could not able to execute $sql. ";
          }
   mysqli_close($link);
?>
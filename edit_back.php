<?php

include "connection.php";

$lat=$_REQUEST['lat'];
$lang=$_REQUEST['lang'];
$d_number=$_REQUEST['number'];
$id=$_REQUEST['id'];

          
            
        $sql="UPDATE `site` SET `lat`='$lat',`lang`='$lang' WHERE id='$id'";                                       

            
        if(mysqli_query($link, $sql))
          {

                  echo"<script> alert('Location updated') </script>";
                  echo '<script>window.location.href = "van.php";</script>';
           
          } else{
              echo "ERROR: Could not able to execute $sql. ";
          }
   mysqli_close($link);
?>
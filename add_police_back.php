<?php

include "connection.php";

$location=$_REQUEST['location'];
$lat=$_REQUEST['lat'];
$lang=$_REQUEST['lang'];
$number=$_REQUEST['number'];


$query7 = "SELECT * FROM `police` WHERE `number` = '$number'";
$result = $link->query($query7);

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0)
{

                  echo"<script> alert('number already added') </script>";
                  echo '<script>window.location.href = "add_police.php";</script>';
                  die();

}else
{

          
            
        $sql="INSERT INTO `police`(`location`, `lat`, `lang`, `number`) VALUES ('$location','$lat','$lang','$number')";

            
        if(mysqli_query($link, $sql))
          {

                  echo"<script> alert('Data added') </script>";
                  echo '<script>window.location.href = "admin_dashboard.php";</script>';
           
          } else{
              echo "ERROR: Could not able to execute $sql. ";
          }
          

  }
  
   mysqli_close($link);
?>
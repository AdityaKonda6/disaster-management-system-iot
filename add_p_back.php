<?php


  include "connection.php";



             $name=$_REQUEST['name'];
             $date=$_REQUEST['date'];
             $email=$_REQUEST['email'];
             $address=$_REQUEST['address'];
             $username=$_REQUEST['username'];
             $password=$_REQUEST['password'];
             $phone=$_REQUEST['phone'];

          
            
        $sql="INSERT INTO `p_data`(`name`, `date`, `phone`, `address`, `email`, `username`, `pass`) VALUES ('$name','$date','$phone','$address','$email','$username','$password')";
            
        if(mysqli_query($link, $sql))
          {

                  echo"<script> alert('Data added') </script>";
                  echo '<script>window.location.href = "add_police.php";</script>';
           
          } else{
              echo "ERROR: Could not able to execute $sql. ";
          }
          

  
  
   mysqli_close($link);
?>
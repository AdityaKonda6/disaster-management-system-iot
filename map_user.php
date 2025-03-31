<?php
// Specify the URL you want to redirect to
 require_once('connection.php');

$id = $_REQUEST['id'];

       $query = "SELECT * FROM `locations` WHERE id = $id";
       $result = mysqli_query($link,$query);

                  while( $row3 = mysqli_fetch_assoc( $result ) )
                      {
                      
                        $data = $row3['lat'].",".$row3['lang'];

}

$redirectUrl = 'https://maps.google.com/?q='.$data;

// Perform the redirection
header("Location: $redirectUrl");
exit;
?>
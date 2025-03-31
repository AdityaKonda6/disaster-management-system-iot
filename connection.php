<?php
$server = "sql304.infinityfree.com";  // Your MySQL Host
$user = "if0_38642133";  // Your MySQL Username
$password = "Adityakonda2003";  // Your MySQL Password
$db = "if0_38642133_disaster";  // Your Database Name
$port = 3306;  // Default MySQL Port

$link = mysqli_connect($server, $user, $password, $db, $port);

if (!$link) {
    echo "<script>
        alert('Unable to connect to Database. Contact your Administrator.');
        window.location.href='index.php';
    </script>";
    die();
} 

date_default_timezone_set("Asia/Kolkata");
?>

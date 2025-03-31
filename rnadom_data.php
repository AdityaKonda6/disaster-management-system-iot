<?php
// Database connection details
include "connection.php";

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fixed phone number
$phone_number = '97691956423';

// Insert 300 times
for ($i = 0; $i < 300; $i++) {
    // Generate a random UNIX timestamp from one year ago to today
    $start = strtotime("-1 year");
    $end = time();
    $random_time = rand($start, $end);

    // Generate a random bin ID between 1 and 5
    $bin_id = rand(1, 5);

    // Insert query
    $sql = "INSERT INTO sms (`time`, `number`, `bin_id`) VALUES ($random_time, '$phone_number', $bin_id)";

    // Execute the query
    if ($link->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

echo "300 records inserted successfully.";

// Close connection
$conn->close();
?>
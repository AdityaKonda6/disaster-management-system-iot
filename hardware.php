<?php
require_once('connection.php');

// Function to calculate distance between two lat-long coordinates
function getDistance($lat1, $lng1, $lat2, $lng2) {
    $earthRadius = 6371000; // Radius of Earth in meters

    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);

    $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) * sin($dLng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c;
    return $distance; // Returns distance in meters
}

// Function to send SMS using Fast2SMS API
function sendSMS($number, $message) {
    $fields = array(
        "message" => $message,
        "language" => "english",
        "route" => "q",
        "numbers" => "$number",
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => array(
            "authorization: wRHelMmsy7z4SinDU083ObKJVCBk5Z1XvuPYrfGxghFpAcTa6LAGIhk3YKXvdMnCuFa2xLt1wfSRZcb",  // Replace with your Fast2SMS API Key
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
        return false;
    } else {
        return $response;
    }
}

// Sample data received from gate request (e.g., 0@1@0@1@1)
$alertData = $_REQUEST['id'];

// Split the string to get alert values and site ID
$alertParts = explode('@', $alertData);
$earthquakeAlert = $alertParts[0];
$moistureAlert = $alertParts[1];
$gasAlert = $alertParts[2];
$temperatureAlert = $alertParts[3];
$site_id = $alertParts[4]; // Extract site ID

// Get site location from the 'site' table
$siteQuery = "SELECT `lat`, `lang` FROM `site` WHERE `id` = $site_id";
$siteResult = mysqli_query($link, $siteQuery);
$siteRow = mysqli_fetch_assoc($siteResult);
$siteLat = $siteRow['lat'];
$siteLng = $siteRow['lang'];

// Get all help center locations
$helpCentersQuery = "SELECT `id`, `lat`, `lang`, `number` FROM `helpcenter`";
$helpCentersResult = mysqli_query($link, $helpCentersQuery);

// Initialize variables to track nearest help center
$nearestHelpCenterId = null;
$nearestDistance = PHP_INT_MAX;
$nearestHelpCenterNumber = "";

// Loop through all help centers and calculate distance
while ($row = mysqli_fetch_assoc($helpCentersResult)) {
    $helpLat = $row['lat'];
    $helpLng = $row['lang'];
    $helpNumber = $row['number'];

    // Calculate distance between the site and the help center
    $distance = getDistance($siteLat, $siteLng, $helpLat, $helpLng);

    // Check if this is the nearest help center so far
    if ($distance < $nearestDistance) {
        $nearestDistance = $distance;
        $nearestHelpCenterId = $row['id'];
        $nearestHelpCenterNumber = $helpNumber;
    }
}

// Check if any alert is set to 1 and send a message with custom text and Google Maps URL
$alerts = [
    'earthquake' => $earthquakeAlert,
    'moisture' => $moistureAlert,
    'gas' => $gasAlert,
    'temperature' => $temperatureAlert
];

$alertMessages = [
    'earthquake' => "Earthquake detected.",
    'moisture' => "High moisture levels detected.",
    'gas' => "Gas leak detected.",
    'temperature' => "High temperature detected."
];

// Alert type mapping to numbers
$alertTypeMapping = [
    'earthquake' => 1,
    'moisture' => 2,
    'gas' => 3,
    'temperature' => 4
];

// Send a message and insert data for each alert that is set to 1
foreach ($alerts as $alert => $value) {
    if ($value == 1) {
        // Custom message for the alert
        $alertMessage = "ALERT: " . $alertMessages[$alert] . " Location: https://www.google.com/maps?q=$siteLat,$siteLng";
        
        // Send SMS to the nearest help center
        if ($nearestHelpCenterId !== null) {
            $smsResponse = sendSMS($nearestHelpCenterNumber, $alertMessage);
            
            $alertType = $alertTypeMapping[$alert];  // Get the numeric value for the alert
            $insertQuery = "INSERT INTO `sms` (`time`, `number`, `site_id`, `alert_type`) VALUES (UNIX_TIMESTAMP(), '$nearestHelpCenterNumber', '$site_id', '$alertType')";

            if ($smsResponse) {
                echo "SMS sent successfully for $alert alert to help center ID: $nearestHelpCenterId, Number: $nearestHelpCenterNumber\n";
                echo "SMS Content: $alertMessage\n";
                
                // Insert alert data into the `sms` table
               
                
                if (mysqli_query($link, $insertQuery)) {
                    echo "Alert data for $alert inserted into `sms` table successfully.\n";
                } else {
                    echo "Failed to insert alert data for $alert: " . mysqli_error($link) . "\n";
                }
            } else {
                echo "Failed to send SMS for $alert alert.\n";
            }
        } else {
            echo "No help center found for $alert alert.\n";
        }
    }
}
?>

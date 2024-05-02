<?php
// Get the JSON data from the request
$data = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($data, true);

// Log file path
$logFile = 'general.log';

// Write the data to the log file
file_put_contents($logFile, json_encode($data) . PHP_EOL, FILE_APPEND);

// Send a response
echo 'Logged successfully';
?>
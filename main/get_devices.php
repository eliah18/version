<?php
// Get config file
require("conn.php"); 

// Get and sanitize the country ID from the GET request.
$branchId = filter_input(INPUT_GET, "branch_code", FILTER_SANITIZE_STRING);

// Check if the countryId is empty after sanitization.
if (empty($branchId)) {
  die("Invalid branch code.");
}

// Create the SQL query to retrieve states based on the country ID.
$sql = "SELECT  Device_id FROM `all_devices` WHERE Branch ='$branchId'";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$devices = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($devices);

// Close the database connection.
mysqli_close($connection);
?>

<?php
// Get config file
require("conn.php"); 

// Get and sanitize the country ID from the GET request.
$companyId = filter_input(INPUT_GET, "company_code", FILTER_SANITIZE_STRING);

// Check if the countryId is empty after sanitization.
if (empty($companyId)) {
  die("Invalid company code.");
}

// Create the SQL query to retrieve states based on the country ID.
$sql = "SELECT DISTINCT Branch FROM `all_devices` WHERE Company_code ='$companyId'";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);

// Close the database connection.
mysqli_close($connection);
?>

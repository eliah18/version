<?php
// Get config file
require("conn.php"); 
// Get and sanitize the country ID from the GET request.
$companycode = filter_input(INPUT_GET, "company_code", FILTER_SANITIZE_STRING);
$companybranch = filter_input(INPUT_GET, "branch_code", FILTER_SANITIZE_STRING);
$postfromdate = filter_input(INPUT_GET, "fromdate", FILTER_SANITIZE_STRING);
$posttodate = filter_input(INPUT_GET, "todate", FILTER_SANITIZE_STRING);
if(isset($companycode) && isset($companybranch) && isset($postfromdate) && isset($posttodate) ){
    $Company = $companycode;
    $Branch = $companybranch;
    $time=strtotime($postfromdate);
   
    $fromdate = $postfromdate;
    $todate = $posttodate;
// Check if the countryId is empty after sanitization.
if (empty($Company)) {
  die("Invalid company code.");
}
if($Company == '02'){
// Create the SQL query to retrieve states based on the country ID.
$sql = "call after_hours_Branch('$Company','$fromdate','$todate','$Branch')";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);
}
else if($Company == '01'){
// Create the SQL query to retrieve states based on the country ID.
$sql = "call afterhours_ZETDC_Branch('$Company','$fromdate','$todate','$Branch')";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);
}
// Close the database connection.
mysqli_close($connection);	
}
?>
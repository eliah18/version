<?php
// Get config file
require("conn.php"); 

// Get and sanitize the country ID from the GET request.
$companycode = filter_input(INPUT_GET, "company_code", FILTER_SANITIZE_STRING);
$companybranch = filter_input(INPUT_GET, "branch_code", FILTER_SANITIZE_STRING);
$postfromdate = filter_input(INPUT_GET, "fromdate", FILTER_SANITIZE_STRING);
if(isset($companycode) && isset($companybranch) && isset($postfromdate) ){
    $Company = $companycode;
    $Branch = $companybranch;
    $time=strtotime($postfromdate);
$month=date("F",$time);
$year=date("Y",$time);
// Check if the countryId is empty after sanitization.
if (empty($Company)) {
  die("Invalid company code.");
}

  if($month == "January"){
    
   // Create the SQL query to retrieve states based on the country ID.
$sql = "call sp_weekend_Branch('$Company','$Branch')";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);

   }
 
  else if($month == "February" ){
       
   // Create the SQL query to retrieve states based on the country ID.
$sql = "call sp_weekend_FEB_Branch('$Company','$Branch')";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);
   }
 
   else if($month == "March"){
         
  // Create the SQL query to retrieve states based on the country ID.
$sql = "call sp_weekend_Mar_Branch('$Company','$Branch')";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);
    }
    
   else  if($month == "April" ){
         
  // Create the SQL query to retrieve states based on the country ID.
$sql = "call sp_weekend_Apr_Branch('$Company','$Branch')";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);
     }
    
    else  if($month == "May" ){
  // Create the SQL query to retrieve states based on the country ID.
$sql = "call sp_weekend_May('$Company','$Branch')";

// Execute the query.
$result = mysqli_query($connection, $sql);

// Convert the result set to an array.
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Echo the JSON response.
echo json_encode($branches);
      }
    
   else    if($month == "June" ){
  // Create the SQL query to retrieve states based on the country ID.
$sql = "call sp_weekend_June('$Company','$Branch')";

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
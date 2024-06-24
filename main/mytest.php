<?php
include "conn.php";
ob_start();
session_start();
/* $array2 = array( 9912, 8526, 8537 );


$string = serialize( $array2 );
$_SESSION['Objects']=unserialize( $string );

$formatted_array = json_encode($_SESSION['Objects']);

 //echo $formatted_array;

$array1 = [9912, 8526, 8537];
 
// Serialize the array
$array3 = json_encode($array2);

$array []= $_SESSION['Objects'];
$formatted_array = array_values($array[0]);
print_r($formatted_array);
$delimiter = ', ';
 $arrayString = implode($delimiter,$formatted_array);
 echo  $arrayString;
$loc = str_replace('[','(',$arrayString);
echo $loc ;
$loc2 = str_replace(']',')',$loc);
echo$loc2; */
// Insert the serialized array into the database
$formatted_array = array(8399, 8410);

$delimiter = ', ';
$arrayString = implode($delimiter,$formatted_array);
echo $arrayString;
$FleetMatrixBranch=[];
$mydevices='1 and  b.Device_id in (8399, 8410)';

$sqler = "'SELECT x.Branch,
FORMAT(SUM(CASE WHEN x.Category = ''Fleet Size'' THEN x.FleetSize ELSE 0 END), 0, ''en_US'') AS ''Fleet Size'',
FORMAT(SUM(CASE WHEN x.Category = ''Total Mileage'' THEN x.FleetSize ELSE 0 END), 0, ''en_US'') AS ''Total Mileage'',
FORMAT(SUM(CASE WHEN x.Category = ''After Hours (km)'' THEN x.FleetSize ELSE 0 END), 0, ''en_US'') AS ''After Hours (km)''
FROM
(SELECT COUNT(a.Device_id) AS FleetSize, b.Branch, ''Fleet Size'' AS Category
FROM
    (SELECT Device_id FROM all_devices) a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = @Company AND b.Device_id IN ($arrayString)
GROUP BY
    b.Branch

UNION

SELECT SUM(a.Distance) AS TotalMileage, b.Branch, ''Total Mileage'' AS Category
FROM
    (SELECT device_id, SUM(distance) AS Distance
    FROM travel_sheet
    WHERE date >= @FROMDATE AND date <= @TODATE
    GROUP BY device_id) a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = @Company AND b.Device_id IN ($arrayString)
GROUP BY
    b.Branch

UNION

SELECT SUM(e.Distance) AS AfterHoursDistance, e.Branch, ''After Hours (km)'' AS Category
FROM
    (SELECT
        b.Branch,
        FORMAT(SUM(a.distance), 0) AS Distance
    FROM
        (SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= @FROMDATE AND date <= @TODATE) a
    JOIN
        all_devices b ON a.device_id = b.Device_id
    WHERE
        b.Company_code = @Company AND b.Device_id IN ($arrayString) AND a.distance > 1
    GROUP BY
        b.Branch) e
GROUP BY
    e.Branch) x
GROUP BY
x.Branch'";
$fetch_query_run = mysqli_query($connection,$sqler);
if(mysqli_num_rows($fetch_query_run) > 0){
    while($rowz = mysqli_fetch_array($fetch_query_run)){
        $FleetMatrixBranch[] =$rowz;
      
    }
    print_r($FleetMatrixBranch);
}
else{
    echo "Error: ".$sqler."<br>".mysqli_error($connection);
}
// $sql = "SELECT `Objects` FROM `users` where email ='tetet@gmail.com'";
// $fetch_query_run = mysqli_query($connection,$sql);
// if(mysqli_num_rows($fetch_query_run) > 0){
//     while($row = mysqli_fetch_array($fetch_query_run)){
//         $_SESSION['Objects']=unserialize( $row['Objects'] );
//        echo $row['Objects'];
//     }
// }
// else{
//     echo '<h4>No record found</h4>';
// }
// $array=[];
// if(isset($_SESSION['Objects'])){$array=$_SESSION['Objects'];}
// $formatted_array = array_values($array[0]);

//  $delimiter = ', ';
//  $arrayString = implode($delimiter,$formatted_array);
//  echo $arrayString;
// // Insert the serialized array into the database
// $sql = "SELECT DISTINCT `branch` FROM `Objects` where device_id in  ($arrayString)";
// $fetch_query_run = mysqli_query($connection,$sql);
// if(mysqli_num_rows($fetch_query_run) > 0){
//     while($row = mysqli_fetch_array($fetch_query_run)){
       
//        echo $row['branch'];
//     }
// }
// else{
//     echo '<h4>No record found</h4>';
// }
// // Close the connection
// mysqli_close($connection);

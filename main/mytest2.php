<?php
include "conn.php";
ob_start();
session_start();
if(isset($_SESSION['Company_code']) && isset($_SESSION['myobjects']) && isset($_SESSION['fromdate']) && isset($_SESSION['todate']) ){
   
    $array=[];
    if(isset($_SESSION['myobjects'])){$array=$_SESSION['myobjects'];}
    $formatted_array = array_values($array);
    
     $delimiter = ', ';
     $arrayString = implode($delimiter,$formatted_array);
     echo '('.$arrayString.')';
   


}
?>
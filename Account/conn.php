<?php
//retrive data from database code
$DBHOST='localhost';
$dbuser='root';
$dbpass='';
$dbname='bantu_reports';
$connection= new mysqli($DBHOST,$dbuser,$dbpass,$dbname);
if(!$connection)
{die ('Could not connect: ' . mysqli_error());}


?>
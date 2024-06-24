<?php 
session_start();
 include "conn.php";
 if(isset($_SESSION['access']) && $_SESSION['username'] &&  $_SESSION['access']=="1") { 
     $date = date('d-m-Y');
	 date_default_timezone_set('Africa/Harare');
     $time=date("H:i:s");

	 
unset($_SESSION['username']);
unset($_SESSION['access']);


session_unset();
session_destroy();

header("location:../Account/index.php");
 }
else{header('location:../Account/index.php');} ?>
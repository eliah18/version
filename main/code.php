<?php 
include "conn.php";
ob_start();
session_start();
if(isset($_SESSION['access']) && isset($_SESSION['username']) && isset($_SESSION['useraccess']) && isset($_SESSION['Objects']) && isset($_SESSION['Company_code']) &&  $_SESSION['access']=='1' ) { 
if(isset($_POST['click_edit_btn'])){
    $useremail = $_POST['user_email'];
    $arrayresult = [];
    
    $fetch_query = "SELECT `userID`, `email`,  `phone`, `level`, `Status`, `company`,  `Objects` FROM `users` where email = '$useremail'";
    $fetch_query_run = mysqli_query($connection,$fetch_query);
    if(mysqli_num_rows($fetch_query_run) > 0){
        while($row = mysqli_fetch_array($fetch_query_run)){
            $_SESSION['userobjects']=unserialize($row['Objects']);
            $_SESSION['usercompany']=$row['company'];
            $_SESSION['userlevel']=$row['level'];
            array_push($arrayresult,$row);
            header('content-type: application/json');
            echo json_encode($arrayresult);
        }
    }
    else{
        echo '<h4>No record found</h4>';
    }
   
}
if(isset($_POST['click_getsession_btn'])){
    $useremail = $_POST['user_email'];
    $sql = "SELECT  `email`,  `phone`, `level`, `Status`, `company`,  `Objects` FROM `users` where email = '$useremail'";
    $query = $connection->query($sql);

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc())
        {
            $_SESSION['userobjects']=unserialize($row['Objects']);
            $_SESSION['usercompany']=$row['company'];
            $_SESSION['userlevel']=$row['level'];
             
        }
       
    }
}
if(isset($_POST['btnUpdate'])){
    
    $Email = $_POST["editemail"];
    $Phone = $_POST["editphone_number"];
    $Company = $_POST["editcompany_code"];
    $objects[] = $_POST["editobjects"];
    $stringobjects = serialize($objects);
    $Access = $_POST["editaccess_level"];
    $userID = $_POST["userID"];
  
    $query="UPDATE `users` SET `email`='$Email',`phone`='$Phone',`level`='$Access',`company`='$Company',`Objects`='$stringobjects' WHERE `userID`='$userID'
      ";
  if($connection-> query($query))
  {
      echo ("<script> alert('User updated Successful');window.location='users.php';</script>");
     
  }
}
if(isset($_POST['btnUpdate3'])){
    $objects[] = $_POST["editobjects"];
    $stringobjects = serialize($objects);
    echo  strlen($stringobjects);
   }

}
?>
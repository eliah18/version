<?php  
include("database.php");
error_reporting(0);
ob_start();
session_start(); 
if(isset($_SESSION['Company_code']) && isset($_SESSION['myobjects']) && isset($_SESSION['fromdate']) && isset($_SESSION['todate']) ){
  $array=[];
  if(isset($_SESSION['myobjects'])){$array=$_SESSION['myobjects'];}
  $formatted_array = array_values($array);
  
   $delimiter = ', ';
   $arrayString = implode($delimiter,$formatted_array);
   

$time=strtotime($_SESSION["fromdate"]);
$month=date("F",$time);
$year=date("Y",$time);
$_SESSION['Month'] = date("F",$time);
$FleetBranch = array();
$FleetMatrixBranch = array();

$Speed_Branch = array();

$NightDriving_Branch = array();
$ZETDCNightDriving_Branch = array();
$ZETDC = array();
$Weekend= array();
$MyCompany='';
$_SESSION['Company']=$_SESSION["Company_code"];
$_SESSION['From']=$_SESSION["fromdate"];
$_SESSION['To']=$_SESSION["todate"];
$_SESSION['branch']=$_SESSION["myobjects"];
$Company = $_SESSION['Company_code'];
$fromdate =$_SESSION['From'];
$todate =$_SESSION['To'];



$dateFrom = $fromdate;
$dateFr = DateTime::createFromFormat("Y-m-d", $dateFrom);
$formDate = $dateFr->format("d F, Y");
$_SESSION['Daterange1']=$formDate;
$dateTo = $todate;
$dateTOr = DateTime::createFromFormat("Y-m-d", $dateTo);
$forDate = $dateTOr->format("d F, Y");
$_SESSION['Daterange2']=$forDate;
$hours="";



   
if($_SESSION['Company_code'] == '02'){
    
    $_SESSION['myCompany']='ALLIED TIMBERS';
    if ($Company != "" && $Branch != 'all')
   {
   if($Company != ""){

        
  $sqli="call perfom_matrix_branch('$Company','$fromdate','$todate','$arrayString')";
    if ($matrix= mysqli_query($con,$sqli)){
      do{
        if($matrix != ""){
     
          while ($res= mysqli_fetch_assoc($matrix) ){
            
          $FleetMatrixBranch[]=$res;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    
  
    if( !empty($FleetMatrixBranch)) {
       
         $sqlizbr="call after_hours_Bra('$Company','$fromdate','$todate','$arrayString')";
    if ($NightBranch= mysqli_query($con,$sqlizbr)){
      do{
        if($NightBranch != ""){
     
          while ($reztBranch= mysqli_fetch_assoc($NightBranch) ){
            
          $NightDriving_Branch[]=$reztBranch;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    
    }
     $sqlBr02="call OverSpeeding_Bra('$Company','$fromdate','$todate','$arrayString')";
    if ($speedingBranch02= mysqli_query($con,$sqlBr02)){
      do{
        if($speedingBranch02 != ""){
     
          while ($rezbr02= mysqli_fetch_assoc($speedingBranch02) ){
            
          $Speed_Branch[]=$rezbr02;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    if( !empty($FleetMatrixBranch)  || !empty($NightDriving_Branch) ) {
        
        if($month == "January"){
             $sql="call Fleet_Size_Branch_Jan('$Company','$fromdate','$todate','$arrayString')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sqliJ="call sp_weekend_Branch('$Company','$Branch')";
    if ($BrjAN= mysqli_query($con,$sqliJ)){
      do{
        if($BrjAN != ""){
     
          while ($rezjAN= mysqli_fetch_assoc($BrjAN) ){
            
          $Weekend[]=$rezjAN;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
 
  else if($month == "February" ){
       $sql="call Fleet_Size_Branch_Feb('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sqliy="call sp_weekend_FEB_Branch('$Company','$Branch')";
    if ($BrFeb= mysqli_query($con,$sqliy)){
      do{
        if($BrFeb != ""){
     
          while ($rezFeb= mysqli_fetch_assoc($BrFeb) ){
            
          $Weekend[]=$rezFeb;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
 
   else if($month == "March"){
        $sql="call Fleet_Size_Branch_Mar('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sqliF="call sp_weekend_Mar_Branch('$Company','$Branch')";
    if ($BrMar= mysqli_query($con,$sqliF)){
      do{
        if($BrMar != ""){
     
          while ($rezMar= mysqli_fetch_assoc($BrMar) ){
            
          $Weekend[]=$rezMar;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    }
    
   else  if($month == "April" ){
        $sql="call Fleet_Size_Branch_Apr('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sqliAp="call sp_weekend_Apr_Branch('$Company','$Branch')";
    if ($brApr= mysqli_query($con,$sqliAp)){
      do{
        if($brApr != ""){
     
          while ($rezApr= mysqli_fetch_assoc($brApr) ){
            
          $Weekend[]=$rezApr;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
     }
    
    else  if($month == "May" ){
         $sql="call Fleet_Size_Branch_May('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
             $sqlMay="call sp_weekend_May('$Company')";
    if ($BrMay= mysqli_query($con,$sqlMay)){
      do{
        if($BrMay != ""){
     
          while ($rezMay= mysqli_fetch_assoc($BrMay) ){
            
          $Weekend[]=$rezMay;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
      }
    
   else    if($month == "June" ){
        $sql="call Fleet_Size_Branch_June('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
              $sqliJun="call sp_weekend_June('$Company')";
    if ($BrJun= mysqli_query($con,$sqliJun)){
      do{
        if($BrJun != ""){
     
          while ($rezJun= mysqli_fetch_assoc($BrJun) ){
            
          $Weekend[]=$reztx;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
       }
 else  if($month == "July"){
             $sql="call Fleet_Size_Branch_July('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sqliJ="call sp_weekend_July_Branch('$Company','$Branch')";
    if ($BrjAN= mysqli_query($con,$sqliJ)){
      do{
        if($BrjAN != ""){
     
          while ($rezjAN= mysqli_fetch_assoc($BrjAN) ){
            
          $Weekend[]=$rezjAN;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
 
  else if($month == "August" ){
       $sql="call Fleet_Size_Branch_Aug('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sqliy="call sp_weekend_Aug_Branch('$Company','$Branch')";
    if ($BrFeb= mysqli_query($con,$sqliy)){
      do{
        if($BrFeb != ""){
     
          while ($rezFeb= mysqli_fetch_assoc($BrFeb) ){
            
          $Weekend[]=$rezFeb;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
 
   else if($month == "September"){
        $sql="call Fleet_Size_Branch_Sept('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sqliF="call sp_weekend_Sept_Branch('$Company','$Branch')";
    if ($BrMar= mysqli_query($con,$sqliF)){
      do{
        if($BrMar != ""){
     
          while ($rezMar= mysqli_fetch_assoc($BrMar) ){
            
          $Weekend[]=$rezMar;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    }
    
   else  if($month == "October" ){
        $sql="call Fleet_Size_Branch_Oct('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sqliAp="call sp_weekend_Oct_Branch('$Company','$Branch')";
    if ($brApr= mysqli_query($con,$sqliAp)){
      do{
        if($brApr != ""){
     
          while ($rezApr= mysqli_fetch_assoc($brApr) ){
            
          $Weekend[]=$rezApr;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
     }
    
    else  if($month == "November" ){
         $sql="call Fleet_Size_Branch_Nov('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
             $sqlMay="call sp_weekend_Nov('$Company')";
    if ($BrMay= mysqli_query($con,$sqlMay)){
      do{
        if($BrMay != ""){
     
          while ($rezMay= mysqli_fetch_assoc($BrMay) ){
            
          $Weekend[]=$rezMay;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
      }
    
   else    if($month == "December" ){
        $sql="call Fleet_Size_Branch_Dec('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
              $sqliJun="call sp_weekend_Dec('$Company')";
    if ($BrJun= mysqli_query($con,$sqliJun)){
      do{
        if($BrJun != ""){
     
          while ($rezJun= mysqli_fetch_assoc($BrJun) ){
            
          $Weekend[]=$reztx;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
       }
    

   }
   
   

   }
    
    
     
    
  }
}
else if($_SESSION['Company_code'] == '01') {
    $_SESSION['myCompany']='ZETDC';
    if ($Company != "")
   {
   
   

      $sqlBr01="call OverSpeeding_Bra('$Company','$fromdate','$todate','$Branch')";
    if ($speedingBranch01= mysqli_query($con,$sqlBr01)){
      do{
        if($speedingBranch01 != ""){
     
          while ($rezbr01= mysqli_fetch_assoc($speedingBranch01) ){
            
          $Speed_Branch[]=$rezbr01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
 
    
     if( !empty($Speed_Branch)) {
         $sqlizybr01="call afterhours_ZETDC_Br('$Company','$fromdate','$todate','$Branch')";
    if ($ZETDCNightbr01= mysqli_query($con,$sqlizybr01)){
      do{
        if($ZETDCNightbr01 != ""){
     
          while ($reztYbr01= mysqli_fetch_assoc($ZETDCNightbr01) ){
            
          $ZETDCNightDriving_Branch[]=$reztYbr01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    }
        if( !empty($Speed_Branch) || !empty($ZETDCNightDriving_Branch)) {
            $sqlixfiz01="call perfomance_matrix_ZETDC_Branch('$Company','$fromdate','$todate','$Branch')";
    if ($ZEC01= mysqli_query($con,$sqlixfiz01)){
      do{
        if($ZEC01 != ""){
     
          while ($zet01= mysqli_fetch_assoc($ZEC01) ){
            
          $FleetMatrixBranch[]=$zet01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
       }
    if( !empty($ZETDCNightDriving_Branch) || !empty($Speed_Branch)  || !empty($FleetMatrixBranch) ) {
         if($month == "January" ){
        $sqlizx01="call sp_weekend_Branch('$Company','$Branch')";
    if ($Jan01= mysqli_query($con,$sqlizx01)){
      do{
        if($Jan01 != ""){
     
          while ($rez01= mysqli_fetch_assoc($Jan01) ){
            
          $Weekend[]=$rez01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
 
  else if($month == "February" ){
        $sqliFeb01="call sp_weekend_FEB_Branch('$Company','$Branch')";
    if ($Feb01= mysqli_query($con,$sqliFeb01)){
      do{
        if($Feb01 != ""){
     
          while ($rezFeb01= mysqli_fetch_assoc($Feb01) ){
            
          $Weekend[]=$rezFeb01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }

  else  if($month == "March"){
          $sqliMar01="call sp_weekend_Mar_Branch('$Company','$Branch')";
    if ($Mar01= mysqli_query($con,$sqliMar01)){
      do{
        if($Mar01 != ""){
     
          while ($rezMar01= mysqli_fetch_assoc($Mar01) ){
            
          $Weekend[]=$rezMar01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    }
   
   else  if($month == "April"){
          $sqliApr01="call sp_weekend_Apr_Branch('$Company','$Branch')";
    if ($Apr01= mysqli_query($con,$sqliApr01)){
      do{
        if($Apr01 != ""){
     
          while ($rezApr01= mysqli_fetch_assoc($Apr01) ){
            
          $Weekend[]=$rezApr01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
     }
   
   else if($month == "May"){
             $sqliMay01="call sp_weekend_May('$Company')";
    if ($May01= mysqli_query($con,$sqliMay01)){
      do{
        if($May01 != ""){
     
          while ($rezMay01= mysqli_fetch_assoc($May01) ){
            
          $Weekend[]=$rezMay01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
      }
     
  else  if($month == "June" ){
              $sqliJun01="call sp_weekend_June('$Company')";
    if ($Jun01= mysqli_query($con,$sqliJun01)){
      do{
        if($Jun01 != ""){
     
          while ($rezJun01= mysqli_fetch_assoc($Jun01) ){
            
          $Weekend[]=$rezJun01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
       }
 else  if($month == "July"){
      $sql="call Fleet_Size_ZETDC_Branch_July('$Company','$fromdate','$todate','$Branch')";
    if ($select01= mysqli_query($con,$sql)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $FleetBranch[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
     
        $sqliJ="call sp_weekend_July_Branch('$Company','$Branch')";
    if ($BrjAN= mysqli_query($con,$sqliJ)){
      do{
        if($BrjAN != ""){
     
          while ($rezjAN= mysqli_fetch_assoc($BrjAN) ){
            
          $Weekend[]=$rezjAN;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
 
  else if($month == "August" ){
       $sql="call Fleet_Size_ZETDC_Branch_Aug('$Company','$fromdate','$todate','$Branch')";
    if ($select01= mysqli_query($con,$sql)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $FleetBranch[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
      
        $sqliy="call sp_weekend_Aug_Branch('$Company','$Branch')";
    if ($BrFeb= mysqli_query($con,$sqliy)){
      do{
        if($BrFeb != ""){
     
          while ($rezFeb= mysqli_fetch_assoc($BrFeb) ){
            
          $Weekend[]=$rezFeb;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
 
   else if($month == "September"){
        $sql="call Fleet_Size_ZETDC_Branch_Sept('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sqliF="call sp_weekend_Sept_Branch('$Company','$Branch')";
    if ($BrMar= mysqli_query($con,$sqliF)){
      do{
        if($BrMar != ""){
     
          while ($rezMar= mysqli_fetch_assoc($BrMar) ){
            
          $Weekend[]=$rezMar;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
    }
    
   else  if($month == "October" ){
        $sql="call Fleet_Size_ZETDC_Branch_Oct('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sqliAp="call sp_weekend_Oct_Branch('$Company','$Branch')";
    if ($brApr= mysqli_query($con,$sqliAp)){
      do{
        if($brApr != ""){
     
          while ($rezApr= mysqli_fetch_assoc($brApr) ){
            
          $Weekend[]=$rezApr;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
     }
    
    else  if($month == "November" ){
         $sql="call Fleet_Size_ZETDC_Branch_Nov('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
             $sqlMay="call sp_weekend_Nov('$Company')";
    if ($BrMay= mysqli_query($con,$sqlMay)){
      do{
        if($BrMay != ""){
     
          while ($rezMay= mysqli_fetch_assoc($BrMay) ){
            
          $Weekend[]=$rezMay;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
      }
    
   else    if($month == "December" ){
        $sql="call Fleet_Size_ZETDC_Branch_Dec('$Company','$fromdate','$todate','$Branch')";
    if ($select= mysqli_query($con,$sql)){
      do{
        if($select != ""){
     
          while ($result= mysqli_fetch_assoc($select) ){
            
          $FleetBranch[]=$result;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
              $sqliJun="call sp_weekend_Dec('$Company')";
    if ($BrJun= mysqli_query($con,$sqliJun)){
      do{
        if($BrJun != ""){
     
          while ($rezJun= mysqli_fetch_assoc($BrJun) ){
            
          $Weekend[]=$reztx;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
       }
       
   }
      
     
  }
}

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Tracking System-Report </title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQlaoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJISAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
     <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

   <!-- Custom styles for this template -->
   <link href="css/sb-admin-2.min.css" rel="stylesheet">
   
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="print.css" media="print">
</head>
<style>
  .container1{
    
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .title{
    display: grid;
    grid-template-columns: repeat(3,1fr);
    align-items: center;
    column-gap: 1.6rem;
  }
  .title::before, .title::after{
content:"";
height: 2px;
background-color: #000;
display: block;
  }
 
</style>
<body>
    <div class="container">
        <div class="row py-4">
        <div class="col-sm-6"> <img src="Fwd_ Bantu track logos/bantu track logo.png2.png" width="400" ></div>
        <div class="col-sm-6">
          <p class="text-sm text-italic text-right" style="font-size: 10px;"><i>Bantu Track Pvt Ltd</i><br>
          <i> Suite 11, Bascow Court Selous Ave</i><br>
          <i>     Harare, Zimbabwe</i><br>
          <i>       +263 778 002 318</i><br>
          <i>       0242 702 509</i><br>
          <i>  operations@bantutrack.com</i><br>
          <i>    www.bantutrack.com</i></p>
        </div>
        </div>
<div class="row">
  
  <div class="col-md-12"><p class="text-center my-auto"><i>Vehicle Tracking System</i> </p><div> 
 <br><br><br><br><br><br><br>
  
</div>
<div class="row py-4">
  
  <div class="col-md-12"><h2 class="text-center my-auto" style="margin-top: 90px;color:red;"><span></span><strong><?php if(isset($_SESSION['myCompany'])){echo $_SESSION['myCompany'];} else{echo "";} ?></strong> </span><br><br>
      <span><strong>VEHICLE TRACKING REPORT</strong></span> <br><br>
<span><strong>From: <?php if(isset($_SESSION['Daterange1'])){echo $_SESSION['Daterange1'];} else{echo "";}  ?></strong></span><br><br>
<span><strong>To: <?php if(isset($_SESSION['Daterange2'])){echo $_SESSION['Daterange2'];} else{echo "";} ?></strong></span><br><br>
<span><strong>FOR</strong></span> <br><br>
<span><strong><?php if(isset($_SESSION['branch'])){echo $_SESSION['branch'];} else{echo "";} ?></strong></span></h2><div> 
 
<br><br><br> <br><br><br><br><br><br><br><br><br><br>
</div>


    <!-- <textarea id="mycomment" class="form-control text-sm" name="w3review" rows="4" cols="50"></textarea> -->
   
    <div class="row py-4">
        <div class="col-sm-12">
            <h4 class="text-center"> PERFORMANCE METRICS</h4>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" style="font-size: 10px;">ASPECT</th>
                        <th class="text-center" style="font-size: 10px;"> <?php if(isset($_SESSION['branch']) && $_SESSION['branch'] != "all" ) { echo $_SESSION['branch'];} else {echo "";} ?></th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
if(isset($FleetBranch)){
  foreach ($FleetBranch as $row)
 {
                       
     
echo "
        <tr>
          
         
          <td><p class='text-xs text-secondary mb-0 text-center'>Fleet Size (vehicles)</p></td>
          <td><p class='text-xs text-secondary mb-0 text-center'>".$row['FleetSize']."</p></td>
          
         
        </tr>
        <tr>
          
         
        <td><p class='text-xs text-secondary mb-0 text-center'>Total Mileage (km)</p></td>
        <td><p class='text-xs text-secondary mb-0 text-center'>".$row['TotalMileage']."</p></td>
        
       
      </tr>
      <tr>
          
         
      <td><p class='text-xs text-secondary mb-0 text-center'>Weekends and Holidays (km)</p></td>
      <td><p class='text-xs text-secondary mb-0 text-center'>".$row['TotalWknds']."</p></td>
     
     
    </tr>
    <tr>
          
         
      <td><p class='text-xs text-secondary mb-0 text-center'>After Hours (km)</p></td>
      <td><p class='text-xs text-secondary mb-0 text-center'>".$row['AfterHours_Distance']."</p></td>
     
     
    </tr>
      ";
    }
  }
  ?>
                
                   
                    
                </tbody>
            </table>
           
        </div>
        </div>
       
<!-- second table -->

<div class="row py-4">
        <div class="col-sm-12">
           
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm" style="font-size: 10px;">Branch</th>
                        <th class="text-sm" style="font-size: 10px;"> Fleet Size</th>
                        <th class="text-sm" style="font-size: 10px;"> Total Mileage</th>
                        <th class="text-sm" style="font-size: 10px;">After Hours (km)</th>
                        
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($FleetMatrixBranch)){
  foreach ($FleetMatrixBranch as $rowz)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['Branch']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['Fleet Size']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['Total Mileage']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['After Hours (km)']."</p></td>
               </tr>
          
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
          
        </div>
        </div>
      
       <!-- third table -->
 
        <div class="row py-4">
        <div class="col-sm-12">
           <h4 class="text-center">SPEEDING</h4 >
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm text-center" style="font-size: 10px;">REG NO.</th>
                        <th class="text-sm text-center" style="font-size: 10px;">LOCATION</th>
                        <th class="text-sm text-center" style="font-size: 10px;">TOP SPEED</th>
                        <th class="text-sm text-center" style="font-size: 10px;">LOCATION</th>
                        <th class="text-sm text-center" style="font-size: 10px;">TIME</th>
                        <th class="text-sm text-center" style="font-size: 10px;">FREQUENCY OF SPEEDING</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($Speed_Branch)){
  foreach ($Speed_Branch as $rowzy)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowzy['RegNo']." </p></td>
               <td><p class='text-xs text-secondary mb-0 text-center'>".$rowzy['Location']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowzy['top_speed']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowzy['Address']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowzy['date']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowzy['freq']." </p></td>
              
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
            
        </div>
        </div> 
          <!-- fourth table -->
 
          <div class="row py-4">
        <div class="col-sm-12">
           <h4 class="text-center">Weekends and Holidays</h4>
           <?PHP  if(isset($_SESSION['Month']) &&$_SESSION['Month'] == "January"){  ?>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm text-center" style="font-size: 10px;">VEHICLE ID.</th>
                        <th class="text-sm text-center" style="font-size: 10px;">Location </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-01-06 </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-01-07</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-01-13</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-01-14</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-01-20</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-01-21</th>
                         <th class="text-sm text-center" style="font-size: 10px;">2024-01-27</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-01-28</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($Weekend)){
  foreach ($Weekend as $weekends)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['VehicleID']." </p></td>
                  <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['Location']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-06']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-07']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-13']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-14']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-20']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-21']." </p></td>
               <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-27']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-01-28']." </p></td>
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
            <?PHP } ?>
            
             <?PHP  if(isset($_SESSION['Month']) &&$_SESSION['Month'] == "February"){  ?>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm text-center" style="font-size: 10px;">VEHICLE ID.</th>
                        <th class="text-sm text-center" style="font-size: 10px;">Location </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-02-03 </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-02-04</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-02-10</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-02-11</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-02-17</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-02-18</th>
                         <th class="text-sm text-center" style="font-size: 10px;">2024-02-24</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-02-25</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($Weekend)){
  foreach ($Weekend as $weekends)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['VehicleID']." </p></td>
                  <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['Location']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-03']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-04']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-10']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-11']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-17']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-18']." </p></td>
               <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-24']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-02-25']." </p></td>
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
            <?PHP } ?>
            <?PHP  if(isset($_SESSION['Month']) &&$_SESSION['Month'] == "March"){  ?>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm text-center" style="font-size: 10px;">VEHICLE ID.</th>
                        <th class="text-sm text-center" style="font-size: 10px;">Location </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-02 </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-03</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-09</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-10</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-16</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-17</th>
                         <th class="text-sm text-center" style="font-size: 10px;">2024-03-23</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-24</th>
                         <th class="text-sm text-center" style="font-size: 10px;">2024-03-30</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-03-31</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($Weekend)){
  foreach ($Weekend as $weekends)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['VehicleID']." </p></td>
                  <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['Location']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-02']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-03']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-09']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-10']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-16']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-17']." </p></td>
               <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-23']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-24']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-30']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-03-31']." </p></td>
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
            <?PHP } ?>
            <?PHP  if(isset($_SESSION['Month']) &&$_SESSION['Month'] == "April"){  ?>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm text-center" style="font-size: 10px;">VEHICLE ID.</th>
                        <th class="text-sm text-center" style="font-size: 10px;">Location </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-04-06 </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-04-07</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-04-13</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-04-14</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-04-20</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-04-21</th>
                         <th class="text-sm text-center" style="font-size: 10px;">2024-04-27</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-04-28</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($Weekend)){
  foreach ($Weekend as $weekends)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['VehicleID']." </p></td>
                  <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['Location']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-06']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-07']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-13']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-14']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-20']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-21']." </p></td>
               <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-27']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-04-28']." </p></td>
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
            <?PHP } ?>
            <?PHP  if(isset($_SESSION['Month']) &&$_SESSION['Month'] == "May"){  ?>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm text-center" style="font-size: 10px;">VEHICLE ID.</th>
                        <th class="text-sm text-center" style="font-size: 10px;">Location </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-05-04 </th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-05-05</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-05-11</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-05-12</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-05-18</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-05-19</th>
                         <th class="text-sm text-center" style="font-size: 10px;">2024-05-25</th>
                        <th class="text-sm text-center" style="font-size: 10px;">2024-05-26</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($Weekend)){
  foreach ($Weekend as $weekends)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['VehicleID']." </p></td>
                  <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['Location']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-04']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-05']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-11']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-12']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-18']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-10']." </p></td>
               <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-25']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$weekends['2024-05-26']." </p></td>
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
            <?PHP } ?>
        </div>
        </div> 
        <!-- Fifth table -->

<div class="row py-4 mb-4">
        <div class="col-sm-12">
        <h4 class="text-center">AFTER HOURS DRIVING</h4>
        <?PHP  if(isset($_SESSION['Company']) &&$_SESSION['Company']=="02" && isset($_SESSION['branch']) && $_SESSION['branch'] !="all") { ?>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                         
                        <th class="text-sm text-center" style="font-size: 10px;">VEHICLE REG</th>
                             <th class="text-sm text-center" style="font-size: 10px;">Location</th>
                        <th class="text-sm text-center" style="font-size: 10px;">18:00-18:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">19:00-19:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 20:00-20:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">21:00-21:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 22:00-22:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 23:00-23:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">00:00-00:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 01:00-01:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">02:00-02:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 03:00-03:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">04:00-04:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 05:00-05:59</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($NightDriving_Branch)){
  foreach ($NightDriving_Branch as $rowxbr)
 {
       
    
    echo "
            <tr>
              
            <td><p class='text-xs text-secondary mb-0 text-center'>".$rowxbr['RegNo']." </p></td>
                     <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Location']." </p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Six']." </p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Seven']."</p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Eight']." </p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Nine']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxbr['Ten']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Eleven']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxbr['Twelve']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxbr['One']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Two']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'  >".$rowxbr['Three']."</p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Four']."</p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowxbr['Five']." </p></td>
              
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
                   
                   <?php } else if(isset($_SESSION['Company']) &&$_SESSION['Company']=="01" && isset($_SESSION['branch']) && $_SESSION['branch'] !="all") {?>
                     <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                         
                        <th class="text-sm text-center" style="font-size: 10px;">VEHICLE REG</th>
                         <th class="text-sm text-center" style="font-size: 10px;"> Location</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 22:00-22:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 23:00-23:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">00:00-00:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 01:00-01:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">02:00-02:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 03:00-03:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;">04:00-04:59</th>
                        <th class="text-sm text-center" style="font-size: 10px;"> 05:00-05:59</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($ZETDCNightDriving_Branch)){
  foreach ($ZETDCNightDriving_Branch as $rowxybr)
 {
       
    
    echo "
            <tr>
              
            <td><p class='text-xs text-secondary mb-0 text-center'>".$rowxybr['RegNo']." </p></td>
             <td><p class='text-xs text-secondary mb-0 text-center'>".$rowxybr['Location']." </p></td>
             <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxybr['Ten']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowxybr['Eleven']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxybr['Twelve']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxybr['One']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowxybr['Two']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'  >".$rowxybr['Three']."</p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowxybr['Four']."</p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowxybr['Five']." </p></td>
              
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>

                    <?php } ?>
            <div class="text-center">
                <button onclick="window.print();" id="print-btn" class="btn btn-success col-md-3">Print</button>
</div>
        </div>
        </div>
    </div>
   <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
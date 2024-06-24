<?php  

include("database.php");
error_reporting(0);
ob_start();
session_start(); 
if(isset($_SESSION["company_code"])  && isset($_SESSION["fromdate"]) && isset($_SESSION["todate"])){

$time=strtotime($_SESSION["fromdate"]);
$month=date("F",$time);
$year=date("Y",$time);
$_SESSION['Month'] = date("F",$time);
$Fleet = array();
$FleetMatrix = array();
$Speed = array();

$NightDriving = array();
$ZETDCNightDriving = array();

$ZETDC = array();
$Weekend= array();
$MyCompany='';
$_SESSION['Company']=$_SESSION["company_code"];
$_SESSION['From']=$_SESSION["fromdate"];
$_SESSION['To']=$_SESSION["todate"];

$Company = $_SESSION['Company'];
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


if($_SESSION['Company'] == '02'){
    
    $_SESSION['myCompany']='ALLIED TIMBERS';
    if ($Company != "")
   {
    
     $sqli02="call perfomance_matrix('$Company','$fromdate','$todate')";
     if ($matrix02= mysqli_query($con,$sqli02)){
       do{
         if($matrix02 != ""){
      
           while ($res02= mysqli_fetch_assoc($matrix02) ){
             
           $FleetMatrix[]=$res02;
           }
            
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
    
         $sqlii02="call Over_Speeding_Table('$Company','$fromdate','$todate')";
     if ($speeding02= mysqli_query($con,$sqlii02)){
       do{
         if($speeding02 != ""){
      
           while ($rez02= mysqli_fetch_assoc($speeding02) ){
             
           $Speed[]=$rez02;
           }
             
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
   
         $sqliz02="call after_hours_driving('$Company','$fromdate','$todate')";
     if ($Night02= mysqli_query($con,$sqliz02)){
       do{
         if($Night02 != ""){
      
           while ($rezt02= mysqli_fetch_assoc($Night02) ){
             
           $NightDriving[]=$rezt02;
           }
             
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }  
  
    
        if($month == "January"){
            $sql02="call Fleet_Size_Jan('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
        $sql01Jan="call sp_weekend('$Company')";
    if ($Jan01= mysqli_query($con,$sql01Jan)){
      do{
        if($Jan01 != ""){
     
          while ($rezJan01= mysqli_fetch_assoc($Jan01) ){
            
          $Weekend[]=$rezJan01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
  
  else  if($month == "February" ){
           $sql02="call Fleet_Size_Feb('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
        $sql01Feb="call sp_weekend_FEB('$Company')";
    if ($Feb01= mysqli_query($con,$sql01Feb)){
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
  
    else if($month == "March" ){
             $sql02="call Fleet_Size_Mar('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
          $sql01Mar="call sp_weekend_Mar('$Company')";
    if ($Mar01= mysqli_query($con,$sql01Mar)){
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
   
     else  if($month == "April" ){
              $sql02="call Fleet_Size_Apr('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
          $sql01Apr="call sp_weekend_Apr('$Company')";
    if ($Apr01= mysqli_query($con,$sql01Apr)){
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
               $sql02="call Fleet_Size_May('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
             $sql01May="call sp_weekend_May('$Company')";
    if ($May01= mysqli_query($con,$sql01May)){
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
                $sql02="call Fleet_Size_Jun('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
              $sql01Jun="call sp_weekend_June('$Company')";
    if ($Jun01= mysqli_query($con,$sql01Jun)){
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
            $sql02="call Fleet_Size_July('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
        $sql01Jan="call sp_weekend_July('$Company')";
    if ($Jan01= mysqli_query($con,$sql01Jan)){
      do{
        if($Jan01 != ""){
     
          while ($rezJan01= mysqli_fetch_assoc($Jan01) ){
            
          $Weekend[]=$rezJan01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
  
  else  if($month == "August" ){
           $sql02="call Fleet_Size_Aug('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
        $sql01Feb="call sp_weekend_Aug('$Company')";
    if ($Feb01= mysqli_query($con,$sql01Feb)){
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
  
    else if($month == "September" ){
             $sql02="call Fleet_Size_Sept('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
          $sql01Mar="call sp_weekend_Sept('$Company')";
    if ($Mar01= mysqli_query($con,$sql01Mar)){
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
   
     else  if($month == "October" ){
              $sql02="call Fleet_Size_Oct('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
          $sql01Apr="call sp_weekend_Oct('$Company')";
    if ($Apr01= mysqli_query($con,$sql01Apr)){
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
    
      else if($month == "Nov"){
               $sql02="call Fleet_Size_Nov('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
             $sql01May="call sp_weekend_Nov('$Company')";
    if ($May01= mysqli_query($con,$sql01May)){
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
    
       else  if($month == "Dec" ){
                $sql02="call Fleet_Size_Dec('$Company','$fromdate','$todate')";
     if ($select02= mysqli_query($con,$sql02)){
       do{
         if($select02 != ""){
      
           while ($result02= mysqli_fetch_assoc($select02) ){
             
           $Fleet[]=$result02;
           }
          
         }
     
     
     }
       
     while(mysqli_next_result($con));
     }
              $sql01Jun="call sp_weekend_Dec('$Company')";
    if ($Jun01= mysqli_query($con,$sql01Jun)){
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
  }
}
else if($_SESSION['Company'] == '01') {
    $_SESSION['myCompany']='ZETDC';
    if ($Company != "")
   {
   
     $sqlix01="call perfomance_matrix_ZETDC('$Company','$fromdate','$todate')";
    if ($ZEC= mysqli_query($con,$sqlix01)){
      do{
        if($ZEC != ""){
     
          while ($zet01= mysqli_fetch_assoc($ZEC) ){
            
          $ZETDC[]=$zet01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
 
          $sqli01="call Over_Speeding_Table('$Company','$fromdate','$todate')";
    if ($speeding01= mysqli_query($con,$sqli01)){
      do{
        if($speeding01 != ""){
     
          while ($rez01= mysqli_fetch_assoc($speeding01) ){
            
          $Speed[]=$rez01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
 
          $sqliz01="call after_hours_ZETDC('$Company','$fromdate','$todate')";
    if ($ZETDCNight= mysqli_query($con,$sqliz01)){
      do{
        if($ZETDCNight != ""){
     
          while ($rez01= mysqli_fetch_assoc($ZETDCNight) ){
            
          $ZETDCNightDriving[]=$rez01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }

        if($month == "January"){
      $sql01="call Fleet_Size_ZETDC_Jan('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sql01Jan="call sp_weekend('$Company')";
    if ($Jan01= mysqli_query($con,$sql01Jan)){
      do{
        if($Jan01 != ""){
     
          while ($rezJan01= mysqli_fetch_assoc($Jan01) ){
            
          $Weekend[]=$rezJan01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
  
  else  if($month == "February" ){
        $sql01="call Fleet_Size_ZETDC_Feb('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sql01Feb="call sp_weekend_FEB('$Company')";
    if ($Feb01= mysqli_query($con,$sql01Feb)){
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
  
    else if($month == "March" ){
          $sql01="call Fleet_Size_ZETDC_Mar('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sql01Mar="call sp_weekend_Mar('$Company')";
    if ($Mar01= mysqli_query($con,$sql01Mar)){
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
   
     else  if($month == "April" ){
           $sql01="call Fleet_Size_ZETDC_Apr('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sql01Apr="call sp_weekend_Apr('$Company')";
    if ($Apr01= mysqli_query($con,$sql01Apr)){
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
            $sql01="call Fleet_Size_ZETDC_May('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
             $sql01May="call sp_weekend_May('$Company')";
    if ($May01= mysqli_query($con,$sql01May)){
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
             $sql01="call Fleet_Size_ZETDC_Jun('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
              $sql01Jun="call sp_weekend_June('$Company')";
    if ($Jun01= mysqli_query($con,$sql01Jun)){
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
       else if($month == "July"){
      $sql01="call Fleet_Size_ZETDC_July('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sql01Jan="call sp_weekend_July('$Company')";
    if ($Jan01= mysqli_query($con,$sql01Jan)){
      do{
        if($Jan01 != ""){
     
          while ($rezJan01= mysqli_fetch_assoc($Jan01) ){
            
          $Weekend[]=$rezJan01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
   }
  
  else  if($month == "August" ){
        $sql01="call Fleet_Size_ZETDC_Aug('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
        $sql01Feb="call sp_weekend_Aug('$Company')";
    if ($Feb01= mysqli_query($con,$sql01Feb)){
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
  
    else if($month == "September" ){
          $sql01="call Fleet_Size_ZETDC_Sept('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sql01Mar="call sp_weekend_Sept('$Company')";
    if ($Mar01= mysqli_query($con,$sql01Mar)){
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
   
     else  if($month == "October" ){
           $sql01="call Fleet_Size_ZETDC_Oct('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
          $sql01Apr="call sp_weekend_Oct('$Company')";
    if ($Apr01= mysqli_query($con,$sql01Apr)){
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
    
      else if($month == "November"){
            $sql01="call Fleet_Size_ZETDC_Nov('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
             $sql01May="call sp_weekend_Nov('$Company')";
    if ($May01= mysqli_query($con,$sql01May)){
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
    
       else  if($month == "December" ){
             $sql01="call Fleet_Size_ZETDC_Dec('$Company','$fromdate','$todate')";
    if ($select01= mysqli_query($con,$sql01)){
      do{
        if($select01 != ""){
     
          while ($result01= mysqli_fetch_assoc($select01) ){
            
          $Fleet[]=$result01;
          }
            
        }
    
    
    }
      
    while(mysqli_next_result($con));
    }
              $sql01Jun="call sp_weekend_Dec('$Company')";
    if ($Jun01= mysqli_query($con,$sql01Jun)){
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
  
  <div class="col-md-12"><h2 class="text-center my-auto" style="margin-top: 10px;color:red;"><span></span><strong><?php if(isset($_SESSION['myCompany'])){echo $_SESSION['myCompany'];} else{echo "";} ?></strong> </span><br><br>
      <span><strong>VEHICLE TRACKING REPORT</strong></span> <br><br>
<span><strong>From: <?php if(isset($_SESSION['Daterange1'])){echo $_SESSION['Daterange1'];} else{echo "";}  ?></strong></span><br><br>
<span><strong>To: <?php if(isset($_SESSION['Daterange2'])){echo $_SESSION['Daterange2'];} else{echo "";} ?></strong></span></h2>
<div> 
 
<br><br><br>
</div>
<div  style="page-break-after: always;"> 

</div>



    <!-- <textarea id="mycomment" class="form-control text-sm" name="w3review" rows="4" cols="50"></textarea> -->
   
    <div class="row py-4">
        <div class="col-sm-12">
            <h4 class="text-center"> PERFORMANCE METRICS</h4>
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" style="font-size: 10px;">ASPECT</th>
                        <th class="text-center" style="font-size: 10px;"> <?php if(isset($_SESSION['Company']) &&$_SESSION['Company']=="02") { echo "ALLIED TIMBERS";} else {echo "ZETDC";} ?></th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
if(isset($Fleet)){
  foreach ($Fleet as $row)
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
<?php if(isset($_SESSION['Company']) &&$_SESSION['Company']=="02") { ?>
<div class="row py-4"  >
        <div class="col-sm-12">
           
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm" style="font-size: 10px;">ASPECT</th>
                        <th class="text-sm" style="font-size: 10px;"> MUTARE FACTORY</th>
                        <th class="text-sm" style="font-size: 10px;"> MUTARE OFFICE</th>
                        <th class="text-sm" style="font-size: 10px;">BULAWAYO</th>
                        <th class="text-sm" style="font-size: 10px;">CASHEL</th>
                        <th class="text-sm" style="font-size: 10px;">MASVINGO</th>
                        <th class="text-sm" style="font-size: 10px;">CHISENGU</th>
                        <th class="text-sm" style="font-size: 10px;">ERIN</th>
                        <th class="text-sm" style="font-size: 10px;">GWENDINGWE</th>
                        <th class="text-sm" style="font-size: 10px;">GWERU</th>
                        <th class="text-sm" style="font-size: 10px;">HQ</th>
                        <th class="text-sm" style="font-size: 10px;">MARTIN</th>
                        <th class="text-sm" style="font-size: 10px;">MTAO</th>
                        <th class="text-sm" style="font-size: 10px;">NGUNGUNYANA</th>
                         <th class="text-sm" style="font-size: 10px;">STAPLEFORD</th>
                         <th class="text-sm" style="font-size: 10px;">NYANGUI</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($FleetMatrix)){
  foreach ($FleetMatrix as $rowz)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ASPECT']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED MUTARE FACTORY']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED MUTARE OFFICE']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS BULAWAYO']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS CASHEL']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS MASVINGO']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS CHISENGU']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS ERIN']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS GWENDINGWE']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS GWERU']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS HQ']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS MARTIN']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS MTAO']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS NGUNGUNYANA']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['ALLIED TIMBERS STAPLEFORD']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowz['AlLLIED TIMBERS NYANGUI']." </p></td>
            </tr>
          
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
          
        </div>
        </div>
        <?php }?>
        <?php if(isset($_SESSION['Company']) &&$_SESSION['Company']=="01"){ ?>
        <div class="row py-4"  style="page-break-after: always;">
        <div class="col-sm-12">
           
            <table class="table table-bordered text-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-sm" style="font-size: 10px;">ASPECT</th>
                        <th class="text-sm" style="font-size: 10px;"> ZETDC</th>
                        <th class="text-sm" style="font-size: 10px;"> WESTERN REGION</th>
                        <th class="text-sm" style="font-size: 10px;">HEAD OFFICE</th>
                        <th class="text-sm" style="font-size: 10px;">WYNE DEPOT</th>
                        <th class="text-sm" style="font-size: 10px;">HARARE REGION</th>
                        <th class="text-sm" style="font-size: 10px;">CBD DEPOT</th>
                        <th class="text-sm" style="font-size: 10px;">ZETDC KUWADZANA</th>
                         <th class="text-sm" style="font-size: 10px;">EASTERN REGION</th>
                        <th class="text-sm" style="font-size: 10px;">SOUTHERN REGION</th>
                      
                        <th class="text-sm" style="font-size: 10px;">ZETDC TRANSMISSION</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php

if(isset($ZETDC)){
  foreach ($ZETDC as $rowze)
 {
       
    
    echo "
            <tr>
              
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['ASPECT']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['ZETDC']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['WESTERN REGION']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['HEAD OFFICE']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['WYNE DEPOT']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['HARARE REGION']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['CBD DEPOT']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['ZETDC KUWADZANA']."</p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['ZETDC EASTERN REGION']." </p></td>
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['ZETDC SOUTHERN REGION']."</p></td>
             
              <td><p class='text-xs text-secondary mb-0 text-center'>".$rowze['ZETDC TRANSMISSION']."</p></td>
             
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
          
        </div>
        </div>
        <?php } ?>
       <!-- third table -->
 
        <div class="row py-4"  style="page-break-after: always;">
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

if(isset($Speed)){
  foreach ($Speed as $rowzy)
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
 
          <div class="row py-4"  style="page-break-after: always;">
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

<div class="row py-4 mb-4" >
        <div class="col-sm-12">
        <h4 class="text-center">AFTER HOURS DRIVING</h4>
       <?php if(isset($_SESSION['Company']) &&$_SESSION['Company']=="02"  ) { ?>
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

if(isset($NightDriving)){
  foreach ($NightDriving as $rowx)
 {
       
    
    echo "
            <tr>
              
            <td><p class='text-xs text-secondary mb-0 text-center'>".$rowx['RegNo']." </p></td>
                     <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Location']." </p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Six']." </p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Seven']."</p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Eight']." </p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Nine']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowx['Ten']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Eleven']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowx['Twelve']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowx['One']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Two']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'  >".$rowx['Three']."</p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Four']."</p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowx['Five']." </p></td>
              
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
             <?php } else if(isset($_SESSION['Company']) &&$_SESSION['Company']=="01"  ) { ?>
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

if(isset($ZETDCNightDriving)){
  foreach ($ZETDCNightDriving as $rowxy)
 {
       
    
    echo "
            <tr>
              
            <td><p class='text-xs text-secondary mb-0 text-center'>".$rowxy['RegNo']." </p></td>
             <td><p class='text-xs text-secondary mb-0 text-center'>".$rowxy['Location']." </p></td>
             <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxy['Ten']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowxy['Eleven']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxy['Twelve']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'>".$rowxy['One']."</p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center' >".$rowxy['Two']." </p></td>
              <td bgcolor='red'><p class='text-xs text-secondary mb-0 text-center'  >".$rowxy['Three']."</p></td>
              <td bgcolor='orange'><p class='text-xs text-secondary mb-0 text-center' >".$rowxy['Four']."</p></td>
              <td bgcolor='yellow'><p class='text-xs text-secondary mb-0 text-center' >".$rowxy['Five']." </p></td>
              
            </tr>
           
          ";
        }
      }
   
  ?>
                
                   
                    
                </tbody>
            </table>
                   <?php }?>
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
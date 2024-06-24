<?php
include "conn.php";
session_start();
if(isset($_SESSION['access']) && isset($_SESSION['username']) &&  $_SESSION['access']=='1') { 
    
  if(isset($_POST['btnSubmit'])){
  //personal details
  $_SESSION['company_code'] = $_POST["company_code"];
  $_SESSION['Branch']= $_POST["Branch"];
  $_SESSION['fromdate'] = $_POST["fromdate"];
  $_SESSION['todate']= $_POST["todate"];
  
  if(isset($_SESSION['company_code']) && isset($_SESSION['Branch']) && isset($_SESSION['fromdate']) && isset($_SESSION['todate']) && $_SESSION['Branch'] != 'all' ){
      header("location:../mainbranch.php");
  }
  else if(isset($_SESSION['company_code']) && isset($_SESSION['Branch']) && isset($_SESSION['fromdate']) && isset($_SESSION['todate']) && $_SESSION['Branch'] == 'all' ) {
            header("location:../main.php");
  }
 }
  
 
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Reporting System - Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
		<script>
    // JavaScript function to fetch and populate states based on the selected country
    function getBranches(company_code) {
        // Initialize XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure GET request to fetch state data from the PHP script
        xhr.open("GET", "get_branch.php?company_code=" + company_code, true);

        // Define callback function for handling state data once received
        xhr.onreadystatechange = function() {
            // Check if the request is complete and successful
            if (xhr.readyState === 4 && xhr.status === 200) {

                // Parse the JSON response to obtain state data
                var branches = JSON.parse(xhr.responseText);

                // Access the state dropdown element
                var branchDropdown = document.getElementById("Branch");

                // Clear and set the default option for the state dropdown
                branchDropdown.innerHTML = "<option value=''>Select Branch</option><option value='all'>All</option>";
                
                // Enable the state dropdown for user interaction
                branchDropdown.disabled = false;

                // Loop through the state data to populate the state dropdown
                branches.forEach(branch => {
                    var option = document.createElement("option");
                    option.value = branch.Branch;
                    option.text = branch.Branch;
                    branchDropdown.appendChild(option);
                });
            }
        };

        // Send the GET request to fetch state data
        xhr.send();
    }
    // Get Devices
    function getDevices(branch_code) {
        // Initialize XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure GET request to fetch state data from the PHP script
        xhr.open("GET", "get_devices.php?branch_code=" + branch_code, true);

        // Define callback function for handling state data once received
        xhr.onreadystatechange = function() {
            // Check if the request is complete and successful
            if (xhr.readyState === 4 && xhr.status === 200) {

                // Parse the JSON response to obtain state data
                var devices = JSON.parse(xhr.responseText);

                // Access the state dropdown element
                var deviceDropdown = document.getElementById("Device");

                // Clear and set the default option for the state dropdown
                deviceDropdown.innerHTML = "<option value=''>Select Device</option><option value='all'>All</option>";
                
                // Enable the state dropdown for user interaction
                deviceDropdown.disabled = false;

                // Loop through the state data to populate the state dropdown
                devices.forEach(device => {
                    var option = document.createElement("option");
                    option.value = device.Device_id;
                    option.text = device.Device_id;
                    deviceDropdown.appendChild(option);
                });
            }
        };

        // Send the GET request to fetch state data
        xhr.send();
    }
</script>
  </head>
  <style>
	.panel-heading {
		background-color: #28a745; /* Dark green */
		border-color: #28a745; /* Dark green */
		/* Additional styles as needed */
	}
	.center {
  margin: auto;
  width: 60%;
  border: 3px solid #73AD21;
  padding: 10px;
}
	</style>
  <body>

    <div class="container pt-5 pb-4">
			<div class="row justify-content-between">
				<div class="col-md-8 order-md-last">
					<div class="row">
						<div class="col-md-6 text-center">
							<a class="navbar-brand" href="index.html">Repoting<span> System</span></a>
						</div>
						
					</div>
				</div>
				<div class="col-md-4 d-flex">
					<div class="social-media">
		    		<p class="mb-0 d-flex">
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
		    		</p>
	        </div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container-fluid">
	    
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav m-auto">
	        	<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	        	  <li class="nav-item"><a href="usercreation.php" class="nav-link">Add Users</a></li>
			  <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading"></span>
            <h2 class="mb-4"></h2>
          </div>
        </div>
        <div class="row ftco-animate">
         <div class="col-sm-6 center" >
		  <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="" >
                    <div class="mb-3">
                        <label for="company" class="form-label" aria-label="Default select example">Company</label>
                        <select id="company" name="company_code" class="form-control form-select form-select-lg" onchange="getBranches(this.value)">
                            <option value="">Select Company</option>
                            <option value="02">ALLIED TIMBERS</option>
                                <option value="01">ZETDC</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Branch" class="form-label" aria-label="Default select example">Branch</label>
                        <select id="Branch" name="Branch" class="form-control form-select form-select-lg"  onchange="getDevices(this.value)" disabled>
                            <option value="">Select Branch</option>
							
                        </select>
                    </div>
                  <!--  <div class="mb-3">
                        <label for="Device" class="form-label" aria-label="Default select example">Device</label>
                        <select id="Device" name="Device" class="form-control form-select form-select-lg" disabled>
                            <option value="">Select Device</option>
							
                        </select>
                    </div> -->
					<div class="mb-3">
                        <label for="FromDate" class="form-label" aria-label="Default select example">From</label>
                        <input class="form-control date start input-sm" size="20" type="date"  Placeholder="" name="fromdate" id="from" data-date="" data-date-format="dd-mm-yyyy" data-link-field="any" data-link-format="dd-mm-yyyy">
                    </div>
					<div class="mb-3">
                        <label for="ToDate" class="form-label" aria-label="Default select example">To</label>
                        <input class="form-control date start input-sm" size="20" type="date"  Placeholder="" name="todate" id="to" data-date="" data-date-format="dd-mm-yyyy" data-link-field="any" data-link-format="dd-mm-yyyy">
                    </div>
					<div class="mb-3">
					<button type="submit" name="btnSubmit" class="btn btn-success col-md-3">Generate <i class="fa fa-arrow-circle-right bold"></i></button>
                    </div>
                </form>
            </div>
        </div>
          </div>
        </div>
      </div>
    </section>

   
		

    <section class="ftco-section ftco-no-pt ftco-no-pb bg-primary">
      <div class="container">
        <div class="row d-flex justify-content-center">
        	<div class="col-lg-8 py-4">
        		<div class="row">
		          <div class="col-md-6 ftco-animate d-flex align-items-center">
		            
		          </div>
		          <div class="col-md-6 d-flex align-items-center">
		           
		          </div>
	          </div>
          </div>
        </div>
      </div>
    </section>

   
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

   <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
    
  </body>
</html>
<?php
}
else {
	header('location:../Account/Index.php');
}
?>

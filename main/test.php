<?php
include "conn.php";
session_start();
if(isset($_SESSION['access']) && isset($_SESSION['username']) &&  $_SESSION['access']=='1') { 

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



 <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <link href="./jquery.multiselect.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./jquery.multiselect.js"></script>

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
                       <h2>optgroup Example</h2>
    <select name="basicOptgroup[]" multiple="multiple">
            <optgroup label="Programming Languages">
                <option value="C++ / C#">C++ / C#</option>
                <option value="Java">Java</option>
                <option value="Objective-C">Objective-C</option>
            </optgroup>
            <optgroup label="Client-side scripting Languages">
                <option value="JavaScript">JavaScript</option>
            </optgroup>
            <optgroup label="Server-side scripting Languages">
                <option value="Perl">Perl</option>
                <option value="PHP">PHP</option>
                <option value="Ruby on Rails">Ruby on Rails</option>
            </optgroup>
            <optgroup label="Mobile Platforms">
                <option value="Android">Android</option>
                <option value="iOS (iPhone, iPad and iPod Touch)">iOS (iPhone, iPad and iPod Touch)</option>
            </optgroup>
            <optgroup label="Document Markup Languages">
                <option value="HTML">HTML</option>
                <option value="SGML">SGML</option>
            </optgroup>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="jquery.multiselect.js"></script>
<script>
$('select[multiple]').multiselect({
    columns: 4,
    placeholder: 'Select options'
});
</script>
</select>

                    </div>
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

  <script>
    $(function () {
        $('select[multiple].active.3col').multiselect({
            columns: 3,
            placeholder: 'Select States',
            search: true,
            searchOptions: {
                'default': 'Search States'
            },
            selectAll: true
        });

    });
</script>


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
na 
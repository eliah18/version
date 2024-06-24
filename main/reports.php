<?php
include "conn.php";
ob_start();
session_start();
if(isset($_SESSION['access']) && isset($_SESSION['username']) && isset($_SESSION['useraccess']) && isset($_SESSION['Objects']) && isset($_SESSION['Company_code']) &&  $_SESSION['access']=='1' ) { 

    if(isset($_POST['btnSubmit'])){
        //personal details
        $_SESSION['mycompany'] = $_POST["company_code"];
        $_SESSION['myobjects']= $_POST["editobjects"];
        $_SESSION['fromdate'] = $_POST["fromdate"];
        $_SESSION['todate']= $_POST["todate"];
        if(isset($_SESSION['myobjects'])){}
        else{
            $_SESSION['myobjects'] = $_SESSION['Objects'];
        }
        
        if(isset($_SESSION['Company_code']) && isset($_SESSION['myobjects']) && isset($_SESSION['fromdate']) && isset($_SESSION['todate']) ){
            header("location:../mainbranch.php");
        }
       
        // else if(isset($_SESSION['company_code']) && isset($_SESSION['Branch']) && isset($_SESSION['fromdate']) && isset($_SESSION['todate']) && $_SESSION['Branch'] == 'all' ) {
        //           header("location:../main.php");
        // }
       }

?>
<!DOCTYPE html>

<html lang="en" >


<head>
    <meta charset="utf-8"/>
    <title>Bantu Track</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link rel="shortcut icon" href="https://track.bantutrack.com/images/favicon.ico?t=1688814127"/>
    <link rel="stylesheet" type="text/css" href="https://track.bantutrack.com/assets/css/light-blue.css?t=1688814127" />
      <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

<body class="admin-layout">

<div class="header">
    <nav class="navbar navbar-main navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-header-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                                <a class="navbar-brand" href="javascript:"><img src="https://track.bantutrack.com/images/logo.png?t=1688814127"></a>
                
                <p class="navbar-text">ADMIN</p>
            </div>

            <div class="collapse navbar-collapse" id="bs-header-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
            

            <a  href="users.php">
                <i class="icon users"></i> <span class="text">Users</span>
            </a></li><li class="">
   <a  href="reports.php">
                <i class="icon book"></i> <span class="text">Reports</span>
                </a></li><li class="">
            <a data-hover="dropdown" data-toggle="dropdown" href="javascript:;">
                <span  ><?php if(isset(	$_SESSION['username'])){echo ''.$_SESSION['username'].'';} ?></span> <?php if(isset($_SESSION['useraccess'])){echo 	'('.$_SESSION['useraccess'].')';} ?> <i class="caret"></i><i class=""></i>
            </a><ul class="dropdown-menu"><li class="">

            <a  href="logout.php">
                <i class="icon logout"></i><span class="text">Log out</span>
            </a></li></ul></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="content">
    <div class="container-fluid">
        
         <div class="col-md-4">       </div> 
        <div class="col-md-5">
    <div class="panel panel-default" id="table_clients">

       

        <div class="panel-heading">
           

            <div class="panel-title">Reports</div>

          
        </div>

        <div class="panel-body" data-table>
            

 <form method="POST" action="" >
                    <div class="mb-3">
                        <label for="company" class="form-label" aria-label="Default select example">Company</label>
                        <select id="company" name="company_code" class="form-control form-select form-select-lg" onchange="getBranches(this.value)" width="50%">
                            <option value="">Select Company</option>
                            <option value="02">ALLIED TIMBERS</option>
                                <option value="01">ZETDC</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Branch" class="form-label" aria-label="Default select example">Objects</label>
                        <select class="form-control multiexpand" multiple="multiple" data-live-search="true" data-actions-box="true"   id="editobjects[]" name="editobjects[]">
<?php
$array=[];
if(isset($_SESSION['Objects'])){$array=$_SESSION['Objects'];}
$formatted_array = array_values($array[0]);

 $delimiter = ', ';
 $arrayString = implode($delimiter,$formatted_array);

// Query to fetch categories
$categoryQuery = "SELECT DISTINCT `branch` FROM `Objects` where device_id in ($arrayString) ;";
$categoryResult = $connection->query($categoryQuery);

while ($categoryRow = $categoryResult->fetch_assoc()) {

$categoryName = $categoryRow['branch'];
?>

<optgroup label="<?php echo $categoryName; ?>">
<?php
$userobjects =[];
if(isset( $_SESSION['Objects'])){ 

$array = $_SESSION['Objects'];
$formatted_array = array_values($array[0]);

$userobjects =$formatted_array; }
$subcategoryQuery = "SELECT  `device_id`, `device_name` FROM `Objects` WHERE branch = '$categoryName'";
$subcategoryResult = $connection->query($subcategoryQuery);

while ($subcategoryRow = $subcategoryResult->fetch_assoc()) {
$subcategoryName = $subcategoryRow['device_name'];
$subcategoryValue = $subcategoryRow['device_id'];
$selected = ''; // Initialize the "selected" variable

// Check if the current subcategory value is selected
if (in_array($subcategoryValue,$userobjects?? [])) {
$selected = 'selected="selected"'; // Mark as selected
}
?>
<option value="<?php echo $subcategoryValue; ?>" <?php echo $selected; ?>><?php echo $subcategoryName; ?> </option>
  
<?php
}
}
?>
</optgroup>
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
                        <input class="form-control date start input-sm" size="20" type="date"  Placeholder="" name="todate" id="to" data-date="" data-date-format="dd-mm-yyyy" data-link-field="any" data-link-format="dd-mm-yyyy" >
                    </div>
                  <br/>
					<div class="mb-3">
					<button type="submit" name="btnSubmit" class="btn btn-success col-md-3">Generate <i class="fa fa-arrow-circle-right bold"></i></button>
                    </div>
                </form>

<div class="nav-pagination">
    
</div>        </div>
    </div>
    </div>
     <div class="col-md-3">       </div> 
    </div>
</div>

<div id="footer">
    <div class="container-fluid">
        <p>
            <span>2024 &copy; Bantu Track
            
                        </span>
        </p>
    </div>
</div>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
    window.lang = {
        select_all: 'Select all',
        deselect_all: 'Deselect All',
        no_results_matched: 'No results matched',
        close: 'Close',
        device: 'Device',
        address: 'Address',
        position: 'Position',
        altitude: 'Altitude',
        speed: 'Speed',
        angle: 'Angle',
        time: 'Time',
        model: 'Model',
        plate: 'Plate',
        protocol: 'Protocol',
        alerts_maximum_date_range: 'Maximum date range is 90 days.',
        successfully_created_alert: 'Successfully created alert',
        successfully_updated_alert: 'Successfully updated alert',
        geofence: 'Geofence',
        event: 'Event',
        successfully_created_geofence: 'Successfully created geofence',
        successfully_updated_geofence: 'Successfully updated geofence',
        came: 'Came',
        left: 'Left',
        duration: 'Duration',
        route_length: 'Route length',
        move_duration: 'Move duration',
        stop_duration: 'Stop duration',
        top_speed: 'Top speed',
        fuel_cons: 'Fuel cons.',
        parameters: 'Parameters',
        driver: 'Driver',
        street_view: 'Street view',
        preview: 'Preview',
        route_start: 'Route start',
        route_end: 'Route end',
        sensors: 'Sensors',
        successfully_created_route: 'Successfully created route',
        successfully_updated_route: 'Successfully updated route',
        gps: 'GPS',
        lat: 'Latitude',
        lng: 'Longitude',
        all_parameters: 'Show more',
        hide_parameters: 'Show less',
        nothing_selected: 'Nothing selected',
        color: 'Color',
        from: 'From',
        to: 'To',
        add: 'Add',
        follow: 'Follow',
        on: 'On ',
        off: 'Off',
        streetview: 'Street view',
        successfully_created_marker: 'Successfully created marker',
        successfully_updated_marker: 'Successfully updated marker',
        status_offline: 'Offline',
        status_online: 'Online',
        status_ack: 'ACK',
        status_engine: 'Engine',
        alert: 'Alert',
        short_h: 'h',
        short_m: 'min',
        short_s: 's',
        distance: 'Distance',
        remove: 'Delete',
        expiration_date: 'Expiration date'
    };
</script>
<script src="js/core.js?t=1688814127"></script>
<script src="js/app.js?t=1688814127"></script>

<script type="text/javascript">
    $.extend(true, app, {"debug":false,"user_id":7,"version":"3.6.10","firstLogin":false,"offlineTimeout":3600,"checkFrequency":5,"lang":{"key":"en","iso":"en","iso3":"eng","title":"English(USA)","active":true,"dir":"ltr","flag":"en.png","locale":"en_US"},"show_object_info_after":0,"object_listview":0,"channels":{"userChannel":"0af19a1d9258ce39a8527107a9356259"},"settings":{"units":{"speed":{"unit":"kph","radio":1},"distance":{"unit":"Km","radio":1},"altitude":{"unit":"m","radio":1},"capacity":{"unit":"Liters","radio":1}},"timeFormat":"hh:mm:ss A","dateFormat":"DD-MM-YYYY","weekStart":1,"mapCenter":{"lat":51.505,"lng":-0.09},"mapZoom":"19","map_id":2,"availableMaps":["3","1","4","5","2"],"toggleSidebar":false,"showTraffic":false,"showTotalDistance":0,"animateDeviceMove":"1","showGeofenceSize":0,"showEventSectionAddress":0,"showDevice":true,"showGeofences":false,"showRoutes":true,"showPoi":true,"showTail":false,"showNames":true,"showHistoryRoute":true,"showHistoryArrow":true,"showHistoryStop":true,"showHistoryEvent":true,"keys":{"google_maps_key":"AIzaSyDm9g4Nd4GPet7s3O6nyW3zCvKqQclONW8","here_map_id":null,"here_map_code":null,"here_api_key":"","mapbox_access_token":"pk.eyJ1Ijoic2FsZXNpbXByZXNzaXZlYmQiLCJhIjoiY2xtNmNxODZtMmxwajNqcDZ4aGExZGluMCJ9.70Wq5Wj4jxiF6BeUDQMjeg","bing_maps_key":"","maptiler_key":"","tomtom_key":""},"googleQueryParam":{"key":"AIzaSyDm9g4Nd4GPet7s3O6nyW3zCvKqQclONW8","language":"en"},"openmaptiles_url":"","showStreetView":false},"urls":{"asset":"https:\/\/track.bantutrack.com\/","streetView":"https:\/\/track.bantutrack.com\/streetview.jpg","geoAddress":"https:\/\/track.bantutrack.com\/geo_address","events":"https:\/\/track.bantutrack.com\/events","eventDoDelete":"https:\/\/track.bantutrack.com\/events\/do_destroy","history":"https:\/\/track.bantutrack.com\/history","historyExport":"https:\/\/track.bantutrack.com\/history\/export","historyPosition":"https:\/\/track.bantutrack.com\/history\/position","historyPositions":"https:\/\/track.bantutrack.com\/history\/positions","historyPositionsDelete":"https:\/\/track.bantutrack.com\/history\/delete_positions","check":"https:\/\/track.bantutrack.com\/objects\/items_json","devices":"https:\/\/track.bantutrack.com\/objects\/items","deviceDelete":"https:\/\/track.bantutrack.com\/objects\/destroy","deviceChangeActive":"https:\/\/track.bantutrack.com\/devices\/change_active","deviceToggleGroup":"https:\/\/track.bantutrack.com\/objects\/change_group_status","deviceStopTime":"https:\/\/track.bantutrack.com\/objects\/stop_time\/","deviceFollow":"https:\/\/track.bantutrack.com\/devices\/follow_map\/","devicesSensorCreate":"https:\/\/track.bantutrack.com\/sensors\/create\/","devicesServiceCreate":"https:\/\/track.bantutrack.com\/services\/create\/","devicesServices":"https:\/\/track.bantutrack.com\/services\/index\/","devicesCommands":"https:\/\/track.bantutrack.com\/devices\/commands","deviceImages":"https:\/\/track.bantutrack.com\/device_media\/images\/","deviceImage":"https:\/\/track.bantutrack.com\/device_media\/image\/","deleteImage":"https:\/\/track.bantutrack.com\/device_media\/delete\/","deviceSendGprsCommand":"https:\/\/track.bantutrack.com\/send_command\/gprs","deviceWidgetLocation":"https:\/\/track.bantutrack.com\/device\/widgets\/location\/","deviceWidgetCameras":"https:\/\/track.bantutrack.com\/device\/widgets\/cameras\/","deviceWidgetImage":"https:\/\/track.bantutrack.com\/device\/widgets\/image\/","deviceWidgetUploadImage":"https:\/\/track.bantutrack.com\/devices\/image\/upload\/","deviceWidgetFuelGraph":"https:\/\/track.bantutrack.com\/device\/widgets\/fuel_graph\/","deviceWidgetGprsCommand":"https:\/\/track.bantutrack.com\/device\/widgets\/gprs_command\/","deviceWidgetRecentEvents":"https:\/\/track.bantutrack.com\/device\/widgets\/recent_events\/","deviceWidgetTemplateWebhook":"https:\/\/track.bantutrack.com\/device\/widgets\/template_webhook\/","geofences":"https:\/\/track.bantutrack.com\/geofences","geofenceChangeActive":"https:\/\/track.bantutrack.com\/geofences\/change_active","geofenceDelete":"https:\/\/track.bantutrack.com\/geofences\/destroy","geofencesExportType":"https:\/\/track.bantutrack.com\/geofences\/export_type","geofencesImport":"https:\/\/track.bantutrack.com\/geofences\/import","geofenceToggleGroup":"https:\/\/track.bantutrack.com\/geofences_groups\/change_status","routes":"https:\/\/track.bantutrack.com\/route","routeChangeActive":"https:\/\/track.bantutrack.com\/route\/change_active","routeDelete":"https:\/\/track.bantutrack.com\/route\/destroy","alerts":"https:\/\/track.bantutrack.com\/alerts","alertEdit":"https:\/\/track.bantutrack.com\/alerts\/edit","alertChangeActive":"https:\/\/track.bantutrack.com\/alerts\/change_active","alertDelete":"https:\/\/track.bantutrack.com\/alerts\/destroy","alertGetEvents":"https:\/\/track.bantutrack.com\/custom_events\/get_events","alertGetProtocols":"https:\/\/track.bantutrack.com\/custom_events\/get_protocols","alertGetEventsByDevice":"https:\/\/track.bantutrack.com\/custom_events\/get_events_by_device","alertGetCommands":"https:\/\/track.bantutrack.com\/alerts\/commands","pois":"https:\/\/track.bantutrack.com\/pois","poisDelete":"https:\/\/track.bantutrack.com\/pois\/destroy","poisChangeActive":"https:\/\/track.bantutrack.com\/pois\/change_active","poisToggleGroup":"https:\/\/track.bantutrack.com\/pois_groups\/change_status","changeMap":"https:\/\/track.bantutrack.com\/my_account\/change_map","changeMapSettings":"https:\/\/track.bantutrack.com\/my_account_settings\/change_map_settings","clearQueue":"https:\/\/track.bantutrack.com\/sms_gateway\/clear_queue","listView":"https:\/\/track.bantutrack.com\/objects\/list","listViewItems":"https:\/\/track.bantutrack.com\/objects\/list\/items","chatMessages":"https:\/\/track.bantutrack.com\/chat\/\/messages","dashboard":"https:\/\/track.bantutrack.com\/dashboard","dashboardBlockContent":"https:\/\/track.bantutrack.com\/dashboard\/block_content","lockHistory":"https:\/\/track.bantutrack.com\/lock_status\/history\/","lockStatus":"https:\/\/track.bantutrack.com\/lock_status\/status\/","unlockLock":"https:\/\/track.bantutrack.com\/lock_status\/unlock\/","checklistUpdateRowStatus":"https:\/\/track.bantutrack.com\/checklists\/update_row_status\/","checklistUpdateRowOutcome":"https:\/\/track.bantutrack.com\/checklists\/update_row_outcome\/","checklistUploadFile":"https:\/\/track.bantutrack.com\/checklists\/upload_file\/","checklistSign":"https:\/\/track.bantutrack.com\/checklists\/sign_checklist\/","checklistGetRow":"https:\/\/track.bantutrack.com\/checklists\/get_row\/","deviceConfigApnData":"https:\/\/track.bantutrack.com\/devices_config\/getApnData\/","importGetFields":"https:\/\/track.bantutrack.com\/import\/get_fields"}});
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', 'select[name="group_id"]', showHideClientFields);

        $(document).on('change', 'input[name="enable_devices_limit"]', function() {
            if ($(this).prop('checked'))
                $('input[name="devices_limit"]').removeAttr('disabled');
            else
                $('input[name="devices_limit"]').attr('disabled', 'disabled');
        });

        $(document).on('change', 'input[name="enable_expiration_date"]', function() {
            if ($(this).prop('checked'))
                $('input[name="expiration_date"]').removeAttr('disabled');
            else
                $('input[name="expiration_date"]').attr('disabled', 'disabled');
        });

        $(document).on('change', 'input[name="password_generate"]', function() {
            var
                $this = $(this),
                _checked = $this.is(':checked'),
                $siblings = $('input[name="password_generate"]').not(this);

            if (_checked) {
                $siblings.prop('checked', false);
                $siblings.removeAttr('checked');
                $siblings.trigger('change');

                $this.prop('checked', true);
                $this.attr('checked', 'checked');
            }
        });

        $(document).on('change', 'select[name="billing_plan_id"], select[name="group_id"]', function () {
            var el = $(this);
            var url = el.data('url');
            var parent = el.closest('.modal-dialog');
            var table = parent.find('.user_permissions_ajax');
            var user_id = parent.find('input[name="id"]').val();

            var data = {
                id: el.val(),
                user_id: user_id
            };

            if (el.attr('name') === 'group_id') {
                var billing_plan_select = $('select[name="billing_plan_id"]');

                if (billing_plan_select.length > 0 && billing_plan_select.val() != 0)
                    return;

                data = {
                    group_id: el.val(),
                    user_id: user_id
                };
            }


            $.ajax({
                type: 'GET',
                dataType: "html",
                url: url,
                data: data,
                beforeSend: function() {
                    loader.add( table );
                },
                success: function(res){
                    table.html(res);
                },
                complete: function() {
                    loader.remove( table );
                },
            });
        });
    });

    function showHideClientFields() {
        var group_id = $('select[name="group_id"]').val();
        if (group_id == 2) {
            $('.field_manager_id').show();
        }
        else {
            $('.field_manager_id').hide();
        }
    }

    tables.set_config('table_clients', {
        url:'https://track.bantutrack.com/admin/users/clients',
        do_destroy: {
            url: 'https://track.bantutrack.com/admin/users/clients/do_destroy',
            modal: 'clients_delete',
            method: 'GET'
        },
        set_active: {
            url: 'https://track.bantutrack.com/admin/users/clients/active/1',
            method: 'POST'
        },
        set_inactive: {
            url: 'https://track.bantutrack.com/admin/users/clients/active/0',
            method: 'POST'
        }
    });

    function clients_edit_modal_callback() {
        tables.get('table_clients');
    }

    function clients_create_modal_callback() {
        tables.get('table_clients');
    }


    function clients_delete_modal_callback() {
        tables.get('table_clients');
    }

    function devices_import_modal_callback() {
        tables.get('table_clients');
    }
</script>

<script>
    $.ajaxSetup({cache: false});
    window.lang = {
        nothing_selected: 'Nothing selected',
        color: 'Color',
        from: 'From',
        to: 'To',
        add: 'Add'
    };
    app.lang = {"key":"en","iso":"en","iso3":"eng","title":"English(USA)","active":true,"dir":"ltr","flag":"en.png","locale":"en_US"};
    app.initSocket();
</script>







        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <script src="js/demo/datatables-demo.js"></script>
    <!-- Bootstrap core JavaScript-->
  
</body>
</html>

<?php
}
else {
	header('location:../Account/index.php');
}
?>
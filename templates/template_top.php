<!DOCTYPE html>
<html lang="en">
<head>
	<title>WCFCourier.com | Map: Crimes reported in the Cedar Valley</title>
    
    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/leaflet/leaflet.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/leaflet/leaflet.ie.css"  />
    <style type="text/css">
    #all-reports-tab {
        opacity: 0;
        filter: alpha(opacity = 0);
        zoom: 1;
        cursor: default;
    }
    #all-reports-tab a {
        cursor: default;
    }
    </style>
    <![endif]-->

    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/leaflet/MarkerCluster.css" />
    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/leaflet/MarkerCluster.Default.css" />
    
    <link rel="stylesheet" type="text/css" id="themeCSS" href="http://wcfcourier.com/app/crime_map/jQRangeSlider/css/classic.css">
    <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/crime_map/jQRangeSlider/demo/style.css">
    <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/crime_map/jQRangeSlider/demo/lib/jquery-ui/css/smoothness/jquery-ui-1.8.10.custom.css">
    
    <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/crime_map/datatables/media/css/demo_page.css">
    <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/crime_map/datatables/media/css/demo_table.css">
    
    <link href="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://wcfcourier.com/app/crime_map/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/crime_map/css/styles_percent.css">
    
	<script src="http://wcfcourier.com/app/crime_map/leaflet/leaflet_05.js"></script>
    <script src="http://wcfcourier.com/app/crime_map/leaflet/leaflet.markercluster-src.js"></script>
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="http://wcfcourier.com/app/crime_map/js/jquery.js"></script>
    <script src="http://wcfcourier.com/app/crime_map/js/jquery.geocodify.0.11.min.js"></script>
    
	<script type="text/javascript" src="http://wcfcourier.com/app/crime_map/datatables/jquery.dataTables.js"></script>

    <script src="http://wcfcourier.com/app/crime_map/jQRangeSlider/demo/lib/jquery-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script src="http://wcfcourier.com/app/crime_map/jQRangeSlider/lib/jquery.mousewheel.min.js"></script>
	
     <script type="text/javascript" src="http://wcfcourier.com/app/crime_map/js/bootstrap-dropdown.js"></script>
	<script src="http://wcfcourier.com/app/crime_map/js/bootstrap-tab.js"></script>
    <script src="http://wcfcourier.com/app/crime_map/datatables/DT_bootstrap.js"></script>
</head>
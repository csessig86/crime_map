<!DOCTYPE html>
<html lang="en">
<head>
    <title>WCFCourier.com | Map: Crimes reported in Waterloo, Iowa in 2013</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="http://wcfcourier.com/icon.ico" />
    <meta name="description" content="This map displays crimes reported in Waterloo, Iowa." />
    <meta name="keywords" content="Waterloo,Iowa,crime,Courier" />
    <meta name="author" content="Lee Enterprises" />

    <!-- Mobile meta tags-->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="http://wcfcourier.com/app/special/facebookcourierlogo.jpg"/>
    <meta http-equiv="cleartype" content="on">

    <!-- Facebook meta tags-->
    <meta property="og:title" content="WCFCourier.com | Crimes reported in Waterloo" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="wcfcourier.com" />
    <meta property="og:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg" />
    <meta property="og:description" content="This map displays crimes reported in Waterloo, Iowa." />
    <meta property="og:site_name" content="WCFCourier"/>

    <!-- Twitter meta tags -->
    <meta property="twitter:site" content="@WCFCourier">
    <meta property="twitter:card" content="This map displays crimes reported in Waterloo, Iowa.">
    <meta property="twitter:url" content="http://wcfcourier.com/app/crime_map/">
    <meta property="twitter:title" content="Crimes reported in the Waterloo">
    <meta property="twitter:description" content="This map displays crimes reported in Waterloo, Iowa.">
    <meta property="twitter:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg">

    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/leaflet/leaflet.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/leaflet/leaflet.ie.css"  />
    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/css/lib/font-awesome-ie7.min.css" />
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

    <link rel="stylesheet" href="http://wcfcourier.com/app/crime_map/css/lib/font-awesome.css" />
    <!-- <link rel="stylesheet" href="css/lib/leaflet.awesome-markers.css" /> -->

    <link rel="stylesheet" type="text/css" href="http://wcfcourier.com/app/crime_map/css/styles_percent.css">
    
    <style>
    body {
        padding: 10px 0 0 0;
    }

    /* Description, popup boxes */
    .toggle_description {
        padding: 10px;
        font-size: 16px;
        z-index: 9;
        position: relative;
        float: right;
        right: 0%;
        top: 0%;
        margin: 5px;
    }

    .toggle_description, .toggle_popup {
        padding: 10px;
        font-size: 16px;
        z-index: 9;
        position: relative;
        float: right;
    }

    .description_box_cover, .popup_cover {
        display: none;
        z-index: 12;
        position: absolute;
        top: 0%;
        width: 100%;
        height: 100%;
    }

    .description_box_cover {
        background-color: #333333;
        background-color:rgba(33,33,33,0.9);
    }

    .popup_cover {
        background-color: #666666;
        background-color:rgba(66,66,66,0.6);
    }

    .description_box, .popup {
        position: absolute;
        display: none;
        z-index: 13;
        background-color: #FFFFFF;
        border: 1px solid #999;
        overflow: scroll;
        padding-left: 1%;
        padding-right: 1%;
        padding-top: 1%;
    }

    .description_box {
        height: 96%;
        width: 96%;
        left: 1%;
        top: 1%;
        overflow: scroll;
        -webkit-overflow-scrolling: touch;  
    }

    .description_box_text_header h4 {
        font-family: Georgia;
        font-size: 17.5px;
        margin: 10px 0;
        height: 40px;
    }

    .description_box_text_etc h4 {
        margin-bottom: 5px;
    }

    #mobile_header {
        position: absolute;
        display: none;
        float: left;
        width: 100%;
        z-index: 10;
        border-width: 0 0 1px;
        border-bottom: 1px solid #333;
        box-shadow: 1px 0 3px 0 #444444;
        margin-top: 0%;
        float: left;
        left: 0%;
        right: 0%;
        height: auto;
        background-color: #FFF;
    }

    #mobile_header h4 {
        font-size: 16px;
        margin: 0;
        padding: 5px;
        font-family: Georgia;
        line-height: 22px;
    }


    /* Map */
    #map_table {
        height: 675px;
        clear: both;
        float: left;
    }

    #map {
        border: 0px solid #FFF;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        float: left;
        position: absolute;
        width: 100%;
        z-index: 6;
        background-color: #ddd;
    }

    #geocode_box {
        margin: 10px 10px 0 0;
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        box-shadow: -1px 1px 3px 0 #666;
        float: right;
        height: 100px;
        padding-left: 5px;
        position: absolute;
        right: 0;
        width: 350px;
        z-index: 10;
    }

    .dropdown-menu {
        z-index: 5000;
    }

    #geocode_box h3 {
        font-size: 16px;
    }
    

    #geocode_box form, .description_box_text_etc form {
        margin-top: 10px;
    }

    .select-map input {
        margin: 0 5px;
    }

    .legend-desktop {
        line-height: 18px;
        color: #333;
        background-color: #FFF;
        padding: 10px;
        border: 1px solid #CCCCCC;
        box-shadow: -1px 1px 3px 0 #666;
    }

    .legend-mobile {
       float: right;
        margin: 0 10px;
    }

    .legend-header {
        font-weight: bold;
        padding-bottom: 5px;
        font-size: 14px;
    }
    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 1;
    }

    #credits {
        display: none;
    }


    @media (max-width: 767px) {
        body {
            padding: 0;
        }

        #mobile_header {
            display: inline;
        }
        #map {
            border: 0px solid #FFF;
            height: 100%;
        }
        .leaflet-top, .leaflet-control-attribution {
            display: none;
        }

        #credits {
            display: inline;
        }
    }

    #crime_table {
        width: 100%;
        float: left;
    }
    </style>

    <script src="http://wcfcourier.com/app/crime_map/leaflet/leaflet.js"></script>
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
<body>
<div id="main_content">

<div class="hidden-phone">
<div id="nav-primary">
    <ul class="nav nav-tabs">
        <li>
            <a href="profile.php">Profile</a>
        </li>
        <li id="all-reports-tab">
            <a href="map_index_all.php">All</a>
        </li>
        <li>
            <a href="map_index_jan.php">Jan.</a>
        </li>
        <li>
            <a href="map_index_feb.php">Feb.</a>
        </li>
        <li>
            <a href="map_index_march.php">March</a>
        </li>
        <li>
            <a href="map_index_april.php">April</a>
        </li>
        <li>
            <a href="map_index_may.php">May</a>
        </li>
        <li>
            <a href="map_index_june.php">June</a>
        </li>
        <li>
            <a href="map_index_july.php">July</a>
        </li>
        <li>
            <a href="map_index_aug.php">Aug.</a>
        </li>
        <li>
            <a href="map_index_sept.php">Sept.</a>
        </li>
        <li>
            <a href="map_index_oct.php">Oct.</a>
        </li>
        <li>
            <a href="map_index_nov.php">Nov.</a>
        </li>
        <li>
            <a href="map_index_dec.php">Dec.</a>
        </li>
        <li class="active">
            <a href="map_index_review.php">Year in review</a>
        </li>
    </ul>
</div>
</div>

<div id="mobile_header" class="header-footer" class="visible-phone">
    <div class="toggle_description btn icon-info-sign" type="button"></div>

    <!-- <div class="dropdown" style="padding-bottom: 0px; font-size: 14px;">
        <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" href="#">
            Click here toggle between months
            <b class="caret"></b>
        </a>
        <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
            <li><a href="profile.php">Community Profile</a></li>
            <li><a href="map_index_all.php">All reports of crime</a></li>
            <li><a href="map_index_jan.php">January reports</a></li>
            <li><a href="map_index_feb.php">February reports</a></li>
            <li><a href="map_index_march.php">March reports</a></li>
            <li><a href="map_index_april.php">April reports</a></li>
            <li><a href="map_index_may.php">May reports</a></li>
            <li><a href="map_index_june.php">June reports</a></li>
            <li><a href="map_index_july.php">July reports</a></li>
            <li><a href="map_index_aug.php">August reports</a></li>
            <li><a href="map_index_sept.php">September reports</a></li>
            <li><a href="map_index_oct.php">October reports</a></li>
            <li><a href="map_index_nov.php">November reports</a></li>
            <li><a href="map_index_dec.php">December reports</a></li>
            <li><a href="test_wloo_review.html" target="_blank">Map: Year in review</a></li>
        </ul>
    </div> -->
    <h4>Map: Crimes reported in Waterloo in 2013</h4>
</div>

<div id='info-map' class='hidden-phone'>
<p><strong>About:</strong> What areas had the most reported crimes in Waterloo this year? On this map, the city of Waterloo is divided into several <a href="http://cran.r-project.org/web/packages/hexbin/vignettes/hexagon_binning.pdf" target="_blank">hexagon shapes</a>. The darker the shapes, the more crimes that particular area had in 2013. Use the view options to toggle between violent and property crimes.</p>
<p><strong>Note:</strong> What areas had the most reported crimes in Cedar Falls this year? On this map, the city of Cedar Falls is divided into several <a href="http://cran.r-project.org/web/packages/hexbin/vignettes/hexagon_binning.pdf" target="_blank">hexagon shapes</a>. The darker the shapes, the more crimes that particular area had in 2013. Use the view options to toggle between violent and property crimes. Click on a hexagon to see how many crimes happened in that area.</p>
</div>

<!-- For mobile -->
<div class="description_box box-shadow">
    <div class="x_button toggle_description btn icon-remove" type="button"></div>
    <div class="description_box_content">
        <div class="description_box_text">
            <div class="description_box_text_header"></div>
            <div class="description_box_text_etc"></div>
            <form id='select-map-mobile' class='select-map'>
                <input type="radio" name="map-filter" value="violent" checked>Violent crimes
                <input type="radio" name="map-filter" value="property">Property crimes
            </form>
        </div>
    </div>
    <br />
    <strong>More crime coverage</strong><br />
    - <a href="http://wcfcourier.com/app/crime_map/index_mobile_wloo.php">View reports for December and other months in Waterloo</a>
    <br />
    - <a href="http://wcfcourier.com/app/crime_map/templates/cf/map_index_review.php">View crime map for Cedar Falls</a>
    <br />
    <br />
    <div id="credits">
        <strong>Credits</strong>
        <p>- Interactive by: <a href="http://twitter.com/courieressig" target="_blank">Chris Essig</a>
        <br />
        - <a href="https://docs.google.com/spreadsheet/pub?key=0As3JvOeYDO50dDRYWUdUNEg3QXB0UG42ZE9TNXZCTnc&output=html" target="_blank">View the data used to make the map</a>
        <br />
        - Map made using <a title="A JS library for interactive maps" href="http://leafletjs.com">Leaflet</a>
        <br />
        - Map data CCBYSA &copy; 2012 OpenStreetMap contributors, Imagery &copy; 2012 CloudMade</p>
        <br />
        <br />
    </div>
</div>
<div class="description_box_cover"></div>


<table id="map_table">
    <tr>
        <td>
            <div class="hidden-phone">
                <div id="geocode_box">
                    <h3>Search for an address</h3>
                    <table>
                    <tr>
                        <td>
                        <form id="geocoder"></form>
                        </td>
                    </tr>
                    </table>
                    <form id='select-map-desktop' class='select-map'>
                        <input type="radio" name="map-filter" value="violent" checked>Violent crimes
                        <input type="radio" name="map-filter" value="property">Property crimes
                    </form>
                </div>
            </div>
            <div id="map"></div>
        </td>
    </tr>
</table>

<h2 id="crime_table_h2" style="float: left;">Search through the records</h2>

<table class="table table-striped table-bordered" id="crime_table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Crime</th>
            <th>Location</th>
            <th>Disposition</th>
        </tr>
    </thead>
    <tbody id="crime_table_tbody">
    </tbody>
</table>

<script src="http://wcfcourier.com/app/crime_map/JSON/crime_data_review_violent.json"></script>
<script src="http://wcfcourier.com/app/crime_map/JSON/crime_data_review_property.json"></script>
<script src="http://wcfcourier.com/app/crime_map/js/script_map_review.js"></script>

<!--[if lte IE 8]>
<script type="text/javascript">
$('#all-reports-tab a').click(function(e) {
        return false;
});

$('#crime_table').hide();
$('#crime_table_h2').hide();
</script>
<![endif]-->

<!--[if !IE]><!-->
<script src="http://wcfcourier.com/app/crime_map/JSON/crime_data.json"></script>
<script type="text/javascript">
if ($(window).width() > 626) {
  tableCreate();
}   
</script>
<!--[endif]-->

</body>
</html>
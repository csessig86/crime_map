<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WCFCourier.com | Crimes reported in Cedar Falls, Iowa</title>

<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="Lee Enterprises" />
<meta property="og:title" content="WCFCourier.com | Crimes reported in Cedar Falls, Iowa" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="wcfcourier.com" />
<meta property="og:image" content="http://www.wcfcourier.com/app/images/site-logo.png" />
<meta property="fb:app_id" content="125197567518585" />
<link rel="shortcut icon" type="image/x-icon" href="http://wcfcourier.com/icon.ico" />

<script src="js/jquery.js"></script>
<script type="text/javascript" src="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/js/bootstrap-tab.js"></script>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<link href="http://wcfcourier.com/app/special/grassley_sweeney/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="http://wcfcourier.com/app/crime_map/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

<style type="text/css">
@media (max-width: 767px) {
	#crime_iframe_id {
		height: 1300px;
	}
	
	#last_updated {
		float: left;
	}
	.navbar-fixed-top {
		padding-left: 3%;
		padding-right: 3%;
	}
}

#p_container {
	padding-left: 1%;
	padding-top: 5%;
}

body {
	width: 100%
	padding: 0px;
}

body p {
    font-family: Arial,Helvetica,sans-serif;
    font-size: 14px;
	color: rgb(51, 51, 51);
	padding: 0px;
}

#intro_table {
    margin: 0 0 0 5px;
}

#share li {
    float: left;
    list-style: none;
    margin-right: 2px;
}

#last_updated {
    font-weight: bold;
	float: right;
	padding: 25px 10px 35px 10px;
}

#last_updated_mobile {
    font-weight: bold;
	padding: 0 0 10px 0;
}

#last_updated_red_text {
    color: #930000;
    font-style: italic;
    display: inline;
}

#main_content {
    width: 100%;
}

#main_content h2 {
    font-family: Georgia,serif;
	color: rgb(51, 51, 51);
}
#share {
    margin-top: 5px;
}

#share li {
    float: left;
    margin-right: 2px;
}
hr {
    background: #DDD;
    color: #DDD;
    clear: both;
    float: none;
    width: 100%;
    height: 1px;
    margin: 0 0 15px 0;
    border: none;
}
#credits {
	font-family: Arial,Helvetica,sans-serif;
	font-size: 13px;
	float: left;
	color: #778899;
}
#credits a {
	color: #778899;
}
</style>
</head>
<body style="padding: 0px" onLoad="last_updated();">
<a name="top"> </a>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="http://wcfcourier.com" alt="Waterloo-Cedar Falls Courier">
				<img src="icons/WCFCourier.com_LOGO_300px.gif" width="116px" />
			</a>
			<a class="btn btn-navbar" data-toggle="collapse" data-target="#mobile-nav">Cedar Valley crime reports</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li><a href="index_mobile.php">Home</a></li>
					<li><a href="index_mobile_wloo.php">Waterloo crime reports</a></li>
					<li><a href="index_mobile_cf.php">Cedar Falls crime reports</a></li>
				</ul>
			</div>
			<div id="mobile-nav" class="nav-collapse hidden-desktop">
				<ul class="nav">
					<li><a href="index_mobile.php">Home</a></li>
					<li><a href="index_mobile_wloo.php">Waterloo crime reports</a></li>
					<li><a href="index_mobile_cf.php">Cedar Falls crime reports</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
  
<div id="p_container">
<div id="p_content">
<div id="main_content">
<div id="header">
	<div id="share">
    	<table>
        	<tr>
				<td><a data-text="" href="http://twitter.com/share" url="http://wcfcourier.com/app/crime_map/" class="twitter-share-button" data-count="horizontal">Tweet</a>
				<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></td>
				<td><g:plusone size="medium"></g:plusone></td>
				<td><div id="fb-root"></div>
				<script src="http://connect.facebook.net/en_US/all.js#appId=161694630579757&amp;xfbml=1"></script>
            	<fb:like href="" send="false" layout="button_count" width="90" show_faces="false" font=""></fb:like></td>
            </tr>
        </table>
	</div>
</div>

<h2>Crimes reported in Cedar Falls, Iowa</h2>

<hr>

<div class="hidden-phone">
	<div id="last_updated"></div>
</div>
<div class="visible-phone">
	<div id="last_updated_mobile"></div>
</div>

<p>The chart below displays crimes reported in Cedar Falls, Iowa, since the beginning of the year. The information is gathered from the Cedar Falls Police Department, which keeps a <a href="http://www.cedarfalls.com/Archive.aspx?AMID=82" target="_blank">log of calls for service</a>. Not all calls are mapped; minor reports like business checks and traffic stops are not shown below. Instead, we have selected seven categories of reports to map.</p>

<p>Select a month below to filter the number of reported crimes that are pinpointed on the map.</p>

<iframe id="crime_iframe_id" name="crime_iframe" class="map_embed" height="1750" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src='templates/cf/map_index_july.php'></iframe>

</div><!-- close main_content -->

<div class='visible-phone'>
<a class='btn btn-info' href="#top">Return to the Top</a>
</div>

<div id="credits">
	<p>Interactive by: <a href="http://twitter.com/courieressig" target="_blank">Chris Essig</a>	|	Data provided by: <a href="http://www.cedarfalls.com/Archive.aspx?AMID=82" target="_blank">Cedar Falls Police Department</a>
    <br /><br />
    &copy; Copyright 2012, <a href="/" target="_blank">wcfcourier.com</a>, 100 E. 4th St. Waterloo, IA | <a href="/terms/" target="_blank">Terms of Service</a> and <a href="/privacy/" target="_blank">Privacy Policy</a></p>
</div>


</div><!-- close p_content -->	
</div><!-- close p_container -->
<script src="JSON_cf/crime_data.json"></script>
<script type="text/javascript">
// This variable is used to calculate the last date in the JSON file
// We'll then use it with the slider
count = 0;

for (incident in crime_data) {
	count++;
}

// Split the first and last date in the JSON file
// Then set it in the slider below
first_date = crime_data[0].date.split("-");
last_date = crime_data[count -1].date.split("-");

function last_updated() {
    $('#last_updated').html('Last updated: <br /> <div id="last_updated_red_text">' + (last_date[1]) + '-' + last_date[2] + '-' +  last_date[0] + '</div>');
	$('#last_updated_mobile').html('Last updated: <div id="last_updated_red_text">' + (last_date[1]) + '-' + last_date[2] + '-' +  last_date[0] + '</div>');
}

//This counter will determine if this is our second time 
// Or later through the slider method
// If it is, we will destroy the old table
// Set the HTML to the new table info
// And call our start_table function to make it a datatable
	
// function load_table() {
	// $('#crime_table').dataTable().fnDestroy();
	// $('#crime_table_tbody').html(window.crime_iframe.crime_data_table);
	// start_table();
// };

// function start_table() {
	// $('#crime_table').dataTable({
		// "sPaginationType": "bootstrap",
		// "oLanguage": {
			// "sLengthMenu": "_MENU_ records per page"
		// }
	// });
// };

</script>


<!-- SiteCatalyst code version: H.7. Copyright 1997-2006 Omniture, Inc. navblack info available at http://www.omniture.com -->
    <script language="JavaScript" src="http://www.wcfcourier.com/app/omniture/s_code.js" type="text/javascript"></script>
    <script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on the next lines. */
    s.pageName="Crimes reported in Cedar Falls: Mobile"
    s.server="Waterloo"
    s.channel="wcfcourier.com"
    s.pageType=""
    s.prop1=""
    s.prop2=""
    s.prop3=""
    s.prop4=""
    s.prop5=""
    s.prop6=""
    s.prop7=""
    s.prop8=""
    s.prop9=""
    s.prop10=""
    s.prop11=""
    s.prop12=""
    s.prop13=""
    s.prop14=""
    s.prop15=""
    s.prop16=""
    s.prop17=""
    s.prop18=""
    s.prop19=""
    s.prop20=""
    s.prop21=""
    s.prop22=""
    s.prop23=""

/* E-commerce Variables */
    s.campaign=""
    s.state=""
    s.zip=""
    s.events=""
    s.products=""
    s.purchaseID=""
    s.eVar1=""
    s.eVar2=""
    s.eVar3=""
    s.eVar4=""
    s.eVar5=""

/* Hierarchy Variables */
    s.hier1="Lee Enterprises," + s.server + "," + s.channel + "," + s.prop1 + "," + s.prop2 + "," + s.prop3 + "," + s.prop4 + "," + s.prop5
    s.hier2="Lee Enterprises," + s.prop1 + "," + s.server + "," + s.channel + "," + s.prop2 + "," + s.prop3 + "," + s.prop4 + "," + s.prop5
/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
    var s_code=s.t();if(s_code)document.write(s_code)//--></script>
        <script language="JavaScript" type="text/javascript"><!--
    if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
    //--></script>
<!--/DO NOT REMOVE/-->
<!-- End SiteCatalyst code version: H.7. -->
</body>
</html>

<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WCFCourier.com | Crimes reported in the Cedar Valley</title>

<link rel="shortcut icon" type="image/x-icon" href="http://wcfcourier.com/icon.ico" />
<meta name="description" content="This map displays crimes reported in Waterloo, Iowa and Cedar Falls, Iowa." />
<meta name="keywords" content="Waterloo,Cedar Falls,Iowa,crime,Courier" />
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
<meta property="og:title" content="WCFCourier.com | Crimes reported in the Cedar Valley" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="wcfcourier.com" />
<meta property="og:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg" />
<meta property="og:description" content="These maps display crimes reported in Waterloo, Iowa and Cedar Falls, Iowa." />
<meta property="og:site_name" content="WCFCourier"/>

<!-- Twitter meta tags -->
<meta property="twitter:site" content="@WCFCourier">
<meta property="twitter:card" content="These maps display crimes reported in Waterloo, Iowa and Cedar Falls, Iowa.">
<meta property="twitter:url" content="wcfcourier.com/app/crime_map/">
<meta property="twitter:title" content="Crimes reported in the Cedar Valley">
<meta property="twitter:description" content="These maps display crimes reported in Waterloo, Iowa and Cedar Falls, Iowa.">
<meta property="twitter:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg">

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
	width: 100%;
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
<body style="padding: 0px">
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
				<td>
					<div id="fb-root"></div>
            		<script>(function(d, s, id) {
                		var js, fjs = d.getElementsByTagName(s)[0];
                		if (d.getElementById(id)) return;
                		js = d.createElement(s); js.id = id;
                		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=148866255208434";
                		fjs.parentNode.insertBefore(js, fjs);
            		}(document, 'script', 'facebook-jssdk'));</script>
            		<div class="fb-like" data-href="http://wcfcourier.com/app/crime_map/index_mobile.php" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
            	</td>
            </tr>
        </table>
	</div>
</div>

<h2>Crimes reported in the Cedar Valley</h2>

<hr>

<div class="hidden-phone">
	<div id="last_updated"></div>
</div>
<div class="visible-phone">
	<div id="last_updated_mobile"></div>
</div>


<div class='hidden-phone'>
<p>These maps display crimes reported in Waterloo, Iowa and Cedar Falls, Iowa. Select a map for a complete breakdown of crimes reported in each town. All data is gathered and released by the Waterloo Police Department and the Cedar Falls Police Department.</p>

<table id="intro_table">
	<tr>
		<td width='50%'>
			<h3>Waterloo</h3>
			<a href='index_mobile_wloo.php'>
				<img src='templates/wloo_screenshot.jpg' width='100%' />
			</a>
		</td>
		<td width='50%'>
			<h3>Cedar Falls</h3>
			<a href='index_mobile_cf.php'>
				<img src='templates/cf_screenshot.jpg' width='100%' />
			</a>
		</td>
	</tr>
</table>
</div>

<div class='visible-phone'>
<p>Select a city for a complete breakdown of crimes reported in each town. All data is gathered and released by the Waterloo Police Department and the Cedar Falls Police Department.</p>

<a href='index_mobile_wloo.php'>
		<h3>Waterloo</h3>
	</a>
	<br />
	<a href='index_mobile_cf.php'>
		<h3>Cedar Falls</h3>
	</a>
</div>

</div><!-- close main_content -->

<br />
<br />
<br />

<div id="credits">
	<p>Interactive by: <a href="http://twitter.com/courieressig" target="_blank">Chris Essig</a>	|	Data provided by: <a href="http://www.waterloopolice.com/images/crpress.PDF" target="_blank">Waterloo Police Department</a> and the <a href="http://www.cedarfalls.com/Archive.aspx?AMID=82" target="_blank">Cedar Falls Police Department</a>
    <br /><br />
    &copy; Copyright 2012, <a href="/" target="_blank">wcfcourier.com</a>, 100 E. 4th St. Waterloo, IA | <a href="/terms/" target="_blank">Terms of Service</a> and <a href="/privacy/" target="_blank">Privacy Policy</a></p>
</div>


</div><!-- close p_content -->	
</div><!-- close p_container -->


<!-- SiteCatalyst code version: H.7. Copyright 1997-2006 Omniture, Inc. navblack info available at http://www.omniture.com -->
    <script language="JavaScript" src="http://www.wcfcourier.com/app/omniture/s_code.js" type="text/javascript"></script>
    <script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on the next lines. */
    s.pageName="Crimes reported in the Cedar Valley: Mobile"
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

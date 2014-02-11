<?php
$title = 'WCFCourier.com | Map: Crimes reported in the Cedar Valley';
$pageKeywords = '';
$pageDescription = 'These maps display crimes reported in Waterloo and Cedar Falls, Iowa.';
$forceTabOpen = 'home';
$sidebar = 'false'; # uncomment to hide sidebar
?>


<?php include($_SERVER['DOCUMENT_ROOT'].'/app/header.php'); ?>

<meta name="description" content="This map displays crimes reported in Waterloo and Cedar Falls, Iowa." />
<meta name="keywords" content="Waterloo,Cedar Falls,Iowa,crime,Courier" />

<!-- Facebook meta tags-->
<meta property="og:title" content="WCFCourier.com | Crimes reported in the Cedar Valley" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="wcfcourier.com" />
<meta property="og:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg" />
<meta property="og:description" content="These maps display crimes reported in Waterloo and Cedar Falls, Iowa." />
<meta property="og:site_name" content="WCFCourier"/>

<!-- Twitter meta tags -->
<meta property="twitter:site" content="@WCFCourier">
<meta property="twitter:card" content="These maps display crimes reported in Waterloo and Cedar Falls, Iowa.">
<meta property="twitter:url" content="wcfcourier.com/app/crime_map/">
<meta property="twitter:title" content="Crimes reported in the Cedar Valley">
<meta property="twitter:description" content="These maps display crimes reported in Waterloo and Cedar Falls, Iowa.">
<meta property="twitter:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg">

<script type="text/javascript">
<!--
if ((screen.width < 640) && (screen.height < 960)) {
	document.location='index_mobile.php';
}
//-->
<!--
if ((navigator.userAgent.match(/iPhone/i)) || 
	(navigator.userAgent.match(/iPod/i)) ||
	(navigator.userAgent.match(/iPad/i)) ||
	(navigator.userAgent.match(/Android/i)) ||
	(navigator.userAgent.match(/webOS/i)) ||
	(navigator.userAgent.match(/BlackBerry/))) {
		location.replace("index_mobile.php");
}
-->
</script>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<style type="text/css">
body p {
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
	color: rgb(51, 51, 51);
}
.nameWrap { padding:3px;}
.titleWrap {background:#003e6e; padding:2px; color:#ffffff; font-weight:bold; margin-top:11px; clear:both;}
.subtitleWrap {background:#ccc; padding:2px; font-weight:bold; margin-top:7px;}

.name {float:left; width:300px; display:block; font-weight:bold; }
.phonenumber {float:left; display:block;}
.title {float:left; width:300px; display:block; }
.email {float:left; display:block;}
.twitter {float:right; background:url(/app/contact-us/twitter.jpg) left no-repeat; padding:1px 0 3px 18px; display:block;}


/* ##### GLOBAL TABS ##### */
.tabs { height: 1%; background: url(/app/contact-us/storyTabBground.gif) top left repeat-x; }
.tab_menu li {margin-left: 0; padding-left: 0px; border: none; list-style: none; display: inline; float:left; margin-right:2px;}
.tab_menu {margin-left: 0; padding-left: 0; display: inline; border: none; margin-right:2px;}
.tab_menu li a {display: block; padding: 0 6px; line-height: 20px; background-color: #cccccc; border: 1px solid #9DACBF; border-bottom: 0px; font-weight:bold; color:#002e6e; text-decoration:none;}
.tab_menu a.selected {background: #fff; color: #333; border: 1px solid #9DACBF; border-bottom: 0px; padding-bottom: 1px; font-weight:bold; color:#002e6e; text-decoration:none;}
.tab_item,.tab_item_selected,.tab_item2,.tab_item2_selected {clear: left; display: none; height: 1%; /* hasLayout for IE */ border: 1px solid #9DACBF; border-top: 0px;  padding: 10px; background:#FFFFFF;}
.tab_item2,.tab_item2_selected { padding: 7px; }
.tab_item_selected,.tab_item2_selected { display: block; }
/* ##### END GLOBAL TABS ##### */
#intro_table {
    margin: 0 0 0 5px;
}

.border {
	border: 1px solid #3d3d3d;
	padding: 5px;
}
#share {
    float:right;
    position:relative;
}

#share li {
    float: left;
    list-style: none;
    margin-right: 2px;
}

#last_updated {
    font-weight: bold;
    float: left;
    padding: 0 0 0 5px;
}

#last_updated_red_text {
    color: #930000;
    font-style: italic;
    display: inline;
}

#main_content h2 {
    font-family: Georgia,serif;
	color: rgb(51, 51, 51);
}
#share {
    float:right;
    position:relative;
}

#share li {
    float: left;
    list-style: none;
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
<body>

<div id="p_container">
<?php #include($_SERVER['DOCUMENT_ROOT'].'/app/includes/template/auxbar.php'); ?>
<div id="p_content">

<div id="main_content">
	
	<div id="header">
		<div id="share">
			<ul><li>
				<a data-text="" href="http://twitter.com/share" url="http://wcfcourier.com/app/crime_map/" class="twitter-share-button" data-count="horizontal">Tweet</a>
				<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			</li><li>
				<g:plusone size="medium"></g:plusone>
			</li><li>
				<div id="fb-root"></div>
            	<script>(function(d, s, id) {
                	var js, fjs = d.getElementsByTagName(s)[0];
                	if (d.getElementById(id)) return;
                	js = d.createElement(s); js.id = id;
                	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=148866255208434";
                	fjs.parentNode.insertBefore(js, fjs);
            	}(document, 'script', 'facebook-jssdk'));</script>
            	<div class="fb-like" data-href="http://wcfcourier.com/app/crime_map/index.php" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
			</li></ul>
		</div>
	</div>
	
<h2>Crimes reported in the Cedar Valley: 2014</h2>

<hr>

<p>These maps display crimes reported in Waterloo and Cedar Falls, Iowa. Select a map for a complete breakdown of crimes reported in each town. All data is gathered and released by the Waterloo Police Department, the Cedar Falls Police Department and the University of Northern Iowa Police Department.</p>

<p>For the mobile/tablet version of this app, <a href="index_mobile.php">click here</a>. For reports from 2013, <a href="http://wcfcourier.com/app/crime_map2013/" target="_blank">click here</a>. For partial reports from 2012, <a href="http://wcfcourier.com/app/crime_map2012/" target="_blank">click here</a>.</p>

<table id="intro_table">
	<tr>
		<td><h3>Waterloo</h3></td>
		<td><h3>Cedar Falls</h3></td>
	</tr>
	<tr>
		<td width='50%' class='border'>
			<a href='index_wloo.php'>
				<img src='templates/wloo_screenshot.jpg' width='100%' />
			</a>
		</td>
		<td width='50%' class='border'>
			<a href='index_cf.php'>
				<img src='templates/cf_screenshot.jpg' width='100%' />
			</a>
		</td>
	</tr>
</table>
</div>

<br />
<br />
<div id="credits">
	<p>Interactive by: <a href="http://twitter.com/courieressig" target="_blank">Chris Essig</a>	|	Data provided by: <a href="http://www.waterloopolice.com/images/crpress.PDF" target="_blank">Waterloo Police Department</a>, <a href="http://www.cedarfalls.com/Archive.aspx?AMID=82" target="_blank">Cedar Falls Police Department</a> and <a href="http://www.vpaf.uni.edu/pubsaf/" target="_blank">University of Northern Iowa Police Department</a>
    <br />
    * Note: For best results, use a browser other than Internet Explorer.</p>
</div>

</div><!-- close p_content -->	
</div><!-- close p_container -->

<!-- SiteCatalyst code version: H.7. Copyright 1997-2006 Omniture, Inc. navblack info available at http://www.omniture.com -->
	<script language="JavaScript" src="http://www.wcfcourier.com/app/omniture/s_code.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on the next lines. */
	s.pageName="Crimes reported in the Cedar Valley"
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
<?php include($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>
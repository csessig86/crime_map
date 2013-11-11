<?php
$title = 'WCFCourier.com | Map: Crimes reported in Cedar Falls, Iowa';
$pageKeywords = '';
$pageDescription = 'These maps display crimes reported in Waterloo, Iowa and Cedar Falls, Iowa.';
$forceTabOpen = 'home';
$sidebar = 'false'; # uncomment to hide sidebar
?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/header.php'); ?>

<meta name="description" content="This map displays crimes reported in Waterloo, Iowa and Cedar Falls, Iowa." />
<meta name="keywords" content="Waterloo,Cedar Falls,Iowa,crime,Courier" />

<!-- Facebook meta tags-->
<meta property="og:title" content="WCFCourier.com | Crimes reported in Cedar Falls" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="wcfcourier.com" />
<meta property="og:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg" />
<meta property="og:description" content="This map displays crimes reported in Cedar Falls, Iowa." />
<meta property="og:site_name" content="WCFCourier"/>

<!-- Twitter meta tags -->
<meta property="twitter:site" content="@WCFCourier">
<meta property="twitter:card" content="This map displays crimes reported in Cedar Falls, Iowa.">
<meta property="twitter:url" content="wcfcourier.com/app/crime_map/">
<meta property="twitter:title" content="Crimes reported in Cedar Falls">
<meta property="twitter:description" content="This map displays crimes reported in Cedar Falls, Iowa.">
<meta property="twitter:image" content="http://wcfcourier.com/app/special/facebookcourierlogo.jpg">

<script type="text/javascript">
<!--
if ((screen.width < 640) && (screen.height < 960)) {
	document.location='index_mobile_cf.php';
}
//-->
<!--
if ((navigator.userAgent.match(/iPhone/i)) || 
	(navigator.userAgent.match(/iPod/i)) ||
	(navigator.userAgent.match(/iPad/i)) ||
	(navigator.userAgent.match(/Android/i)) ||
	(navigator.userAgent.match(/webOS/i)) ||
	(navigator.userAgent.match(/BlackBerry/))) {
		location.replace("index_mobile_cf.php");
}
-->
</script>

<script type="text/javascript">
function toggle(num,tabId,int){
    var i = 1;
    while(i <= int){
        if(num!=1){
            document.getElementById(tabId+'1').className='null';
        }
        if(num == i){
            document.getElementById(tabId+i).className='selected';
            document.getElementById("div_"+tabId+i).style.display="block";
        } else {
            document.getElementById(tabId+i).className='null';
            document.getElementById("div_"+tabId+i).style.display="none";
        }
        i++;
    }
}
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
<body onLoad="last_updated()">


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
            <div class="fb-like" data-href="http://wcfcourier.com/app/crime_map/index_cf.php" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		</li></ul>
	</div>
</div>

<h2>Crimes reported in Cedar Falls, Iowa</h2>

<hr>

<table id="intro_table">
	<tr>
		<td width="90%">
		<p>These maps display crimes reported in Cedar Falls, Iowa, since the beginning of the year. The information is gathered from the <a href="http://www.cedarfalls.com/Archive.aspx?AMID=82" target="_blank">Cedar Falls Police Department</a> and the <a href="http://www.vpaf.uni.edu/pubsaf/crime_stats/log/index.shtml" target="_blank">UNI Police Department</a>. Not all calls are mapped; minor reports like business checks and traffic stops are not shown below. Instead, we have selected eight categories of reports to map.</p>
		<p>The map is color coded depending on the type of call. Click on the markers on the map for more information on the call. Select a month below to filter the number of reported crimes that are pinpointed on the map.</p>
        <p><strong>Update (10/10):</strong> We added reports from the UNI PD to the map. As a result, the types of crimes we selected to map has changed to keep data across police departments consistent. We removed reports of hit and runs and added theft and arson reports to all maps.</p>
        <p>For the mobile/tablet version of this app, <a href="index_mobile_cf.php">click here</a>. For a crime map for the city of Waterloo, <a href="index_wloo.php">click here</a>.</p>
		</td>
		<td width="10%"><div id="last_updated"></div></td>
	</tr>
</table>

<iframe class="map_embed" height="1700" width="940" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src='templates/cf/map_index_nov.php'></iframe>

</div>

<div id="credits">
	<p>Interactive by: <a href="http://twitter.com/courieressig" target="_blank">Chris Essig</a>	|	To view the data, <a href="https://docs.google.com/spreadsheet/pub?key=0As3JvOeYDO50dDRYWUdUNEg3QXB0UG42ZE9TNXZCTnc&output=html" target="_blank">click here</a>.
    <br />
    * Note: For best results, use a browser other than Internet Explorer.</p>


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
    $('#last_updated').html('Last updated: <br /> <div id="last_updated_red_text">' + (last_date[1]) + '-' + last_date[2] + '-' +  last_date[0] + '</div>')
}
</script>

<!-- SiteCatalyst code version: H.7. Copyright 1997-2006 Omniture, Inc. navblack info available at http://www.omniture.com -->
    <script language="JavaScript" src="http://www.wcfcourier.com/app/omniture/s_code.js" type="text/javascript"></script>
    <script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on the next lines. */
    s.pageName="Crimes reported in Cedar Falls"
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
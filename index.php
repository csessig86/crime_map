<?php
$title = 'WCFCourier.com | Map: Crimes reported in Waterloo, Iowa';
$pageKeywords = '';
$pageDescription = '';
$forceTabOpen = 'home';
$sidebar = 'false'; # uncomment to hide sidebar
?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/header.php'); ?>
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
			<script src="http://connect.facebook.net/en_US/all.js#appId=161694630579757&amp;xfbml=1"></script>
            <fb:like href="" send="false" layout="button_count" width="90" show_faces="false" font=""></fb:like>
		</li></ul>
	</div>
</div>

<h2>Crimes reported in Waterloo, Iowa</h2>

<hr>

<table id="intro_table">
	<tr>
		<td width="90%">
		<p>The map below displays crimes reported in Waterloo, Iowa, since the beginning of July. The information is gathered from the Waterloo Police Department, which keeps a <a href="http://waterloopolice.com/index.php?option=com_content&view=section&layout=blog&id=16&Itemid=31" target="_blank">log of calls for service</a> that is updated on a daily basis. Not all calls are mapped; minor reports like business checks and traffic stops are not shown below. Instead, we have selected seven categories of reports to map.</p>
		<p>The map is color coded depending on the type of call. Click on the markers on the map for more information on the call. Select a month below to filter the number of reported crimes that are pinpointed on the map.</p>
		</td>
		<td width="10%"><div id="last_updated"></div></td>
	</tr>
</table>

<iframe class="map_embed" height="1450" width="940" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src='map_index_aug.php'></iframe>

</div>

<div id="credits">
	Interactive by: <a href="http://twitter.com/courieressig" target="_blank">Chris Essig</a>	|	Data provided by: <a href="http://www.waterloopolice.com/images/crpress.PDF" target="_blank">Waterloo Police Department</a>
    <br />
    * Note: For best results, use a browser other than Internet Explorer.
</div>

</div><!-- close p_content -->	
</div><!-- close p_container -->
<script src="JSON/crime_data.json"></script>
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
</body>
<?php include($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>
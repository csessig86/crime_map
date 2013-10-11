<?php include($_SERVER['DOCUMENT_ROOT'].'/app/crime_map/templates/template_top.php'); ?>
<body style="padding-top: 10px; padding-bottom: 0px;">
<div id="main_content">

<div class="hidden-phone">
<div id="nav-primary">
	<ul class="nav nav-tabs">
    	<li>
            <a href="profile.php">Profile</a>
        </li>
        <li id="all-reports-tab" class="active">
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
    </ul>
</div>
</div>

<div class="visible-phone">
	<div class="dropdown" style="padding-bottom: 20px; font-size: 14px;">
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
            <li><a href="map_index_sept.php">October reports</a></li>
    	</ul>
	</div>
	<h2>Compare crimes: 2013</h2>
    This chart compares how often crimes in this month were reported.
</div>

<div class="hidden-phone">
<p><strong>Note:</strong> This map clusters particular crimes together using large circles. The number on the cluster represents the total number of crimes that were reported in that area. For instance, the number "13" next to the letter "B" means 13 burglaries were reported in that particular area. The number "11" next to "T" means 11 thefts were reported.</p>
<p>The clustered areas will automatically change when you zoom in and out of the map. Rollover the marker to see the area covered by the cluster. Click on the cluster to see each individual crime report on the map and where it occurred.</p>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/crime_map/templates/template_middle.php'); ?>
<script src="http://wcfcourier.com/app/crime_map/JSON_cf/crime_data.json"></script>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/crime_map/templates/template_bottom.php'); ?>
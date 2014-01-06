<?php include($_SERVER['DOCUMENT_ROOT'].'/app/crime_map/templates/template_top.php'); ?>
<body style="padding-top: 10px; padding-bottom: 0px;">
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
        <li class="active">
            <a href="map_index_nov.php">Nov.</a>
        </li>
        <li>
            <a href="map_index_dec.php">Dec.</a>
        </li>
        <li>
            <a href="map_index_review.php">Year in review</a>
        </li>
    </ul>
</div>
</div>

<div class="visible-phone">
	<div class="dropdown" style="padding-bottom: 0px; font-size: 14px;">
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
            <li><a href="map_index_review.php">Map: Year in review</a></li>
    	</ul>
	</div>
	<h2>Compare crimes: Nov. 2013</h2>
    This chart compares how often crimes in this month were reported.
</div>

<div class="hidden-phone">
<p><strong>About:</strong> This map is color coded depending on the type of call. Click on the markers on the map for more information on the call. Select a month below to filter the number of reported crimes that are pinpointed on the map.</p>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/crime_map/templates/template_middle.php'); ?>
<script src="http://wcfcourier.com/app/crime_map/JSON_cf/crime_data_nov.json"></script>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/crime_map/templates/template_bottom.php'); ?>
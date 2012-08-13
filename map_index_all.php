<?php include($_SERVER['DOCUMENT_ROOT'].'/app/special/crime_map/template_top.php'); ?>
<body style="padding-top: 10px; padding-bottom: 0px;">
<div id="main_content">

<div id="nav-primary">
	<ul class="nav nav-tabs">
    	<li class="active">
    		<a href="map_index_all.php">All Reports</a>
    	</li>
        <li>
    		<a href="map_index_july.php">July</a>
    	</li>
        <li>
    		<a href="map_index_aug.php">August</a>
    	</li>
    </ul>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/special/crime_map/template_middle.php'); ?>
<script src="JSON/crime_data.json"></script>

<?php include($_SERVER['DOCUMENT_ROOT'].'/app/special/crime_map/template_bottom.php'); ?>
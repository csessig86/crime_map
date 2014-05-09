<?php include($_SERVER['DOCUMENT_ROOT'].'/app/crime_map/templates/template_top.php'); ?>
<body style="padding-top: 10px; padding-bottom: 0px;">
<div id="main_content">

<div class="hidden-phone">
<div id="nav-primary">
	<ul class="nav nav-tabs">
    	<li class="active">
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
            <a href="map_index_mar.php">March</a>
        </li>
        <li>
            <a href="map_index_april.php">April</a>
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
        	<li><a href="map_index_mar.php">March reports</a></li>
        	<li><a href="map_index_april.php">April reports</a></li>
    	</ul>
	</div>
	<br />
	<h2>Community profile</h2>
</div>

<p><strong>About:</strong> This table is a community profile for the city of Cedar Falls, which shows population figures as well as poverty estimates.<br />
All figures are provided by the <a href="http://quickfacts.census.gov/qfd/states/19/1911755.html" target="_blank">U.S. Census Bureau</a>.</p>

<table class="table table-striped table-bordered" width="100%" style="overflow: auto;">
	<tr>
		<th width="60%">Category</th>
		<th width="20%"><b>Cedar Falls</b></th>
		<th width="20%"><b>Iowa</b></th>
	</tr>
	<tr>
		<td>Population, 2010 (April 1) estimates base</td>
		<td>39,260</td>
		<td>3,046,350</td>
	</tr>
		<td>Population, percent change, April 1, 2010 to July 1, 2011</td>
		<td>0.3%</td>
		<td>0.5%</td>
	</tr>
	<tr>
		<td>Population, 2010</td>
		<td>39,260</td>
		<td>3,046,355</td>
	</tr>
	<tr>
		<td>Persons under 5 years, percent, 2010</td>
		<td>5.0%</td>
		<td>6.6%</td>
	</tr>
	<tr>
		<td>Persons under 18 years, percent, 2010</td>
		<td>17.3%</td>
		<td>23.9%</td>
	</tr>
	
	<tr>
		<td>Persons 65 years and over, percent,  2010</td>
		<td>12.4%</td>
		<td>14.9%</td>
	</tr>
	<tr>
		<td>Female persons, percent, 2010</td>
		<td>51.9%</td>
		<td>50.5%</td>
	</tr>
	<tr>
		<td>White persons, percent, 2010 (a)</td>
		<td>93.4%</td>
		<td>91.3%</td>
	</tr>
	<tr>
		<td>Black persons, percent, 2010 (a)</td>
		<td>2.1%</td>
		<td>2.9%</td>
	</tr>
	<tr>
		<td>American Indian and Alaska Native persons, percent, 2010 (a)</td>
		<td>0.2%</td>
		<td>0.4%</td>
	</tr>
	<tr>
		<td>Asian persons, percent, 2010 (a)</td>
		<td>2.3%</td>
		<td>1.7%</td>
	</tr>
	<tr>
		<td>Native Hawaiian and Other Pacific Islander, percent, 2010 (a)</td>
		<td>Z</td>
		<td>0.1%</td>
	</tr>
	<tr>
		<td>Persons reporting two or more races, percent, 2010</td>
		<td>1.7%</td>
		<td>1.8%</td>
	</tr>
	<tr>
		<td>Persons of Hispanic or Latino origin, percent, 2010 (b)</td>
		<td>2.0%</td>
		<td>5.0%</td>
	</tr>
	<tr>
		<td>White persons not Hispanic, percent, 2010</td>
		<td>92.2%</td>
		<td>88.7%</td>
	</tr>
		<td>Living in same house 1 year & over, 2006-2010</td>
		<td>70.6%</td>
		<td>83.8%</td>
	</tr>
		<td>Foreign born persons, percent,  2006-2010</td>
		<td>3.4%</td>
		<td>4.1%</td>
	</tr>
		<td>Language other than English spoken at home, pct age 5+, 2006-2010</td>
		<td>5.2%</td>
		<td>6.8%</td>
	</tr>
		<td>High school graduates, percent of persons age 25+, 2006-2010</td>
		<td >93.7%</td>
		<td>89.9%</td>
	</tr>
	<tr>
		<td>Bachelor's degree or higher, pct of persons age 25+, 2006-2010</td>
		<td>42.8%</td>
		<td>24.5%</td>
	</tr>
		<td>Homeownership rate, 2006-2010</td>
		<td>63.9%</td>
		<td>73.2%</td>
	</tr>
	<tr>
		<td>Housing units in multi-unit structures, percent, 2006-2010</td>
		<td>31.6%</td>
		<td>18.6%</td>
	</tr>
	<tr>
		<td>Median value of owner-occupied housing units, 2006-2010</td>
		<td>$151,400</td>
		<td>$119,200</td>
	</tr>
	<tr>
		<td>Households, 2006-2010</td>
		<td>13,978</td>
		<td>1,215,954</td>
	</tr>
	<tr>
		<td>Persons per household, 2006-2010</td>
		<td>2.41</td>
		<td>2.40</td>
	</tr>
	<tr>
		<td>Per capita money income in past 12 months (2010 dollars) 2006-2010</td>
		<td>$23,730</td>
		<td>$25,335</td>
	</tr>
	<tr>
		<td>Median household income 2006-2010</td>
		<td>$47,339</td>
		<td>$48,872</td>
	</tr>
	<tr>
		<td>Persons below poverty level, percent, 2006-2010</td>
		<td>21.0%</td>
		<td>11.6%</td>
	<tr>
		<td>Land area in square miles, 2010</td>
		<td>28.75</td>
		<td>55,857.13</td>
	</tr>
	<tr>
		<td>Persons per square mile, 2010 </td>
		<td>1,365.7</td>
		<td>54.5</td>
	</tr>
</table>

</body>
</html>
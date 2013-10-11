<table id="map_table">
    <tr>
        <td id="left_column_key">
            <div class="hidden-phone">
            <table id="legend_violentcrimes">
                <h3>Types of crimes</h3>
                <p>Select from the types of crimes below to see them plotted on the map.</p>
                <p class="font_georgia"><strong>Violent crimes</strong></p>
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="homicide_box" />
                        <div id="homicide">
                        <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/homicide_icon.png" />
                        Homicide
                    </label>
                </div>
                </td></tr>
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="shooting_box" />
                        <div id="shooting" class="legend_padding_top">
                        <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/shooting_icon.png" />
                        Shooting in progress / Shots fired
                    </label>
                </div>
                </td></tr>
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="weapons_violations" />
                        <div id="Weapons Violations" class="legend_padding_top">
                        <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/weapons_icon.png" />
                        Weapons violations / Stabbings
                    </label>
                </div>
                </td></tr>
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="robbery" />
                        <div id="Robbery" class="legend_padding_top">
                            <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/robbery_icon.png" />
                            Robbery
                    </label>
                </div>
                </td></tr>
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="assault" />
                        <div id="Assault" class="legend_padding_top">
                        <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/assault_icon.png" />
                        Assault
                    </label>
                </div>
                </td></tr>
            </table>
            <p class="font_georgia"><strong>Property crimes</strong></p>
            <table id="legend_propertycrimes">
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="burglary_box" />
                        <div id="burglary" class="legend_padding_top">
                        <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/burglary_icon.png" />
                        Burglary
                    </label>
                </div>
                </td></tr>
                <tr><td id="legend_propertycrimes">
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="theft_box" />                    
                        <div id="theft">
                        <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/theft_icon.png" />
                        Larcency / Theft / Shoplifting
                    </label>
                </div>
                </td></tr>
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="arson_box" />
                        <div id="burglary" class="legend_padding_top">
                        <img width="20px" src="http://wcfcourier.com/app/crime_map/icons/arson_icon.png" />
                        Arson
                    </label>
                </div>
                </td></tr>
            </table>
            </div>
            <div class="hidden-phone">
            	<h3>Compare crimes</h3>
            	This chart compares how often crimes plotted on the map are reported.
            </div>
            <div id="bar_chart"></div>
		</td>
        
		<td>
        	<div class="hidden-phone">
            	<div id="geocode_box">
                    <h3>Search for an address</h3>
                    <table>
                    <tr>
                        <td>
                        <form id="geocoder"></form>
                        </td>
                        <td style="padding-left: 50px;">
                        <p>Note: A blue marker will appear on the map showing the address you entered.</p>
                    </tr>
                    </table>
                </div>
                <div id="map"></div>
				<div id="date_slider_box">
					<h3>Date range</h3>
                	Select a date range to plot the crimes on the map.
					<br />
					<br />
					<div id="date_slider"></div>
				</div>
				<script src="http://wcfcourier.com/app/crime_map/jQRangeSlider/jQRangeSlider-min.js"></script>
				<script src="http://wcfcourier.com/app/crime_map/jQRangeSlider/jQDateRangeSlider-min.js"></script>
                <script>var NA = "NA"</script>
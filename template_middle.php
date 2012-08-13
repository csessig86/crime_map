<table>
    <tr>
        <td id="left_column_key">
            <table id="legend_violentcrimes">
                <h3>Types of crimes</h3>
                <p>Select from the types of crimes below to see them plotted on the map.</p>
                <p class="font_georgia"><strong>Violent crimes</strong></p>
                <tr><td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="homicide_box" />
                        <div id="homicide">
                        <img src="icons/homicide_icon.png" />
                        Homicide
                    </label>
                </div>
                </td>
                </tr>
                <tr>
                <td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="shooting_box" />
                        <div id="shooting" class="legend_padding_top">
                        <img src="icons/shooting_icon.png" />
                        Shooting in progress / Shots fired
                    </label>
                </div>
                </td>
                </tr>
                <tr>
                <td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="weapons_violations" />
                        <div id="Weapons Violations" class="legend_padding_top">
                        <img src="icons/weapons_icon.png" />
                        Weapons violations
                    </label>
                </div>
                </td>
                </tr>
                <tr>
                <td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="robbery" />
                        <div id="Robbery" class="legend_padding_top">
                            <img src="icons/robbery_icon.png" />
                            Robbery
                    </label>
                </div>
                </td>
                </tr>
                <tr>
                <td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="assault" /
                        <div id="Assault" class="legend_padding_top">
                        <img src="icons/assault_icon.png" />
                        Assault
                    </label>
                </div>
                </td>
                </tr>
            </table>
            <p class="font_georgia"><strong>Property crimes</strong></p>
            <table id="legend_propertycrimes">
                <tr><td id="legend_propertycrimes">
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="mva_box" />                    
                        <div id="mva">
                        <img src="icons/mva_icon.png" />
                        Hit and run
                    </label>
                </div>
                </td>
                </tr>
                <tr>
                <td>
                    <label class="checkbox">
                        <input type="checkbox" onClick="initialize_map(start_usable[0], end_usable[0]);" checked="checked" id="burglary_box" />
                        <div id="burglary" class="legend_padding_top">
                        <img src="icons/burglary_icon.png" />
                        Burglary
                    </label>
                </div>
                </td>
                </tr>
                <tr>
            </table>
			<h3>Compare crimes</h3>
            This chart compares how often crimes plotted on the map are reported.
            <div id="bar_chart"></div>
			</div>
		</td>
		<td>
			<div id="map"></div>
			<div id="date_slider_box">
				<h3>Date range</h3>
                Select a date range to plot the crimes on the map.
				<br />
				<br />
				<div id="date_slider"></div>
			</div>
			<script src="jQRangeSlider/jQRangeSlider-min.js"></script>
			<script src="jQRangeSlider/jQDateRangeSlider-min.js"></script>
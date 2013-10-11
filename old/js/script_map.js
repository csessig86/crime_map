// Information for the base tile
var cloudmadeUrl = 'http://{s}.tile.cloudmade.com/f14689c8008d43da9028a70e6a8e710a/22677/256/{z}/{x}/{y}.png',
cloudmadeAttribution = 'Map data CCBYSA &copy; 2012 OpenStreetMap contributors, Imagery &copy; 2012 CloudMade',
cloudmade = new L.TileLayer(cloudmadeUrl, {maxZoom: 18, attribution: cloudmadeAttribution});

// Set default zoom to either Waterloo or Cedar Falls
// Depends on the url to contain the word 'wloo' or 'cf'
if (window.document.URL.indexOf('templates/wloo') > 0) {
	var map = new L.Map('map');
	map.setView(new L.LatLng(42.495, -92.34), 13).addLayer(cloudmade);	
} else if (window.document.URL.indexOf('templates/cf') > 0) {
	var map = new L.Map('map');
	map.setView(new L.LatLng(42.527, -92.445), 13).addLayer(cloudmade);
} else {
    var map = new L.Map('map');
    map.setView(new L.LatLng(42.495, -92.34), 11).addLayer(cloudmade);  
}

// Crimes that fit between the two dates
// In the date slide
// Will be added to this variable
var layer_group = new L.LayerGroup();

// We'll use counter to reload the table data
count_initialize_map = 0;

// This variable is used to calculate the last date in the JSON file
// We'll then use it with the slider
count = 0;

// Convert our military times to a.m. and p.m.
// Loop through JSON file
// We'll use this in the slider below
for (incident in crime_data) {
    crime_data[incident].times = crime_data[incident].times.split(":");
    crime_data[incident].times2 = crime_data[incident].times[0]
	// Convert 0 to 12 a.m.
	if (crime_data[incident].times2 == 0) {
	    crime_data[incident].times2 = 12 + ':' + crime_data[incident].times[1] + ' a.m.';
	// Anything under 12 is a.m.
	} else if (crime_data[incident].times2 < 12) {
	    crime_data[incident].times2 = crime_data[incident].times2 + ':' + crime_data[incident].times[1] + ' a.m.';
	// Convert 12 to 12 p.m.
	} else if (crime_data[incident].times2 == 12) {
	    crime_data[incident].times2 = crime_data[incident].times2 + ':' + crime_data[incident].times[1] + ' p.m.';
    // Anything more than 12 is p.m. Also need to subtract 12 (13 = 1 p.m.)
    } else if (crime_data[incident].times2 > 12) {
        crime_data[incident].times2 = crime_data[incident].times2 - 12 + ':' + crime_data[incident].times[1] + ' p.m.';
    }
    count ++;
}

// Convert fields with all uppercase letters
// To fields where only the first letter is uppercased
function lowercase_letters(string) {
    string2 = "";
    for (x = 1; x < string.length; x++) {
        if (string.charAt(x -1 ) === " ") {
            string2 += string.charAt(x)
        } else if (string.charAt(x -1 ) === "/") {
            string2 += string.charAt(x)
        } else if (string.charAt(x -1 ) === ":") {
            string2 += string.charAt(x)
        } else {
            string2 += string.charAt(x).toLowerCase();
        }
    }
    return string[0] + string2
}

// Split the first and last date in the JSON file
// Then set it in the slider below
first_date = crime_data[0].date.split("-");
last_date = crime_data[count -1].date.split("-");

start_usable = [];
end_usable = [];

function get_dates(slider_date) {
	var year, month, day;
	year = slider_date.getFullYear();
	month = slider_date.getMonth() + 1;
	if (month.length == 1) {
		month = "0" + month;
	}
	day = slider_date.getDate();
	if (day.length == 1) {
		day = "0" + day_min;
	}
	return year + "-" + month + "-" + day;
};

// Date slider
// Set initial values here
$("#date_slider").dateRangeSlider({
    bounds: {
        min:new Date(first_date[0],first_date[1] -1,first_date[2]),
        max:new Date(last_date[0],last_date[1] -1,last_date[2])
    },
    defaultValues:{
        min:new Date(first_date[0],first_date[1] -1,first_date[2]),
        max:new Date(last_date[0],last_date[1] -1,last_date[2])
    },
    formatter: function(value) {
        if (value.getMonth() === 0) {
            string2 = "Jan.";
        } else if (value.getMonth() === 1) {
            string2 = "Feb.";
        } else if (value.getMonth() === 2) {
            string2 = "March";
        } else if (value.getMonth() === 3) {
            string2 = "April";
        } else if (value.getMonth() === 4) {
            string2 = "May";
        } else if (value.getMonth() === 5) {
            string2 = "June";
        } else if (value.getMonth() === 6) {
            string2 = "July";
        } else if (value.getMonth() === 7) {
            string2 = "Aug.";
        } else if (value.getMonth() === 8) {
            string2 = "Sept.";
        } else if (value.getMonth() === 9) {
            string2 = "Oct.";
        } else if (value.getMonth() === 10) {
            string2 = "Nov.";
        } else if (value.getMonth() === 11) {
            string2 = "Dec.";
        }
        string3 = value.getDate();
        string4 = string2 + " " + string3;
        return string4;
    }
// This event is called every time the date slider is moved
}).bind("valuesChanged", function set_dates(event, ui){
    // Picks out where the slider is starting and ending
	start = $.datepicker.formatDate("yy-mm-dd", ui.values.min);
	end = $.datepicker.formatDate("yy-mm-dd", ui.values.max);
	start_usable = [];
	start_usable.push(start);
	
	end_usable = [];
	end_usable.push(end);
    // Load map + pie chart
    initialize_map(start, end);
});

// Select which types of crimes will be displayed on the map
function initialize_map(start, end) {
	// We'll use counter to reload the table data
    count_initialize_map += 1;
    
    // This is where we will store table information
    // Will be HTML
    crime_data_table = "";
    
    // We need to clear all the 
    layer_group.clearLayers();
    
    // These variables are used with the Flot pie chart
    var homicide_total = 0;
    var shooting_total = 0;
    var shots_fired_total = 0;
    var weapons_violations_total = 0;
    var robbery_total = 0;
    var assault_total = 0;
    var hit_and_run_total = 0;
    var burglary_total = 0;
    
    // Sets marker color
    // Lat and long
    function set_marker(lat, long, icon_url) {
        var icon_location = L.icon({
            iconUrl: 'http://wcfcourier.com/app/crime_map/icons/' + icon_url + '.png',
			iconSize: [20, 20]
        });
		// var icon_hover = L.icon({
            // iconUrl: 'icons/' + icon_url + '_hover.png'
        // });
		
		// Using parameters called in set_marker function
        marker_location = new L.LatLng(lat, long);
        // Actually creates the icon
        var layer = new L.marker(marker_location, {icon: icon_location});
		
		// Only works on Firefox and with newest version of Leaflet
        //layer.on("mouseover", function (e) {
            // e.target = original fill color
            // Which will be used when we rollover marker
			// layer.setIcon(icon_hover);
        // });
        // layer.on("mouseout", function (e) {
            // Change the style to the original version
            // layer.setIcon(icon_location);
        // });
		
        // Create popup using CSS
        var popup = "<div class=popup_box" + "id=" + crime_data[incident] + ">";
        
        // We'll edit the text on some of the crimes below
        // To make it look cleaner on the site
        if (crime_data[incident].crime === 'SHOOTING IN PROGRESS/JUST') {
            crime_formatted = 'Shooting in progress';
        } else if (crime_data[incident].crime === 'SHOOTING IN PROGRESS/') {
            crime_formatted = 'Shooting in progress';
        } else if (crime_data[incident].crime === 'SHOOTING IN PROGRESS') {
            crime_formatted = 'Shooting in progress';
        } else if (crime_data[incident].crime === 'SHOOTING IN') {
            crime_formatted = 'Shooting in progress';
        } else if (crime_data[incident].crime === 'WEAPON:SHOTS FIRED') {
            crime_formatted = 'Weapon: Shots fired';
        } else if (crime_data[incident].crime === 'WEAPONS VIOLATIONS') {
            crime_formatted = 'Weapons violations';
        } else if (crime_data[incident].crime === 'ROBBERY IN PROGRESS/JUST') {
            crime_formatted = 'Robbery in progress';
        } else if (crime_data[incident].crime === 'ROBBERY IN PROGRESS/') {
            crime_formatted = 'Robbery in progress';
        } else if (crime_data[incident].crime === 'ROBBERY IN PROGRESS') {
            crime_formatted = 'Robbery in progress';
        } else if (crime_data[incident].crime === 'ROBBERY IN') {
            crime_formatted = 'Robbery in progress';
        } else if (crime_data[incident].crime === 'STABBING IN PROGRESS/JUST') {
            crime_formatted = 'Stabbing in progress';
        } else if (crime_data[incident].crime === 'STABBING IN PROGRESS/') {
            crime_formatted = 'Stabbing in progress';
        } else if (crime_data[incident].crime === 'STABBING IN PROGRESS') {
            crime_formatted = 'Stabbing in progress';
        } else if (crime_data[incident].crime === 'STABBING IN') {
            crime_formatted = 'Stabbing in progress';
        } else if (crime_data[incident].crime === 'ASSAULT/AMBULANCE REQUESTED') {
            crime_formatted = 'Assault: Ambulance requested';
        } else if (crime_data[incident].crime === 'ASSAULT IN PROGRESS/JUST') {
            crime_formatted = 'Assault in progress';
        } else if (crime_data[incident].crime === 'ASSAULT IN PROGRESS/') {
            crime_formatted = 'Assault in progress';
        } else if (crime_data[incident].crime === 'ASSAULT IN PROGRESS') {
            crime_formatted = 'Assault in progress';
        } else if (crime_data[incident].crime === 'ASSAULT IN') {
            crime_formatted = 'Assault in progress';
        } else if (crime_data[incident].crime === 'ASSAULT/RAPE') {
            crime_formatted = 'Assault/Rape';
        } else if (crime_data[incident].crime === 'MVA HIT & RUN') {
            crime_formatted = 'Hit and run';
        } else if (crime_data[incident].crime === 'BURGLARY IN PROGRESS/JUST') {
            crime_formatted = 'Burglary in progress';
        } else if (crime_data[incident].crime === 'BURGLARY IN PROGRESS/') {
            crime_formatted = 'Burglary in progress';
        } else if (crime_data[incident].crime === 'BURGLARY IN PROGRESS') {
            crime_formatted = 'Burglary in progress';
        } else if (crime_data[incident].crime === 'BURGLARY IN') {
            crime_formatted = 'Burglary in progress';
        // The rest we will lowercase every letter
        // But the first
        } else {
            crime_formatted = lowercase_letters(crime_data[incident].crime);
        }
        popup += "<div class='popup_box_header'><strong>" + crime_formatted + "</strong></div>"
        
        // Add the rest of the popup
        popup += "<strong>Date:</strong> " + crime_data[incident].date + "<br />";
        popup += "<strong>Time:</strong> " + crime_data[incident].times2 + "<br />";
        popup += "<strong>Location:</strong> " + lowercase_letters(crime_data[incident].location) + "<br />";
        popup += "<strong>Result:</strong> " + lowercase_letters(crime_data[incident].disposition) + "<br />";
        popup += "</div>";
		layer.bindPopup(popup);
        // See if the date of the crime matches
        // With slider start/end dates
        layer_group.addLayer(layer);
		
    };
    
    // Loop through our JSON file
    for (incident in crime_data) {       
        // Grab LatLng from JSON file
        // And plot locations with our data
        if (crime_data[incident].date >= start && crime_data[incident].date <= end) {
        
            lat = crime_data[incident].lat;
            long = crime_data[incident].long;
        
            if (crime_data[incident].crime === 'HOMICIDE' && document.getElementById('homicide_box').checked === true) {
                icon_url = 'homicide_icon';
                set_marker(lat, long, icon_url);
                homicide_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'SHOOTING IN PROGRESS/JUST' && document.getElementById('shooting_box').checked === true || crime_data[incident].crime === 'SHOOTING IN PROGRESS/' && document.getElementById('shooting_box').checked === true || crime_data[incident].crime === 'SHOOTING IN PROGRESS' && document.getElementById('shooting_box').checked === true || crime_data[incident].crime === 'SHOOTING IN' && document.getElementById('shooting_box').checked === true) {
                icon_url = 'shooting_icon';
                set_marker(lat, long, icon_url);
                shooting_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'WEAPON:SHOTS FIRED' && document.getElementById('shooting_box').checked === true) {
                icon_url = 'shooting_icon';
                set_marker(lat, long, icon_url);
                shooting_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'WEAPONS VIOLATIONS' && document.getElementById('weapons_violations').checked === true) {
                icon_url = 'weapons_icon';
                set_marker(lat, long, icon_url);
                weapons_violations_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'STABBING IN PROGRESS/JUST' && document.getElementById('weapons_violations').checked === true || crime_data[incident].crime === 'STABBING IN PROGRESS/' && document.getElementById('weapons_violations').checked === true || crime_data[incident].crime === 'STABBING IN PROGRESS' && document.getElementById('weapons_violations').checked === true || crime_data[incident].crime === 'STABBING IN' && document.getElementById('weapons_violations').checked === true) {
                icon_url = 'weapons_icon';
                set_marker(lat, long, icon_url);
                weapons_violations_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'ROBBERY' && document.getElementById('robbery').checked === true) {
                icon_url = 'robbery_icon';
                set_marker(lat, long, icon_url);
                robbery_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'ROBBERY IN PROGRESS/JUST' && document.getElementById('robbery').checked === true || crime_data[incident].crime === 'ROBBERY IN PROGRESS/' && document.getElementById('robbery').checked === true || crime_data[incident].crime === 'ROBBERY IN PROGRESS' && document.getElementById('robbery').checked === true || crime_data[incident].crime === 'ROBBERY IN' && document.getElementById('robbery').checked === true) {
                icon_url = 'robbery_icon';
                set_marker(lat, long, icon_url);
                robbery_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'ASSAULT' && document.getElementById('assault').checked === true) {
                icon_url = 'assault_icon';
                set_marker(lat, long, icon_url);
                assault_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'ASSAULT/AMBULANCE REQUESTED' && document.getElementById('assault').checked === true) {
                icon_url = 'assault_icon';
                set_marker(lat, long, icon_url);
                assault_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'ASSAULT IN PROGRESS/JUST' && document.getElementById('assault').checked === true || crime_data[incident].crime === 'ASSAULT IN PROGRESS/' && document.getElementById('assault').checked === true || crime_data[incident].crime === 'ASSAULT IN PROGRESS' && document.getElementById('assault').checked === true || crime_data[incident].crime === 'ASSAULT IN' && document.getElementById('assault').checked === true) {
                icon_url = 'assault_icon';
                set_marker(lat, long, icon_url);
                assault_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'ASSAULT/RAPE' && document.getElementById('assault').checked === true) {
                icon_url = 'assault_icon';
                set_marker(lat, long, icon_url);
                assault_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'MVA HIT & RUN' && document.getElementById('mva_box').checked === true) {
                icon_url = 'mva_icon';
                set_marker(lat, long, icon_url);
                hit_and_run_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'BURGLARY' && document.getElementById('burglary_box').checked === true) {
                icon_url = 'burglary_icon';
                set_marker(lat, long, icon_url);
                burglary_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            } else if (crime_data[incident].crime === 'BURGLARY IN PROGRESS/JUST' && document.getElementById('burglary_box').checked === true || crime_data[incident].crime === 'BURGLARY IN PROGRESS/' && document.getElementById('burglary_box').checked === true || crime_data[incident].crime === 'BURGLARY IN PROGRESS' && document.getElementById('burglary_box').checked === true || crime_data[incident].crime === 'BURGLARY IN' && document.getElementById('burglary_box').checked === true) {
                icon_url = 'burglary_icon';
                set_marker(lat, long, icon_url);
                burglary_total += 1;
                // We'll add the crime information in the JSON file
                // And table data
                // To a blank variable
                // And later add that to our DataTable
                crime_data_table += '<tr>';
                crime_data_table += '<td>' + crime_data[incident].date + '</td>';
                crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
                crime_data_table += '<td>' + crime_formatted + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
                crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
                crime_data_table += '</tr>';
            }
        }
    }
    // Add to map
    map.addLayer(layer_group);
	
	total_total = homicide_total + shooting_total + weapons_violations_total + robbery_total + assault_total + hit_and_run_total + burglary_total;
	
	bars_html = "<table class='table'><thead>";
	bars_html += "<th>Crime</th><th>Reports</th><th>Percent</th>";
	bars_html += "</thead>";
	
	bars_html += "<tr><td width='20%'>Homicide</td>"
	bars_html += "<td id='center_align' width='10%'><strong>";
	bars_html += homicide_total;
	bars_html += "</strong></td>";
	bars_html += "<td width='70%'><div class='bar-container'>";
	if (homicide_total > 0) {
		bars_html += "<div id='homicide_bar' class='bar' style='width:";
		bars_html += homicide_total / total_total * 100;
		bars_html += "%;'></div>";
	}
	bars_html += "</div>";
	bars_html += "</td></tr>";
	
	bars_html += "<tr><td width='20%'>Shooting</td>"
	bars_html += "<td id='center_align' width='10%'><strong>";
	bars_html += shooting_total;
	bars_html += "</strong></td>";
	bars_html += "<td width='70%'><div class='bar-container'>";
	if (shooting_total > 0) {
		bars_html += "<div id='shooting_bar' class='bar' style='width:";
		bars_html += shooting_total / total_total * 100;
		bars_html += "%;'></div>";
	}
	bars_html += "</div>";
	bars_html += "</td></tr>";
	
	bars_html += "<tr><td width='20%'>Weapons/ Stabbing</td>"
	bars_html += "<td id='center_align' width='10%'><strong>";
	bars_html += weapons_violations_total;
	bars_html += "</strong></td>";
	bars_html += "<td width='70%'><div class='bar-container'>";
	if (weapons_violations_total > 0) {
		bars_html += "<div id='weapons_bar' class='bar' style='width:";
		bars_html += weapons_violations_total / total_total * 100;
		bars_html += "%;'></div>";
	}
	bars_html += "</div>";
	bars_html += "</td></tr>";
	
	bars_html += "<tr><td width='20%'>Robbery</td>"
	bars_html += "<td id='center_align' width='10%'><strong>";
	bars_html += robbery_total;
	bars_html += "</strong></td>";
	bars_html += "<td width='70%'><div class='bar-container'>";
	if (robbery_total > 0) {
		bars_html += "<div id='robbery_bar' class='bar' style='width:";
		bars_html += robbery_total / total_total * 100;
		bars_html += "%;'></div>";
	}
	bars_html += "</div>";
	bars_html += "</td></tr>";
	
	bars_html += "<tr><td width='20%'>Assault</td>"
	bars_html += "<td id='center_align' width='10%'><strong>";
	bars_html += assault_total;
	bars_html += "</strong></td>";
	bars_html += "<td width='70%'><div class='bar-container'>";
	if (assault_total > 0) {
		bars_html += "<div id='assault_bar' class='bar' style='width:";
		bars_html += assault_total / total_total * 100;
		bars_html += "%;'></div>";
	}
	bars_html += "</div>";
	bars_html += "</td></tr>";
	
	bars_html += "<tr><td width='20%'>Hit and Run</td>"
	bars_html += "<td id='center_align' width='10%'><strong>";
	bars_html += hit_and_run_total;
	bars_html += "</strong></td>";
	bars_html += "<td width='70%'><div class='bar-container'>";
	if (hit_and_run_total > 0) {
		bars_html += "<div id='hit_and_run_bar' class='bar' style='width:";
		bars_html += hit_and_run_total / total_total * 100;
		bars_html += "%;'></div>";
	}
	bars_html += "</div>";
	bars_html += "</td></tr>";
	
	bars_html += "<tr><td width='20%'>Burglary</td>"
	bars_html += "<td id='center_align' width='10%'><strong>";
	bars_html += burglary_total;
	bars_html += "</strong></td>";
	bars_html += "<td width='70%'><div class='bar-container'>";
	if (burglary_total > 0) {
		bars_html += "<div id='burglary_bar' class='bar' style='width:";
		bars_html += burglary_total / total_total * 100;
		bars_html += "%;'></div>";
	}
	bars_html += "</div>";
	bars_html += "</td></tr>";
	bars_html += "</table>";
	
	// We'll load up the bar chart for desktops, mobile phones and tablets
	$('#bar_chart').html(bars_html);
	
	// This counter will determine if this is our second time 
    // Or later through the slider method
    // If it is, we will destroy the old table
    // Set the HTML to the new table info
    // And call our start_table function to make it a datatable
	if (count_initialize_map > 1) {
		$('#crime_table').dataTable().fnDestroy();
		$('#crime_table_tbody').html(crime_data_table);
		start_table();
	// If it's our first time through, we just need to set up the HTML
	// And then make it a datatable
	} else {
		$('#crime_table_tbody').html(crime_data_table);
		start_table();
	}
	// }
};

// This makes our table a datatable
// Which gives us interactive component
function start_table() {
	$('#crime_table').dataTable({
		"sPaginationType": "bootstrap",
		"sScrollY": "425px",
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		}
	});
};

// Geocodify
var maxY = 42.603642;
var minY = 42.376807;
var minX = -92.557068;
var maxX = -92.184906;

var searchMarker;

var searchIcon = L.Icon.extend({
    options: {
        iconUrl: "http://wcfcourier.com/app/crime_map/leaflet/images/marker-icon.png",
        iconSize: new L.Point(16, 27),
        iconAnchor: new L.Point(8, 13),
        shadowSize: new L.Point(25, 32),
        popupAnchor: new L.Point(0, 5)
    }
});

$("#geocoder").geocodify({
    onSelect: function (result) { 
        // Extract the location from the geocoder result
        var location = result.geometry.location;
        // Center the map on the result
        map.setView(new L.LatLng(location.lat(), location.lng()), 15);
        // Remove marker if one is already on map
        if (searchMarker) {
            map.removeLayer(searchMarker);
        }
        // Create marker
        searchMarker = L.marker([location.lat(), location.lng()], {
            clickable: false,
            icon: new searchIcon()
        });
        // Add marker to the map
        searchMarker.addTo(map)
    },
    initialText: "Enter an address",
    regionBias: 'US',
    // Lat, long information for Cedar Valley enter here
    viewportBias: new google.maps.LatLngBounds(
        new google.maps.LatLng(42.376807,-92.557068),
        new google.maps.LatLng(42.603642,-92.184906)
    ),
    width: 300,
    height: 26,
    fontSize: '14px',
    filterResults: function(results) {
        var filteredResults =[];
        $.each(results, function(i,val) {
            var location = val.geometry.location;
            if (location.lat() > minY && location.lat() < maxY) {
                if (location.lng() > minX && location.lng() < maxX) {
                    filteredResults.push(val);
                }
            }
        });
        return filteredResults;
    }
});
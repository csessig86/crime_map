// Information for the base tile
var cloudmadeUrl = 'http://{s}.tile.cloudmade.com/f14689c8008d43da9028a70e6a8e710a/22677/256/{z}/{x}/{y}.png',
cloudmadeAttribution = 'Map data CCBYSA &copy; 2012 OpenStreetMap contributors, Imagery &copy; 2012 CloudMade',
cloudmade = new L.TileLayer(cloudmadeUrl, {maxZoom: 18, attribution: cloudmadeAttribution});

// Set default zoom to Waterloo
var map = new L.Map('map');
map.setView(new L.LatLng(42.495, -92.34), 13).addLayer(cloudmade);

// Crimes that fit between the two dates
// In the date slide
// Will be added to this variable
var layers_group = new L.LayerGroup();

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
    layers_group.clearLayers();
    
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
    function set_marker(color, lat, long) {
        
        // What the markers will look like on mouseover
        function highlight_marker(e, color) {
            var highlight_style = {
                radius: 8,
        	    color: "#000",
                weight: 1.5,
                opacity: 1,
                fillOpacity: 0.7,
                fillColor: color
            };
            e.target.setStyle(highlight_style);
        }
        
        // What the markers will look like on mouseout
        // Same as set_marker function
        // But with two parameters
        function rollout_style(e, color) {
            var options = {
        	    radius: 6,
        	    color: "#ffffff",
        	    weight: 1.5,
        	    opacity: 1,
        	    fillOpacity: 1,
        	    fillColor: color
            };
            e.target.setStyle(options);
        }
        
        // Set location
        // Using parameters called in set_marker function
        marker_location = new L.LatLng(lat, long);
        
        // Color of marker
        // Uses 'color' parameter passed in function
        var options = {
    	    radius: 6,
    	    color: "#ffffff",
    	    weight: 1.5,
    	    opacity: 1,
    	    fillOpacity: 1,
    	    fillColor: color
        };
        // Actually creates the circle marker
        layer = new L.CircleMarker(marker_location, options);
        
        // Create popup using CSS
        var popup = "<div class=popup_box" + "id=" + crime_data[incident] + ">";
        
        // We'll edit the text on some of the crimes below
        // To make it look cleaner on the site
        if (crime_data[incident].crime === 'SHOOTING IN PROGRESS/JUST') {
            crime_formatted = 'Shooting in progress';
        } else if (crime_data[incident].crime === 'WEAPON:SHOTS FIRED') {
            crime_formatted = 'Weapon: Shots fired';
        } else if (crime_data[incident].crime === 'WEAPONS VIOLATIONS') {
            crime_formatted = 'Weapons violations';
        } else if (crime_data[incident].crime === 'ASSAULT/AMBULANCE REQUESTED') {
            crime_formatted = 'Assault: Ambulance requested';
        } else if (crime_data[incident].crime === 'ASSAULT IN PROGRESS/JUST') {
            crime_formatted = 'Assault in progress';
        } else if (crime_data[incident].crime === 'MVA HIT & RUN') {
            crime_formatted = 'Hit and run';
        } else if (crime_data[incident].crime === 'BURGLARY IN PROGRESS/JUST') {
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
        layers_group.addLayer(layer);
        
        // Use e.target to change style of marker we mouseover and mouseout 
        layer.on("mouseover", function (e) {
            // e.target = original fill color
            // Which will be used when we rollover marker
            highlight_marker(e, e.target.options.fillColor);
        });
        layer.on("mouseout", function (e) {
            // Change the style to the original version
            rollout_style(e, e.target.options.fillColor);
        });
    }
    
    // Loop through our JSON file
    for (incident in crime_data) {       
        // Grab LatLng from JSON file
        // And plot locations with our data
        if (crime_data[incident].date >= start && crime_data[incident].date <= end) {
        
            lat = crime_data[incident].lat;
            long = crime_data[incident].long;
        
            if (crime_data[incident].crime === 'HOMICIDE' && document.getElementById('homicide_box').checked === true) {
                color = '#483C32';
                set_marker(color, lat, long);
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
            } else if (crime_data[incident].crime === 'SHOOTING IN PROGRESS/JUST' && document.getElementById('shooting_box').checked === true) {
                color = '#B92317';
                set_marker(color, lat, long);
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
                color = '#B92317';
                set_marker(color, lat, long);
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
                color = '#CF7928';
                set_marker(color, lat, long);
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
                color = '#F5E43E';
                set_marker(color, lat, long);
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
                color = '#86A42C';
                set_marker(color, lat, long);
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
                color = '#86A42C';
                set_marker(color, lat, long);
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
            } else if (crime_data[incident].crime === 'ASSAULT IN PROGRESS/JUST' && document.getElementById('assault').checked === true) {
                color = '#86A42C';
                set_marker(color, lat, long);
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
                color = '#54278F';
                set_marker(color, lat, long);
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
                color = '#73CAEE';
                set_marker(color, lat, long);
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
            } else if (crime_data[incident].crime === 'BURGLARY IN PROGRESS/JUST' && document.getElementById('burglary_box').checked === true) {
                color = '#73CAEE';
                set_marker(color, lat, long);
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
    map.addLayer(layers_group);
    
    // Create piec chart
    var data = [
        { label: "Homicides",  data: homicide_total},
        { label: "Shootings",  data: shooting_total},
        { label: "Weapons violations",  data: weapons_violations_total},
        { label: "Robberies",  data: robbery_total},
        { label: "Assaults",  data: assault_total},
        { label: "Hit and runs",  data: hit_and_run_total},
        { label: "Burglaries",  data: burglary_total}
    ];
    
    // Flot uses jQuery
    $.plot($("#graph"), data, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 2/3,
                    // Sets up label on the 
                    formatter: function(label, series){
                        // For whatever reason "1," appears before all the numbers
                        // We'll convert numbers into strings
                        // And replace "1," with nothing
                        var series_new = series.data + "";
                        var series_new02 = series_new.replace("1,", "");
                        // If the value is one, we'll end with the word 'report'
                        // Otherwise, we'll say 'reports'
                        if (series_new02 > 1) {
                            end_div = ' reports</div>'
                        } else {
                            end_div = ' report</div>';
                        }
                        return '<div id="graph_labels"><strong>'+label+'</strong><br/>'+series_new02+end_div
                    },
                    threshold: 0.1
                },
                stroke: {
                    color: '#F7F7F7'
                }
            }
        },
        legend: {
            show: false
        },
        colors: ['#483C32', '#B92317', '#CF7928', '#F5E43E', '#86A42C', '#54278F', '#73CAEE'],
        grid: {
            hoverable: true,
            clickable: true
        }
    });
    $("#graph").bind("plothover", pieHover);
    
    function pieHover(event, pos, obj) {
        if (!obj) return;
        var series_new = obj.series.data + "";
        var series_new02 = series_new.replace("1,", "");
        if (series_new02 > 1) {
            end_span = ' reports</span>'
        } else {
            end_span = ' report</span>';
        }
        $("#hover").html('<span>'+obj.series.label+': '+series_new02+end_span);
    }
    
    //This counter will determine if this is our second time 
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
}

// This makes our table a datatable
// Which gives us interactive component
function start_table() {
	$('#crime_table').dataTable( {
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"sScrollY": "425px",
        "bScrollCollapse": true,
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		}
	} );
}
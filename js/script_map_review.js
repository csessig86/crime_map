// Information for the base tile
var cloudmadeUrl = 'http://{s}.tile.cloudmade.com/f14689c8008d43da9028a70e6a8e710a/22677/256/{z}/{x}/{y}.png',
cloudmadeAttribution = 'Map data CCBYSA &copy; 2012 OpenStreetMap contributors, Imagery &copy; 2012 CloudMade',
cloudmade = new L.TileLayer(cloudmadeUrl, {maxZoom: 18, attribution: cloudmadeAttribution});

// Set default zoom to either Waterloo or Cedar Falls
// Depends on the url to contain the word 'wloo' or 'cf'
if (window.document.URL.indexOf('templates/wloo') > 0) {
    var map = new L.Map('map');
    // Mobile, desktop view
    if ($(window).width() < 626) {
      map.setView(new L.LatLng(42.495, -92.34), 12).addLayer(cloudmade);
    } else {
      map.setView(new L.LatLng(42.495, -92.34), 13).addLayer(cloudmade);
    }
} else if (window.document.URL.indexOf('templates/cf') > 0) {
    var map = new L.Map('map');
    // Mobile, desktop view
    if ($(window).width() < 626) {
      map.setView(new L.LatLng(42.527, -92.445), 12).addLayer(cloudmade);
    } else {
      map.setView(new L.LatLng(42.527, -92.445), 13).addLayer(cloudmade);
    }
} else {
    var map = new L.Map('map');
    map.setView(new L.LatLng(42.495, -92.34), 11).addLayer(cloudmade);
}

var hexGeojson;
var legend;

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
    initialText: "Enter an address...",
    regionBias: 'US',
    // Lat, long information for Cedar Valley enter here
    viewportBias: new google.maps.LatLngBounds(
        new google.maps.LatLng(42.376807,-92.557068),
        new google.maps.LatLng(42.603642,-92.184906)
    ),
    width: 295,
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

// Toggle for description and X buttons
// Only visible on mobile
isVisibleDescription = false;
// Grab legend content
legendContentHeader = $('#mobile_header h4').html();
legendContentEtc = $('#info-map').html() + '<h4>Select types of crimes to display:</h4>';
$('.toggle_description').click(function() {
  if (isVisibleDescription === false) {
    $('.description_box_cover').show();
    $('.description_box_text_header').html('<h4>' + legendContentHeader + '</h4>');
    $('.description_box_text_etc').html("<div class='info legend legend-mobile leaflet-control'>" + $(".legend-desktop").html() + "</div>" + legendContentEtc);
    $('.description_box').show();
    isVisibleDescription = true;
  } else {
    $('.description_box').hide();
    $('.description_box_cover').hide();
    isVisibleDescription = false;
  }
});


// Reset the polygon styles
function resetHighlight(e) {
  var layer = e.target;
  layer.setStyle({
    "color": "#FFF",
    "weight": 1,
    "opacity": 0.8,
    "fillOpacity": 0.85
  })
};

// Highlight style
function highlightPolygons(e) {
  var layer = e.target;
  layer.setStyle({
    "color": "#333",
    "weight": 2,
    "fillOpacity": 0.95,
    "opacity": 1
  })

  if (!L.Browser.ie && !L.Browser.opera) {
    layer.bringToFront();
  }
}


// Set buckets of colors for the layers
function getColor(m) {
  if ( $('input[name=map-filter]:checked', '.select-map').val() === 'violent' ) {
    // Determine which colors will be displayed based on which form is checked
    return m < 2 ? "#fff7ec" :
         m < 5 ? "#fee8c8" :
         m < 10 ? "#fdd49e" :
         m < 15 ? "#fdbb84" :
         m < 20 ? "#fc8d59" :
         m < 25 ? "#ef6548" :
         m < 30 ? "#d7301f" :
         m < 35 ? "#b30000" :
         m < 200 ? "#7f0000" :
                "#CCC" ;
  } if ( $('input[name=map-filter]:checked', '.select-map').val() === 'property' ) {
    return m < 2 ? "#f7fcfd" :
       m < 5 ? "#e0ecf4" :
       m < 10 ? "#bfd3e6" :
       m < 15 ? "#9ebcda" :
       m < 20 ? "#8c96c6" :
       m < 25 ? "#8c6bb1" :
       m < 30 ? "#88419d" :
       m < 35 ? "#810f7c" :
       m < 200 ? "#4d004b" :
            "#CCC" ;

  }
}


// Color the layers
function style(feature) {
  fill_color = getColor( parseInt( feature.properties["COUNT"] ) );

	return {
	    "color": "#FFF",
	    "weight": 1,
	    "opacity": 0.8,
	    "fillOpacity": 0.85,
	    "fillColor": fill_color
  }
}

// Set the mouseover, mouseout events
function onEachFeature(feature, layer) {
  layer.on({
    mouseover: highlightPolygons,
    mouseout: resetHighlight
  });
  
  var popupContent = "<h4>Crimes reported</strong>: " + feature.properties["COUNT"] + "</h4>";
  layer.bindPopup(popupContent);
}


// Set the legend
function setLegend(crime_type) {
  if (legend !== undefined) {
    map.removeControl(legend);
  }

  // Our legend
  legend = L.control( {position: 'bottomright'} );

  legend.onAdd = function (map) {
      if (crime_type === 'violent') {
        crime_type_legend = 'Violent crimes';
      } else if (crime_type === 'property') {
        crime_type_legend = 'Property crimes';
      } else {
        crime_type_legend = 'Crimes';
      }

      var div = L.DomUtil.create('div', 'info legend legend-desktop hidden-phone'),
          grades = [1, 5, 10, 15, 20, 25, 30, 35],
          labels = [];
      // loop through our density intervals and generate a label with a colored square for each interval
      div.innerHTML += '<div class="legend-header">' + crime_type_legend + ' <br />reported</div>';

      for (var i = 0; i < grades.length; i++) {
          div.innerHTML +=
              '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
              grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
      }
      return div;
  };

  legend.addTo(map);
}

// Figure out which data set to display
function setMap() {
  if (hexGeojson !== undefined) {
    map.removeLayer(hexGeojson);
  }
  
  if ( $('input[name=map-filter]:checked', '.select-map').val() === 'violent' ) {
    // Our geoJSON variables
    hexGeojson = L.geoJson(crime_data_review_violent, {
      style: style,
      onEachFeature: onEachFeature
    }).addTo(map);

    // Change header
    if (window.document.URL.indexOf('templates/wloo') > 0) {
      $('#mobile_header h4').html('<h4>Map: Violent crimes reported in Waterloo in 2013</h4>');
    } else if (window.document.URL.indexOf('templates/cf') > 0) {
      $('#mobile_header h4').html('<h4>Map: Violent crimes reported in Cedar Falls in 2013</h4>');
    } else {
      $('#mobile_header h4').html('<h4>Map: Crimes reported in the Cedar Valley in 2013</h4>');
    }

    setLegend('violent');

  } else if ( $('input[name=map-filter]:checked', '.select-map').val() === 'property' ){
    hexGeojson = L.geoJson(crime_data_review_property, {
      style: style,
      onEachFeature: onEachFeature
    }).addTo(map);

    // Change header
    if (window.document.URL.indexOf('templates/wloo') > 0) {
      $('#mobile_header h4').html('<h4>Map: Property crimes reported in Waterloo in 2013</h4>');
    } else if (window.document.URL.indexOf('templates/cf') > 0) {
      $('#mobile_header h4').html('<h4>Map: Property crimes reported in Cedar Falls in 2013</h4>');
    } else {
      $('#mobile_header h4').html('<h4>Map: Crimes reported in the Cedar Valley in 2013</h4>');
    }

    setLegend('property');
  }

  $('.description_box').hide();
  $('.description_box_cover').hide();
  isVisibleDescription = false;

}

// Reset the map every time the radio form is changed
$('body').on('click', '.select-map input', function() {
  
  if ( $(this).parent().attr('id') === 'select-map-desktop' ) {
    var valChecked = $('input[name=map-filter]:checked', '#select-map-desktop').val();
    $('input[name=map-filter]:checked', '#select-map-mobile').val(valChecked);
  } else if ( $(this).parent().attr('id') === 'select-map-desktop' ) {
    var valChecked = $('input[name=map-filter]:checked', '#select-map-mobile').val();
    $('input[name=map-filter]:checked', '#select-map-desktop').val(valChecked);
  
  }

  setMap();
});


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


crime_data_table = '';

function tableCreate() {
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

    crime_data_table += '<tr>';
    crime_data_table += '<td>' + crime_data[incident].date + '</td>';
    crime_data_table += '<td>' + crime_data[incident].times2 + '</td>';
    crime_data_table += '<td>' + crime_data[incident].crime;
    
    if (crime_data[incident].location_geo === 'UNI') {
        crime_data_table += '<div style="font-size:10px;">* Report from UNI PD</div>';
    }
    
    crime_data_table += '</td>';
    crime_data_table += '<td>' + lowercase_letters(crime_data[incident].location) + '</td>';
    crime_data_table += '<td>' + lowercase_letters(crime_data[incident].disposition) + '</td>';
    crime_data_table += '</tr>';
  }

  $('#crime_table_tbody').html(crime_data_table);
  tableStart();
};

// This makes our table a datatable
// Which gives us interactive component
function tableStart() {
    $('#crime_table').dataTable({
        "sPaginationType": "bootstrap",
        "sScrollY": "625px",
        "iDisplayLength": 15,
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        }
    });
};

// Fire it off
setMap();